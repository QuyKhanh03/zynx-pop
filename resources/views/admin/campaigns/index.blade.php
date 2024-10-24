@extends('layouts.main')
@push('styles')
    <style>
        #table-campaigns td {
            padding: 5px !important;
            line-height: 1.2 !important;
            vertical-align: middle !important;
        }

        .campaign-name {
            position: relative;
            cursor: pointer;
            min-width: 200px;

        }

        .campaign-name .action-column {
            display: none; /* Initially hidden */
            position: absolute;
            right: 10px;
            background: transparent;
            bottom: 5px;
        }

        .campaign-row:hover .campaign-name .action-column {
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
                    <a href="{{ route('admin.campaigns.create') }}" class="btn btn-sm btn-primary btn-back"
                       id="kt_toolbar_primary_button"
                       title="Create New Campaign">
                        <i class="fa fa-plus"></i>
                        Create New Campaign
                    </a>
                </div>
            </div>
        </div>
        <div id="kt_content_container" class="container-xxl">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered gs-7" id="table-campaigns">
                            <thead>
                            <tr class="text-center">
                                <th title="Zone ID">
                                    <div>Zone ID</div>
                                    <div>
                                        &nbsp;
                                    </div>
                                </th>
                                <th>
                                    <div>Campaign</div>
                                    <div>
                                        &nbsp;
                                    </div>
                                <th>
                                    <div>Delay</div>
                                    <div>
                                        &nbsp;
                                    </div>
                                </th>
                                <th>
                                    <div>Frequency</div>
                                    <div>
                                        &nbsp;
                                    </div>
                                </th>
                                <th>
                                    <div>Interval</div>
                                    <div>
                                        &nbsp;
                                    </div>
                                </th>
                                <th class="text-center">
                                    <div>Status</div>
                                    <div>
                                        &nbsp;
                                    </div>
                                </th>
                                <th class="stats">
                                    <div>Impressions</div>

                                    <div class="text-end ">
                                        <small class="total-impressions"></small>
                                    </div>

                                </th>
                                <th class="stats">
                                    <div>Clicks</div>
                                    <div class="text-end">
                                        <small class="total-clicks"></small>
                                    </div>
                                </th>
                                <th class="stats">
                                    <div>CTR</div>
                                    <div>
                                        &nbsp;
                                    </div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($campaigns as $key => $value)
                                <tr class="campaign-row">
                                    <td class="text-center">
                                        <b title="Zone ID">{{ '#' . $value->code }}</b>
                                    </td>
                                    <td class="campaign-name">
                                        <b>{{ $value->name }}</b>
                                        <span class="action-column">
                                            <a href="#" class="text-blue-600 me-2" title="View Report">
                                                <i class="fa fa-line-chart" style="color:#0a6aa1;"></i>
                                            </a>
                                            <a href="{{ route('admin.campaigns.edit', $value->id) }}"
                                               class="text-blue-600" title="Edit Campaign">
                                                <i class="fa fa-edit" style="color:#0a6aa1;"></i>
                                            </a>
                                            <form action="{{ route('admin.campaigns.destroy', $value->id) }}"
                                                  method="POST"
                                                  class="d-inline" id="form-delete-campaign-{{ $value->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete" title="Delete Campaign"
                                                        style="background: transparent; border: none; color: #e63757;">
                                                    <i class="fa fa-trash" style="color: #0a6aa1"></i>
                                                </button>
                                            </form>

                                            <button class="btn-show-code"
                                                    style="background: transparent; border: none; color: #e63757;"
                                                    title="Show Code" data-id="{{ $value->id }}">
                                            <i class="fa fa-code me-1" style="color: #0a6aa1"></i>
                                        </button>

                                        </span>
                                    </td>
                                    <td class="text-center">
                                        {{ $value->delay }}{{ $value->delay_unit }}
                                    </td>
                                    <td class="text-center">
                                        {{ $value->number_of_popups }} pops
                                        / {{ $value->every }}{{ $value->every_unit }}
                                    </td>
                                    <td class="text-center">
                                        {{ $value->pop_interval }}{{ $value->interval_unit }}
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center">
                                            @if($value->status == 'active')
                                                <i class="fas fa-check-circle text-success fs-3" title="Active"></i>
                                            @else
                                                <i class="fas fa-times-circle text-danger fs-3" title="Inactive"></i>
                                            @endif
                                        </div>
                                    </td>
                                    @php
                                        $totalImpressions = $value->stats->sum('impressions');
                                        $totalClicks = $value->stats->sum('clicks');
                                        $ctr = $totalImpressions > 0 ? ($totalClicks / $totalImpressions) * 100 : 0;
                                    @endphp

                                    <td class="text-end">{{ $totalImpressions > 0 ? number_format($totalImpressions) : '-' }}</td>
                                    <td class="text-end">{{ $totalClicks > 0 ? number_format($totalClicks) : '-' }}</td>
                                    <td class="text-end">{{ $ctr > 0 ? number_format($ctr) .'%' : '-' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalShowCode" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalShowCodeLabel">
                        Copy and Paste the code below to your website
                    </h5>
                    <button type="button" class="btn close btn-close-modal" aria-label="Close" data-bs-dismiss="modal">
                        <i aria-hidden="true" class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div data-scroll="true" data-height="300">
                        <div class="mb-5">
                            <div class="code-pop-up">
                                <div class="code-title mb-3">
                                    <label for="code">Code Pop-Up</label>
                                </div>
                                <div class="code-content position-relative">
                                    <div class="input-group">
                                        <input id="kt_clipboard_1" type="text" class="form-control"
                                               placeholder="name@example.com"
                                               value="">
                                        <button class="btn btn-light-primary btn-copy"
                                                data-clipboard-target="#kt_clipboard_1">Copy
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <div class="code-pop-under">
                                <div class="code-title mb-3">
                                    <label for="code">Code Pop Under</label>
                                </div>
                                <div class="code-content position-relative">
                                    <div class="input-group">
                                        <input id="kt_clipboard_2" type="text" class="form-control"
                                               placeholder="name@example.com"
                                               value="">
                                        <button class="btn btn-light-primary btn-copy"
                                                data-clipboard-target="#kt_clipboard_2">Copy
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
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

            $('.btn-delete-campaign').on('click', function (e) {
                e.preventDefault();
                //show sweet alert
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

            //btn-show-code
            $('.btn-show-code').on('click', function () {
                let id = $(this).data('id');
                let url = "{{ route('admin.campaigns.show', ':id') }}";
                $.ajax({
                    url: url.replace(':id', id),
                    type: 'GET',
                    data: {id: id},
                    success: function (response) {
                        var zoneId = response.data;
                        var backendUrl = "{{ env('URL_BACKEND', 'https://api-pop.diveinthebluesky.biz') }}";

                        var popUpScript = "<script  src='" + backendUrl + "/pop?zoneId=" + zoneId + "'" + "><" + "/script>";
                        var popUnderScript = "<script  src='" + backendUrl + "/pop-under?zoneId=" + zoneId + "'" + "><" + "/script>";


                        $('#kt_clipboard_1').val(popUpScript);
                        $('#kt_clipboard_2').val(popUnderScript);
                        $('#modalShowCode').modal('show');
                    }
                });
            })
            $(document).on('click', '.btn-copy', function () {
                const targetId = $(this).attr('data-clipboard-target');  //
                const $input = $(targetId);  //

                $input.select();  //
                document.execCommand('copy');  //

                toastr.success('Copied to clipboard!');  //
            });

            $('.btn-close-modal').on('click', function () {
                $('#modalShowCode').modal('hide');
            });


            //sum total impressions in column 6
            var totalImpressions = 0;
            $('#table-campaigns tbody tr').each(function () {
                var value = $(this).find('td:eq(6)').text();
                if (value !== '-') {
                    totalImpressions += parseInt(value.replace(/,/g, ''));
                }
            });
            $('.total-impressions').text(numberWithCommas(totalImpressions));

            function numberWithCommas(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            //sum total clicks in column 7
            var totalClicks = 0;
            $('#table-campaigns tbody tr').each(function () {
                var value = $(this).find('td:eq(7)').text();
                if (value !== '-') {
                    totalClicks += parseInt(value.replace(/,/g, ''));
                }
            });
            $('.total-clicks').text(numberWithCommas(totalClicks));
        });


    </script>
@endpush
