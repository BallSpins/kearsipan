<x-layouts.app>
    <x-slot:title>
        Halaman Login
    </x-slot:title>
    <div class="min-h-screen flex items-center justify-center bg-[#E6ECFE]">
        <div class="w-full bg-white p-12 max-w-lg rounded-2xl shadow-xl">
            
            <form action="{{ route('login') }}" method="POST" class="w-full">
                @csrf
                <div class="flex justify-center">
                    <img src="{{ asset('logo_smekten.png') }}" alt="" class="w-22 mb-4 mx-auto">
                </div>
                <label for="" class="block font-semibold mb-1 text-2xl">
                    Username
                    <br>
                    <input type="text" name="username" required class="border rounded w-full mt-3 font-light p-1">
                </label>
                <label for="" class="block font-semibold mb-1 text-2xl w-full">
                    Password
                <input type="password" name="password" required class="border rounded w-full mt-3 font-light p-1">
                </label>
                
                <button type="submit" class="px-4 py-2 w-full bg-[#3B82F6] text-white rounded-sm mt-5">
                    Login
                </button>
            </form>
        </div>
    </div>
</x-layouts.app>