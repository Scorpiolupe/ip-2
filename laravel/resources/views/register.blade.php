@extends('auth')

@section('title', 'Register')

@section('content')
<div style="text-align: center; margin-bottom: 20px;">
    <h2>Register</h2>
</div>
<form method="POST" action="{{ route('auth.register') }}">
    @csrf
    <div class="form-group">
        <label for="name">Ad Soyad</label>
        <input type="text" name="name" id="name" placeholder="Adınızı ve Soyadınızı Girin" required>
        @error('name')
            <div class="alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="email">E-Posta</label>
        <input type="email" name="email" id="email" placeholder="E-Postanızı Girin" required>
        @error('email')
            <div class="alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="tel">Telefon Numarası</label>
        <input type="text" name="tel" id="tel" placeholder="Telefon Numaranızı Girin" required>
        @error('tel')
            <div class="alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="gender">Cinsiyet</label>
        <select name="gender" id="gender">
            <option value="">Seçiniz</option>
            <option value="man">Erkek</option>
            <option value="woman">Kadın</option>
        </select>
        @error('gender')
            <div class="alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="password">Şifre</label>
        <input type="password" name="password" id="password" placeholder="Şifrenizi Belirleyin" required>
        @error('password')
            <div class="alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="password_confirmation">Şifre Doğrula</label>
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Şifrenizi Doğrulayın" required>
        @error('password_confirmation')
            <div class="alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn">Kayıt Ol</button>
</form>
<a href="{{ route('login') }}" class="link">Giriş Yap</a>
@endsection
