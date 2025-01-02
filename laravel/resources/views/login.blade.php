@extends('auth')

@section('title', 'Login')

@section('content')
<div style="text-align: center; margin-bottom: 20px">
    <p style="font-size: 20px; font-weight: 600;">
        GİRİŞ YAP
    </p>
</div>
<form method="POST" action="{{ route('auth.login') }}">
    @csrf
    <div class="form-group">
        <label>E-Posta</label>
        <input type="email" name="email" placeholder="E-Postanızı Girin" required>
    </div>
    <div class="form-group">
        <label>Şifre</label>
        <input type="password" name="password" placeholder="Şifrenizi Girin" required>
    </div>
    <button type="submit" class="btn">Giriş Yap</button>
</form>
@if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif
@if(session('error'))
  <div class="alert alert-danger">
    {{ session('error') }}
  </div>
@endif
@if($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<p class="link">Hesabın yok mu? <a href="{{ route('register') }}">Kayıt Ol</a></p>
@endsection
