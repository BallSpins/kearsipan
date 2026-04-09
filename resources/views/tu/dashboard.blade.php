<x-layouts.app>
    <x-slot:title>
        Dashboard TU
    </x-slot:title>
    <div>
        <x-layouts.sidebar>
            <a href="{{ route('tu.dashboard') }}" class="flex px-4 py-2 rounded {{ request()->routeIs('tu.dashboard') ? 'bg-[#5F9598] ' : 'hover:bg-[#5F9598]' }}">
                <div class="justify-center flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24"><path fill="#fff" d="M4 19v-9q0-.475.213-.9t.587-.7l6-4.5q.525-.4 1.2-.4t1.2.4l6 4.5q.375.275.588.7T20 10v9q0 .825-.588 1.413T18 21h-3q-.425 0-.712-.288T14 20v-5q0-.425-.288-.712T13 14h-2q-.425 0-.712.288T10 15v5q0 .425-.288.713T9 21H6q-.825 0-1.412-.587T4 19"/></svg>
                    <h-1 class="text-xl">Dashboard</h-1>
                </div>
            </a>
            <a href="{{ route('tu.request.list.view') }}" class="flex px-4 py-2 rounded {{ request()->routeIs('') ? 'bg-[#5F9598] ' : 'hover:bg-[#5F9598]' }}">
                <div class="justify-center flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24"><path fill="currentColor" d="M13 19c0-3.31 2.69-6 6-6c1.1 0 2.12.3 3 .81V6a2 2 0 0 0-2-2H4c-1.11 0-2 .89-2 2v12a2 2 0 0 0 2 2h9.09c-.05-.33-.09-.66-.09-1M4 8V6l8 5l8-5v2l-8 5zm16 7v3h3v2h-3v3h-2v-3h-3v-2h3v-3z"/></svg>
                    <h-1 class="text-xl">Permintaan Surat</h-1>
                </div>
            </a>
            <a href="{{ route('tu.dashboard') }}" class="flex px-4 py-2 rounded {{ request()->routeIs('') ? 'bg-[#5F9598] ' : 'hover:bg-[#5F9598]' }}">
                <div class="justify-center flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24"><path fill="#fff" d="M20 2a1 1 0 0 1 1 1v3.757l-8.999 9l-.006 4.238l4.246.006L21 15.242V21a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1zm1.778 6.808l1.414 1.414L15.414 18l-1.416-.002l.002-1.412zM12 12H7v2h5zm3-4H7v2h8z"/></svg>
                    <h1 class="text-xl">Draft</h1>
                </div>
            </a>
            <a href="{{ route('tu.dashboard') }}" class="flex px-4 py-2rounded {{ request()->routeIs('') ? 'bg-[#5F9598] ' : 'hover:bg-[#5F9598]' }}">
                <div class="justify-center flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24"><path fill="currentColor" d="m12 18l4-4l-1.4-1.4l-1.6 1.6V10h-2v4.2l-1.6-1.6L8 14zm-7 3q-.825 0-1.412-.587T3 19V6.525q0-.35.113-.675t.337-.6L4.7 3.725q.275-.35.687-.538T6.25 3h11.5q.45 0 .863.188t.687.537l1.25 1.525q.225.275.338.6t.112.675V19q0 .825-.587 1.413T19 21zm.4-15h13.2l-.85-1H6.25z"/></svg>
                    <h-1 class="text-xl">Arsip</h-1>
                </div>
            </a>
            <a href="{{ route('logout') }}" class="flex bg-[#FF0000] w-40 h-10 rounded ml-10 mt-130 px-8">
                <div class="justify-center flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h7v2H5v14h7v2zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z"/></svg>
                    <h1 class="text-lg">Logout</h1>
                </div>
            </a>
        </x-layouts.sidebar>
        <div class="bg-white"><h1 class="text-black ml-67 text-2xl font-bold">Tata Usaha</h1></div>
        <div class="mt-20 ml-75 flex gap-15">
            <div class="bg-white rounded-xl shadow-xl w-110 h-55">
                <h1 class="font-semibold text-xl p-2 ml-10">Total Permintaan</h1>
                <div class="flex gap-40 mt-10">
                    <p class="font-bold text-7xl p-2 ml-10">20</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="84" height="84" viewBox="0 0 24 24"><path fill="#3B82F6" d="m16.484 11.976l6.151-5.344v10.627zm-7.926.905l2.16 1.875c.339.288.781.462 1.264.462h.017h-.001h.014c.484 0 .926-.175 1.269-.465l-.003.002l2.16-1.875l6.566 5.639H1.995zM1.986 5.365h20.03l-9.621 8.356a.6.6 0 0 1-.38.132h-.014h.001h-.014a.6.6 0 0 1-.381-.133l.001.001zm-.621 1.266l6.15 5.344l-6.15 5.28zm21.6-2.441c-.24-.12-.522-.19-.821-.19H1.859a1.9 1.9 0 0 0-.835.197l.011-.005A1.86 1.86 0 0 0 0 5.855v12.172a1.86 1.86 0 0 0 1.858 1.858h20.283a1.86 1.86 0 0 0 1.858-1.858V5.855c0-.727-.419-1.357-1.029-1.66l-.011-.005z"/></svg>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-xl w-110 h-55">
                <h1 class="font-semibold text-xl p-2 ml-10">Menunggu Persetujuan</h1>
                 <div class="flex gap-40 mt-10">
                    <p class="font-bold text-7xl p-2 ml-10">20</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="84" height="84" viewBox="0 0 24 24"><path fill="#FF5D00" d="M12 5.511c.561 0 1.119.354 1.544 1.062l5.912 9.854C20.307 17.842 19.65 19 18 19H6c-1.65 0-2.307-1.159-1.456-2.573l5.912-9.854c.425-.708.983-1.062 1.544-1.062m0-2c-1.296 0-2.482.74-3.259 2.031l-5.912 9.856c-.786 1.309-.872 2.705-.235 3.83S4.473 21 6 21h12c1.527 0 2.77-.646 3.406-1.771s.551-2.521-.235-3.83l-5.912-9.854C14.482 4.251 13.296 3.511 12 3.511"/><circle cx="12" cy="16" r="1.3" fill="#FF5D00"/><path fill="#FF5D00" d="M13.5 10c0-.83-.671-1.5-1.5-1.5a1.5 1.5 0 0 0-1.389 2.062C11.165 11.938 12 14 12 14l1.391-3.438c.068-.173.109-.363.109-.562"/></svg>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-xl w-110 h-55">
                <h1 class="font-semibold text-xl p-2 ml-10">Revisi</h1>
                <div class="flex gap-40 mt-10">
                    <p class="font-bold text-7xl p-2 ml-10">20</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="84" height="84" viewBox="0 0 24 24"><path fill="#3B82F6" d="M5 21h14c1.1 0 2-.9 2-2v-7h-2v7H5V5h7V3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2"/><path fill="#3B82F6" d="M7 13v3c0 .55.45 1 1 1h3c.27 0 .52-.11.71-.29l9-9a.996.996 0 0 0 0-1.41l-3-3a.996.996 0 0 0-1.41 0l-9.01 8.99A1 1 0 0 0 7 13m10-7.59L18.59 7L17.5 8.09L15.91 6.5zm-8 8l5.5-5.5l1.59 1.59l-5.5 5.5H9z"/></svg>
                </div>
            </div>
        </div>
        <h1 class="text-4xl font-semibold ml-75 mt-10">Draft Surat</h1>
        <div class="bg-[#061E29] shadow-lg  w-360 ml-75">
