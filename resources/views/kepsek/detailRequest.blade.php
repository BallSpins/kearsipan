<x-layouts.app>
    <x-slot:title>
        Detail Permintaan Persetujuan
    </x-slot:title>
    <x-sidebar.kepsek />

    {{-- <div class="bg-white shadow-xl">
        <h1 class="text-black ml-67 text-2xl font-bold">Kepala Sekolah</h1>
    </div> --}}
    <div class="flex mt-10">
        <div class="bg-white hover:bg-gray-200 rounded-full w-15 ml-77 h-15 shadow-lg">
            <a href="{{ route('kepsek.outgoing.sign.view') }}"
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

    <div class="flex items-center justify-center ml-77">
        <div class="bg-[#29627C] p-8 rounded-lg shadow-md w-300 h-180">
            <h2 class="text-2xl font-bold text-white mb-2">Detail Surat</h2>
            <hr class="mb-6 border-gray-300">

            <form action="{{ route('kepsek.outgoing.sign', $letter->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="flex gap-8 mb-6 items-center">

                <div class="flex flex-col">
                    {{-- Download File Utama --}}
                    <div class="flex flex-col gap-4">
                        <label for="" class="text-white mb-2 text-xl">Surat yang Disertakan</label>
    
                        <div class="flex flex-row gap-2">
                            <a 
                            @if ($letter->type === App\Enums\LetterType::OUTGOING)
                                href="{{ route('download.incoming', $letter->id) }}" {{-- Link download untuk surat keluar --}}
                            @else
                                href="{{ route('download.outgoing', $letter->id) }}" {{-- Link download --}}               
                            @endif
                                class="flex items-center gap-3 rounded-md bg-white hover:bg-gray-50 transition w-100 h-10 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24">
                                    <path fill="#3B82F6" fill-rule="evenodd"
                                        d="M14.25 2.5a.25.25 0 0 0-.25-.25H7A2.75 2.75 0 0 0 4.25 5v14A2.75 2.75 0 0 0 7 21.75h10A2.75 2.75 0 0 0 19.75 19V9.147a.25.25 0 0 0-.25-.25H15a.75.75 0 0 1-.75-.75zm.75 9.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1 0-1.5zm0 4a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1 0-1.5z"
                                        clip-rule="evenodd" />
                                    <path fill="#3B82F6"
                                        d="M15.75 2.824c0-.184.193-.301.336-.186q.182.147.323.342l3.013 4.197c.068.096-.006.22-.124.22H16a.25.25 0 0 1-.25-.25z" />
                                </svg>
        
                                Buka Surat
                            </a>
                            <a 
                            @if ($letter->type === App\Enums\LetterType::OUTGOING)
                                href="{{ route('download.incoming', $letter->id) }}" {{-- Link download untuk surat keluar --}}
                            @else
                                href="{{ route('download.outgoing', $letter->id) }}" {{-- Link download --}}               
                            @endif
                                class="bg-[#28A745] hover:bg-[#218838] text-white p-2 rounded-lg shadow-sm transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </a>
                        </div>
                    </div>
    
                    {{-- Download Lampiran --}}
                    <div class="flex flex-col gap-4">
                        <label for="" class="text-white mb-2 text-xl">Lampiran</label>
    
                        <div class="flex flex-row gap-2">
                            <a 
                            @if (!$letter->attachments->first())
                                href="javascript:void(0)" {{-- Path kosong/tidak ke mana-mana --}}
                                class="flex items-center gap-3 rounded-md bg-white hover:bg-gray-50 transition w-100 h-10 p-2 opacity-45 cursor-not-allowed">
                            @elseif ($letter->type === App\Enums\LetterType::OUTGOING)
                                href="{{ route('download.incoming.attachment', $letter->attachments->first()->id) }}" 
                                class="flex items-center gap-3 rounded-md bg-white hover:bg-gray-50 transition w-100 h-10 p-2">
                            @else
                                href="{{ route('download.outgoing.attachment', $letter->attachments->first()->id) }}" {{-- Link download --}}               
                                class="flex items-center gap-3 rounded-md bg-white hover:bg-gray-50 transition w-100 h-10 p-2">
                            @endif
                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24">
                                    <path fill="#3B82F6" fill-rule="evenodd"
                                        d="M14.25 2.5a.25.25 0 0 0-.25-.25H7A2.75 2.75 0 0 0 4.25 5v14A2.75 2.75 0 0 0 7 21.75h10A2.75 2.75 0 0 0 19.75 19V9.147a.25.25 0 0 0-.25-.25H15a.75.75 0 0 1-.75-.75zm.75 9.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1 0-1.5zm0 4a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1 0-1.5z"
                                        clip-rule="evenodd" />
                                    <path fill="#3B82F6"
                                        d="M15.75 2.824c0-.184.193-.301.336-.186q.182.147.323.342l3.013 4.197c.068.096-.006.22-.124.22H16a.25.25 0 0 1-.25-.25z" />
                                </svg>
        
                                Buka Lampiran
                            </a>
                            <a 
                            @if (!$letter->attachments->first())
                                href="javascript:void(0)" {{-- Path kosong/tidak ke mana-mana --}}
                                class="bg-[#28A745] cursor-not-allowed hover:bg-[#218838] text-white p-2 rounded-lg shadow-sm transition opacity-45">
                            @elseif ($letter->type === App\Enums\LetterType::OUTGOING)
                                href="{{ route('download.incoming.attachment', $letter->attachments->first()->id) }}" 
                                class="bg-[#28A745] hover:bg-[#218838] text-white p-2 rounded-lg shadow-sm transition">
                            @else
                                href="{{ route('download.outgoing.attachment', $letter->attachments->first()->id) }}" {{-- Link download --}}               
                                class="bg-[#28A745] hover:bg-[#218838] text-white p-2 rounded-lg shadow-sm transition">
                            @endif
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <input 
                    type="file" 
                    name="signed_file" 
                    id="signed_file" 
                    accept="application/pdf" 
                    required
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#1D4E63] file:text-white hover:file:bg-[#153a4a] cursor-pointer"
                >
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-white text-lg mb-1">Nomor Surat</label>
                    <input type="text" value="{{ $letter->full_number }}" readonly
                        class="w-200 border border-gray-400 rounded-md p-3 bg-white text-gray-800 focus:outline-none">
                </div>

                <div>
                    <label class="block text-white text-lg mb-1">Jenis Surat</label>
                    <input type="text" value="{{ $letter->type->value }}" readonly
                        class="w-200 border border-gray-400 rounded-md p-3 bg-white text-gray-800 focus:outline-none">
                </div>

                <div>
                    <label class="block text-white text-lg mb-1">Alamat</label>
                    <input type="text" value="{{ $letter->address }}" readonly
                        class="w-200 border border-gray-400 rounded-md p-3 bg-white text-gray-800 focus:outline-none">
                </div>
            </div>

            <div class="flex justify-center gap-12 mt-12">
                <button type="submit"
                    class="bg-[#10B981] hover:bg-[#059669] text-white px-8 py-2.5 rounded-md font-medium shadow-[0_4px_0_rgb(5,150,105)] active:shadow-none active:translate-y-[2px] transition-all">
                    Tanda Tangani
                </button>
            </div>
            </form>
        </div>
    </div>
</x-layouts.app>
