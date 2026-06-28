<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $user->name }} - {{ config('app.name', 'SkillSwap') }}</title>
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
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-gray-900">Dashboard</a>
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

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">&larr; Kembali ke Dashboard</a>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 h-32"></div>
            
            <div class="px-6 pb-6">
                <div class="flex flex-col items-center -mt-16 mb-6">
                    <div class="w-32 h-32 rounded-full bg-white flex items-center justify-center text-4xl font-bold text-gray-700 shadow-lg">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <h2 class="mt-4 text-3xl font-bold text-gray-900">{{ $user->name }}</h2>
                    <p class="text-gray-600">{{ $user->email }}</p>
                </div>

                <div class="grid md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-3">Informasi Akademik</h3>
                        @if ($user->prodi)
                            <div class="mb-2">
                                <span class="text-gray-600 text-sm">Program Studi:</span>
                                <p class="text-gray-900 font-medium">{{ $user->prodi }}</p>
                            </div>
                        @endif
                        @if ($user->semester)
                            <div class="mb-2">
                                <span class="text-gray-600 text-sm">Semester:</span>
                                <p class="text-gray-900 font-medium">{{ $user->semester }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-3">Kontak</h3>
                        @if ($user->whatsapp_number)
                            <div class="mb-2">
                                <span class="text-gray-600 text-sm">WhatsApp:</span>
                                <p class="text-gray-900 font-medium">{{ $user->whatsapp_number }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                            Keahlian yang Ditawarkan
                        </h3>
                        @if ($user->offeredSkills->isNotEmpty())
                            <div class="flex flex-wrap gap-3">
                                @foreach ($user->offeredSkills as $skill)
                                    <div class="bg-green-50 border border-green-200 rounded-lg px-4 py-3">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <div>
                                                <p class="font-semibold text-green-800">{{ $skill->skill_name }}</p>
                                                @if ($skill->category)
                                                    <p class="text-xs text-green-600">{{ $skill->category }}</p>
                                                @endif
                                                @if ($skill->pivot->proficiency_level)
                                                    <span class="text-xs bg-green-200 text-green-800 px-2 py-0.5 rounded-full mt-1 inline-block">
                                                        {{ ucfirst($skill->pivot->proficiency_level) }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 italic">Belum menambahkan keahlian yang ditawarkan</p>
                        @endif
                    </div>

                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <span class="w-3 h-3 bg-blue-500 rounded-full mr-2"></span>
                            Keahlian yang Dicari
                        </h3>
                        @if ($user->soughtSkills->isNotEmpty())
                            <div class="flex flex-wrap gap-3">
                                @foreach ($user->soughtSkills as $skill)
                                    <div class="bg-blue-50 border border-blue-200 rounded-lg px-4 py-3">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                            <div>
                                                <p class="font-semibold text-blue-800">{{ $skill->skill_name }}</p>
                                                @if ($skill->category)
                                                    <p class="text-xs text-blue-600">{{ $skill->category }}</p>
                                                @endif
                                                @if ($skill->pivot->proficiency_level)
                                                    <span class="text-xs bg-blue-200 text-blue-800 px-2 py-0.5 rounded-full mt-1 inline-block">
                                                        Target: {{ ucfirst($skill->pivot->proficiency_level) }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 italic">Belum menambahkan keahlian yang dicari</p>
                        @endif
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('swaps.create', $user->id) }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow transition duration-200 text-center">
                        Ajukan Swap
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>