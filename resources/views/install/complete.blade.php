<x-install-layout :step="4">
    <div class="text-center py-4">
        
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <h2 class="text-lg font-bold text-green-700 mb-3">Installation Complete!</h2>
        
        <p class="text-gray-500 text-sm leading-relaxed mb-2">
            Your system has been installed successfully.
        </p>
        <p class="text-gray-500 text-sm leading-relaxed mb-8">
            You can now login with your Super Admin account.
        </p>

        <a href="{{ route('login') }}" 
           class="inline-block w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
            Go to Login Page
        </a>

    </div>
</x-install-layout>