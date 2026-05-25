<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="text-center p-6 bg-white rounded-lg shadow-md max-w-md">
        <h1 class="text-6xl font-bold text-red-500 mb-4">404</h1>
        <p class="text-xl font-semibold text-gray-850 mb-2">{{ $message ?? 'Halaman tidak ditemukan.' }}</p>
        <p class="text-gray-600 mb-6">Maaf, halaman yang Anda tuju tidak ada atau telah dipindahkan.</p>
        
        @if(isset($suggestions))
            <div class="text-left mb-6">
                <p class="font-medium text-gray-700 mb-2">Mungkin yang Anda cari:</p>
                <ul class="list-disc pl-5 space-y-1 text-blue-600">
                    @foreach($suggestions as $item)
                        <li><a href="{{ $item['url'] }}" class="hover:underline">{{ $item['text'] }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <a href="{{ url('/') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Kembali ke Beranda
        </a>
    </div>
</body>
</html>