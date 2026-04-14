<x-layouts.app>
    <x-slot:title>
        Surat Masuk
    </x-slot:title>
    <x-sidebar.waka />
    
    <div class="bg-white shadow-xl">
        <h1 class="text-black ml-67 text-2xl font-bold">WAKA</h1>
    </div>
    <form action="{{ route('tu.request.list.view') }}" method="GET" class="flex">
        <div class="relative ml-auto mt-10 mr-20">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-[#3B82F6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

              <input type="text" name="search" value="{{ request('search') }}"
                class="block w-full border rounded-md  pl-10 pr-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-[#000000]">
        </div>
    </form>
    <div class="bg-[#061E29] shadow-lg  w-385 ml-75">
        <div class="mt-10 bg-white shadow-lg overflow-x-auto border border-gray-200">
            <table class="w-full text-left">
                <thead class="bg-[#061E29]">
                    <tr>
                        <th class="px-6 py-4 font-bold text-white text-lg">No</th>
                        <th class="px-6 py-4 font-bold text-white text-lg">Nomor Surat</th>
                        <th class="px-6 py-4 font-bold text-white text-lg">Jenis Surat</th>
                        <th class="px-6 py-4 font-bold text-white text-lg">Alamat Tujuan</th>
                        <th class="px-6 py-4 font-bold text-white text-lg text-center">Status</th>
                        <th class="px-6 py-4 font-bold text-white text-lg text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach ($letters as $index => $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-gray-700">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $item->full_number }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $item->type }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $item->address }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $item->status }}</td>
                            <td class="px-6 py-4 text-center justify-center flex gap-2 text-white">
                                <a href="{{ route('waka.incoming.detail.view', $item->id) }}" class="px-3 py-1 rounded-md font-semibold bg-[#065F46] hover:bg-green-950 cursor-pointer w-30">
                                  Detail
                                </a>
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
