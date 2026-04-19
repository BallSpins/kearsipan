<x-layouts.app>
    <x-slot:title>
        Kelola User
    </x-slot:title>
    <x-sidebar.tu />
    
    <div class="bg-white shadow-xl">
        <h1 class="text-black ml-67 text-2xl font-bold">Kepala Tata Usaha</h1>
    </div>

    {{-- Alert Sukses --}}
    @if (session()->has('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                window.notyf.success("{{ session('success') }}");
            });
        </script>
    @endif
      
    {{-- Alert Error (Opsional, untuk menangani Exception) --}}
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Looping karena $errors isinya array
                @foreach ($errors->all() as $error)
                    window.notyf.error("{{ $error }}");
                @endforeach
            });
        </script>
    @endif

    <div class="flex justify-end mb-4">
        <a href="{{ route('users.create') }}" class="mr-20 px-10 bg-[#1D546D] hover:bg-[#5F9598] text-white rounded-sm mt-5 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M13 6a1 1 0 1 0-2 0v5H6a1 1 0 1 0 0 2h5v5a1 1 0 1 0 2 0v-5h5a1 1 0 1 0 0-2h-5z" />
            </svg>
            <span class="text-xl font-semibold">Buat Akun</span>
        </a>
      </div>

    <div class="mt-10 bg-white shadow-lg overflow-x-auto border border-gray-200 ml-75 mr-20">
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
        <div class="bg-white px-6 py-4 mr-8">
            {{ $users->links('pagination::tailwind') }}
        </div>
</x-layouts.app>
