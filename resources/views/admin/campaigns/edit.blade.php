@extends('layouts.main')
@section('title')
    {{ $title }}
@endsection

@push('styles')
    <style>
        textarea::placeholder {
            color: #6c757d;
            opacity: 1;
        }

        .icon-rotate {
            transition: transform 0.3s ease;
        }

        .rotate-down {
            transform: rotate(0deg);
        }

        .rotate-up {
            transform: rotate(180deg);
        }

        .filter-item .form-label {
            margin-bottom: 0;
            white-space: nowrap;
        }

        .filter-item .form-select {
            width: 100%;
        }
    </style>
@endpush

@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div class="page-title d-flex align-items-center me-3 flex-wrap lh-1">
                    <h3 class="text-dark fw-bolder my-1">
                        {{ $title }}
                    </h3>
                </div>
                <div class="d-flex align-items-center justify-content-between w-100 w-md-auto py-1">
                    <div class="me-4">
                        <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-back" id="kt_toolbar_primary_button"
                           title="Back to Campaigns">
                            <i class="fa fa-arrow-left"></i>
                            Back to Campaigns
                        </a>
                    </div>

                    <div class="">
                        <button class="btn btn-sm btn-primary btn-save-campaign d-md-none d-block" title="Save Campaign">
                        <span class="indicator-label">
                            <i class="fa fa-save me-2"></i> Save
                        </span>
                            <span class="indicator-progress" style="display: none;">
                            Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div id="kt_content_container" class="container-xxl">
            <form id="form-campaign">
                @csrf
                <div class="card">
                    <div class="card-body p-4 p-md-10">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title "><b>General</b></h3>
                                    </div>
                                    <div class="card-body p-3 p-md-10">
                                        <div class="row">
                                            <div class="col mb-5">
                                                <label for="name" class="form-label required">Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                       value="{{ old('name', $campaign->name) }}" placeholder="Enter name">
                                                <span class="text-danger error-text name_error"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-5">
                                                <label for="status" class="form-label required">Status</label>
                                                <select class="form-select" id="status" name="status">
                                                    <option value="active" {{ $campaign->status == 'active' ? 'selected' : '' }}>Active</option>
                                                    <option value="inactive" {{ $campaign->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                                <span class="text-danger error-text status_error"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-5">
                                                <label for="delay" class="form-label required">Delay</label>
                                                <input type="number" class="form-control" id="delay" name="delay"
                                                       value="{{ old('delay', $campaign->delay) }}" placeholder="Enter delay">
                                                <span class="text-danger error-text delay_error"></span>
                                            </div>
                                            <div class="col mb-5">
                                                <label for="delay_unit" class="form-label required">Delay Unit</label>
                                                <select class="form-select" id="delay_unit" name="delay_unit">
                                                    @foreach($timeUnits as $val)
                                                        <option value="{{ $val->abbreviation }}" {{ $campaign->delay_unit == $val->abbreviation ? 'selected' : '' }}>{{ $val->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-5">
                                                <label for="number_of_popups" class="form-label required">No of Pop</label>
                                                <input type="number" class="form-control" id="number_of_popups" name="number_of_popups"
                                                       value="{{ old('number_of_popups', $campaign->number_of_popups) }}" placeholder="Enter number of pop">
                                                <span class="text-danger error-text number_of_popups_error"></span>
                                            </div>
                                            <div class="col mb-5">
                                                <label for="every" class="form-label required">Every</label>
                                                <input type="number" class="form-control" id="every" name="every"
                                                       value="{{ old('every', $campaign->every) }}" placeholder="Enter frequency">
                                                <span class="text-danger error-text every_error"></span>
                                            </div>
                                            <div class="col mb-5">
                                                <label for="every_unit" class="form-label">&nbsp;</label>
                                                <select class="form-select" id="every_unit" name="every_unit">
                                                    @foreach($timeUnits as $val)
                                                        <option value="{{ $val->abbreviation }}" {{ $campaign->every_unit == $val->abbreviation ? 'selected' : '' }}>{{ $val->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-5">
                                                <label for="pop_interval" class="form-label required">Interval</label>
                                                <input min="1" type="number" class="form-control" id="pop_interval" name="pop_interval"
                                                       value="{{ old('pop_interval', $campaign->pop_interval) }}" placeholder="Enter interval">
                                                <span class="text-danger error-text pop_interval_error"></span>
                                            </div>
                                            <div class="col mb-5">
                                                <label for="interval_unit" class="form-label ">&nbsp;</label>
                                                <select class="form-select" id="interval_unit" name="interval_unit">
                                                    @foreach($timeUnits as $val)
                                                        <option value="{{ $val->abbreviation }}" {{ $campaign->interval_unit == $val->abbreviation ? 'selected' : '' }}>{{ $val->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-5">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" id="description" name="description"
                                                          rows="3">{{ old('description', $campaign->description) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Funnels Section -->
                            <div class="col-12 col-md-6 mb-4">
                                @include('admin.campaigns.partials.funnels', ['funnels' => $campaign->funnels])
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary btn-save-campaign" title="Update Campaign">
                                <span class="indicator-label">
                                    <i class=" fa fa-save me-2"></i>
                                    Update
                                </span>
                                <span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                            <a class="btn btn-light btn-back" title="Cancel" href="javascript:void(0)">
                                <i style="color: red" class="fa fa-warning"></i>
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for Copying Script -->

@endsection

@push('scripts')
    <script>



        // Handle Cancel button with SweetAlert
        $(document).on('click', '.btn-back', function () {
            Swal.fire({
                title: 'Are you sure?',
                text: "You are leaving this page without saving the campaign!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route('admin.campaigns.index') }}';
                }
            });
        });
    </script>
@endpush
