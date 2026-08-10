@extends('layouts.redesign.frontend')

@section('main')
<section class="order-page">
    <div class="order-header">
        <h1>{{ $customer->name ?? 'Restaurant' }} - Table {{ $table->table_number }}</h1>
        <p>Place your order using the menu below</p>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ url('/' . $customer->slug . '/table-order') }}" class="order-form">
        @csrf
        <input type="hidden" name="table_id" value="{{ $table->id }}">

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

        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
</section>

<style>
    .order-page { max-width: 900px; margin: 2rem auto; padding: 0 1rem; }
    .order-header { text-align: center; margin-bottom: 1.5rem; }
    .order-form { display: flex; flex-direction: column; gap: 1.5rem; }
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
    .btn-primary { background: #dc2626; color: #fff; border: none; padding: 0.75rem 1.5rem; border-radius: 0.5rem; }
    .alert { padding: 0.75rem 1rem; border-radius: 0.5rem; margin-bottom: 1rem; }
    .alert-danger { background: #fee2e2; color: #991b1b; }
</style>
@endsection
