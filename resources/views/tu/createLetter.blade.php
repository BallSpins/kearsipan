@foreach ($requests as $request)
  <p>{{ $request->subject }}</p>
  <p>{{ $request->description }}</p>
@endforeach
<x-layouts.app>
      <x-slot:title>
        Surat Masuk
    </x-slot:title>
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
            <a href="{{ route('') }}" class="flex px-4 py-2 rounded {{ request()->routeIs('') ? 'bg-[#5F9598] ' : 'hover:bg-[#5F9598]' }}">
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
</x-layouts.app>