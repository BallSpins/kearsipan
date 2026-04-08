<div class="fixed left-0 top-0 h-screen w-64 bg-[#1D546D] flex flex-col">
    <div class=" flex mt-2">
        <img src="{{ asset('logo_smekten.png') }}" alt="" class="w-16">
        <span class="ml-3 font-bold text-4xl text-white mt-2">Archive</span>
    </div>

    <nav class="flex-1 py-4  space-y-2 overflow-y-auto text-white">
        {{ $slot }}
    </nav>
</div>