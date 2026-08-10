@extends('layouts.redesign.frontend')

@section('main')
<section class="order-page">
    <div class="order-header">
        <h1>{{ $customer->name ?? 'Hotel' }} - Room {{ $room->room_number }}</h1>
        <p>Request room services and place orders</p>
    </div>

    <form method="POST" action="{{ url('/' . $customer->slug . '/room-service') }}" class="order-form">
        @csrf
        <input type="hidden" name="room_id" value="{{ $room->id }}">

        <div class="form-row">
            <div class="form-group">
                <label>Guest Name</label>
                <input type="text" name="guest_name" placeholder="Optional">
            </div>
            <div class="form-group">
                <label>Service Type</label>
                <select name="service_type" required>
                    <option value="food">Food</option>
                    <option value="housekeeping">Housekeeping</option>
                    <option value="laundry">Laundry</option>
                    <option value="minibar">Minibar</option>
                    <option value="amenity">Amenities</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>
            <div class="form-group">
                <label>Priority</label>
                <select name="priority">
                    <option value="normal">Normal</option>
                    <option value="high">High</option>
                    <option value="urgent">Urgent</option>
                </select>
            </div>
        </div>

        @foreach($categories as $category)
            @if($category->items->count() > 0)
            <div class="menu-section">
                <h2>{{ $category->name }}</h2>
                <div class="menu-items">
                    @foreach($category->items as $item)
                    <div class="menu-item">
                        <div class="menu-item-info">
                            <div class="menu-item-name">{{ $item->name }}</div>
                            @if($item->description)
                                <div class="menu-item-desc">{{ $item->description }}</div>
                            @endif
                            <div class="menu-item-price">Rs. {{ number_format($item->price ?? 0, 2) }}</div>
                        </div>
                        <div class="menu-item-qty">
                            <label>Qty</label>
                            <input type="number" name="items[{{ $item->id }}]" min="0" value="0">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        @endforeach

        <div class="form-group">
            <label>Notes</label>
            <textarea name="notes" rows="3" placeholder="Any special requests?"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Request</button>
    </form>
</section>

<style>
    .order-page { max-width: 900px; margin: 2rem auto; padding: 0 1rem; }
    .order-header { text-align: center; margin-bottom: 1.5rem; }
    .order-form { display: flex; flex-direction: column; gap: 1.5rem; }
    .form-row { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); }
    .form-group input, .form-group select { width: 100%; padding: 0.6rem; border: 1px solid #d1d5db; border-radius: 0.4rem; }
    .menu-section { background: #fff; border-radius: 0.75rem; padding: 1rem; border: 1px solid #e5e7eb; }
    .menu-section h2 { margin-bottom: 0.75rem; font-size: 1.2rem; }
    .menu-item { display: flex; justify-content: space-between; gap: 1rem; padding: 0.75rem 0; border-bottom: 1px solid #f1f5f9; }
    .menu-item:last-child { border-bottom: none; }
    .menu-item-name { font-weight: 600; }
    .menu-item-desc { color: #6b7280; font-size: 0.85rem; margin-top: 0.25rem; }
    .menu-item-price { margin-top: 0.5rem; font-weight: 600; color: #0f172a; }
    .menu-item-qty label { display: block; font-size: 0.8rem; color: #6b7280; margin-bottom: 0.25rem; }
    .menu-item-qty input { width: 70px; padding: 0.4rem; border: 1px solid #d1d5db; border-radius: 0.4rem; }
    .form-group textarea { width: 100%; border: 1px solid #d1d5db; border-radius: 0.5rem; padding: 0.75rem; }
    .btn-primary { background: #0f172a; color: #fff; border: none; padding: 0.75rem 1.5rem; border-radius: 0.5rem; }
</style>
@endsection
