<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PORTAL DATA TERPADU - Login</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-image: linear-gradient(135deg, #DBE5F4 0%, #DBE5F4 100%);
        }
        .login-card {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.85);
            transition: all 0.3s ease-in-out;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15); /* tebal */
        }

        .btn-submit {
            background-image: linear-gradient(135deg, #003B69 0%, #005191 100%);
            transition: all 0.3s ease-in-out;
        }
        .btn-submit:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.25);
            background-image: linear-gradient(135deg, #004D8C 0%, #006FB3 100%);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 sm:p-6 md:p-8">

    <div class="w-full max-w-sm sm:max-w-md flex flex-col items-center">
        <!-- Logo di luar card -->
        <div class="flex flex-col items-center mb-6 sm:mb-10">
            <!--
                Catatan: Ganti URL gambar di bawah ini dengan URL logo RRI yang asli.
                Sebagai contoh, saya menggunakan placeholder.
            -->
            <img src="/images/logorri.png" alt="Logo RRI" class="w-40 h-auto mb-4">
        </div>

        <!-- Card Login -->
        <div class="login-card rounded-2xl s w-full p-6 sm:p-8 md:p-12">
            
            <!-- Judul -->
            <div class="text-center mb-6 pb-4">
                <h2 class="text-2xl font-bold text-gray-800 mb-1">Selamat Datang</h2>
                <p class="text-base font-semibold text-gray-500">Silakan Masuk Ke Akun Anda</p>
                <div class="w-1/2 mx-auto border-b border-gray-400 mt-4"></div>
            </div>
            
            <!-- Contoh Tampilan Pesan Error
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-5" role="alert">
                <strong class="font-bold">Gagal masuk!</strong>
                <span class="block sm:inline">Periksa kembali email dan kata sandi Anda.</span>
            </div> -->

            <form action="{{ route('login.process') }}" method="POST" class="space-y-6">
                @csrf
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <input id="email" name="email" type="email" required autofocus
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Kata Sandi</label>
                    <input id="password" name="password" type="password" required
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition">
                </div>

                <!-- Tombol -->
                <button type="submit"
                        class="btn-submit w-full text-white py-3 rounded-xl font-bold text-lg shadow-lg">
                    Masuk
                </button>
            </form>

            
            <!-- Footer -->
            <p class="mt-6 text-center text-xs text-gray-500 font-medium">
                Radio Republik Indonesia (RRI Banjarmasin)
            </p>
        </div>
    </div>

</body>
</html>
