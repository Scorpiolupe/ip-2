@extends('layout')

@section('hero')
    <div class="container">
        <h1>Yolculuk Geçmişiniz</h1>
        <p>Geçmişteki ve aktif yolculuklarınızı burada bulabilirsiniz.</p>
    </div>
@endsection

@section('features')
    <div class="container">
        @if(Auth::user()->canDrive)
            <h2>Aktif Yolculuklar</h2>
            <table class="table ride-table driver">
                <thead>
                    <tr>
                        <th>Alış Lokasyonu</th>
                        <th>Bırakış Lokasyonu</th>
                        <th>Alış Zamanı</th>
                        <th>Yolcu Sayısı</th>
                        <th>Özel İstekler</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activeRides as $ride)
                        <tr>
                            <td>{{ $ride->pickup_location }}</td>
                            <td>{{ $ride->dropoff_location }}</td>
                            <td>{{ $ride->pickup_time }}</td>
                            <td>{{ $ride->passenger_count }}</td>
                            <td>{{ $ride->special_requests ?? 'Yok' }}</td>
                            <td>
                            <button type="button" class="btn btn-success" onclick="openCompleteModal('{{ $ride->id }}')">
                                    Yolculuğu Bitir
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Aktif yolculuk bulunmamaktadır.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if($activeRides->isNotEmpty())
                <div class="modal fade" id="completeRideModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="completeRideForm" method="POST">
                                @csrf
                                <div class="modal-body" style="margin-top: 5px;">
                                    <div class="form-group" id="priceGroup">
                                        <label for="price">Yolculuk Ücreti</label>
                                        <input type="number" class="form-control" id="price" name="price" placeholder="₺" style="width: 120px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 20px" required>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin: 10px;">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                                    <button type="submit" class="btn btn-success" id="completeButton">Tamamla</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif


            <h2>Tamamlanan Yolculuklar</h2>
            <table class="table ride-table driver">
                <thead>
                    <tr>
                        <th>Tarih</th>
                        <th>Başlangıç</th>
                        <th>Bitiş</th>
                        <th>Durum</th>
                        <th>Ücret</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($completedRides as $ride)
                        <tr>
                            <td>{{ $ride->created_at }}</td>
                            <td>{{ $ride->start_location }}</td>
                            <td>{{ $ride->end_location }}</td>
                            <td>{{ $ride->status }}</td>
                            <td>{{ $ride->price }} TL</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tamamlanan yolculuk bulunmamaktadır.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            

        @else

            <h2>Aktif Yolculuk İstekleriniz</h2>
            <table class="table ride-table customer">
                <thead>
                    <tr>
                        <th>Alış Lokasyonu</th>
                        <th>Bırakış Lokasyonu</th>
                        <th>Alış Zamanı</th>
                        <th>Durum</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activeRequests as $request)
                        <tr>
                            <td>{{ $request->pickup_location }}</td>
                            <td>{{ $request->dropoff_location }}</td>
                            <td>{{ $request->pickup_time }}</td>
                            <td>{{ $request->driver_id ? 'Sürücü Atandı' : 'Sürücü Bekleniyor' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Aktif yolculuk isteğiniz bulunmamaktadır.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <h2>Tamamlanan Yolculuklarınız</h2>
            <table class="table ride-table customer">
                <thead>
                    <tr>
                        <th>Tarih</th>
                        <th>Başlangıç</th>
                        <th>Bitiş</th>
                        <th>Durum</th>
                        <th>Ücret</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rides as $ride)
                        <tr class="{{ $ride->status === 'Tamamlandı' ? 'completed' : 'cancelled' }}">
                            <td>{{ $ride->created_at }}</td>
                            <td>{{ $ride->start_location }}</td>
                            <td>{{ $ride->end_location }}</td>
                            <td>{{ $ride->status }}</td>
                            <td>{{ $ride->price }} TL</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tamamlanan yolculuğunuz bulunmamaktadır.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @endif
    </div>
@endsection

@section('scripts')
<script>
function openCompleteModal(rideId) {
    const modal = $('#completeRideModal');
    const form = $('#completeRideForm');
    const formGroup = $('.modal-body .form-group');
    const footer = $('.modal-footer');
    
    formGroup.hide();
    footer.hide();
    
    form.attr('action', `/rides/${rideId}/complete`);
    
    modal.modal('show');
    
    setTimeout(function() {
        formGroup.fadeIn(300);
        footer.fadeIn(300);
    }, 50);
}
</script>
@endsection

@section('styles')
    <style>
        .container {
            margin-top: 20px;
        }

        h1, h2 {
            color: #333;
            text-align: center;
            font-family: 'Arial', sans-serif;
        }

        .modal-body .form-group, .modal-footer {
            display: none;
        }

        .table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            font-family: 'Arial', sans-serif;
        }

        .table th, .table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .ride-table {
            background-color: #f9f9f9;
        }

        .ride-table thead {
            background-color:rgb(215, 210, 65);
            color: #000;
        }

        .ride-table tr:hover {
            background-color: rgb(195, 191, 59);
        }

        .ride-table td {
            background-color: white;
        }

        .ride-table td.completed {
            background-color: #d4edda;
            color: #155724;
        }

        .ride-table td.cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }

        .completed {
            color: green;
        }

        .cancelled {
            color: red;
        }

        .status-completed {
            color: green;
        }

        .status-cancelled {
            color: red;
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
    </style>
@endsection