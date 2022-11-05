<!DOCTYPE html>
<html :class="{ 'dark': dark }" x-data="data()"
      x-init="$watch('dark',persistDark)"
      lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla&display=swap" rel="stylesheet">
    <title>NICL Dashboard</title>
    @livewireStyles
    @vite('resources/css/app.css')
    <style>
        @font-face {
            font-family: 'kalpurush';
            src: url({{asset('storage/fonts/kalpurush.ttf')}}) format("truetype");
        }

        .bangla {
            font-family: 'kalpurush', serif;
        }
    </style>
</head>
<body>
<div
    class="flex h-screen bg-gray-50 dark:bg-gray-900"
    :class="{ 'overflow-hidden': isSideMenuOpen }"
>
    <!-- Desktop sidebar -->
    <x-side-bar/>
    <!-- Mobile sidebar -->
    <!-- Backdrop -->
    <div
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
    ></div>
    <x-mobile-side-bar/>
    <div class="flex flex-col flex-1 w-full">
        <x-header/>
        <main class="h-full overflow-y-auto pb-16 print:page-bg">
            {{$slot}}
        </main>
    </div>
    <div class="hidden h-screen w-screen fixed top-0 bottom-0 left-0 print:grid print:place-content-center">
        <div class="flex flex-col items-center justify-center -rotate-45">
            <img class="h-48 w-48 opacity-25" src="{{asset('images/nicl.svg')}}" alt="NICL">
            <h1 class="text-4xl opacity-25 font-bold">NICL Properties and Developers Limited</h1>
        </div>
    </div>
    <script>
        function data() {
            let dark = false
            let mode = localStorage.getItem('mode')
            if (mode) {
                dark = mode === 'dark' ? true : false;
            } else {
                localStorage.setItem('mode', 'light')
            }
            return {
                isSideMenuOpen: false,
                dark,
                isPagesMenuOpen: false,
                isNotificationsMenuOpen: false,
                isProfileMenuOpen: false,
                toggleNotificationsMenu: () => {
                    this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
                },
                toggleSideMenu() {
                    this.isSideMenuOpen = !this.isSideMenuOpen
                },
                closeSideMenu(){
                    this.isSideMenuOpen = false
                },
                togglePagesMenu() {
                    this.isPagesMenuOpen = !this.isPagesMenuOpen
                },
                toggleProfileMenu() {
                    this.isProfileMenuOpen = !this.isProfileMenuOpen
                },
                toggleTheme() {
                    this.dark = !this.dark
                }
            }
        }

        function persistDark(value) {
            if (value == true) {
                localStorage.setItem('mode', 'dark')
            } else {
                localStorage.setItem('mode', 'light')
            }
        }

        function printPage() {
            window.print()
        }
    </script>
</div>
@livewireScripts
@vite('resources/js/app.js')
@stack('scripts')
</body>
</html>
