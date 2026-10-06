{{-- File: resources/views/profile/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
    <h1>Profil Petugas</h1>

    <div style="background: #f8fafc; padding: 16px; border-radius: 6px; border: 1px solid #e2e8f0; margin-bottom: 24px;">
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
    </div>

    <h2>Ganti Password</h2>

    <form action="{{ route('profile.password.update') }}" method="POST" style="max-width: 400px;">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 12px;">
            <label for="current_password" style="display: block; font-weight: bold;">Password Saat Ini</label>
            <input type="password" name="current_password" id="current_password" style="width: 100%; padding: 8px; margin-top: 4px;">
            @error('current_password')
                <div style="color: #b91c1c; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 12px;">
            <label for="password" style="display: block; font-weight: bold;">Password Baru</label>
            <input type="password" name="password" id="password" style="width: 100%; padding: 8px; margin-top: 4px;">
            @error('password')
                <div style="color: #b91c1c; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 12px;">
            <label for="password_confirmation" style="display: block; font-weight: bold;">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" id="password_confirmation" style="width: 100%; padding: 8px; margin-top: 4px;">
        </div>

        <button type="submit" class="btn" style="background: #2563eb; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">
            Perbarui Password
        </button>
    </form>
@endsection