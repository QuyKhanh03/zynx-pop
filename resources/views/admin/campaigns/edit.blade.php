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
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                     data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                     class="page-title d-flex align-items-center me-3 flex-wrap lh-1">
                    <h3 class="text-dark fw-bolder my-1">
                        {{ $title }}
                    </h3>
                </div>
                <div class="d-flex align-items-center justify-content-between w-100 w-md-auto py-1">
                    <div class="me-4">
                        <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-back"
                           id="kt_toolbar_primary_button"
                           title="Back to Campaigns">
                            <i class="fa fa-arrow-left"></i>
                            Back to Campaigns
                        </a>
                    </div>

                    <div class="">
                        <button class="btn btn-sm btn-primary btn-save-campaign d-md-none d-block"
                                title="Save Campaign">
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
                                                       value="{{ $campaign->name ?? old('name') }}"
                                                       placeholder="Enter name">
                                                <span class="text-danger error-text name_error"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-5">
                                                <label for="status" class="form-label required">Status</label>
                                                <select class="form-select" id="status" name="status">
                                                    <option
                                                        {{ $campaign->status == 'active' ? 'selected' : '' }} value="active">
                                                        Active
                                                    </option>
                                                    <option
                                                        {{ $campaign->status == 'inactive' ? 'selected' : '' }} value="inactive">
                                                        Inactive
                                                    </option>
                                                </select>
                                                <span class="text-danger error-text status_error"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-5">
                                                <label for="delay" class="form-label required">Delay</label>
                                                <input type="number" class="form-control" id="delay" name="delay"
                                                       placeholder="Enter delay"
                                                       value="{{ $campaign->delay ?? old('delay') }}">
                                                <span class="text-danger error-text delay_error"></span>
                                            </div>
                                            <div class="col mb-5">
                                                <label for="delay_unit" class="form-label required">Delay
                                                    Unit</label>
                                                <select class="form-select" id="delay_unit" name="delay_unit">
                                                    @foreach($timeUnits as $val)
                                                        <option
                                                            {{ $campaign->delay_unit == $val->abbreviation ? 'selected' : '' }} value="{{ $val->abbreviation }}">{{ $val->name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-5">
                                                <label for="number_of_popups" class="form-label required">No of
                                                    Pop</label>
                                                <input type="number" class="form-control" id="number_of_popups"
                                                       name="number_of_popups"
                                                       value="{{ $campaign->number_of_popups ?? old('number_of_popups') }}"
                                                       placeholder="Enter number of pop">
                                                <span class="text-danger error-text number_of_popups_error"></span>
                                            </div>

                                            <div class="col mb-5">
                                                <label for="every" class="form-label required">Every</label>
                                                <input type="number" class="form-control" id="every"
                                                       name="every"
                                                       value="{{ $campaign->every ?? old('every') }}"
                                                       placeholder="Enter frequency">
                                                <span class="text-danger error-text every_error"></span>
                                            </div>
                                            <div class="col mb-5">
                                                <label for="every_unit" class="form-label ">
                                                    &nbsp;
                                                </label>
                                                <select class="form-select" id="every_unit"
                                                        name="every_unit">
                                                    @foreach($timeUnits as $value)
                                                        <option
                                                            value="{{ $value->abbreviation }}" {{ $campaign->abbreviation == $value->abbreviation ? 'selected' : '' }}>{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-5">
                                                <label for="pop_interval" class="form-label required">Interval</label>
                                                <input min="1" type="number" class="form-control" id="pop_interval"
                                                       name="pop_interval" placeholder="Enter interval"
                                                       value="{{ $campaign->pop_interval ?? old('pop_interval') }}">
                                                <span class="text-danger error-text pop_interval_error"></span>
                                            </div>
                                            <div class="col mb-5">
                                                <label for="interval_unit" class="form-label ">
                                                    &nbsp;</label>
                                                <select class="form-select" id="interval_unit"
                                                        name="interval_unit">
                                                    @foreach($timeUnits as $value)
                                                        <option
                                                            {{ $campaign->abbreviation == $value->abbreviation ? 'selected' : '' }} value="{{ $value->abbreviation }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-5">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" id="description" name="description"
                                                          rows="3">
                                                    {{ $campaign->description ?? old('description') }}
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <b>Funnels</b>
                                        </h3>
                                    </div>
                                    <div class="card-body p-3 p-md-10">
                                        <div class="list-funnels">
                                            @foreach($campaign->funnels as $funnelKey => $funnel)
                                                <div class="item-funnel" data-funnel-id="{{ $funnelKey + 1 }}">
                                                    <div class="card mb-4 funnel-item" data-funnel-id="{{ $funnelKey + 1 }}">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h4 class="card-title mb-0">Funnel #{{ $funnelKey + 1 }}</h4>
                                                            @if($funnelKey !== 0)
                                                                <button class="btn btn-sm btn-delete-funnel" type="button">
                                                                    <i class="fa fa-times text-gray-500"></i>
                                                                </button>
                                                            @endif
                                                        </div>
                                                        <div class="card-body p-3 p-md-10">
                                                            <div class="mb-3">
                                                                <h5 class="card-subtitle mb-3">Offers</h5>
                                                                <div class="list-offers">
                                                                    @foreach($funnel->offers as $offerKey => $offer)
                                                                        <div class="item-offer" data-offer-id="{{ $offerKey + 1 }}">
                                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                                <div class="d-flex align-items-center flex-grow-1">
                                                                                    <div class="me-3">
                                                                                        <label class="form-label">&nbsp;</label>
                                                                                        <div class="fs-3 font-bold offer-number"></div> <!-- Thay thế số thứ tự bằng thẻ này để JavaScript cập nhật -->
                                                                                    </div>

                                                                                    <div class="mx-2 flex-grow-1">
                                                                                        <label for="offer-select-{{ $funnelKey + 1 }}-{{ $offerKey + 1 }}" class="form-label required">Offer</label>
                                                                                        <select class="form-select select2-search w-100 offer-select"
                                                                                                id="offer-select-{{ $funnelKey + 1 }}-{{ $offerKey + 1 }}"
                                                                                                name="funnels[{{ $funnelKey + 1 }}][offers][{{ $offerKey + 1 }}][offer_id]">
                                                                                            <option value="{{ $offer->offer_id }}" selected>{{ $offer->offer->name }}</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="mx-0 mx-md-2">
                                                                                        <label for="ratio-{{ $funnelKey + 1 }}-{{ $offerKey + 1 }}" class="form-label">Ratio</label>
                                                                                        <input type="number" max="100" min="0" value="{{ $offer->ratio }}"
                                                                                               class="form-control min-w-60px ratio-input"
                                                                                               id="ratio-{{ $funnelKey + 1 }}-{{ $offerKey + 1 }}"
                                                                                               name="funnels[{{ $funnelKey + 1 }}][offers][{{ $offerKey + 1 }}][ratio]"
                                                                                               placeholder="Enter ratio">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="">
                                                                                    <label class="form-label">&nbsp;</label>
                                                                                    <button type="button" {{ $offerKey === 0 ? 'disabled' : '' }}
                                                                                    title="Need at least one offer"
                                                                                            class="btn btn-sm {{ $offerKey === 0 ? 'disabled' : '' }} rounded {{ $offerKey !== 0 ? 'btn-delete-offer' : '' }} ">
                                                                                        <i class="fa fa-times"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <span class="text-danger mx-7 error-text offer_id_error"></span>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                <button class="btn btn-sm btn-success mt-2 btn-add-offer" title="Add offer" type="button">
                                                                    <i class="fa fa-plus"></i> Add
                                                                </button>
                                                                <a class="btn btn-sm btn-primary mt-2" title="Create new offer" target="_blank"
                                                                   href="{{ route('admin.offers.create') }}">New Offer</a>
                                                            </div>

                                                            <div>
                                                                <button class="btn btn-sm btn-success btn-add-filters d-flex justify-content-between align-items-center"
                                                                        title="Add new filters" type="button">
                                                                    Filters (<span class="count-filters" data-count="0">0</span>) &nbsp;
                                                                    <i class="fa fa-chevron-down icon-rotate rotate-up" aria-hidden="true"></i>
                                                                </button>
                                                                <div class="filter-container mt-3" style="display:none;">
                                                                    <div class="item-filters">
                                                                        <div class="col-6">
                                                                            <label for="add-filter" class="form-label">Add Filter</label>
                                                                            <select class="form-select select2-search add-filter-select multi-select-filter"
                                                                                    id="add-filter" name="funnels[{{ $funnelKey + 1 }}][filters][]" multiple>
                                                                                <option value="geo">Geo</option>
                                                                                <option value="device">Device</option>
                                                                                <option value="browser">Browser</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="selected-filters mt-3"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div>
                                            <button class="btn btn-sm btn-primary mt-2 btn-add-funnel" title="Add funnel" type="button">
                                                <i class="fa fa-plus me-2"></i> Add Funnel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary btn-save-campaign" title="Save Campaign">
                                <span class="indicator-label">
                                    <i class="fa fa-save"></i> Save
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

@endsection

@push('scripts')
    <script>
        function initializeSelect2($funnel) {
            $funnel.find('.offer-select').select2({
                ajax: {
                    url: '{{ route('admin.offers.list') }}',
                    dataType: 'json',
                    delay: 0,
                    data: function (params) {
                        return {
                            search: params.term || '',
                            limit: 10
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            })
                        };
                    },
                    cache: true
                },
                placeholder: "Select an offer",
                minimumInputLength: 0,
                allowClear: true
            });

            $funnel.find('.add-filter-select').select2({
                placeholder: "Select filters",
                allowClear: true,
                multiple: true
            }).on('change', function () {
                const selectedValues = $(this).val() || [];
                const $funnel = $(this).closest('.item-funnel'); //
                const $selectedFilters = $funnel.find('.selected-filters');

                $.each(selectedValues, function (index, value) {
                    if (!$(`#${value}-select-${$funnel.data('funnel-id')}`, $selectedFilters).length) {
                        appendFilterSelect(value, $selectedFilters, $funnel);
                    }
                });
                updateFilterCount($funnel);  //
            });
        }
        function updateFunnelIndexes() {
            $('.list-funnels .item-funnel').each(function (index) {
                $(this).attr('data-funnel-id', index + 1); //
                $(this).find('.card-title').text(`Funnel #${index + 1}`); //
            });
        }

        function createFunnelHtml(funnelIndex) {
            return `
                <div class="item-funnel mb-4" data-funnel-id="${funnelIndex}">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Funnel #${funnelIndex}</h4>
                            <button class="btn btn-sm  btn-delete-funnel" type="button" >
                                <i class="fa fa-times text-gray-500"></i>
                            </button>
                        </div>
                        <div class="card-body p-3 p-md-10">
                            <!-- Offers Section -->
                            <div class="mb-3">
                                <h5>Offers</h5>
                                <div class="list-offers">
                                    ${createOfferHtml(funnelIndex, 1)}
                                </div>
                                <button class="btn btn-sm btn-success mt-2 btn-add-offer" type="button" title="Add offer">
                                    <i class="fa fa-plus"></i> Add
                                </button>
                            </div>
                            <!-- Filters Section -->
                            <div>
                                <button class="btn btn-sm btn-success btn-add-filters" type="button">
                                    Filters (<span class="count-filters">0</span>)
                                    <i class="fa fa-chevron-down"></i>
                                </button>
                                <div class="filter-container mt-3" style="display:none;">
                                    <div class="col-6">
                                        <label for="add-filter-${funnelIndex}" class="form-label">Add Filter</label>
                                        <select class="form-select select2-search add-filter-select multi-select-filter"
                                                id="add-filter-${funnelIndex}" name="funnels[${funnelIndex}][filters][]" multiple>
                                            <option value="geo">Geo</option>
                                            <option value="device">Device</option>
                                            <option value="browser">Browser</option>
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="selected-filters mt-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        function createOfferHtml(funnelIndex, offerIndex) {
            const disabledAttr = offerIndex === 1 ? 'disabled' : '';
            return `
                <div class="item-offer" data-offer-id="${offerIndex}">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center flex-grow-1">
                            <div class="me-3">
                                <label class="form-label">&nbsp;</label>
                                <div class="fs-3 font-bold offer-number">${offerIndex}</div> <!-- Số thứ tự của offer -->
                            </div>
                            <div class="mx-2 flex-grow-1">
                                <label for="offer-select-${funnelIndex}-${offerIndex}" class="form-label required">Offer</label>
                                <select class="form-select select2-search w-100 offer-select"
                                        id="offer-select-${funnelIndex}-${offerIndex}"
                                        name="funnels[${funnelIndex}][offers][${offerIndex}][offer_id]">
                                </select>
                            </div>
                            <div class="mx-0 mx-md-2">
                                <label for="ratio-${funnelIndex}-${offerIndex}" class="form-label">Ratio</label>
                                <input type="number" max="100" min="0" value="100"
                                       class="form-control min-w-60px ratio-input"
                                       id="ratio-${funnelIndex}-${offerIndex}"
                                       name="funnels[${funnelIndex}][offers][${offerIndex}][ratio]"
                                       placeholder="Enter ratio">
                            </div>
                        </div>

                        <div class="">
                            <label class="form-label">&nbsp;</label>
                            <button type="button" class="btn btn-sm  rounded btn-delete-offer" ${disabledAttr}>
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <span class="text-danger mx-7 error-text offer_id_error"></span>
                </div>
            `;
        }


        function appendFilterSelect(type, $selectedFilters, $funnel) {
            const label = type.charAt(0).toUpperCase() + type.slice(1);
            const id = `${type}-select-${$funnel.data('funnel-id')}`; // Gán ID duy nhất cho filter
            const url = getFilterUrl(type);

            const newSelectHtml = `
                <div class="filter-item mt-2 d-flex align-items-center">
                    <div class="d-flex align-items-center" style="width: 150px;">
                        <label for="${id}" class="form-label me-2">${label}</label>
                    </div>
                    <div class="me-2" style="width: 120px;">
                        <select class="form-select target-type-select">
                            <option value="include" selected>Include</option>
                            <option value="exclude">Exclude</option>
                            <option value="none">None</option>
                        </select>
                    </div>
                    <div class="flex-grow-1 me-2">
                        <select class="form-select select2-search filter-select" id="${id}" name="${id}" data-url="${url}" multiple></select>
                    </div>
                    <button type="button" class="btn btn-sm  btn-remove-filter" title="Remove filter">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            `;

            $selectedFilters.append(newSelectHtml); //
            initializeSelect2Dynamic(`#${id}`, url); //
        }

        function getFilterUrl(type) {
            switch (type) {
                case 'geo':
                    return '{{ route('admin.countries.list') }}';
                case 'device':
                    return '{{ route('admin.devices.list') }}';
                case 'browser':
                    return '{{ route('admin.browsers.list') }}';
                default:
                    return '';
            }
        }

        // Khởi tạo Select2 cho Filter mới
        function initializeSelect2Dynamic(selector, url) {
            $(selector).select2({
                placeholder: 'Select an option',
                allowClear: true,
                width: '100%',
                multiple: true,
                ajax: {
                    url: url,
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {id: item.id, text: item.name};
                            })
                        };
                    },
                    cache: true
                }
            });
        }

        // Cập nhật số lượng filter
        function updateFilterCount($funnel) {
            const filterCount = $funnel.find('.selected-filters .filter-item').length;
            $funnel.find('.count-filters').text(filterCount).data('count', filterCount);
        }

        // Xử lý khi nhấn nút "Remove Filter"
        $(document).on('click', '.btn-remove-filter', function () {
            const filterItem = $(this).closest('.filter-item');
            filterItem.remove(); // Xóa filter
            const $funnel = $(this).closest('.item-funnel');
            updateFilterCount($funnel); // Cập nhật lại số lượng filter
        });

        // Xử lý khi nhấn nút "Delete Offer"
        $(document).on('click', '.btn-delete-offer', function () {
            const $funnel = $(this).closest('.item-funnel');
            $(this).closest('.item-offer').remove(); // Xóa offer
            updateOfferIndexes($funnel); // Cập nhật lại chỉ số sau khi xóa offer
        });


        // Xử lý khi nhấn nút "Delete Funnel"
        $(document).on('click', '.btn-delete-funnel', function () {
            $(this).closest('.item-funnel').remove();
            updateFunnelIndexes();  // Cập nhật lại chỉ mục sau khi xóa
        });

        // Thêm Funnel mới
        $(document).on('click', '.btn-add-funnel', function () {
            const funnelCount = $('.list-funnels .item-funnel').length + 1;
            const html = createFunnelHtml(funnelCount);
            const $newFunnel = $(html);
            $('.list-funnels').append($newFunnel);
            initializeSelect2($newFunnel); // Khởi tạo Select2 cho funnel mới
            updateFunnelIndexes();  // Cập nhật chỉ mục cho tất cả các funnels
        });


        // Thêm Offer mới
        $(document).on('click', '.btn-add-offer', function () {
            const $funnel = $(this).closest('.item-funnel');
            const funnelIndex = $funnel.data('funnel-id');
            const offerCount = $funnel.find('.list-offers .item-offer').length + 1;
            const offerHtml = createOfferHtml(funnelIndex, offerCount);
            $funnel.find('.list-offers').append(offerHtml);
            initializeSelect2($funnel); // Khởi tạo Select2 cho offer mới
            updateOfferIndexes($funnel);
        });

        $(document).on('click', '.btn-add-filters', function () {
            const $currentFunnel = $(this).closest('.item-funnel');
            $currentFunnel.find('.icon-rotate').toggleClass('rotate-down rotate-up');
            const $filterContainer = $currentFunnel.find('.filter-container');
            $filterContainer.toggle();
        });



        // Handle for click Cancel button
        $(document).on('click', '.btn-back', function () {
            //call sweet alert
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
        // Handle for click Close button in modal
        $(document).on('click', '.btn-close-modal', function () {
            $('#modalShowCode').modal('hide');
            //remove loading
            //show indicator-label
            $('.indicator-label').show();
            //hide indicator-progress
            $('.indicator-progress').hide();
            //enable button
            $('.btn-save-campaign').prop('disabled', false);

        });

        //check if the user is leaving the page
        // window.onbeforeunload = function () {
        //     return "Are you sure you want to leave?";
        // };

        // Handle for click Copy button
        $(document).on('click', '.btn-copy', function () {
            const targetId = $(this).attr('data-clipboard-target');  //
            const $input = $(targetId);  //

            $input.select();  //
            document.execCommand('copy');  //

            toastr.success('Copied to clipboard!');  //
        });

        $(document).on('click', '.btn-save-campaign', function (e) {
            e.preventDefault();
            $('.error-text').text('');
            let id = '{{ $campaign->id ?? '' }}';
            let url = '{{ route('admin.campaigns.update', ':id') }}';
            $.ajax({
                url: id ? url.replace(':id', id) : '{{ route('admin.campaigns.store') }}',
                type: 'PUT',
                data: $('#form-campaign').serialize(),
                success: function (response) {
                    if (response.success) {
                        window.location.href = '{{ route('admin.campaigns.index') }}';
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    // Enable button and hide progress indicator
                    $('.btn-save-campaign').prop('disabled', false);
                    $('.indicator-label').show();
                    $('.indicator-progress').hide();

                    // Display error message
                    toastr.error('Please check the form again!');

                    const errors = xhr.responseJSON.errors;
                    if (errors) {
                        $.each(errors, function (key, value) {
                            if (key.includes('funnels')) {
                                const keys = key.split('.'); //
                                const funnelIndex = keys[1]; // funnel index (e.g., '0')
                                const offerIndex = keys[3]; // offer index (e.g., '1')
                                const fieldName = keys[4]; // actual field name (e.g., 'offer_id')

                                // Display error message for offer_id
                                $(`[name="funnels[${funnelIndex}][offers][${offerIndex}][${fieldName}]"]`)
                                    .closest('.item-offer')
                                    .find(`.${fieldName}_error`)
                                    .text(value); // Show error under the appropriate input
                            } else {
                                // For non-nested errors
                                $(`.${key}_error`).text(value);
                            }
                        });
                    }
                }
            });
        });
        function updateOfferIndexes($funnel) {
            $funnel.find('.list-offers .item-offer').each(function (index) {
                $(this).find('.offer-number').text(index + 1); // Cập nhật số thứ tự offer
            });
        }


        // Remove error message when a valid selection is made
        $(document).on('change', '.offer-select', function () {
            const $offerSelect = $(this);
            if ($offerSelect.val()) {
                $offerSelect.closest('.item-offer').find('.offer_id_error').text('');
            }
        });
        $(document).ready(function () {
            const $funnels =  $('.list-funnels .item-funnel');
            $funnels.each(function () {
                initializeSelect2($(this));
                updateOfferIndexes($(this));
            });
        });
    </script>

@endpush