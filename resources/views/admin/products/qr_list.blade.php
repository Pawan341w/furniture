@extends('admin.layout.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">QR Code Generator: {{ $product->name }}</h2>

    <div class="mb-4 d-flex justify-content-between">
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">← Back to Products</a>
    </div>

    {{-- QR Code Generation Form --}}
    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <form id="qrForm">
                @csrf
                <input type="hidden" id="product_id" value="{{ $product->id }}">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="count" class="form-label">QR Count (max 20)</label>
 <input type="number"
           class="form-control"
           id="count"
           name="count"
           min="0"
           max="20"
           required>                    </div>

                    <div class="col-md-6 mb-3">
                        {{-- Manual Coin Rewards --}}
                        <div id="div_coin_rewards">
                            <label class="form-label">Coin Rewards</label>
                            <input type="text" name="coin_rewards" id="coin_rewards" class="form-control" placeholder="e.g. 10,20,30">
                            <small class="text-muted">Match rewards with QR count. Default = 0 if empty.</small>
                        </div>

                        {{-- Auto-generate Digit Length --}}
                        <div id="div_digit_length" class="mt-2 d-none">
                            <label class="form-label">Digit Length</label>
                            <select id="digitLength" class="form-select form-select-sm" style="max-width: 150px;">
                                <option value="1">1 Digit</option>
                                <option value="2" selected>2 Digits</option>
                                <option value="3">3 Digits</option>
                            </select>
                            <small class="text-muted">Numbers will be auto-generated.</small>
                        </div>

                        {{-- Auto-generate Toggle --}}
                        <div class="form-check mt-2">
                            <input type="checkbox" class="form-check-input" id="autoGenerateCoins">
                            <label class="form-check-label" for="autoGenerateCoins">Auto-generate rewards</label>
                        </div>
                    </div>

                    <div class="col-md-3 d-flex align-items-end mb-3">
                        <button type="submit" class="btn btn-primary w-100">Generate QR Codes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- QR Code Table --}}
    @if($qrCodes->count())
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-4">Generated QR Codes</h5>

            {{-- Filter Buttons --}}
           <div class="mb-3 d-flex gap-2">
    <button class="btn btn-outline-success" onclick="filterQR('used')">Used</button>
    <button class="btn btn-outline-secondary" onclick="filterQR('not_used')">Not Used</button>
    <button class="btn btn-outline-dark" onclick="filterQR('all')">Show All</button>
    <button class="btn btn-primary ms-auto" onclick="printSelectedQRs()">🖨 Print All Not Used</button>
</div>

            <div class="table-responsive">
                <table id="qrTable" class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-light">
    <tr>
        <th><input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)"></th>
        <th>#</th>
        <th>QR Code</th>
        <th>Code</th>
        <th>Coins</th>
        <th>Used</th>
        <th>Used By</th>
        <th>Used At</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
@foreach($qrCodes as $index => $qr)
<tr>
    <td>
        <input type="checkbox" class="qr-select" data-src="{{ asset($qr->path) }}">
    </td>
    <td>{{ $index + 1 }}</td>
    <td>
        @if($qr->path && file_exists(public_path($qr->path)))
            <div class="qr-item">
                <img src="{{ asset($qr->path) }}" alt="QR" style="height: 80px; width: 80px; border-radius: 50%; object-fit: cover;">
            </div>
        @else
            <span class="text-muted">N/A</span>
        @endif
    </td>
    <td>{{ $qr->code }}</td>
    <td>{{ $qr->coin_reward }}</td>
    <td>
        <span class="badge {{ $qr->is_used ? 'bg-danger' : 'bg-success' }}">
            {{ $qr->is_used ? 'Yes' : 'No' }}
        </span>
    </td>
    <td>{{ $qr->usedUser->name ?? '-' }}</td>
    <td>{{ $qr->used_at ? \Carbon\Carbon::parse($qr->used_at)->format('d M Y H:i') : '-' }}</td>
    <td>
        <button onclick="printQRCode('{{ $qr->code }}')" class="btn btn-sm btn-outline-primary">
            🖨 Print
        </button>
    </td>
</tr>
@endforeach
</tbody>

                </table>
            </div>
        </div>
    </div>
    @else
        <div class="alert alert-warning text-center">No QR codes generated yet.</div>
    @endif
</div>
@endsection

@section('script')
<script>


