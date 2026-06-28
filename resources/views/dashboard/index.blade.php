<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - {{ config('app.name', 'SkillSwap') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-900">SkillSwap</h1>
                </div>
                <nav class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-gray-900 font-medium">Dashboard</a>
                    <a href="{{ route('swaps.index') }}" class="text-gray-700 hover:text-gray-900">My Swaps</a>
                    <a href="{{ route('profile.edit') }}" class="text-gray-700 hover:text-gray-900">Profil Saya</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-gray-900">Logout</button>
                    </form>
                </nav>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Daftar User</h2>
            <p class="text-gray-600 mt-1">Temukan partner pertukaran keahlian</p>
        </div>

        @if ($users->isEmpty())
            <div class="bg-white rounded-lg shadow p-8 text-center">
                <p class="text-gray-500">Belum ada user terdaftar.</p>
            </div>
        @else
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($users as $user)
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h3>
                            <span class="text-sm text-gray-500">{{ $user->email }}</span>
                        </div>

                        @if ($user->prodi || $user->semester)
                            <div class="mb-4 text-sm text-gray-600">
                                @if ($user->prodi)
                                    <p>Prodi: {{ $user->prodi }}</p>
                                @endif
                                @if ($user->semester)
                                    <p>Semester: {{ $user->semester }}</p>
                                @endif
                            </div>
                        @endif

                        @if ($user->offeredSkills->isNotEmpty())
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-green-700 mb-2">Menawarkan:</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($user->offeredSkills as $skill)
                                        <span class="inline-block px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                            {{ $skill->skill_name }}
                                            @if ($skill->pivot->proficiency_level)
                                                <span class="ml-1 opacity-75">({{ $skill->pivot->proficiency_level }})</span>
                                            @endif
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($user->soughtSkills->isNotEmpty())
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-blue-700 mb-2">Mencari:</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($user->soughtSkills as $skill)
                                        <span class="inline-block px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                            {{ $skill->skill_name }}
                                            @if ($skill->pivot->proficiency_level)
                                                <span class="ml-1 opacity-75">({{ $skill->pivot->proficiency_level }})</span>
                                            @endif
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($user->offeredSkills->isEmpty() && $user->soughtSkills->isEmpty())
                            <p class="text-sm text-gray-500 italic">Belum menambahkan keahlian</p>
                        @endif

                        <div class="pt-4 border-t border-gray-100">
                            <a href="{{ route('users.show', $user->id) }}" class="text-sm text-blue-600 hover:underline">Lihat Profil</a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{ $users->links() }}
        @endif
    </main>
</body>
</html>