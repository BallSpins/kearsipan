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
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div @click.away="open = false" class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6 border border-red-800">
                    <div>
                        <div class="mt-3 text-center sm:mt-5">
                            <h3 class="text-2xl font-bold leading-6 text-red-600 mb-8">
                                Anda Yakin Ingin Logout
                            </h3>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-6 flex gap-3 justify-center">
                        <button type="button" 
                                @click="open = false"
                                class="inline-flex w-32 justify-center rounded-md bg-[#5D9FD6] px-3 py-2 text-xl font-semibold text-white shadow-sm hover:bg-blue-500">
                            Batal
                        </button>
                        <a 
                            href="{{ route('logout') }}" 
                            class="inline-flex w-32 justify-center rounded-md bg-[#48B02C] px-3 py-2 text-xl font-semibold text-white shadow-sm hover:bg-green-700"
                            >Logout</a>
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