<x-layouts.app>
    <x-slot:title>
        Edit Kode
    </x-slot:title>
    <x-sidebar.tu />
        <div class="bg-white shadow-xl">
        @if (auth()->user()->role === App\Enums\UserRole::KEPALA_TU)
            <h1 class="text-black ml-67 text-2xl font-bold">Kepala Tata Usaha</h1>
        @elseif (auth()->user()->role === App\Enums\UserRole::TU)
            <h1 class="text-black ml-67 text-2xl font-bold">Tata Usaha</h1>
        @endif
    </div>
        <div class="ml-77 mt-10 pr-10" x-data="{ note: '' }"> 
        <div class="bg-white hover:bg-gray-200 rounded-full w-15 h-15 shadow-lg flex items-center justify-center mb-6">
            <a href="{{ route('classifications.index') }}" class="flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                    <path fill="black" d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6l6 6l1.41-1.41z"/>
                </svg>
            </a>
        </div>

        <form action="#" method="POST" class="bg-white rounded-md shadow-xl p-12 w-150 ml-20">
            @csrf
            <h1 class="text-4xl font-semibold mb-4">Buat Kode</h1>
            <div class="w-full border border-gray-300 mb-8"></div>

            <div class="space-y-6">
                <div class="flex flex-col gap-2">
                    <label class="text-2xl text-[#7E95DB]">Referensi Kode</label>
                    <input type="text" class="rounded-md border border-gray-400 w-full h-12 px-4 text-lg">
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-2xl text-[#7E95DB]">Kode Surat Baru</label>
                    <input type="text" class="rounded-md border border-gray-400 w-full h-12 px-4 text-lg">
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-2xl text-[#7E95DB]">Nama Kode</label>
                    <input type="text" class="rounded-md border border-gray-400 w-full h-12 px-4 text-lg">
                </div>
            </div>

            <div class="flex justify-center w-full gap-4 mt-10 ">
                <button type="submit" class="cursor-not-allowed bg-[#484848] hover:bg-[#838383] text-white text-xl rounded-md px-8 p-2"
                    class="px-8 py-3 text-white text-xl rounded-lg transition font-semibold">
                    Batal
                </button>
                
                <button type="submit" 
                    class="cursor-not-allowed bg-[#28A745] hover:bg-[#218838] text-white text-xl rounded-md px-8 p-2"
                    class="px-8 py-3 text-white text-xl rounded-lg transition font-semibold">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>