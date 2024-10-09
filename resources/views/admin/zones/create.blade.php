@extends('layouts.main')
@section('title', $title)
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
                    <a href="{{ route('admin.zones.index') }}" class="btn btn-sm btn-primary btn-back"
                       id="kt_toolbar_primary_button"
                       title="Back to zones! You are leaving the page without unsaved changes">
                        <i class="fas fa-arrow-left"></i>
                        Back to zones
                    </a>
                </div>
            </div>
        </div>
        <div id="kt_content_container" class="container-xxl">
            <form action="" method="POST">
                @csrf
                <div class="row mb-7">
                    <div class="col-md-6 col-12 mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h3 class="card-title">General Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label required">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Enter zone name">
                                </div>
                                <div class="mb-3">
                                    <label for="website" class="form-label required">Website</label>
                                    <select class="form-select select2-search" id="website" name="website">
                                        <option value="">Select website</option>
                                        <option value="1">Website 1</option>
                                        <option value="2">Website 2</option>
                                        <option value="3">Website 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h3 class="card-title">Ad Type</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="delay" class="form-label required">Delay Interval</label>
                                        <input type="number" id="delay" class="form-control" value="0" name="delay">
                                    </div>
                                    <div class="col-6">
                                        <label for="type_delay" class="form-label">&nbsp;</label>
                                        <select class="form-select" id="type_delay" name="type_delay">
                                            <option value="1">Seconds</option>
                                            <option value="2">Minutes</option>
                                            <option value="3">Hours</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="frequency" class="form-label required">Frequency Capping</label>
                                        <input type="number" id="frequency" class="form-control" value="5"
                                               name="frequency">
                                    </div>
                                    <div class="col-6">
                                        <label for="type_frequency" class="form-label">&nbsp;</label>
                                        <select class="form-select" id="type_frequency" name="type_frequency">
                                            <option value="1">Seconds</option>
                                            <option value="2">Minutes</option>
                                            <option value="3">Hours</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-7">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">URL Targeting (Optional) and Geo Targeting</h3>
                                <div class="d-flex justify-content-center align-items-center">
                                    <button type="button" class="btn btn-success btn-add-url"
                                            id="add-url-btn"
                                            title="Add new URL targeting">
                                        <i class="fas fa-plus"></i> Add URL
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="list-url-targeting">
                                    <div class="item-url">
                                        <div class="row">
                                            <div class="col-6 mb-5">
                                                <label for="url" class="form-label required">URL</label>
                                                <input type="text" class="form-control" id="url" name="url"
                                                       placeholder="Enter URL">
                                            </div>
                                            <div class="col mb-5">
                                                <label for="ratio" class="form-label">Ratio %</label>
                                                <input type="number" class="form-control" id="ratio" name="ratio" value="100">
                                            </div>
                                            <div class="col mb-5">
                                                <label for="geo" class="form-label">Geo Targeting</label>
                                                <select class="form-select select2-search" id="geo" name="geo">
                                                    <option value="">Select geo targeting</option>
                                                    <option value="1">Geo 1</option>
                                                    <option value="2">Geo 2</option>
                                                    <option value="3">Geo 3</option>
                                                </select>
                                            </div>
                                            <div class="col mb-5">
                                                <label for="device" class="form-label">Device Targeting</label>
                                                <select class="form-select select2-search" id="device" name="device">
                                                    <option value="">Select device targeting</option>
                                                    <option value="1">Desktop</option>
                                                    <option value="2">Mobile</option>
                                                    <option value="3">Tablet</option>
                                                </select>
                                            </div>
                                            <div class="col mb-5">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" id="status" name="status">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary" title="Save changes">
                            <i class="fas fa-save"></i> Save
                        </button>
                        <a href="{{ route('admin.zones.index') }}" class="btn btn-secondary btn-back"
                           title="You are leaving the page without saving changes">
                            <span class="btn-icon"><i class="fas fa-exclamation-triangle"></i></span> Cancel
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            //website select2 search
            $('.select2-search').select2({
                placeholder: 'Select website',
                allowClear: true,
                width: '100%'
            });

            $('.btn-back').click(function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are leaving the page without unsaved changes!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, leave!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = $(this).attr('href');
                    }
                });
            });

            $('#add-url-btn').on('click', function() {
                var newItem = `
                    <div class="item-url">
                        <div class="row">
                            <div class="col-6 mb-5">
                                <label for="url" class="form-label required">URL</label>
                                <input type="text" class="form-control" name="url[]" placeholder="Enter URL">
                            </div>
                            <div class="col mb-5">
                                <label for="ratio" class="form-label">Ratio %</label>
                                <input type="number" class="form-control" name="ratio[]" value="100">
                            </div>
                            <div class="col mb-5">
                                <label for="geo" class="form-label">Geo Targeting</label>
                                <select class="form-select select2-search" name="geo[]">
                                    <option value="">Select geo targeting</option>
                                    <option value="1">Geo 1</option>
                                    <option value="2">Geo 2</option>
                                    <option value="3">Geo 3</option>
                                </select>
                            </div>
                            <div class="col mb-5">
                                <label for="device" class="form-label">Device Targeting</label>
                                <select class="form-select select2-search" name="device[]">
                                    <option value="">Select device targeting</option>
                                    <option value="1">Desktop</option>
                                    <option value="2">Mobile</option>
                                    <option value="3">Tablet</option>
                                </select>
                            </div>
                            <div class="col mb-5">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status[]">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                `;

                $('.list-url-targeting').append(newItem);
            });


        });
    </script>
@endpush
