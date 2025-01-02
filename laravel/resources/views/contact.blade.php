@extends('layout')

@section('hero')
<div class="container">
    <h1>İletişim</h1>
    <p>Bize ulaşın, en kısa sürede dönüş yapalım</p>
</div>
@endsection

@section('features')
    <div class="contact-container" style="max-width: 800px; margin: 0 auto;">
        @if(session('success'))
            <div class="alert-success" style="background-color: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST" class="contact-form" style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 6px 10px rgba(0,0,0,0.1);">
            @csrf
            
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="name" style="display: block; margin-bottom: 5px; font-weight: 600;">Ad Soyad</label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       placeholder="Adınız" 
                       value="{{ old('name', auth()->user()->name ?? '') }}" 
                       @if(auth()->check()) readonly @endif
                       style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;"
                       class="@error('name') is-invalid @enderror">
                @error('name')
                    <div class="error-message" style="color: #dc3545; font-size: 14px; margin-top: 5px;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="email" style="display: block; margin-bottom: 5px; font-weight: 600;">E-posta</label>
                <input type="email" 
                       name="email" 
                       id="email" 
                       placeholder="xxxxxxxx@xxxx.com" 
                       value="{{ old('email', auth()->user()->email ?? '') }}" 
                       @if(auth()->check()) readonly @endif
                       style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;"
                       class="@error('email') is-invalid @enderror">
                @error('email')
                    <div class="error-message" style="color: #dc3545; font-size: 14px; margin-top: 5px;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="phone" style="display: block; margin-bottom: 5px; font-weight: 600;">Telefon</label>
                <input type="tel" 
                       name="phone" 
                       id="phone" 
                       placeholder="05xxxxxxxxx" 
                       value="{{ old('phone', auth()->user()->tel ?? '') }}" 
                       @if(auth()->check()) readonly @endif
                       style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;"
                       class="@error('phone') is-invalid @enderror">
                @error('phone')
                    <div class="error-message" style="color: #dc3545; font-size: 14px; margin-top: 5px;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="subject" style="display: block; margin-bottom: 5px; font-weight: 600;">Konu</label>
                <select name="subject" id="subject" required 
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;"
                    class="@error('subject') is-invalid @enderror">
                    <option value="" disabled selected>Seçiniz</option>
                    <option value="genel">Genel Bilgi</option>
                    <option value="rezervasyon">Rezervasyon</option>
                    <option value="sikayet">Şikayet</option>
                    <option value="oneri">Öneri</option>
                </select>
                @error('subject')
                    <div class="error-message" style="color: #dc3545; font-size: 14px; margin-top: 5px;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="message" style="display: block; margin-bottom: 5px; font-weight: 600;">Mesajınız</label>
                <textarea name="message" id="message" rows="5" required placeholder="Mesajınız" 
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;"
                    class="@error('message') is-invalid @enderror"></textarea>
                @error('message')
                    <div class="error-message" style="color: #dc3545; font-size: 14px; margin-top: 5px;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn" style="width: 100%; background-color: #1abc9c; border: none;">
                Gönder
            </button>
        </form>

        <div class="contact-info" style="margin-top: 40px; text-align: center;">
            <h3 style="color: #333; margin-bottom: 20px;">İletişim Bilgilerimiz</h3>
            <p><strong>Adres:</strong> Onsekiz Mart Üniversitesi, Teknik Bilimler Meslek Yüksek Okulu, Çanakkale</p>
            <p><strong>Telefon:</strong> (0212) 123 12 34</p>
            <p><strong>E-posta:</strong> ikorfax@gmail.com</p>
        </div>
    </div>
@endsection