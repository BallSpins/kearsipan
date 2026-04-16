<div>
    <!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->
</div>
halohalo tes

{{-- @foreach ($users as $user)
    <p>{{ $user->name }} - {{ $user->username }}</p>
@endforeach --}}

<label for="" class="text-[#7E95DB] mb-2 text-xl">Surat yang disertakan</label>
<div class="flex flex-row gap-4">
  <div
      class="relative border border-black rounded-lg w-full h-20 flex items-center justify-center bg-white">
      
      <svg xmlns="http://www.w3.org/2000/svg" class="w-15 h-15 text-[#4285F4]" viewBox="0 0 24 24"
          fill="currentColor">
          <path
              d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
      </svg>
      
  </div>
    <div class="my-auto">
        @php
            $hasFile = !empty($request->file_path);
        @endphp
        <a 
        @if($hasFile)
            href="{{ route('download.outgoing', $request->id) }}"
        @else
            href="javascript:void(0)" {{-- Path kosong/tidak ke mana-mana --}}
        @endif
        class="p-2 rounded-xl shadow-md flex items-center justify-center transition 
        {{ $hasFile 
           ? 'bg-[#28A745] hover:bg-[#218838] text-white' 
           : 'bg-gray-400 text-gray-200 cursor-not-allowed opacity-50 pointer-events-none' }}"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
        </a>
    </div>
</div>

<label for="" class="text-[#7E95DB] mb-2 text-xl">Lampiran</label>
<div class="flex flex-row gap-4">
  <div
      class="relative border border-black rounded-lg w-full h-20 flex items-center justify-center bg-white">
      
      <svg xmlns="http://www.w3.org/2000/svg" class="w-15 h-15 text-[#4285F4]" viewBox="0 0 24 24"
          fill="currentColor">
          <path
              d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
      </svg>
      
  </div>
    <div class="my-auto">
        @php
            $hasFile = !empty($request->attachments->first()->file_path);
        @endphp
        <a 
        @if($hasFile)
            href="{{ route('download.outgoing.attachment', $request->attachments->first()->id) }}"
        @else
            href="javascript:void(0)" {{-- Path kosong/tidak ke mana-mana --}}
        @endif
        class="p-2 rounded-xl shadow-md flex items-center justify-center transition 
        {{ $hasFile 
           ? 'bg-[#28A745] hover:bg-[#218838] text-white' 
           : 'bg-gray-400 text-gray-200 cursor-not-allowed opacity-50 pointer-events-none' }}"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
        </a>
    </div>
</div>

<div class="bg-white rounded-md shadow-xl w-150 h-110 ml-auto mr-20 p-8">
    <h1 class="text-4xl font-semibold mb-4">Revisi</h1>
    <div class=" w-full border border-gray-300 mb-15"></div>
    <h1 class="font-semibold mt-5 text-2xl">Catatan</h1>
    <textarea name="" class="bg-[#F2F2F2] w-full h-40 rounded p-2 resize-none border" id="" cols="30" rows="10"></textarea>
</div>

{{-- Download File Utama --}}
<div class="flex flex-col gap-4">
    <label for="" class="text-[#484848] mb-2 text-xl">Surat yang Disertakan</label>
    <div class="flex flex-row gap-2">
        <a 
        @if ($letter->type === App\Enums\LetterType::OUTGOING)
            href="{{ route('download.incoming', $letter->id) }}" {{-- Link download untuk surat keluar --}}
        @else
            href="{{ route('download.outgoing', $letter->id) }}" {{-- Link download --}}               
        @endif
            class="flex items-center gap-3 border rounded-md bg-white hover:bg-gray-50 transition w-100 h-10 p-2">
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
    <label for="" class="text-[#484848] mb-2 text-xl">Lampiran</label>
    <div class="flex flex-row gap-2">
        <a 
        @if (!$letter->attachments->first())
            href="javascript:void(0)" {{-- Path kosong/tidak ke mana-mana --}}
            class="flex items-center gap-3 border rounded-md bg-white hover:bg-gray-50 transition w-100 h-10 p-2 opacity-45 cursor-not-allowed">
        @elseif ($letter->type === App\Enums\LetterType::OUTGOING)
            href="{{ route('download.incoming.attachment', $letter->attachments->first()->id) }}" 
            class="flex items-center gap-3 border rounded-md bg-white hover:bg-gray-50 transition w-100 h-10 p-2">
        @else
            href="{{ route('download.outgoing.attachment', $letter->attachments->first()->id) }}" {{-- Link download --}}               
            class="flex items-center gap-3 border rounded-md bg-white hover:bg-gray-50 transition w-100 h-10 p-2">
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