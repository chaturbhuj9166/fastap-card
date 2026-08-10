<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\ClassBooking;
use App\Models\Company;
use App\Models\DietPlan;
use App\Models\FitnessClass;
use App\Models\FitnessMembership;
use App\Models\FitnessProgram;
use App\Models\FitnessTrainer;
use App\Models\MemberProgress;
use App\Models\MemberSubscription;
use App\Models\TransformationGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FitnessController extends Controller
{
    public function programs(Request $request)
    {
        $company = $this->getCompany($request);
        $programs = FitnessProgram::where('company_id', $company->id)->orderByDesc('created_at')->get();
        $trainers = FitnessTrainer::where('company_id', $company->id)->orderBy('trainer_name')->get();

        return view('company.fitness.programs.index', compact('company', 'programs', 'trainers'));
    }

    public function storeProgram(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

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
            'customer_id' => $customerId,
            'company_id' => $company->id,
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
        $company = $this->getCompany($request);
        $program = FitnessProgram::where('company_id', $company->id)->findOrFail($id);

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

    public function deleteProgram(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $program = FitnessProgram::where('company_id', $company->id)->findOrFail($id);
        $program->delete();

        return back()->with('success', 'Program removed.');
    }

    public function trainers(Request $request)
    {
        $company = $this->getCompany($request);
        $trainers = FitnessTrainer::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.fitness.trainers.index', compact('company', 'trainers'));
    }

    public function storeTrainer(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

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
            'customer_id' => $customerId,
            'company_id' => $company->id,
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
        $company = $this->getCompany($request);
        $trainer = FitnessTrainer::where('company_id', $company->id)->findOrFail($id);

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

    public function deleteTrainer(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $trainer = FitnessTrainer::where('company_id', $company->id)->findOrFail($id);
        $trainer->delete();

        return back()->with('success', 'Trainer removed.');
    }

    public function memberships(Request $request)
    {
        $company = $this->getCompany($request);
        $memberships = FitnessMembership::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.fitness.memberships.index', compact('company', 'memberships'));
    }

    public function storeMembership(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'plan_name' => 'required|string|max:150',
            'duration_months' => 'nullable|integer|min:0',
            'session_type' => 'nullable|string|max:60',
            'price' => 'nullable|numeric|min:0',
            'features' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        FitnessMembership::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
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
        $company = $this->getCompany($request);
        $membership = FitnessMembership::where('company_id', $company->id)->findOrFail($id);

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

    public function deleteMembership(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $membership = FitnessMembership::where('company_id', $company->id)->findOrFail($id);
        $membership->delete();

        return back()->with('success', 'Membership removed.');
    }

    public function subscriptions(Request $request)
    {
        $company = $this->getCompany($request);
        $subscriptions = MemberSubscription::where('company_id', $company->id)->orderByDesc('created_at')->get();
        $memberships = FitnessMembership::where('company_id', $company->id)->orderBy('plan_name')->get();

        return view('company.fitness.subscriptions.index', compact('company', 'subscriptions', 'memberships'));
    }

    public function storeSubscription(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

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
            'customer_id' => $customerId,
            'company_id' => $company->id,
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
        $company = $this->getCompany($request);
        $subscription = MemberSubscription::where('company_id', $company->id)->findOrFail($id);

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

    public function deleteSubscription(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $subscription = MemberSubscription::where('company_id', $company->id)->findOrFail($id);
        $subscription->delete();

        return back()->with('success', 'Subscription removed.');
    }

    public function classes(Request $request)
    {
        $company = $this->getCompany($request);
        $classes = FitnessClass::where('company_id', $company->id)->orderByDesc('created_at')->get();
        $trainers = FitnessTrainer::where('company_id', $company->id)->orderBy('trainer_name')->get();

        return view('company.fitness.classes.index', compact('company', 'classes', 'trainers'));
    }

    public function storeClass(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

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
            'customer_id' => $customerId,
            'company_id' => $company->id,
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
        $company = $this->getCompany($request);
        $class = FitnessClass::where('company_id', $company->id)->findOrFail($id);

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

    public function deleteClass(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $class = FitnessClass::where('company_id', $company->id)->findOrFail($id);
        $class->delete();

        return back()->with('success', 'Class removed.');
    }

    public function bookings(Request $request)
    {
        $company = $this->getCompany($request);
        $bookings = ClassBooking::where('company_id', $company->id)->orderByDesc('created_at')->get();
        $classes = FitnessClass::where('company_id', $company->id)->orderBy('class_name')->get();

        return view('company.fitness.bookings.index', compact('company', 'bookings', 'classes'));
    }

    public function storeBooking(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'class_id' => 'nullable|exists:fitness_classes,id',
            'member_name' => 'required|string|max:150',
            'member_mobile' => 'nullable|string|max:30',
            'booking_date' => 'nullable|date',
            'booking_status' => 'nullable|string|max:20',
            'is_trial' => 'nullable|boolean',
        ]);

        ClassBooking::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
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
        $company = $this->getCompany($request);
        $booking = ClassBooking::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'booking_status' => 'required|string|max:20',
        ]);

        $booking->update([
            'booking_status' => $request->booking_status,
        ]);

        return back()->with('success', 'Booking status updated.');
    }

    public function deleteBooking(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $booking = ClassBooking::where('company_id', $company->id)->findOrFail($id);
        $booking->delete();

        return back()->with('success', 'Booking removed.');
    }

    public function progress(Request $request)
    {
        $company = $this->getCompany($request);
        $progressEntries = MemberProgress::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.fitness.progress.index', compact('company', 'progressEntries'));
    }

    public function storeProgress(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

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
            'customer_id' => $customerId,
            'company_id' => $company->id,
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

    public function deleteProgress(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $progress = MemberProgress::where('company_id', $company->id)->findOrFail($id);
        $progress->delete();

        return back()->with('success', 'Progress entry removed.');
    }

    public function transformations(Request $request)
    {
        $company = $this->getCompany($request);
        $transformations = TransformationGallery::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.fitness.transformations.index', compact('company', 'transformations'));
    }

    public function storeTransformation(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

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
            'customer_id' => $customerId,
            'company_id' => $company->id,
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
        $company = $this->getCompany($request);
        $transformation = TransformationGallery::where('company_id', $company->id)->findOrFail($id);

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

    public function deleteTransformation(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $transformation = TransformationGallery::where('company_id', $company->id)->findOrFail($id);
        $transformation->delete();

        return back()->with('success', 'Transformation removed.');
    }

    public function dietPlans(Request $request)
    {
        $company = $this->getCompany($request);
        $dietPlans = DietPlan::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.fitness.diet-plans.index', compact('company', 'dietPlans'));
    }

    public function storeDietPlan(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

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
            'customer_id' => $customerId,
            'company_id' => $company->id,
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
        $company = $this->getCompany($request);
        $dietPlan = DietPlan::where('company_id', $company->id)->findOrFail($id);

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

    public function deleteDietPlan(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $dietPlan = DietPlan::where('company_id', $company->id)->findOrFail($id);
        $dietPlan->delete();

        return back()->with('success', 'Diet plan removed.');
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
