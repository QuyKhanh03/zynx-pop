@extends('layouts.main')

@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                     data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                     class="page-title d-flex align-items-center me-3 flex-wrap lh-1">
                    <h3 class="text-dark fw-bolder my-1">
                        {{ $title }}
                    </h3>
                </div>
                <div class="d-flex align-items-center py-1">
                    <div class="me-4">
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-primary btn-back"
                       id="kt_toolbar_primary_button"
                       title="Back to Dashboard">
                        <i class="fa fa-arrow-left"></i>
                        Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
        <div class="container-xxl" id="kt_content_container">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_signin_method">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Sign-in Method</h3>
                    </div>
                </div>
                <div id="kt_account_settings_signin_method" class="collapse show">
                    <div class="card-body border-top p-9">
                        <div class="d-flex flex-wrap align-items-center">
                            <div id="kt_signin_email" class="">
                                <div class="fs-6 fw-bold mb-1">Email Address</div>
                                <div class="fw-semibold text-gray-600">
                                    {{ auth()->user()->email }}
                                </div>
                            </div>
                            <div id="kt_signin_email_edit" class="flex-row-fluid d-none">
                                <form id="kt_signin_change_email" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                                    <div class="row mb-6">
                                        <div class="col-lg-6 mb-4 mb-lg-0">
                                            <div class="fv-row mb-0 fv-plugins-icon-container">
                                                <label for="emailaddress" class="form-label fs-6 fw-bold mb-3">Enter New Email Address</label>
                                                <input type="email" class="form-control form-control-lg form-control-solid" id="emailaddress" placeholder="Email Address" name="emailaddress" value="{{ auth()->user()->email }}">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="fv-row mb-0 fv-plugins-icon-container">
                                                <label for="confirmemailpassword" class="form-label fs-6 fw-bold mb-3">Confirm Password</label>
                                                <input type="password" class="form-control form-control-lg form-control-solid" name="confirmemailpassword" id="confirmemailpassword">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button id="kt_signin_submit" type="button" class="btn btn-primary me-2 px-6">Update Email</button>
                                        <button id="kt_signin_cancel" type="button" class="btn btn-color-gray-500 btn-active-light-primary px-6">Cancel</button>
                                    </div>
                                </form>
                            </div>
                            <div  class="ms-auto">
                                <button  id="kt_signin_email_button" class="btn btn-light btn-active-light-primary cursor-pointer" disabled title="You can't change your email address">
                                    Change Email
                                </button>
                            </div>
                        </div>
                        <div class="separator separator-dashed my-6"></div>
                        <div class="d-flex flex-wrap align-items-center mb-10">
                            <div id="kt_signin_password" class="">
                                <div class="fs-6 fw-bold mb-1">Password</div>
                                <div class="fw-semibold text-gray-600">************</div>
                            </div>
                            <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                                <form id="kt_signin_change_password" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                                    <div class="row mb-1">
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0 fv-plugins-icon-container">
                                                <label for="currentpassword" class="form-label fs-6 fw-bold mb-3">Current Password</label>
                                                <input type="password" class="form-control form-control-lg form-control-solid" name="currentpassword" id="currentpassword">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0 fv-plugins-icon-container">
                                                <label for="newpassword" class="form-label fs-6 fw-bold mb-3">New Password</label>
                                                <input type="password" class="form-control form-control-lg form-control-solid" name="newpassword" id="newpassword">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0 fv-plugins-icon-container">
                                                <label for="confirmpassword" class="form-label fs-6 fw-bold mb-3">Confirm New Password</label>
                                                <input type="password" class="form-control form-control-lg form-control-solid" name="confirmpassword" id="confirmpassword">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                                        </div>
                                    </div>
                                    <div class="form-text mb-5">Password must be at least 8 character and contain symbols</div>
                                    <div class="d-flex">
                                        <button id="kt_password_submit" type="button" class="btn btn-primary me-2 px-6">Update Password</button>
                                        <button id="kt_password_cancel" type="button" class="btn btn-color-gray-500 btn-active-light-primary px-6">Cancel</button>
                                    </div>
                                </form>
                            </div>
                            <div id="kt_signin_password_button" class="ms-auto">
                                <button class="btn btn-light btn-active-light-primary">Reset Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#kt_signin_email_button').on('click', function () {
                $('#kt_signin_email_button').addClass('d-none');
                $('#kt_signin_email').addClass('d-none');
                $('#kt_signin_email_edit').removeClass('d-none');
            });

            $('#kt_signin_cancel').on('click', function () {
                $('#kt_signin_email').removeClass('d-none');
                $('#kt_signin_email_edit').addClass('d-none');
                $('#kt_signin_email_button').removeClass('d-none');
            });

            $('#kt_signin_password_button').on('click', function () {
                $('#kt_signin_password_button').addClass('d-none');
                $('#kt_signin_password').addClass('d-none');
                $('#kt_signin_password_edit').removeClass('d-none');
            });

            $('#kt_password_cancel').on('click', function () {
                $('#kt_signin_password').removeClass('d-none');
                $('#kt_signin_password_edit').addClass('d-none');
                $('#kt_signin_password_button').removeClass('d-none');
            });
        });
    </script>
@endpush
