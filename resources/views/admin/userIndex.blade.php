<x-layouts.app>
  <x-slot:title> 
    Dashboard Admin 
  </x-slot:title>
  
  <div class="w-full min-h-screen bg-gray-50">
    <div class="bg-white shadow-md w-full px-6 flex flex-row justify-between items-center">
      <img src="{{ asset('logo_smekten.png') }}" alt="Logo" class="w-16 h-16">
      <button type="button" 
        @click="$dispatch('open-logout-modal')" 
        class="flex bg-[#FF0000] hover:bg-red-700 transition w-40 h-10 rounded justify-center items-center cursor-pointer">
          <div class="flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                  <path fill="white" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h7v2H5v14h7v2zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z"/>
              </svg>
              <span class="text-white font-medium">Logout</span>
          </div>
      </button>
    </div>

    {{-- Alert Sukses --}}
    @if (session('success'))
        <div id="alert-success" class="flex items-center p-4 mb-6 text-green-800 border-t-4 border-green-300 bg-green-50 shadow-md rounded-lg" role="alert">
            <svg class="flex-shrink-0 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <div class="ml-3 text-sm font-medium">
                {{ session('success') }}
            </div>
            <button type="button" onclick="document.getElementById('alert-success').remove()" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" aria-label="Close">
                <span class="sr-only">Dismiss</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
      
    {{-- Alert Error (Opsional, untuk menangani Exception) --}}
    @if (session('error'))
        <div id="alert-error" class="flex items-center p-4 mb-6 text-red-800 border-t-4 border-red-300 bg-red-50 shadow-md rounded-lg" role="alert">
            <svg class="flex-shrink-0 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <div class="ml-3 text-sm font-medium">
                {{ session('error') }}
            </div>
            <button type="button" onclick="document.getElementById('alert-error').remove()" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
            </button>
        </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
      <div class="flex justify-end mb-4">
        <a href="{{ route('users.create') }}" class="mr-20 px-10 bg-[#1D546D] hover:bg-[#5F9598] text-white rounded-sm mt-5 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M13 6a1 1 0 1 0-2 0v5H6a1 1 0 1 0 0 2h5v5a1 1 0 1 0 2 0v-5h5a1 1 0 1 0 0-2h-5z" />
            </svg>
            <span class="text-xl font-semibold">Buat Akun</span>
        </a>
      </div>

      <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead class="bg-[#061E29]">
              <tr>
                <th class="px-6 py-4 font-bold text-white text-lg">ID</th>
                <th class="px-6 py-4 font-bold text-white text-lg">Nama</th>
                <th class="px-6 py-4 font-bold text-white text-lg">Role</th>
                <th class="px-6 py-4 font-bold text-white text-lg">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              @foreach ($users as $index => $item)
                <tr class="hover:bg-gray-50 transition">
                  <td class="px-6 py-4 text-gray-700 font-medium">{{ $index + 1 }}</td>
                  <td class="px-6 py-4 text-gray-700">{{ $item->name }}</td>
                  <td class="px-6 py-4 text-gray-700">
                    <span class="px-2 py-1 text-xs uppercase font-bold">
                      {{ $item->role }}
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex gap-3">
                      <a href="{{ route('users.edit', $item->id) }}" class="inline-block px-4 py-1.5 text-center rounded bg-[#38AC18] hover:bg-green-700 text-white text-sm font-semibold transition">
                        Edit
                      </a>
                      <button type="button" 
                              @click="$dispatch('open-delete-modal', { url: '{{ route('users.delete', $item->id) }}' })"
                              class="inline-block px-4 py-1.5 text-center rounded bg-[#FF0000] hover:bg-red-700 text-white text-sm font-semibold transition">
                          Hapus
                      </button>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-layouts.app>