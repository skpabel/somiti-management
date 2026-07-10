<x-install-layout :step="3">
    <h2 class="text-lg font-bold text-green-800 mb-1">Create Super Admin Account</h2>
    <p class="text-gray-500 text-sm mb-5">This account will have full access to the system</p>

    <form action="{{ route('install.save.admin') }}" method="POST">
        @csrf

        <div class="space-y-4">
            
            <div>
                <label class="block text-sm font-medium text-green-800 mb-1">Full Name</label>
                <input type="text" name="name" required
                       class="w-full px-3 py-2.5 border border-green-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-green-800 mb-1">Username</label>
                <input type="text" name="username" required
                       class="w-full px-3 py-2.5 border border-green-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-green-800 mb-1">Password</label>
                <input type="password" name="password" required minlength="8"
                       class="w-full px-3 py-2.5 border border-green-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-green-800 mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" required minlength="8"
                       class="w-full px-3 py-2.5 border border-green-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>

        </div>

        <button type="submit" class="w-full mt-6 bg-green-700 hover:bg-green-800 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
            Create Super Admin
        </button>
    </form>
</x-install-layout>