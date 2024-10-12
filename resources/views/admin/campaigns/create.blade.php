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
                <div class="d-flex align-items-center py-1">
                    <div class="me-4">
                    </div>
                    <a href="{{ route('admin.campaigns.index') }}" class="btn btn-sm btn-primary btn-back"
                       id="kt_toolbar_primary_button"
                       title="Back to Campaigns">
                        <i class="fa fa-arrow-left"></i>
                        Back to Campaigns
                    </a>
                </div>
            </div>
        </div>
        <div id="kt_content_container" class="container-xxl">
            <form id="form-campaign">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title "><b>General</b></h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mb-5">
                                                <label for="name" class="form-label required">Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                       placeholder="Enter name">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-5">
                                                <label for="status" class="form-label required">Status</label>
                                                <select class="form-select" id="status" name="status">
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-5">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" id="description" name="description"
                                                          rows="3"
                                                          placeholder="Notes about the campaign..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <b>
                                                Funnels
                                            </b>
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="list-funnels">
                                            <div class="item-funnel">
                                                <div class="card mb-4 funnel-item" data-funnel-id="1">
                                                    <div class="card-header d-flex justify-content-between align-items-center">
                                                        <h4 class="card-title mb-0">Funnel #1</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <div class="row mb-3">
                                                                    <div class="col-12">
                                                                        <h5 class="card-subtitle mb-3">Offers</h5>
                                                                        <div class="list-offers">
                                                                            <div class="item-offer" data-offer-id="1">
                                                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                                                    <div class="d-flex align-items-center flex-grow-1">
                                                                                        <div class="me-5">
                                                                                            <label class="form-label">&nbsp;</label>
                                                                                            <div class="fs-3 font-bold">
                                                                                                Offer 1
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="mx-2 flex-grow-1">
                                                                                            <label for="offer-select-1-1" class="form-label">Offer</label>
                                                                                            <select class="form-select select2-search w-100 offer-select"
                                                                                                    id="offer-select-1-1"
                                                                                                    name="offer-1-1">
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="mx-2" style="width: 150px;">
                                                                                            <label for="ratio-1-1" class="form-label">Ratio</label>
                                                                                            <input type="number" max="100" min="0" value="100"
                                                                                                   class="form-control"
                                                                                                   id="ratio-1-1"
                                                                                                   name="ratio-1-1"
                                                                                                   placeholder="Enter ratio">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="mt-8">
                                                                                        <label class="form-label">&nbsp;</label>
                                                                                        <button type="button" disabled title="Need at least one offer"
                                                                                                class="btn btn-sm disabled btn-outline-secondary rounded">
                                                                                            <i class="fa fa-times"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <button class="btn btn-sm btn-success mt-2 btn-add-offer" title="Add offer" type="button">
                                                                            <i class="fa fa-plus"></i> Add
                                                                        </button>

                                                                        <a class="btn btn-sm btn-primary mt-2" title="Create new offer" target="_blank"
                                                                           href="{{ route('admin.offers.create') }}">New Offer</a>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                                                                id="add-filter" name="add-filter[]"
                                                                                multiple="multiple">
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
                                        </div>
                                        <div>
                                            <button class="btn btn-sm btn-primary mt-2 btn-add-funnel"
                                                    title="Add funnel" type="button">
                                                <i class="fa fa-plus me-2"></i> Add Funnel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-start">
                            <button type="submit" class="btn btn-primary" title="Save Campaign">
                                <i class="fa fa-save"></i> Save
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Khởi tạo Select2 cho tất cả các Filter và Offer trong Funnel
        function initializeSelect2($funnel) {
            // Khởi tạo Select2 cho các offer trong funnel
            $funnel.find('.offer-select').select2({
                ajax: {
                    url: '{{ route('admin.offers.list') }}',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return { id: item.id, text: item.name };
                            })
                        };
                    }
                },
                placeholder: "Select an offer",
            });

            // Khởi tạo Select2 cho các filter trong funnel
            $funnel.find('.add-filter-select').select2({
                placeholder: "Select filters",
                allowClear: true,
                multiple: true
            }).on('change', function () {
                const selectedValues = $(this).val() || [];
                const $funnel = $(this).closest('.item-funnel'); // Lấy funnel hiện tại
                const $selectedFilters = $funnel.find('.selected-filters');

                // Thêm filter mới nếu chưa tồn tại trong funnel hiện tại
                $.each(selectedValues, function (index, value) {
                    if (!$(`#${value}-select-${$funnel.data('funnel-id')}`, $selectedFilters).length) {
                        appendFilterSelect(value, $selectedFilters, $funnel);
                    }
                });

                updateFilterCount($funnel);  // Cập nhật số lượng filter trong funnel hiện tại
            });
        }

        // Hàm để cập nhật chỉ mục cho các Funnels sau mỗi thay đổi
        function updateFunnelIndexes() {
            $('.list-funnels .item-funnel').each(function (index) {
                $(this).attr('data-funnel-id', index + 1); // Cập nhật data-funnel-id
                $(this).find('.card-title').text(`Funnel #${index + 1}`); // Cập nhật tiêu đề Funnel
            });
        }

        // Tạo HTML cho một Funnel mới
        function createFunnelHtml(funnelIndex) {
            return `
            <div class="item-funnel mb-4" data-funnel-id="${funnelIndex}">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Funnel #${funnelIndex}</h4>
                        <button class="btn btn-sm btn-light btn-delete-funnel" type="button" >
                            <i class="fa fa-times text-gray-500"></i>
                        </button>
                    </div>
                    <div class="card-body">
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
                                            id="add-filter-${funnelIndex}" name="add-filter-${funnelIndex}[]" multiple>
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

        // Tạo HTML cho một Offer mới
        function createOfferHtml(funnelIndex, offerIndex) {
            return `
        <div class="item-offer" data-offer-id="${offerIndex}">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="d-flex align-items-center flex-grow-1">
                    <div class="me-5">
                        <label class="form-label">&nbsp;</label>
                        <div class="fs-3 font-bold offer-number">Offer ${offerIndex}</div>
                    </div>
                    <div class="mx-2 flex-grow-1">
                        <label for="offer-select-${funnelIndex}-${offerIndex}" class="form-label">Offer</label>
                        <select class="form-select select2-search w-100 offer-select"
                                id="offer-select-${funnelIndex}-${offerIndex}"
                                name="offer-${funnelIndex}-${offerIndex}">
                            <!-- Options cho offer sẽ được thêm vào đây -->
                        </select>
                    </div>
                    <div class="mx-2" style="width: 150px;">
                        <label for="ratio-${funnelIndex}-${offerIndex}" class="form-label">Ratio</label>
                        <input type="number" max="100" min="0" value="100"
                               class="form-control ratio-input"
                               id="ratio-${funnelIndex}-${offerIndex}"
                               name="ratio-${funnelIndex}-${offerIndex}"
                               placeholder="Enter ratio">
                    </div>
                </div>
                <div class="mt-8">
                    <label class="form-label">&nbsp;</label>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded btn-delete-offer">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    `;
        }

        // Thêm filter mới vào khu vực selected-filters trong Funnel
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
            <button type="button" class="btn btn-sm btn-outline-secondary btn-remove-filter" title="Remove filter">
                <i class="fa fa-times"></i>
            </button>
        </div>
    `;

            $selectedFilters.append(newSelectHtml); // Thêm filter vào danh sách filter của funnel
            initializeSelect2Dynamic(`#${id}`, url); // Khởi tạo Select2 cho filter mới
        }

        // Lấy URL cho các loại filter
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
                                return { id: item.id, text: item.name };
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
            $(this).closest('.item-offer').remove();
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
        });

        // Khởi tạo cho Funnel 1 khi trang tải lần đầu
        $(document).ready(function() {
            initializeSelect2($('.item-funnel').first());
        });

        // Toggle hiển thị bộ lọc khi nhấn nút Filter
        $(document).on('click', '.btn-add-filters', function () {
            const $filterContainer = $(this).closest('.item-funnel').find('.filter-container');
            $filterContainer.toggle();
        });
    </script>










@endpush
