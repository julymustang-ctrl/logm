<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Giriş | LOG Makine</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-primary-800 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <div class="text-center mb-8">
                <img src="{{ asset('images/logo.png') }}" alt="LOG Makine" class="h-16 mx-auto mb-4">
                <h1 class="text-2xl font-bold text-primary-800">Admin Paneli</h1>
                <p class="text-gray-500 mt-2">Yönetim paneline giriş yapın</p>
            </div>

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">E-posta</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Şifre</label>
                    <input type="password" name="password" id="password" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" 
                           class="w-4 h-4 text-accent-600 border-gray-300 rounded focus:ring-accent-500">
                    <label for="remember" class="ml-2 text-sm text-gray-600">Beni hatırla</label>
                </div>

                <button type="submit" class="w-full bg-accent-500 hover:bg-accent-600 text-white font-semibold py-3 px-4 rounded-lg transition duration-200">
                    Giriş Yap
                </button>
            </form>
        </div>

        <p class="text-center text-primary-300 text-sm mt-6">
            © {{ date('Y') }} LOG Makine A.Ş.
        </p>
    </div>
</body>
</html>
