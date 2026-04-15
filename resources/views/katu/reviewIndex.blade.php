<x-layouts.app>
    <x-slot:title>
        Permintaan ACC
    </x-slot:title>
    <x-sidebar.tu />
    
    <div class="bg-white shadow-xl">
        <h1 class="text-black ml-67 text-2xl font-bold">Kepala Tata Usaha</h1>
    </div>

    <div class="mt-10 bg-white shadow-lg overflow-x-auto border border-gray-200 ml-75 mr-20">
        <table class="w-full text-left">
            <thead class="bg-[#061E29]">
                <tr>
                    <th class="px-6 py-4 font-bold text-white text-lg">No</th>
                    <th class="px-6 py-4 font-bold text-white text-lg">Tanggal Agenda</th>
                    <th class="px-6 py-4 font-bold text-white text-lg">Perihal</th>
                    <th class="px-6 py-4 font-bold text-white text-lg">Alamat</th>
                    <th class="px-6 py-4 font-bold text-white text-lg text-center">Status</th>
                    <th class="px-6 py-4 font-bold text-white text-lg text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach ($letters as $index => $item)
                    <tr class="hover:bg-gray-50 transition">
                        {{-- Logika Nomor: Jika menggunakan paginasi pakai firstItem, jika dummy pakai index + 1 --}}
                        <td class="px-6 py-4 text-gray-700">
                            {{ $index + 1 }}
                        </td>

                        <td class="px-6 py-4 text-gray-700">
                            {{ $item->created_at instanceof \Carbon\Carbon ? $item->created_at->format('d/m/Y') : $item->created_at }}
                        </td>

                        <td class="px-6 py-4 text-gray-700">{{ $item->subject }}</td>

                        <td class="px-6 py-4 text-gray-700">{{ $item->address }}</td>

                        <td class="px-6 py-4 text-gray-700 text-center">
                          @if ($item->status)
                            <span
                                  class="px-2 py-1 rounded-full text-xs {{ $item->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                                  {{ ucfirst($item->status->value) }}
                              </span>
                          
                          @elseif (!$item->status)
                          <span
                                  class="px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">
                                  Pending
                              </span>
                          @endif
                        </td>

                        <td class="px-6 py-4 text-gray-700 text-center">
                            <a href="{{ route('katu.review.view', $item->id) }}"
                                class="bg-[#065F46] text-white rounded-md px-4 py-2 hover:bg-[#044a36]">
                                Detail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
        {{ $letters->links() }}
    </div>
    </div>
</x-layouts.app>
