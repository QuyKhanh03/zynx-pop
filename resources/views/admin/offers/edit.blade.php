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
    </style>
@endpush
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
                    <a href="" class="btn btn-sm btn-primary btn-back"
                       id="kt_toolbar_primary_button"
                       title="Back to Offers">
                        <i class="fa fa-arrow-left"></i>
                        Back to Offers
                    </a>
                </div>
            </div>
        </div>
        <div id="kt_content_container" class="container-xxl">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('admin.offers.update', $model->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-5">
                                    <label for="name" class="form-label required">Offer Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter offer name" value="{{ $model->name ?? old('name') }}">
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                </div>
                                <div class="mb-5">
                                    <label for="direct_link" class="form-label required">Direct Link</label>
                                    <input type="text" class="form-control" id="direct_link" name="direct_link" placeholder="Enter direct link" value="{{ $model->direct_link ?? old('direct_link') }}">
                                    <span class="text-danger">{{ $errors->first('direct_link') }}</span>
                                </div>
                                <div class="mb-5">
                                    <label for="status" class="form-label required">Offer Status</label>
                                    <select class="form-select" id="status" name="status" >
                                        <option value="1" {{ $model->status == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $model->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <span class="text-danger">{{ $errors->first('status') }}</span>
                                </div>
                                <div class="mb-5">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" >
                                        {{ $model->description ?? old('description') }}
                                    </textarea>
                                </div>
                                <div class="mb-5">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i>
                                        Save
                                    </button>
                                    <a href="{{ route('admin.offers.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
