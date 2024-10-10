<div class="aside-menu flex-column-fluid">
    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y" id="kt_aside_menu_wrapper" data-kt-scroll="true"
         data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
         data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
         data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
        <!--begin::Menu-->
        <div
            class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
            id="#kt_aside_menu" data-kt-menu="true">

            <!--begin:Menu item-->
            <div class="menu-item pt-5">
                <!--begin:Menu content-->
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">
                        <span class="fs-7">Menu</span>
                    </span>
                </div>
            </div>

            <div class="menu-item">
                <a class="menu-link
                    @if(request()->routeIs('admin.dashboard')) active @endif" href="{{ route('admin.dashboard') }}"
                   title="Dashboard">

										<span class="menu-icon">
											<i class="ki-outline bi-house fs-3"></i>
										</span>
                    <span class="menu-title">
                        Dashboard
                    </span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="" title="Statistics">
										<span class="menu-icon">
											<i class="ki-outline ki-chart-simple-2 fs-3"></i>
										</span>
                    <span class="menu-title">
                        Statistics
                    </span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link
                    @if(request()->routeIs('admin.campaigns.*')) active @endif" href="{{ route('admin.campaigns.index') }}"
                   title="Campaigns">
										<span class="menu-icon">
											<i class="ki-outline ki-directbox-default fs-3"></i>
										</span>
                    <span class="menu-title">
                        Campaigns
                    </span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link
                    @if(request()->routeIs('admin.offers.*')) active @endif" href="{{ route('admin.offers.index') }}"
                   title="Offers">
										<span class="menu-icon">
											<i class="ki-outline bi-gift fs-3"></i>
										</span>
                    <span class="menu-title">
                        Offers
                    </span>
                </a>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion @if(request()->routeIs('admin.zones.*')) show @endif">
                <span class="menu-link">
					<span class="menu-icon">
						<i class="ki-outline bi-grid-1x2 fs-3"></i>
					</span>
					<span class="menu-title">
                        Zones
                    </span>
					<span class="menu-arrow"></span>
				</span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link @if(request()->routeIs('admin.zones.index')) active @endif" href="{{ route('admin.zones.index') }}" title="Customers">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">
                                My Zones
                            </span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link @if(request()->routeIs('admin.zones.create')) active @endif" href="{{ route('admin.zones.create') }}" title="Create Zone">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">
                                Create Zone
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="" title="Statistics">
										<span class="menu-icon">
											<i class="fa fa-globe fs-3"></i>
										</span>
                    <span class="menu-title">
                        Website
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
