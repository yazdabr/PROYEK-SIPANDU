<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPANDU - Login</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex items-center justify-center bg-cover bg-center" 
      style="background-color: #EDF2F9;">

    <div class="w-full max-w-md flex flex-col items-center">
        <!-- Logo di luar card -->
        <div class="flex flex-col items-center mb-6">
            <img src="/images/logorri.png" alt="Logo RRI" class="w-50 h-20 mb-8">
            <!-- <h1 class="text-4xl font-bold text-blue-500 drop-shadow mb-2">SIPANDU</h1> -->
        </div>

        <!-- Card Login -->
        <div class="bg-white/95 rounded-xl shadow-[0_10px_30px_rgba(0,0,0,0.45)] w-full p-8 mb-4">
            
            <!-- Judul -->
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-1">Selamat Datang</h2>
            <p class="text-sm font-semibold text-gray-500 pb-3">Silahkan Masuk Ke Akun Anda</p>

            <!-- Garis abu-abu pendek -->
            <div class="mx-auto mt-4 w-40 border-b-3 border-gray-400"></div>
        </div>

        @if ($errors->any())
            <div class="mb-4 text-red-600 text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form method="POST" action="{{ route('login.process') }}" class="space-y-5">
            @csrf
            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" required autofocus
                    class="w-full rounded-md border border-gray-300 pl-3 pr-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" type="password" required
                    class="w-full rounded-md border border-gray-300 pl-3 pr-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Tombol -->
            <button type="submit"
                    class="w-full bg-[#68778B] text-white py-2 rounded-md font-semibold hover:bg-[#003B69] transition">
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
