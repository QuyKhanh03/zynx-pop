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
{{--                                        <div class="list-funnels">--}}
{{--                                            <div class="item-funnel">--}}
{{--                                                <div class="card mb-4">--}}
{{--                                                    <div--}}
{{--                                                        class="card-header d-flex justify-content-between align-items-center">--}}
{{--                                                        <h4 class="card-title mb-0">Funnel #1</h4>--}}
{{--                                                        <div class="d-flex align-items-center">--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="card-body">--}}
{{--                                                        <div class="card mb-3">--}}
{{--                                                            <div class="card-body">--}}
{{--                                                                <div class="row mb-3">--}}
{{--                                                                    <div class="col-12">--}}
{{--                                                                        <h5 class="card-subtitle mb-3">Offers</h5>--}}
{{--                                                                        <div class="list-offers">--}}
{{--                                                                            <div class="item-offer">--}}
{{--                                                                                <div--}}
{{--                                                                                    class="d-flex justify-content-between align-items-center mb-2">--}}
{{--                                                                                    <div--}}
{{--                                                                                        class="d-flex align-items-center flex-grow-1">--}}
{{--                                                                                        <div class="me-5">--}}
{{--                                                                                            <label--}}
{{--                                                                                                class="form-label">&nbsp;</label>--}}
{{--                                                                                            <div class="fs-3 font-bold">--}}
{{--                                                                                                1--}}
{{--                                                                                            </div>--}}
{{--                                                                                        </div>--}}
{{--                                                                                        <div class="mx-2 flex-grow-1">--}}
{{--                                                                                            <label for="offer-select"--}}
{{--                                                                                                   class="form-label">Offer</label>--}}
{{--                                                                                            <select--}}
{{--                                                                                                class="form-select select2-search w-100 offer-select"--}}
{{--                                                                                                id="offer-select"--}}
{{--                                                                                                name="offer-1">--}}
{{--                                                                                            </select>--}}
{{--                                                                                        </div>--}}
{{--                                                                                        <div class="mx-2"--}}
{{--                                                                                             style="width: 150px;">--}}
{{--                                                                                            <label for="ratio"--}}
{{--                                                                                                   class="form-label">Ratio</label>--}}
{{--                                                                                            <input type="number"--}}
{{--                                                                                                   max="100"--}}
{{--                                                                                                   min="0" value="100"--}}
{{--                                                                                                   class="form-control"--}}
{{--                                                                                                   id="ratio"--}}
{{--                                                                                                   name="ratio-1"--}}
{{--                                                                                                   placeholder="Enter ratio">--}}
{{--                                                                                        </div>--}}
{{--                                                                                    </div>--}}
{{--                                                                                    <div class="mt-8">--}}
{{--                                                                                        <label--}}
{{--                                                                                            class="form-label">&nbsp;</label>--}}
{{--                                                                                        <button type="button" disabled title="Need at least one offer"--}}
{{--                                                                                                class="btn btn-sm disabled btn-outline-secondary rounded">--}}
{{--                                                                                            <i class="fa fa-times"></i>--}}
{{--                                                                                        </button>--}}
{{--                                                                                    </div>--}}
{{--                                                                                </div>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}

{{--                                                                        <button--}}
{{--                                                                            class="btn btn-sm btn-success mt-2 btn-add-offer"--}}
{{--                                                                            title="Add offer" type="button">--}}
{{--                                                                            <i class="fa fa-plus"></i> Add--}}
{{--                                                                        </button>--}}

{{--                                                                        <a class="btn btn-sm btn-primary mt-2"--}}
{{--                                                                           title="Create new offer"--}}
{{--                                                                           target="_blank"--}}
{{--                                                                           href="{{ route('admin.offers.create') }}">New--}}
{{--                                                                            Offer</a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}

{{--                                                        <div>--}}
{{--                                                            <button--}}
{{--                                                                class="btn btn-sm btn-success btn-add-filters d-flex justify-content-between align-items-center"--}}
{{--                                                                title="Add new filters" type="button">--}}
{{--                                                                Filters (--}}
{{--                                                                <span class="count-filters" data-count="0">0</span>--}}
{{--                                                                ) &nbsp;--}}
{{--                                                                <i class="fa fa-chevron-down icon-rotate rotate-up"--}}
{{--                                                                   aria-hidden="true"></i>--}}
{{--                                                            </button>--}}

{{--                                                            <div class="filter-container d-none mt-3">--}}
{{--                                                                <div class="item-filters">--}}
{{--                                                                    <div class="col-6">--}}
{{--                                                                        <label for="add-filter" class="form-label">Add--}}
{{--                                                                            Filter</label>--}}
{{--                                                                        <select--}}
{{--                                                                            class="form-select select2-search add-filter-select multi-select-filter"--}}
{{--                                                                            id="add-filter" name="add-filter[]"--}}
{{--                                                                            multiple="multiple">--}}
{{--                                                                            <option value="geo">Geo</option>--}}
{{--                                                                            <option value="device">Device</option>--}}
{{--                                                                            <option value="browser">Browser</option>--}}
{{--                                                                        </select>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <hr>--}}
{{--                                                                <div class="selected-filters mt-3">--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        @include('components.funnel', ['funnelId' => 1])
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
        $(document).ready(function () {
            function initializeSelect2ForElement(element) {
                $(element).select2({
                    placeholder: "Select an offer",
                    allowClear: false,
                    width: '100%',
                    ajax: {
                        url: "{{ route('admin.offers.list') }}",
                        type: "GET",
                        dataType: "json",
                        delay: 250,
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
                    }
                });
            }
            initializeSelect2ForElement('.offer-select');
            $(document).on('click', '.btn-add-offer', function () {
                let count = $('.item-offer').length;
                let html = `
                    <div class="item-offer">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-center flex-grow-1">
                                <div class="me-5">
                                    <label class="form-label mb-0">&nbsp;</label>
                                    <div class="fs-3 font-bold">${count + 1}</div>
                                </div>
                                <div class="mx-2 flex-grow-1">
                                    <label for="offer-select" class="form-label">Offer</label>
                                    <select class="form-select select2-search w-100 offer-select" id="offer-select-${count + 1}" name="offer-${count + 1}">
                                    </select>
                                </div>
                                <div class="mx-2" style="width: 150px;">
                                    <label for="ratio" class="form-label">Ratio</label>
                                    <input type="number" max="100" min="0" value="100" class="form-control" id="ratio" name="ratio-${count + 1}" placeholder="Enter ratio">
                                </div>
                            </div>
                            <div class="mt-8">
                                <label class="form-label">&nbsp;</label>
                                <button class="btn btn-sm btn-outline-secondary rounded btn-remove-offer" title="Remove offer" type="button">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                $('.list-offers').append(html);
                initializeSelect2ForElement(`#offer-select-${count + 1}`);
            });
            $(document).on('click', '.btn-remove-offer', function () {
                $(this).closest('.item-offer').remove();
            });
            $('.multi-select-filter').select2({
                placeholder: "Select filters",
                allowClear: true,
                width: '100%',
                closeOnSelect: false //
            });
            $(document).on('click', '.btn-add-filters', function () {
                let $filterContainer = $(this).next('.filter-container');
                let $icon = $(this).find('i');
                $filterContainer.toggleClass('d-none');
                $icon.toggleClass('rotate-up rotate-down');
            });

            $('.multi-select-filter').on('change', function () {
                const selectedValues = $(this).val() || [];
                const existingFilters = {};
                $('.selected-filters .filter-item select').each(function () {
                    const id = $(this).attr('id');
                    existingFilters[id] = $(this).val();
                });
                $.each(selectedValues, function (index, value) {
                    if (!$(`#${value}-select`).length) {
                        appendFilterSelect(value);
                    }
                });
                $('.selected-filters .filter-item select.filter-select').each(function () {
                    const id = $(this).attr('id');
                    initializeSelect2Dynamic(this);
                    if (existingFilters[id]) {
                        $(this).val(existingFilters[id]).trigger('change');
                    }
                });
                updateFilterCount();
            });
            function appendFilterSelect(type) {
                const label = type.charAt(0).toUpperCase() + type.slice(1);
                const id = `${type}-select`;
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
                            <select class="form-select select2-search filter-select" id="${id}" name="${id}" data-url="${url}" multiple>
                            </select>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary btn-remove-filter" title="Remove filter">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                `;
                $('.selected-filters').append(newSelectHtml);
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
            function initializeSelect2Dynamic(selectElement) {
                $(selectElement).select2({
                    placeholder: 'Select an option',
                    allowClear: true,
                    width: '100%',
                    multiple: true,
                    ajax: {
                        url: $(selectElement).data('url'),
                        dataType: 'json',
                        delay: 250,
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
                    }
                });
            }
            function updateFilterCount() {
                const filterCount = $('.selected-filters .filter-item').length;
                $('.count-filters').text(filterCount).data('count', filterCount);
            }
            $(document).on('click', '.btn-remove-filter', function () {
                const filterItem = $(this).closest('.filter-item');
                const filterLabel = filterItem.find('label').text().trim().toLowerCase();

                let selectedValues = $('.multi-select-filter').val();
                selectedValues = selectedValues.filter(value => value.toLowerCase() !== filterLabel);
                $('.multi-select-filter').val(selectedValues).trigger('change');

                filterItem.remove();
                updateFilterCount();
            });
        });

    </script>
@endpush
