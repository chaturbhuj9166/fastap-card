<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\AdmissionApplication;
use App\Models\ClassAttendance;
use App\Models\Company;
use App\Models\EducationBatch;
use App\Models\EducationCourse;
use App\Models\EducationFaculty;
use App\Models\EducationResult;
use App\Models\FeeStructure;
use App\Models\StudentFee;
use App\Models\StudentTest;
use App\Models\StudyMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EducationController extends Controller
{
    public function courses(Request $request)
    {
        $company = $this->getCompany($request);
        $courses = EducationCourse::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.education.courses.index', compact('company', 'courses'));
    }

    public function storeCourse(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

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
            'customer_id' => $customerId,
            'company_id' => $company->id,
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
        $company = $this->getCompany($request);
        $course = EducationCourse::where('company_id', $company->id)->findOrFail($id);

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

    public function deleteCourse(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $course = EducationCourse::where('company_id', $company->id)->findOrFail($id);
        $course->delete();

        return back()->with('success', 'Course removed.');
    }

    public function batches(Request $request)
    {
        $company = $this->getCompany($request);
        $batches = EducationBatch::where('company_id', $company->id)->orderByDesc('created_at')->get();
        $courses = EducationCourse::where('company_id', $company->id)->orderBy('course_name')->get();
        $faculty = EducationFaculty::where('company_id', $company->id)->orderBy('faculty_name')->get();

        return view('company.education.batches.index', compact('company', 'batches', 'courses', 'faculty'));
    }

    public function storeBatch(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

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
            'customer_id' => $customerId,
            'company_id' => $company->id,
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
        $company = $this->getCompany($request);
        $batch = EducationBatch::where('company_id', $company->id)->findOrFail($id);

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

    public function deleteBatch(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $batch = EducationBatch::where('company_id', $company->id)->findOrFail($id);
        $batch->delete();

        return back()->with('success', 'Batch removed.');
    }

    public function faculty(Request $request)
    {
        $company = $this->getCompany($request);
        $faculty = EducationFaculty::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.education.faculty.index', compact('company', 'faculty'));
    }

    public function storeFaculty(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'faculty_name' => 'required|string|max:150',
            'qualification' => 'nullable|string|max:150',
            'specialization' => 'nullable|string|max:150',
            'experience_years' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|max:2048',
            'bio' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $photoName = $this->storeSingleFile($request, 'photo', 'uploads/education/faculty', 'faculty');

        EducationFaculty::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
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
        $company = $this->getCompany($request);
        $member = EducationFaculty::where('company_id', $company->id)->findOrFail($id);

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
        $newPhoto = $this->storeSingleFile($request, 'photo', 'uploads/education/faculty', 'faculty');
        if ($newPhoto) {
            $photoName = $newPhoto;
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

    public function deleteFaculty(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $member = EducationFaculty::where('company_id', $company->id)->findOrFail($id);
        $member->delete();

        return back()->with('success', 'Faculty removed.');
    }

    public function admissions(Request $request)
    {
        $company = $this->getCompany($request);
        $admissions = AdmissionApplication::where('company_id', $company->id)->orderByDesc('created_at')->get();
        $courses = EducationCourse::where('company_id', $company->id)->orderBy('course_name')->get();

        return view('company.education.admissions.index', compact('company', 'admissions', 'courses'));
    }

    public function storeAdmission(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

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
            'customer_id' => $customerId,
            'company_id' => $company->id,
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
        $company = $this->getCompany($request);
        $admission = AdmissionApplication::where('company_id', $company->id)->findOrFail($id);

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

    public function deleteAdmission(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $admission = AdmissionApplication::where('company_id', $company->id)->findOrFail($id);
        $admission->delete();

        return back()->with('success', 'Admission removed.');
    }

    public function attendance(Request $request)
    {
        $company = $this->getCompany($request);
        $attendance = ClassAttendance::where('company_id', $company->id)->orderByDesc('attendance_date')->get();
        $batches = EducationBatch::where('company_id', $company->id)->orderBy('batch_name')->get();

        return view('company.education.attendance.index', compact('company', 'attendance', 'batches'));
    }

    public function storeAttendance(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'batch_id' => 'nullable|integer',
            'student_name' => 'required|string|max:150',
            'attendance_date' => 'required|date',
            'status' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);

        ClassAttendance::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'batch_id' => $request->batch_id,
            'student_name' => $request->student_name,
            'attendance_date' => $request->attendance_date,
            'status' => $request->status ?? 'present',
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Attendance added.');
    }

    public function deleteAttendance(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $entry = ClassAttendance::where('company_id', $company->id)->findOrFail($id);
        $entry->delete();

        return back()->with('success', 'Attendance removed.');
    }

    public function tests(Request $request)
    {
        $company = $this->getCompany($request);
        $tests = StudentTest::where('company_id', $company->id)->orderByDesc('created_at')->get();
        $batches = EducationBatch::where('company_id', $company->id)->orderBy('batch_name')->get();

        return view('company.education.tests.index', compact('company', 'tests', 'batches'));
    }

    public function storeTest(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'batch_id' => 'nullable|integer',
            'test_name' => 'required|string|max:150',
            'test_date' => 'nullable|date',
            'total_marks' => 'nullable|integer|min:0',
            'results' => 'nullable|string',
        ]);

        StudentTest::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'batch_id' => $request->batch_id,
            'test_name' => $request->test_name,
            'test_date' => $request->test_date,
            'total_marks' => $request->total_marks,
            'results' => $this->splitLines($request->results),
        ]);

        return back()->with('success', 'Test added.');
    }

    public function deleteTest(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $test = StudentTest::where('company_id', $company->id)->findOrFail($id);
        $test->delete();

        return back()->with('success', 'Test removed.');
    }

    public function results(Request $request)
    {
        $company = $this->getCompany($request);
        $results = EducationResult::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.education.results.index', compact('company', 'results'));
    }

    public function storeResult(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'exam_year' => 'nullable|string|max:10',
            'exam_type' => 'nullable|string|max:50',
            'total_students' => 'nullable|integer|min:0',
            'pass_percentage' => 'nullable|numeric|min:0|max:100',
            'toppers' => 'nullable|string',
            'achievements' => 'nullable|string',
        ]);

        EducationResult::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'exam_year' => $request->exam_year,
            'exam_type' => $request->exam_type,
            'total_students' => $request->total_students,
            'pass_percentage' => $request->pass_percentage,
            'toppers' => $this->splitLines($request->toppers),
            'achievements' => $this->splitLines($request->achievements),
        ]);

        return back()->with('success', 'Result added.');
    }

    public function deleteResult(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $result = EducationResult::where('company_id', $company->id)->findOrFail($id);
        $result->delete();

        return back()->with('success', 'Result removed.');
    }

    public function materials(Request $request)
    {
        $company = $this->getCompany($request);
        $materials = StudyMaterial::where('company_id', $company->id)->orderByDesc('created_at')->get();
        $courses = EducationCourse::where('company_id', $company->id)->orderBy('course_name')->get();
        $batches = EducationBatch::where('company_id', $company->id)->orderBy('batch_name')->get();

        return view('company.education.materials.index', compact('company', 'materials', 'courses', 'batches'));
    }

    public function storeMaterial(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

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

        $filePath = $this->storeSingleFile($request, 'material_file', 'uploads/education/materials', 'material');

        StudyMaterial::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
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

    public function deleteMaterial(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $material = StudyMaterial::where('company_id', $company->id)->findOrFail($id);
        $material->delete();

        return back()->with('success', 'Material removed.');
    }

    public function feeStructures(Request $request)
    {
        $company = $this->getCompany($request);
        $structures = FeeStructure::where('company_id', $company->id)->orderByDesc('created_at')->get();
        $courses = EducationCourse::where('company_id', $company->id)->orderBy('course_name')->get();

        return view('company.education.fees.structures', compact('company', 'structures', 'courses'));
    }

    public function storeFeeStructure(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'course_id' => 'nullable|integer',
            'registration_fee' => 'nullable|numeric|min:0',
            'tuition_fee' => 'nullable|numeric|min:0',
            'installment_count' => 'nullable|integer|min:0',
            'late_fee_amount' => 'nullable|numeric|min:0',
        ]);

        FeeStructure::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'course_id' => $request->course_id,
            'registration_fee' => $request->registration_fee,
            'tuition_fee' => $request->tuition_fee,
            'installment_count' => $request->installment_count,
            'late_fee_amount' => $request->late_fee_amount,
        ]);

        return back()->with('success', 'Fee structure added.');
    }

    public function deleteFeeStructure(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $structure = FeeStructure::where('company_id', $company->id)->findOrFail($id);
        $structure->delete();

        return back()->with('success', 'Fee structure removed.');
    }

    public function studentFees(Request $request)
    {
        $company = $this->getCompany($request);
        $fees = StudentFee::where('company_id', $company->id)->orderByDesc('created_at')->get();
        $batches = EducationBatch::where('company_id', $company->id)->orderBy('batch_name')->get();

        return view('company.education.fees.students', compact('company', 'fees', 'batches'));
    }

    public function storeStudentFee(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

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
            'customer_id' => $customerId,
            'company_id' => $company->id,
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

    public function deleteStudentFee(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $fee = StudentFee::where('company_id', $company->id)->findOrFail($id);
        $fee->delete();

        return back()->with('success', 'Student fee removed.');
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

    private function storeSingleFile(Request $request, string $field, string $directory, string $prefix): ?string
    {
        if (!$request->hasFile($field)) {
            return null;
        }

        $storagePath = public_path($directory);
        if (!is_dir($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        $file = $request->file($field);
        $fileName = $prefix . '-' . Str::random(8) . '.' . $file->getClientOriginalExtension();
        $file->move($storagePath, $fileName);

        return $fileName;
    }
}
