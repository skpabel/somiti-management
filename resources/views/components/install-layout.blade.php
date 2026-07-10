<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation - Somiti Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gradient-to-br from-green-50 to-green-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden">
        
        <div class="bg-green-700 px-6 py-5 text-center">
            <h1 class="text-xl font-bold text-white">Somiti Management System</h1>
            <p class="text-green-200 text-sm mt-1">Installation Wizard</p>
        </div>

        <div class="px-6 pt-5">
            <div class="flex items-center justify-between mb-1">
                <span class="text-xs font-semibold {{ $step >= 1 ? 'text-green-800' : 'text-green-600' }}">Database</span>
                <span class="text-xs font-semibold {{ $step >= 2 ? 'text-green-800' : 'text-green-600' }}">Migration</span>
                <span class="text-xs font-semibold {{ $step >= 3 ? 'text-green-800' : 'text-green-600' }}">Admin</span>
                <span class="text-xs font-semibold {{ $step >= 4 ? 'text-green-800' : 'text-green-600' }}">Done</span>
            </div>
            <div class="w-full bg-green-100 rounded-full h-2">
                <div class="bg-green-700 h-2 rounded-full transition-all duration-500" style="width: {{ ($step / 4) * 100 }}%"></div>
            </div>
        </div>

        <div class="px-6 py-6">

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-5 text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{ $slot }}

        </div>
    </div>

</body>
</html>