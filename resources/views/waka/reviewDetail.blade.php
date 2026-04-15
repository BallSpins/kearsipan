<x-layouts.app>
    <x-slot:title>
        Detail Permintaan ACC
    </x-slot:title>
    <x-sidebar.waka />
    <div class="bg-white shadow-xl">
        <h1 class="text-black ml-67 text-2xl font-bold">WAKA</h1>
    </div>
    <div class="flex mt-10">
        <div class="bg-white hover:bg-gray-200 rounded-full w-15 ml-77 h-15 shadow-lg">
            <a href="{{ route('waka.review.index.view') }}"
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
    <div x-data="{ note: '' }" class="bg-white shadow-xl items-center justify-center rounded-xl h-160 w-370 mt-10 ml-87 p-12">
        <h1 class="text-4xl font-semibold mb-4">Detail Surat</h1>
        <div class=" w-full border border-gray-300 mb-15"></div>
        <form action="">
            <div class="flex flex-row gap-10">
                <div class="flex flex-col">
                    <label for="" class="text-[#7E95DB] mb-2 text-xl">Surat yang disertakan</label>
                    <div class="flex flex-row gap-4">
                      <div class="relative border border-black rounded-lg w-100 py-4 px-2 flex items-center justify-start bg-white">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#4285F4]" viewBox="0 0 24 24"
                              fill="currentColor">
                              <path
                                  d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
                          </svg>

                          <p class="text-lg">Buka Surat</p>
  
                      </div>
                        <div class="my-auto">
                            <a href="#"
                                class="bg-[#28A745] hover:bg-[#218838] text-white p-2  rounded-xl shadow-md flex items-center justify-center transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <label for="" class="text-[#7E95DB] mb-2 text-xl">Alamat</label>
                    <input type="text" disabled value="{{ $letter->address }}" name="address" class="rounded border w-150 h-10 p-2 mb-2">

                    <label for="" class="text-[#7E95DB] mb-2 text-xl">Lampiran</label>
                    <div class="relative border border-black rounded-lg w-full h-37 flex items-center justify-center bg-white">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-15 h-15 text-[#4285F4]" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
                        </svg>

                    </div>
                </div>

                <div class="flex flex-col">
                    @php
                      if ($letter->type === App\Enums\LetterType::INCOMING) {
                        $number = $letter->origin_number;
                      } else {
                        $number = $letter->full_number;
                      }
                    @endphp
                    <label for="" class="text-[#7E95DB] mb-2 text-xl">Nomor Surat</label>
                    <input type="text" disabled value="{{ $number }}" name="" class="rounded border w-2xl h-10 p-2 mb-2">

                    <label for="revision_note" class="text-[#7E95DB] mb-2 text-xl">Catatan Revisi (Bila Ada)</label>
                    <textarea 
                          x-model="note" {{-- Menghubungkan textarea ke variabel 'note' --}}
                          name="revision_note" 
                          id="revision_note" 
                          cols="30" 
                          rows="10" 
                          class="border w-2xl rounded p-2 resize-none"
                          placeholder="Isi jika ingin memberikan revisi..."></textarea>
                </div>


              </div>
              <div class="flex justify-end w-full gap-4">
                  <button type="submit" 
                      :disabled="note.length === 0"
                      :class="note.length === 0 ? 'bg-gray-400 cursor-not-allowed' : 'bg-red-600 hover:bg-red-700'"
                      class="px-6 py-2 text-white text-lg rounded-lg transition mt-5">
                      Revisi
                  </button>
                  <button type="submit" 
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
