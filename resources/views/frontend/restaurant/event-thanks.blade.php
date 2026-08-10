@extends('layouts.redesign.frontend')

@section('main')
<section class="thanks-page">
    <div class="thanks-card">
        <h1>Booking Submitted</h1>
        <p>Your event inquiry has been submitted. Our team will contact you soon.</p>
        <a href="{{ url('/' . $customer->slug) }}" class="btn btn-primary">Back to Profile</a>
    </div>
</section>

<style>
    .thanks-page { display: flex; justify-content: center; align-items: center; min-height: 60vh; padding: 2rem; }
    .thanks-card { background: #fff; border-radius: 0.75rem; padding: 2rem; text-align: center; border: 1px solid #e5e7eb; }
    .btn-primary { display: inline-block; margin-top: 1rem; background: #dc2626; color: #fff; padding: 0.7rem 1.5rem; border-radius: 0.5rem; text-decoration: none; }
</style>
@endsection
