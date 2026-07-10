<?php

namespace App\Livewire\Sms;

use App\Models\Member;
use App\Models\Deposit;
use App\Models\Loan;
use App\Models\Setting;
use App\Models\SmsLog;
use App\Models\SmsTemplate;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Portal extends Component
{
    public $smsActive = false;
    public $activeTab = 'send';
    
    // Send SMS Properties
    public $smsCategories = ['Single SMS', 'Alert SMS', 'Due SMS', 'Loan SMS', 'Group SMS', 'Meeting SMS'];
    public $selectedCategory = 'Single SMS';
    public $targetGroup = 'all';
    public $availableMembers = [];
    public $selectedMembers = [];
    public $templates = [];
    public $allTemplates = [];
    public $selectedTemplate = null;
    public $message = '';
    public $balanceMessage = '';
    public $selectAll = false;

    // Delivery options
    public $showDeliveryModal = false;
    public $sendViaSMS = true;
    public $sendViaNotification = true;
    public $noticeTitle = '';

    // Category icon mapping
    public function getCategoryIcon($category)
    {
        return match($category) {
            'Single SMS' => '👤',
            'Alert SMS' => '🚨',
            'Due SMS' => '⏳',
            'Loan SMS' => '💰',
            'Group SMS' => '👥',
            'Meeting SMS' => '📅',
            default => '📱',
        };
    }

    public function getCategoryPriority($category)
    {
        return match($category) {
            'Alert SMS' => 'urgent',
            'Meeting SMS' => 'meeting',
            default => 'normal',
        };
    }

    // Template Modal Properties
    public $showTemplateModal = false;
    public $templateId = null;
    public $templateName = '';
    public $templateCategory = '';
    public $templateMessage = '';

    // Delete Template Properties
    public $confirmDelete = false;
    public $deleteId = null;

    // History Properties
    public $history = [];
    public $searchHistory = '';
    public $filterStatus = '';
    public $filterDate = '';
    public $historySuccessCount = 0;
    public $historyFailedCount = 0;

    // ✅ View Message Modal Properties
    public $showViewMessageModal = false;
    public $viewMessageData = null;

    public function mount()
    {
        $this->smsActive = Setting::get('sms_is_active', false);
        $this->loadTemplates();
        $this->loadMembers();
        $this->loadHistory();
    }

    // ===== Member Loading Logic =====
    public function loadMembers()
    {
        $currentMonth = now()->format('Y-m');
        
        $query = Member::orderByRaw('CAST(account_no AS UNSIGNED) ASC');

        if ($this->selectedCategory === 'Due SMS') {
            $dueMemberIds = Deposit::where('due_amount', '>', 0)
                ->pluck('member_id')
                ->unique();
            $query->whereIn('id', $dueMemberIds);
        } 
        
        elseif ($this->selectedCategory === 'Loan SMS') {
            $query->whereHas('loans', function($q) {
                $q->whereIn('status', ['disbursed', 'active']);
            });
        }

        if ($this->targetGroup === 'bd') {
            $query->where(function($q) {
                $q->where('mobile', 'LIKE', '880%')
                  ->orWhere('mobile', 'LIKE', '0%');
            });
        } elseif ($this->targetGroup === 'abroad') {
            $query->where(function($q) {
                $q->where('mobile', 'NOT LIKE', '880%')
                  ->where('mobile', 'NOT LIKE', '0%');
            });
        }

        $this->availableMembers = $query->get();
    }

        public function updatedSelectedCategory() 
    { 
        $this->selectedTemplate = null; 
        $this->message = '';
        $this->selectAll = false;
        $this->selectedMembers = [];
        $this->loadMembers(); 
        $this->loadTemplates(); 
    }
        public function updatedTargetGroup() 
    { 
        $this->selectAll = false;
        $this->selectedMembers = [];
        $this->loadMembers(); 
    }

        public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedMembers = $this->availableMembers->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selectedMembers = [];
        }
    }

    public function updatedSelectedTemplate()
    {
        if ($this->selectedTemplate) {
            $tpl = SmsTemplate::find($this->selectedTemplate);
            if ($tpl) {
                $this->message = $tpl->message;
            }
        }
    }

    // ===== Template CRUD =====
    public function loadTemplates()
    {
        $this->templates = SmsTemplate::where('category', $this->selectedCategory)
            ->orderBy('name', 'asc')
            ->get();

        $this->allTemplates = SmsTemplate::orderBy('category', 'asc')->orderBy('name', 'asc')->get();
    }

    public function openTemplateModal($id = null)
    {
        $this->reset(['templateName', 'templateCategory', 'templateMessage']);
        $this->templateId = $id;
        
        if ($id) {
            $tpl = SmsTemplate::find($id);
            $this->templateName = $tpl->name;
            $this->templateCategory = $tpl->category;
            $this->templateMessage = $tpl->message;
        } else {
            $this->templateCategory = $this->selectedCategory;
        }
        
        $this->showTemplateModal = true;
    }

    public function saveTemplate()
    {
        $this->validate([
            'templateName' => 'required|string',
            'templateCategory' => 'required|string',
            'templateMessage' => 'required|string',
        ]);

        SmsTemplate::updateOrCreate(['id' => $this->templateId], [
            'name' => $this->templateName,
            'category' => $this->templateCategory,
            'message' => $this->templateMessage,
        ]);

        $this->showTemplateModal = false;
        $this->loadTemplates();
        session()->flash('message', $this->templateId ? '✅ Template Updated!' : '✅ Template Added!');
    }

    public function confirmDeleteTemplate($id)
    {
        $this->deleteId = $id;
        $this->confirmDelete = true;
    }

    public function deleteTemplate()
    {
        SmsTemplate::find($this->deleteId)?->delete();
        $this->confirmDelete = false;
        $this->loadTemplates();
        session()->flash('message', '🗑️ Template Deleted!');
    }

    // ===== SMS Sending Logic =====
    public function sendSms()
    {
        if (!$this->smsActive) {
            session()->flash('message', '⛔ SMS Gateway is inactive!');
            return;
        }

        if (empty($this->selectedMembers) || empty($this->message)) {
            session()->flash('message', '⚠️ Select members and write a message!');
            return;
        }

        // Show delivery options modal for ALL SMS types
        if (!$this->showDeliveryModal) {
            $this->noticeTitle = $this->selectedCategory; // Default title
            $this->showDeliveryModal = true;
            return;
        }

        $this->confirmAndSend();
    }

    public function confirmAndSend()
    {
        if (!$this->sendViaSMS && !$this->sendViaNotification) {
            session()->flash('message', '⚠️ Select at least one delivery method!');
            return;
        }

        // Create notification if checked (for ANY SMS category)
        if ($this->sendViaNotification) {
            $targetMemberIds = array_map('intval', $this->selectedMembers);
            
            // Clean user input: remove any emojis from noticeTitle (broader range)
            $cleanTitle = trim(preg_replace('/[\x{203C}-\x{3299}\x{1F000}-\x{1F9FF}]/u', '', $this->noticeTitle ?: $this->selectedCategory));
            
            // Build final title: category icon + clean text
            $finalTitle = $this->getCategoryIcon($this->selectedCategory) . ' ' . $cleanTitle;
            
            // Create individual notice for each member with personalized message
            foreach ($targetMemberIds as $memberId) {
                $member = \App\Models\Member::find($memberId);
                if (!$member) continue;
                
                // Format message with member details (same as SMS format)
                $personalizedMessage = "Dear {$member->name_english} (Acc#{$member->account_no}, Share#{$member->shares}) {$this->message}";
                
                \App\Models\Notice::create([
                    'title'             => $finalTitle,
                    'message'           => $personalizedMessage,
                    'priority'          => $this->getCategoryPriority($this->selectedCategory),
                    'target_group'      => 'custom', // Individual notice
                    'target_member_ids' => [$memberId], // Single member
                    'created_by'        => auth()->id(),
                    'source'            => 'sms_portal',
                ]);

            }
        }

        // Send SMS if checked
        if ($this->sendViaSMS) {
            $this->executeSmsDelivery();
        } else {
            session()->flash('message', '📬 Notification sent to ' . count($this->selectedMembers) . ' members!');
            $this->loadHistory();
            $this->selectedMembers = [];
            $this->message = '';
        }

        $this->showDeliveryModal = false;
    }

    private function executeSmsDelivery()
    {
        if (!$this->smsActive) {
            session()->flash('message', '⛔ SMS Gateway is inactive!');
            return;
        }

        if (empty($this->selectedMembers) || empty($this->message)) {
            session()->flash('message', '⚠️ Select members and write a message!');
            return;
        }

        $gw = [
            'url' => Setting::get('sms_api_url'),
            'user' => Setting::get('sms_api_username'),
            'key' => Setting::get('sms_api_key'),
            'sender' => Setting::get('sms_sender_id'),
            'type' => Setting::get('sms_transaction_type', 'T'),
        ];

        $successCount = 0;
        $failCount = 0;

        $uniqueMemberIds = array_unique($this->selectedMembers);

        foreach ($uniqueMemberIds as $memberId) {
            $member = Member::find($memberId);
            if (!$member) continue;

            $finalMessage = "Dear {$member->name_english} (Acc#{$member->account_no}, Share#{$member->shares}) {$this->message}";
            
            $phone = $member->mobile;
            $phone = str_replace([' ', '-', '+'], '', $phone);
            
            if (str_starts_with($phone, '880')) {
            } elseif (str_starts_with($phone, '0')) {
                $phone = '880' . substr($phone, 1);
            } elseif (strlen($phone) === 10 && str_starts_with($phone, '1')) {
                $phone = '880' . $phone;
            }

            try {
                $response = Http::post($gw['url'], [
                    'UserName' => $gw['user'],
                    'Apikey' => $gw['key'],
                    'MobileNumber' => $phone,
                    'CampaignId' => 'null',
                    'SenderName' => $gw['sender'],
                    'TransactionType' => $gw['type'],
                    'Message' => $finalMessage,
                ]);

                $data = $response->json();
                $isSuccess = isset($data['statusCode']) && $data['statusCode'] == "200";

                $statusText = 'Success';
                $trxnId = $data['trxnId'] ?? null;

                if (!$isSuccess) {
                    $apiError = $data['responseResult'] ?? ($data['message'] ?? $response->body());
                    $statusText = 'Failed - ' . $apiError;
                    $trxnId = $trxnId ?? ('ERR-' . time());
                }

                SmsLog::create([
                    'user_id' => auth()->id(),
                    'member_id' => $member->id,
                    'acc_no' => $member->account_no,
                    'member_name' => $member->name_english,
                    'phone' => $phone,
                    'sms_type' => str_replace(' SMS', '', $this->selectedCategory),
                    'message' => $finalMessage,
                    'status' => $statusText,
                    'trxn_id' => $trxnId,
                    'sent_at' => now(),
                ]);

                if ($isSuccess) $successCount++;
                else $failCount++;

            } catch (\Exception $e) {
                SmsLog::create([
                    'user_id' => auth()->id(),
                    'member_id' => $member->id,
                    'acc_no' => $member->account_no,
                    'member_name' => $member->name_english,
                    'phone' => $phone,
                    'sms_type' => str_replace(' SMS', '', $this->selectedCategory),
                    'message' => $finalMessage,
                    'status' => 'Failed - Network Error: ' . $e->getMessage(),
                    'sent_at' => now(),
                ]);
                $failCount++;
            }
        }

        $this->loadHistory();
        $this->selectedMembers = [];
        $this->message = '';
        
        session()->flash('message', "📧 SMS Sent: ✅ {$successCount} Success, ❌ {$failCount} Failed");
    }

    public function checkBalance()
    {
        $url = Setting::get('sms_api_url');
        $user = Setting::get('sms_api_username');
        $key = Setting::get('sms_api_key');

        if (!$url || !$key) {
            $this->balanceMessage = '⛔ Gateway Not Configured!';
            return;
        }

        $balanceUrl = str_replace("/SMS", "/balanceCheck", $url);
        if (!str_contains($balanceUrl, "balanceCheck")) {
            $balanceUrl = "https://api.mimsms.com/api/SmsSending/balanceCheck";
        }

        try {
            $response = Http::post($balanceUrl, [
                'UserName' => $user,
                'Apikey' => $key,
            ]);
            
            $data = $response->json();
            
            if (isset($data['statusCode']) && $data['statusCode'] == "200") {
                $this->balanceMessage = "✅ Available Balance: ৳" . number_format($data['responseResult'] ?? 0, 2);
            } else {
                $this->balanceMessage = "❌ Failed: " . ($data['responseResult'] ?? 'Unknown Error');
            }
        } catch (\Exception $e) {
            $this->balanceMessage = "⛔ Network Error!";
        }
    }

    // ===== History Logic =====
    public function loadHistory()
    {
        $query = SmsLog::latest();

        if ($this->searchHistory) {
            $query->where(function($q) {
                $q->where('member_name', 'like', '%'.$this->searchHistory.'%')
                  ->orWhere('phone', 'like', '%'.$this->searchHistory.'%')
                  ->orWhere('acc_no', 'like', '%'.$this->searchHistory.'%');
            });
        }

        if ($this->filterStatus === 'success') {
            $query->where('status', 'like', '%Success%');
        } elseif ($this->filterStatus === 'failed') {
            $query->where('status', 'not like', '%Success%');
        }

        if ($this->filterDate) {
            $query->whereDate('sent_at', $this->filterDate);
        }

        $this->history = $query->get();

        $this->historySuccessCount = $this->history->filter(fn($log) => str_contains($log->status, 'Success'))->count();
        $this->historyFailedCount = $this->history->count() - $this->historySuccessCount;
    }

    public function updatedSearchHistory()
    {
        $this->loadHistory();
    }

    public function updatedFilterStatus()
    {
        $this->loadHistory();
    }

    public function updatedFilterDate()
    {
        $this->loadHistory();
    }

    // ===== ✅ View Message Modal Methods =====
    public function openViewMessageModal($id)
    {
        $this->viewMessageData = SmsLog::with('member')->find($id);
        $this->showViewMessageModal = true;
    }

    public function closeViewMessageModal()
    {
        $this->showViewMessageModal = false;
        $this->viewMessageData = null;
    }

    public function render()
    {
        return view('livewire.sms.portal');
    }
}