@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection
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
            </div>
        </div>

        {{-- search tool --}}


        <div id="kt_content_container" class="container-xxl">

            <div class="card">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-row-bordered gy-7 gs-7" id="table-offers">
                            <thead>
                            <tr class="fw-bolder fs-6 text-gray-800">
                                <th>#</th>
                                <th class="sorting_domain_name cursor-pointer">
                                    Domain Name <i class="fas fa-sort"></i>
                                </th>
                                <th class="sorting_url cursor-pointer">URL <i class="fas fa-sort"></i></th>
                                <th class="sorting_status cursor-pointer">Status <i class="fas fa-sort"></i></th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                                @foreach($data as $key => $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>
                                            <a href="{{ $value->url }}" target="_blank">
                                                {{ preg_replace('#^https?://#', '', $value->url) }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ $value->url }}" target="_blank">{{ $value->url }}</a>
                                        </td>
                                        <td>
                                            @if($value->status == 'active')
                                                <i class="fas fa-check-circle text-success fs-3" title="Active"></i>
                                            @else
                                                <i class="fas fa-times-circle text-danger fs-3" title="Inactive"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-light-info cursor-not-allowed">
                                                Coming soon
                                            </span>
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
            //sorting
            $('.sorting_domain_name').click(function () {
                var url = "{{ route('admin.websites.index') }}";
                var sort = 'domain_name';
                var order = 'asc';
                if ($(this).find('i').hasClass('fa-sort')) {
                    order = 'asc';
                } else if ($(this).find('i').hasClass('fa-sort-up ')) {
                    order = 'desc';
                } else if ($(this).find('i').hasClass('fa-sort-down')) {
                    order = 'asc';
                }
                window.location.href = url + '?sort=' + sort + '&order=' + order;

            });
        });
    </script>
@endpush
