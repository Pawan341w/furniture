@extends('user.layout.app')
@section('title','Dashboard')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span>Dashboard
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="https://demo.bootstrapdash.com/purple-new/themes/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total QR Scan
                        <i class="mdi mdi-qrcode-scan mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{ num_format($usedQRCodeCount) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="https://demo.bootstrapdash.com/purple-new/themes/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Withdrawal Amount
                        <i class="mdi mdi-cash-minus mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{ num_format($totalDebit) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="https://demo.bootstrapdash.com/purple-new/themes/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Cashback
                        <i class="mdi mdi-cash-plus mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5" >{{ num_format($totalCredit) }}</h2>
                </div>
            </div>
        </div>
    </div>

<div class="row mb-3">


         <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="https://demo.bootstrapdash.com/purple-new/themes/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Today Total QR Scan
                        <i class="mdi mdi-qrcode-scan mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5" id="total-scan"> <span style="font-size: 20px">Total Qr</span> {{ num_format($totalUsedToday) }}  , <img src="{{ asset('assets/images/icons/coin.png') }}" width="18">
{{ num_format($totalcoinToday) }} </h2>
                </div>
            </div>
        </div>


    </div>
<h4 class="card-title mb-3">Today Qr Scan</h4>

<div class="row">
     <div class="col-md-3">
            <form id="qrFilterForm" class="d-flex">
<input type="date" name="date" id="filterDate" class="form-control me-2"
       value="<?php echo date('Y-m-d'); ?>">                <button type="submit" class="btn btn-primary">Filter</button>
                {{-- <button type="button" id="resetFilter" class="btn btn-secondary ms-2">Reset</button> --}}
            </form>
        </div>
</div>
<br>
<br>
    <!-- QR Result Grid -->
    <div class="row" id="qrResult">
        @if($usedQRCodesToday->isEmpty())
            <div class="col-12">
                <div class="alert alert-info">No QR Scan Today.</div>
            </div>
        @else

            @foreach($usedQRCodesToday as $qr)
                <div class="col-12 col-md-4 stretch-card grid-margin">
                    <div class="card shadow-sm h-100">
                        <div class="card-body p-2">
                            <p class="mb-1"><strong>Product Name:</strong> {{ $qr->product->name }}</p>
                            <p class="mb-1"><strong>QR Code:</strong>
                                @if($qr->path && file_exists(public_path($qr->path)))
                                    <img src="{{ asset($qr->path) }}" alt="QR"
                                        style="height:50px;width:50px;border-radius:50%;object-fit:cover;">
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </p>
                            <p class="mb-1"><strong><img src="{{ asset('assets/images/icons/coin.png') }}" width="18"></strong> {{ $qr->coin_reward }}</p>


                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>


<!-- AJAX Script -->
<script>
$(document).ready(function() {
    // Filter by date
    $('#qrFilterForm').on('submit', function(e) {
        e.preventDefault();
        let date = $('#filterDate').val();
        if(!date) return;

        $.ajax({
            url: "{{ route('qr.filter.by.date') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                date: date
            },
            success: function(res) {
                $('#total-scan').html(`<span style="font-size: 20px">Total Qr</span> ${ res.totalUsedOnDate  }  , <img src="{{ asset('assets/images/icons/coin.png') }}" width="18">
${ res.totalcoinToday } `);

                let html = '';
                if(res.usedQRCodes.length === 0) {
                    html = `<div class="col-12"><div class="alert alert-info">No QR scans found.</div></div>`;
                } else {
                    res.usedQRCodes.forEach(function(qr) {
                        let productName = qr.product ? qr.product.name : 'N/A';
                        let qrImg = qr.path ? `<img src="/${qr.path}" style="height:50px;width:50px;border-radius:50%;object-fit:cover;">` : `<span class="text-muted">N/A</span>`;
                        html += `
                        <div class="col-12 col-md-4 stretch-card grid-margin">
                            <div class="card shadow-sm h-100">
                                <div class="card-body p-2">
                                    <p class="mb-1"><strong>Product Name:</strong> ${productName}</p>
                                    <p class="mb-1"><strong>QR Code:</strong> ${qrImg}</p>
                                      <p class="mb-1"><strong>  <img src="{{ asset('assets/images/icons/coin.png') }}" width="18"></strong> ${qr.coin_reward}</p>

                                </div>
                            </div>
                        </div>`;
                    });
                }
                $('#qrResult').html(html);
            }
        });
    });

    // Reset filter button
    $('#resetFilter').on('click', function() {
        $('#filterDate').val('');
        location.reload(); // reload dashboard to default today
    });
});
</script>
{{-- Recent Transactions --}}
<h4 class="card-title mb-3">Recent Transactions</h4>

<div class="row">
    @if($recentWalletTransactions->isEmpty())
        <div class="col-12">
            <div class="alert alert-info">No withdrawals found.</div>
        </div>
    @else
        @foreach($recentWalletTransactions as $recentWalletTransaction)
            @php
                $isCredit = $recentWalletTransaction->type === 'credit';
                $sign = $isCredit ? '+' : '-';
                $color = $isCredit ? 'success' : 'danger';
                $icon = $isCredit ? 'mdi-arrow-down-bold' : 'mdi-arrow-up-bold';
                $finalBalance = $isCredit
                    ? $recentWalletTransaction->balance_before + $recentWalletTransaction->amount
                    : $recentWalletTransaction->balance_before - $recentWalletTransaction->amount;
            @endphp

            <div class="col-12 col-md-4 stretch-card grid-margin">
                <div class="card shadow-sm h-100">
                    <div class="card-body" style="padding:10px !important;">
                        <div class="d-flex justify-content-between mb-2 align-items-center">
                            <strong class="text-capitalize">
                                <i class="mdi {{ $icon }} text-{{ $color }}"></i>
                                {{ ucfirst($recentWalletTransaction->type) }}
                            </strong>
                            <span class="text-{{ $color }}">
                                <img src="{{ asset('assets/images/icons/coin.png') }}" width="18">
                                {{ $sign }}{{ num_format($recentWalletTransaction->amount) }}
                            </span>
                        </div>
                        <div class="small">
                            <!--<p class="mb-1"><strong>User ID:</strong> {{ $recentWalletTransaction->user_id }}</p>-->
                            <p class="mb-1"><strong>Balance Before:</strong>
                                <img src="{{ asset('assets/images/icons/coin.png') }}" width="16"> {{ num_format($recentWalletTransaction->balance_before) }}
                            </p>

                            <p class="mb-1"><strong>Balance After:</strong>
                                <img src="{{ asset('assets/images/icons/coin.png') }}" width="16"> {{ num_format($finalBalance) }}
                            </p>
                            <p class="mb-1"><strong>Message:</strong> {{ $recentWalletTransaction->message }}</p>
                            <p class="mb-1"><strong>UTR:</strong> {{ $recentWalletTransaction->utr ?? '-' }}</p>
                            <p class="mb-1"><strong>Txn ID:</strong> {{ $recentWalletTransaction->transaction_id }}</p>
                            <p class="mb-0"><strong>Date:</strong> {{ $recentWalletTransaction->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

</div>
@endsection
