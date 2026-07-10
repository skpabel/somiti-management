<x-install-layout :step="0">
    <div class="text-center py-4">
        
        <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
        </div>

        <h2 class="text-lg font-bold text-green-800 mb-3">Welcome!</h2>
        
        <p class="text-gray-500 text-sm leading-relaxed mb-2">
            This wizard will guide you through the setup process.
        </p>
        <p class="text-gray-500 text-sm leading-relaxed mb-8">
            You will need to configure your database and create a Super Admin account.
        </p>

        <a href="{{ route('install.database') }}" 
           class="inline-block w-full bg-green-700 hover:bg-green-800 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
            Start Installation
        </a>

    </div>
</x-install-layout>