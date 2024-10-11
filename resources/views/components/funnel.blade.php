<div class="item-funnel" data-funnel-id="{{ $funnelId }}">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Funnel #{{ $funnelId }}</h4>
            <div class="d-flex align-items-center">
            </div>
        </div>
        <div class="card-body">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h5 class="card-subtitle mb-3">Offers</h5>
                            <div class="list-offers">
                                <div class="item-offer">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="d-flex align-items-center flex-grow-1">
                                            <div class="me-5">
                                                <label class="form-label">&nbsp;</label>
                                                <div class="fs-3 font-bold">1</div>
                                            </div>
                                            <div class="mx-2 flex-grow-1">
                                                <label for="offer-select-{{ $funnelId }}-1" class="form-label">Offer</label>
                                                <select class="form-select select2-search w-100 offer-select" id="offer-select-{{ $funnelId }}-1" name="offer-{{ $funnelId }}-1">
                                                </select>
                                            </div>
                                            <div class="mx-2" style="width: 150px;">
                                                <label for="ratio" class="form-label">Ratio</label>
                                                <input type="number" max="100" min="0" value="100" class="form-control" id="ratio" name="ratio-{{ $funnelId }}-1" placeholder="Enter ratio">
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
                            </div>

                            <button class="btn btn-sm btn-success mt-2 btn-add-offer" title="Add offer" type="button">
                                <i class="fa fa-plus"></i> Add
                            </button>

                            <a class="btn btn-sm btn-primary mt-2" title="Create new offer" target="_blank" href="{{ route('admin.offers.create') }}">New Offer</a>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <button class="btn btn-sm btn-success btn-add-filters d-flex justify-content-between align-items-center" title="Add new filters" type="button">
                    Filters (
                    <span class="count-filters" data-count="0">0</span>
                    ) &nbsp;
                    <i class="fa fa-chevron-down icon-rotate rotate-up" aria-hidden="true"></i>
                </button>

                <div class="filter-container d-none mt-3">
                    <div class="item-filters">
                        <div class="col-6">
                            <label for="add-filter-{{ $funnelId }}" class="form-label">Add Filter</label>
                            <select class="form-select select2-search add-filter-select multi-select-filter" id="add-filter-{{ $funnelId }}" name="add-filter-{{ $funnelId }}[]" multiple="multiple">
                                <option value="geo">Geo</option>
                                <option value="device">Device</option>
                                <option value="browser">Browser</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="selected-filters mt-3" id="selected-filters-{{ $funnelId }}"></div>
                </div>
            </div>
        </div>
    </div>
</div>
