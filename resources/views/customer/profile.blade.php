@extends('customer.layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="max-w-2xl mx-auto mt-10 px-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Profil</h2>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" class="bg-white p-6 rounded-2xl shadow">
        @csrf

        {{-- Nama --}}
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('name')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nomor HP --}}
        <div class="mb-4">
            <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
            <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                placeholder="+62...">
            @error('phone_number')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Alamat --}}
        <div class="mb-6">
            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
            <textarea name="address" id="address" rows="3"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">{{ old('address', $user->address) }}</textarea>
            @error('address')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="bg-blue-600 text-white font-medium px-5 py-2 rounded-lg hover:bg-blue-700 transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
