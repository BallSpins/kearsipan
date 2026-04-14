<x-layouts.app>
    <x-slot:title>
        Surat Masuk
    </x-slot:title>
    <x-layouts.sidebar>
<a href="{{ route('tu.dashboard') }}"
            class="flex px-4 py-2 p-4 {{ request()->routeIs('tu.dashboard') ? 'bg-[#5F9598] ' : 'hover:bg-[#5F9598]' }}">
            <div class="justify-center flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24">
                    <path fill="#fff"
                        d="M4 19v-9q0-.475.213-.9t.587-.7l6-4.5q.525-.4 1.2-.4t1.2.4l6 4.5q.375.275.588.7T20 10v9q0 .825-.588 1.413T18 21h-3q-.425 0-.712-.288T14 20v-5q0-.425-.288-.712T13 14h-2q-.425 0-.712.288T10 15v5q0 .425-.288.713T9 21H6q-.825 0-1.412-.587T4 19" />
                </svg>
                <h-1 class="text-xl">Dashboard</h-1>
            </div>
        </a>
        <a href="{{ route('tu.request.list.view') }}"
            class="flex px-4 py-2 p-4 {{ request()->routeIs('tu.request.list.view') ? 'bg-[#5F9598] ' : 'hover:bg-[#5F9598]' }}">
            <div class="justify-center flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M13 19c0-3.31 2.69-6 6-6c1.1 0 2.12.3 3 .81V6a2 2 0 0 0-2-2H4c-1.11 0-2 .89-2 2v12a2 2 0 0 0 2 2h9.09c-.05-.33-.09-.66-.09-1M4 8V6l8 5l8-5v2l-8 5zm16 7v3h3v2h-3v3h-2v-3h-3v-2h3v-3z" />
                </svg>
                <h-1 class="text-xl">Permintaan Surat</h-1>
            </div>
        </a>
        <a href="{{ route('tu.incoming.view') }}"
            class="flex px-4 py-2 p-4 {{ request()->routeIs('tu.incoming.view') ? 'bg-[#5F9598] ' : 'hover:bg-[#5F9598]' }}">
            <div class="justify-center flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24">
                    <path fill="#fff"
                        d="M20 2a1 1 0 0 1 1 1v3.757l-8.999 9l-.006 4.238l4.246.006L21 15.242V21a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1zm1.778 6.808l1.414 1.414L15.414 18l-1.416-.002l.002-1.412zM12 12H7v2h5zm3-4H7v2h8z" />
                </svg>
                <h1 class="text-xl">Draft</h1>
            </div>
        </a>
        <a href="{{ route('tu.archived') }}"
            class="flex px-4 py-2 p-3 {{ request()->routeIs('tu.archived') ? 'bg-[#5F9598] ' : 'hover:bg-[#5F9598]' }}">
            <div class="justify-center flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="m12 18l4-4l-1.4-1.4l-1.6 1.6V10h-2v4.2l-1.6-1.6L8 14zm-7 3q-.825 0-1.412-.587T3 19V6.525q0-.35.113-.675t.337-.6L4.7 3.725q.275-.35.687-.538T6.25 3h11.5q.45 0 .863.188t.687.537l1.25 1.525q.225.275.338.6t.112.675V19q0 .825-.587 1.413T19 21zm.4-15h13.2l-.85-1H6.25z" />
                </svg>
                <h-1 class="text-xl">Arsip</h-1>
            </div>
        </a>
        <a href="{{ route('logout') }}" class="flex bg-[#FF0000] w-40 h-10 rounded ml-10 mt-130 px-8">
            <div class="justify-center flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h7v2H5v14h7v2zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z" />
                </svg>
                <h1 class="text-lg">Logout</h1>
            </div>
        </a>
    </x-layouts.sidebar>
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
        <a href="{{ route('templates.index') }}" target="_blank"
            class="bg-[#1D546D] hover:bg-[#5F9598] cursor-pointer ml-auto text-white rounded-sm flex items-center px-10 py-2 mr-20 ">
            <h1 class="font-semibold text-2xl">Template Surat</h1>
    </a>
    </div>
    <div class="bg-white shadow-xl items-center justify-center rounded-xl h-160 w-370 mt-10 ml-87 p-12">
        <h1 class="text-4xl font-semibold mb-4">Buat Surat</h1>
        <div class=" w-full border border-gray-300 mb-15"></div>
        <form action="">
            <div class="flex flex-row gap-40">
                <div class="flex flex-col">
                    <label for="" class="text-[#7E95DB] mb-2 text-xl">Alamat</label>
                    <input type="text" name="address" class="rounded border w-150 h-10 p-2 mb-2">

                    <label for="" class="text-[#7E95DB] mb-2 text-xl">Lampiran</label>
                    <div
                        class="relative border border-black rounded-lg w-full h-65 flex items-center justify-center bg-white">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-[#4285F4]" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
                        </svg>

                        <div class="absolute bottom-4 right-4">
                            <a href="#"
                                class="bg-[#28A745] hover:bg-[#218838] text-white p-3 rounded-xl shadow-md flex items-center justify-center transition">
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
                    <label for="" class="text-[#7E95DB] mb-2 text-xl">Nomor Surat</label>
                    <input type="text" name="origin_number" class="rounded border w-150 h-10 p-2 mb-2">

                    <label for="" class="text-[#7E95DB] mb-2 text-xl">Perihal</label>
                    <textarea name="subject" id="" cols="30" rows="10" class="border w-150 rounded p-2 resize-none"></textarea>
                    <div class="ml-auto">
                        <button
                            class="bg-[#28A745] px-6 py-2 text-white text-lg rounded-lg cursor-pointer mt-5">Kirim</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-layouts.app>
