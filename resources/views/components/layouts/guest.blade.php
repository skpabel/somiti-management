<!DOCTYPE html>
<html lang="bn" data-theme="light" class="{{ auth()->check() && auth()->user()->theme === 'dark' ? 'dark' : '' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>লগইন - সমিতি ম্যানেজমেন্ট</title>
    
    <!-- Poppins Font (Preconnect for fast loading) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @livewireStyles
        <!-- PWA Links -->
        <link rel="manifest" href="{{ asset('manifest.json') }}">
        <meta name="theme-color" content="#000000">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <meta name="apple-mobile-web-app-title" content="Somiti">
        
        <script>
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', function() {
                    navigator.serviceWorker.register('{{ asset('sw.js') }}');
                });
            }
        </script>
</head>
<body style="opacity: 0; transition: opacity 0.2s; position: relative; overflow-x: hidden;" class="min-h-screen font-poppins">
    
    {{ $slot }}

    <script>document.body.style.opacity = '1';</script>
    @livewireScripts
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('theme-updated', (data) => {
                const theme = data.theme ?? (Array.isArray(data) ? data[0]?.theme : null);
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            });
            
            Livewire.on('language-updated', (data) => {
                const language = data.language ?? (Array.isArray(data) ? data[0]?.language : null);
                console.log('Language updated to:', language);
                // Force page reload to see the language change immediately
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            });
        });
    </script>
</body>
</html>