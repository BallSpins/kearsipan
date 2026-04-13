<x-layouts.app>
    <x-slot:title>
        Surat Masuk
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
        <div class=" rounded-sm flex items-center px-10 py-2">
            <h1 class="font-semibold text-4xl">Template Surat</h1>
        </div>
    </div>
    <div class="bg-white rounded-md shadow p-6 ml-77 mr-10 mt-6">
        <div class="flex flex-row justify-between items-center">
            <h1 class="text-2xl font-semibold">Surat Tugas</h1>

            <button class="bg-[#28A745] text-white rounded flex text-xl font-semibold p-2 items-center gap-2">
                Download
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z" />
                </svg>
            </button>
        </div>
    </div>
</x-layouts.app>
