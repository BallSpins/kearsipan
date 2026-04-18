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

    <div class="min-h-screen flex items-center justify-center bg-[#d1d1cf]">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('patterned-bg.jpg') }}" 
                 class="w-full h-full object-cover grayscale" 
                 alt="Background Industrial">   
        </div>
        <div class="w-full bg-white p-12 max-w-lg rounded-2xl shadow-xl z-1">
            
            <form action="{{ route('login') }}" method="POST" class="w-full">
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
</x-layouts.app>