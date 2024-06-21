@use(Illuminate\Support\Facades\Auth)
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        @vite('resources/js/app.js')
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <h1 id="message">
        123456
    </h1>
    </body>
    <script type="module">
        const id = "{{ Auth::id() }}"
        const hTag = document.getElementById('message');
        console.log(id)
        Echo.private(`user.${id}`)
            .listen('.users.test', (e) => {
                console.log('caught')
                console.log(e.user);
                hTag.innerText = e.message
            })
            .error((error) => {
                console.error('Echo error:', error); // Check for any Echo-specific errors
            });
        console.log('end')
    </script>
</html>
