@extends('layout')

@section('title', 'Şoför Ol')

@section('hero')
<div class="container">
    <h1>Şoför Ol</h1>
    <p>Şoför olarak bizimle çalışın, gelir elde edin.</p>
</div>
@endsection

@section('features')
    <div class="form-container" style="max-width: 800px; margin: 0 auto;">
        
        @if(session('success'))
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('becomeDriver.submit') }}" method="POST" enctype="multipart/form-data" class="contact-form" style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 6px 10px rgba(0,0,0,0.1);">
            @csrf
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="vehicle_model" style="display: block; margin-bottom: 5px; font-weight: 600;">Araç Modeli</label>
                <input type="text" id="vehicle_model" name="vehicle_model" placeholder="Aracınızın modelini girin" required
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="vehicle_license_plate" style="display: block; margin-bottom: 5px; font-weight: 600;">Araç Plakası</label>
                <input type="text" id="vehicle_license_plate" name="vehicle_license_plate" placeholder="Araç plakanızı girin" required
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="vehicle_age" style="display: block; margin-bottom: 5px; font-weight: 600;">Araç Yaşı</label>
                <input type="number" id="vehicle_age" name="vehicle_age" placeholder="Aracınızın yaşını girin" required
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
            </div>
            

            <div class="form-group" style="margin-bottom: 20px; position: relative;">
                <label for="license" style="display: block; margin-bottom: 5px; font-weight: 600;">Ehliyet Belgesi</label>
                <select name="license_option" id="license_option" onchange="toggleLicenseInput()" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; margin-bottom: 10px;">
                    <option value="url" selected>URL Linki ile</option>
                    <option value="file" disabled>Yerel dosya yükleme ile</option>
                </select>

                <div id="input-container-lic" style="position: relative;">
                    <input type="url" id="license_url" name="license" value="https://i.hizliresim.com/.jpg" placeholder="Fotoğraf URL'sini girin" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;" required>
                </div>
            </div>



            <div class="form-group" style="margin-bottom: 20px; position: relative;">
                <label for="registration_photo" style="display: block; margin-bottom: 5px; font-weight: 600;">Ruhsat Belgesi</label>
                <select name="registration_option" id="registration_option" onchange="toggleRegistrationInput()" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; margin-bottom: 10px;" required>
                    <option value="url" selected>URL Linki ile</option>
                    <option value="file" disabled>Yerel dosya yükleme ile</option>
                </select>

                <div id="input-container-reg" style="position: relative;">
                    <input type="url" id="registration_url" name="registration" value="https://i.hizliresim.com/.jpg" placeholder="Fotoğraf URL'sini girin" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;" required>
                </div>
            </div>



            <div class="form-group" style="margin-bottom: 20px; position: relative;">
                <label for="profile_photo" style="display: block; margin-bottom: 5px; font-weight: 600;">Profil Fotoğrafı</label>
                <select name="pp_option" id="pp_option" onchange="togglePhotoInput()" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; margin-bottom: 10px;">
                    <option value="url" selected>URL Linki ile</option>
                    <option value="file" disabled>Yerel dosya yükleme ile</option>
                </select>

                <div id="input-container-pp" style="position: relative;">
                    <input type="url" id="profile_photo_url" value="https://i.hizliresim.com/.jpg" name="profile_photo_url" placeholder="Fotoğraf URL'sini girin" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;" required>
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="bio" style="display: block; margin-bottom: 5px; font-weight: 600;">Hakkınızda</label>
                <textarea name="bio" id="bio" rows="3"  style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;"></textarea>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <button type="submit" class="btn-submit" style="width: 100%; background-color: #1abc9c; border: none; padding: 10px; font-size: 16px; color: white; cursor: pointer; border-radius: 5px;">
                    Başvuruyu Gönder
                </button>
            </div>
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
            @if ($errors->has('error'))
                <div class="alert alert-danger">
                    {{ $errors->first('error') }}
                </div>
            @endif
        </form>
    </div>
@endsection

@section('scripts')
<script>
    function togglePhotoInput() {
        const selectedOption = document.getElementById('pp_option').value;
        const inputContainer = document.getElementById('input-container-pp');

        if (selectedOption === 'file') {
            inputContainer.innerHTML = `
                <input type="file" id="profile_photo_file" name="profile_photo" accept="image/*" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
            `;
        } else {
            inputContainer.innerHTML = `
                <input type="url" id="profile_photo_url" name="profile_photo" placeholder="Fotoğraf URL'sini girin"  style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;" required>
            `;
        }
    }
    function toggleLicenseInput() {
        const selectedOption = document.getElementById('license_option').value;
        const inputContainer = document.getElementById('input-container-lic');

        if (selectedOption === 'file') {
            inputContainer.innerHTML = `
                <input type="file" id="license_file" name="license" accept="image/*" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
            `;
        } else {
            inputContainer.innerHTML = `
                <input type="url" id="license_url" name="license" placeholder="Fotoğraf URL'sini girin"  style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;" required>
            `;
        }
    }
    function toggleRegistrationInput() {
        const selectedOption = document.getElementById('registration_option').value;
        const inputContainer = document.getElementById('input-container-reg');

        if (selectedOption === 'file') {
            inputContainer.innerHTML = `
                <input type="file" id="registration_file" name="registration" accept="image/*" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
            `;
        } else {
            inputContainer.innerHTML = `
                <input type="url" id="registration_url" name="registration" placeholder="Fotoğraf URL'sini girin"  style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;" required>
            `;
        }
    }
</script>
@endsection