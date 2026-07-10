<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\MemberRequest;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Login extends Component
{
    #[Rule('required|string')]
    public $login;

    #[Rule('required|string')]
    public $password;

    public $remember = false;

    public $throttleSeconds = 0;

    // ✅ Login Page Settings
    public $orgName = '';
    public $orgLogo = '';
    public $orgLogoShape = 'round';

    // ✅ Registration Properties
    public $reg_name = '';
    public $reg_mobile = '';
    public $reg_country_code = '880';
    public $reg_email = '';
    public $reg_otp = '';
    public $reg_otp_sent = false;
    public $reg_verified = false;

    // ✅ Forgot Password Properties
    public $fp_identifier = ''; // Mobile or Email
    public $fp_otp = '';
    public $fp_otp_sent = false;
    public $fp_verified = false;
    public $fp_new_password = '';
    public $fp_confirm_password = '';

    // ✅ Send Registration OTP Method
    public function sendRegistrationOtp()
    {
        // ✅ নম্বর থেকে প্রথমে ০ বা + বাদ দিয়ে কান্ট্রি কোড যুক্ত করা (যেমন: 01712345678 -> 8801712345678)
        $this->reg_mobile = $this->reg_country_code . ltrim($this->reg_mobile, '0+');

        $this->validate([
            'reg_name' => 'required|string|max:255',
            'reg_mobile' => 'required|string|unique:users,phone|unique:members,mobile',
            'reg_email' => 'required|email|unique:users,email|unique:members,email',
        ], [
            'reg_mobile.unique' => 'This mobile number is already registered.',
            'reg_email.unique' => 'This email address is already registered.',
        ]);

        // 4 digit OTP generate
        $otp = rand(1000, 9999);

        // OTP save to database
        DB::table('otps')->updateOrInsert(
            ['identifier' => $this->reg_mobile, 'type' => 'registration'],
            [
                'otp' => $otp,
                'is_verified' => false,
                'expires_at' => now()->addMinutes(5),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // TODO: SMS API call here using $this->reg_mobile
        // TODO: Mail send here using $this->reg_email

        // For testing purpose, showing OTP in flash message
        session()->flash('message', "OTP sent successfully! (Test OTP: $otp)");
        $this->reg_otp_sent = true;
    }

    // ✅ Verify Registration OTP Method
    public function verifyRegistrationOtp()
    {
        $this->validate([
            'reg_otp' => 'required|digits:4',
        ]);

        $otpRecord = DB::table('otps')
            ->where('identifier', $this->reg_mobile)
            ->where('type', 'registration')
            ->where('is_verified', false)
            ->where('expires_at', '>', now())
            ->first();

        if (!$otpRecord || $otpRecord->otp != $this->reg_otp) {
            $this->addError('reg_otp', 'Invalid or expired OTP.');
            return;
        }

        // Mark OTP as verified
        DB::table('otps')->where('id', $otpRecord->id)->update(['is_verified' => true]);

        // Save Registration Request to member_requests table
        MemberRequest::create([
            'member_id' => null, // Null because not a member yet
            'type' => 'new_registration',
            'status' => 'pending',
            'data' => [
                'name' => $this->reg_name,
                'mobile' => $this->reg_mobile,
                'email' => $this->reg_email,
            ],
        ]);

        $this->reg_verified = true;
    }

    // ✅ Send Forgot Password OTP Method
    public function sendForgotOtp()
    {
        $this->validate(['fp_identifier' => 'required|string']);

        $isEmail = filter_var($this->fp_identifier, FILTER_VALIDATE_EMAIL);
        $user = $isEmail 
            ? \App\Models\User::where('email', $this->fp_identifier)->first() 
            : \App\Models\User::where('phone', $this->fp_identifier)->first();

        if (!$user) {
            $this->addError('fp_identifier', 'No account found with this mobile or email.');
            return;
        }

        $otp = rand(1000, 9999);

        DB::table('otps')->updateOrInsert(
            ['identifier' => $this->fp_identifier, 'type' => 'password_reset'],
            [
                'otp' => $otp,
                'is_verified' => false,
                'expires_at' => now()->addMinutes(5),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // TODO: Send SMS to mobile or Email
        session()->flash('message', "OTP sent successfully! (Test OTP: $otp)");
        $this->fp_otp_sent = true;
    }

    // ✅ Verify Forgot OTP Method
    public function verifyForgotOtp()
    {
        $this->validate(['fp_otp' => 'required|digits:4']);

        $otpRecord = DB::table('otps')
            ->where('identifier', $this->fp_identifier)
            ->where('type', 'password_reset')
            ->where('is_verified', false)
            ->where('expires_at', '>', now())
            ->first();

        if (!$otpRecord || $otpRecord->otp != $this->fp_otp) {
            $this->addError('fp_otp', 'Invalid or expired OTP.');
            return;
        }

        DB::table('otps')->where('id', $otpRecord->id)->update(['is_verified' => true]);
        $this->fp_verified = true;
    }

    // ✅ Reset Password Method
    public function resetPassword()
    {
        $this->validate([
            'fp_new_password' => 'required|min:6',
            'fp_confirm_password' => 'required|same:fp_new_password',
        ], [
            'fp_confirm_password.same' => 'Passwords do not match.',
        ]);

        $isEmail = filter_var($this->fp_identifier, FILTER_VALIDATE_EMAIL);
        $user = $isEmail 
            ? \App\Models\User::where('email', $this->fp_identifier)->first() 
            : \App\Models\User::where('phone', $this->fp_identifier)->first();

        if ($user) {
            $user->update(['password' => Hash::make($this->fp_new_password)]);
        }

        // Reset states and show success tab
        $this->reset(['fp_otp', 'fp_new_password', 'fp_confirm_password', 'fp_otp_sent', 'fp_verified']);
        $this->fp_identifier = 'success_reset'; // Triggering success state
    }

    public function authenticate()
    {
        $this->validate();

        // প্রতিবার রিসেট করবে
        $this->throttleSeconds = 0;

        $fieldType = is_numeric($this->login) ? 'phone' : 'username';

        $throttleKey = strtolower($this->login) . '|' . request()->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $this->throttleSeconds = $seconds;
            throw ValidationException::withMessages([
                'login' => "BLOCKED",
            ]);
        }

        if (!Auth::attempt([$fieldType => $this->login, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($throttleKey, 60);
            throw ValidationException::withMessages([
                'login' => 'This username / phone number or password is incorrect.',
            ]);
        }

        RateLimiter::clear($throttleKey);
        $this->throttleSeconds = 0;

        if (auth()->user()->isSuperAdmin() || auth()->user()->isAdmin()) {
            return redirect()->to('/dashboard');
        }

        return redirect()->to('/mobile-dashboard');
    }

    public function render()
    {
        $this->orgName = \App\Models\Setting::get('organization_name', '');
        $this->orgLogo = \App\Models\Setting::get('organization_logo', '');
        $this->orgLogoShape = \App\Models\Setting::get('organization_logo_shape', 'round');

        return view('livewire.auth.login');
    }
}