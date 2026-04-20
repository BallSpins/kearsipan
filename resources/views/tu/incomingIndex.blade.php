<x-layouts.app>
    <x-slot:title>
        Surat Masuk
    </x-slot:title>
    <x-sidebar.tu />
    
    {{-- <div class="bg-white shadow-xl">
        @if (auth()->user()->role === App\Enums\UserRole::KEPALA_TU)
            <h1 class="text-black ml-67 text-2xl font-bold">Kepala Tata Usaha</h1>
        @elseif (auth()->user()->role === App\Enums\UserRole::TU)
            <h1 class="text-black ml-67 text-2xl font-bold">Tata Usaha</h1>
        @endif
    </div> --}}
    
    {{-- Alert Sukses --}}
    @if (session()->has('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                window.notyf.success("{{ session('success') }}");
            });
        </script>
    @endif
      
    {{-- Alert Error (Opsional, untuk menangani Exception) --}}
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Looping karena $errors isinya array
                @foreach ($errors->all() as $error)
                    window.notyf.error("{{ $error }}");
                @endforeach
            });
        </script>
    @endif

    <div class="flex flex-row ml-77 gap-240">
        <div class="flex justify-end">
            <a href="{{ route('tu.incoming.draft.create.view') }}"
                class="mr-20 h-15 px-6 bg-[#061E29] hover:bg-white/5 text-white rounded-sm mt-5 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M13 6a1 1 0 1 0-2 0v5H6a1 1 0 1 0 0 2h5v5a1 1 0 1 0 2 0v-5h5a1 1 0 1 0 0-2h-5z" />
                </svg>
                <span class="text-2xl font-semibold">Buat Surat</span>
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

    <div class="bg-[#061E29] shadow-lg  w-385 ml-75 rounded-2xl">
        <div class="mt-10 bg-white shadow-lg overflow-x-auto rounded-2xl">
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
    <div class="px-6 py-4 mr-8">
        {{ $letters->links('pagination::tailwind') }}
    </div>
</x-layouts.app>
