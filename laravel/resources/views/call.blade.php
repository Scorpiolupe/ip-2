@extends('layout')

@section('hero')
    <h1>Taksi Çağır</h1>
    <p>Sarış Taksi ile hızlı ve güvenli ulaşımın keyfini çıkarın.</p>
@endsection

@section('features')
    <h2>Taksi Çağır</h2>
    <p>Aşağıdaki bilgileri doldurun, size en yakın taksiyi hemen yönlendirelim.</p>

    <form action="{{ route('taksi.call') }}" method="POST" class="taksi-call-form">
        @csrf

        <div class="form-group">
            <label for="pickup_location">Nereden Alınacaksınız?</label>
            <select name="pickup_city" id="pickup_city" class="form-control" required>
                <option value="" disabled selected>Şehir Seçin</option>
                @foreach($cities as $city)
                    <option value="{{ $city }}">{{ $city }}</option>
                @endforeach
            </select>
            <input type="text" id="pickup_location" name="pickup_location" value="{{ old('pickup_location') }}" class="form-control" placeholder="Alınmak istediğiniz adresi yazın" required>
        </div>

        <div class="form-group">
            <label for="dropoff_location">Nereye Gidiyorsunuz?</label>
            <select name="dropoff_city" id="dropoff_city" class="form-control" required>
                <option value="" disabled selected>Şehir Seçin</option>
                @foreach($cities as $city)
                    <option value="{{ $city }}">{{ $city }}</option>
                @endforeach
            </select>
            <input type="text" id="dropoff_location" name="dropoff_location" value="{{ old('dropoff_location') }}" class="form-control" placeholder="Gitmek istediğiniz adresi yazın" required>
        </div>

        <div class="form-group">
            <label for="pickup_time">Ne Zaman Taksi İstiyorsunuz?</label>
            <input type="datetime-local" id="pickup_time" name="pickup_time" value="{{ old('pickup_time') }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="passenger_count">Yolcu Sayısı</label>
            <input type="number" id="passenger_count" name="passenger_count" value="{{ old('passenger_count') }}" class="form-control" placeholder="Kaç yolcu olacak?" required>
        </div>

        <div class="form-group">
            <label for="special_requests">Özel Talepleriniz</label>
            <textarea id="special_requests" name="special_requests" class="form-control" rows="4" placeholder="Herhangi bir özel talebiniz var mı?">{{ old('special_requests') }}</textarea>
        </div>

        <button type="submit" class="btn">Taksi Çağır</button>

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
@endsection

@section('styles')
    <style>

        .taksi-call-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 30px auto;
        }

   
        .form-group {
            margin-bottom: 20px;
        }

      
        .form-group label {
            display: block;
            font-size: 16px;
            color: #333;
            margin-bottom: 8px;
            font-weight: 600;
        }

      
        .form-group .form-control {
            margin: 5px;
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 16px;
            box-sizing: border-box; 
            transition: border-color 0.3s ease-in-out;
        }

  
        .form-group .form-control:focus {
            border-color: #1abc9c;
            outline: none;
        }

     
        .btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: #1abc9c;
            color: white;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 50px;
            transition: background-color 0.3s;
            cursor: pointer;
            border: none;
            text-align: center;
        }

     
        .btn:hover {
            background-color: #16a085;
        }

   
        @media (max-width: 768px) {
            .taksi-call-form {
                padding: 20px;
            }

            .taksi-call-form .form-group {
                margin-bottom: 15px;
            }

            .taksi-call-form .btn {
                width: 100%;
                padding: 12px;
            }
        }
    </style>
@endsection
