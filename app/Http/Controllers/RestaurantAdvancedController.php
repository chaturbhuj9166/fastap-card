<?php

namespace App\Http\Controllers;

use App\Models\BanquetHall;
use App\Models\EventBooking;
use App\Models\HotelRoom;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\KitchenOrderStatus;
use App\Models\RestaurantOrderItem;
use App\Models\RestaurantPayment;
use App\Models\RestaurantProfile;
use App\Models\RestaurantTable;
use App\Models\RoomServiceOrder;
use App\Models\TableOrder;
use Carbon\CarbonImmutable;
use App\Models\customer;
use App\Services\QrCodeService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RestaurantAdvancedController extends Controller
{
    // =====================
    // User Dashboard (Customer)
    // =====================

    public function profiles(Request $request)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $profiles = RestaurantProfile::where('customer_id', $customerId)->orderBy('display_order')->get();

        return view('userdashboard-new.restaurant.profiles.index', compact('profiles'));
    }

    public function storeProfile(Request $request)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $customer = customer::findOrFail($customerId);

        $request->validate([
            'profile_type' => 'required|in:restaurant,hotel,cafe,cloud_kitchen,banquet_hall',
            'profile_name' => 'nullable|string|max:150',
            'is_active' => 'nullable|boolean',
        ]);

        $maxOrder = RestaurantProfile::where('customer_id', $customerId)->max('display_order') ?? 0;

        RestaurantProfile::create([
            'customer_id' => $customerId,
            'company_id' => $customer->company_id,
            'profile_type' => $request->profile_type,
            'profile_name' => $request->profile_name,
            'is_active' => $request->has('is_active'),
            'is_default' => false,
            'display_order' => $maxOrder + 1,
        ]);

        return back()->with('success', 'Profile created successfully!');
    }

    public function updateProfile(Request $request, $id)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $profile = RestaurantProfile::where('customer_id', $customerId)->findOrFail($id);

        $request->validate([
            'profile_type' => 'required|in:restaurant,hotel,cafe,cloud_kitchen,banquet_hall',
            'profile_name' => 'nullable|string|max:150',
            'is_active' => 'nullable|boolean',
        ]);

        $profile->update([
            'profile_type' => $request->profile_type,
            'profile_name' => $request->profile_name,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Profile updated successfully!');
    }

    public function setDefaultProfile(Request $request, $id)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $profile = RestaurantProfile::where('customer_id', $customerId)->findOrFail($id);

        RestaurantProfile::where('customer_id', $customerId)->update(['is_default' => false]);
        $profile->is_default = true;
        $profile->save();

        return back()->with('success', 'Default profile updated.');
    }

    public function deleteProfile(Request $request, $id)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $profile = RestaurantProfile::where('customer_id', $customerId)->findOrFail($id);
        $profile->delete();

        return back()->with('success', 'Profile deleted successfully!');
    }

    public function tables(Request $request)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $tables = RestaurantTable::where('customer_id', $customerId)->orderBy('table_number')->get();
        $profiles = RestaurantProfile::where('customer_id', $customerId)->orderBy('display_order')->get();

        return view('userdashboard-new.restaurant.tables.index', compact('tables', 'profiles'));
    }

    public function storeTable(Request $request)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $customer = customer::findOrFail($customerId);

        $request->validate([
            'table_number' => 'required|string|max:50',
            'table_type' => 'nullable|string|max:50',
            'seating_capacity' => 'nullable|integer|min:0',
            'status' => 'nullable|string|max:20',
            'location_area' => 'nullable|string|max:100',
            'profile_id' => 'nullable|integer|exists:restaurant_profiles,id',
        ]);

        $table = RestaurantTable::create([
            'customer_id' => $customerId,
            'company_id' => $customer->company_id,
            'profile_id' => $request->profile_id,
            'table_number' => $request->table_number,
            'table_type' => $request->table_type,
            'seating_capacity' => $request->seating_capacity,
            'status' => $request->status ?? 'available',
            'location_area' => $request->location_area,
        ]);

        $table->qr_code_path = $this->generateTableQr($customerId, $table->id);
        $table->save();

        return back()->with('success', 'Table created successfully!');
    }

    public function updateTable(Request $request, $id)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $table = RestaurantTable::where('customer_id', $customerId)->findOrFail($id);

        $request->validate([
            'table_number' => 'required|string|max:50',
            'table_type' => 'nullable|string|max:50',
            'seating_capacity' => 'nullable|integer|min:0',
            'status' => 'nullable|string|max:20',
            'location_area' => 'nullable|string|max:100',
            'profile_id' => 'nullable|integer|exists:restaurant_profiles,id',
        ]);

        $table->update([
            'profile_id' => $request->profile_id,
            'table_number' => $request->table_number,
            'table_type' => $request->table_type,
            'seating_capacity' => $request->seating_capacity,
            'status' => $request->status ?? 'available',
            'location_area' => $request->location_area,
        ]);

        return back()->with('success', 'Table updated successfully!');
    }

    public function regenerateTableQr(Request $request, $id)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $table = RestaurantTable::where('customer_id', $customerId)->findOrFail($id);

        $table->qr_code_path = $this->generateTableQr($customerId, $table->id);
        $table->save();

        return back()->with('success', 'QR code regenerated.');
    }

    public function deleteTable(Request $request, $id)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $table = RestaurantTable::where('customer_id', $customerId)->findOrFail($id);
        $table->delete();

        return back()->with('success', 'Table deleted successfully!');
    }

    public function rooms(Request $request)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $rooms = HotelRoom::where('customer_id', $customerId)->orderBy('room_number')->get();
        $profiles = RestaurantProfile::where('customer_id', $customerId)->orderBy('display_order')->get();

        return view('userdashboard-new.restaurant.rooms.index', compact('rooms', 'profiles'));
    }

    public function storeRoom(Request $request)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $customer = customer::findOrFail($customerId);

        $request->validate([
            'room_number' => 'required|string|max:50',
            'room_type' => 'nullable|string|max:50',
            'floor' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:20',
            'max_occupancy' => 'nullable|integer|min:0',
            'profile_id' => 'nullable|integer|exists:restaurant_profiles,id',
        ]);

        $room = HotelRoom::create([
            'customer_id' => $customerId,
            'company_id' => $customer->company_id,
            'profile_id' => $request->profile_id,
            'room_number' => $request->room_number,
            'room_type' => $request->room_type,
            'floor' => $request->floor,
            'status' => $request->status ?? 'vacant',
            'max_occupancy' => $request->max_occupancy,
        ]);

        $room->qr_code_path = $this->generateRoomQr($customerId, $room->id);
        $room->save();

        return back()->with('success', 'Room created successfully!');
    }

    public function updateRoom(Request $request, $id)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $room = HotelRoom::where('customer_id', $customerId)->findOrFail($id);

        $request->validate([
            'room_number' => 'required|string|max:50',
            'room_type' => 'nullable|string|max:50',
            'floor' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:20',
            'max_occupancy' => 'nullable|integer|min:0',
            'profile_id' => 'nullable|integer|exists:restaurant_profiles,id',
        ]);

        $room->update([
            'profile_id' => $request->profile_id,
            'room_number' => $request->room_number,
            'room_type' => $request->room_type,
            'floor' => $request->floor,
            'status' => $request->status ?? 'vacant',
            'max_occupancy' => $request->max_occupancy,
        ]);

        return back()->with('success', 'Room updated successfully!');
    }

    public function regenerateRoomQr(Request $request, $id)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $room = HotelRoom::where('customer_id', $customerId)->findOrFail($id);

        $room->qr_code_path = $this->generateRoomQr($customerId, $room->id);
        $room->save();

        return back()->with('success', 'QR code regenerated.');
    }

    public function deleteRoom(Request $request, $id)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $room = HotelRoom::where('customer_id', $customerId)->findOrFail($id);
        $room->delete();

        return back()->with('success', 'Room deleted successfully!');
    }

    public function orders(Request $request)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $tableOrders = TableOrder::where('customer_id', $customerId)->orderByDesc('id')->paginate(20, ['*'], 'table_page');
        $roomOrders = RoomServiceOrder::where('customer_id', $customerId)->orderByDesc('id')->paginate(20, ['*'], 'room_page');

        return view('userdashboard-new.restaurant.orders.index', compact('tableOrders', 'roomOrders'));
    }

    public function updateTableOrderStatus(Request $request, $id)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $order = TableOrder::where('customer_id', $customerId)->findOrFail($id);

        $request->validate([
            'order_status' => 'required|string|max:20',
        ]);

        $order->order_status = $request->order_status;
        if ($request->order_status === 'served') {
            $order->served_time = Carbon::now();
        }
        $order->save();

        return back()->with('success', 'Order status updated.');
    }

    public function updateRoomOrderStatus(Request $request, $id)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $order = RoomServiceOrder::where('customer_id', $customerId)->findOrFail($id);

        $request->validate([
            'status' => 'required|string|max:20',
        ]);

        $order->status = $request->status;
        if ($request->status === 'completed') {
            $order->completed_time = Carbon::now();
        }
        $order->save();

        return back()->with('success', 'Room service status updated.');
    }

    public function events(Request $request)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $events = EventBooking::where('customer_id', $customerId)->orderByDesc('id')->paginate(20);

        return view('userdashboard-new.restaurant.events.index', compact('events'));
    }

    public function updateEventStatus(Request $request, $id)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $event = EventBooking::where('customer_id', $customerId)->findOrFail($id);

        $request->validate([
            'booking_status' => 'required|string|max:20',
        ]);

        $event->booking_status = $request->booking_status;
        $event->save();

        return back()->with('success', 'Event status updated.');
    }

    public function banquets(Request $request)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $banquets = BanquetHall::where('customer_id', $customerId)->orderByDesc('id')->paginate(20);

        return view('userdashboard-new.restaurant.banquets.index', compact('banquets'));
    }

    public function createBanquet(Request $request)
    {
        return view('userdashboard-new.restaurant.banquets.form', ['banquet' => null]);
    }

    public function storeBanquet(Request $request)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');

        $request->validate([
            'hall_name' => 'required|string|max:150',
            'capacity_min' => 'nullable|integer|min:0',
            'capacity_max' => 'nullable|integer|min:0',
            'hall_type' => 'nullable|string|max:50',
            'size_sqft' => 'nullable|integer|min:0',
            'price_per_plate' => 'nullable|numeric|min:0',
            'price_per_day' => 'nullable|numeric|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        BanquetHall::create([
            'customer_id' => $customerId,
            'hall_name' => $request->hall_name,
            'capacity_min' => $request->capacity_min,
            'capacity_max' => $request->capacity_max,
            'hall_type' => $request->hall_type,
            'size_sqft' => $request->size_sqft,
            'price_per_plate' => $request->price_per_plate,
            'price_per_day' => $request->price_per_day,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect('/user/restaurant/banquets')->with('success', 'Banquet hall added.');
    }

    public function editBanquet(Request $request, $id)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $banquet = BanquetHall::where('customer_id', $customerId)->findOrFail($id);

        return view('userdashboard-new.restaurant.banquets.form', compact('banquet'));
    }

    public function updateBanquet(Request $request, $id)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $banquet = BanquetHall::where('customer_id', $customerId)->findOrFail($id);

        $request->validate([
            'hall_name' => 'required|string|max:150',
            'capacity_min' => 'nullable|integer|min:0',
            'capacity_max' => 'nullable|integer|min:0',
            'hall_type' => 'nullable|string|max:50',
            'size_sqft' => 'nullable|integer|min:0',
            'price_per_plate' => 'nullable|numeric|min:0',
            'price_per_day' => 'nullable|numeric|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $banquet->update([
            'hall_name' => $request->hall_name,
            'capacity_min' => $request->capacity_min,
            'capacity_max' => $request->capacity_max,
            'hall_type' => $request->hall_type,
            'size_sqft' => $request->size_sqft,
            'price_per_plate' => $request->price_per_plate,
            'price_per_day' => $request->price_per_day,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect('/user/restaurant/banquets')->with('success', 'Banquet hall updated.');
    }

    public function deleteBanquet(Request $request, $id)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $banquet = BanquetHall::where('customer_id', $customerId)->findOrFail($id);
        $banquet->delete();

        return back()->with('success', 'Banquet hall deleted.');
    }

    public function payments(Request $request)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $payments = RestaurantPayment::where('customer_id', $customerId)->orderByDesc('id')->paginate(20);

        return view('userdashboard-new.restaurant.payments.index', compact('payments'));
    }

    public function kitchen(Request $request)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $tableOrders = TableOrder::where('customer_id', $customerId)
            ->whereIn('order_status', ['pending', 'preparing', 'ready'])
            ->orderByDesc('order_time')
            ->with('table')
            ->get();

        $roomOrders = RoomServiceOrder::where('customer_id', $customerId)
            ->whereIn('status', ['pending', 'in_progress'])
            ->orderByDesc('requested_time')
            ->with('room')
            ->get();

        return view('userdashboard-new.restaurant.kitchen.index', compact('tableOrders', 'roomOrders'));
    }

    public function analytics(Request $request)
    {
        $customerId = $request->session()->get('FRONT_USER_ID');
        $tableOrders = TableOrder::where('customer_id', $customerId)->get();
        $roomOrders = RoomServiceOrder::where('customer_id', $customerId)->get();

        $tableRevenue = $tableOrders->sum('total_amount');
        $roomRevenue = $roomOrders->sum(function ($order) {
            return $order->order_details['total'] ?? 0;
        });

        $statusCounts = [
            'table' => $tableOrders->groupBy('order_status')->map->count(),
            'room' => $roomOrders->groupBy('status')->map->count(),
        ];

        $today = CarbonImmutable::now();
        $last7Days = [];
        for ($i = 6; $i >= 0; $i--) {
            $day = $today->subDays($i)->format('Y-m-d');
            $tableCount = $tableOrders->filter(function ($order) use ($day) {
                if (!$order->order_time) {
                    return false;
                }
                return $order->order_time->format('Y-m-d') === $day;
            })->count();
            $roomCount = $roomOrders->filter(function ($order) use ($day) {
                if (!$order->requested_time) {
                    return false;
                }
                return $order->requested_time->format('Y-m-d') === $day;
            })->count();
            $last7Days[] = [
                'date' => $day,
                'table_orders' => $tableCount,
                'room_orders' => $roomCount,
            ];
        }

        return view('userdashboard-new.restaurant.analytics.index', compact('tableRevenue', 'roomRevenue', 'statusCounts', 'last7Days'));
    }

    // =====================
    // Frontend Ordering
    // =====================

    public function tableOrderForm(Request $request, $slug)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();
        $tableId = $request->query('table');

        $table = RestaurantTable::where('customer_id', $customer->id)->where('id', $tableId)->firstOrFail();
        $categories = MenuCategory::where('customer_id', $customer->id)
            ->active()
            ->ordered()
            ->with(['items' => function ($query) {
                $query->available()->ordered();
            }])
            ->get();

        return view('frontend.restaurant.table-order', compact('customer', 'table', 'categories'));
    }

    public function storeTableOrder(Request $request, $slug)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();
        $tableId = $request->input('table_id');

        $table = RestaurantTable::where('customer_id', $customer->id)->where('id', $tableId)->firstOrFail();

        $itemsPayload = $request->input('items', []);
        $items = [];
        $total = 0;

        foreach ($itemsPayload as $itemId => $quantity) {
            $quantity = (int) $quantity;
            if ($quantity <= 0) {
                continue;
            }
            $menuItem = MenuItem::where('customer_id', $customer->id)->find($itemId);
            if (!$menuItem) {
                continue;
            }
            $price = $menuItem->discounted_price ?? $menuItem->price ?? 0;
            $items[] = [
                'menu_item_id' => $menuItem->id,
                'name' => $menuItem->name,
                'quantity' => $quantity,
                'price' => $price,
                'subtotal' => $price * $quantity,
            ];
            $total += $price * $quantity;
        }

        if (empty($items)) {
            return back()->with('error', 'Please select at least one item.');
        }

        $order = TableOrder::create([
            'customer_id' => $customer->id,
            'company_id' => $customer->company_id,
            'table_id' => $table->id,
            'order_number' => strtoupper('T' . $table->id . '-' . Str::random(6)),
            'items' => $items,
            'total_amount' => $total,
            'order_status' => 'pending',
            'order_time' => Carbon::now(),
            'payment_status' => 'pending',
            'notes' => $request->input('notes'),
        ]);

        foreach ($items as $item) {
            RestaurantOrderItem::create([
                'customer_id' => $customer->id,
                'company_id' => $customer->company_id,
                'order_type' => 'table',
                'order_id' => $order->id,
                'menu_item_id' => $item['menu_item_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        KitchenOrderStatus::create([
            'customer_id' => $customer->id,
            'company_id' => $customer->company_id,
            'order_type' => 'table',
            'order_id' => $order->id,
            'status' => 'received',
        ]);

        return redirect()->route('restaurant.table.thanks', ['slug' => $slug, 'orderId' => $order->id]);
    }

    public function roomServiceForm(Request $request, $slug)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();
        $roomId = $request->query('room');

        $room = HotelRoom::where('customer_id', $customer->id)->where('id', $roomId)->firstOrFail();
        $categories = MenuCategory::where('customer_id', $customer->id)
            ->active()
            ->ordered()
            ->with(['items' => function ($query) {
                $query->available()->ordered();
            }])
            ->get();

        return view('frontend.restaurant.room-service', compact('customer', 'room', 'categories'));
    }

    public function storeRoomService(Request $request, $slug)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();
        $roomId = $request->input('room_id');

        $room = HotelRoom::where('customer_id', $customer->id)->where('id', $roomId)->firstOrFail();

        $request->validate([
            'service_type' => 'required|string|max:50',
        ]);

        $itemsPayload = $request->input('items', []);
        $items = [];
        $total = 0;

        foreach ($itemsPayload as $itemId => $quantity) {
            $quantity = (int) $quantity;
            if ($quantity <= 0) {
                continue;
            }
            $menuItem = MenuItem::where('customer_id', $customer->id)->find($itemId);
            if (!$menuItem) {
                continue;
            }
            $price = $menuItem->discounted_price ?? $menuItem->price ?? 0;
            $items[] = [
                'menu_item_id' => $menuItem->id,
                'name' => $menuItem->name,
                'quantity' => $quantity,
                'price' => $price,
                'subtotal' => $price * $quantity,
            ];
            $total += $price * $quantity;
        }

        $order = RoomServiceOrder::create([
            'customer_id' => $customer->id,
            'company_id' => $customer->company_id,
            'room_id' => $room->id,
            'guest_name' => $request->input('guest_name'),
            'service_type' => $request->service_type,
            'order_details' => [
                'items' => $items,
                'total' => $total,
            ],
            'priority' => $request->input('priority', 'normal'),
            'status' => 'pending',
            'requested_time' => Carbon::now(),
            'notes' => $request->input('notes'),
        ]);

        foreach ($items as $item) {
            RestaurantOrderItem::create([
                'customer_id' => $customer->id,
                'company_id' => $customer->company_id,
                'order_type' => 'room',
                'order_id' => $order->id,
                'menu_item_id' => $item['menu_item_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        KitchenOrderStatus::create([
            'customer_id' => $customer->id,
            'company_id' => $customer->company_id,
            'order_type' => 'room',
            'order_id' => $order->id,
            'status' => 'received',
        ]);

        return redirect()->route('restaurant.room.thanks', ['slug' => $slug, 'orderId' => $order->id]);
    }

    public function eventBookingForm(Request $request, $slug)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();

        return view('frontend.restaurant.event-booking', compact('customer'));
    }

    public function storeEventBooking(Request $request, $slug)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();

        $request->validate([
            'client_name' => 'required|string|max:150',
            'client_mobile' => 'required|string|max:20',
            'event_type' => 'required|string|max:100',
            'event_date' => 'required|date',
            'guest_count' => 'nullable|integer|min:0',
        ]);

        EventBooking::create([
            'customer_id' => $customer->id,
            'company_id' => $customer->company_id,
            'client_name' => $request->client_name,
            'client_mobile' => $request->client_mobile,
            'client_email' => $request->client_email,
            'event_type' => $request->event_type,
            'event_date' => $request->event_date,
            'time_slot' => $request->time_slot,
            'guest_count' => $request->guest_count,
            'venue_area' => $request->venue_area,
            'food_preference' => $request->food_preference,
            'decoration_theme' => $request->decoration_theme,
            'photography_package' => $request->photography_package,
            'booking_status' => 'inquiry',
            'special_requirements' => $request->special_requirements,
        ]);

        return redirect()->route('restaurant.event.thanks', ['slug' => $slug]);
    }

    public function orderThanks(Request $request, $slug, $orderId)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();
        $order = TableOrder::where('customer_id', $customer->id)->findOrFail($orderId);

        return view('frontend.restaurant.table-thanks', compact('customer', 'order'));
    }

    public function roomThanks(Request $request, $slug, $orderId)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();
        $order = RoomServiceOrder::where('customer_id', $customer->id)->findOrFail($orderId);

        return view('frontend.restaurant.room-thanks', compact('customer', 'order'));
    }

    public function eventThanks(Request $request, $slug)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();

        return view('frontend.restaurant.event-thanks', compact('customer'));
    }

    private function generateTableQr(int $customerId, int $tableId): string
    {
        $customer = customer::findOrFail($customerId);
        $url = url('/' . $customer->slug . '/table-order?table=' . $tableId);

        return QrCodeService::generatePng($url, 'table');
    }

    private function generateRoomQr(int $customerId, int $roomId): string
    {
        $customer = customer::findOrFail($customerId);
        $url = url('/' . $customer->slug . '/room-service?room=' . $roomId);

        return QrCodeService::generatePng($url, 'room');
    }
}
