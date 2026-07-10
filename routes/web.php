<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallController;
use App\Livewire\Auth\Login;
use App\Livewire\Dashboard;
use App\Livewire\Member\Index;
use App\Livewire\Deposit\Index as DepositIndex;
use App\Livewire\Expense\Index as ExpenseIndex;
use App\Livewire\Accounts\Index as AccountsIndex;

// ✅ ইনস্টলেশন রাউট (কোনো মিডলওয়্যার নেই - সবসময় অ্যাক্সেসযোগ্য)
Route::prefix('install')->name('install.')->group(function () {
    Route::get('/', [InstallController::class, 'welcome'])->name('welcome');
    Route::get('/database', [InstallController::class, 'database'])->name('database');
    Route::post('/database', [InstallController::class, 'saveDatabase'])->name('save.database');
    Route::get('/migrate', [InstallController::class, 'migrate'])->name('migrate');
    Route::get('/admin', [InstallController::class, 'admin'])->name('admin');
    Route::post('/admin', [InstallController::class, 'saveAdmin'])->name('save.admin');
    Route::get('/complete', [InstallController::class, 'complete'])->name('complete');
});

// ✅ ইনস্টলেশন চেক সহ সব রাউট
Route::middleware('install.check')->group(function () {

    // হোমপেজে গেলে সরাসরি লগইন পেজে রিডাইরেক্ট
    Route::get('/', function () {
        return redirect()->route('login');
    });

    // লগইন পেজ (শুধুমাত্র গেস্টদের জন্য)
    Route::get('/login', Login::class)->name('login');

    // ✅ সব প্রটেক্টেড রাউট 
    Route::middleware('auth')->group(function () {
        
        // ✅ Dashboard (যাদের permission আছে তাদের জন্য)
        Route::get('/dashboard', Dashboard::class)->name('dashboard')->middleware('permission:dashboard');  
        Route::get('/members', Index::class)->name('members.index')->middleware('permission:member_management');
        Route::get('/deposits', DepositIndex::class)->name('deposits.index')->middleware('permission:deposit_management'); 
        Route::get('/expenses', ExpenseIndex::class)->name('expenses.index')->middleware('permission:expenses_management');
        Route::get('/accounts', AccountsIndex::class)->name('accounts.index')->middleware('permission:accounts_management');
        Route::get('/loans', \App\Livewire\Loan\Index::class)->name('loans.index')->middleware('permission:loan_management');
        
        // ✅ SMS Portal (যাদের permission আছে তাদের জন্য)
        Route::get('/sms-portal', \App\Livewire\Sms\Portal::class)->name('sms.portal')->middleware('permission:sms_portal');    
        
        // ✅ ১. Settings রাউট (শুধুমাত্র Super Admin এর জন্য)
        Route::get('/settings', \App\Livewire\Settings\Index::class)->name('settings.index')->middleware('role:super_admin');
        
        // ✅ ২. Member Requests রাউট (শুধুমাত্র Admin এবং Super Admin এর জন্য)
        Route::get('/member-requests', \App\Livewire\Admin\MemberRequests::class)->name('admin.member-requests')->middleware('role:admin,super_admin');
        
        // ✅ ৩. Mobile রাউট (শুধুমাত্র User/Member রোলের জন্য)
        Route::get('/mobile-dashboard', \App\Livewire\User\Dashboard::class)->name('user.dashboard')->middleware('role:user');
        Route::get('/mobile-history', \App\Livewire\User\History::class)->name('user.history')->middleware('role:user');
        Route::get('/mobile-notice', function() {
            return redirect()->route('user.notifications');
        })->name('user.notice')->middleware('role:user');
        Route::get('/mobile-deposit-request', \App\Livewire\User\DepositRequest::class)->name('user.deposit-request')->middleware('role:user');
        Route::get('/mobile-loan', \App\Livewire\User\Loan::class)->name('user.loan')->middleware('role:user');
        Route::get('/mobile-loan-detail/{loanId}', \App\Livewire\User\LoanDetail::class)->name('user.loan-detail')->middleware('role:user');
        Route::get('/mobile-notifications', \App\Livewire\User\Notifications::class)->name('user.notifications')->middleware('role:user');
        Route::get('/mobile-profile', \App\Livewire\User\Profile::class)->name('user.profile')->middleware('role:user');
        Route::get('/mobile-security', \App\Livewire\User\Security::class)->name('user.security')->middleware('role:user');
        Route::get('/mobile-settings', \App\Livewire\User\Settings::class)->name('user.settings')->middleware('role:user');
        Route::get('/mobile-support', \App\Livewire\User\Support::class)->name('user.support')->middleware('role:user');
        Route::post('/mobile-change-password', function (\Illuminate\Http\Request $request) {
            $request->validate(['current_password' => 'required', 'new_password' => 'required|min:6']);
            if (!\Illuminate\Support\Facades\Hash::check($request->current_password, auth()->user()->password)) {
                return response()->json(['success' => false, 'message' => 'Current password is incorrect.']);
            }
            auth()->user()->update(['password' => \Illuminate\Support\Facades\Hash::make($request->new_password)]);
            return response()->json(['success' => true]);
        })->name('user.change-password')->middleware('role:user');

        // লগআউট রাউট
        Route::post('/logout', function () {
            auth()->logout();
            return redirect()->route('login');
        })->name('logout'); 
    });

});
