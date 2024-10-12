@extends('layouts.main')
@section('title', 'Offers')
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
                    <a href="{{ route('admin.offers.create') }}" class="btn btn-sm btn-primary btn-back"
                       id="kt_toolbar_primary_button"
                       title="Create New Offer">
                        <i class="fa fa-plus"></i>
                        Create New Offer
                    </a>
                </div>
            </div>
        </div>
        <div id="kt_content_container" class="container-xxl">
            <div class="card">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-row-bordered gy-7 gs-7" id="table-offers">
                            <thead>
                            <tr class="fw-bolder fs-6 text-gray-800" >
                                <th>#</th>
                                <th>Direct Link Name</th>
                                <th>URL</th>
                                <th>Partner</th>
                                <th>Offer Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                                @foreach($data as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <b>{{ $value->name }}</b>
                                        </td>
                                        <td>
                                            <a href="{{ $value->direct_link }}" target="_blank">{{ $value->direct_link }}</a>
                                        </td>
                                        <td>
                                            {{ $value->partner }}
                                        </td>
                                        <td >
                                            @if($value->status == 'active')
                                                <i class="fas fa-check-circle text-success fs-3" title="Active"></i>
                                            @else
                                                <i class="fas fa-times-circle text-danger fs-3" title="Inactive"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.offers.edit', $value->id) }}" class="btn btn-sm btn-success" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.offers.destroy', $value->id) }}" method="POST" class="d-inline" title="Delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger btn-delete" title="Delete" >
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">No offers found.</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination-wrapper">
                        {{ $data->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            //btn delete
            $('.btn-delete').on('click', function (e) {
                e.preventDefault();
                //sweet alert
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).closest('form').submit();
                    }
                });
            });
        });
    </script>
@endpush
