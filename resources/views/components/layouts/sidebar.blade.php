<div class="fixed left-0 top-0 h-[calc(100vh-2rem)] w-64 bg-[#061E29] flex flex-col m-4 rounded-2xl overflow-hidden shadow-2xl">
    <div class=" flex items-center mt-2 p-2">
        <img src="{{ asset('logo_smekten.png') }}" alt="" class="w-12 h-12 object-contain">
        <span class="ml-2 font-bold text-4xl text-white">ARCHTEN</span>
    </div>
    <div class="px-6 py-2">
        <p class="text-gray-500 text-sm font-semibold uppercase">Menu</p>
    </div>

    <nav class="flex-1 py-4  space-y-2 overflow-y-auto text-white">
        {{ $slot }}
    </nav>
</div>