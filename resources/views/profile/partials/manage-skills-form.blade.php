<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Kelola Keahlian') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Tambahkan keahlian yang Anda tawarkan atau cari untuk bertukar dengan pengguna lain.') }}
        </p>
    </header>

    @if (session('success'))
        <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mt-4 p-4 bg-red-100 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <form method="post" action="{{ route('profile.skills.store') }}" class="mt-6 space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <x-input-label for="skill_id" :value="__('Pilih Keahlian')" />
                <select id="skill_id" name="skill_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="">-- Pilih Skill --</option>
                    @foreach ($skills->groupBy('category') as $category => $categorySkills)
                        <optgroup label="{{ $category }}">
                            @foreach ($categorySkills as $skill)
                                <option value="{{ $skill->id }}">{{ $skill->skill_name }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('skill_id')" />
            </div>

            <div>
                <x-input-label for="type" :value="__('Tipe')" />
                <select id="type" name="type" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="">-- Pilih Tipe --</option>
                    <option value="offer">Ditawarkan</option>
                    <option value="seek">Dicari</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('type')" />
            </div>

            <div>
                <x-input-label for="proficiency_level" :value="__('Level')" />
                <select id="proficiency_level" name="proficiency_level" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="">-- Pilih Level --</option>
                    <option value="beginner">Beginner</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="expert">Expert</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('proficiency_level')" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Tambah Keahlian') }}</x-primary-button>
        </div>
    </form>

    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h3 class="text-md font-semibold text-green-700 mb-4">Keahlian yang Ditawarkan</h3>
            @if ($user->offeredSkills->isNotEmpty())
                <div class="space-y-2">
                    @foreach ($user->offeredSkills as $skill)
                        <div class="flex items-center justify-between p-3 bg-green-50 border border-green-200 rounded-lg">
                            <div>
                                <p class="font-medium text-green-900">{{ $skill->skill_name }}</p>
                                <p class="text-xs text-green-600">{{ $skill->category }} • {{ ucfirst($skill->pivot->proficiency_level) }}</p>
                            </div>
                            <form method="post" action="{{ route('profile.skills.destroy', $skill->pivot->id) }}" class="inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus skill ini?')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500 italic">Belum ada keahlian yang ditawarkan</p>
            @endif
        </div>

        <div>
            <h3 class="text-md font-semibold text-blue-700 mb-4">Keahlian yang Dicari</h3>
            @if ($user->soughtSkills->isNotEmpty())
                <div class="space-y-2">
                    @foreach ($user->soughtSkills as $skill)
                        <div class="flex items-center justify-between p-3 bg-blue-50 border border-blue-200 rounded-lg">
                            <div>
                                <p class="font-medium text-blue-900">{{ $skill->skill_name }}</p>
                                <p class="text-xs text-blue-600">{{ $skill->category }} • Target: {{ ucfirst($skill->pivot->proficiency_level) }}</p>
                            </div>
                            <form method="post" action="{{ route('profile.skills.destroy', $skill->pivot->id) }}" class="inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus skill ini?')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500 italic">Belum ada keahlian yang dicari</p>
            @endif
        </div>
    </div>
</section>
