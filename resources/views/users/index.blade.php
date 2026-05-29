@extends('layouts.sidebar')

@section('page-title', 'Users')

@section('content')

<style>

.page-header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:22px;
    gap:15px;
    flex-wrap:wrap;
}

.page-title{
    font-size:18px;
    font-weight:800;
    color:#0d1b2a;
    margin:0 0 3px;
}

.page-sub{
    font-size:13px;
    color:#adb5bd;
    margin:0;
}

.btn-add{
    background:#185FA5;
    color:#fff;
    border:none;
    padding:10px 18px;
    border-radius:12px;
    font-size:13px;
    font-weight:600;
    cursor:pointer;
    transition:.2s ease;
    display:flex;
    align-items:center;
    gap:7px;
}

.btn-add:hover{
    background:#0C447C;
    color:#fff;
    transform:translateY(-1px);
}

.table-card{
    background:#fff;
    border:1px solid #e9ecef;
    border-radius:18px;
    overflow:hidden;
}

.table{
    margin:0;
}

.table thead th{
    font-size:11px;
    font-weight:700;
    color:#adb5bd;
    text-transform:uppercase;
    letter-spacing:.06em;
    padding:16px 20px;
    background:#fff;
    border:none;
    border-bottom:1px solid #e9ecef;
    white-space:nowrap;
}

.table tbody td{
    font-size:14px;
    color:#495057;
    padding:16px 20px;
    border-top:1px solid #f4f6f9;
    vertical-align:middle;
}

.table tbody tr{
    transition:.15s ease;
}

.table tbody tr:hover{
    background:#fafcff;
}

.user-name{
    font-size:14px;
    font-weight:700;
    color:#0d1b2a;
    margin-bottom:2px;
}

.user-email{
    font-size:12px;
    color:#adb5bd;
}

.joined-date{
    font-size:13px;
    color:#6c757d;
}

.action-group{
    display:flex;
    align-items:center;
    gap:8px;
}

.action-btn{
    width:36px;
    height:36px;
    border-radius:10px;
    border:1px solid #e9ecef;
    background:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    transition:.15s ease;
    font-size:13px;
}

.action-btn.edit{
    color:#185FA5;
}

.action-btn.edit:hover{
    background:#E6F1FB;
    border-color:#b5d4f4;
}

.action-btn.delete{
    color:#dc3545;
}

.action-btn.delete:hover{
    background:#fff0f0;
    border-color:#f5c6cb;
}

.empty-row td{
    text-align:center;
    padding:60px 20px;
    color:#adb5bd;
    font-size:14px;
}

.empty-row i{
    font-size:32px;
    display:block;
    margin-bottom:12px;
    color:#dee2e6;
}

/* Modal */

.modal-content{
    border:none;
    border-radius:18px;
    overflow:hidden;
}

.modal-header{
    padding:18px 22px;
    border-bottom:1px solid #eef1f4;
}

.modal-title{
    font-size:16px;
    font-weight:800;
    color:#0d1b2a;
}

.modal-body{
    padding:22px;
}

.form-label{
    font-size:13px;
    font-weight:600;
    color:#495057;
    margin-bottom:7px;
}

.form-control{
    border:1px solid #e9ecef;
    border-radius:12px;
    padding:11px 14px;
    font-size:14px;
    color:#0d1b2a;
}

.form-control:focus{
    border-color:#185FA5;
    box-shadow:none;
}

.btn-submit{
    width:100%;
    border:none;
    border-radius:12px;
    padding:12px;
    background:#185FA5;
    color:#fff;
    font-size:14px;
    font-weight:600;
    transition:.15s ease;
}

.btn-submit:hover{
    background:#0C447C;
}

.btn-submit.warning{
    background:#854f0b;
}

.btn-submit.warning:hover{
    background:#633806;
}

.delete-modal-body{
    padding:34px 26px;
    text-align:center;
}

.delete-modal-body h5{
    font-size:17px;
    font-weight:800;
    margin-bottom:10px;
    color:#0d1b2a;
}

.delete-modal-body p{
    font-size:14px;
    color:#adb5bd;
    margin-bottom:24px;
}

.btn-cancel{
    border:1px solid #e9ecef;
    background:#fff;
    color:#6c757d;
    padding:10px 18px;
    border-radius:10px;
    font-size:14px;
    font-weight:600;
    margin-right:8px;
}

