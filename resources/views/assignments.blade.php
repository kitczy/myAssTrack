@extends('layouts.sidebar')

@section('page-title', 'Assignments')

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

.btn-add {
    background: #185FA5;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: background .15s;
    display: flex;
    align-items: center;
    gap: 7px;
}

.btn-add:hover {
    background: #0C447C;
    color: #fff;
}

.table-card {
    background: #fff;
    border: 1px solid #e9ecef;
    border-radius: 16px;
    overflow: hidden;
}

.table-card table {
    margin: 0;
}

.table-card thead tr {
    border-bottom: 1px solid #e9ecef;
}

.table-card thead th {
    font-size: 11px;
    font-weight: 700;
    color: #adb5bd;
    text-transform: uppercase;
    letter-spacing: .06em;
    padding: 14px 18px;
    background: #fff;
    border: none;
}

.table-card tbody td {
    font-size: 14px;
    color: #495057;
    padding: 13px 18px;
    border-top: 1px solid #f4f6f9;
    vertical-align: middle;
}

.table-card tbody tr:hover td {
    background: #fafbfc;
}

.assignment-title {
    font-weight: 600;
    color: #0d1b2a;
    font-size: 14px;
}

.assignment-desc {
    font-size: 12px;
    color: #adb5bd;
    margin-top: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 220px;
}

.due-badge {
    display: inline-block;
    font-size: 12px;
    font-weight: 600;
    padding: 4px 11px;
    border-radius: 99px;
}

.due-badge.overdue { background: #fff0f0; color: #dc3545; }
.due-badge.soon    { background: #faeeda; color: #854f0b; }
.due-badge.normal  { background: #E6F1FB; color: #185FA5; }
.due-badge.done    { background: #eaf3de; color: #3b6d11; }

.action-btn {
    background: transparent;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 5px 12px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: background .15s, color .15s, border-color .15s;
}

.action-btn.edit {
    color: #185FA5;
}

.action-btn.edit:hover {
    background: #E6F1FB;
    border-color: #b5d4f4;
    color: #185FA5;
}

.action-btn.delete {
    color: #dc3545;
}

.action-btn.delete:hover {
    background: #fff0f0;
    border-color: #f5c6cb;
    color: #dc3545;
}

.empty-row td {
    text-align: center;
    padding: 48px 0;
    color: #adb5bd;
    font-size: 14px;
}

.empty-row i {
    font-size: 28px;
    display: block;
    margin-bottom: 10px;
    color: #dee2e6;
}

/* Modal */
.modal-content {
    border: 1px solid #e9ecef;
    border-radius: 16px;
    box-shadow: none;
}

.modal-header {
    border-bottom: 1px solid #e9ecef;
    padding: 18px 22px;
}

.modal-title {
    font-size: 15px;
    font-weight: 800;
    color: #0d1b2a;
}

.modal-body {
    padding: 22px;
}

.form-label {
    font-size: 13px;
    font-weight: 600;
    color: #495057;
    margin-bottom: 6px;
}

.form-control {
    font-size: 14px;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 10px 13px;
    color: #0d1b2a;
    transition: border-color .15s;
}

.form-control:focus {
    border-color: #185FA5;
    box-shadow: none;
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

.btn-submit.warning {
    background: #854f0b;
}

.btn-submit.warning:hover {
    background: #633806;
}

.delete-modal-body {
    text-align: center;
    padding: 32px 24px;
}

.delete-modal-body h5 {
    font-size: 16px;
    font-weight: 800;
    color: #0d1b2a;
    margin-bottom: 8px;
}

.delete-modal-body p {
    font-size: 14px;
    color: #adb5bd;
    margin-bottom: 22px;
}

.btn-cancel {
    background: transparent;
    border: 1px solid #e9ecef;
    color: #6c757d;
    padding: 10px 22px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background .15s;
    margin-right: 8px;
}

.btn-cancel:hover {
    background: #f4f6f9;
}

.btn-delete-confirm {
    background: #dc3545;
    border: none;
    color: #fff;
    padding: 10px 22px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background .15s;
}

.btn-delete-confirm:hover {
    background: #b02a37;
}

</style>

{{-- Toast success --}}
@if(session('success'))
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="successToast" class="toast text-bg-success border-0">
        <div class="d-flex">
            <div class="toast-body">{{ session('success') }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
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
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
@endif

{{-- Validation errors --}}
@if($errors->any())
<div class="alert alert-danger rounded-3 mb-3" style="font-size:14px;">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- Header -->
<div class="page-header">
    <div>
        <p class="page-title">Assignment Tracker</p>
    </div>
    <button class="btn-add"
            data-bs-toggle="modal"
            data-bs-target="#addAssignmentModal">
        <i class="fa-solid fa-plus"></i>
        Add Assignment
    </button>
</div>

<!-- Table -->
<div class="table-card">
    <table class="table">
        <thead>
            <tr>
                <th style="width:40px;"></th>
                <th>Assignment</th>
                <th>Due Date</th>
                <th>Created</th>
                <th style="width:130px;">Actions</th>
            </tr>
        </thead>

        <tbody>
                @forelse($assignments as $assignment)
                @php
                    $due  = \Carbon\Carbon::parse($assignment->due_date);
                    $now  = now();
                    $diff = $now->diffInHours($due, false);
                @endphp

                <tr>
                    <td style="color:#adb5bd; font-size:13px;">
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        <div class="assignment-title">{{ $assignment->title }}</div>

                        @if($assignment->description)
                            <div class="assignment-desc">
                                {{ $assignment->description }}
                            </div>
                        @endif
                    </td>

                    {{-- Due date --}}
                    <td style="font-size:13px; color:#495057;">
                        {{ $due->format('M j, Y') }}
                    </td>

                    <td style="font-size:13px; color:#adb5bd;">
                        {{ $assignment->created_at->format('M j, Y') }}
                    </td>

                    {{-- Actions --}}
                    <td>
                        <button class="action-btn edit"
                                data-bs-toggle="modal"
                                data-bs-target="#editAssignmentModal{{ $assignment->id }}"
                                title="Edit">
                            <i class="fa-solid fa-pen"></i>
                        </button>

                        <button class="action-btn delete"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteAssignmentModal{{ $assignment->id }}"
                                title="Delete">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>

                @empty

                <tr class="empty-row">
                    <td colspan="5">
                        <i class="fa-regular fa-folder-open"></i>
                        No assignments yet. Add one to get started.
                    </td>
                </tr>

                @endforelse

    </tbody>
    </table>
</div>


<!-- Add modal -->
<div class="modal fade" id="addAssignmentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Assignment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ url('/assignments') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text"
                               name="title"
                               class="form-control"
                               placeholder="e.g. ITEC 106"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description <span style="color:#adb5bd; font-weight:400;">(optional)</span></label>
                        <textarea name="description"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Add any notes or details..."></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Due Date</label>
                        <input type="date"
                               name="due_date"
                               class="form-control"
                               required>
                    </div>

                    <button type="submit" class="btn-submit">
                        Save Assignment
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit + Delete modals -->
@foreach($assignments as $assignment)

<!-- Edit -->
<div class="modal fade" id="editAssignmentModal{{ $assignment->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Assignment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ url('/assignments/' . $assignment->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text"
                               name="title"
                               class="form-control"
                               value="{{ $assignment->title }}"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description <span style="color:#adb5bd; font-weight:400;">(optional)</span></label>
                        <textarea name="description"
                                  class="form-control"
                                  rows="3">{{ $assignment->description }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Due Date</label>
                        <input type="date"
                               name="due_date"
                               class="form-control"
                               value="{{ $assignment->due_date }}"
                               required>
                    </div>

                    <button type="submit" class="btn-submit warning">
                        Update Assignment
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="deleteAssignmentModal{{ $assignment->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="delete-modal-body">
                <h5>Delete Assignment?</h5>
                <p>This will permanently remove<br><strong style="color:#0d1b2a;">{{ $assignment->title }}</strong></p>

                <form method="POST" action="{{ url('/assignments/' . $assignment->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="button"
                            class="btn-cancel"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn-delete-confirm">
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
        new bootstrap.Toast(successToast, { delay: 5000 }).show();
    }
    const errorToast = document.getElementById('errorToast');
    if (errorToast) {
        new bootstrap.Toast(errorToast, { delay: 5000 }).show();
    }
});
</script>

@endsection