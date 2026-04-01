<x-layouts.app>
    <x-slot:title>
        Halaman Login
    </x-slot:title>

    {{-- <div class="w-full h-screen flex flex-col justify-center items-center bg-gray-200">
        <div class="w-64 h-64 text-center">Gambar</div>
        <div class="flex flex-col w-64 h-64 bg-white">
            <form action="" class="flex flex-col px-6 py-4">
                <h1 class="text-xl text-center font-bold">Login Page</h1>
            </form>
        </div>
    </div> --}}
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label for="">
            username
            <input type="text" name="username" required>
        </label>
        <label for="">
            password
            <input type="password" name="password" required>
        </label>

        <button type="submit">Login</button>
    </form>
</x-layouts.app>