<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPANDU - Login</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex items-center justify-center bg-cover bg-center" 
      style="background-image: url('/images/bg.png')">

    <div class="w-full max-w-md flex flex-col items-center">
        <!-- Logo di luar card -->
        <div class="flex flex-col items-center mb-4">
            <img src="/images/logorri.png" alt="Logo RRI" class="w-28 h-20 mb-5">
            <h1 class="text-2xl font-bold text-black drop-shadow mb-2">SIPANDU</h1>
        </div>

        <!-- Card Login -->
        <div class="bg-white/95 rounded-xl shadow-[0_10px_30px_rgba(0,0,0,0.45)] w-full p-8">
            
            <!-- Judul -->
        <div class="text-center mb-6 pb-1">
            <h2 class="text-lg font-semibold text-gray-900">Selamat Datang Kembali</h2>
            <p class="text-sm text-gray-500">Silahkan masuk ke akun Anda</p>

            <!-- Garis abu-abu pendek -->
            <div class="mx-auto mt-4 w-30 border-b-3 border-gray-400"></div>
        </div>



            <!-- Form -->
            <form class="space-y-5">
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email/NIP</label>
                    <div class="relative mt-1">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <!-- Icon email -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 12H8m0 0l-4-4m4 4l-4 4m12-4h4m0 0l-4-4m4 4l-4 4"/>
                            </svg>
                        </span>
                        <input id="email" type="email" placeholder="Masukkan Email"
                               class="w-full rounded-md border border-gray-300 pl-10 pr-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative mt-1">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <!-- Icon lock -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 11c.667 0 2 0 2-2V7a4 4 0 00-8 0v2c0 2 1.333 2 2 2m-4 4h12v6H4v-6z"/>
                            </svg>
                        </span>
                        <input id="password" type="password" placeholder="Masukkan Password"
                               class="w-full rounded-md border border-gray-300 pl-10 pr-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="flex justify-end mt-1">
                        <a href="#" class="text-sm text-blue-600 hover:underline">Lupa Password?</a>
                    </div>
                </div>

                <!-- Ingat Saya -->
                <div class="flex items-center">
                    <input id="remember" type="checkbox"
                           class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-700">Ingat Saya</label>
                </div>

                <!-- Tombol -->
                <button type="button"
                        class="w-full bg-blue-700 text-white py-2 rounded-md font-semibold hover:bg-blue-800 transition">
                    Masuk
                </button>
            </form>

            <!-- Footer -->
            <p class="mt-6 text-center text-xs text-gray-500">
                Radio Republik Indonesia (RRI Banjarmasin)
            </p>
        </div>
    </div>

</body>
</html>
