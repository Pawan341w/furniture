@extends('user.layout.app')

@section('content')
<div class="container py-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <h2 class="mb-3 mb-md-0">My Addresses</h2>
        <a href="{{ route('address.create') }}" class="btn btn-primary">Add Address</a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Desktop Table View --}}
    @if($addresses->count() > 0)
        <div class="table-responsive d-none d-md-block">
            <table class="table table-bordered align-middle text-nowrap">
                <thead class="table-light">
                    <tr>
                        <th>Street Address</th>
                            <th>Apartment, Suite, Unit</th>

                        <th>City</th>
                        <th>State</th>
                        <th>Country</th>
                        <th>Pincode</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($addresses as $address)
                        <tr>
                            <td>{{ $address->address_line1 }}</td>
                                                        <td>{{ $address->address_line2 }}</td>

                            <td>{{ $address->city }}</td>
                            <td>{{ $address->state }}</td>
                            <td>{{ $address->country }}</td>
                            <td>{{ $address->pincode }}</td>
                            <td>{{ $address->address_type }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('address.edit', $address->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('address.destroy', $address->id) }}" method="POST" onsubmit="return confirm('Delete this address?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Mobile Card View --}}
        <div class="d-md-none">
            @foreach($addresses as $address)
                <div class="card mb-3">
                    <div class="card-body">
                        <p><strong>Street Address:</strong> {{ $address->address_line1 }}</p>
                        <p><strong>Apartment, Suite, Unit:</strong> {{ $address->address_line2 }}</p>

                        <p><strong>City:</strong> {{ $address->city }}</p>
                        <p><strong>State:</strong> {{ $address->state }}</p>
                        <p><strong>Country:</strong> {{ $address->country }}</p>
                        <p><strong>Pincode:</strong> {{ $address->pincode }}</p>
                        <p><strong>Type:</strong> {{ $address->address_type }}</p>
                        <div class="d-flex gap-2 mt-2">
                            <a href="{{ route('address.edit', $address->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('address.destroy', $address->id) }}" method="POST" onsubmit="return confirm('Delete this address?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">No addresses found. Add one now!</div>
    @endif
</div>
@endsection
