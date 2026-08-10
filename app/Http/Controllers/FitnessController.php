<?php

namespace App\Http\Controllers;

use App\Models\ClassBooking;
use App\Models\DietPlan;
use App\Models\FitnessClass;
use App\Models\FitnessMembership;
use App\Models\FitnessProgram;
use App\Models\FitnessTrainer;
use App\Models\MemberProgress;
use App\Models\MemberSubscription;
use App\Models\TransformationGallery;
use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FitnessController extends Controller
{
    // =====================
    // User Dashboard (Customer)
    // =====================

    public function programs()
    {
        $user = Auth::guard('customer')->user();
        $programs = FitnessProgram::where('customer_id', $user->id)->orderByDesc('created_at')->get();
        $trainers = FitnessTrainer::where('customer_id', $user->id)->orderBy('trainer_name')->get();

        return view('userdashboard-new.fitness.programs.index', compact('programs', 'trainers'));
    }

    public function storeProgram(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'program_type' => 'required|string|max:40',
            'program_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'trainer_id' => 'nullable|exists:fitness_trainers,id',
            'duration_weeks' => 'nullable|integer|min:0',
            'sessions_per_week' => 'nullable|integer|min:0',
            'session_duration_minutes' => 'nullable|integer|min:0',
            'max_participants' => 'nullable|integer|min:0',
            'price' => 'nullable|numeric|min:0',
            'features' => 'nullable|string',
            'suitable_for' => 'nullable|string',
            'goals' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        FitnessProgram::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'program_type' => $request->program_type,
            'program_name' => $request->program_name,
            'description' => $request->description,
            'trainer_id' => $request->trainer_id,
            'duration_weeks' => $request->duration_weeks,
            'sessions_per_week' => $request->sessions_per_week,
            'session_duration_minutes' => $request->session_duration_minutes,
            'max_participants' => $request->max_participants,
            'price' => $request->price,
            'features' => $this->splitLines($request->features),
            'suitable_for' => $this->splitLines($request->suitable_for),
            'goals' => $this->splitLines($request->goals),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Program added successfully!');
    }

    public function updateProgram(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $program = FitnessProgram::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'program_type' => 'required|string|max:40',
            'program_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'trainer_id' => 'nullable|exists:fitness_trainers,id',
            'duration_weeks' => 'nullable|integer|min:0',
            'sessions_per_week' => 'nullable|integer|min:0',
            'session_duration_minutes' => 'nullable|integer|min:0',
            'max_participants' => 'nullable|integer|min:0',
            'price' => 'nullable|numeric|min:0',
            'features' => 'nullable|string',
            'suitable_for' => 'nullable|string',
            'goals' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $program->update([
            'program_type' => $request->program_type,
            'program_name' => $request->program_name,
            'description' => $request->description,
            'trainer_id' => $request->trainer_id,
            'duration_weeks' => $request->duration_weeks,
            'sessions_per_week' => $request->sessions_per_week,
            'session_duration_minutes' => $request->session_duration_minutes,
            'max_participants' => $request->max_participants,
            'price' => $request->price,
            'features' => $this->splitLines($request->features),
            'suitable_for' => $this->splitLines($request->suitable_for),
            'goals' => $this->splitLines($request->goals),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Program updated.');
    }

    public function deleteProgram($id)
    {
        $user = Auth::guard('customer')->user();
        $program = FitnessProgram::where('customer_id', $user->id)->findOrFail($id);
        $program->delete();

        return back()->with('success', 'Program removed.');
    }

    public function trainers()
    {
        $user = Auth::guard('customer')->user();
        $trainers = FitnessTrainer::where('customer_id', $user->id)->orderByDesc('created_at')->get();

        return view('userdashboard-new.fitness.trainers.index', compact('trainers'));
    }

    public function storeTrainer(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'trainer_name' => 'required|string|max:150',
            'specialization' => 'nullable|string',
            'certifications' => 'nullable|string',
            'experience_years' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|max:2048',
            'bio' => 'nullable|string',
            'languages' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $photoName = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = 'trainer-' . Str::random(8) . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/fitness/trainers'), $photoName);
        }

        FitnessTrainer::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'trainer_name' => $request->trainer_name,
            'specialization' => $this->splitLines($request->specialization),
            'certifications' => $this->splitLines($request->certifications),
            'experience_years' => $request->experience_years,
            'photo' => $photoName,
            'bio' => $request->bio,
            'languages' => $this->splitLines($request->languages),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Trainer added successfully!');
    }

    public function updateTrainer(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $trainer = FitnessTrainer::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'trainer_name' => 'required|string|max:150',
            'specialization' => 'nullable|string',
            'certifications' => 'nullable|string',
            'experience_years' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|max:2048',
            'bio' => 'nullable|string',
            'languages' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $photoName = $trainer->photo;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = 'trainer-' . Str::random(8) . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/fitness/trainers'), $photoName);
        }

        $trainer->update([
            'trainer_name' => $request->trainer_name,
            'specialization' => $this->splitLines($request->specialization),
            'certifications' => $this->splitLines($request->certifications),
            'experience_years' => $request->experience_years,
            'photo' => $photoName,
            'bio' => $request->bio,
            'languages' => $this->splitLines($request->languages),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Trainer updated.');
    }

    public function deleteTrainer($id)
    {
        $user = Auth::guard('customer')->user();
        $trainer = FitnessTrainer::where('customer_id', $user->id)->findOrFail($id);
        $trainer->delete();

        return back()->with('success', 'Trainer removed.');
    }

    public function memberships()
    {
        $user = Auth::guard('customer')->user();
        $memberships = FitnessMembership::where('customer_id', $user->id)->orderByDesc('created_at')->get();

        return view('userdashboard-new.fitness.memberships.index', compact('memberships'));
    }

    public function storeMembership(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'plan_name' => 'required|string|max:150',
            'duration_months' => 'nullable|integer|min:0',
            'session_type' => 'nullable|string|max:60',
            'price' => 'nullable|numeric|min:0',
            'features' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        FitnessMembership::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'plan_name' => $request->plan_name,
            'duration_months' => $request->duration_months,
            'session_type' => $request->session_type,
            'price' => $request->price,
            'features' => $this->splitLines($request->features),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Membership added successfully!');
    }

    public function updateMembership(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $membership = FitnessMembership::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'plan_name' => 'required|string|max:150',
            'duration_months' => 'nullable|integer|min:0',
            'session_type' => 'nullable|string|max:60',
            'price' => 'nullable|numeric|min:0',
            'features' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $membership->update([
            'plan_name' => $request->plan_name,
            'duration_months' => $request->duration_months,
            'session_type' => $request->session_type,
            'price' => $request->price,
            'features' => $this->splitLines($request->features),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Membership updated.');
    }

    public function deleteMembership($id)
    {
        $user = Auth::guard('customer')->user();
        $membership = FitnessMembership::where('customer_id', $user->id)->findOrFail($id);
        $membership->delete();

        return back()->with('success', 'Membership removed.');
    }

    public function subscriptions()
    {
        $user = Auth::guard('customer')->user();
        $subscriptions = MemberSubscription::where('customer_id', $user->id)->orderByDesc('created_at')->get();
        $memberships = FitnessMembership::where('customer_id', $user->id)->orderBy('plan_name')->get();

        return view('userdashboard-new.fitness.subscriptions.index', compact('subscriptions', 'memberships'));
    }

    public function storeSubscription(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'member_name' => 'required|string|max:150',
            'member_mobile' => 'nullable|string|max:30',
            'member_email' => 'nullable|email|max:150',
            'membership_id' => 'nullable|exists:fitness_memberships,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'nullable|string|max:20',
            'payment_status' => 'nullable|string|max:30',
            'auto_renewal' => 'nullable|boolean',
        ]);

        MemberSubscription::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'member_name' => $request->member_name,
            'member_mobile' => $request->member_mobile,
            'member_email' => $request->member_email,
            'membership_id' => $request->membership_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status ?? 'active',
            'payment_status' => $request->payment_status,
            'auto_renewal' => $request->has('auto_renewal'),
        ]);

        return back()->with('success', 'Subscription added.');
    }

    public function updateSubscription(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $subscription = MemberSubscription::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'member_name' => 'required|string|max:150',
            'member_mobile' => 'nullable|string|max:30',
            'member_email' => 'nullable|email|max:150',
            'membership_id' => 'nullable|exists:fitness_memberships,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'nullable|string|max:20',
            'payment_status' => 'nullable|string|max:30',
            'auto_renewal' => 'nullable|boolean',
        ]);

        $subscription->update([
            'member_name' => $request->member_name,
            'member_mobile' => $request->member_mobile,
            'member_email' => $request->member_email,
            'membership_id' => $request->membership_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status ?? 'active',
            'payment_status' => $request->payment_status,
            'auto_renewal' => $request->has('auto_renewal'),
        ]);

        return back()->with('success', 'Subscription updated.');
    }

    public function deleteSubscription($id)
    {
        $user = Auth::guard('customer')->user();
        $subscription = MemberSubscription::where('customer_id', $user->id)->findOrFail($id);
        $subscription->delete();

        return back()->with('success', 'Subscription removed.');
    }

    public function classes()
    {
        $user = Auth::guard('customer')->user();
        $classes = FitnessClass::where('customer_id', $user->id)->orderByDesc('created_at')->get();
        $trainers = FitnessTrainer::where('customer_id', $user->id)->orderBy('trainer_name')->get();

        return view('userdashboard-new.fitness.classes.index', compact('classes', 'trainers'));
    }

    public function storeClass(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'class_name' => 'required|string|max:150',
            'class_type' => 'nullable|string|max:50',
            'trainer_id' => 'nullable|exists:fitness_trainers,id',
            'schedule_day' => 'nullable|string|max:20',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'max_capacity' => 'nullable|integer|min:0',
            'is_online' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        FitnessClass::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'class_name' => $request->class_name,
            'class_type' => $request->class_type,
            'trainer_id' => $request->trainer_id,
            'schedule_day' => $request->schedule_day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'max_capacity' => $request->max_capacity,
            'is_online' => $request->has('is_online'),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Class added.');
    }

    public function updateClass(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $class = FitnessClass::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'class_name' => 'required|string|max:150',
            'class_type' => 'nullable|string|max:50',
            'trainer_id' => 'nullable|exists:fitness_trainers,id',
            'schedule_day' => 'nullable|string|max:20',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'max_capacity' => 'nullable|integer|min:0',
            'is_online' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $class->update([
            'class_name' => $request->class_name,
            'class_type' => $request->class_type,
            'trainer_id' => $request->trainer_id,
            'schedule_day' => $request->schedule_day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'max_capacity' => $request->max_capacity,
            'is_online' => $request->has('is_online'),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Class updated.');
    }

    public function deleteClass($id)
    {
        $user = Auth::guard('customer')->user();
        $class = FitnessClass::where('customer_id', $user->id)->findOrFail($id);
        $class->delete();

        return back()->with('success', 'Class removed.');
    }

    public function bookings()
    {
        $user = Auth::guard('customer')->user();
        $bookings = ClassBooking::where('customer_id', $user->id)->orderByDesc('created_at')->get();
        $classes = FitnessClass::where('customer_id', $user->id)->orderBy('class_name')->get();

        return view('userdashboard-new.fitness.bookings.index', compact('bookings', 'classes'));
    }

    public function storeBooking(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'class_id' => 'nullable|exists:fitness_classes,id',
            'member_name' => 'required|string|max:150',
            'member_mobile' => 'nullable|string|max:30',
            'booking_date' => 'nullable|date',
            'booking_status' => 'nullable|string|max:20',
            'is_trial' => 'nullable|boolean',
        ]);

        ClassBooking::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'class_id' => $request->class_id,
            'member_name' => $request->member_name,
            'member_mobile' => $request->member_mobile,
            'booking_date' => $request->booking_date,
            'booking_status' => $request->booking_status ?? 'confirmed',
            'is_trial' => $request->has('is_trial'),
        ]);

        return back()->with('success', 'Booking added.');
    }

    public function updateBookingStatus(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $booking = ClassBooking::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'booking_status' => 'required|string|max:20',
        ]);

        $booking->update([
            'booking_status' => $request->booking_status,
        ]);

        return back()->with('success', 'Booking status updated.');
    }

    public function deleteBooking($id)
    {
        $user = Auth::guard('customer')->user();
        $booking = ClassBooking::where('customer_id', $user->id)->findOrFail($id);
        $booking->delete();

        return back()->with('success', 'Booking removed.');
    }

    public function progress()
    {
        $user = Auth::guard('customer')->user();
        $progressEntries = MemberProgress::where('customer_id', $user->id)->orderByDesc('created_at')->get();

        return view('userdashboard-new.fitness.progress.index', compact('progressEntries'));
    }

    public function storeProgress(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'member_mobile' => 'nullable|string|max:30',
            'assessment_date' => 'nullable|date',
            'weight_kg' => 'nullable|numeric|min:0',
            'height_cm' => 'nullable|numeric|min:0',
            'bmi' => 'nullable|numeric|min:0',
            'body_fat_percentage' => 'nullable|numeric|min:0',
            'measurements' => 'nullable|string',
            'progress_photos.*' => 'nullable|image|max:2048',
            'goals' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $photoNames = [];
        if ($request->hasFile('progress_photos')) {
            foreach ($request->file('progress_photos') as $photo) {
                $photoName = 'progress-' . Str::random(8) . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('uploads/fitness/progress'), $photoName);
                $photoNames[] = $photoName;
            }
        }

        MemberProgress::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'member_mobile' => $request->member_mobile,
            'assessment_date' => $request->assessment_date,
            'weight_kg' => $request->weight_kg,
            'height_cm' => $request->height_cm,
            'bmi' => $request->bmi,
            'body_fat_percentage' => $request->body_fat_percentage,
            'measurements' => $this->splitLines($request->measurements),
            'progress_photos' => $photoNames,
            'goals' => $this->splitLines($request->goals),
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Progress entry added.');
    }

    public function deleteProgress($id)
    {
        $user = Auth::guard('customer')->user();
        $progress = MemberProgress::where('customer_id', $user->id)->findOrFail($id);
        $progress->delete();

        return back()->with('success', 'Progress entry removed.');
    }

    public function transformations()
    {
        $user = Auth::guard('customer')->user();
        $transformations = TransformationGallery::where('customer_id', $user->id)->orderByDesc('created_at')->get();

        return view('userdashboard-new.fitness.transformations.index', compact('transformations'));
    }

    public function storeTransformation(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'member_name' => 'nullable|string|max:150',
            'before_photo' => 'nullable|image|max:2048',
            'after_photo' => 'nullable|image|max:2048',
            'duration_months' => 'nullable|integer|min:0',
            'program_type' => 'nullable|string|max:50',
            'weight_lost_kg' => 'nullable|numeric|min:0',
            'testimonial' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        $beforePhoto = null;
        if ($request->hasFile('before_photo')) {
            $photo = $request->file('before_photo');
            $beforePhoto = 'before-' . Str::random(8) . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/fitness/transformations'), $beforePhoto);
        }

        $afterPhoto = null;
        if ($request->hasFile('after_photo')) {
            $photo = $request->file('after_photo');
            $afterPhoto = 'after-' . Str::random(8) . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/fitness/transformations'), $afterPhoto);
        }

        TransformationGallery::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'member_name' => $request->member_name,
            'before_photo' => $beforePhoto,
            'after_photo' => $afterPhoto,
            'duration_months' => $request->duration_months,
            'program_type' => $request->program_type,
            'weight_lost_kg' => $request->weight_lost_kg,
            'testimonial' => $request->testimonial,
            'is_featured' => $request->has('is_featured'),
        ]);

        return back()->with('success', 'Transformation added.');
    }

    public function updateTransformation(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $transformation = TransformationGallery::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'member_name' => 'nullable|string|max:150',
            'before_photo' => 'nullable|image|max:2048',
            'after_photo' => 'nullable|image|max:2048',
            'duration_months' => 'nullable|integer|min:0',
            'program_type' => 'nullable|string|max:50',
            'weight_lost_kg' => 'nullable|numeric|min:0',
            'testimonial' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        $beforePhoto = $transformation->before_photo;
        if ($request->hasFile('before_photo')) {
            $photo = $request->file('before_photo');
            $beforePhoto = 'before-' . Str::random(8) . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/fitness/transformations'), $beforePhoto);
        }

        $afterPhoto = $transformation->after_photo;
        if ($request->hasFile('after_photo')) {
            $photo = $request->file('after_photo');
            $afterPhoto = 'after-' . Str::random(8) . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/fitness/transformations'), $afterPhoto);
        }

        $transformation->update([
            'member_name' => $request->member_name,
            'before_photo' => $beforePhoto,
            'after_photo' => $afterPhoto,
            'duration_months' => $request->duration_months,
            'program_type' => $request->program_type,
            'weight_lost_kg' => $request->weight_lost_kg,
            'testimonial' => $request->testimonial,
            'is_featured' => $request->has('is_featured'),
        ]);

        return back()->with('success', 'Transformation updated.');
    }

    public function deleteTransformation($id)
    {
        $user = Auth::guard('customer')->user();
        $transformation = TransformationGallery::where('customer_id', $user->id)->findOrFail($id);
        $transformation->delete();

        return back()->with('success', 'Transformation removed.');
    }

    public function dietPlans()
    {
        $user = Auth::guard('customer')->user();
        $dietPlans = DietPlan::where('customer_id', $user->id)->orderByDesc('created_at')->get();

        return view('userdashboard-new.fitness.diet-plans.index', compact('dietPlans'));
    }

    public function storeDietPlan(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'plan_name' => 'required|string|max:150',
            'goal' => 'nullable|string|max:50',
            'diet_type' => 'nullable|string|max:30',
            'daily_calories' => 'nullable|integer|min:0',
            'meal_plan' => 'nullable|string',
            'instructions' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        DietPlan::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'plan_name' => $request->plan_name,
            'goal' => $request->goal,
            'diet_type' => $request->diet_type,
            'daily_calories' => $request->daily_calories,
            'meal_plan' => $this->splitLines($request->meal_plan),
            'instructions' => $request->instructions,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Diet plan added.');
    }

    public function updateDietPlan(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $dietPlan = DietPlan::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'plan_name' => 'required|string|max:150',
            'goal' => 'nullable|string|max:50',
            'diet_type' => 'nullable|string|max:30',
            'daily_calories' => 'nullable|integer|min:0',
            'meal_plan' => 'nullable|string',
            'instructions' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $dietPlan->update([
            'plan_name' => $request->plan_name,
            'goal' => $request->goal,
            'diet_type' => $request->diet_type,
            'daily_calories' => $request->daily_calories,
            'meal_plan' => $this->splitLines($request->meal_plan),
            'instructions' => $request->instructions,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Diet plan updated.');
    }

    public function deleteDietPlan($id)
    {
        $user = Auth::guard('customer')->user();
        $dietPlan = DietPlan::where('customer_id', $user->id)->findOrFail($id);
        $dietPlan->delete();

        return back()->with('success', 'Diet plan removed.');
    }

    // =====================
    // Frontend Booking
    // =====================

    public function bookingForm(Request $request, $slug)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();
        $classes = FitnessClass::where('customer_id', $customer->id)
            ->where('is_active', 1)
            ->orderBy('class_name')
            ->get();

        return view('frontend.fitness.booking', compact('customer', 'classes'));
    }

    public function storePublicBooking(Request $request, $slug)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();

        $request->validate([
            'class_id' => 'nullable|exists:fitness_classes,id',
            'member_name' => 'required|string|max:150',
            'member_mobile' => 'required|string|max:30',
            'booking_date' => 'nullable|date',
            'is_trial' => 'nullable|boolean',
        ]);

        $booking = ClassBooking::create([
            'customer_id' => $customer->id,
            'company_id' => $customer->company_id,
            'class_id' => $request->class_id,
            'member_name' => $request->member_name,
            'member_mobile' => $request->member_mobile,
            'booking_date' => $request->booking_date,
            'booking_status' => 'inquiry',
            'is_trial' => $request->has('is_trial'),
        ]);

        return redirect()->route('fitness.booking.thanks', ['slug' => $slug, 'bookingId' => $booking->id]);
    }

    public function bookingThanks(Request $request, $slug, $bookingId)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();
        $booking = ClassBooking::where('customer_id', $customer->id)->findOrFail($bookingId);

        return view('frontend.fitness.thanks', compact('customer', 'booking'));
    }

    private function splitLines(?string $value): array
    {
        if (!$value) {
            return [];
        }

        $lines = preg_split('/\r\n|\r|\n/', $value);
        $lines = array_map('trim', $lines);
        $lines = array_filter($lines, static fn ($line) => $line !== '');

        return array_values($lines);
    }
}
