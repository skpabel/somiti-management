<div class="min-h-screen flex items-center justify-center bg-green-50 p-4 sm:p-6" 
     x-data="{ 
         pass: '', 
         savedLogin: localStorage.getItem('saved_login') || '', 
         savePass: localStorage.getItem('save_pass') === 'true',
         countdown: {{ $throttleSeconds }},
         cdInterval: null,
         activeTab: 'login'
     }" 
     x-init="
         if (savePass && savedLogin) {
             $wire.set('login', savedLogin);
         }
         $watch('$wire.login', function(val) {
             if (savePass) {
                 localStorage.setItem('saved_login', val);
             }
         });
         $watch('$wire.throttleSeconds', function(val) {
             if (val > 0) {
                 countdown = val;
                 if (cdInterval) clearInterval(cdInterval);
                 cdInterval = setInterval(() => {
                     countdown--;
                     if (countdown <= 0) {
                         clearInterval(cdInterval);
                         cdInterval = null;
                     }
                 }, 1000);
             }
         });
         if (countdown > 0 && !cdInterval) {
             cdInterval = setInterval(() => {
                 countdown--;
                 if (countdown <= 0) {
                     clearInterval(cdInterval);
                     cdInterval = null;
                 }
             }, 1000);
         }
     ">
    
    <!-- Main Card -->
    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl border-2 border-green-600 overflow-hidden">
        
        <!-- ===== উপরের ভাগ ===== -->
        <div class="bg-white p-5 pb-3">
            
            <div class="flex justify-center mb-3">
                @if($orgLogo)
                    @if($orgLogoShape === 'round')
                        <div class="h-[100px] w-[100px] rounded-full border-2 border-green-600 overflow-hidden">
                            <img src="{{ asset('storage/' . $orgLogo) }}" alt="Logo" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="h-[100px] w-[187.5px] overflow-hidden">
                            <img src="{{ asset('storage/' . $orgLogo) }}" alt="Logo" class="w-full h-full object-contain">
                        </div>
                    @endif
                @else
                    @if($orgLogoShape === 'round')
                        <div class="h-[100px] w-[100px] rounded-full border-2 border-green-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-14 h-14 text-green-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                            </svg>
                        </div>
                    @else
                        <div class="h-[100px] w-[187.5px] flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-10 text-green-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                            </svg>
                        </div>
                    @endif
                @endif
            </div>
            
            <div class="text-center">
                <h2 class="text-xl font-bold text-green-600">
                    {{ $orgName ?: 'Member Login' }}
                </h2>
            </div>
     
        </div>

        <!-- ===== নিচের ভাগ ===== -->
        <div class="bg-green-50 p-5 pt-4 border-t-2 border-green-600 rounded-t-3xl">
            
            <!-- ===== Login Form ===== -->
            <div x-show="activeTab === 'login'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <form @submit.prevent="if(countdown > 0) return; $wire.set('password', pass).then(function() { $wire.set('remember', savePass); $wire.authenticate(); })" class="space-y-2">
                
                <h3 class="text-center text-lg font-bold text-green-700 mb-1">👤 Member Login</h3>

                <!-- Username / Mobile Number Field -->
                <div>
                    <label class="label">
                        <span class="label-text text-gray-700 font-medium">Username / Mobile Number</span>
                    </label>
                    <label class="input input-bordered input-success flex items-center gap-2 bg-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                        <input type="text" wire:model="login" placeholder="Username / Phone" class="grow text-gray-800" required />
                    </label>
                    @error('login')
                        <div x-show="countdown > 0 && '{{ $message }}' === 'BLOCKED'" class="flex flex-col gap-1">
                            <span class="text-red-500 text-xs text-center">Too many failed attempts. Please wait or.
                                <button type="button" @click.prevent.stop="activeTab = 'forgot_password'" class="text-xs text-green-600 hover:text-green-800 hover:underline font-medium bg-transparent border-0 p-0 cursor-pointer">→ Reset Password</button>
                            </span>
                        </div>
                        <span x-show="countdown <= 0 || '{{ $message }}' !== 'BLOCKED'" class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label class="label">
                        <span class="label-text text-gray-700 font-medium">Password</span>
                    </label>
                    <label class="input input-bordered input-success flex items-center gap-2 bg-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                        <input type="password" x-model="pass" wire:ignore placeholder="Password" class="grow text-gray-800" required />
                    </label>
                    @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Save Password & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" 
                               :checked="savePass" 
                               @change="savePass = !savePass; localStorage.setItem('save_pass', savePass); if(!savePass) localStorage.removeItem('saved_login')"
                               class="checkbox checkbox-sm checkbox-success border-gray-300">
                        <span class="text-sm text-gray-600 group-hover:text-gray-800 transition-colors">Save Password</span>
                    </label>
                    <button type="button" @click.stop="activeTab = 'forgot_password'" class="text-sm text-green-600 hover:text-green-800 transition-colors font-medium hover:underline">
                        Forgot Password?
                    </button>
                </div>

                <!-- Login Account Button -->
                <div class="flex justify-center pt-2">
                    <button type="submit" 
                            :disabled="countdown > 0"
                            :class="countdown > 0 ? 'bg-gray-400 cursor-not-allowed opacity-60' : 'bg-green-600 hover:bg-green-700'"
                            class="w-3/4 py-3 rounded-xl text-white font-bold text-sm tracking-wide border-none shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
                        <span x-show="countdown <= 0">Login Account</span>
                        <span x-show="countdown > 0" x-text="'Please wait ' + countdown + 's'"></span>
                    </button>
                </div>

                <!-- Register Now Link -->
                <p class="text-center text-sm text-gray-600 mt-4">
                    Don't have an account? 
                    <button type="button" @click="activeTab = 'register'" class="text-green-600 hover:text-green-800 font-bold hover:underline">Register now</button>
                </p>

                <!-- সবুজ মার্জিন -->
                <div class="h-[2px] bg-gradient-to-r from-transparent via-green-600 to-transparent rounded-full mt-6"></div>

            </form>
            </div>
            <!-- End Login Form -->

            <!-- ===== Register Form ===== -->
            <div x-show="activeTab === 'register'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <!-- State 1: Info & Send OTP -->
                <div x-show="!$wire.reg_otp_sent && !$wire.reg_verified">
                    <h3 class="text-center text-lg font-bold text-green-700 mb-4 flex items-center justify-center gap-2">
                        Member Registration
                    </h3>
                    <form wire:submit.prevent="sendRegistrationOtp" class="space-y-2">
                        <div>
                            <label class="label"><span class="label-text text-gray-700 font-medium">Full Name</span></label>
                            <label class="input input-bordered input-success flex items-center gap-2 bg-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                                <input type="text" wire:model="reg_name" placeholder="Enter your full name" class="grow text-gray-800" required />
                            </label>
                            @error('reg_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="label"><span class="label-text text-gray-700 font-medium">Mobile Number</span></label>
                            <div class="flex gap-2">
                                <label class="input input-bordered input-success flex items-center gap-2 bg-white flex-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" /></svg>
                                    <input type="text" wire:model="reg_mobile" placeholder="8801712345678" class="grow text-gray-800" required />
                                </label>
                            </div>
                            @error('reg_mobile') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="label"><span class="label-text text-gray-700 font-medium">Email Address</span></label>
                            <label class="input input-bordered input-success flex items-center gap-2 bg-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                                <input type="email" wire:model="reg_email" placeholder="example@gmail.com" class="grow text-gray-800" required />
                            </label>
                            @error('reg_email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-center pt-2">
                            <button type="submit" class="w-3/4 py-3 rounded-xl text-white font-bold text-sm tracking-wide border-none shadow-md bg-green-600 hover:bg-green-700 transition-all duration-300">
                                Send OTP
                            </button>
                        </div>
                    </form>
                </div>

                <!-- State 2: Enter OTP -->
                <div x-show="$wire.reg_otp_sent && !$wire.reg_verified" class="space-y-2 text-center">
                    <div class="bg-white p-4 rounded-xl border border-green-200">
                        <p class="text-sm text-gray-600 mb-3">An OTP has been sent to your mobile and email.</p>
                        <input type="text" wire:model="reg_otp" class="input input-bordered input-success w-full text-center text-2xl tracking-[1em] font-bold" placeholder="• • • •" maxlength="4" />
                        @error('reg_otp') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        
                        <button wire:click="verifyRegistrationOtp" wire:loading.attr="disabled" class="w-full mt-4 py-3 rounded-xl text-white font-bold text-sm tracking-wide border-none shadow-md bg-green-600 hover:bg-green-700 transition-all duration-300">
                            <span wire:loading.remove>Verify OTP</span>
                            <span wire:loading>Verifying...</span>
                        </button>
                    </div>
                    <button type="button" @click="$wire.set('reg_otp_sent', false)" class="text-sm text-gray-500 hover:text-green-600 underline">Change Info?</button>
                </div>

                <!-- State 3: Success Message -->
                <div x-show="$wire.reg_verified" class="text-center py-8 px-4">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-green-700 mb-2">Request Submitted!</h3>
                    <p class="text-sm text-gray-600 mb-4">Your registration request has been submitted successfully. Please wait for admin approval.</p>
                    <button type="button" @click="activeTab = 'login'" class="btn btn-sm bg-green-600 hover:bg-green-700 text-white border-none">Back to Login</button>
                </div>

                <!-- Back to Login Link -->
                <div x-show="!$wire.reg_verified" class="text-center mt-4">
                    <p class="text-sm text-gray-600">
                        Already have an account? 
                        <button type="button" @click="activeTab = 'login'" class="text-green-600 hover:text-green-800 font-bold hover:underline">Login here</button>
                    </p>
                </div>
            </div>
            <!-- End Register Form -->

            <!-- ===== Forgot Password Form ===== -->
            <div x-show="activeTab === 'forgot_password'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <!-- State 1: Enter Identifier & Send OTP -->
                <div x-show="!$wire.fp_otp_sent && !$wire.fp_verified">
                    <h3 class="text-center text-lg font-bold text-green-700 mb-4">Forgot Password</h3>
                    <form wire:submit.prevent="sendForgotOtp" class="space-y-2">
                        <div>
                            <label class="label"><span class="label-text text-gray-700 font-medium">Mobile Number or Email</span></label>
                            <label class="input input-bordered input-success flex items-center gap-2 bg-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                                <input type="text" wire:model="fp_identifier" placeholder="Enter mobile or email" class="grow text-gray-800" required />
                            </label>
                            @error('fp_identifier') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-center pt-2">
                            <button type="submit" class="w-3/4 py-3 rounded-xl text-white font-bold text-sm tracking-wide border-none shadow-md bg-green-600 hover:bg-green-700 transition-all duration-300">
                                Send OTP
                            </button>
                        </div>
                    </form>
                </div>

                <!-- State 2: Enter OTP -->
                <div x-show="$wire.fp_otp_sent && !$wire.fp_verified" class="space-y-2 text-center">
                    <div class="bg-white p-4 rounded-xl border border-green-200">
                        <p class="text-sm text-gray-600 mb-3">An OTP has been sent to your mobile/email.</p>
                        <input type="text" wire:model="fp_otp" class="input input-bordered input-success w-full text-center text-2xl tracking-[1em] font-bold" placeholder="• • • •" maxlength="4" />
                        @error('fp_otp') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        
                        <button wire:click="verifyForgotOtp" wire:loading.attr="disabled" class="w-full mt-4 py-3 rounded-xl text-white font-bold text-sm tracking-wide border-none shadow-md bg-green-600 hover:bg-green-700 transition-all duration-300">
                            <span wire:loading.remove>Verify OTP</span>
                            <span wire:loading>Verifying...</span>
                        </button>
                    </div>
                    <button type="button" @click="$wire.set('fp_otp_sent', false)" class="text-sm text-gray-500 hover:text-green-600 underline">Change Info?</button>
                </div>

                <!-- State 3: Enter New Password -->
                <div x-show="$wire.fp_verified" class="space-y-2">
                    <h3 class="text-center text-lg font-bold text-green-700">Set New Password</h3>
                    <form wire:submit.prevent="resetPassword" class="space-y-2">
                        <div>
                            <label class="label"><span class="label-text text-gray-700 font-medium">New Password</span></label>
                            <label class="input input-bordered input-success flex items-center gap-2 bg-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                                <input type="password" wire:model="fp_new_password" placeholder="Enter new password" class="grow text-gray-800" required />
                            </label>
                            @error('fp_new_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="label"><span class="label-text text-gray-700 font-medium">Confirm Password</span></label>
                            <label class="input input-bordered input-success flex items-center gap-2 bg-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                                <input type="password" wire:model="fp_confirm_password" placeholder="Confirm new password" class="grow text-gray-800" required />
                            </label>
                            @error('fp_confirm_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-center pt-2">
                            <button type="submit" class="w-3/4 py-3 rounded-xl text-white font-bold text-sm tracking-wide border-none shadow-md bg-green-600 hover:bg-green-700 transition-all duration-300">
                                Reset Password
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Back to Login Link -->
                <div x-show="!$wire.fp_verified" class="text-center mt-4">
                    <p class="text-sm text-gray-600">
                        Remembered your password? 
                        <button type="button" @click="activeTab = 'login'" class="text-green-600 hover:text-green-800 font-bold hover:underline">Login here</button>
                    </p>
                </div>

                <!-- State 4: Password Reset Success -->
                <div x-show="$wire.fp_identifier === 'success_reset'" class="text-center py-8 px-4">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-green-700 mb-2">Password Reset!</h3>
                    <p class="text-sm text-gray-600 mb-4">Your password has been reset successfully. Please login with your new password.</p>
                    <button type="button" @click="activeTab = 'login'" class="btn btn-sm bg-green-600 hover:bg-green-700 text-white border-none">Back to Login</button>
                </div>
            </div>
            <!-- End Forgot Password Form -->

            <!-- Footer Section -->
            <div class="text-center mt-2">
                <div class="flex justify-center mb-1">
                    @if($orgLogo)
                        @if($orgLogoShape === 'round')
                            <div class="h-10 w-10 rounded-full border border-green-600/30 overflow-hidden">
                                <img src="{{ asset('storage/' . $orgLogo) }}" alt="Logo" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="h-10 w-auto max-w-[60px] overflow-hidden">
                                <img src="{{ asset('storage/' . $orgLogo) }}" alt="Logo" class="w-full h-full object-contain">
                            </div>
                        @endif
                    @else
                        <div class="h-10 w-10 rounded-full border border-green-600/30 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                            </svg>
                        </div>
                    @endif
                </div>
                <p class="text-xs text-gray-600 font-semibold">@2026 {{ $orgName ?: 'Organization Name' }}</p>
                <p class="text-xs text-gray-400 mt-1">| All Rights Reserved |</p>
            </div>

        </div>
    </div>
</div>