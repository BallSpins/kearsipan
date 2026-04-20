<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? config('app.name') }}</title>

    <style> [x-cloak] { display: none !important; } </style>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#1E3F4D]">
    <div x-data="{}"> 
        {{ $slot }}
    </div>

    <div x-data="{ open: false }" 
        @open-logout-modal.window="open = true" 
        class="relative z-50" 
        style="display: none;" 
        x-show="open">
    
        <div class="fixed inset-0 bg-gray-500 opacity-50 transition-opacity"></div>
    
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center py-4 text-center sm:items-center sm:p-0">
                <div @click.away="open = false" class="relative transform overflow-hidden rounded-lg bg-white pb-10 px-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                    <div class="flex justify-center items-center">
                       <svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="#FF0000" d="M16 3.77v16.46a1.5 1.5 0 0 1-1.747 1.479l-8.582-1.43A2 2 0 0 1 4 18.306V5.694a2 2 0 0 1 1.671-1.973l8.582-1.43A1.5 1.5 0 0 1 16 3.771ZM18 5a2 2 0 0 1 1.995 1.85L20 7v10a2 2 0 0 1-1.85 1.995L18 19h-1V5zm-6.5 5.5a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3"/></g></svg>
                    </div>
                    <div>
                        <div class="mt-3 text-center sm:mt-5">
                            <h3 class="text-2xl font-bold leading-6 text-black mb-8">
                                Pastikan semua pekerjaanmu sudah tersimpan, ya. Sampai jumpa lagi!
                            </h3>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-6 flex gap-3 justify-center flex-col items-center">
                        <a 
                            href="{{ route('logout') }}" 
                            class="inline-flex w-64 justify-center bg-[#FF0000] px-8 py-4 text-xl font-semibold text-white shadow-sm hover:bg-[#FF0000]/80 rounded-3xl"
                            >Iya Keluar
                        </a>
                        <button type="button" 
                                @click="open = false"
                                class="inline-flex w-64 justify-center text-xl font-semibold text-black shadow-sm">
                            Kembali Ke Dashboard
                        </button>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-data="{ open: false, postUrl: '' }" 
        @open-delete-modal.window="open = true; postUrl = $event.detail.url" 
        class="relative z-50" 
        x-show="open" 
        x-cloak>
    
        <div class="fixed inset-0 bg-gray-500 opacity-50 transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div @click.away="open = false" class="relative bg-white rounded-lg px-4 pb-4 pt-5 shadow-xl sm:w-full sm:max-w-sm border border-red-800">
                    <div class="text-center">
                        <h3 class="text-2xl font-bold text-red-600 mb-8">
                            Yakin Ingin Menghapus?
                        </h3>
                    </div>
                    <div class="mt-5 flex gap-3 justify-center">
                        <button type="button" @click="open = false" 
                                class="w-32 rounded-md bg-[#5D9FD6] px-3 py-2 text-xl font-semibold text-white">
                            Batal
                        </button>

                        <form :action="postUrl" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-32 rounded-md bg-red-600 px-3 py-2 text-xl font-semibold text-white hover:bg-red-800">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>