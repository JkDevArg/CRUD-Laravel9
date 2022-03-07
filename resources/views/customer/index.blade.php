@extends('app')
@section('content')
@if(session('success'))
<p class="alert alert-success">{{ session('success') }}</p>
@endif
<div class="card">
    <div class="card-header">
        <form class="row row-cols-auto g-l" autocomplete="off">
            <div class="col">
                <input type="text" class="form-control" name="q" value="{{ $q }}" placeholder="Search Here..." />
            </div>
            <div class="col">
                <button class="btn btn-info text-light">Refresh</button>
            </div>
            <div class="col">
                <a class="btn btn-success" href="{{ route('customer.create') }}">Add</a>
            </div>
        </form>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-bordered table-striped table-hover n-0">
            <thead>
                <th>#</th>
                <th>Customer Name</th>
                <th>Contact Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Action</th>
            </thead>
            <?php $no = 1; ?>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $customer->customer_name }}</td>
                <td>{{ $customer->contact_name }}</td>
                <td>{{ $customer->address }}</td>
                <td>{{ $customer->city }}</td>
                <td>
                    <a href="{{ route('customer.edit', $customer) }}" class="btn btn-sm btn-info">Edit</a>
                    <form method="POST" action="{{ route('customer.destroy', $customer) }}" style="display: inline;" onsubmit="return confirm('Delete?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection