<x-layouts.app>
    <x-slot:title>
        Halaman Login
    </x-slot:title>

    @if (session()->has('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                window.notyf.success("{{ session('success') }}");
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Looping karena $errors isinya array
                @foreach ($errors->all() as $error)
                    window.notyf.error("{{ $error }}");
                @endforeach
            });
        </script>
    @endif
<div class="bg-[#1E3F4D] flex items-center justify-center min-h-screen">

    <div class="relative bg-[#ced4da] p-10 rounded-lg shadow-xl w-full max-w-md border border-white/50">
        
        <div class="absolute -top-14 left-1/2 -translate-x-1/2">
            <div class="bg-[#061E29] p-3 rounded-full shadow-lg">
                <img src="{{ asset('logo_smekten.png') }}" 
                     alt="Logo" class="w-16 h-16 object-contain">
            </div>
        </div>

        <div class="mt-8 mb-8 text-center">
            <h2 class="text-xl font-bold text-gray-800 uppercase tracking-wider">User Login</h2>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div class="flex items-stretch shadow-sm">
                <span class="bg-white px-4 flex items-center border-r border-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2a5 5 0 1 0 0 10a5 5 0 1 0 0-10M4 22h16c.55 0 1-.45 1-1v-1c0-3.86-3.14-7-7-7h-4c-3.86 0-7 3.14-7 7v1c0 .55.45 1 1 1"/></svg>
                </span>
                <input type="text" name="username" placeholder="Username" required
                    class="w-full p-3 bg-[#dee2e6] text-gray-700 focus:outline-none focus:ring-2 focus:ring-slate-400 placeholder-gray-500">
            </div>

            <div class="flex items-stretch shadow-sm">
                <span class="bg-white px-4 flex items-center border-r border-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 17a2 2 0 0 1-2-2c0-1.11.89-2 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2m6 3V10H6v10zm0-12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10c0-1.11.89-2 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2zm-6-5a3 3 0 0 0-3 3v2h6V6a3 3 0 0 0-3-3"/></svg>
                </span>
                <input type="password" name="password" placeholder="Password" required
                    class="w-full p-3 bg-[#dee2e6] text-gray-700 focus:outline-none focus:ring-2 focus:ring-slate-400 placeholder-gray-500">
            </div>

            <div class="pt-4">
                <button type="submit" 
                    class="w-full cursor-pointer bg-[#061E29] hover:bg-[#112833] text-white font-semibold py-3 transition duration-200 shadow-md">
                    Login
                </button>
            </div>

        </form>
    </div>
</div>
    {{-- <div class="min-h-screen flex items-center justify-center bg-[#1E3F4D]">
        <div class="w-full bg-[#FFFEFE] opacity-70 p-12 max-w-lg rounded-2xl shadow-xl z-1">
            <div class="opacity-100">
                <form action="{{ route('login') }}" method="POST" class="w-full opacity-100">
                    @csrf
                    <div class="flex justify-center">
                        <img src="{{ asset('logo_smekten.png') }}" alt="" class="w-22 mb-4 mx-auto">
                    </div>
                    <h1 class="text-3xl text-black font-bold text-center mb-8">Login Page</h1>
                    <label for="" class="block font-semibold mb-1 text-2xl">
                        Username
                        <br>
                        <input type="text" name="username" required class="border rounded w-full mt-3 font-light p-1">
                    </label>
                    <label for="" class="block font-semibold mb-1 text-2xl w-full">
                        Password
                    <input type="password" name="password" required class="border rounded w-full mt-3 font-light p-1">
                    </label>

                    <button type="submit" class="px-4 py-2 w-full bg-[#3B82F6] text-white rounded-sm mt-5 font-bold text-xl">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div> --}}
</x-layouts.app>