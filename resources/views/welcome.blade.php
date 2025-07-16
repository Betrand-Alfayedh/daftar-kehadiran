<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kehadiran Mahasiswa</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">

    <div class="text-center space-y-6">
        <h1 class="text-4xl md:text-5xl font-bold drop-shadow-lg">
            Daftar Kehadiran Mahasiswa
        </h1>
        <p class="text-gray-400 text-lg">
            Selamat datang! Silakan login untuk mengakses sistem.
        </p>
        <a href="{{ route('login') }}"
           class="inline-block bg-indigo-600 hover:bg-indigo-700 transition duration-300 px-6 py-3 rounded-full text-lg font-semibold shadow-lg">
            Masuk ->
        </a>
    </div>

</body>
</html>
