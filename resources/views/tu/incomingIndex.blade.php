<x-layouts.app>
    <x-slot:title>
        Surat Masuk
    </x-slot:title>
    <x-sidebar.tu />
    
    <div class="bg-white shadow-xl">
        @if (auth()->user()->role === App\Enums\UserRole::KEPALA_TU)
            <h1 class="text-black ml-67 text-2xl font-bold">Kepala Tata Usaha</h1>
        @elseif (auth()->user()->role === App\Enums\UserRole::TU)
            <h1 class="text-black ml-67 text-2xl font-bold">Tata Usaha</h1>
        @endif
    </div>
    
    {{-- Alert Sukses --}}
    @if (session('success'))
        <div id="alert-success" class="flex items-center p-4 mb-6 text-green-800 border-t-4 border-green-300 bg-green-50 shadow-md rounded-lg" role="alert">
            <svg class="flex-shrink-0 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <div class="ml-77 text-sm font-medium text-black">
                {{ session('success') }}
            </div>
            <button type="button" onclick="document.getElementById('alert-success').remove()" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" aria-label="Close">
                <span class="sr-only">Dismiss</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
      
    {{-- Alert Error (Opsional, untuk menangani Exception) --}}
    @if (session('error'))
        <div id="alert-error" class="flex items-center p-4 mb-6 text-red-800 border-t-4 border-red-300 bg-red-50 shadow-md rounded-lg" role="alert">
            <svg class="flex-shrink-0 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <div class="ml-3 text-sm font-medium">
                {{ session('error') }}
            </div>
            <button type="button" onclick="document.getElementById('alert-error').remove()" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
            </button>
        </div>
    @endif

    <div class="flex flex-row ml-77 gap-220">
        <div class="flex justify-end">
            <a href="{{ route('tu.incoming.draft.create.view') }}"
                class="mr-20 py-3 px-10 bg-[#1D546D] hover:bg-[#5F9598] text-white rounded-sm mt-5 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M13 6a1 1 0 1 0-2 0v5H6a1 1 0 1 0 0 2h5v5a1 1 0 1 0 2 0v-5h5a1 1 0 1 0 0-2h-5z" />
                </svg>
                <span class="text-4xl font-semibold">Buat Surat</span>
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
                            <td class="px-6 py-4 text-gray-700">{{ $item->full_number ?? $item->origin_number }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $item->type }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $item->address }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $item->status }}</td>
                            <td class="px-6 py-4 text-center justify-center flex gap-2 text-white">
                                <a 
                                @if ($item->type === App\Enums\LetterType::INCOMING)
                                href="{{ route('tu.incoming.draft.edit.view', $item->id) }}" class="px-3 py-1 rounded-md font-semibold bg-[#065F46] hover:bg-green-950 cursor-pointer w-30">Update
                                @else
                                href="{{ route('tu.outgoing.edit', $item->id) }}" class="px-3 py-1 rounded-md font-semibold bg-[#065F46] hover:bg-green-950 cursor-pointer w-30">Update

                                @endif
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
