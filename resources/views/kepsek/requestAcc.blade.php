<x-layouts.app>
    <x-slot:title>
        Permintaan Acc
    </x-slot:title>
    <x-sidebar.kepsek />
    <div class="bg-white shadow-xl">
        <h1 class="text-black ml-67 text-2xl font-bold">Kepala Sekolah</h1>
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
                            <td class="px-6 py-4 text-gray-700">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $item->full_number }}
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $item->type }}
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $item->address }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold">
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center justify-center flex gap-2 text-white">
                                <a href="{{ route('kepsek.outgoing.sign.detail.view', $item->id) }}"
                                    class="px-3 py-1 rounded-md font-semibold bg-[#065F46] hover:bg-green-950 cursor-pointer w-30 text-white">Detail
                                </a>
                                <a href=""
                                    class="px-3 py-1 rounded-md font-semibold bg-[#A9A2A2] hover:bg-gray-500 cursor-pointer w-30 text-white">Arsip
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
