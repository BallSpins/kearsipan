<x-layouts.app>
    <x-slot:title>
        Buat User
    </x-slot:title>
    <x-sidebar.tu />

    {{-- <div class="bg-white shadow-xl">
      <h1 class="text-black ml-67 text-2xl font-bold">Kepala Tata Usaha</h1>
    </div> --}}

    <div class="ml-77 mt-10 pr-10"> 
        <div class="bg-white hover:bg-gray-200 rounded-xl w-40 h-15 shadow-lg flex items-center justify-center mb-6">
            <a href="{{ route('users.index') }}" 
             class="text-center items-center justify-center flex">
                <svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M12 9.059V6.5a1.001 1.001 0 0 0-1.707-.708L4 12l6.293 6.207a.997.997 0 0 0 1.414 0A1 1 0 0 0 12 17.5v-2.489c2.75.068 5.755.566 8 3.989v-1c0-4.633-3.5-8.443-8-8.941" />
                </svg>
                <h1 class="text-xl font-bold">KEMBALI</h1>
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