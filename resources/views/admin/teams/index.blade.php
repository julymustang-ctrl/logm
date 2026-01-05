@extends('layouts.admin')

@section('title', 'Ekip')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Ekip</h2>
    <a href="{{ route('admin.teams.create') }}" class="bg-accent-500 hover:bg-accent-600 text-white px-4 py-2 rounded-lg transition flex items-center space-x-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        <span>Yeni Üye</span>
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($teams as $team)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center space-x-4">
                @if($team->photo)
                    <img src="{{ asset('storage/' . $team->photo) }}" alt="{{ $team->name }}" class="w-16 h-16 rounded-full object-cover">
                @else
                    <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                @endif
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-800">{{ $team->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $team->title }}</p>
                </div>
            </div>
            <div class="mt-4 flex justify-between items-center">
                @if($team->is_active)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                @else
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Pasif</span>
                @endif
                <div class="space-x-2">
                    <a href="{{ route('admin.teams.edit', $team) }}" class="text-accent-600 hover:text-accent-900 text-sm">Düzenle</a>
                    <form action="{{ route('admin.teams.destroy', $team) }}" method="POST" class="inline" onsubmit="return confirm('Bu üyeyi silmek istediğinize emin misiniz?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Sil</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-3 text-center py-12 text-gray-500">Henüz ekip üyesi eklenmemiş.</div>
    @endforelse
</div>
@endsection
