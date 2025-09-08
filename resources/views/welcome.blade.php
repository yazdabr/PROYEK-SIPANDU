<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel + Tailwind</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="text-center">
        <h1 class="text-4xl font-bold text-blue-600 mb-4">
            Hello, Tailwind is Working! 🎉
        </h1>
        <p class="text-gray-700">
            Kalau kamu melihat teks ini berwarna biru & layout rapi, berarti Tailwind sudah aktif.
        </p>
        <button class="mt-6 px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
            Coba Kl
