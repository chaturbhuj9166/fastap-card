<?php

namespace App\Http\Controllers;

use App\Models\AdmissionApplication;
use App\Models\ClassAttendance;
use App\Models\EducationBatch;
use App\Models\EducationCourse;
use App\Models\EducationFaculty;
use App\Models\EducationResult;
use App\Models\FeeStructure;
use App\Models\StudentFee;
use App\Models\StudentTest;
use App\Models\StudyMaterial;
use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EducationController extends Controller
{
    public function courses()
    {
        $user = Auth::guard('customer')->user();
        $courses = EducationCourse::where('customer_id', $user->id)->orderByDesc('created_at')->get();

        return view('userdashboard-new.education.courses.index', compact('courses'));
    }

    public function storeCourse(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'course_name' => 'required|string|max:150',
            'course_category' => 'nullable|string|max:100',
            'board_exam' => 'nullable|string|max:50',
            'class_standard' => 'nullable|string|max:50',
            'subjects' => 'nullable|string',
            'batch_type' => 'nullable|string|max:50',
            'mode' => 'nullable|string|max:30',
            'duration_months' => 'nullable|integer|min:0',
            'fee_structure' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        EducationCourse::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'course_name' => $request->course_name,
            'course_category' => $request->course_category,
            'board_exam' => $request->board_exam,
            'class_standard' => $request->class_standard,
            'subjects' => $this->splitLines($request->subjects),
            'batch_type' => $request->batch_type,
            'mode' => $request->mode,
            'duration_months' => $request->duration_months,
            'fee_structure' => $request->fee_structure,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Course added successfully!');
    }

    public function updateCourse(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $course = EducationCourse::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'course_name' => 'required|string|max:150',
            'course_category' => 'nullable|string|max:100',
            'board_exam' => 'nullable|string|max:50',
            'class_standard' => 'nullable|string|max:50',
            'subjects' => 'nullable|string',
            'batch_type' => 'nullable|string|max:50',
            'mode' => 'nullable|string|max:30',
            'duration_months' => 'nullable|integer|min:0',
            'fee_structure' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $course->update([
            'course_name' => $request->course_name,
            'course_category' => $request->course_category,
            'board_exam' => $request->board_exam,
            'class_standard' => $request->class_standard,
            'subjects' => $this->splitLines($request->subjects),
            'batch_type' => $request->batch_type,
            'mode' => $request->mode,
            'duration_months' => $request->duration_months,
            'fee_structure' => $request->fee_structure,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Course updated.');
    }

    public function deleteCourse($id)
    {
        $user = Auth::guard('customer')->user();
        $course = EducationCourse::where('customer_id', $user->id)->findOrFail($id);
        $course->delete();

        return back()->with('success', 'Course removed.');
    }

    public function batches()
    {
        $user = Auth::guard('customer')->user();
        $batches = EducationBatch::where('customer_id', $user->id)->orderByDesc('created_at')->get();
        $courses = EducationCourse::where('customer_id', $user->id)->orderBy('course_name')->get();
        $faculty = EducationFaculty::where('customer_id', $user->id)->orderBy('faculty_name')->get();

        return view('userdashboard-new.education.batches.index', compact('batches', 'courses', 'faculty'));
    }

    public function storeBatch(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'course_id' => 'nullable|integer',
            'batch_name' => 'required|string|max:150',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'faculty_id' => 'nullable|integer',
            'max_students' => 'nullable|integer|min:0',
            'enrolled_students' => 'nullable|integer|min:0',
            'class_schedule' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        EducationBatch::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'course_id' => $request->course_id,
            'batch_name' => $request->batch_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'faculty_id' => $request->faculty_id,
            'max_students' => $request->max_students,
            'enrolled_students' => $request->enrolled_students ?? 0,
            'class_schedule' => $this->splitLines($request->class_schedule),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Batch added successfully!');
    }

    public function updateBatch(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $batch = EducationBatch::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'course_id' => 'nullable|integer',
            'batch_name' => 'required|string|max:150',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'faculty_id' => 'nullable|integer',
            'max_students' => 'nullable|integer|min:0',
            'enrolled_students' => 'nullable|integer|min:0',
            'class_schedule' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $batch->update([
            'course_id' => $request->course_id,
            'batch_name' => $request->batch_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'faculty_id' => $request->faculty_id,
            'max_students' => $request->max_students,
            'enrolled_students' => $request->enrolled_students ?? $batch->enrolled_students,
            'class_schedule' => $this->splitLines($request->class_schedule),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Batch updated.');
    }

    public function deleteBatch($id)
    {
        $user = Auth::guard('customer')->user();
        $batch = EducationBatch::where('customer_id', $user->id)->findOrFail($id);
        $batch->delete();

        return back()->with('success', 'Batch removed.');
    }

    public function faculty()
    {
        $user = Auth::guard('customer')->user();
        $faculty = EducationFaculty::where('customer_id', $user->id)->orderByDesc('created_at')->get();

        return view('userdashboard-new.education.faculty.index', compact('faculty'));
    }

    public function storeFaculty(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'faculty_name' => 'required|string|max:150',
            'qualification' => 'nullable|string|max:150',
            'specialization' => 'nullable|string|max:150',
            'experience_years' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|max:2048',
            'bio' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $photoName = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = 'faculty-' . Str::random(8) . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/education/faculty'), $photoName);
        }

        EducationFaculty::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'faculty_name' => $request->faculty_name,
            'qualification' => $request->qualification,
            'specialization' => $request->specialization,
            'experience_years' => $request->experience_years,
            'photo' => $photoName,
            'bio' => $request->bio,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Faculty added successfully!');
    }

    public function updateFaculty(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $member = EducationFaculty::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'faculty_name' => 'required|string|max:150',
            'qualification' => 'nullable|string|max:150',
            'specialization' => 'nullable|string|max:150',
            'experience_years' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|max:2048',
            'bio' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $photoName = $member->photo;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = 'faculty-' . Str::random(8) . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/education/faculty'), $photoName);
        }

        $member->update([
            'faculty_name' => $request->faculty_name,
            'qualification' => $request->qualification,
            'specialization' => $request->specialization,
            'experience_years' => $request->experience_years,
            'photo' => $photoName,
            'bio' => $request->bio,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Faculty updated.');
    }

    public function deleteFaculty($id)
    {
        $user = Auth::guard('customer')->user();
        $member = EducationFaculty::where('customer_id', $user->id)->findOrFail($id);
        $member->delete();

        return back()->with('success', 'Faculty removed.');
    }

    public function admissions()
    {
        $user = Auth::guard('customer')->user();
        $admissions = AdmissionApplication::where('customer_id', $user->id)->orderByDesc('created_at')->get();
        $courses = EducationCourse::where('customer_id', $user->id)->orderBy('course_name')->get();

        return view('userdashboard-new.education.admissions.index', compact('admissions', 'courses'));
    }

    public function storeAdmission(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'student_name' => 'required|string|max:150',
            'parent_name' => 'nullable|string|max:150',
            'mobile' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:150',
            'course_id' => 'nullable|integer',
            'class_standard' => 'nullable|string|max:50',
            'documents' => 'nullable|string',
            'entrance_test_date' => 'nullable|date',
            'entrance_test_score' => 'nullable|string|max:50',
            'admission_status' => 'nullable|string|max:30',
            'seat_allocated' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
        ]);

        AdmissionApplication::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'student_name' => $request->student_name,
            'parent_name' => $request->parent_name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'course_id' => $request->course_id,
            'class_standard' => $request->class_standard,
            'documents' => $this->splitLines($request->documents),
            'entrance_test_date' => $request->entrance_test_date,
            'entrance_test_score' => $request->entrance_test_score,
            'admission_status' => $request->admission_status ?? 'applied',
            'seat_allocated' => $request->seat_allocated,
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Admission added successfully!');
    }

    public function updateAdmissionStatus(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $admission = AdmissionApplication::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'admission_status' => 'required|string|max:30',
            'entrance_test_score' => 'nullable|string|max:50',
            'seat_allocated' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
        ]);

        $admission->update([
            'admission_status' => $request->admission_status,
            'entrance_test_score' => $request->entrance_test_score,
            'seat_allocated' => $request->seat_allocated,
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Admission updated.');
    }

    public function deleteAdmission($id)
    {
        $user = Auth::guard('customer')->user();
        $admission = AdmissionApplication::where('customer_id', $user->id)->findOrFail($id);
        $admission->delete();

        return back()->with('success', 'Admission removed.');
    }

    public function attendance()
    {
        $user = Auth::guard('customer')->user();
        $attendance = ClassAttendance::where('customer_id', $user->id)->orderByDesc('attendance_date')->get();
        $batches = EducationBatch::where('customer_id', $user->id)->orderBy('batch_name')->get();

        return view('userdashboard-new.education.attendance.index', compact('attendance', 'batches'));
    }

    public function storeAttendance(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'batch_id' => 'nullable|integer',
            'student_name' => 'required|string|max:150',
            'attendance_date' => 'required|date',
            'status' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);

        ClassAttendance::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'batch_id' => $request->batch_id,
            'student_name' => $request->student_name,
            'attendance_date' => $request->attendance_date,
            'status' => $request->status ?? 'present',
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Attendance added.');
    }

    public function deleteAttendance($id)
    {
        $user = Auth::guard('customer')->user();
        $entry = ClassAttendance::where('customer_id', $user->id)->findOrFail($id);
        $entry->delete();

        return back()->with('success', 'Attendance removed.');
    }

    public function tests()
    {
        $user = Auth::guard('customer')->user();
        $tests = StudentTest::where('customer_id', $user->id)->orderByDesc('created_at')->get();
        $batches = EducationBatch::where('customer_id', $user->id)->orderBy('batch_name')->get();

        return view('userdashboard-new.education.tests.index', compact('tests', 'batches'));
    }

    public function storeTest(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'batch_id' => 'nullable|integer',
            'test_name' => 'required|string|max:150',
            'test_date' => 'nullable|date',
            'total_marks' => 'nullable|integer|min:0',
            'results' => 'nullable|string',
        ]);

        StudentTest::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'batch_id' => $request->batch_id,
            'test_name' => $request->test_name,
            'test_date' => $request->test_date,
            'total_marks' => $request->total_marks,
            'results' => $this->splitLines($request->results),
        ]);

        return back()->with('success', 'Test added.');
    }

    public function deleteTest($id)
    {
        $user = Auth::guard('customer')->user();
        $test = StudentTest::where('customer_id', $user->id)->findOrFail($id);
        $test->delete();

        return back()->with('success', 'Test removed.');
    }

    public function results()
    {
        $user = Auth::guard('customer')->user();
        $results = EducationResult::where('customer_id', $user->id)->orderByDesc('created_at')->get();

        return view('userdashboard-new.education.results.index', compact('results'));
    }

    public function storeResult(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'exam_year' => 'nullable|string|max:10',
            'exam_type' => 'nullable|string|max:50',
            'total_students' => 'nullable|integer|min:0',
            'pass_percentage' => 'nullable|numeric|min:0|max:100',
            'toppers' => 'nullable|string',
            'achievements' => 'nullable|string',
        ]);

        EducationResult::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'exam_year' => $request->exam_year,
            'exam_type' => $request->exam_type,
            'total_students' => $request->total_students,
            'pass_percentage' => $request->pass_percentage,
            'toppers' => $this->splitLines($request->toppers),
            'achievements' => $this->splitLines($request->achievements),
        ]);

        return back()->with('success', 'Result added.');
    }

    public function deleteResult($id)
    {
        $user = Auth::guard('customer')->user();
        $result = EducationResult::where('customer_id', $user->id)->findOrFail($id);
        $result->delete();

        return back()->with('success', 'Result removed.');
    }

    public function materials()
    {
        $user = Auth::guard('customer')->user();
        $materials = StudyMaterial::where('customer_id', $user->id)->orderByDesc('created_at')->get();
        $courses = EducationCourse::where('customer_id', $user->id)->orderBy('course_name')->get();
        $batches = EducationBatch::where('customer_id', $user->id)->orderBy('batch_name')->get();

        return view('userdashboard-new.education.materials.index', compact('materials', 'courses', 'batches'));
    }

    public function storeMaterial(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'title' => 'required|string|max:150',
            'course_id' => 'nullable|integer',
            'batch_id' => 'nullable|integer',
            'material_type' => 'nullable|string|max:50',
            'material_file' => 'nullable|file|max:4096',
            'external_link' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $filePath = null;
        if ($request->hasFile('material_file')) {
            $file = $request->file('material_file');
            $fileName = 'material-' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/education/materials'), $fileName);
            $filePath = $fileName;
        }

        StudyMaterial::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'title' => $request->title,
            'course_id' => $request->course_id,
            'batch_id' => $request->batch_id,
            'material_type' => $request->material_type,
            'file_path' => $filePath,
            'external_link' => $request->external_link,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Material added.');
    }

    public function deleteMaterial($id)
    {
        $user = Auth::guard('customer')->user();
        $material = StudyMaterial::where('customer_id', $user->id)->findOrFail($id);
        $material->delete();

        return back()->with('success', 'Material removed.');
    }

    public function feeStructures()
    {
        $user = Auth::guard('customer')->user();
        $structures = FeeStructure::where('customer_id', $user->id)->orderByDesc('created_at')->get();
        $courses = EducationCourse::where('customer_id', $user->id)->orderBy('course_name')->get();

        return view('userdashboard-new.education.fees.structures', compact('structures', 'courses'));
    }

    public function storeFeeStructure(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'course_id' => 'nullable|integer',
            'registration_fee' => 'nullable|numeric|min:0',
            'tuition_fee' => 'nullable|numeric|min:0',
            'installment_count' => 'nullable|integer|min:0',
            'late_fee_amount' => 'nullable|numeric|min:0',
        ]);

        FeeStructure::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'course_id' => $request->course_id,
            'registration_fee' => $request->registration_fee,
            'tuition_fee' => $request->tuition_fee,
            'installment_count' => $request->installment_count,
            'late_fee_amount' => $request->late_fee_amount,
        ]);

        return back()->with('success', 'Fee structure added.');
    }

    public function deleteFeeStructure($id)
    {
        $user = Auth::guard('customer')->user();
        $structure = FeeStructure::where('customer_id', $user->id)->findOrFail($id);
        $structure->delete();

        return back()->with('success', 'Fee structure removed.');
    }

    public function studentFees()
    {
        $user = Auth::guard('customer')->user();
        $fees = StudentFee::where('customer_id', $user->id)->orderByDesc('created_at')->get();
        $batches = EducationBatch::where('customer_id', $user->id)->orderBy('batch_name')->get();

        return view('userdashboard-new.education.fees.students', compact('fees', 'batches'));
    }

    public function storeStudentFee(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'student_name' => 'nullable|string|max:150',
            'student_mobile' => 'nullable|string|max:30',
            'batch_id' => 'nullable|integer',
            'total_fee' => 'nullable|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'amount_paid' => 'nullable|numeric|min:0',
            'amount_due' => 'nullable|numeric|min:0',
            'payment_history' => 'nullable|string',
            'next_due_date' => 'nullable|date',
        ]);

        StudentFee::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'student_name' => $request->student_name,
            'student_mobile' => $request->student_mobile,
            'batch_id' => $request->batch_id,
            'total_fee' => $request->total_fee,
            'discount_amount' => $request->discount_amount,
            'amount_paid' => $request->amount_paid,
            'amount_due' => $request->amount_due,
            'payment_history' => $this->splitLines($request->payment_history),
            'next_due_date' => $request->next_due_date,
        ]);

        return back()->with('success', 'Student fee added.');
    }

    public function deleteStudentFee($id)
    {
        $user = Auth::guard('customer')->user();
        $fee = StudentFee::where('customer_id', $user->id)->findOrFail($id);
        $fee->delete();

        return back()->with('success', 'Student fee removed.');
    }

    // Public Admission Form
    public function admissionForm(Request $request, $slug)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();
        $courses = EducationCourse::where('customer_id', $customer->id)->where('is_active', 1)->orderBy('course_name')->get();

        return view('frontend.education.admission', compact('customer', 'courses'));
    }

    public function storePublicAdmission(Request $request, $slug)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();

        $request->validate([
            'student_name' => 'required|string|max:150',
            'parent_name' => 'nullable|string|max:150',
            'mobile' => 'required|string|max:30',
            'email' => 'nullable|email|max:150',
            'course_id' => 'nullable|integer',
            'class_standard' => 'nullable|string|max:50',
        ]);

        $admission = AdmissionApplication::create([
            'customer_id' => $customer->id,
            'company_id' => $customer->company_id,
            'student_name' => $request->student_name,
            'parent_name' => $request->parent_name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'course_id' => $request->course_id,
            'class_standard' => $request->class_standard,
            'admission_status' => 'applied',
        ]);

        return redirect()->route('education.admission.thanks', ['slug' => $slug, 'admissionId' => $admission->id]);
    }

    public function admissionThanks(Request $request, $slug, $admissionId)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();
        $admission = AdmissionApplication::where('customer_id', $customer->id)->findOrFail($admissionId);

        return view('frontend.education.thanks', compact('customer', 'admission'));
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
