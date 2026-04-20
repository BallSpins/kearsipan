<x-layouts.app>
    <x-slot:title>
        Dashboard TU
    </x-slot:title>
    <div>
        <x-sidebar.tu />
        @if (session()->has('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    window.notyf.success("{{ session('success') }}");
                });
            </script>
        @endif

        <div class="ml-10 mt-5">
            @if (auth()->user()->role === App\Enums\UserRole::KEPALA_TU)
                <h1 class="text-black ml-67 text-4xl font-bold">Kepala Tata Usaha</h1>
                <h1 class="text-white ml-67 text-xl">Ayo, taklukkan tumpukan suratmu!</h1>
            @elseif (auth()->user()->role === App\Enums\UserRole::TU)
                <h1 class="text-white ml-67 text-4xl font-bold">Tata Usaha</h1>
                <h1 class="text-white ml-67 text-xl">Ayo, taklukkan tumpukan suratmu!</h1>
            @endif
        </div>

        <div class="mt-5 ml-75 flex gap-15">
            <div class="bg-white rounded-xl shadow-xl w-110 h-55">
                <h1 class="font-semibold text-2xl p-2 ml-10 mt-10 text-[#7F7F7F]">Surat Masuk</h1>
                <div class="flex gap-40 mt-5">
                    <p class="font-bold text-7xl p-2 ml-10 text-[#1D546D]">{{ $totalRequestCount }}</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="84" height="84" viewBox="0 0 24 24"><path fill="#3B82F6" d="m16.484 11.976l6.151-5.344v10.627zm-7.926.905l2.16 1.875c.339.288.781.462 1.264.462h.017h-.001h.014c.484 0 .926-.175 1.269-.465l-.003.002l2.16-1.875l6.566 5.639H1.995zM1.986 5.365h20.03l-9.621 8.356a.6.6 0 0 1-.38.132h-.014h.001h-.014a.6.6 0 0 1-.381-.133l.001.001zm-.621 1.266l6.15 5.344l-6.15 5.28zm21.6-2.441c-.24-.12-.522-.19-.821-.19H1.859a1.9 1.9 0 0 0-.835.197l.011-.005A1.86 1.86 0 0 0 0 5.855v12.172a1.86 1.86 0 0 0 1.858 1.858h20.283a1.86 1.86 0 0 0 1.858-1.858V5.855c0-.727-.419-1.357-1.029-1.66l-.011-.005z"/></svg>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-xl w-110 h-55">
                <h1 class="font-semibold text-2xl p-2 ml-10 mt-10 text-[#7F7F7F]">Menunggu Persetujuan</h1>
                 <div class="flex gap-40 mt-5">
                    <p class="font-bold text-7xl p-2 ml-10 text-[#1D546D]">{{ $pendingRequestCount }}</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="84" height="84" viewBox="0 0 24 24"><path fill="#FF5D00" d="M12 5.511c.561 0 1.119.354 1.544 1.062l5.912 9.854C20.307 17.842 19.65 19 18 19H6c-1.65 0-2.307-1.159-1.456-2.573l5.912-9.854c.425-.708.983-1.062 1.544-1.062m0-2c-1.296 0-2.482.74-3.259 2.031l-5.912 9.856c-.786 1.309-.872 2.705-.235 3.83S4.473 21 6 21h12c1.527 0 2.77-.646 3.406-1.771s.551-2.521-.235-3.83l-5.912-9.854C14.482 4.251 13.296 3.511 12 3.511"/><circle cx="12" cy="16" r="1.3" fill="#FF5D00"/><path fill="#FF5D00" d="M13.5 10c0-.83-.671-1.5-1.5-1.5a1.5 1.5 0 0 0-1.389 2.062C11.165 11.938 12 14 12 14l1.391-3.438c.068-.173.109-.363.109-.562"/></svg>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-xl w-110 h-55">
                <h1 class="font-semibold text-2xl p-2 ml-10 mt-10 text-[#7F7F7F]">Revisi</h1>
                <div class="flex gap-40 mt-5">
                    <p class="font-bold text-7xl p-2 ml-10 text-[#1D546D]">{{ $revisionRequestCount }}</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="84" height="84" viewBox="0 0 24 24"><path fill="#3B82F6" d="M5 21h14c1.1 0 2-.9 2-2v-7h-2v7H5V5h7V3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2"/><path fill="#3B82F6" d="M7 13v3c0 .55.45 1 1 1h3c.27 0 .52-.11.71-.29l9-9a.996.996 0 0 0 0-1.41l-3-3a.996.996 0 0 0-1.41 0l-9.01 8.99A1 1 0 0 0 7 13m10-7.59L18.59 7L17.5 8.09L15.91 6.5zm-8 8l5.5-5.5l1.59 1.59l-5.5 5.5H9z"/></svg>
                </div>
            </div>
        </div>

        <h1 class="text-white text-2xl font-semibold ml-75 mt-10">Draft Surat</h1>

        <div class="bg-[#061E29] shadow-lg  w-360 ml-75 rounded-2xl">
            <div class="mt-10 bg-white shadow-lg overflow-x-auto rounded-2xl">
            <table class="w-full text-left">
                <thead class="bg-[#061E29]">
                    <tr>
                        <th class="px-6 py-4 font-bold text-white text-md">No</th>
                        <th class="px-6 py-4 font-bold text-white text-md">Tanggal Agenda</th>
                        <th class="px-6 py-4 font-bold text-white text-md">Jenis Surat</th>
                        <th class="px-6 py-4 font-bold text-white text-md">Alamat Tujuan</th>
                        <th class="px-6 py-4 font-bold text-white text-md text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach ($draftLetter as $index => $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-gray-700">{{ $index + 1 }}</td>
                            {{-- Gunakan created_at karena di tabel letters gak ada kolom 'tanggal' --}}
                            <td class="px-6 py-4 text-gray-700">{{ $item->created_at->format('d F Y') }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $item->type }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $item->address }}</td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    // Logic warna berdasarkan Enum/Status
                                    $colorClass = $item->status->value === 'Draft' ? 'bg-yellow-100 text-yellow-600' : 'bg-blue-100 text-blue-600';
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
    </div>
</x-layouts.app>
