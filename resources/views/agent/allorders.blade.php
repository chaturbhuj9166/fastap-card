@extends('agent.layouts.main')

@section('page_title', 'All Orders')

@section('main-container')
<div class="container-fluid">
  <h4 class="fw-bold py-1"><span class="text-muted fw-light">Order Management /</span> All Orders</h4>

  @if ($message = Session::get('success'))
    <div class="alert alert-success">
      <strong>{{ $message }}</strong>
    </div>
  @endif

  <div class="card">
    <div class="card-header bg-primary text-white">
      <i class="fa fa-table"></i> All Orders
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Contact</th>
              <th>Product</th>
              <th>Commission</th>
              <th>Price</th>
              <th>Status</th>
              <th>Type</th>
              <th>Earned</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orderProducts as $key => $item)
              @php
                $earned = ($item->commission / 100) * $item->price * $item->quantity;
              @endphp
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->shipping_first_name }} {{ $item->shipping_last_name }}</td>
                <td>{{ $item->shipping_phone }}</td>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->commission }}%</td>
                <td>₹{{ $item->price }} × {{ $item->quantity }}</td>
                <td>{{ ucfirst($item->payment_status) }}</td>
                <td>{{ ucfirst($item->payment_type) }}</td>
                <td>₹{{ number_format($earned, 2) }}</td>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="pagination justify-content-center mt-3">
          {{ $orderProducts->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
