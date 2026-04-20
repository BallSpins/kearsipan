<x-layouts.app>
    <x-slot:title>
        Detail Permintaan Surat
    </x-slot:title>
    <x-sidebar.tu />

    {{-- <div class="bg-white shadow-xl">
        @if (auth()->user()->role === App\Enums\UserRole::KEPALA_TU)
            <h1 class="text-black ml-67 text-2xl font-bold">Kepala Tata Usaha</h1>
        @elseif (auth()->user()->role === App\Enums\UserRole::TU)
            <h1 class="text-black ml-67 text-2xl font-bold">Tata Usaha</h1>
        @endif
    </div> --}}

    <div class="flex flex-row justify-between">
        <div class="flex mt-10">
            <div class="bg-white hover:bg-gray-200 rounded-xl w-40 ml-77 h-15 shadow-lg">
                <a href="{{ route('tu.request.list.view') }}"
                    class="text-center items-center justify-center flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" viewBox="0 0 24 24"><path fill="currentColor" d="M12 9.059V6.5a1.001 1.001 0 0 0-1.707-.708L4 12l6.293 6.207a.997.997 0 0 0 1.414 0A1 1 0 0 0 12 17.5v-2.489c2.75.068 5.755.566 8 3.989v-1c0-4.633-3.5-8.443-8-8.941"/></svg>
                    <h1 class="text-xl font-bold">KEMBALI</h1>
                </a>
            </div>
        </div>
        <div class="flex justify-end">
            <a 
                @if ($request->letter) 
                    {{-- Jika letter sudah ada, hilangkan href dan tambah class disabled --}}
                    class="mr-20 py-2 px-6 bg-gray-400 text-white rounded-sm mt-5 flex items-center gap-2 cursor-not-allowed opacity-50"
                @else 
                    href="{{ route('tu.request.create.outgoing.view', $request->id) }}"
                    target="_blank" 
                    class="mr-20 h-15 px-6 bg-[#061E29] hover:bg-white/5 text-white rounded-sm mt-10 flex items-center gap-2"
                @endif
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M13 6a1 1 0 1 0-2 0v5H6a1 1 0 1 0 0 2h5v5a1 1 0 1 0 2 0v-5h5a1 1 0 1 0 0-2h-5z" />
                </svg>
                <span class="text-2xl font-semibold">Buat Surat</span>
            </a>
        </div>
    </div>
    <div class="bg-[#29627C] shadow-2xl rounded-xl w-350 ml-auto mr-20 mt-8 p-10">
        <h1 class="text-white text-3xl font-bold mb-4 font-lora">Detail Permintaan</h1>
        <div class="w-full border-t border-white/50 mb-8"></div>

        <form class="space-y-6">
            <div class="flex flex-col">
                <div class="flex items-center gap-3">
                    <div class="w-180 items-center bg-white rounded-md overflow-hidden h-12">
                        <div class="h-full px-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#3B82F6]" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
                            </svg>
                        </div>
                        <span class="px-4 text-black font-medium">Buka lampiran</span>
                    </div>


                    @php $hasFile = !empty($request->attachments->first()->file_path); @endphp
                    <a href="{{ $hasFile ? route('download.outgoing.attachment', $request->attachments->first()->id) : '#' }}" 
                       class="h-12 w-12 flex items-center justify-center rounded-md transition shadow-md
                       {{ $hasFile ? 'bg-[#4CAF50] hover:bg-green-600 text-white' : 'bg-gray-400 cursor-not-allowed opacity-50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="flex flex-col">
                <label class="text-white text-lg font-medium mb-1">Tanggal</label>
                <div class="relative flex items-center">
                    <input type="text" disabled value="{{ $request->created_at->format('d/m/Y') }}" 
                           class="w-180 h-12 px-4 rounded-md bg-white text-black focus:outline-none">
                    <div class=" text-[#4285F4]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2m0 16H5V10h14zm0-12H5V6h14zm-7 5h5v5h-5z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex flex-col">
                <label class="text-white text-lg font-medium mb-1">Alamat Tujuan</label>
                <input type="text" disabled value="{{ $request->destination ?? 'Wali Murid' }}" 
                       class="w-200 h-12 px-4 rounded-md bg-white text-black">
            </div>

            <div class="flex flex-col">
                <label class="text-white text-lg font-medium mb-1">Jenis Surat</label>
                <input type="text" disabled value="{{ $request->letter_type ?? 'Surat Undangan' }}" 
                       class="w-200 h-12 px-4 rounded-md bg-white text-black">
            </div>

            <div class="flex flex-col">
                <label class="text-white text-lg font-medium mb-1">Perihal</label>
                <textarea disabled rows="4" 
                          class="w-200 p-4 rounded-md bg-white text-black resize-none shadow-inner">{{ $request->description }}</textarea>
            </div>
        </form>
    </div>
</x-layouts.app>