document.getElementById('count').addEventListener('input', function () {
    if (this.value > 20) {
        this.value = 20;
    }

});
document.addEventListener("DOMContentLoaded", function () {
    const autoGenerateCheckbox = document.getElementById("autoGenerateCoins");
    const coinRewardsInput = document.getElementById("coin_rewards");
    const countInput = document.getElementById("count");
    const digitLengthDiv = document.getElementById("div_digit_length");
    const digitLengthSelect = document.getElementById("digitLength");

    // Toggle Auto-generate Mode
    autoGenerateCheckbox.addEventListener("change", function () {
        if (this.checked) {
            digitLengthDiv.classList.remove("d-none");
            coinRewardsInput.disabled = true;
            generateCoins();
        } else {
            digitLengthDiv.classList.add("d-none");
            coinRewardsInput.disabled = false;
            coinRewardsInput.value = "";
        }
    });

    // Auto-generate on changes
    countInput.addEventListener("input", function () {
        if (autoGenerateCheckbox.checked) generateCoins();
    });
    digitLengthSelect.addEventListener("change", function () {
        if (autoGenerateCheckbox.checked) generateCoins();
    });

    function generateCoins() {
        let count = parseInt(countInput.value) || 0;
        let digitLength = parseInt(digitLengthSelect.value) || 1;
        let min = Math.pow(10, digitLength - 1);
        let max = Math.pow(10, digitLength) - 1;
        if (digitLength === 1) min = 1;

        let coins = [];
        for (let i = 0; i < count; i++) {
            coins.push(Math.floor(Math.random() * (max - min + 1)) + min);
        }
        coinRewardsInput.value = coins.join(",");
    }

    // Form Submission with Validation
    document.getElementById("qrForm").addEventListener("submit", function (e) {
        e.preventDefault();

        const productId = document.getElementById("product_id").value;
        const count = parseInt(countInput.value) || 0;
        const coin_rewards = coinRewardsInput.value.trim();
        const autoGenerate = autoGenerateCheckbox.checked;

        // Validation
        if (count < 1 || count > 20) {
            Swal.fire({ icon: 'warning', title: 'Invalid Count', text: 'QR count must be between 1 and 20.' });
            return;
        }

        if (!autoGenerate) {
            if (coin_rewards.length > 0) {
                let coinsArr = coin_rewards.split(',').map(c => c.trim());
                let isValid = coinsArr.every(c => /^\d+$/.test(c));
                if (!isValid) {
                    Swal.fire({ icon: 'warning', title: 'Invalid Coins', text: 'Coin rewards must be numbers separated by commas.' });
                    return;
                }
                // if (coinsArr.length !== count) {
                //     Swal.fire({ icon: 'warning', title: 'Mismatch', text: 'Number of coin rewards must match the QR count.' });
                //     return;
                // }
            }
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        Swal.fire({ title: 'Generating QR Codes...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

        fetch(`/qr/generate`, {
            method: "POST",
            headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": csrfToken, "Accept": "application/json" },
            body: JSON.stringify({ product_id: productId, count: count, coin_rewards: coin_rewards })
        })
        .then(res => res.json())
        .then(data => {
            Swal.fire({ icon: data.status ? 'success' : 'error', title: data.status ? 'Success!' : 'Error!', text: data.message })
            .then(() => { if (data.status) location.reload(); });
        })
        .catch(() => Swal.fire({ icon: 'error', title: 'Error!', text: 'An unexpected error occurred.' }));
    });
});

// Printing QR
function printQRCode(code) {
    const imageUrl = `/qr_codes/${code}.png`;
    const w = window.open('', '', 'width=400,height=400');
    w.document.write(`
        <html>
        <head>
            <title>Print QR Code</title>
            <style>
                body { display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; background: white; }
                img { width: 300px; height: 300px; object-fit: cover; }
            </style>
        </head>
        <body>
            <img src="${imageUrl}" alt="QR Code">
        </body>
        </html>
    `);
    w.document.close();
    setTimeout(() => { w.print(); w.close(); }, 500);
}

// Filter QR
function filterQR(filterType) {
    const rows = document.querySelectorAll('#qrTable tbody tr');
    rows.forEach(row => {
        const badge = row.querySelector('td:nth-child(6) .badge');
        const isUsed = badge ? badge.classList.contains('bg-danger') : false;

        if (filterType === 'used') row.style.display = isUsed ? '' : 'none';
        else if (filterType === 'not_used') row.style.display = !isUsed ? '' : 'none';
        else row.style.display = '';
    });
}

</script>

<script>
function toggleSelectAll(source) {
    document.querySelectorAll('.qr-select').forEach(cb => cb.checked = source.checked);
}

function printSelectedQRs() {
    let selected = [];
    document.querySelectorAll('.qr-select:checked').forEach(cb => {
        selected.push(cb.getAttribute('data-src'));
    });

    if (selected.length === 0) {
        Swal.fire({ icon: 'info', title: 'No QR Codes Selected!' });
        return;
    }

    let html = '';
    selected.forEach((src, i) => {
        html += `
            <div class="qr-page">
                <img src="${src}" alt="QR Code">
            </div>
        `;
    });

    const printWindow = window.open('', '', 'width=800,height=900');
    printWindow.document.open();
    printWindow.document.write(`
        <html>
            <head>
                <title>Print Selected QR Codes</title>
                <style>
                    @page {
                        size: A4;
                        margin: 0;
                    }
                    body {
                        margin: 0;
                        padding: 0;
                    }
                    .qr-page {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh; /* full page height */
                        page-break-after: always; /* force new sheet */
                    }
                    .qr-page:last-child {
                        page-break-after: auto; /* prevent extra blank page */
                    }
                    img {
                        width: 300px;
                        height: 300px;
                        object-fit: contain;
                    }
                </style>
            </head>
            <body>
                ${html}
                <script>
                    window.onafterprint = function() {
                        window.close();
                    };
                    setTimeout(() => { window.print(); }, 500);
                <\/script>
            </body>
        </html>
    `);
    printWindow.document.close();
}



</script>

@endsection
