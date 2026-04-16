<x-layouts.app>
    <x-slot:title>
        Detail Permintaan Surat
    </x-slot:title>
    <x-sidebar.tu />

    <div class="bg-white shadow-xl">
        @if (auth()->user()->role === App\Enums\UserRole::KEPALA_TU)
            <h1 class="text-black ml-67 text-2xl font-bold">Kepala Tata Usaha</h1>
        @elseif (auth()->user()->role === App\Enums\UserRole::TU)
            <h1 class="text-black ml-67 text-2xl font-bold">Tata Usaha</h1>
        @endif
    </div>

    <div class="flex flex-row justify-between">
        <div class="flex mt-10">
            <div class="bg-white hover:bg-gray-200 rounded-full w-15 ml-77 h-15 shadow-lg">
                <a href="{{ route('tu.request.list.view') }}"
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
        <div class="flex justify-end">
            <a 
                @if ($request->letter) 
                    {{-- Jika letter sudah ada, hilangkan href dan tambah class disabled --}}
                    class="mr-20 py-4 px-10 bg-gray-400 text-white rounded-sm mt-5 flex items-center gap-2 cursor-not-allowed opacity-50"
                @else 
                    href="{{ route('tu.request.create.outgoing.view', $request->id) }}"
                    target="_blank" 
                    class="mr-20 py-4 px-10 bg-[#1D546D] hover:bg-[#5F9598] text-white rounded-sm mt-5 flex items-center gap-2"
                @endif
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M13 6a1 1 0 1 0-2 0v5H6a1 1 0 1 0 0 2h5v5a1 1 0 1 0 2 0v-5h5a1 1 0 1 0 0-2h-5z" />
                </svg>
                <span class="text-4xl font-semibold">Buat Surat</span>
            </a>
        </div>
    </div>
    <div class="bg-white shadow-xl items-center justify-center rounded-xl h-160 w-370 mt-10 ml-87 p-12">
        <h1 class="text-4xl font-semibold mb-4">Detail Permintaan</h1>
        <div class=" w-full border border-gray-300 mb-15"></div>
        <form action="">
            <div class="flex flex-row gap-40">
                <div class="flex flex-col">
                    <label for="" class="text-[#7E95DB] mb-2 text-xl">Perhial</label>
                    <input type="text" disabled value="{{ $request->subject }}" name="address" class="rounded border w-150 h-10 p-2 mb-2">

                    <label for="" class="text-[#7E95DB] mb-2 text-xl">Surat yang disertakan</label>
                    <div class="flex flex-row gap-4">
                      <div
                          class="relative border border-black rounded-lg w-full h-20 flex items-center justify-center bg-white">
  
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-15 h-15 text-[#4285F4]" viewBox="0 0 24 24"
                              fill="currentColor">
                              <path
                                  d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
                          </svg>
  
                      </div>
                        <div class="my-auto">
                            @php
                                $hasFile = !empty($request->file_path);
                            @endphp
                            <a 
                            @if($hasFile)
                                href="{{ route('download.outgoing', $request->id) }}"
                            @else
                                href="javascript:void(0)" {{-- Path kosong/tidak ke mana-mana --}}
                            @endif
                            class="p-2 rounded-xl shadow-md flex items-center justify-center transition 
                            {{ $hasFile 
                               ? 'bg-[#28A745] hover:bg-[#218838] text-white' 
                               : 'bg-gray-400 text-gray-200 cursor-not-allowed opacity-50 pointer-events-none' }}"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <label for="" class="text-[#7E95DB] mb-2 text-xl">Lampiran</label>
                    <div class="flex flex-row gap-4">
                      <div
                          class="relative border border-black rounded-lg w-full h-20 flex items-center justify-center bg-white">
  
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-15 h-15 text-[#4285F4]" viewBox="0 0 24 24"
                              fill="currentColor">
                              <path
                                  d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
                          </svg>
  
                      </div>
                        <div class="my-auto">
                            @php
                                $hasFile = !empty($request->attachments->first()->file_path);
                            @endphp
                            <a 
                            @if($hasFile)
                                href="{{ route('download.outgoing.attachment', $request->attachments->first()->id) }}"
                            @else
                                href="javascript:void(0)" {{-- Path kosong/tidak ke mana-mana --}}
                            @endif
                            class="p-2 rounded-xl shadow-md flex items-center justify-center transition 
                            {{ $hasFile 
                               ? 'bg-[#28A745] hover:bg-[#218838] text-white' 
                               : 'bg-gray-400 text-gray-200 cursor-not-allowed opacity-50 pointer-events-none' }}"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col">
                    <label for="" class="text-[#7E95DB] mb-2 text-xl">Perihal</label>
                    <textarea name="subject" disabled id="" cols="30" rows="10" class="border w-150 rounded p-2 resize-none">{{ $request->description }}</textarea>
                </div>
            </div>
        </form>
    </div>
</x-layouts.app>

