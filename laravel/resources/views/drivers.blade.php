@extends('layout')

@section('hero')
<div class="container">
    <h1>Şoförlerimiz</h1>
    <p>Güvenilir ve profesyonel şoför kadromuzla hizmetinizdeyiz.</p>
</div>
@endsection

@section('features')
<h2>Şoförlerimiz</h2>
<div class="features-grid">
    @foreach($drivers as $driver)
    <div class="feature">
        <img src="{{ $driver->profile_photo_url }}" alt="{{ $driver->name }}" style="width: 150px; height: auto; border-radius: 50%; margin-bottom: 15px;">
        <h3>{{ $driver->name }}</h3>
        <p><strong>Tecrübe:</strong> {{ $driver->experience_years }} yıl</p>
        <p><strong>Hakkında:</strong> {{ $driver->bio }}</p>
        <p><strong>Telefon:</strong> {{ $driver->tel }}</p>
    </div>
    @endforeach
</div>
@endsection
