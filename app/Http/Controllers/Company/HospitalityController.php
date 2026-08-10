<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\BanquetHall;
use App\Models\Company;
use App\Models\EventBooking;
use App\Models\HotelRoom;
use App\Models\RestaurantPayment;
use App\Models\RestaurantProfile;
use App\Models\RestaurantTable;
use App\Models\RoomServiceOrder;
use App\Models\TableOrder;
use App\Models\customer;
use App\Services\QrCodeService;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;

class HospitalityController extends Controller
{
    public function profiles(Request $request)
    {
        $company = $this->getCompany($request);
        $profiles = RestaurantProfile::where('company_id', $company->id)->orderBy('display_order')->get();

        return view('company.restaurant.profiles.index', compact('company', 'profiles'));
    }

    public function storeProfile(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'profile_type' => 'required|in:restaurant,hotel,cafe,cloud_kitchen,banquet_hall',
            'profile_name' => 'nullable|string|max:150',
            'is_active' => 'nullable|boolean',
        ]);

        $maxOrder = RestaurantProfile::where('company_id', $company->id)->max('display_order') ?? 0;

        RestaurantProfile::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
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
        $company = $this->getCompany($request);
        $profile = RestaurantProfile::where('company_id', $company->id)->findOrFail($id);

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
        $company = $this->getCompany($request);
        $profile = RestaurantProfile::where('company_id', $company->id)->findOrFail($id);

        RestaurantProfile::where('company_id', $company->id)->update(['is_default' => false]);
        $profile->is_default = true;
        $profile->save();

        return back()->with('success', 'Default profile updated.');
    }

    public function deleteProfile(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $profile = RestaurantProfile::where('company_id', $company->id)->findOrFail($id);
        $profile->delete();

        return back()->with('success', 'Profile deleted successfully!');
    }
    public function tables(Request $request)
    {
        $company = $this->getCompany($request);
        $profiles = RestaurantProfile::where('company_id', $company->id)->orderBy('display_order')->get();
        $tables = RestaurantTable::where('company_id', $company->id)->orderBy('table_number')->get();

        return view('company.restaurant.tables.index', compact('company', 'tables', 'profiles'));
    }

    public function storeTable(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

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
            'company_id' => $company->id,
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
        $company = $this->getCompany($request);
        $table = RestaurantTable::where('company_id', $company->id)->findOrFail($id);

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
        $company = $this->getCompany($request);
        $table = RestaurantTable::where('company_id', $company->id)->findOrFail($id);
        $customerId = $this->resolveCustomerId($company);

        $table->qr_code_path = $this->generateTableQr($customerId, $table->id);
        $table->save();

        return back()->with('success', 'QR code regenerated.');
    }

    public function deleteTable(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $table = RestaurantTable::where('company_id', $company->id)->findOrFail($id);
        $table->delete();

        return back()->with('success', 'Table deleted successfully!');
    }

    public function rooms(Request $request)
    {
        $company = $this->getCompany($request);
        $profiles = RestaurantProfile::where('company_id', $company->id)->orderBy('display_order')->get();
        $rooms = HotelRoom::where('company_id', $company->id)->orderBy('room_number')->get();

        return view('company.restaurant.rooms.index', compact('company', 'rooms', 'profiles'));
    }

    public function storeRoom(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

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
            'company_id' => $company->id,
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
        $company = $this->getCompany($request);
        $room = HotelRoom::where('company_id', $company->id)->findOrFail($id);

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
        $company = $this->getCompany($request);
        $room = HotelRoom::where('company_id', $company->id)->findOrFail($id);
        $customerId = $this->resolveCustomerId($company);

        $room->qr_code_path = $this->generateRoomQr($customerId, $room->id);
        $room->save();

        return back()->with('success', 'QR code regenerated.');
    }

    public function deleteRoom(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $room = HotelRoom::where('company_id', $company->id)->findOrFail($id);
        $room->delete();

        return back()->with('success', 'Room deleted successfully!');
    }

    public function orders(Request $request)
    {
        $company = $this->getCompany($request);
        $tableOrders = TableOrder::where('company_id', $company->id)->orderByDesc('id')->paginate(20, ['*'], 'table_page');
        $roomOrders = RoomServiceOrder::where('company_id', $company->id)->orderByDesc('id')->paginate(20, ['*'], 'room_page');

        return view('company.restaurant.orders.index', compact('company', 'tableOrders', 'roomOrders'));
    }

    public function updateTableOrderStatus(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $order = TableOrder::where('company_id', $company->id)->findOrFail($id);

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
        $company = $this->getCompany($request);
        $order = RoomServiceOrder::where('company_id', $company->id)->findOrFail($id);

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
        $company = $this->getCompany($request);
        $events = EventBooking::where('company_id', $company->id)->orderByDesc('id')->paginate(20);

        return view('company.restaurant.events.index', compact('company', 'events'));
    }

    public function updateEventStatus(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $event = EventBooking::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'booking_status' => 'required|string|max:20',
        ]);

        $event->booking_status = $request->booking_status;
        $event->save();

        return back()->with('success', 'Event status updated.');
    }

    public function banquets(Request $request)
    {
        $company = $this->getCompany($request);
        $banquets = BanquetHall::where('company_id', $company->id)->orderByDesc('id')->paginate(20);

        return view('company.restaurant.banquets.index', compact('company', 'banquets'));
    }

    public function createBanquet(Request $request)
    {
        $company = $this->getCompany($request);

        return view('company.restaurant.banquets.form', ['company' => $company, 'banquet' => null]);
    }

    public function storeBanquet(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

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
            'company_id' => $company->id,
            'hall_name' => $request->hall_name,
            'capacity_min' => $request->capacity_min,
            'capacity_max' => $request->capacity_max,
            'hall_type' => $request->hall_type,
            'size_sqft' => $request->size_sqft,
            'price_per_plate' => $request->price_per_plate,
            'price_per_day' => $request->price_per_day,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect('/company/restaurant/banquets')->with('success', 'Banquet hall added.');
    }

    public function editBanquet(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $banquet = BanquetHall::where('company_id', $company->id)->findOrFail($id);

        return view('company.restaurant.banquets.form', compact('company', 'banquet'));
    }

    public function updateBanquet(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $banquet = BanquetHall::where('company_id', $company->id)->findOrFail($id);

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

        return redirect('/company/restaurant/banquets')->with('success', 'Banquet hall updated.');
    }

    public function deleteBanquet(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $banquet = BanquetHall::where('company_id', $company->id)->findOrFail($id);
        $banquet->delete();

        return back()->with('success', 'Banquet hall deleted.');
    }

    public function payments(Request $request)
    {
        $company = $this->getCompany($request);
        $payments = RestaurantPayment::where('company_id', $company->id)->orderByDesc('id')->paginate(20);

        return view('company.restaurant.payments.index', compact('company', 'payments'));
    }

    public function kitchen(Request $request)
    {
        $company = $this->getCompany($request);
        $tableOrders = TableOrder::where('company_id', $company->id)
            ->whereIn('order_status', ['pending', 'preparing', 'ready'])
            ->orderByDesc('order_time')
            ->with('table')
            ->get();

        $roomOrders = RoomServiceOrder::where('company_id', $company->id)
            ->whereIn('status', ['pending', 'in_progress'])
            ->orderByDesc('requested_time')
            ->with('room')
            ->get();

        return view('company.restaurant.kitchen.index', compact('company', 'tableOrders', 'roomOrders'));
    }

    public function analytics(Request $request)
    {
        $company = $this->getCompany($request);
        $tableOrders = TableOrder::where('company_id', $company->id)->get();
        $roomOrders = RoomServiceOrder::where('company_id', $company->id)->get();

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

        return view('company.restaurant.analytics.index', compact('company', 'tableRevenue', 'roomRevenue', 'statusCounts', 'last7Days'));
    }

    private function getCompany(Request $request): Company
    {
        $companyId = $request->session()->get('COMPANY_ID');
        return Company::findOrFail($companyId);
    }

    private function resolveCustomerId(Company $company): int
    {
        if ($company->created_by) {
            return (int) $company->created_by;
        }

        $customerId = $company->customers()->value('id');
        if (!$customerId) {
            abort(400, 'Company owner not found.');
        }

        return (int) $customerId;
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
