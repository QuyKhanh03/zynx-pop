@extends('layouts.main')
@section('title', 'Offers')
@push('styles')
    <style>
        #table-offers td {
            padding: 5px !important;
            line-height: 1.2 !important;
            vertical-align: middle !important;
        }
        .offer-name {
            position: relative;
            cursor: pointer;
        }

        .offer-name .action-column {
            display: none; /* Initially hidden */
            position: absolute;
            right: 10px;
            background: transparent;
            bottom: 5px;
        }

        .offer-row:hover .offer-name .action-column {
            display: block; /* Show on row hover */
        }
        .stats {
            min-width: 145px;
            max-width: 145px;
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
                        <table class="table table-striped table-bordered gy-7 gs-7" id="table-offers" >
                            <thead>
                            <tr class="fw-bolder fs-6 text-center text-gray-800">
                                <th>#</th>
                                <th style="min-width: 280px">Direct Link Name</th>
                                <th>Partner</th>
                                <th>Status</th>
                                <th class="stats" >Impressions</th>
                                <th class="stats"  >Clicks</th>
                                <th class="stats"  >CTR</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($data) > 0)
                                @foreach($data as $key => $offer)
                                    <tr class="offer-row">
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="offer-name">
                                            <b>{{ $offer->name }}</b>
                                            <span class="action-column" >
                                            <a href="#" class="text-blue-600 me-2" title="View Report">
                                                <i class="fa fa-line-chart" style="color:#0a6aa1;"></i>
                                            </a>
                                            <a href="{{ route('admin.offers.edit', $offer->id) }}" class="text-blue-600" title="Edit Offer">
                                                <i class="fa fa-edit" style="color:#0a6aa1;"></i>
                                            </a>
                                            <form action="{{ route('admin.offers.destroy', $offer->id) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete" title="Delete Offer" style="background: transparent; border: none; color: #e63757;">
                                                    <i class="fa fa-trash" style="color: #0a6aa1"></i>
                                                </button>
                                            </form>
                                        </span>
                                        </td>


                                        <td class="text-center">
                                            {{ $offer->partner }}
                                        </td>
                                        <td class="text-center">
                                            @if($offer->status == 'active')
                                                <i class="fas fa-check-circle text-success fs-3" title="Active"></i>
                                            @else
                                                <i class="fas fa-times-circle text-danger fs-3" title="Inactive"></i>
                                            @endif
                                        </td>

                                        @php
                                            $totalImpressions = $offer->stats->sum('impressions');
                                            $totalClicks = $offer->stats->sum('clicks');
                                            $ctr = $totalImpressions > 0 ? ($totalClicks / $totalImpressions) * 100 : 0;
                                        @endphp
                                        <td class="text-end">{{ $totalImpressions > 0 ? number_format($totalImpressions) : '-' }}</td>
                                        <td class="text-end">{{ $totalClicks > 0 ? number_format($totalClicks) : '-' }}</td>
                                        <td class="text-end">{{ $ctr > 0 ? number_format($ctr) .'%' : '-' }}</td>
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
