<x-layouts.app>
    <x-slot:title>
        Surat Masuk
    </x-slot:title>
    
    <x-sidebar.tu />

    {{-- <div class="bg-white shadow-xl">
        <h1 class="text-black ml-67 text-2xl font-bold">Tata Usaha</h1>
    </div> --}}
    <div class="flex mt-10">
        <div class="bg-white hover:bg-gray-200 rounded-xl w-40 ml-77 h-15 shadow-lg">
            <a href="{{ route('tu.request.list.view') }}" class="text-center items-center justify-center flex">
                <svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M12 9.059V6.5a1.001 1.001 0 0 0-1.707-.708L4 12l6.293 6.207a.997.997 0 0 0 1.414 0A1 1 0 0 0 12 17.5v-2.489c2.75.068 5.755.566 8 3.989v-1c0-4.633-3.5-8.443-8-8.941" />
                </svg>
                <h1 class="text-xl font-bold">KEMBALI</h1>
            </a>
        </div>
        <div class=" rounded-sm flex items-center px-10 py-2">
            <h1 class="font-semibold text-4xl text-white">Template Surat</h1>
        </div>
    </div>

    <div class="p-6 ml-77 mr-10 mt-6 flex flex-col gap-4">
        @foreach ($templates as $template)
            <div class="flex flex-row justify-between items-center bg-white px-8 py-4 rounded-xl shadow-xl">
                <h1 class="text-2xl font-semibold">{{ $template->name }}</h1>

                <a href="{{ route('download.template.download', $template->slug) }}" class="bg-[#28A745] text-white rounded flex text-xl font-semibold p-2 items-center gap-2">
                    Download
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z" />
                    </svg>
                </a>
            </div>
        @endforeach
    </div>
</x-layouts.app>
