<x-layouts.app>
    <x-slot:title>
        Detail Arsip
    </x-slot:title>
    <x-sidebar.tu />
    {{-- <div class="bg-white shadow-xl">
        @if (auth()->user()->role === App\Enums\UserRole::KEPALA_TU)
            <h1 class="text-black ml-67 text-2xl font-bold">Kepala Tata Usaha</h1>
        @elseif (auth()->user()->role === App\Enums\UserRole::TU)
            <h1 class="text-black ml-67 text-2xl font-bold">Tata Usaha</h1>
        @endif
    </div> --}}
    <div class="flex mt-10">
        <div class="bg-white hover:bg-gray-200 rounded-2xl w-40 ml-77 h-15 shadow-lg">
            <a href="{{ route('tu.archived') }}" 
             class="text-center items-center justify-center flex">
                <svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M12 9.059V6.5a1.001 1.001 0 0 0-1.707-.708L4 12l6.293 6.207a.997.997 0 0 0 1.414 0A1 1 0 0 0 12 17.5v-2.489c2.75.068 5.755.566 8 3.989v-1c0-4.633-3.5-8.443-8-8.941" />
                </svg>
                <h1 class="text-xl font-bold">KEMBALI</h1>
            </a>
        </div>
    </div>
        <div class="bg-[#29627C] rounded-md shadow-xl w-250 h-240 mb-10 ml-127 p-8">
            <h1 class="text-white text-4xl font-semibold mb-4">Detail Surat</h1>
            <div class=" w-full border border-gray-300 mb-15"></div>
            <form action="" class="flex flex-col gap-4">

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
                            class="flex items-center gap-3 border rounded-md bg-white hover:bg-gray-50 transition w-100 h-10 p-2">
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
                            class="flex items-center gap-3 border rounded-md bg-white hover:bg-gray-50 transition w-100 h-10 p-2 opacity-45 cursor-not-allowed">
                        @elseif ($letter->type === App\Enums\LetterType::OUTGOING)
                            href="{{ route('download.incoming.attachment', $letter->attachments->first()->id) }}" 
                            class="flex items-center gap-3 border rounded-md bg-white hover:bg-gray-50 transition w-100 h-10 p-2">
                        @else
                            href="{{ route('download.outgoing.attachment', $letter->attachments->first()->id) }}" {{-- Link download --}}               
                            class="flex items-center gap-3 border rounded-md bg-white hover:bg-gray-50 transition w-100 h-10 p-2">
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


                <label for="" class="text-white mb-2 text-xl">Nomor Surat</label>
                @php
                    if ($letter->type === App\Enums\LetterType::OUTGOING) {
                        $number = $letter->full_number;
                    } else {
                        $number = $letter->origin_number;
                    }
                @endphp
                <input type="text" disabled value="{{ $number }}" class="rounded bg-white w-150 h-10 p-2 mb-2">

                <label for="" class="text-white mb-2 text-xl">Alamat</label>
                <input type="text" disabled value="{{ $letter->address }}" class="rounded bg-white w-150 h-10 p-2 mb-2">
                
                <label for="" class="text-white mb-2 text-xl">Perihal</label>
                <textarea disabled name="description" class="bg-white w-180 h-40 rounded p-2 resize-none">{{ $letter->subject }}</textarea>
            </form>
        </div>
</x-layouts.app>
