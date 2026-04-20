<x-layouts.app>
    <x-slot:title>
        Buat User
    </x-slot:title>
    <x-sidebar.tu />

    {{-- <div class="bg-white shadow-xl">
      <h1 class="text-black ml-67 text-2xl font-bold">Kepala Tata Usaha</h1>
    </div> --}}

    <div class="ml-77 mt-10 pr-10"> 
        <div class="bg-white hover:bg-gray-200 rounded-full w-15 h-15 shadow-lg flex items-center justify-center mb-6">
            <a href="{{ route('users.index') }}" class="flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                    <path fill="black" d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6l6 6l1.41-1.41z"/>
                </svg>
            </a>
        </div>

        <form action="{{ route('users.store') }}" method="POST" class="bg-[#29627C] rounded-md shadow-xl p-12 w-150 ml-20">
            @csrf
            <h1 class="text-3xl mb-6 border-b border-gray-300 pb-4 text-white">Buat Akun</h1>

            <label for="" class="text-white flex flex-col gap-2 text-xl">
                Nama
                <input type="text" name="name" class="bg-white w-100 h-10 p-2 mb-2 text-black">
            </label>

            <label for="" class="text-white flex flex-col gap-2 text-xl">
                Username
                <input type="text" name="username" class="bg-white w-100 h-10 p-2 mb-2 text-black">
            </label>

            <label for="" class="text-white flex flex-col gap-2 text-xl">
                Role
                <select name="role" id="role" class="bg-white w-100 p-2 mb-2 text-black">
                    <option value="" disabled selected>Pilih Role</option>
                    @foreach (App\Enums\UserRole::cases() as $role)
                        <option value="{{ $role->value }}">{{ $role->value }}</option>
                    @endforeach
                </select>
            </label>

            <label for="" class="text-white flex flex-col gap-2 text-xl">
                Password
                <input type="password" name="password" class="bg-white w-100 h-10 p-2 mb-2 text-black">
            </label>

            <div class="mx-auto flex gap-4">
                <a href="{{ route('users.index') }}" class="bg-[#484848] px-10 py-2 text-white text-lg rounded-lg cursor-pointer mt-5">
                    Batal
                </a>
                <button type="submit" class="bg-[#28A745] px-10 py-2 text-white text-lg rounded-lg cursor-pointer mt-5">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>