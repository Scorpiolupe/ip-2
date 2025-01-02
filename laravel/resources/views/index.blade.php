@extends('layout')

@section('hero')
<h1>Güvenilir ve Hızlı Ulaşım</h1>
            <p>Sarı Taksi ile her zaman, her yerde yanınızdayız!</p>
            <div class="cta-buttons">
                <a href="call" class="btn">Hemen Çağır</a>
                <a href="services" class="btn btn-alt">Daha Fazla Bilgi</a>
            </div>

@endsection

@section('features')
<h2>Neden Sarı Taksi?</h2>
            <div class="features-grid">
                <div class="feature">
                    <h3>Hızlı Rezervasyon</h3>
                    <p>Yalnızca birkaç tıklamayla taksinizi kolayca ayırtın.</p>
                </div>
                <div class="feature">
                    <h3>Güvenilir Şoförler</h3>
                    <p>Deneyimli ve profesyonel şoförlerimizle güvenli yolculuk.</p>
                </div>
                <div class="feature">
                    <h3>Uygun Fiyatlar</h3>
                    <p>Her bütçeye uygun fiyatlarla hizmet sunuyoruz.</p>
                </div>
            </div>

@endsection