<div class="mt-10 bg-white shadow-lg overflow-x-auto border border-gray-200">
<table class="w-full text-left">
    <thead class="bg-[#061E29]">
        <tr>
            <th class="px-6 py-4 font-bold text-white text-lg">No</th>
            <th class="px-6 py-4 font-bold text-white text-lg">Tanggal Agenda</th>
            <th class="px-6 py-4 font-bold text-white text-lg">Jenis Surat</th>
            <th class="px-6 py-4 font-bold text-white text-lg">Pengirim</th>
            <th class="px-6 py-4 font-bold text-white text-lg text-center">Status</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-100">
        @php
            // Membuat data dummy dalam bentuk array
            $surats = [
                ['tanggal' => '07 April 2026', 'jenis' => 'Surat Masuk', 'pengirim' => 'Dinas Pendidikan', 'status' => 'Menunggu', 'color' => 'bg-[#FDF3A8]', 'text' => 'text-[#FF9D00]'],
                ['tanggal' => '08 April 2026', 'jenis' => 'Surat Keluar', 'pengirim' => 'Kepala Sekolah', 'status' => 'Selesai', 'color' => 'bg-green-100', 'text' => 'text-green-600'],
                ['tanggal' => '09 April 2026', 'jenis' => 'Surat Tugas', 'pengirim' => 'Kurikulum', 'status' => 'Proses', 'color' => 'bg-blue-100', 'text' => 'text-blue-600'],
                ['tanggal' => '10 April 2026', 'jenis' => 'Surat Masuk', 'pengirim' => 'PT Telkom', 'status' => 'Menunggu', 'color' => 'bg-[#FDF3A8]', 'text' => 'text-[#FF9D00]'],
                ['tanggal' => '11 April 2026', 'jenis' => 'Nota Dinas', 'pengirim' => 'Kesiswaan', 'status' => 'Ditolak', 'color' => 'bg-red-100', 'text' => 'text-red-600'],
            ];
        @endphp

        @foreach ($surats as $index => $item)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 text-gray-700">{{ $index + 1 }}</td>
                <td class="px-6 py-4 text-gray-700">{{ $item['tanggal'] }}</td>
                <td class="px-6 py-4 text-gray-700">{{ $item['jenis'] }}</td>
                <td class="px-6 py-4 text-gray-700">{{ $item['pengirim'] }}</td>
                <td class="px-6 py-4 text-center">
                    <span class="px-3 py-1 {{ $item['color'] }} {{ $item['text'] }} rounded-full text-xs font-semibold">
                        {{ $item['status'] }}
                    </span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
        </div>
    </div>
</x-layouts.app>
