<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List Produk</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">

    <div class="ml-10 mt-10">
        <h1 class="text-xl font-bold mb-4">Daftar Produk</h1>

        <table class="min-w-full border border-gray-300 shadow-md rounded-lg overflow-hidden text-sm">
            <thead class="bg-pink-500 text-white uppercase">
                <tr>
                    <th class="px-6 py-3 border-r">No</th>
                    <th class="px-6 py-3 border-r">Nama Produk</th>
                    <th class="px-6 py-3 border-r">Deskripsi Produk</th>
                    <th class="px-6 py-3">Harga Produk</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($nama as $index => $item)
                <tr class="hover:bg-gray-100 transition-colors">
                    <td class="px-6 py-4 border-t border-gray-200">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 border-t border-gray-200 font-medium">{{ $item }}</td>
                    <td class="px-6 py-4 border-t border-gray-200">{{ $desc[$index] }}</td>
                    <td class="px-6 py-4 border-t border-gray-200 text-right">Rp{{ number_format($harga[$index], 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
