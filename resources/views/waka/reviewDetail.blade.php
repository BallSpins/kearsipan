<x-layouts.app>
    <x-slot:title>
        Detail Permintaan ACC
    </x-slot:title>
    <x-sidebar.waka />
    {{-- <div class="bg-white shadow-xl">
        <h1 class="text-black ml-67 text-2xl font-bold">WAKA</h1>
    </div> --}}
    <div class="flex mt-10">
        <div class="bg-white hover:bg-gray-200 rounded-xl w-40 ml-77 h-15 shadow-lg">
            <a href="{{ route('waka.review.index.view') }}"
             class="text-center items-center justify-center flex">
                <svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M12 9.059V6.5a1.001 1.001 0 0 0-1.707-.708L4 12l6.293 6.207a.997.997 0 0 0 1.414 0A1 1 0 0 0 12 17.5v-2.489c2.75.068 5.755.566 8 3.989v-1c0-4.633-3.5-8.443-8-8.941" />
                </svg>
                <h1 class="text-xl font-bold">KEMBALI</h1>
            </a>
        </div>
    </div>
    <div x-data="{ note: '' }" class="bg-[#29627C]  shadow-xl items-center justify-center rounded-xl h-160 w-370 mt-10 ml-87 p-12">
        <h1 class="text-4xl font-semibold mb-4 text-white">Detail Surat</h1>
        <div class=" w-full border border-gray-300 mb-15"></div>
        <form action="{{ route('waka.review', $letter->id) }}" method="POST">
            @csrf
            <div class="flex flex-row gap-10">
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

                    <label for="" class="text-white mb-2 text-xl">Alamat</label>
                    <input type="text" disabled value="{{ $letter->address }}" name="address" class="rounded bg-white w-150 h-10 p-2 mb-2">
                </div>

                <div class="flex flex-col">
                    @php
                      if ($letter->type === App\Enums\LetterType::INCOMING) {
                        $number = $letter->origin_number;
                      } else {
                        $number = $letter->full_number;
                      }
                    @endphp
                    <label for="" class="text-white mb-2 text-xl">Nomor Surat</label>
                    <input type="text" disabled value="{{ $number }}" name="" class="bg-white border w-2xl h-10 p-2 mb-2">

                    <label for="note" class="text-white mb-2 text-xl">Catatan Revisi (Bila Ada)</label>
                    <textarea 
                          x-model="note" {{-- Menghubungkan textarea ke variabel 'note' --}}
                          name="note" 
                          id="note" 
                          cols="30" 
                          rows="10" 
                          class="bg-white w-2xl rounded p-2 resize-none"
                          placeholder="Isi jika ingin memberikan revisi..."></textarea>
                </div>


              </div>
              <div class="flex justify-end w-full gap-4">
                  <button type="submit" 
                      name="action" value="reject"
                      :disabled="note.length === 0"
                      :class="note.length === 0 ? 'bg-gray-400 cursor-not-allowed' : 'bg-red-600 hover:bg-red-700'"
                      class="px-6 py-2 text-white text-lg rounded-lg transition mt-5">
                      Revisi
                  </button>
                  <button type="submit" 
                      name="action" value="approve"
                      :disabled="note.length > 0" 
                      :class="note.length > 0 ? 'bg-gray-400 cursor-not-allowed' : 'bg-[#28A745] hover:bg-[#218838]'"
                      class="px-6 py-2 text-white text-lg rounded-lg transition mt-5">
                      Setujui
                  </button>
                  
                  {{-- <button type="submit" {{ $disabled }} class="bg-[#28A745] px-6 py-2 text-white text-lg rounded-lg cursor-pointer mt-5">Setujui</button> --}}
                  {{-- <button type="submit" class="bg-[#28A745] px-6 py-2 text-white text-lg rounded-lg cursor-pointer mt-5">Revisi</button> --}}
              </div>
        </form>
    </div>
</x-layouts.app>
