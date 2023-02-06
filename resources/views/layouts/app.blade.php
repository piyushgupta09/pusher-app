<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Pusher App</title>

        {{-- Styles --}}
        @livewireStyles
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        @vite(['resources/css/app.css'])

    </head>
    <body>

        <div class="container align-items-center">
            <h1>Welcome to Task App</h1>
            <pre>{{ now() }}</pre>
            {{ $slot }}
        </div>
        
        {{-- Scripts --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        @vite(['resources/js/app.js'])
        @livewireScripts
        <script>
            window.addEventListener('livewire:load', () => {
                Echo.channel('task-push')
                .listen('TaskAdded', (e) => {
                    Livewire.emit('onTaskAdded', e.task);
                })
                .listen('TaskUpdated', () => {
                    Livewire.emit('onTaskUpdated');
                });
            });
        </script>

    </body>
</html>
