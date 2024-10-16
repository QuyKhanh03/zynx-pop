<div class="list-funnels">
    @foreach($funnels as $funnelIndex => $funnel)
        <div class="item-funnel" data-funnel-id="{{ $funnelIndex + 1 }}">
            <div class="card mb-4 funnel-item">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Funnel #{{ $funnelIndex + 1 }}</h4>
                    <button class="btn btn-sm btn-delete-funnel" type="button">
                        <i class="fa fa-times text-gray-500"></i>
                    </button>
                </div>
                <div class="card-body p-3 p-md-10">
                    <!-- Offers Section -->
                    <div class="mb-3">
                        <h5>Offers</h5>
                        <div class="list-offers">
                            @foreach($funnel->offers as $offerIndex => $offer)
                                <div class="item-offer" data-offer-id="{{ $offerIndex + 1 }}">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="d-flex align-items-center flex-grow-1">
                                            <div class="me-3">
                                                <label class="form-label">&nbsp;</label>
                                                <div class="fs-3 font-bold offer-number">{{ $offerIndex + 1 }}</div>
                                            </div>
                                            <div class="mx-2 flex-grow-1">
                                                <label for="offer-select-{{ $funnelIndex + 1 }}-{{ $offerIndex + 1 }}" class="form-label required">Offer</label>
                                                <select class="form-select select2-search w-100 offer-select"
                                                        id="offer-select-{{ $funnelIndex + 1 }}-{{ $offerIndex + 1 }}"
                                                        name="funnels[{{ $funnelIndex }}][offers][{{ $offerIndex }}][offer_id]">
                                                    <option value="{{ $offer->id }}">{{ $offer->name }}</option>
                                                </select>
                                            </div>
                                            <div class="mx-0 mx-md-2">
                                                <label for="ratio-{{ $funnelIndex + 1 }}-{{ $offerIndex + 1 }}" class="form-label">Ratio</label>
                                                <input type="number" max="100" min="0"
                                                       value="{{ $offer->pivot->ratio }}"
                                                       class="form-control min-w-60px ratio-input"
                                                       id="ratio-{{ $funnelIndex + 1 }}-{{ $offerIndex + 1 }}"
                                                       name="funnels[{{ $funnelIndex }}][offers][{{ $offerIndex }}][ratio]"
                                                       placeholder="Enter ratio">
                                            </div>
                                        </div>

                                        <div class="">
                                            <label class="form-label">&nbsp;</label>
                                            <button type="button" class="btn btn-sm btn-delete-offer">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
                                <label for="add-filter-{{ $funnelIndex + 1 }}" class="form-label">Add Filter</label>
                                <select class="form-select select2-search add-filter-select multi-select-filter"
                                        id="add-filter-{{ $funnelIndex + 1 }}" name="funnels[{{ $funnelIndex }}][filters][]" multiple>
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
    @endforeach
</div>
