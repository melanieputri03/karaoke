<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Daftar Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .btn-pink {
            background-color: #ec4899;
            color: white;
        }
        .btn-pink:hover {
            background-color: #db2777;
        }
        .btn-yellow {
            background-color: #facc15;
            color: white;
        }
        .btn-yellow:hover {
            background-color: #eab308;
        }
        .btn-gray {
            background-color: #6b7280;
            color: white;
        }
        .btn-gray:hover {
            background-color: #4b5563;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">

    <div class="mt-10 max-w-5xl mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-pink-600">Daftar Produk</h1>
            <button onclick="openAddModal()" 
                    class="btn-pink font-bold py-2 px-4 rounded-lg shadow-md hover:shadow-lg transition-all flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Produk
            </button>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-pink-100 border-l-4 border-pink-500 text-pink-700 rounded">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-10">
            <table class="min-w-full">
                <thead class="bg-pink-600 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold uppercase">No</th>
                        <th class="px-6 py-4 text-left font-semibold uppercase">Nama Produk</th>
                        <th class="px-6 py-4 text-left font-semibold uppercase">Deskripsi</th>
                        <th class="px-6 py-4 text-right font-semibold uppercase">Harga</th>
                        <th class="px-6 py-4 text-center font-semibold uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($produk as $index => $item)
                        <tr class="hover:bg-pink-50 transition-colors">
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-medium">{{ $item->nama }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $item->deskripsi }}</td>
                            <td class="px-6 py-4 text-right font-medium">Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center space-x-2">
                                    <button onclick="openEditModal({{ $item->id }}, '{{ $item->nama }}', '{{ $item->deskripsi }}', {{ $item->harga }})"
                                       class="btn-yellow px-3 py-1 rounded-md text-sm font-medium shadow-sm">
                                        Edit
                                    </button>
                                    <form action="{{ route('produk.delete', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus {{ $item->nama }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm font-medium shadow-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada data produk</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Produk -->
    <div id="addModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-pink-600">Tambah Produk Baru</h2>
                    <button onclick="closeAddModal()" class="text-gray-400 hover:text-pink-600 text-2xl font-bold">
                        &times;
                    </button>
                </div>
                
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('produk.simpan') }}">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1" for="add_nama">Nama Produk</label>
                            <input type="text" id="add_nama" name="nama" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                   required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1" for="add_deskripsi">Deskripsi</label>
                            <textarea id="add_deskripsi" name="deskripsi" 
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1" for="add_harga">Harga</label>
                            <input type="number" id="add_harga" name="harga" min="0" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                   required>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeAddModal()" 
                                class="btn-gray font-medium py-2 px-4 rounded-lg">
                            Batal
                        </button>
                        <button type="submit" 
                                class="btn-pink font-medium py-2 px-4 rounded-lg shadow-md hover:shadow-lg">
                            Simpan Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Produk -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-pink-600">Edit Produk</h2>
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-pink-600 text-2xl font-bold">
                        &times;
                    </button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1" for="edit_nama">Nama Produk</label>
                            <input type="text" id="edit_nama" name="nama" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                   required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1" for="edit_deskripsi">Deskripsi</label>
                            <textarea id="edit_deskripsi" name="deskripsi" 
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1" for="edit_harga">Harga</label>
                            <input type="number" id="edit_harga" name="harga" min="0" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                   required>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeEditModal()" 
                                class="btn-gray font-medium py-2 px-4 rounded-lg">
                            Batal
                        </button>
                        <button type="submit" 
                                class="btn-pink font-medium py-2 px-4 rounded-lg shadow-md hover:shadow-lg">
                            Update Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        // Add Product Modal Functions
        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
            document.getElementById('addModal').classList.add('flex');
            document.getElementById('add_nama').focus();
        }

        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
            document.getElementById('addModal').classList.remove('flex');
        }

        // Edit Product Modal Functions
        function openEditModal(id, nama, deskripsi, harga) {
            document.getElementById('editForm').action = `/produk/${id}`;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_deskripsi').value = deskripsi;
            document.getElementById('edit_harga').value = harga;
            
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');
            document.getElementById('edit_nama').focus();
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.getElementById('editModal').classList.remove('flex');
        }

        // Close modals when clicking outside
        document.getElementById('addModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAddModal();
            }
        });

        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });
    </script>

</body>
</html>