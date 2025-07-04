@extends('layouts.admin')
@section('title', 'Trip Request Details')
@section('content')
<div class="container mt-4">
    <h2>Trip Request Details</h2>
    @if($tripRequest)
        <div class="card mb-4">
            <div class="card-header">Request #{{ $tripRequest->id }}</div>
            <div class="card-body">
                <p><strong>Passenger:</strong> {{ $tripRequest->passenger->user->name ?? 'N/A' }}</p>
                <p><strong>Pickup Location:</strong> {{ $tripRequest->pickup_location ?? 'N/A' }}</p>
                <p><strong>Dropoff Location:</strong> {{ $tripRequest->dropoff_location ?? 'N/A' }}</p>
                <p><strong>Preferred Time:</strong> {{ $tripRequest->preferred_time ?? 'N/A' }}</p>
                <p><strong>Status:</strong> {{ ucfirst($tripRequest->status) }}</p>
                <p><strong>Estimated Fare:</strong> ${{ number_format($tripRequest->estimated_fare ?? 0, 2) }}</p>
                <p><strong>Notes:</strong> {{ $tripRequest->notes ?? 'None' }}</p>
                <p><strong>Created At:</strong> {{ $tripRequest->created_at }}</p>
                @if($tripRequest->trip)
                    <hr>
                    <h5>Trip Details</h5>
                    <p><strong>Driver:</strong> {{ $tripRequest->trip->driver->user->name ?? 'N/A' }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($tripRequest->trip->status) }}</p>
                    <p><strong>Fare:</strong> ${{ number_format($tripRequest->trip->fare ?? 0, 2) }}</p>
                @endif
            </div>
        </div>
    @else
        <div class="alert alert-warning">Trip request not found.</div>
    @endif
    <a href="{{ route('admin.trip-requests.index') }}" class="btn btn-secondary">Back to Trip Requests</a>
</div>
@endsection 