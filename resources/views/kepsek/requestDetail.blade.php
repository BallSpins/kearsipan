<x-layouts.app>
    <x-slot:title>Detail Permintaan Persetujuan</x-slot:title>
    <x-sidebar.kepsek />

    {{-- <div class="bg-white shadow-xl">
        <h1 class="text-black ml-67 text-2xl font-bold">Kepala Sekolah</h1>
    </div> --}}

    <div class="mt-10 bg-white hover:bg-gray-200 rounded-xl w-40 ml-77 h-15 shadow-lg">
            <a href="{{ route('kepsek.incoming.view') }}"
             class="text-center items-center justify-center flex">
                <svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M12 9.059V6.5a1.001 1.001 0 0 0-1.707-.708L4 12l6.293 6.207a.997.997 0 0 0 1.414 0A1 1 0 0 0 12 17.5v-2.489c2.75.068 5.755.566 8 3.989v-1c0-4.633-3.5-8.443-8-8.941" />
                </svg>
                <h1 class="text-xl font-bold">KEMBALI</h1>
            </a>
        </div>

    <div class="pl-72 pr-10 py-10 flex flex-col gap-6" 
         x-data="{ 
            dispositions: [], 
            selectedWaka: '',
            addWaka() {
                if(!this.selectedWaka) return;
                const el = document.getElementById('waka-select');
                const name = el.options[el.selectedIndex].text;
                if(this.dispositions.find(d => d.receiver_id === this.selectedWaka)) {
                    alert('Waka ini sudah ditambahkan!');
                    return;
                }
                this.dispositions.push({
                    receiver_id: this.selectedWaka,
                    username: name,
                    instruction: ''
                });
                this.selectedWaka = '';
            },
            removeWaka(index) {
                this.dispositions.splice(index, 1);
            }
         }">

        <div class="bg-[#29627C] p-8 rounded-lg shadow-md w-full max-w-4xl mx-auto">
            <h2 class="text-2xl font-bold text-white mb-2">Disposisi</h2>
            <hr class="mb-6 border-gray-300">

            <form action="{{ route('kepsek.dispositions.store', $letter->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Download File Utama --}}
                <div class="flex flex-col gap-4">
                    <label for="" class="text-white mb-2 text-xl">Surat yang Disertakan</label>

                    <div class="flex flex-row gap-2">
                        <a 
                        @if ($letter->type === App\Enums\LetterType::OUTGOING)
                            href="{{ route('download.incoming', $letter->id) }}" {{-- Link download untuk surat keluar --}}
                        @else
                            href="{{ route('download.outgoing', $letter->id) }}" {{-- Link download --}}               
                        @endif
                            class="flex items-center gap-3 rounded-md bg-white hover:bg-gray-50 transition w-100 h-10 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24">
                                <path fill="#3B82F6" fill-rule="evenodd"
                                    d="M14.25 2.5a.25.25 0 0 0-.25-.25H7A2.75 2.75 0 0 0 4.25 5v14A2.75 2.75 0 0 0 7 21.75h10A2.75 2.75 0 0 0 19.75 19V9.147a.25.25 0 0 0-.25-.25H15a.75.75 0 0 1-.75-.75zm.75 9.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1 0-1.5zm0 4a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1 0-1.5z"
                                    clip-rule="evenodd" />
                                <path fill="#3B82F6"
                                    d="M15.75 2.824c0-.184.193-.301.336-.186q.182.147.323.342l3.013 4.197c.068.096-.006.22-.124.22H16a.25.25 0 0 1-.25-.25z" />
                            </svg>
    
                            Buka Surat
                        </a>
                        <a 
                        @if ($letter->type === App\Enums\LetterType::OUTGOING)
                            href="{{ route('download.incoming', $letter->id) }}" {{-- Link download untuk surat keluar --}}
                        @else
                            href="{{ route('download.outgoing', $letter->id) }}" {{-- Link download --}}               
                        @endif
                            class="bg-[#28A745] hover:bg-[#218838] text-white p-2 rounded-lg shadow-sm transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Download Lampiran --}}
                <div class="flex flex-col gap-4">
                    <label for="" class="text-white mb-2 text-xl">Lampiran</label>

                    <div class="flex flex-row gap-2">
                        <a 
                        @if (!$letter->attachments->first())
                            href="javascript:void(0)" {{-- Path kosong/tidak ke mana-mana --}}
                            class="flex items-center gap-3 rounded-md bg-white hover:bg-gray-50 transition w-100 h-10 p-2 opacity-45 cursor-not-allowed">
                        @elseif ($letter->type === App\Enums\LetterType::OUTGOING)
                            href="{{ route('download.incoming.attachment', $letter->attachments->first()->id) }}" 
                            class="flex items-center gap-3 rounded-md bg-white hover:bg-gray-50 transition w-100 h-10 p-2">
                        @else
                            href="{{ route('download.outgoing.attachment', $letter->attachments->first()->id) }}" {{-- Link download --}}               
                            class="flex items-center gap-3 rounded-md bg-white hover:bg-gray-50 transition w-100 h-10 p-2">
                        @endif
                            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24">
                                <path fill="#3B82F6" fill-rule="evenodd"
                                    d="M14.25 2.5a.25.25 0 0 0-.25-.25H7A2.75 2.75 0 0 0 4.25 5v14A2.75 2.75 0 0 0 7 21.75h10A2.75 2.75 0 0 0 19.75 19V9.147a.25.25 0 0 0-.25-.25H15a.75.75 0 0 1-.75-.75zm.75 9.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1 0-1.5zm0 4a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1 0-1.5z"
                                    clip-rule="evenodd" />
                                <path fill="#3B82F6"
                                    d="M15.75 2.824c0-.184.193-.301.336-.186q.182.147.323.342l3.013 4.197c.068.096-.006.22-.124.22H16a.25.25 0 0 1-.25-.25z" />
                            </svg>
    
                            Buka Lampiran
                        </a>
                        <a 
                        @if (!$letter->attachments->first())
                            href="javascript:void(0)" {{-- Path kosong/tidak ke mana-mana --}}
                            class="bg-[#28A745] cursor-not-allowed hover:bg-[#218838] text-white p-2 rounded-lg shadow-sm transition opacity-45">
                        @elseif ($letter->type === App\Enums\LetterType::OUTGOING)
                            href="{{ route('download.incoming.attachment', $letter->attachments->first()->id) }}" 
                            class="bg-[#28A745] hover:bg-[#218838] text-white p-2 rounded-lg shadow-sm transition">
                        @else
                            href="{{ route('download.outgoing.attachment', $letter->attachments->first()->id) }}" {{-- Link download --}}               
                            class="bg-[#28A745] hover:bg-[#218838] text-white p-2 rounded-lg shadow-sm transition">
                        @endif
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="p-4 rounded-lg">
                        <label class="block text-white font-semibold mb-2">Tambah Disposisi Waka</label>
                        <div class="flex gap-2">
                            <select id="waka-select" x-model="selectedWaka"
                                    class="rounded flex-1 h-10 p-2 bg-white focus:ring-2 focus:ring-blue-400">
                                <option value="" disabled selected>Pilih Waka</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                                @endforeach
                            </select>
                            <button type="button" @click="addWaka()" class="bg-blue-600 hover:bg-blue-700 px-6 text-white rounded-md cursor-pointer">Pilih</button>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <template x-for="(item, index) in dispositions" :key="item.receiver_id">
                            <div class="flex flex-col p-4 border borde-white rounded-lg bg-gray-50">
                                <label class="text-sm font-bold text-white mb-1">
                                    Instruksi untuk: <span x-text="item.username"></span>
                                </label>
                                <input type="hidden" :name="`dispositions[${index}][receiver_id]`" :value="item.receiver_id">
                                <div class="flex flex-row gap-2">
                                    <textarea :name="`dispositions[${index}][instruction]`" x-model="item.instruction"
                                        placeholder="Tulis instruksi/perintah..."
                                        class="flex-1 border border-gray-400 rounded-md p-3 bg-white focus:ring-2 focus:ring-blue-400"
                                        required></textarea>
                                    <button type="button" @click="removeWaka(index)" class="bg-red-600 hover:bg-red-700 px-6 text-white rounded-md h-12 self-end">Hapus</button>
                                </div>
                            </div>
                        </template>
                    </div>

                    <template x-if="dispositions.length === 0">
                        <div class="text-center py-4 text-gray-400 border-2 border-dashed rounded-lg">
                            Belum ada waka yang dipilih.
                        </div>
                    </template>
                </div>

                <div class="flex justify-end mt-12">
                    <button type="submit" x-show="dispositions.length > 0"
                        class="bg-[#10B981] hover:bg-[#059669] text-white px-8 py-2.5 rounded-md font-medium shadow-[0_4px_0_rgb(5,150,105)] active:shadow-none active:translate-y-[2px] transition-all">
                        Kirim Disposisi
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>