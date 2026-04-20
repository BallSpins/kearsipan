<x-layouts.sidebar>
        @php
    $activeClass = 'bg-[#5F9598]/20 border-l-4 border-[#1D546D] text-[#5F9598]';
    $inactiveClass = 'border-l-4 border-transparent text-white hover:bg-white/5';
@endphp

    <a href="{{ route('kepsek.dashboardkep.view') }}" class="flex px-4 py-2 p-4 {{ request()->routeIs('kepsek.dashboardkep.view') ? $activeClass : $inactiveClass }}">
        <div class="justify-center flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24"><path fill="#fff" d="M4 19v-9q0-.475.213-.9t.587-.7l6-4.5q.525-.4 1.2-.4t1.2.4l6 4.5q.375.275.588.7T20 10v9q0 .825-.588 1.413T18 21h-3q-.425 0-.712-.288T14 20v-5q0-.425-.288-.712T13 14h-2q-.425 0-.712.288T10 15v5q0 .425-.288.713T9 21H6q-.825 0-1.412-.587T4 19"/></svg>
            <h-1 class="text-xl">Dashboard</h-1>
        </div>
    </a>
    <a href="{{ route('kepsek.outgoing.sign.view') }}" class="flex px-4 py-2 p-4 {{ request()->routeIs('kepsek.outgoing.sign.view') ? $activeClass : $inactiveClass }}">
        <div class="justify-center flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3V1h6v2zm2 11h2V8h-2zm-2.488 7.288q-1.637-.713-2.862-1.938t-1.937-2.863T3 13t.713-3.488T5.65 6.65t2.863-1.937T12 4q1.55 0 2.975.5t2.675 1.45l1.4-1.4l1.4 1.4l-1.4 1.4Q20 8.6 20.5 10.025T21 13q0 1.85-.713 3.488T18.35 19.35t-2.863 1.938T12 22t-3.488-.712"/></svg>
            <h-1 class="text-xl">Permintaan ACC</h-1>
        </div>
    </a>
    <a href="{{ route('kepsek.incoming.view') }}" class="flex px-4 py-2 p-4 {{ request()->routeIs('kepsek.incoming.view') ? $activeClass : $inactiveClass }}">
        <div class="justify-center flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 48 48"><g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="4"><path stroke-linecap="round" d="m5 30l5-24h28l5 24"/><path fill="currentColor" d="M5 30h9.91l1.817 6h14.546l1.818-6H43v13H5z"/><path stroke-linecap="round" d="m18 20l6 6l6-6m-6 6V14"/></g></svg>
            <h1 class="text-xl">Surat Masuk</h1>
        </div>
    </a>
    <button type="button" 
        @click="$dispatch('open-logout-modal')" 
        class="flex bg-[#FF0000] w-40 h-10 rounded ml-10 mt-130 px-8 cursor-pointer">
          <div class="flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                  <path fill="white" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h7v2H5v14h7v2zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z"/>
              </svg>
              <span class="text-white font-medium">Logout</span>
          </div>
      </button>
</x-layouts.sidebar>