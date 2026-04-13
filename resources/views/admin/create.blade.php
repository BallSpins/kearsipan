<x-layouts.app>
  <x-slot:title> 
    Buat Akun
  </x-slot:title>
  
  <div class="w-full min-h-screen bg-gray-50">
    <div class="bg-white shadow-md w-full px-6 flex flex-row justify-between items-center">
      <img src="{{ asset('logo_smekten.png') }}" alt="Logo" class="w-16 h-16">
      <a href="{{ route('logout') }}" class="flex bg-[#FF0000] hover:bg-red-700 transition w-40 h-10 rounded justify-center items-center">
        <div class="flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="white" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h7v2H5v14h7v2zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z"/></svg>
          <span class="text-white font-medium">Logout</span>
        </div>
      </a>
    </div>

    <div class="max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      <div class="flex">
        <div class="bg-white hover:bg-gray-200 rounded-full w-15 h-15 shadow-lg">
            <a href="{{ route('users.index') }}"
                class="text-center rotate-90 items-center justify-center flex">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24">
                    <g fill="none" fill-rule="evenodd">
                        <path
                            d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                        <path fill="currentColor"
                            d="M13.06 16.06a1.5 1.5 0 0 1-2.12 0l-5.658-5.656a1.5 1.5 0 1 1 2.122-2.121L12 12.879l4.596-4.596a1.5 1.5 0 0 1 2.122 2.12l-5.657 5.658Z" />
                    </g>
                </svg>
            </a>
        </div>

        <form action="{{ route('users.store') }}" method="POST" class="bg-white px-6 py-10 flex flex-col shadow-xl rounded-lg overflow-hidden border border-gray-200">
            @csrf
            <h1 class="text-3xl mb-6 border-b border-gray-300 pb-4">Buat Akun</h1>

            <label for="" class="text-[#7E95DB] flex flex-col gap-2 text-xl">
                Nama
                <input type="text" name="name" class="rounded border border-black w-150 h-10 p-2 mb-2 text-black">
            </label>

            <label for="" class="text-[#7E95DB] flex flex-col gap-2 text-xl">
                Username
                <input type="text" name="username" class="rounded border border-black w-150 h-10 p-2 mb-2 text-black">
            </label>

            <label for="" class="text-[#7E95DB] flex flex-col gap-2 text-xl">
                Role
                <select name="role" id="role" class="rounded border border-black w-150 p-2 mb-2 bg-white text-black">
                    <option value="" disabled selected>Pilih Role</option>
                    @foreach (App\Enums\UserRole::cases() as $role)
                        <option value="{{ $role->value }}">{{ $role->value }}</option>
                    @endforeach
                </select>
            </label>

            <label for="" class="text-[#7E95DB] flex flex-col gap-2 text-xl">
                Password
                <input type="password" name="password" class="rounded border border-black w-150 h-10 p-2 mb-2 text-black">
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
    </div>
  </div>
</x-layouts.app>