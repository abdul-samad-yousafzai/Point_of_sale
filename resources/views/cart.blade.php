@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Add New Profile</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Full Name -->
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="03XXXXXXXXX" required>
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="3" placeholder="Enter complete address"></textarea>
                        </div>

                        <!-- Profile Image -->
                        <div class="mb-3">
                            <label class="form-label">Profile Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('profile.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Create Profile</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
