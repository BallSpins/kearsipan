<x-layouts.app>
    <x-slot:title>
        Surat Masuk
    </x-slot:title>
    <x-sidebar.waka />
    

    {{-- <div class="bg-white shadow-xl">
        <h1 class="text-black ml-67 text-2xl font-bold">WAKA</h1>
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

    <div class="flex justify-end">
        <a href="{{ route('waka.request.create.view') }}" class="mr-20 px-10 bg-[#061E29] hover:bg-white/5 text-white rounded-sm mt-5 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M13 6a1 1 0 1 0-2 0v5H6a1 1 0 1 0 0 2h5v5a1 1 0 1 0 2 0v-5h5a1 1 0 1 0 0-2h-5z" />
            </svg>
            <span class="text-xl font-semibold">Buat Permintaan</span>
        </a>
    </div>
    <div class="mt-10 bg-white shadow-lg overflow-x-auto rounded-2xl ml-75 mr-20">
        <table class="w-full text-left">
            <thead class="bg-[#061E29]">
                <tr>
                    <th class="px-6 py-4 font-bold text-white text-lg">No</th>
                    <th class="px-6 py-4 font-bold text-white text-lg">Tanggal Agenda</th>
                    <th class="px-6 py-4 font-bold text-white text-lg">Perihal</th>
                    <th class="px-6 py-4 font-bold text-white text-lg text-center">Status</th>
                    <th class="px-6 py-4 font-bold text-white text-lg text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach ($requests as $index => $item)
                    <tr class="hover:bg-gray-50 transition">
                        {{-- Logika Nomor: Jika menggunakan paginasi pakai firstItem, jika dummy pakai index + 1 --}}
                        <td class="px-6 py-4 text-gray-700">
                            {{ $index + 1 }}
                        </td>

                        <td class="px-6 py-4 text-gray-700">
                            {{ $item->created_at instanceof \Carbon\Carbon ? $item->created_at->format('d/m/Y') : $item->created_at }}
                        </td>

                        <td class="px-6 py-4 text-gray-700">{{ $item->subject }}</td>

                        <td class="px-6 py-4 text-gray-700 text-center">
                          @if ($item->letter)
                            <span
                                  class="px-2 py-1 rounded-full text-xs {{ $item->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                                  {{ ucfirst($item->letter->status->value) }}
                              </span>
                          
                          @else
                          <span
                                  class="px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">
                                  Pending
                              </span>
                          @endif
                        </td>

                        <td class="px-6 py-4 text-gray-700 text-center">
                            <a href="{{ route('waka.request.detail.view', $item->id) }}"
                                class="bg-[#065F46] text-white rounded-md px-4 py-2 hover:bg-[#044a36]">
                                Detail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 mr-8">
        {{ $requests->links('pagination::tailwind') }}
    </div>
</x-layouts.app>
