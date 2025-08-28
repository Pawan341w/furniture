@extends('user.layout.app')

@section('content')
<div class="container">
    <h2>Add Address</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <form action="{{ route('address.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Street Address</label>
            <input type="text" name="address_line1" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Apartment, Suite, Unit, etc. (optional)</label>
            <input type="text" name="address_line2" class="form-control">
        </div>

        <div class="mb-3">
            <label>Landmark</label>
            <input type="text" name="landmark" class="form-control">
        </div>

        <div class="mb-3">
            <label>City</label>
            <input type="text" name="city" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>State</label>
            <input type="text" name="state" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Country</label>
            <input type="text" name="country" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Pincode</label>
            <input type="text" name="pincode" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Address Type</label>
            <select name="address_type" class="form-control" required>
                <option value="Home">Home</option>
                <option value="Work">Work</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('address.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
