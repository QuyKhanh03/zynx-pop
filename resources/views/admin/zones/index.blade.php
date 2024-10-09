@extends('layouts.main')

@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap lh-1">
                </div>
                <div class="d-flex align-items-center py-1">
                    <div class="me-4">
                    </div>
                    <a href="{{ route('admin.zones.create') }}" class="btn btn-sm btn-primary"  id="kt_toolbar_primary_button" title="Create zone">
                        <i class="fas fa-plus"></i>
                        Create zone
                    </a>
                </div>
            </div>
        </div>

        <div id="kt_content_container" class="container-xxl">
            <h1>
                Zones
            </h1>
        </div>
    </div>

@endsection
