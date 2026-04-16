<x-layouts.app>
    <x-slot:title>
        Edit Draf
    </x-slot:title>
    <x-sidebar.tu />
    <div class="bg-white shadow-xl">
        @if (auth()->user()->role === App\Enums\UserRole::KEPALA_TU)
            <h1 class="text-black ml-67 text-2xl font-bold">Kepala Tata Usaha</h1>
        @elseif (auth()->user()->role === App\Enums\UserRole::TU)
            <h1 class="text-black ml-67 text-2xl font-bold">Tata Usaha</h1>
        @endif
    </div>
    <div class="flex mt-10">
        <div class="bg-white hover:bg-gray-200 rounded-full w-15 ml-77 h-15 shadow-lg">
            <a href="{{ route('tu.incoming.view') }}"
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
        <a href="{{ route('templates.index') }}" target="_blank"
            class="bg-[#1D546D] hover:bg-[#5F9598] cursor-pointer ml-auto text-white rounded-sm flex items-center px-10 py-2 mr-20 ">
            <h1 class="font-semibold text-2xl">Template Surat</h1>
    </a>
    </div>
    <div class="bg-white shadow-xl items-center justify-center rounded-xl h-160 w-370 mt-10 ml-87 p-12">
        @if($letter->type === App\Enums\LetterType::INCOMING)
            <h1 class="text-4xl font-semibold mb-4">Edit Surat Masuk</h1>
        @else
            <h1 class="text-4xl font-semibold mb-4">Edit Surat Keluar</h1>
        @endif
        <div class=" w-full border border-gray-300 mb-15"></div>
        <form id="form-update" action="{{ route('tu.incoming.update', $letter->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-row gap-40">
                <div class="flex flex-col">
                    <label for="classification_code" class="text-[#7E95DB] mb-2 text-xl">Kode Klasifikasi</label>

                    <select 
                        name="classification_code" 
                        id="classification_code" 
                        class="rounded border w-150 h-10 p-2 mb-2 bg-white focus:outline-none focus:ring-2 focus:ring-[#7E95DB]"
                        required
                    >
                        <option value="" disabled selected>Pilih Klasifikasi</option>
                        @foreach ($classifications as $classification)
                            <option value="{{ $classification->code }}"
                                {{ $classification->code === $letter->classification_code ? 'selected' : '' }}>
                                {{ $classification->code }} - {{ Str::limit($classification->name, 50) }}
                            </option>
                        @endforeach
                    </select>
                    
                    <label for="" class="text-[#7E95DB] mb-2 text-xl">Alamat</label>
                    <input type="text" value="{{ $letter->address }}" name="address" class="rounded border w-150 h-10 p-2 mb-2">

                    <label class="text-[#7E95DB] mb-2 text-xl">Draf Utama</label>
                    <div class="flex flex-row gap-4">
                        {{-- Hubungkan label FOR dengan ID input --}}
                        @php
                            $hasFile = !empty($letter->file_path);
                        @endphp
                        <label for="file" class="w-full flex flex-row gap-4">
                            <div class="relative border border-black border-dashed rounded-lg w-full h-20 flex items-center justify-center bg-white hover:bg-gray-50 cursor-pointer transition">
                                <input accept=".pdf" type="file" name="file" id="file" class="hidden" onchange="updateFileName(this, 'draft-name')">
                                
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#4285F4]" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
                                    </svg>
                                    @if($hasFile)
                                        <span id="draft-name" class="text-sm text-gray-500 mt-1">{{ $letter->file_path }}</span>
                                    @else
                                        <span id="draft-name" class="text-sm text-gray-500 mt-1">Pilih file...</span>
                                    @endif
                                </div>
                            </div>

                            <a 
                            @if($hasFile)
                                href="{{ route('download.incoming', $letter->id) }}"
                            @else
                                href="javascript:void(0)" {{-- Path kosong/tidak ke mana-mana --}}
                            @endif
                            class="p-2 rounded-xl shadow-md flex items-center justify-center transition 
                            {{ $hasFile 
                               ? 'bg-[#28A745] hover:bg-[#218838] text-white' 
                               : 'bg-gray-400 text-gray-200 cursor-not-allowed opacity-50 pointer-events-none' }}"    
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </a>
                        </label>
                    </div>
                    
                    <label class="text-[#7E95DB] mb-2 text-xl mt-4 block">Lampiran</label>
                    <div class="flex flex-row gap-4">
                        {{-- Tambahkan Label FOR agar area ini bisa diklik --}}
                        <label for="attachments" class="w-full flex flex-row gap-4">
                            @php
                            $hasFile = !empty($letter->attachments->first()->file_path);
                            @endphp

                            <div class="relative border border-black rounded-lg w-full h-20 flex items-center justify-center bg-white hover:bg-gray-50 cursor-pointer transition">
                                <input accept=".pdf,.jpg,.jpeg,.png" type="file" name="attachments[]" id="attachments" class="hidden" onchange="updateFileName(this, 'attachments-name')">
                                
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#4285F4]" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
                                    </svg>
                                    @if($hasFile)
                                        <span id="attachments-name" class="text-sm text-gray-500 mt-1">{{ $letter->attachments->first()->file_path }}</span>
                                    @else
                                        <span id="attachments-name" class="text-sm text-gray-500 mt-1">Pilih file...</span>
                                    @endif
                                </div>
                            </div>

                            <a 
                            @endphp
                            @if($hasFile)
                                href="{{ route('download.incoming', $letter->attachments->first()->id) }}"
                            @else
                                href="javascript:void(0)" {{-- Path kosong/tidak ke mana-mana --}}
                            @endif
                            class="p-2 rounded-xl shadow-md flex items-center justify-center transition 
                            {{ $hasFile 
                               ? 'bg-[#28A745] hover:bg-[#218838] text-white' 
                               : 'bg-gray-400 text-gray-200 cursor-not-allowed opacity-50 pointer-events-none' }}"    
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </a>
                        </label>
                    </div>
                    
                    <script>
                        // Tambahkan parameter targetId supaya nama file tidak tertukar antara input 1 dan 2
                        function updateFileName(input, targetId) {
                            const fileName = input.files[0] ? input.files[0].name : 'Pilih file...';
                            document.getElementById(targetId).textContent = fileName;
                        }
                    </script>
                </div>

                <div class="flex flex-col">
                    <label for="" class="text-[#7E95DB] mb-2 text-xl">Nomor Surat</label>
                    <input type="text" value="{{ $letter->full_number ?? $letter->origin_number }}" name="origin_number" class="rounded border w-150 h-10 p-2 mb-2">

                    <label for="" class="text-[#7E95DB] mb-2 text-xl">Perihal</label>
                    <textarea name="subject" id="" cols="30" rows="10" class="border w-150 rounded p-2 resize-none">{{ $letter->subject }}</textarea>
                    <div class="ml-auto">
                        <button type="submit" form="form-kepsek"
                            class="bg-[#28A745] px-6 py-2 text-white text-lg rounded-lg cursor-pointer mt-5">Serahkan ke Kepsek</button>
                        <button type="submit" form="form-update"
                            class="bg-[#28A745] px-6 py-2 text-white text-lg rounded-lg cursor-pointer mt-5">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
        <form id="form-kepsek" action="{{ route('tu.incoming.give.kepsek', $letter->id) }}" method="POST">
                            @csrf
                        </form>
    </div>
</x-layouts.app>
