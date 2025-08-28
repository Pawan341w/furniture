@extends('user.layout.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Wallet History</h2>

    <!-- Filter Buttons -->
    <div class="mb-3">
        <button class="btn btn-outline-primary filter-btn" data-type="">All</button>
        <button class="btn btn-outline-success filter-btn" data-type="credit">Credit</button>
        <button class="btn btn-outline-danger filter-btn" data-type="debit">Debit</button>
    </div>

    @if($historys->isEmpty())
        <div class="alert alert-info">No withdrawals found.</div>
    @else
        <div class="row g-3" id="walletGrid">
            @foreach($historys as $history)
                @php
                    $isCredit = $history->type === 'credit';
                    $sign = $isCredit ? '+' : '-';
                    $color = $isCredit ? 'success' : 'danger';
                    $finalBalance = $isCredit
                        ? $history->balance_before + $history->amount
                        : $history->balance_before - $history->amount;
                @endphp

                <div class="col-md-6 wallet-item" data-type="{{ $history->type }}">
                    <div class="p-3 border rounded bg-light shadow-sm h-100">
                        <div class="d-flex justify-content-between mb-2">
                            <strong class="text-capitalize">{{ $history->type }}</strong>
                            <span class="text-{{ $color }}">
                                <img src="{{ asset('assets/images/icons/coin.png') }}" width="18">
                                {{ $sign }}{{ num_format($history->amount) }}
                            </span>
                        </div>
                        <div class="small">
                            <!--<p class="mb-1"><strong>User ID:</strong> {{ $history->user_id }}</p>-->
                            <p class="mb-1"><strong>Balance Before:</strong>
                                <img src="{{ asset('assets/images/icons/coin.png') }}" width="16"> {{ num_format($history->balance_before) }}
                            </p>
                            <p class="mb-1"><strong>Balance After:</strong>
                                <img src="{{ asset('assets/images/icons/coin.png') }}" width="16"> {{ num_format($finalBalance) }}
                            </p>
                            <p class="mb-1"><strong>Message:</strong> {{ $history->message }}</p>
                            <p class="mb-1"><strong>UTR:</strong> {{ $history->utr ?? '-' }}</p>
                            <p class="mb-1"><strong>Txn ID:</strong> {{ $history->transaction_id }}</p>
                            <p class="mb-0"><strong>Date:</strong> {{ $history->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
         <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-4">
            {{ $historys->links() }}
        </div>
    @endif
</div>
@endsection

@section('script')
<script>
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function () {
            const type = this.getAttribute('data-type');
            document.querySelectorAll('.wallet-item').forEach(item => {
                if (!type || item.getAttribute('data-type') === type) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection
