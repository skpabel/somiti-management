<x-install-layout :step="1">
    <h2 class="text-lg font-bold text-green-800 mb-1">Database Configuration</h2>
    <p class="text-gray-500 text-sm mb-5">Enter your database server details</p>

    <form action="{{ route('install.save.database') }}" method="POST">
        @csrf

        <div class="space-y-4">
            
            <div>
                <label class="block text-sm font-medium text-green-800 mb-1">Database Host</label>
                <input type="text" name="db_host" value="localhost" required
                       class="w-full px-3 py-2.5 border border-green-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-green-800 mb-1">Port</label>
                <input type="text" name="db_port" value="3306" required
                       class="w-full px-3 py-2.5 border border-green-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-green-800 mb-1">Database Name</label>
                <input type="text" name="db_name" required placeholder="e.g: somiti_db"
                       class="w-full px-3 py-2.5 border border-green-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-green-800 mb-1">Username</label>
                <input type="text" name="db_username" required placeholder="e.g: root"
                       class="w-full px-3 py-2.5 border border-green-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-green-800 mb-1">Password</label>
                <input type="password" name="db_password"
                       class="w-full px-3 py-2.5 border border-green-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>

        </div>

        <button type="submit" class="w-full mt-6 bg-green-700 hover:bg-green-800 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
            Test Connection & Continue
        </button>
    </form>
</x-install-layout>