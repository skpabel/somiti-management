<?php

namespace App\Livewire\User;

use App\Models\Deposit;
use App\Models\Loan;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Notifications extends Component
{
    public $activeFilter = 'all';
    public $notifications = [];

    public function mount()
    {
        $this->loadAll();
    }

    public function setFilter(string $filter)
    {
        $this->activeFilter = $filter;
    }

    public function markRead(int $noticeId, string $source)
    {
        if ($source === 'notice' && $noticeId > 0) {
            \App\Models\NoticeRead::firstOrCreate([
                'notice_id' => $noticeId,
                'member_id' => auth()->user()->member->id,
            ], [
                'read_at' => now(),
            ]);
            $this->loadAll(); // reload
        }
    }

    public function deleteNotice(int $noticeId)
    {
        if ($noticeId <= 0) return;
        
        // Mark as deleted
        \App\Models\NoticeRead::updateOrCreate(
            [
                'notice_id' => $noticeId,
                'member_id' => auth()->user()->member->id,
            ],
            [
                'read_at' => now(),
                'deleted_at' => now(), // Mark as deleted
            ]
        );
        
        $this->loadAll(); // reload
        session()->flash('message', '✅ Notice removed successfully!');
    }

    public function loadAll()
    {
        $member     = auth()->user()->member;
        $dateFormat = \App\Models\Setting::get('date_format', 'd M, Y');
        $items      = [];

        // ── Deposit alerts ──────────────────────────────────────────
        $draftDeposits = Deposit::where('member_id', $member->id)
            ->where('status', 'draft')
            ->orderBy('month_year', 'asc')
            ->get();

        $today           = \Carbon\Carbon::today();
        $currentMonthYear = $today->format('Y-m');
        $day             = $today->day;

        foreach ($draftDeposits as $deposit) {
            $month      = \Carbon\Carbon::createFromFormat('Y-m', $deposit->month_year)->format('F Y');
            $isPastMonth = $deposit->month_year < $currentMonthYear;
            $isCurrentMonth = $deposit->month_year === $currentMonthYear;
            $amount     = $deposit->deposit_amount + $deposit->due_amount + $deposit->fine_amount;
            $hasFine    = $deposit->fine_amount > 0;
            $hasDue     = $deposit->due_amount > 0;

            // Build message parts
            $parts = [];
            $parts[] = 'Deposit ৳' . number_format($deposit->deposit_amount, 0);
            if ($hasDue)  $parts[] = 'Due ৳' . number_format($deposit->due_amount, 0);
            if ($hasFine) $parts[] = 'Fine ৳' . number_format($deposit->fine_amount, 0);
            $breakdown = implode(' + ', $parts);

            // Estimated fine (5% of deposit amount)
            $estimatedFine = $deposit->deposit_amount * 0.05;
            $fineNote = $hasFine
                ? ''
                : ' Estimated fine: ৳' . number_format($estimatedFine, 0) . ' (5%).';

            // Determine urgency
            if ($isPastMonth) {
                // Past month unpaid — urgent + fine warning
                $title   = '⚠️ Overdue: ' . $month;
                $message = 'Please submit immediately. ' . $breakdown . '.' . $fineNote;
                $color   = 'red';
            } elseif ($isCurrentMonth && $day > 30) {
                // Current month, after 30th
                $title   = '🔴 Last chance: ' . $month;
                $message = 'Submit before deadline. ' . $breakdown . '.' . $fineNote;
                $color   = 'red';
            } elseif ($isCurrentMonth && $day > 15) {
                // Current month, after 15th — late period
                $title   = '⏰ Late: ' . $month . ' deposit due';
                $message = 'Deadline passed.' . $fineNote . ' ' . $breakdown;
                $color   = 'orange';
            } elseif ($isCurrentMonth && $day >= 10) {
                // Current month, collection open
                $title   = '📅 ' . $month . ' deposit due';
                $message = 'Collection is open. Please submit soon. ' . $breakdown;
                $color   = 'orange';
            } else {
                // Upcoming
                $title   = '📌 ' . $month . ' deposit upcoming';
                $message = $breakdown;
                $color   = 'blue';
            }

            $items[] = [
                'type'       => 'deposit',
                'title'      => $title,
                'message'    => $message,
                'amount'     => '৳' . number_format($amount, 0),
                'color'      => $color,
                'read'       => false,
                'time'       => $isPastMonth ? 'Overdue' : ($isCurrentMonth && $day > 15 ? 'Late' : 'Upcoming'),
                'month_year' => $deposit->month_year,
                'direct'     => true, // no popup, direct redirect
            ];
        }

        // ── Admin Notices ───────────────────────────────────────────
        if (class_exists(\App\Models\Notice::class) && class_exists(\App\Models\NoticeRead::class)) {
            // Get read IDs (for styling)
            $readIds = \App\Models\NoticeRead::where('member_id', $member->id)
                ->whereNull('deleted_at')
                ->pluck('notice_id')
                ->toArray();
            
            // Get deleted IDs (to exclude completely)
            $deletedIds = \App\Models\NoticeRead::where('member_id', $member->id)
                ->whereNotNull('deleted_at')
                ->pluck('notice_id')
                ->toArray();
            
            $notices = \App\Models\Notice::whereNotIn('id', $deletedIds)
                ->where(function($q) use ($member) {
                    // All members
                    $q->where('target_group', 'all')
                      // Or specific/custom members
                      ->orWhere(function($q2) use ($member) {
                          $q2->whereIn('target_group', ['specific', 'custom'])
                             ->where(function($q3) use ($member) {
                                 $q3->whereRaw("JSON_CONTAINS(target_member_ids, ?)", [json_encode((string)$member->id)])
                                    ->orWhereRaw("JSON_CONTAINS(target_member_ids, ?)", [json_encode((int)$member->id)]);
                             });
                      });
                })
                ->latest()
                ->get();

            foreach ($notices as $notice) {
                $color = match($notice->priority) {
                    'urgent' => 'red',
                    'meeting' => 'purple',
                    default  => 'blue',
                };
                
                // Extract ALL emojis from title (broader Unicode range)
                preg_match('/[\x{203C}-\x{3299}\x{1F000}-\x{1F9FF}]/u', $notice->title, $matches);
                $emoji = $matches[0] ?? '📢';
                
                // Remove ALL emojis from title (including common symbols like ⏳)
                $titleWithoutEmoji = trim(preg_replace('/[\x{203C}-\x{3299}\x{1F000}-\x{1F9FF}]/u', '', $notice->title));
                
                // Check if this notice is read by current member
                $isRead = in_array($notice->id, $readIds);
                
                $items[] = [
                    'type'    => 'notice',
                    'title'   => $titleWithoutEmoji, // Title without emoji
                    'message' => $notice->message,
                    'amount'  => null,
                    'color'   => $color,
                    'read'    => $isRead, // Mark as read if in readIds
                    'time'    => formatDateTime($notice->created_at),
                    '_src'    => 'notice',
                    '_id'     => $notice->id,
                    '_emoji'  => $emoji, // Store emoji separately for icon display
                ];
            }
        }

        // ── Loan alerts (REMOVED - next_due_date column doesn't exist) ──
        // Loan notifications will be added later when next_due_date column is available
        
        $this->notifications = $items;
    }

    public function getFilteredItemsProperty()
    {
        $tagged = array_map(
            fn($item, $idx) => $item + ['_src' => $item['type'], '_idx' => $idx],
            $this->notifications,
            array_keys($this->notifications)
        );

        return match($this->activeFilter) {
            'unread'  => array_values(array_filter($tagged, fn($i) => !$i['read'])),
            'deposit' => array_values(array_filter($tagged, fn($i) => $i['type'] === 'deposit')),
            'loan'    => array_values(array_filter($tagged, fn($i) => $i['type'] === 'loan')),
            'notice'  => array_values(array_filter($tagged, fn($i) => $i['type'] === 'notice')),
            default   => $tagged,
        };
    }

    public function getUnreadCountProperty()
    {
        return count(array_filter($this->notifications, fn($i) => !$i['read']));
    }

    public function getDepositCountProperty()
    {
        return count(array_filter($this->notifications, fn($i) => $i['type'] === 'deposit'));
    }

    public function getLoanCountProperty()
    {
        return count(array_filter($this->notifications, fn($i) => $i['type'] === 'loan'));
    }

    public function getNoticeCountProperty()
    {
        return count(array_filter($this->notifications, fn($i) => $i['type'] === 'notice'));
    }

    public function render()
    {
        return view('livewire.user.notifications');
    }
}
