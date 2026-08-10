<!-- Company Sidebar -->
<aside class="dashboard-sidebar" id="dashboardSidebar">
    <div class="sidebar-header">
        <a href="{{ url('/company/dashboard') }}" class="sidebar-logo">
            <i class="fas fa-building"></i>
            <span>Fastap</span>
        </a>
        <button class="sidebar-close" id="sidebarClose">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Company Info -->
    <div class="sidebar-company-info" style="padding: 1rem; border-bottom: 1px solid var(--border-color);">
        <div style="display: flex; align-items: center; gap: 0.75rem;">
            @if($company->logo ?? false)
                <img src="{{ asset('uploads/companies/' . $company->logo) }}" alt="{{ $company->name ?? 'Company' }}"
                     style="width: 40px; height: 40px; border-radius: 8px; object-fit: cover;">
            @else
                <div style="width: 40px; height: 40px; border-radius: 8px; background: linear-gradient(135deg, #0891b2, #06b6d4); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                    {{ substr($company->name ?? 'C', 0, 1) }}
                </div>
            @endif
            <div style="flex: 1; min-width: 0;">
                <div style="font-weight: 600; font-size: 0.875rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    {{ $company->name ?? 'Company' }}
                </div>
                <div style="font-size: 0.75rem; color: var(--text-muted);">
                    {{ ucfirst($company->subscription_type ?? 'free') }} Plan
                </div>
            </div>
        </div>
        @if(isset($company))
        <div style="margin-top: 0.75rem; font-size: 0.75rem; display: flex; justify-content: space-between; padding: 0.5rem; background: var(--bg-secondary); border-radius: 6px;">
            <span>Cards: {{ $company->cards_used ?? 0 }}/{{ $company->card_limit ?? 5 }}</span>
            <span style="color: #0891b2;">{{ $company->remaining_cards ?? 0 }} left</span>
        </div>
        @endif
    </div>

    <nav class="sidebar-nav">
        <ul class="sidebar-nav-list">
            <!-- Dashboard -->
            <li class="sidebar-nav-item">
                <a href="{{ url('/company/dashboard') }}" class="sidebar-nav-link {{ request()->is('company/dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Staff Management -->
            <li class="sidebar-nav-item has-submenu {{ request()->is('company/staff*') ? 'open' : '' }}">
                <a href="javascript:void(0)" class="sidebar-nav-link">
                    <i class="fas fa-users"></i>
                    <span>Staff Management</span>
                    <i class="fas fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ url('/company/staff') }}" class="{{ request()->is('company/staff') ? 'active' : '' }}">
                            <i class="fas fa-list"></i>
                            <span>All Staff</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/staff/create') }}" class="{{ request()->is('company/staff/create') ? 'active' : '' }}">
                            <i class="fas fa-user-plus"></i>
                            <span>Add Staff</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/staff/import') }}" class="{{ request()->is('company/staff/import') ? 'active' : '' }}">
                            <i class="fas fa-file-import"></i>
                            <span>Bulk Import</span>
                        </a>
                    </li>
                </ul>
            </li>

            @if(isset($company) && $company->profession_type == 13)
            <!-- Menu Management (Restaurant Theme Only) -->
            <li class="sidebar-nav-item has-submenu {{ request()->is('company/menu*') ? 'open' : '' }}">
                <a href="javascript:void(0)" class="sidebar-nav-link">
                    <i class="fas fa-utensils"></i>
                    <span>Menu</span>
                    <i class="fas fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ url('/company/menu') }}" class="{{ request()->is('company/menu') && !request()->is('company/menu/*') ? 'active' : '' }}">
                            <i class="fas fa-th-list"></i>
                            <span>All Categories</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/menu/category/create') }}" class="{{ request()->is('company/menu/category/create') ? 'active' : '' }}">
                            <i class="fas fa-folder-plus"></i>
                            <span>Add Category</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/menu/item/create') }}" class="{{ request()->is('company/menu/item/create') ? 'active' : '' }}">
                            <i class="fas fa-plus-circle"></i>
                            <span>Add Item</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Restaurant Settings (Restaurant Theme Only) -->
            <li class="sidebar-nav-item">
                <a href="{{ url('/company/restaurant') }}" class="sidebar-nav-link {{ request()->is('company/restaurant*') ? 'active' : '' }}">
                    <i class="fas fa-store"></i>
                    <span>Restaurant Settings</span>
                </a>
            </li>

            <!-- Hospitality Management (Restaurant Theme Only) -->
            <li class="sidebar-nav-item has-submenu {{ request()->is('company/restaurant/tables*') || request()->is('company/restaurant/rooms*') || request()->is('company/restaurant/orders*') || request()->is('company/restaurant/events*') || request()->is('company/restaurant/banquets*') || request()->is('company/restaurant/payments*') ? 'open' : '' }}">
                <a href="javascript:void(0)" class="sidebar-nav-link">
                    <i class="fas fa-concierge-bell"></i>
                    <span>Hospitality</span>
                    <i class="fas fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ url('/company/restaurant/profiles') }}" class="{{ request()->is('company/restaurant/profiles*') ? 'active' : '' }}">
                            <i class="fas fa-layer-group"></i>
                            <span>Profiles</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/restaurant/tables') }}" class="{{ request()->is('company/restaurant/tables*') ? 'active' : '' }}">
                            <i class="fas fa-chair"></i>
                            <span>Tables</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/restaurant/rooms') }}" class="{{ request()->is('company/restaurant/rooms*') ? 'active' : '' }}">
                            <i class="fas fa-bed"></i>
                            <span>Rooms</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/restaurant/orders') }}" class="{{ request()->is('company/restaurant/orders*') ? 'active' : '' }}">
                            <i class="fas fa-receipt"></i>
                            <span>Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/restaurant/events') }}" class="{{ request()->is('company/restaurant/events*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-day"></i>
                            <span>Events</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/restaurant/banquets') }}" class="{{ request()->is('company/restaurant/banquets*') ? 'active' : '' }}">
                            <i class="fas fa-warehouse"></i>
                            <span>Banquets</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/restaurant/payments') }}" class="{{ request()->is('company/restaurant/payments*') ? 'active' : '' }}">
                            <i class="fas fa-credit-card"></i>
                            <span>Payments</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/restaurant/kitchen') }}" class="{{ request()->is('company/restaurant/kitchen*') ? 'active' : '' }}">
                            <i class="fas fa-fire"></i>
                            <span>Kitchen</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/restaurant/analytics') }}" class="{{ request()->is('company/restaurant/analytics*') ? 'active' : '' }}">
                            <i class="fas fa-chart-line"></i>
                            <span>Analytics</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if(isset($company) && $company->profession_type == 8)
            <!-- Production House Management (Production Theme Only) -->
            <li class="sidebar-nav-item has-submenu {{ request()->is('company/production/services*') || request()->is('company/production/projects*') || request()->is('company/production/portfolios*') || request()->is('company/production/team*') || request()->is('company/production/payments*') ? 'open' : '' }}">
                <a href="javascript:void(0)" class="sidebar-nav-link">
                    <i class="fas fa-clapperboard"></i>
                    <span>Production</span>
                    <i class="fas fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ url('/company/production/services') }}" class="{{ request()->is('company/production/services*') ? 'active' : '' }}">
                            <i class="fas fa-list"></i>
                            <span>Services</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/production/projects') }}" class="{{ request()->is('company/production/projects*') ? 'active' : '' }}">
                            <i class="fas fa-folder-open"></i>
                            <span>Projects</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/production/portfolios') }}" class="{{ request()->is('company/production/portfolios*') ? 'active' : '' }}">
                            <i class="fas fa-photo-film"></i>
                            <span>Portfolio</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/production/team') }}" class="{{ request()->is('company/production/team*') ? 'active' : '' }}">
                            <i class="fas fa-users"></i>
                            <span>Team</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/production/payments') }}" class="{{ request()->is('company/production/payments*') ? 'active' : '' }}">
                            <i class="fas fa-receipt"></i>
                            <span>Payments</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if(isset($company) && $company->profession_type == 10)
            <!-- Jewellery Management (Jewellery Theme Only) -->
            <li class="sidebar-nav-item has-submenu {{ request()->is('company/jewellery/products*') || request()->is('company/jewellery/rates*') || request()->is('company/jewellery/orders*') ? 'open' : '' }}">
                <a href="javascript:void(0)" class="sidebar-nav-link">
                    <i class="fas fa-gem"></i>
                    <span>Jewellery</span>
                    <i class="fas fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ url('/company/jewellery/products') }}" class="{{ request()->is('company/jewellery/products*') ? 'active' : '' }}">
                            <i class="fas fa-ring"></i>
                            <span>Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/jewellery/rates') }}" class="{{ request()->is('company/jewellery/rates*') ? 'active' : '' }}">
                            <i class="fas fa-coins"></i>
                            <span>Metal Rates</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/jewellery/orders') }}" class="{{ request()->is('company/jewellery/orders*') ? 'active' : '' }}">
                            <i class="fas fa-clipboard-list"></i>
                            <span>Custom Orders</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if(isset($company) && $company->profession_type == 11)
            <!-- Technology Management (Technology Theme Only) -->
            <li class="sidebar-nav-item has-submenu {{ request()->is('company/tech/services*') || request()->is('company/tech/projects*') || request()->is('company/tech/case-studies*') ? 'open' : '' }}">
                <a href="javascript:void(0)" class="sidebar-nav-link">
                    <i class="fas fa-laptop-code"></i>
                    <span>Technology</span>
                    <i class="fas fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ url('/company/tech/services') }}" class="{{ request()->is('company/tech/services*') ? 'active' : '' }}">
                            <i class="fas fa-layer-group"></i>
                            <span>Services</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/tech/projects') }}" class="{{ request()->is('company/tech/projects*') ? 'active' : '' }}">
                            <i class="fas fa-briefcase"></i>
                            <span>Projects</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/tech/case-studies') }}" class="{{ request()->is('company/tech/case-studies*') ? 'active' : '' }}">
                            <i class="fas fa-chart-line"></i>
                            <span>Case Studies</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if(isset($company) && $company->profession_type == 14)
            <!-- Tour Planner Management (Travel Theme Only) -->
            <li class="sidebar-nav-item has-submenu {{ request()->is('company/tour/packages*') || request()->is('company/tour/bookings*') ? 'open' : '' }}">
                <a href="javascript:void(0)" class="sidebar-nav-link">
                    <i class="fas fa-suitcase-rolling"></i>
                    <span>Travel</span>
                    <i class="fas fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ url('/company/tour/packages') }}" class="{{ request()->is('company/tour/packages*') ? 'active' : '' }}">
                            <i class="fas fa-map-marked-alt"></i>
                            <span>Packages</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/tour/bookings') }}" class="{{ request()->is('company/tour/bookings*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-check"></i>
                            <span>Bookings</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if(isset($company) && $company->profession_type == 15)
            <!-- Fitness Management (Fitness Theme Only) -->
            <li class="sidebar-nav-item has-submenu {{ request()->is('company/fitness/programs*') || request()->is('company/fitness/trainers*') || request()->is('company/fitness/memberships*') || request()->is('company/fitness/subscriptions*') || request()->is('company/fitness/classes*') || request()->is('company/fitness/bookings*') || request()->is('company/fitness/progress*') || request()->is('company/fitness/transformations*') || request()->is('company/fitness/diet-plans*') ? 'open' : '' }}">
                <a href="javascript:void(0)" class="sidebar-nav-link">
                    <i class="fas fa-dumbbell"></i>
                    <span>Fitness</span>
                    <i class="fas fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ url('/company/fitness/programs') }}" class="{{ request()->is('company/fitness/programs*') ? 'active' : '' }}">
                            <i class="fas fa-list-check"></i>
                            <span>Programs</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/fitness/trainers') }}" class="{{ request()->is('company/fitness/trainers*') ? 'active' : '' }}">
                            <i class="fas fa-user-ninja"></i>
                            <span>Trainers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/fitness/memberships') }}" class="{{ request()->is('company/fitness/memberships*') ? 'active' : '' }}">
                            <i class="fas fa-id-card"></i>
                            <span>Memberships</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/fitness/subscriptions') }}" class="{{ request()->is('company/fitness/subscriptions*') ? 'active' : '' }}">
                            <i class="fas fa-user-check"></i>
                            <span>Subscriptions</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/fitness/classes') }}" class="{{ request()->is('company/fitness/classes*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Classes</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/fitness/bookings') }}" class="{{ request()->is('company/fitness/bookings*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-check"></i>
                            <span>Bookings</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/fitness/progress') }}" class="{{ request()->is('company/fitness/progress*') ? 'active' : '' }}">
                            <i class="fas fa-chart-line"></i>
                            <span>Progress</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/fitness/transformations') }}" class="{{ request()->is('company/fitness/transformations*') ? 'active' : '' }}">
                            <i class="fas fa-trophy"></i>
                            <span>Transformations</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/fitness/diet-plans') }}" class="{{ request()->is('company/fitness/diet-plans*') ? 'active' : '' }}">
                            <i class="fas fa-apple-alt"></i>
                            <span>Diet Plans</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if(isset($company) && $company->profession_type == 16)
            <!-- Education Management (Education Theme Only) -->
            <li class="sidebar-nav-item has-submenu {{ request()->is('company/education/courses*') || request()->is('company/education/batches*') || request()->is('company/education/faculty*') || request()->is('company/education/admissions*') || request()->is('company/education/results*') || request()->is('company/education/materials*') || request()->is('company/education/fee-structures*') || request()->is('company/education/student-fees*') || request()->is('company/education/attendance*') || request()->is('company/education/tests*') ? 'open' : '' }}">
                <a href="javascript:void(0)" class="sidebar-nav-link">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Education</span>
                    <i class="fas fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ url('/company/education/courses') }}" class="{{ request()->is('company/education/courses*') ? 'active' : '' }}">
                            <i class="fas fa-book"></i>
                            <span>Courses</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/education/batches') }}" class="{{ request()->is('company/education/batches*') ? 'active' : '' }}">
                            <i class="fas fa-layer-group"></i>
                            <span>Batches</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/education/faculty') }}" class="{{ request()->is('company/education/faculty*') ? 'active' : '' }}">
                            <i class="fas fa-user-graduate"></i>
                            <span>Faculty</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/education/admissions') }}" class="{{ request()->is('company/education/admissions*') ? 'active' : '' }}">
                            <i class="fas fa-clipboard-list"></i>
                            <span>Admissions</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/education/results') }}" class="{{ request()->is('company/education/results*') ? 'active' : '' }}">
                            <i class="fas fa-trophy"></i>
                            <span>Results</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/education/materials') }}" class="{{ request()->is('company/education/materials*') ? 'active' : '' }}">
                            <i class="fas fa-folder-open"></i>
                            <span>Materials</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/education/fee-structures') }}" class="{{ request()->is('company/education/fee-structures*') ? 'active' : '' }}">
                            <i class="fas fa-receipt"></i>
                            <span>Fee Structures</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/education/student-fees') }}" class="{{ request()->is('company/education/student-fees*') ? 'active' : '' }}">
                            <i class="fas fa-wallet"></i>
                            <span>Student Fees</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/education/attendance') }}" class="{{ request()->is('company/education/attendance*') ? 'active' : '' }}">
                            <i class="fas fa-user-check"></i>
                            <span>Attendance</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/education/tests') }}" class="{{ request()->is('company/education/tests*') ? 'active' : '' }}">
                            <i class="fas fa-clipboard-check"></i>
                            <span>Tests</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if(isset($company) && $company->profession_type == 17)
            <!-- Lawyer Management (Lawyer Theme Only) -->
            <li class="sidebar-nav-item has-submenu {{ request()->is('company/lawyer/services*') || request()->is('company/lawyer/cases*') || request()->is('company/lawyer/hearings*') || request()->is('company/lawyer/consultations*') ? 'open' : '' }}">
                <a href="javascript:void(0)" class="sidebar-nav-link">
                    <i class="fas fa-scale-balanced"></i>
                    <span>Legal</span>
                    <i class="fas fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ url('/company/lawyer/services') }}" class="{{ request()->is('company/lawyer/services*') ? 'active' : '' }}">
                            <i class="fas fa-list-check"></i>
                            <span>Services</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/lawyer/cases') }}" class="{{ request()->is('company/lawyer/cases*') ? 'active' : '' }}">
                            <i class="fas fa-gavel"></i>
                            <span>Cases</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/lawyer/hearings') }}" class="{{ request()->is('company/lawyer/hearings*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-day"></i>
                            <span>Hearings</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/lawyer/consultations') }}" class="{{ request()->is('company/lawyer/consultations*') ? 'active' : '' }}">
                            <i class="fas fa-user-clock"></i>
                            <span>Consultations</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if(isset($company) && $company->profession_type == 18)
            <!-- CA Management (CA Theme Only) -->
            <li class="sidebar-nav-item has-submenu {{ request()->is('company/ca/services*') || request()->is('company/ca/cases*') || request()->is('company/ca/consultations*') || request()->is('company/ca/deadlines*') ? 'open' : '' }}">
                <a href="javascript:void(0)" class="sidebar-nav-link">
                    <i class="fas fa-file-invoice"></i>
                    <span>CA</span>
                    <i class="fas fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ url('/company/ca/services') }}" class="{{ request()->is('company/ca/services*') ? 'active' : '' }}">
                            <i class="fas fa-file-invoice"></i>
                            <span>Services</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/ca/cases') }}" class="{{ request()->is('company/ca/cases*') ? 'active' : '' }}">
                            <i class="fas fa-folder-open"></i>
                            <span>Cases</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/ca/consultations') }}" class="{{ request()->is('company/ca/consultations*') ? 'active' : '' }}">
                            <i class="fas fa-user-clock"></i>
                            <span>Consultations</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/ca/deadlines') }}" class="{{ request()->is('company/ca/deadlines*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-check"></i>
                            <span>Deadlines</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if(isset($company) && $company->profession_type == 19)
            <!-- Salon Management (Salon Theme Only) -->
            <li class="sidebar-nav-item has-submenu {{ request()->is('company/salon/services*') || request()->is('company/salon/artists*') || request()->is('company/salon/appointments*') || request()->is('company/salon/packages*') || request()->is('company/salon/portfolio*') || request()->is('company/salon/products*') ? 'open' : '' }}">
                <a href="javascript:void(0)" class="sidebar-nav-link">
                    <i class="fas fa-spa"></i>
                    <span>Salon</span>
                    <i class="fas fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ url('/company/salon/services') }}" class="{{ request()->is('company/salon/services*') ? 'active' : '' }}">
                            <i class="fas fa-list-check"></i>
                            <span>Services</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/salon/artists') }}" class="{{ request()->is('company/salon/artists*') ? 'active' : '' }}">
                            <i class="fas fa-user-astronaut"></i>
                            <span>Artists</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/salon/appointments') }}" class="{{ request()->is('company/salon/appointments*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-check"></i>
                            <span>Appointments</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/salon/packages') }}" class="{{ request()->is('company/salon/packages*') ? 'active' : '' }}">
                            <i class="fas fa-gift"></i>
                            <span>Packages</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/salon/portfolio') }}" class="{{ request()->is('company/salon/portfolio*') ? 'active' : '' }}">
                            <i class="fas fa-images"></i>
                            <span>Portfolio</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/salon/products') }}" class="{{ request()->is('company/salon/products*') ? 'active' : '' }}">
                            <i class="fas fa-box"></i>
                            <span>Products</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if(isset($company) && $company->profession_type == 24)
            <!-- Political Management (Political Theme Only) -->
            <li class="sidebar-nav-item has-submenu {{ request()->is('company/political/profiles*') || request()->is('company/political/grievances*') || request()->is('company/political/services*') || request()->is('company/political/projects*') || request()->is('company/political/events*') || request()->is('company/political/volunteers*') ? 'open' : '' }}">
                <a href="javascript:void(0)" class="sidebar-nav-link">
                    <i class="fas fa-flag"></i>
                    <span>Political</span>
                    <i class="fas fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ url('/company/political/profiles') }}" class="{{ request()->is('company/political/profiles*') ? 'active' : '' }}">
                            <i class="fas fa-id-badge"></i>
                            <span>Profiles</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/political/grievances') }}" class="{{ request()->is('company/political/grievances*') ? 'active' : '' }}">
                            <i class="fas fa-comments"></i>
                            <span>Grievances</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/political/services') }}" class="{{ request()->is('company/political/services*') ? 'active' : '' }}">
                            <i class="fas fa-hand-holding-heart"></i>
                            <span>Services</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/political/projects') }}" class="{{ request()->is('company/political/projects*') ? 'active' : '' }}">
                            <i class="fas fa-road"></i>
                            <span>Projects</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/political/events') }}" class="{{ request()->is('company/political/events*') ? 'active' : '' }}">
                            <i class="fas fa-calendar"></i>
                            <span>Events</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/political/volunteers') }}" class="{{ request()->is('company/political/volunteers*') ? 'active' : '' }}">
                            <i class="fas fa-people-group"></i>
                            <span>Volunteers</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if(isset($company) && $company->profession_type == 20)
            <!-- Interior Management (Interior Theme Only) -->
            <li class="sidebar-nav-item has-submenu {{ request()->is('company/interior/services*') || request()->is('company/interior/projects*') || request()->is('company/interior/portfolio*') || request()->is('company/interior/consultations*') ? 'open' : '' }}">
                <a href="javascript:void(0)" class="sidebar-nav-link">
                    <i class="fas fa-couch"></i>
                    <span>Interior</span>
                    <i class="fas fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ url('/company/interior/services') }}" class="{{ request()->is('company/interior/services*') ? 'active' : '' }}">
                            <i class="fas fa-list-check"></i>
                            <span>Services</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/interior/projects') }}" class="{{ request()->is('company/interior/projects*') ? 'active' : '' }}">
                            <i class="fas fa-briefcase"></i>
                            <span>Projects</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/interior/portfolio') }}" class="{{ request()->is('company/interior/portfolio*') ? 'active' : '' }}">
                            <i class="fas fa-images"></i>
                            <span>Portfolio</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/interior/consultations') }}" class="{{ request()->is('company/interior/consultations*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-check"></i>
                            <span>Consultations</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if(isset($company) && $company->profession_type == 23)
            <!-- Astrologer Management (Astrologer Theme Only) -->
            <li class="sidebar-nav-item has-submenu {{ request()->is('company/astrologer/services*') || request()->is('company/astrologer/consultations*') || request()->is('company/astrologer/reports*') ? 'open' : '' }}">
                <a href="javascript:void(0)" class="sidebar-nav-link">
                    <i class="fas fa-star"></i>
                    <span>Astrologer</span>
                    <i class="fas fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ url('/company/astrologer/services') }}" class="{{ request()->is('company/astrologer/services*') ? 'active' : '' }}">
                            <i class="fas fa-star"></i>
                            <span>Services</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/astrologer/consultations') }}" class="{{ request()->is('company/astrologer/consultations*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-check"></i>
                            <span>Consultations</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/astrologer/reports') }}" class="{{ request()->is('company/astrologer/reports*') ? 'active' : '' }}">
                            <i class="fas fa-file-lines"></i>
                            <span>Reports</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if(isset($company) && $company->profession_type == 22)
            <!-- Security Management (Security Theme Only) -->
            <li class="sidebar-nav-item has-submenu {{ request()->is('company/security/products*') || request()->is('company/security/surveys*') || request()->is('company/security/projects*') || request()->is('company/security/amc*') ? 'open' : '' }}">
                <a href="javascript:void(0)" class="sidebar-nav-link">
                    <i class="fas fa-video"></i>
                    <span>Security</span>
                    <i class="fas fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ url('/company/security/products') }}" class="{{ request()->is('company/security/products*') ? 'active' : '' }}">
                            <i class="fas fa-video"></i>
                            <span>Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/security/surveys') }}" class="{{ request()->is('company/security/surveys*') ? 'active' : '' }}">
                            <i class="fas fa-clipboard-list"></i>
                            <span>Surveys</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/security/projects') }}" class="{{ request()->is('company/security/projects*') ? 'active' : '' }}">
                            <i class="fas fa-briefcase"></i>
                            <span>Projects</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/security/amc') }}" class="{{ request()->is('company/security/amc*') ? 'active' : '' }}">
                            <i class="fas fa-wrench"></i>
                            <span>AMC</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if(isset($company) && $company->profession_type == 25)
            <!-- Influencer Management (Influencer Theme Only) -->
            <li class="sidebar-nav-item has-submenu {{ request()->is('company/influencer/stats*') || request()->is('company/influencer/collaborations*') || request()->is('company/influencer/portfolio*') ? 'open' : '' }}">
                <a href="javascript:void(0)" class="sidebar-nav-link">
                    <i class="fas fa-bullhorn"></i>
                    <span>Influencer</span>
                    <i class="fas fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ url('/company/influencer/stats') }}" class="{{ request()->is('company/influencer/stats*') ? 'active' : '' }}">
                            <i class="fas fa-chart-line"></i>
                            <span>Stats</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/influencer/collaborations') }}" class="{{ request()->is('company/influencer/collaborations*') ? 'active' : '' }}">
                            <i class="fas fa-handshake"></i>
                            <span>Collaborations</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/influencer/portfolio') }}" class="{{ request()->is('company/influencer/portfolio*') ? 'active' : '' }}">
                            <i class="fas fa-images"></i>
                            <span>Portfolio</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if(isset($company) && $company->profession_type == 21)
            <!-- Solar Management (Solar Theme Only) -->
            <li class="sidebar-nav-item has-submenu {{ request()->is('company/solar/solutions*') || request()->is('company/solar/surveys*') || request()->is('company/solar/projects*') || request()->is('company/solar/monitoring*') || request()->is('company/solar/amc*') || request()->is('company/solar/subsidies*') ? 'open' : '' }}">
                <a href="javascript:void(0)" class="sidebar-nav-link">
                    <i class="fas fa-solar-panel"></i>
                    <span>Solar</span>
                    <i class="fas fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ url('/company/solar/solutions') }}" class="{{ request()->is('company/solar/solutions*') ? 'active' : '' }}">
                            <i class="fas fa-solar-panel"></i>
                            <span>Solutions</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/solar/surveys') }}" class="{{ request()->is('company/solar/surveys*') ? 'active' : '' }}">
                            <i class="fas fa-clipboard-list"></i>
                            <span>Surveys</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/solar/projects') }}" class="{{ request()->is('company/solar/projects*') ? 'active' : '' }}">
                            <i class="fas fa-screwdriver-wrench"></i>
                            <span>Projects</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/solar/subsidies') }}" class="{{ request()->is('company/solar/subsidies*') ? 'active' : '' }}">
                            <i class="fas fa-gift"></i>
                            <span>Subsidies</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/solar/monitoring') }}" class="{{ request()->is('company/solar/monitoring*') ? 'active' : '' }}">
                            <i class="fas fa-chart-line"></i>
                            <span>Monitoring</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/solar/amc') }}" class="{{ request()->is('company/solar/amc*') ? 'active' : '' }}">
                            <i class="fas fa-wrench"></i>
                            <span>AMC</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            <!-- Company Profile -->
            <li class="sidebar-nav-item has-submenu {{ request()->is('company/profile*') || request()->is('company/branding*') ? 'open' : '' }}">
                <a href="javascript:void(0)" class="sidebar-nav-link">
                    <i class="fas fa-building"></i>
                    <span>Company</span>
                    <i class="fas fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ url('/company/profile') }}" class="{{ request()->is('company/profile') ? 'active' : '' }}">
                            <i class="fas fa-id-card"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/company/branding') }}" class="{{ request()->is('company/branding') ? 'active' : '' }}">
                            <i class="fas fa-palette"></i>
                            <span>Branding</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Subscription -->
            <li class="sidebar-nav-item">
                <a href="{{ url('/company/subscription') }}" class="sidebar-nav-link {{ request()->is('company/subscription') ? 'active' : '' }}">
                    <i class="fas fa-crown"></i>
                    <span>Subscription</span>
                </a>
            </li>

            <!-- Settings -->
            <li class="sidebar-nav-item">
                <a href="{{ url('/company/change-password') }}" class="sidebar-nav-link {{ request()->is('company/change-password') ? 'active' : '' }}">
                    <i class="fas fa-key"></i>
                    <span>Change Password</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <a href="{{ url('/company/logout') }}" class="sidebar-footer-link">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </div>
</aside>
