<x-layouts.app>
    <x-slot:title>
        Buat Permintaan
    </x-slot:title>
    <x-sidebar.waka />
    <div class="bg-white shadow-xl">
        <h1 class="text-black ml-67 text-2xl font-bold">WAKA</h1>
    </div>

    {{-- Alert Error (Opsional, untuk menangani Exception) --}}
    @if (session('error'))
        <div id="alert-error" class="flex items-center p-4 mb-6 text-red-800 border-t-4 border-red-300 bg-red-50 shadow-md rounded-lg" role="alert">
            <svg class="flex-shrink-0 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <div class="ml-3 text-sm font-medium">
                {{ session('error') }}
            </div>
            <button type="button" onclick="document.getElementById('alert-error').remove()" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
            </button>
        </div>
    @endif

    <div class="flex mt-10">
        <div class="bg-white hover:bg-gray-200 rounded-full w-15 ml-77 h-15 shadow-lg">
            <a href="{{ route('waka.request.view') }}"
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
    </div>
    <div class="bg-white shadow-xl items-center justify-center rounded-xl h-160 w-370 mt-10 ml-87 p-12">
        <h1 class="text-4xl font-semibold mb-4">Buat Permintaan</h1>
        <div class=" w-full border border-gray-300 mb-15"></div>
        <form action="{{ route('waka.request.store') }}" method="POST"enctype="multipart/form-data">
          @csrf
            <div class="flex flex-row gap-40">
                <div class="flex flex-col">
                    <label for="" class="text-[#7E95DB] mb-2 text-xl">Perihal</label>
                    <input type="text" name="subject" class="rounded border w-150 h-10 p-2 mb-2">

                    <label class="text-[#7E95DB] mb-2 text-xl">Draf Utama</label>
                    <div class="flex flex-row gap-4">
                        {{-- Hubungkan label FOR dengan ID input --}}
                        <label for="draft_file" class="w-full">
                            <div class="relative border border-black border-dashed rounded-lg w-full h-20 flex items-center justify-center bg-white hover:bg-gray-50 cursor-pointer transition">
                                <input accept=".pdf,.doc,.docx" type="file" name="draft_file" id="draft_file" class="hidden" onchange="updateFileName(this, 'draft-name')">
                                
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#4285F4]" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
                                    </svg>
                                    <span id="draft-name" class="text-sm text-gray-500 mt-1">Pilih file...</span>
                                </div>
                            </div>
                        </label>
                    </div>
                    
                    <label class="text-[#7E95DB] mb-2 text-xl mt-4 block">Lampiran</label>
                    <div class="flex flex-row gap-4">
                        {{-- Tambahkan Label FOR agar area ini bisa diklik --}}
                        <label for="attachments" class="w-full">
                            <div class="relative border border-black rounded-lg w-full h-20 flex items-center justify-center bg-white hover:bg-gray-50 cursor-pointer transition">
                                <input accept=".pdf,.doc,.docx" type="file" name="attachments[]" id="attachments" class="hidden" onchange="updateFileName(this, 'attachments-name')">
                                
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#4285F4]" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
                                    </svg>
                                    <span id="attachments-name" class="text-sm text-gray-500 mt-1">Pilih file...</span>
                                </div>
                            </div>
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
                    <label for="" class="text-[#7E95DB] mb-2 text-xl">Deskripsi</label>
                    <textarea name="description" id="" cols="30" rows="10" class="border w-150 rounded p-2 resize-none"></textarea>
                    <div class="ml-auto">
                        <button
                            class="bg-[#28A745] px-6 py-2 text-white text-lg rounded-lg cursor-pointer mt-5">Kirim</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-layouts.app>
