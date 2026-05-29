@extends('layouts.sidebar')

@section('page-title', 'Profile')

@section('content')

<style>

.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 22px;
}

.page-title {
    font-size: 17px;
    font-weight: 800;
    color: #0d1b2a;
    margin: 0 0 2px;
}

.page-sub {
    font-size: 12px;
    color: #adb5bd;
    margin: 0;
}

.profile-card {
    background: #fff;
    border: 1px solid #e9ecef;
    border-radius: 16px;
    padding: 28px 22px;
    text-align: center;
}

.profile-photo {
    width: 170px;
    height: 170px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #E6F1FB;
    margin-bottom: 14px;
}

.profile-initials {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background: #E6F1FB;
    color: #185FA5;
    font-size: 28px;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 14px;
    border: 3px solid #E6F1FB;
}

.profile-name {
    font-size: 16px;
    font-weight: 800;
    color: #0d1b2a;
    margin-bottom: 2px;
}

.profile-email {
    font-size: 12px;
    color: #adb5bd;
    margin-bottom: 20px;
}

.divider {
    border: none;
    border-top: 1px solid #f4f6f9;
    margin: 20px 0;
}

.photo-label {
    font-size: 12px;
    font-weight: 700;
    color: #adb5bd;
    text-transform: uppercase;
    letter-spacing: .05em;
    margin-bottom: 10px;
    display: block;
    text-align: left;
}

.info-card {
    background: #fff;
    border: 1px solid #e9ecef;
    border-radius: 16px;
    padding: 26px 24px;
}

.section-title {
    font-size: 14px;
    font-weight: 800;
    color: #0d1b2a;
    margin-bottom: 18px;
}

.form-label {
    font-size: 13px;
    font-weight: 600;
    color: #495057;
    margin-bottom: 6px;
}

.form-control,
.form-select {
    font-size: 14px;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 10px 13px;
    color: #0d1b2a;
    transition: border-color .15s;
}

.form-control:focus,
.form-select:focus {
    border-color: #185FA5;
    box-shadow: none;
}

.section-divider {
    border: none;
    border-top: 1px solid #f4f6f9;
    margin: 24px 0;
}

.btn-submit {
    width: 100%;
    background: #185FA5;
    color: #fff;
    border: none;
    padding: 11px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background .15s;
    margin-top: 4px;
}

.btn-submit:hover {
    background: #0C447C;
}

.btn-upload {
    width: 100%;
    background: transparent;
    border: 1px solid #e9ecef;
    color: #495057;
    padding: 9px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: background .15s, border-color .15s;
    margin-top: 8px;
}

.btn-upload:hover {
    background: #f3f6fb;
    border-color: #b5d4f4;
    color: #185FA5;
}

</style>

{{-- Toast success --}}
@if(session('success'))
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="successToast" class="toast text-bg-success border-0">
        <div class="d-flex">
            <div class="toast-body">{{ session('success') }}</div>
            <button type="button"
                    class="btn-close btn-close-white me-2 m-auto"
                    data-bs-dismiss="toast">
            </button>
        </div>
    </div>
</div>
@endif

{{-- Toast error --}}
@if(session('error'))
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="errorToast" class="toast text-bg-danger border-0">
        <div class="d-flex">
            <div class="toast-body">{{ session('error') }}</div>
            <button type="button"
                    class="btn-close btn-close-white me-2 m-auto"
                    data-bs-dismiss="toast">
            </button>
        </div>
    </div>
</div>
@endif

{{-- Toast validation --}}
@if($errors->any())
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="validationToast" class="toast text-bg-danger border-0">
        <div class="d-flex">
            <div class="toast-body">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
            <button type="button"
                    class="btn-close btn-close-white me-2 m-auto"
                    data-bs-dismiss="toast">
            </button>
        </div>
    </div>
</div>
@endif

<!-- Header -->
<div class="page-header">
    <div>
        <p class="page-title">My Profile</p>
    </div>
</div>

<div class="row g-3 align-items-start">

    <div class="col-lg-4">
        <div class="profile-card">
            @if($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}"
                     alt="{{ $user->name }}"
                     class="profile-photo">
            @else
                <div class="profile-initials">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
            @endif
            <div class="profile-name">{{ $user->name }}</div>
            <hr class="divider">

            <form method="POST"
                  action="{{ route('profile.photo') }}"
                  enctype="multipart/form-data">
                @csrf
                <span class="photo-label">Profile Photo</span>
                <input type="file"
                       name="profile_picture"
                       class="form-control"
                       accept=".jpg,.jpeg,.png"
                       style="font-size:13px;">
                <button type="submit" class="btn-upload">
                    <i class="fa-solid fa-arrow-up-from-bracket me-1"></i>
                    Upload Photo
                </button>
            </form>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="info-card">

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                <p class="section-title">Profile Information</p>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name', $user->name) }}"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email', $user->email) }}"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Address</label>
                        <input type="text"
                               name="address"
                               class="form-control"
                               placeholder="e.g. GMA, Cavite"
                               value="{{ old('address', $user->address) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select">
                            <option value="">Select gender</option>
                            <option value="Male"
                                {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>
                                Male
                            </option>
                            <option value="Female"
                                {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>
                                Female
                            </option>
                            <option value="Other"
                                {{ old('gender', $user->gender) == 'Other' ? 'selected' : '' }}>
                                Other
                            </option>
                        </select>
                    </div>
                </div>

                <hr class="section-divider">

                <p class="section-title">Change Password</p>

                <div class="row g-3 mb-4">
                    <div class="col-md-12">
                        <label class="form-label">Current Password</label>
                        <input type="password"
                               name="current_password"
                               class="form-control"
                               placeholder="Enter current password">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">New Password</label>
                        <input type="password"
                               name="new_password"
                               class="form-control"
                               placeholder="Min. 8 characters">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password"
                               name="new_password_confirmation"
                               class="form-control"
                               placeholder="Re-enter new password">
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    Save Changes
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const successToast = document.getElementById('successToast');
    if (successToast) {
        new bootstrap.Toast(successToast, { delay: 5000 }).show();
    }
    const errorToast = document.getElementById('errorToast');
    if (errorToast) {
        new bootstrap.Toast(errorToast, { delay: 5000 }).show();
    }
    const validationToast = document.getElementById('validationToast');
    if (validationToast) {
        new bootstrap.Toast(validationToast, { delay: 5000 }).show();
    }
});
</script>

@endsection