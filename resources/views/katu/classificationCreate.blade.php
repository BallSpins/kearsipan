<x-layouts.app>
    <x-slot:title>
        Buat Kode
    </x-slot:title>
    <x-sidebar.tu />

    {{-- <div class="bg-white shadow-xl">
        @if (auth()->user()->role === App\Enums\UserRole::KEPALA_TU)
            <h1 class="text-black ml-67 text-2xl font-bold">Kepala Tata Usaha</h1>
        @elseif (auth()->user()->role === App\Enums\UserRole::TU)
            <h1 class="text-black ml-67 text-2xl font-bold">Tata Usaha</h1>
        @endif
    </div> --}}

    <div class="ml-77 mt-10 pr-10" x-data="{ note: '' }"> 
        <div class="bg-white hover:bg-gray-200 rounded-xl w-40 h-15 shadow-lg flex items-center justify-center mb-6">
            <a href="{{ route('classifications.index') }}" 
             class="text-center items-center justify-center flex">
                <svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M12 9.059V6.5a1.001 1.001 0 0 0-1.707-.708L4 12l6.293 6.207a.997.997 0 0 0 1.414 0A1 1 0 0 0 12 17.5v-2.489c2.75.068 5.755.566 8 3.989v-1c0-4.633-3.5-8.443-8-8.941" />
                </svg>
                <h1 class="text-xl font-bold">KEMBALI</h1>
            </a>
        </div>

        <form action="{{ route('classifications.store') }}" method="POST" class="bg-[#29627C] rounded-md shadow-xl p-12 w-150 ml-20">
            @csrf
            <h1 class="text-white text-4xl font-semibold mb-4">Buat Kode</h1>
            <div class="w-full border border-gray-300 mb-8"></div>

            <div class="space-y-6">
                <div class="flex flex-col gap-2">
                    <label class="text-2xl text-white">Referensi Kode</label>
                    <select name="parent_code" id="classification_select" class="rounded-md bg-white w-full h-12 px-4 text-lg">
                        <option value="" disabled selected>Pilih Kode Surat</option>
                        @foreach ($classifications as $classification)
                            <option value="{{ $classification->code }}">
                                {{ $classification->code }} - {{ Str::limit($classification->name, 50) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-2xl text-white">Kode Surat Baru</label>
                    <input type="text" id="new_code_input" name="code" class="rounded-md bg-white w-full h-12 px-4 text-lg">
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const selectElement = document.getElementById('classification_select');
                        const inputElement = document.getElementById('new_code_input');
                    
                        selectElement.addEventListener('change', function() {
                            // Ambil value dari option yang dipilih
                            const selectedCode = this.value;

                            // Masukkan ke input "Kode Surat Baru"
                            inputElement.value = selectedCode;
                        });
                    });
                </script>

                <div class="flex flex-col gap-2">
                    <label class="text-2xl text-white">Nama Kode</label>
                    <input type="text" name="name" class="rounded-md bg-white w-full h-12 px-4 text-lg">
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