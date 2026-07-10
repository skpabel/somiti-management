<div>
    
    <!-- ===== Welcome Banner ===== -->
    <div class="relative overflow-hidden bg-gradient-to-br from-sky-500 via-blue-600 to-indigo-700 p-6 sm:p-8 rounded-t-2xl shadow-lg text-white">
        <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -mr-16 -mt-16 blur-2xl"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full -ml-12 -mb-12 blur-2xl"></div>
        
        <div class="relative z-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="bg-white/20 p-3 rounded-2xl backdrop-blur-sm border border-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                </div>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">স্বাগতম, {{ auth()->user()->name }}! 👋</h1>
                    <p class="text-sm text-blue-100 mt-1">আজকের সমিতির সামগ্রিক তথ্য নিচে দেওয়া হলো।</p>
                </div>
            </div>
            <div class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-medium py-2.5 px-5 rounded-xl shadow text-sm flex items-center justify-center gap-2 border border-white/30 transition-all">
                📅 {{ formatDate(now()) }}
            </div>
        </div>
    </div>

    <!-- ===== Body Section ===== -->
    <div class="bg-base-100 p-6 sm:p-8 rounded-b-2xl shadow-xl border border-t-0 border-base-300">
        
        <!-- ===== Dashboard Stat Cards ===== -->
                <div class="grid grid-cols-2 lg:grid-cols-7 gap-4 mb-8">
            <!-- Card 1: Total Members -->
            <div class="bg-gradient-to-br from-green-500/10 to-green-500/5 border border-green-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
                <div class="bg-green-100 p-3 rounded-full text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                </div>
                <div>
                    <p class="text-xs text-green-600 font-bold uppercase">Total Members</p>
                    <p class="text-xl font-extrabold text-green-700">{{ $totalMembers }}</p>
                </div>
            </div>

            <!-- Card 2: Monthly Collection -->
            <div class="bg-gradient-to-br from-blue-500/10 to-blue-500/5 border border-blue-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
                <div class="bg-blue-100 p-3 rounded-full text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>
                </div>
                <div>
                    <p class="text-xs text-blue-600 font-bold uppercase">Monthly Collection</p>
                    <p class="text-xl font-extrabold text-blue-700">৳{{ number_format($currentMonthCollection, 0) }}</p>
                </div>
            </div>

            <!-- Card 3: Monthly Due -->
            <div class="bg-gradient-to-br from-red-500/10 to-red-500/5 border border-red-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
                <div class="bg-red-100 p-3 rounded-full text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
                </div>
                <div>
                    <p class="text-xs text-red-600 font-bold uppercase">Monthly Due</p>
                    <p class="text-xl font-extrabold text-red-700">৳{{ number_format($currentMonthDue, 0) }}</p>
                </div>
            </div>

            <!-- Card 4: Monthly Expenses -->
            <div class="bg-gradient-to-br from-orange-500/10 to-orange-500/5 border border-orange-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
                <div class="bg-orange-100 p-3 rounded-full text-orange-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6L9 12.75l4.286-4.286a11.948 11.948 0 014.306 6.43l.776 2.898m0 0l3.182-5.511m-3.182 5.51l-5.511-3.181" /></svg>
                </div>
                <div>
                    <p class="text-xs text-orange-600 font-bold uppercase">Monthly Expenses</p>
                    <p class="text-xl font-extrabold text-orange-700">৳{{ number_format($currentMonthExpense, 0) }}</p>
                </div>
            </div>

            <!-- Card 5: Total Collection -->
            <div class="bg-gradient-to-br from-emerald-500/10 to-emerald-500/5 border border-emerald-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
                <div class="bg-emerald-100 p-3 rounded-full text-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" /></svg>
                </div>
                <div>
                    <p class="text-xs text-emerald-600 font-bold uppercase">Total Collection</p>
                    <p class="text-xl font-extrabold text-emerald-700">৳{{ number_format($totalCollection, 0) }}</p>
                </div>
            </div>

            <!-- Card 6: Total Due -->
            <div class="bg-gradient-to-br from-rose-500/10 to-rose-500/5 border border-rose-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
                <div class="bg-rose-100 p-3 rounded-full text-rose-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
                </div>
                <div>
                    <p class="text-xs text-rose-600 font-bold uppercase">Total Due</p>
                    <p class="text-xl font-extrabold text-rose-700">৳{{ number_format($totalDue, 0) }}</p>
                </div>
            </div>

            <!-- Card 7: Total Expenses -->
            <div class="bg-gradient-to-br from-slate-500/10 to-slate-500/5 border border-slate-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
                <div class="bg-slate-100 p-3 rounded-full text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <p class="text-xs text-slate-600 font-bold uppercase">Total Expenses</p>
                    <p class="text-xl font-extrabold text-slate-700">৳{{ number_format($totalExpenses, 0) }}</p>
                </div>
            </div>
        </div>

    <!-- ===== Recent Activity Section ===== -->
        <div class="border border-base-300 rounded-xl overflow-hidden">
        <div class="p-4 border-b border-base-300 flex justify-between items-center bg-sky-500/30">
            <h3 class="text-lg font-bold text-base-content/80 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                Recent Transactions
            </h3>
            <a href="{{ route('accounts.index') }}" class="text-sm text-sky-600 font-bold hover:underline flex items-center gap-1">View All <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg></a>
        </div>
        
        <!-- Table -->
        <div class="overflow-x-auto bg-white border border-gray-200 shadow-sm">
            <table class="table w-full text-sm">
                <thead>
                    <tr class="bg-sky-600 text-white uppercase text-xs">
                        <th class="py-3 px-3 text-left">Date</th>
                        <th class="py-3 px-3 text-left">User/Member</th>
                        <th class="py-3 px-3 text-left">Description</th>
                        <th class="py-3 px-3 text-right">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentTransactions as $item)
                    <tr class="border-b border-base-200 hover:bg-sky-500/20 transition-colors">
                        <td class="py-3 px-3 text-sm text-base-content/60">{{ formatDateTime($item['date']) }}</td>
                        <td class="py-3 px-3 text-sm font-medium text-base-content">{{ $item['name'] }}</td>
                        <td class="py-3 px-3 text-sm text-base-content/60">{{ $item['desc'] }}</td>
                        <td class="py-3 px-3 text-sm font-semibold text-right {{ $item['type'] == 'deposit' ? 'text-green-500' : 'text-red-500' }}">
                            {{ $item['type'] == 'deposit' ? '+' : '-' }} ৳ {{ number_format($item['amount'], 0) }}
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-8 text-base-content/40">No recent transactions found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>