.btn-cancel:hover{
    background:#f4f6f9;
}

.btn-delete-confirm{
    border:none;
    background:#dc3545;
    color:#fff;
    padding:10px 18px;
    border-radius:10px;
    font-size:14px;
    font-weight:600;
}

.btn-delete-confirm:hover{
    background:#b02a37;
}

</style>

{{-- Toast success --}}
@if(session('success'))
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="successToast"
         class="toast text-bg-success border-0">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('success') }}
            </div>
            <button type="button"
                    class="btn-close btn-close-white me-2 m-auto"
                    data-bs-dismiss="toast">
            </button>
        </div>
    </div>
</div>
@endif

{{-- Toast error --}}
@if($errors->any())
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="errorToast"
         class="toast text-bg-danger border-0">
        <div class="d-flex">
            <div class="toast-body">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
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
        <p class="page-title">
            Users Management
        </p>
    </div>

    <button class="btn-add"
            data-bs-toggle="modal"
            data-bs-target="#addModal">
        <i class="fa-solid fa-plus"></i>
        Add User
    </button>
</div>

<!-- Table -->
<div class="table-card">
    <table class="table">
        <thead>
            <tr>
                <th style="width:50px;"></th>
                <th>User</th>
                <th>Joined</th>
                <th style="width:120px;">Actions</th>
            </tr>
        </thead>

        <tbody>
        @forelse($users as $user)
        <tr>
            <td style="color:#adb5bd; font-size:13px;">
                {{ $loop->iteration }}
            </td>

            <td>
                <div>
                    <div class="user-name">
                        {{ $user->name }}
                    </div>

                    <div class="user-email">
                        {{ $user->email }}
                    </div>

                </div>
            </td>

            <td class="joined-date">
                {{ $user->created_at->format('M j, Y') }}
            </td>

            <td>
                <div class="action-group">
                    <button class="action-btn edit"
                            title="Edit"
                            data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $user->id }}">
                        <i class="fa-solid fa-pen"></i>
                    </button>

                    <button class="action-btn delete"
                            title="Delete"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $user->id }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>

        @empty

        <tr class="empty-row">
            <td colspan="4">
                <i class="fa-regular fa-user"></i>
                No users found.
            </td>
        </tr>

        @endforelse

        </tbody>
    </table>
</div>

<!-- Add modal -->
<div class="modal fade"
     id="addModal"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Add New User
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body">
                <form method="POST"
                      action="{{ route('users.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">
                            Full Name
                        </label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               placeholder="e.g. Juan dela Cruz"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Email
                        </label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               placeholder="e.g. juan@email.com"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Password
                        </label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Minimum 8 characters"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            Confirm Password
                        </label>
                        <input type="password"
                               name="password_confirmation"
                               class="form-control"
                               placeholder="Re-enter password"
                               required>
                    </div>

                    <button type="submit"
                            class="btn-submit">
                        Save User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit + Delete -->
@foreach($users as $user)

<!-- Edit -->
<div class="modal fade"
     id="editModal{{ $user->id }}"
     tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Edit User
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <form method="POST"
                      action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">
                            Full Name
                        </label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ $user->name }}"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            Email
                        </label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ $user->email }}"
                               required>
                    </div>

                    <button type="submit"
                            class="btn-submit warning">
                        Update User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade"
     id="deleteModal{{ $user->id }}"
     tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="delete-modal-body">
                <h5>
                    Delete User?
                </h5>
                <p>
                    This will permanently remove
                    <br>
                    <strong style="color:#0d1b2a;">
                        {{ $user->name }}
                    </strong>
                </p>

                <form method="POST"
                      action="{{ route('users.destroy', $user->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="button"
                            class="btn-cancel"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                            class="btn-delete-confirm">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endforeach

<script>

document.addEventListener('DOMContentLoaded', function () {
    const successToast = document.getElementById('successToast');
    if (successToast) {
        new bootstrap.Toast(successToast, {
            delay: 5000
        }).show();
    }
    const errorToast = document.getElementById('errorToast');
    if (errorToast) {
        new bootstrap.Toast(errorToast, {
            delay: 5000
        }).show();
    }
});

</script>

@endsection