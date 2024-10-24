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

        @media (max-width: 768px) {
            .select-0ffers_mob {
                width: 155px;
            }
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
                    <div class="table-responsive">
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
                                                <div class="col mb-5">
                                                    <label for="website_id" class="form-label ">Website</label>
                                                    <select class="form-select select2-search" id="website_id" name="website_id">
                                                            @if(isset($campaign->website_id) && $campaign->website_id)
                                                                <option value="{{ $campaign->website_id }}" selected>
                                                                    {{ $campaign->website->url }}
                                                                </option>
                                                            @endif
                                                    </select>
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
                                                                value="{{ $value->abbreviation }}" {{ $campaign->every_unit == $value->abbreviation ? 'selected' : '' }}>{{ $value->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mb-5">
                                                    <label for="pop_interval"
                                                           class="form-label required">Interval</label>
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
                                                                {{ $campaign->interval_unit == $value->abbreviation ? 'selected' : '' }} value="{{ $value->abbreviation }}">{{ $value->name }}</option>
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
                                                <!-- Xử lý từng Funnel -->
                                                @foreach($campaign->funnels as $funnelKey => $funnel)
                                                    <div class="item-funnel" data-funnel-id="{{ $funnelKey + 1 }}">
                                                        <div class="card mb-4 funnel-item"
                                                             data-funnel-id="{{ $funnelKey + 1 }}">
                                                            <div
                                                                class="card-header d-flex justify-content-between align-items-center">
                                                                <h4 class="card-title mb-0">Funnel
                                                                    #{{ $funnelKey + 1 }}</h4>
                                                                @if($funnelKey !== 0)
                                                                    <button class="btn btn-sm btn-delete-funnel"
                                                                            type="button">
                                                                        <i class="fa fa-times text-gray-500"></i>
                                                                    </button>
                                                                @endif
                                                            </div>

                                                            <div class="card-body p-3 p-md-10">
                                                                <!-- Offers Section -->
                                                                <div class="mb-3">
                                                                    <h5 class="card-subtitle mb-3">Offers</h5>
                                                                    <div class="list-offers">
                                                                        @foreach($funnel->offers as $offerKey => $offer)
                                                                            <div class="item-offer"
                                                                                 data-offer-id="{{ $offerKey + 1 }}">
                                                                                <!-- Offer Selection -->
                                                                                <div
                                                                                    class="d-flex justify-content-between align-items-center mb-2">
                                                                                    <div
                                                                                        class="d-flex align-items-center flex-grow-1">
                                                                                        <div class="me-3">
                                                                                            <label class="form-label">&nbsp;</label>
                                                                                            <div
                                                                                                class="fs-3 font-bold offer-number">{{ $offerKey + 1 }}</div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="mx-2 flex-grow-1 select-0ffers_mob">
                                                                                            <label
                                                                                                for="offer-select-{{ $funnelKey + 1 }}-{{ $offerKey + 1 }}"
                                                                                                class="form-label required">Offer</label>
                                                                                            <select
                                                                                                class="form-select select2-search w-100 offer-select"
                                                                                                id="offer-select-{{ $funnelKey + 1 }}-{{ $offerKey + 1 }}"
                                                                                                name="funnels[{{ $funnelKey }}][offers][{{ $offerKey }}][offer_id]">
                                                                                                <option
                                                                                                    value="{{ $offer->offer_id }}"
                                                                                                    selected>
                                                                                                    {{ $offer->offer->name }}
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="mx-0 mx-md-2">
                                                                                            <label
                                                                                                for="ratio-{{ $funnelKey + 1 }}-{{ $offerKey + 1 }}"
                                                                                                class="form-label">Ratio</label>
                                                                                            <input type="number"
                                                                                                   max="100" min="0"
                                                                                                   value="{{ $offer->ratio }}"
                                                                                                   class="form-control min-w-60px ratio-input"
                                                                                                   id="ratio-{{ $funnelKey + 1 }}-{{ $offerKey + 1 }}"
                                                                                                   name="funnels[{{ $funnelKey }}][offers][{{ $offerKey }}][ratio]"
                                                                                                   placeholder="Enter ratio">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="">
                                                                                        <label
                                                                                            class="form-label">&nbsp;</label>
                                                                                        <button type="button"
                                                                                                class="btn btn-sm {{ $offerKey === 0 ? 'disabled' : '' }} rounded {{ $offerKey !== 0 ? 'btn-delete-offer' : '' }}"
                                                                                                {{ $offerKey === 0 ? 'disabled' : '' }} title="Need at least one offer">
                                                                                            <i class="fa fa-times"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                                <span
                                                                                    class="text-danger mx-7 error-text offer_id_error"></span>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                    <button
                                                                        class="btn btn-sm btn-success mt-2 btn-add-offer"
                                                                        title="Add offer" type="button">
                                                                        <i class="fa fa-plus"></i> Add
                                                                    </button>
                                                                    <a class="btn btn-sm btn-primary mt-2"
                                                                       title="Create new offer" target="_blank"
                                                                       href="{{ route('admin.offers.create') }}">New
                                                                        Offer</a>
                                                                </div>

                                                                <!-- Filters Section -->
                                                                @php
                                                                    $countDevices = (count($funnel->devices) > 0 ? 1 : 0);
                                                                    $countCountries = (count($funnel->countries) > 0 ? 1 : 0);
                                                                    $countBrowsers = (count($funnel->browsers) > 0 ? 1 : 0);
                                                                    $totalFilterCount = $countDevices + $countCountries + $countBrowsers;
                                                                @endphp
                                                                <div>
                                                                    <button
                                                                        class="btn btn-sm btn-success btn-add-filters d-flex justify-content-between align-items-center"
                                                                        title="Add new filters" type="button">
                                                                        Filters (<span
                                                                            class="count-filters">{{ $totalFilterCount }}</span>)
                                                                        &nbsp;
                                                                        <i class="fa fa-chevron-down icon-rotate rotate-down"></i>
                                                                    </button>

                                                                    <div class="filter-container mt-3"
                                                                         style="display: none">
                                                                        <div class="item-filters">
                                                                            <div class="col-12 col-md-6">
                                                                                <label
                                                                                    for="add-filter-{{ $funnelKey+1 }}"
                                                                                    class="form-label">Add
                                                                                    Filter</label>
                                                                                <select
                                                                                    class="form-select select2-search add-filter-select multi-select-filter"
                                                                                    id="add-filter-{{ $funnelKey+1 }}"
                                                                                    name="funnels[{{ $funnelKey+1 }}][filters][]"
                                                                                    multiple>
                                                                                    <option
                                                                                        value="geo" {{ count($funnel->countries) ? 'selected' : '' }}>
                                                                                        Geo
                                                                                    </option>
                                                                                    <option
                                                                                        value="device" {{ count($funnel->devices) ? 'selected' : '' }}>
                                                                                        Device
                                                                                    </option>
                                                                                    <option
                                                                                        value="browser" {{ count($funnel->browsers ?? []) ? 'selected' : '' }}>
                                                                                        Browser
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="selected-filters mt-3">
                                                                            @if(count($funnel->countries) > 0)
                                                                                @php
                                                                                    $selectedCountries = $funnel->countries->pluck('country_id')->toArray();
                                                                                    $countryTargetingType = $funnel->countries->pluck('targeting_type')->first() ?? 'include'; // Assuming one targeting type per filter
                                                                                @endphp
                                                                                <div
                                                                                    class="filter-item mt-2 d-flex align-items-center">
                                                                                    <div
                                                                                        class="d-flex align-items-center"
                                                                                        style="width: 150px;">
                                                                                        <label
                                                                                            for="geo-select-{{ $funnelKey+1 }}"
                                                                                            class="form-label me-2">Geo</label>
                                                                                    </div>
                                                                                    <div class="me-2"
                                                                                         style="width: 120px;">
                                                                                        <select
                                                                                            class="form-select target-type-select"
                                                                                            name="funnels[{{ $funnelKey+1 }}][filters][geo][targeting_type]">
                                                                                            <option
                                                                                                value="include" {{ $countryTargetingType == 'include' ? 'selected' : '' }}>
                                                                                                Include
                                                                                            </option>
                                                                                            <option
                                                                                                value="exclude" {{ $countryTargetingType == 'exclude' ? 'selected' : '' }}>
                                                                                                Exclude
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="flex-grow-1 me-2">
                                                                                        <select
                                                                                            class="form-select select2-search select2-search-filter-select filter-select"
                                                                                            id="geo-select-{{ $funnelKey+1 }}"
                                                                                            name="funnels[{{ $funnelKey+1 }}][filters][geo][values][]"
                                                                                            multiple>
                                                                                            @foreach($countries as $country)
                                                                                                <option
                                                                                                    value="{{ $country->id }}" {{ in_array($country->id, $selectedCountries) ? 'selected' : '' }}>
                                                                                                    {{ $country->name }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    <button type="button"
                                                                                            class="btn btn-sm btn-remove-filter"
                                                                                            title="Remove filter">
                                                                                        <i class="fa fa-times"></i>
                                                                                    </button>
                                                                                </div>
                                                                            @endif

                                                                            <!-- Device Filter (Devices Multi-Select) -->
                                                                            @if(count($funnel->devices)>0)
                                                                                @php
                                                                                    $selectedDevices = $funnel->devices->pluck('device_id')->toArray();
                                                                                    $deviceTargetingType = $funnel->devices->pluck('targeting_type')->first() ?? 'include';
                                                                                @endphp
                                                                                <div
                                                                                    class="filter-item mt-2 d-flex align-items-center">
                                                                                    <div
                                                                                        class="d-flex align-items-center"
                                                                                        style="width: 150px;">
                                                                                        <label
                                                                                            for="device-select-{{ $funnelKey+1 }}"
                                                                                            class="form-label me-2">Device</label>
                                                                                    </div>
                                                                                    <div class="me-2"
                                                                                         style="width: 120px;">
                                                                                        <select
                                                                                            class="form-select target-type-select"
                                                                                            name="funnels[{{ $funnelKey+1 }}][filters][device][targeting_type]">
                                                                                            <option
                                                                                                value="include" {{ $deviceTargetingType == 'include' ? 'selected' : '' }}>
                                                                                                Include
                                                                                            </option>
                                                                                            <option
                                                                                                value="exclude" {{ $deviceTargetingType == 'exclude' ? 'selected' : '' }}>
                                                                                                Exclude
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="flex-grow-1 me-2">
                                                                                        <select
                                                                                            class="form-select select2-search select2-search-filter-select filter-select"
                                                                                            id="device-select-{{ $funnelKey+1 }}"
                                                                                            name="funnels[{{ $funnelKey+1 }}][filters][device][values][]"
                                                                                            multiple>
                                                                                            @foreach($devices as $device)
                                                                                                <option
                                                                                                    value="{{ $device->id }}" {{ in_array($device->id, $selectedDevices) ? 'selected' : '' }}>
                                                                                                    {{ $device->name }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    <button type="button"
                                                                                            class="btn btn-sm btn-remove-filter"
                                                                                            title="Remove filter">
                                                                                        <i class="fa fa-times"></i>
                                                                                    </button>
                                                                                </div>
                                                                            @endif

                                                                            @if(count($funnel->browsers) > 0)
                                                                                    <!-- Browser Filter (Browsers Multi-Select) -->
                                                                                    @php
                                                                                        $selectedBrowsers = $funnel->browsers->pluck('browser_id')->toArray();
                                                                                        $browserTargetingType = $funnel->browsers->pluck('targeting_type')->first() ?? 'include';
                                                                                    @endphp
                                                                                    <div
                                                                                        class="filter-item mt-2 d-flex align-items-center">
                                                                                        <div class="d-flex align-items-center"
                                                                                             style="width: 150px;">
                                                                                            <label
                                                                                                for="browser-select-{{ $funnelKey+1 }}"
                                                                                                class="form-label me-2">Browser</label>
                                                                                        </div>
                                                                                        <div class="me-2" style="width: 120px;">
                                                                                            <select
                                                                                                class="form-select target-type-select"
                                                                                                name="funnels[{{ $funnelKey+1 }}][filters][browser][targeting_type]">
                                                                                                <option
                                                                                                    value="include" {{ $browserTargetingType == 'include' ? 'selected' : '' }}>
                                                                                                    Include
                                                                                                </option>
                                                                                                <option
                                                                                                    value="exclude" {{ $browserTargetingType == 'exclude' ? 'selected' : '' }}>
                                                                                                    Exclude
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="flex-grow-1 me-2">
                                                                                            <select
                                                                                                class="form-select select2-search select2-search-filter-select filter-select"
                                                                                                id="browser-select-{{ $funnelKey+1 }}"
                                                                                                name="funnels[{{ $funnelKey+1 }}][filters][browser][values][]"
                                                                                                multiple>
                                                                                                @foreach($browsers as $browser)
                                                                                                    <option
                                                                                                        value="{{ $browser->id }}" {{ in_array($browser->id, $selectedBrowsers) ? 'selected' : '' }}>
                                                                                                        {{ $browser->name }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                        <button type="button"
                                                                                                class="btn btn-sm btn-remove-filter"
                                                                                                title="Remove filter">
                                                                                            <i class="fa fa-times"></i>
                                                                                        </button>
                                                                                    </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

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
                const $funnel = $(this).closest('.item-funnel');
                const $selectedFilters = $funnel.find('.selected-filters');

                $.each(selectedValues, function (index, value) {
                    if (!$(`#${value}-select-${$funnel.data('funnel-id')}`, $selectedFilters).length) {
                        appendFilterSelect(value, $selectedFilters, $funnel);
                    }
                });

                updateFilterCount($funnel);
            }).on('select2:unselect', function (e) {
                const removedValue = e.params.data.id;
                const $funnel = $(this).closest('.item-funnel');
                const $selectedFilters = $funnel.find('.selected-filters');

                $selectedFilters.find(`#${removedValue}-select-${$funnel.data('funnel-id')}`).closest('.filter-item').remove();

                updateFilterCount($funnel);
            });
        }

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
                                    <div class="col-12 col-md-6">
                                        <label for="add-filter-${funnelIndex}" class="form-label">Add Filter</label>
                                        <select class="form-select select2-search add-filter-select multi-select-filter"
                                                id="add-filter-${funnelIndex}" name="funnels[${funnelIndex}][filters][]" multiple>
                                            <option value="geo" >Geo</option>
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
            const disabledAttr = offerIndex === 1 ? 'disabled' : '';
            return `
                <div class="item-offer" data-offer-id="${offerIndex}">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center flex-grow-1">
                            <div class="me-3">
                                <label class="form-label">&nbsp;</label>
                                <div class="fs-3 font-bold offer-number ">${offerIndex}</div>
                            </div>
                            <div class="mx-2 flex-grow-1">
                                <label for="offer-select-${funnelIndex}-${offerIndex}" class="form-label required">Offer</label>
                                <select class="form-select select2-search w-100 offer-select"
                                        id="offer-select-${funnelIndex}-${offerIndex}"
                                        name="funnels[${funnelIndex}][offers][${offerIndex}][offer_id]">
                                </select>
                            </div>
                            <div class="mx-0 mx-md-2" >
                                <label for="ratio-${funnelIndex}-${offerIndex}" class="form-label">Ratio</label>
                                <input type="number" max="100" min="0" value="100"
                                       class="form-control min-w-70px ratio-input"
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
            const funnelId = $funnel.data('funnel-id');
            const id = `${type}-select-${funnelId}`;
            const url = getFilterUrl(type);

            const filterName = `funnels[${funnelId}][filters][${type}][values][]`;
            const targetingTypeName = `funnels[${funnelId}][filters][${type}][targeting_type]`;

            const newSelectHtml = `
                <div class="filter-item mt-2 d-flex align-items-center">
                    <div class="d-flex align-items-center" style="width: 150px;">
                        <label for="${id}" class="form-label me-2">${label}</label>
                    </div>
                    <div class="me-2" style="width: 120px;">
                        <select class="form-select target-type-select" name="${targetingTypeName}">
                            <option value="include" selected>Include</option>
                            <option value="exclude">Exclude</option>
                        </select>
                    </div>
                    <div class="flex-grow-1 me-2">
                        <select class="form-select select2-search filter-select" id="${id}" name="${filterName}" data-url="${url}" multiple></select>
                    </div>
                    <button type="button" class="btn btn-sm btn-remove-filter" title="Remove filter">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            `;

            $selectedFilters.append(newSelectHtml);
            initializeSelect2Dynamic(`#${id}`, url);
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

        function initializeSelect2Dynamic(selector, url) {
            $(selector).select2({
                placeholder: 'Select an option',
                allowClear: true,
                width: '100%',
                multiple: true,
                ajax: {
                    url: url,
                    dataType: 'json',
                    delay: 250, // Add a slight delay to prevent overwhelming the server
                    data: function (params) {
                        return {
                            search: params.term || '', // This sends the search term to the server
                            limit: 10, // Limit the number of results returned by the server
                            page: params.page || 1 // Add pagination support
                        };
                    },
                    processResults: function (data, params) {
                        // Ensure pagination is supported by select2
                        params.page = params.page || 1;

                        return {
                            results: $.map(data.items, function (item) {
                                return {id: item.id, text: item.name};
                            }),
                            pagination: {
                                more: (params.page * 10) < data.total_count // Enable "load more" if there are more results
                            }
                        };
                    },
                    cache: true
                },
                minimumInputLength: 0, // Users can view the list without entering any search term
            });
        }

        // Cập nhật số lượng filter
        function updateFilterCount($funnel) {
            const filterCount = $funnel.find('.selected-filters .filter-item').length;
            $funnel.find('.count-filters').text(filterCount).data('count', filterCount);
        }

        $(document).on('click', '.btn-remove-filter', function () {
            const $filterItem = $(this).closest('.filter-item');
            const filterId = $filterItem.find('.filter-select').attr('id').split('-')[0]; // Lấy loại filter (geo, device, browser)
            const $funnel = $(this).closest('.item-funnel');

            // Tìm và xóa giá trị từ select2
            const $addFilterSelect = $funnel.find('.add-filter-select');
            const currentValues = $addFilterSelect.val() || []; // Lấy các giá trị hiện tại trong select2
            const updatedValues = currentValues.filter(value => value !== filterId); // Loại bỏ filter vừa xóa
            $addFilterSelect.val(updatedValues).trigger('change'); // Cập nhật lại select2 và kích hoạt sự kiện change

            // Xóa filter khỏi selected-filters
            $filterItem.remove();

            // Cập nhật lại số lượng filter
            updateFilterCount($funnel);
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


        $(document).on('click', '.btn-add-offer', function () {
            const $funnel = $(this).closest('.item-funnel');
            const funnelIndex = $funnel.data('funnel-id');
            const offerCount = $funnel.find('.list-offers .item-offer').length + 1;

            // Append the new offer HTML
            const offerHtml = createOfferHtml(funnelIndex, offerCount);
            $funnel.find('.list-offers').append(offerHtml);

            // Initialize select2 ONLY for the new offer added
            initializeSelect2ForNewOffer($funnel, offerCount);
        });

        function initializeSelect2ForNewOffer($funnel, offerCount) {
            const $newOfferSelect = $funnel.find(`#offer-select-${$funnel.data('funnel-id')}-${offerCount}`);

            // Ensure this newly added select element gets initialized
            $newOfferSelect.select2({
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
        }


        // Khởi tạo cho Funnel 1 khi trang tải lần đầu
        $(document).ready(function () {
            initializeSelect2($('.item-funnel').first());
            $('.select2-search-filter-select').select2({
                placeholder: 'Select an option',
                allowClear: true,
                width: '100%',
                multiple: true
            });
        });

        // Toggle hiển thị bộ lọc khi nhấn nút Filter
        $(document).on('click', '.btn-add-filters', function () {
            const $filterContainer = $(this).closest('.item-funnel').find('.filter-container');
            $filterContainer.toggle();
        });

        function updateOfferIndexes($funnel) {
            // Lặp qua tất cả các offer trong funnel hiện tại
            $funnel.find('.list-offers .item-offer').each(function (index) {
                const offerIndex = index + 1; // Chỉ số mới cho offer (bắt đầu từ 1)
                const funnelId = $funnel.data('funnel-id'); // Lấy funnel-id từ funnel hiện tại

                // Cập nhật số thứ tự hiển thị của offer
                $(this).find('.offer-number').text(offerIndex);

                // Cập nhật id và name cho select offer
                $(this).find('.offer-select').attr('id', `offer-select-${funnelId}-${offerIndex}`);
                $(this).find('.offer-select').attr('name', `funnels[${funnelId}][offers][${offerIndex}][offer_id]`);

                // Cập nhật id và name cho input ratio
                $(this).find('.ratio-input').attr('id', `ratio-${funnelId}-${offerIndex}`);
                $(this).find('.ratio-input').attr('name', `funnels[${funnelId}][offers][${offerIndex}][ratio]`);
            });
        }


        // Khi trang được load
        $(document).ready(function () {
            const $funnels = $('.list-funnels .item-funnel');


            $funnels.each(function () {
                initializeSelect2($(this));
                updateOfferIndexes($(this));
            });

            $('#website_id').select2({
                placeholder: 'Select a website',
                ajax: {
                    url: '{{ route('admin.websites.list') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term, // search term
                            page: params.page || 1
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.results, // results from the server
                            pagination: {
                                more: (params.page * 10) < data.total_count // Check if more results are available
                            }
                        };
                    },
                    cache: true
                },
                minimumInputLength: 0 // Allow showing results without typing
            });

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
                    $('.btn-save-campaign').prop('disabled', false);
                    $('.indicator-label').show();
                    $('.indicator-progress').hide();

                    toastr.error('Please check the form again!');

                    const errors = xhr.responseJSON.errors;
                    if (errors) {
                        $.each(errors, function (key, value) {
                            if (key.includes('funnels')) {
                                const keys = key.split('.'); //
                                const funnelIndex = keys[1]; // funnel index (e.g., '0')
                                const offerIndex = keys[3]; // offer index (e.g., '1')
                                const fieldName = keys[4]; // actual field name (e.g., 'offer_id')

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

        $(document).on('click', '.btn-back', function () {
            //call sweet alert
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to leave this page!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, leave!',
                cancelButtonText: 'No, stay'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route('admin.campaigns.index') }}';
                }
            });
        });
    </script>

@endpush
