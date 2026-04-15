<x-layouts.app>
    <x-slot:title>
        Kode Surat
    </x-slot:title>

    <x-sidebar.tu />

    <div class="bg-white shadow-xl">
        @if (auth()->user()->role === App\Enums\UserRole::KEPALA_TU)
            <h1 class="text-black ml-67 text-2xl font-bold">Kepala Tata Usaha</h1>
        @elseif (auth()->user()->role === App\Enums\UserRole::TU)
            <h1 class="text-black ml-67 text-2xl font-bold">Tata Usaha</h1>
        @endif
    </div>
    <div class="flex flex-row ml-77 gap-220">
        <div class="flex justify-end">
            <a href="{{ route('classifications.create') }}"
                class="mr-20 py-3 px-10 bg-[#1D546D] hover:bg-[#5F9598] text-white rounded-sm mt-5 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M13 6a1 1 0 1 0-2 0v5H6a1 1 0 1 0 0 2h5v5a1 1 0 1 0 2 0v-5h5a1 1 0 1 0 0-2h-5z" />
                </svg>
                <span class="text-4xl font-semibold">Buat Kode</span>
            </a>
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
    </div>
    <div class="bg-[#061E29] shadow-lg  w-385 ml-75">
        <div class="mt-10 bg-white shadow-lg overflow-x-auto border border-gray-200">
            <table class="w-full text-left">
                <thead class="bg-[#061E29]">
                    <tr>
                        <th class="px-6 py-4 font-bold text-white text-lg">No</th>
                        <th class="px-6 py-4 font-bold text-white text-lg">Kode Surat</th>
                        <th class="px-6 py-4 font-bold text-white text-lg">Nama Kode</th>
                        <th class="px-6 py-4 font-bold text-white text-lg text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach ($classifications as $index => $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-gray-700">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $item->code }}
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $item->name }}
                            </td>
                            <td class="px-6 py-4 text-center justify-center flex gap-2 text-white">
                                <a href="{{ route('classifications.edit', $item->code) }}"
                                    class="px-3 py-1 rounded-md font-semibold bg-[#7E95DB] hover:bg-[#bcc2d6] cursor-pointer w-30 text-white">Edit
                                </a>
                                <a
                                    class="px-3 py-1 rounded-md font-semibold bg-[#AC1010] hover:bg-red-900 cursor-pointer w-30 text-white">Hapus
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $classifications->links() }}
    </div>
</x-layouts.app>
