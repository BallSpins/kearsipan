<x-layouts.app>
    <x-slot:title>
        Detail Surat
    </x-slot:title>
    
    <x-sidebar.tu />

    <div class="bg-white shadow-xl">
        <h1 class="text-black ml-67 text-2xl font-bold">Tata Usaha</h1>
    </div>
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
    <div class="bg-white shadow-xl items-center justify-center rounded-xl h-160 w-350 mt-10 ml-auto mr-20 p-12">
        <h1 class="text-4xl font-semibold mb-4">Detail Permintaan</h1>
        <div class=" w-full border border-gray-300 mb-8"></div>
        <form action="">
            <div class="flex gap-40">
                <div class="flex flex-col">
                    <div class="flex flex-row gap-2">
                        <a href=""
                            class="flex items-center gap-3 border rounded-md bg-white hover:bg-gray-50 transition w-100 h-10 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24">
                                <path fill="#3B82F6" fill-rule="evenodd"
                                    d="M14.25 2.5a.25.25 0 0 0-.25-.25H7A2.75 2.75 0 0 0 4.25 5v14A2.75 2.75 0 0 0 7 21.75h10A2.75 2.75 0 0 0 19.75 19V9.147a.25.25 0 0 0-.25-.25H15a.75.75 0 0 1-.75-.75zm.75 9.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1 0-1.5zm0 4a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1 0-1.5z"
                                    clip-rule="evenodd" />
                                <path fill="#3B82F6"
                                    d="M15.75 2.824c0-.184.193-.301.336-.186q.182.147.323.342l3.013 4.197c.068.096-.006.22-.124.22H16a.25.25 0 0 1-.25-.25z" />
                            </svg>
                        </a>
                        <a href=""
                            class="bg-[#28A745] hover:bg-[#218838] text-white p-2 rounded-lg shadow-sm transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                        </a>
                    </div>

                    <div class="flex flex-col mt-4">
                        <label class="text-[#484848] mb-2 text-xl font-medium">Tanggal</label>

                        <input type="date" value="{{ $request->created_at->format('Y-m-d') }}"
                            class="border rounded-md bg-white hover:bg-gray-50 transition 
               h-12 p-3 text-lg outline-none
               [&::-webkit-calendar-picker-indicator]:w-7 
               [&::-webkit-calendar-picker-indicator]:h-7 
               [&::-webkit-calendar-picker-indicator]:cursor-pointer
               [&::-webkit-calendar-picker-indicator]:bg-[#3B82F6]
               [&::-webkit-calendar-picker-indicator]:rounded-md
               [&::-webkit-calendar-picker-indicator]:ml-auto">
                    </div>
                    
                    <label for="" class="text-[#484848] mb-2 text-xl">Alamat Tujuan</label>
                    <input type="text" class="rounded border w-150 h-10 p-2 mb-2">

                    <label for="" class="text-[#484848] mb-2 text-xl">Jenis Surat</label>
                    <input type="text" class="rounded border w-150 h-10 p-2 mb-2">
                    
                    <label for="" class="text-[#484848] mb-2 text-xl">Perihal</label>
                    <textarea name="" id="" cols="30" rows="10" class="border w-150 rounded p-2 resize-none h-30"></textarea>

                </div>
            </div>
        </form>
    </div>
</x-layouts.app>
