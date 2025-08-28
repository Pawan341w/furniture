@extends('user.layout.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Withdrawal History</h2>

    <!-- Withdraw Button -->
    <button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#withdrawModal">
        Request Withdrawal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="withdrawModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('withdraw.request') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Withdraw Coins</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                          <!-- Bank Select Dropdown -->
                        <div class="mb-3">
                            <label>Select Bank Account</label>
                            <select name="bank_id" class="form-select" required>
                                <option value="">-- Select Bank --</option>
                                @if($bank!='')
                                    <option value="{{ $bank->id }}">
                                        {{ $bank->bank_name }} - {{ $bank->account_number }}
                                    </option>
                                    @else
                                    @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Enter Coin Amount</label>
                            <input type="number" min="1" name="amount" class="form-control" id="coinInput" required>
                        </div>



                        <div class="alert alert-info">
                            ₹ <span id="coinValue">0</span> will be credited based on rate ₹{{ get_setting('coin') }} / coin.
                        </div>
                        <input type="hidden" name="rate" value="{{ get_setting('coin') }}">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Wallet History -->
    @php $totalBalance = 0; @endphp

    @if ($withdrawals->count() === 0)
        <div class="alert alert-warning">No wallet history found.</div>
    @else
        <div class="row g-3">
            @foreach ($withdrawals as $withdrawal)
                @php
                    $isCredit = $withdrawal->type === 'credit';
                    $sign = $isCredit ? '+' : '-';
                    $color = $isCredit ? 'success' : 'danger';
                    $finalBalance = $isCredit
                        ? $withdrawal->balance_before + $withdrawal->amount
                        : $withdrawal->balance_before - $withdrawal->amount;
                    $totalBalance = $finalBalance;
                @endphp

                <div class="col-md-6">
                    <div class="border p-3 rounded bg-light">
                        <div class="d-flex justify-content-between">
                            <strong>{{ ucfirst($withdrawal->type) }}</strong>
                            <span class="text-{{ $color }}">
                                <img src="{{ asset('assets/images/icons/coin.png') }}" width="18">
                                {{ $sign }}{{ num_format($withdrawal->amount) }}
                            </span>
                        </div>
                        <div class="mt-2 small">
                            <strong>Message:</strong> {{ $withdrawal->message }}<br>
                            <strong>Balance Before:</strong> {{ num_format($withdrawal->balance_before) }}<br>
                            <strong>Balance After:</strong> {{ num_format($finalBalance) }}<br>
                            <strong>Txn ID:</strong> {{ $withdrawal->transaction_id }}<br>
                            <strong>UTR:</strong> {{ $withdrawal->utr ?? '-' }}<br>
                            <strong>Date:</strong> {{ $withdrawal->created_at->format('Y-m-d H:i') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $withdrawals->links() }}
        </div>
        
        

        <!-- Total Balance -->
       <div class="alert alert-info mt-4">
    <strong>Total Wallet Value In (INR):</strong>
    ₹{{ num_format(auth()->user()->wallet * get_setting('coin')) }}
</div>

    @endif
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('coinInput').addEventListener('input', function () {
        const rate = {{ get_setting('coin') }};
        const amount = parseInt(this.value) || 0;
        document.getElementById('coinValue').textContent = amount * rate;
    });
</script>
@endsection
