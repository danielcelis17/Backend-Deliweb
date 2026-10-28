@props(['breadcrumbs' => []])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/bb685615ea.js" crossorigin="anonymous"></script>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-50"
        x-data="{ sidebarOpen: false }"
        :class="{ 'overflow-hidden': sidebarOpen }">

        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 sm:hidden"
            style="display: none;"
            x-show="sidebarOpen"
            x-on:click="sidebarOpen = false">
        </div>

        @include('layouts.partials.admin.navigation')

        @include('layouts.partials.admin.sidebar')

        <div class="mt-14">

        <div class="p-4 sm:ml-64">

            <div class="flex justify-between items-center">
                @include('layouts.partials.admin.breadcrumb')

                @isset($action)

                    <div>
                        {{ $action }}
                    </div>

                @endisset
            </div>

            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg">
                {{ $slot }}
                </div>

            </div>
        </div>

        @stack('modals')

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        @livewireScripts

        @stack('js')

        @if (session('swal'))
        <script>
            Swal.fire({{ session('swal') }});
        </script>

        @endif

    </body>
</html>
