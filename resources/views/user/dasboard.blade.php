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
                    <h2 class="mb-5">{{ num_format($totalCredit) }}</h2>
                </div>
            </div>
        </div>
    </div>

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