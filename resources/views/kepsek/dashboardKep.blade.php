<x-layouts.app>
    <x-slot:title>
        Dashboard Kepsek
    </x-slot:title>
    <x-sidebar.kepsek />
    <div class="bg-white shadow-xl">
        <h1 class="text-black ml-67 text-2xl font-bold">Kepala Sekolah</h1>
    </div>

    <div class="mt-20 ml-75 flex gap-70 items-center justify-center">
        <div class="bg-white rounded-xl shadow-xl w-120 h-55">
            <h1 class="font-semibold text-xl p-2 ml-10">Total Permintaan</h1>
            <div class="flex gap-60 mt-10">
                <p class="font-bold text-7xl p-2 ml-10">{{ $totalRequestCount }}</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="84" height="84" viewBox="0 0 24 24">
                    <path fill="#3B82F6"
                        d="m16.484 11.976l6.151-5.344v10.627zm-7.926.905l2.16 1.875c.339.288.781.462 1.264.462h.017h-.001h.014c.484 0 .926-.175 1.269-.465l-.003.002l2.16-1.875l6.566 5.639H1.995zM1.986 5.365h20.03l-9.621 8.356a.6.6 0 0 1-.38.132h-.014h.001h-.014a.6.6 0 0 1-.381-.133l.001.001zm-.621 1.266l6.15 5.344l-6.15 5.28zm21.6-2.441c-.24-.12-.522-.19-.821-.19H1.859a1.9 1.9 0 0 0-.835.197l.011-.005A1.86 1.86 0 0 0 0 5.855v12.172a1.86 1.86 0 0 0 1.858 1.858h20.283a1.86 1.86 0 0 0 1.858-1.858V5.855c0-.727-.419-1.357-1.029-1.66l-.011-.005z" />
                </svg>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-xl w-120 h-55">
            <h1 class="font-semibold text-xl p-2 ml-10">Revisi</h1>
            <div class="flex gap-60 mt-10">
                <p class="font-bold text-7xl p-2 ml-10">{{ $totalIncomingCount }}</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="84" height="84" viewBox="0 0 24 24">
                    <path fill="#3B82F6"
                        d="M5 21h14c1.1 0 2-.9 2-2v-7h-2v7H5V5h7V3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2" />
                    <path fill="#3B82F6"
                        d="M7 13v3c0 .55.45 1 1 1h3c.27 0 .52-.11.71-.29l9-9a.996.996 0 0 0 0-1.41l-3-3a.996.996 0 0 0-1.41 0l-9.01 8.99A1 1 0 0 0 7 13m10-7.59L18.59 7L17.5 8.09L15.91 6.5zm-8 8l5.5-5.5l1.59 1.59l-5.5 5.5H9z" />
                </svg>
            </div>
        </div>
    </div>

    <h1 class="text-4xl font-semibold ml-75 mt-10">Surat Menunggu Persetujuan</h1>

    <div class="bg-[#061E29] shadow-lg  w-360 ml-75">
        <div class="mt-10 bg-white shadow-lg overflow-x-auto border border-gray-200">
            <table class="w-full text-left">
                <thead class="bg-[#061E29]">
                    <tr>
                        <th class="px-6 py-4 font-bold text-white text-lg">No</th>
                        <th class="px-6 py-4 font-bold text-white text-lg">Tanggal Agenda</th>
                        <th class="px-6 py-4 font-bold text-white text-lg">Jenis Surat</th>
                        <th class="px-6 py-4 font-bold text-white text-lg">Alamat Tujuan</th>
                        <th class="px-6 py-4 font-bold text-white text-lg text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach ($letterToSign as $index => $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-gray-700">{{ $index + 1 }}</td>
                            {{-- Gunakan created_at karena di tabel letters gak ada kolom 'tanggal' --}}
                            <td class="px-6 py-4 text-gray-700">{{ $item->created_at->format('d F Y') }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $item->type }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $item->address }}</td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    // Logic warna berdasarkan Enum/Status
                                    $colorClass =
                                        $item->status->value === 'Draft'
                                            ? 'bg-yellow-100 text-yellow-600'
                                            : 'bg-blue-100 text-blue-600';
                                @endphp
                                <span class="px-3 py-1 {{ $colorClass }} rounded-full text-xs font-semibold">
                                    {{ $item->status }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
