<x-guest-layout>
    <div class="h-screen w-screen grid place-content-center">
        <div class="w-[400px] max-w-md border flex flex-col space-y-2 md:space-y-4">
            <h1 class="p-2 text-center text-2xl font-bold">NICL Dashboard</h1>
            <div class="flex justify-between p-2 md:p-4">
                @guest
                    <a href="{{route('login')}}" class="bg-green-500 p-2 text-white rounded-md">Login</a>
                    @if($users->isEmpty())
                        <a href="{{route('admin.once')}}" class="bg-red-500 p-2 text-white rounded-md">Create Admin</a>
                    @endif
                @endguest
                @auth
                    <a href="{{route('admin.dashboard')}}" class="bg-green-500 p-2 text-white rounded-md">Dashboard</a>
                @endauth
            </div>
        </div>
    </div>
</x-guest-layout>
