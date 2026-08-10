<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <a href="{{ url('/userdashboard') }}" class="sidebar-logo">
            <span class="sidebar-logo-text">FASTAP</span>
        </a>
        <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
            <i class="fas fa-chevron-left"></i>
        </button>
    </div>

    <!-- Sidebar Navigation -->
    <nav class="sidebar-nav">
        <!-- Main Menu -->
        <div class="nav-section">
            <span class="nav-section-title">Main Menu</span>
            <a href="{{ url('/userdashboard') }}" class="nav-item {{ request()->is('userdashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span class="nav-item-text">Dashboard</span>
            </a>
            <a href="{{ url('/myorder') }}" class="nav-item {{ request()->is('myorder') ? 'active' : '' }}">
                <i class="fas fa-shopping-bag"></i>
                <span class="nav-item-text">My Orders</span>
            </a>
            <a href="{{ url('/qrcode') }}" class="nav-item {{ request()->is('qrcode') ? 'active' : '' }}">
                <i class="fas fa-qrcode"></i>
                <span class="nav-item-text">QR Code</span>
            </a>
        </div>

        <!-- Profile Section -->
        <div class="nav-section">
            <span class="nav-section-title">Profile</span>
            <a href="{{ url('/updateuserprofile') }}" class="nav-item {{ request()->is('updateuserprofile') ? 'active' : '' }}">
                <i class="fas fa-user"></i>
                <span class="nav-item-text">My Profile</span>
            </a>
            {{-- <a href="{{ url('/profile-theme') }}" class="nav-item {{ request()->is('profile-theme') ? 'active' : '' }}">
                <i class="fas fa-palette"></i>
                <span class="nav-item-text">Profile Theme</span>
            </a> --}}
            <a href="{{ url('/myprofessions') }}" class="nav-item {{ request()->is('myprofessions*') ? 'active' : '' }}">
                <i class="fas fa-briefcase"></i>
                <span class="nav-item-text">Professions</span>
            </a>
            <a href="{{ url('/myqualification') }}" class="nav-item {{ request()->is('myqualification*') ? 'active' : '' }}">
                <i class="fas fa-graduation-cap"></i>
                <span class="nav-item-text">Qualifications</span>
            </a>
        </div>

        <!-- Content Section -->
        <div class="nav-section">
            <span class="nav-section-title">Content</span>
            @php
                $customerTheme = \App\Models\customer::find(session('FRONT_USER_ID'))?->profession_type;
            @endphp
            @if($customerTheme == 13)
            <a href="{{ url('/mymenu') }}" class="nav-item {{ request()->is('mymenu*') ? 'active' : '' }}">
                <i class="fas fa-utensils"></i>
                <span class="nav-item-text">Menu</span>
            </a>
            @endif
            <a href="{{ url('/myportfolio') }}" class="nav-item {{ request()->is('myportfolio*') ? 'active' : '' }}">
                <i class="fas fa-images"></i>
                <span class="nav-item-text">Portfolio</span>
            </a>
            <a href="{{ url('/myvideos') }}" class="nav-item {{ request()->is('myvideos*') ? 'active' : '' }}">
                <i class="fas fa-video"></i>
                <span class="nav-item-text">Videos</span>
            </a>
            <a href="{{ url('/myproducts') }}" class="nav-item {{ request()->is('myproducts*') ? 'active' : '' }}">
                <i class="fas fa-box"></i>
                <span class="nav-item-text">Products</span>
            </a>
            <a href="{{ url('/mythought') }}" class="nav-item {{ request()->is('mythought*') ? 'active' : '' }}">
                <i class="fas fa-lightbulb"></i>
                <span class="nav-item-text">Thoughts</span>
            </a>
        </div>

        @if($customerTheme == 13)
        <div class="nav-section">
            <span class="nav-section-title">Restaurant</span>
            <a href="{{ url('/user/restaurant/profiles') }}" class="nav-item {{ request()->is('user/restaurant/profiles*') ? 'active' : '' }}">
                <i class="fas fa-layer-group"></i>
                <span class="nav-item-text">Profiles</span>
            </a>
            <a href="{{ url('/user/restaurant/tables') }}" class="nav-item {{ request()->is('user/restaurant/tables*') ? 'active' : '' }}">
                <i class="fas fa-chair"></i>
                <span class="nav-item-text">Tables</span>
            </a>
            <a href="{{ url('/user/restaurant/rooms') }}" class="nav-item {{ request()->is('user/restaurant/rooms*') ? 'active' : '' }}">
                <i class="fas fa-bed"></i>
                <span class="nav-item-text">Rooms</span>
            </a>
            <a href="{{ url('/user/restaurant/orders') }}" class="nav-item {{ request()->is('user/restaurant/orders*') ? 'active' : '' }}">
                <i class="fas fa-receipt"></i>
                <span class="nav-item-text">Orders</span>
            </a>
            <a href="{{ url('/user/restaurant/events') }}" class="nav-item {{ request()->is('user/restaurant/events*') ? 'active' : '' }}">
                <i class="fas fa-calendar-day"></i>
                <span class="nav-item-text">Events</span>
            </a>
            <a href="{{ url('/user/restaurant/banquets') }}" class="nav-item {{ request()->is('user/restaurant/banquets*') ? 'active' : '' }}">
                <i class="fas fa-warehouse"></i>
                <span class="nav-item-text">Banquets</span>
            </a>
            <a href="{{ url('/user/restaurant/payments') }}" class="nav-item {{ request()->is('user/restaurant/payments*') ? 'active' : '' }}">
                <i class="fas fa-credit-card"></i>
                <span class="nav-item-text">Payments</span>
            </a>
            <a href="{{ url('/user/restaurant/kitchen') }}" class="nav-item {{ request()->is('user/restaurant/kitchen*') ? 'active' : '' }}">
                <i class="fas fa-fire"></i>
                <span class="nav-item-text">Kitchen</span>
            </a>
            <a href="{{ url('/user/restaurant/analytics') }}" class="nav-item {{ request()->is('user/restaurant/analytics*') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i>
                <span class="nav-item-text">Analytics</span>
            </a>
        </div>
        @endif

        @if($customerTheme == 8)
        <div class="nav-section">
            <span class="nav-section-title">Production</span>
            <a href="{{ url('/user/production/services') }}" class="nav-item {{ request()->is('user/production/services*') ? 'active' : '' }}">
                <i class="fas fa-clapperboard"></i>
                <span class="nav-item-text">Services</span>
            </a>
            <a href="{{ url('/user/production/projects') }}" class="nav-item {{ request()->is('user/production/projects*') ? 'active' : '' }}">
                <i class="fas fa-folder-open"></i>
                <span class="nav-item-text">Projects</span>
            </a>
            <a href="{{ url('/user/production/portfolios') }}" class="nav-item {{ request()->is('user/production/portfolios*') ? 'active' : '' }}">
                <i class="fas fa-photo-film"></i>
                <span class="nav-item-text">Portfolio</span>
            </a>
            <a href="{{ url('/user/production/team') }}" class="nav-item {{ request()->is('user/production/team*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span class="nav-item-text">Team</span>
            </a>
            <a href="{{ url('/user/production/payments') }}" class="nav-item {{ request()->is('user/production/payments*') ? 'active' : '' }}">
                <i class="fas fa-receipt"></i>
                <span class="nav-item-text">Payments</span>
            </a>
        </div>
        @endif

        @if($customerTheme == 10)
        <div class="nav-section">
            <span class="nav-section-title">Jewellery</span>
            <a href="{{ url('/user/jewellery/products') }}" class="nav-item {{ request()->is('user/jewellery/products*') ? 'active' : '' }}">
                <i class="fas fa-gem"></i>
                <span class="nav-item-text">Products</span>
            </a>
            <a href="{{ url('/user/jewellery/rates') }}" class="nav-item {{ request()->is('user/jewellery/rates*') ? 'active' : '' }}">
                <i class="fas fa-coins"></i>
                <span class="nav-item-text">Metal Rates</span>
            </a>
            <a href="{{ url('/user/jewellery/orders') }}" class="nav-item {{ request()->is('user/jewellery/orders*') ? 'active' : '' }}">
                <i class="fas fa-ring"></i>
                <span class="nav-item-text">Custom Orders</span>
            </a>
        </div>
        @endif

        @if($customerTheme == 11)
        <div class="nav-section">
            <span class="nav-section-title">Technology</span>
            <a href="{{ url('/user/tech/services') }}" class="nav-item {{ request()->is('user/tech/services*') ? 'active' : '' }}">
                <i class="fas fa-laptop-code"></i>
                <span class="nav-item-text">Services</span>
            </a>
            <a href="{{ url('/user/tech/projects') }}" class="nav-item {{ request()->is('user/tech/projects*') ? 'active' : '' }}">
                <i class="fas fa-briefcase"></i>
                <span class="nav-item-text">Projects</span>
            </a>
            <a href="{{ url('/user/tech/case-studies') }}" class="nav-item {{ request()->is('user/tech/case-studies*') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i>
                <span class="nav-item-text">Case Studies</span>
            </a>
        </div>
        @endif

        @if($customerTheme == 14)
        <div class="nav-section">
            <span class="nav-section-title">Travel</span>
            <a href="{{ url('/user/tour/packages') }}" class="nav-item {{ request()->is('user/tour/packages*') ? 'active' : '' }}">
                <i class="fas fa-suitcase-rolling"></i>
                <span class="nav-item-text">Packages</span>
            </a>
            <a href="{{ url('/user/tour/bookings') }}" class="nav-item {{ request()->is('user/tour/bookings*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span class="nav-item-text">Bookings</span>
            </a>
        </div>
        @endif

        @if($customerTheme == 15)
        <div class="nav-section">
            <span class="nav-section-title">Fitness</span>
            <a href="{{ url('/user/fitness/programs') }}" class="nav-item {{ request()->is('user/fitness/programs*') ? 'active' : '' }}">
                <i class="fas fa-dumbbell"></i>
                <span class="nav-item-text">Programs</span>
            </a>
            <a href="{{ url('/user/fitness/trainers') }}" class="nav-item {{ request()->is('user/fitness/trainers*') ? 'active' : '' }}">
                <i class="fas fa-user-ninja"></i>
                <span class="nav-item-text">Trainers</span>
            </a>
            <a href="{{ url('/user/fitness/memberships') }}" class="nav-item {{ request()->is('user/fitness/memberships*') ? 'active' : '' }}">
                <i class="fas fa-id-card"></i>
                <span class="nav-item-text">Memberships</span>
            </a>
            <a href="{{ url('/user/fitness/subscriptions') }}" class="nav-item {{ request()->is('user/fitness/subscriptions*') ? 'active' : '' }}">
                <i class="fas fa-user-check"></i>
                <span class="nav-item-text">Subscriptions</span>
            </a>
            <a href="{{ url('/user/fitness/classes') }}" class="nav-item {{ request()->is('user/fitness/classes*') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i>
                <span class="nav-item-text">Classes</span>
            </a>
            <a href="{{ url('/user/fitness/bookings') }}" class="nav-item {{ request()->is('user/fitness/bookings*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span class="nav-item-text">Bookings</span>
            </a>
            <a href="{{ url('/user/fitness/progress') }}" class="nav-item {{ request()->is('user/fitness/progress*') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i>
                <span class="nav-item-text">Progress</span>
            </a>
            <a href="{{ url('/user/fitness/transformations') }}" class="nav-item {{ request()->is('user/fitness/transformations*') ? 'active' : '' }}">
                <i class="fas fa-trophy"></i>
                <span class="nav-item-text">Transformations</span>
            </a>
            <a href="{{ url('/user/fitness/diet-plans') }}" class="nav-item {{ request()->is('user/fitness/diet-plans*') ? 'active' : '' }}">
                <i class="fas fa-apple-alt"></i>
                <span class="nav-item-text">Diet Plans</span>
            </a>
        </div>
        @endif

        @if($customerTheme == 16)
        <div class="nav-section">
            <span class="nav-section-title">Education</span>
            <a href="{{ url('/user/education/courses') }}" class="nav-item {{ request()->is('user/education/courses*') ? 'active' : '' }}">
                <i class="fas fa-book"></i>
                <span class="nav-item-text">Courses</span>
            </a>
            <a href="{{ url('/user/education/batches') }}" class="nav-item {{ request()->is('user/education/batches*') ? 'active' : '' }}">
                <i class="fas fa-layer-group"></i>
                <span class="nav-item-text">Batches</span>
            </a>
            <a href="{{ url('/user/education/faculty') }}" class="nav-item {{ request()->is('user/education/faculty*') ? 'active' : '' }}">
                <i class="fas fa-user-graduate"></i>
                <span class="nav-item-text">Faculty</span>
            </a>
            <a href="{{ url('/user/education/admissions') }}" class="nav-item {{ request()->is('user/education/admissions*') ? 'active' : '' }}">
                <i class="fas fa-clipboard-list"></i>
                <span class="nav-item-text">Admissions</span>
            </a>
            <a href="{{ url('/user/education/results') }}" class="nav-item {{ request()->is('user/education/results*') ? 'active' : '' }}">
                <i class="fas fa-trophy"></i>
                <span class="nav-item-text">Results</span>
            </a>
            <a href="{{ url('/user/education/materials') }}" class="nav-item {{ request()->is('user/education/materials*') ? 'active' : '' }}">
                <i class="fas fa-folder-open"></i>
                <span class="nav-item-text">Materials</span>
            </a>
            <a href="{{ url('/user/education/fee-structures') }}" class="nav-item {{ request()->is('user/education/fee-structures*') ? 'active' : '' }}">
                <i class="fas fa-receipt"></i>
                <span class="nav-item-text">Fee Structures</span>
            </a>
            <a href="{{ url('/user/education/student-fees') }}" class="nav-item {{ request()->is('user/education/student-fees*') ? 'active' : '' }}">
                <i class="fas fa-wallet"></i>
                <span class="nav-item-text">Student Fees</span>
            </a>
            <a href="{{ url('/user/education/attendance') }}" class="nav-item {{ request()->is('user/education/attendance*') ? 'active' : '' }}">
                <i class="fas fa-user-check"></i>
                <span class="nav-item-text">Attendance</span>
            </a>
            <a href="{{ url('/user/education/tests') }}" class="nav-item {{ request()->is('user/education/tests*') ? 'active' : '' }}">
                <i class="fas fa-clipboard-check"></i>
                <span class="nav-item-text">Tests</span>
            </a>
        </div>
        @endif

        @if($customerTheme == 17)
        <div class="nav-section">
            <span class="nav-section-title">Legal</span>
            <a href="{{ url('/user/lawyer/services') }}" class="nav-item {{ request()->is('user/lawyer/services*') ? 'active' : '' }}">
                <i class="fas fa-scale-balanced"></i>
                <span class="nav-item-text">Services</span>
            </a>
            <a href="{{ url('/user/lawyer/cases') }}" class="nav-item {{ request()->is('user/lawyer/cases*') ? 'active' : '' }}">
                <i class="fas fa-gavel"></i>
                <span class="nav-item-text">Cases</span>
            </a>
            <a href="{{ url('/user/lawyer/hearings') }}" class="nav-item {{ request()->is('user/lawyer/hearings*') ? 'active' : '' }}">
                <i class="fas fa-calendar-day"></i>
                <span class="nav-item-text">Hearings</span>
            </a>
            <a href="{{ url('/user/lawyer/consultations') }}" class="nav-item {{ request()->is('user/lawyer/consultations*') ? 'active' : '' }}">
                <i class="fas fa-user-clock"></i>
                <span class="nav-item-text">Consultations</span>
            </a>
        </div>
        @endif

        @if($customerTheme == 18)
        <div class="nav-section">
            <span class="nav-section-title">CA</span>
            <a href="{{ url('/user/ca/services') }}" class="nav-item {{ request()->is('user/ca/services*') ? 'active' : '' }}">
                <i class="fas fa-file-invoice"></i>
                <span class="nav-item-text">Services</span>
            </a>
            <a href="{{ url('/user/ca/cases') }}" class="nav-item {{ request()->is('user/ca/cases*') ? 'active' : '' }}">
                <i class="fas fa-folder-open"></i>
                <span class="nav-item-text">Cases</span>
            </a>
            <a href="{{ url('/user/ca/consultations') }}" class="nav-item {{ request()->is('user/ca/consultations*') ? 'active' : '' }}">
                <i class="fas fa-user-clock"></i>
                <span class="nav-item-text">Consultations</span>
            </a>
            <a href="{{ url('/user/ca/deadlines') }}" class="nav-item {{ request()->is('user/ca/deadlines*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span class="nav-item-text">Deadlines</span>
            </a>
        </div>
        @endif

        @if($customerTheme == 19)
        <div class="nav-section">
            <span class="nav-section-title">Salon</span>
            <a href="{{ url('/user/salon/services') }}" class="nav-item {{ request()->is('user/salon/services*') ? 'active' : '' }}">
                <i class="fas fa-list-check"></i>
                <span class="nav-item-text">Services</span>
            </a>
            <a href="{{ url('/user/salon/artists') }}" class="nav-item {{ request()->is('user/salon/artists*') ? 'active' : '' }}">
                <i class="fas fa-user-astronaut"></i>
                <span class="nav-item-text">Artists</span>
            </a>
            <a href="{{ url('/user/salon/appointments') }}" class="nav-item {{ request()->is('user/salon/appointments*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span class="nav-item-text">Appointments</span>
            </a>
            <a href="{{ url('/user/salon/packages') }}" class="nav-item {{ request()->is('user/salon/packages*') ? 'active' : '' }}">
                <i class="fas fa-gift"></i>
                <span class="nav-item-text">Packages</span>
            </a>
            <a href="{{ url('/user/salon/portfolio') }}" class="nav-item {{ request()->is('user/salon/portfolio*') ? 'active' : '' }}">
                <i class="fas fa-images"></i>
                <span class="nav-item-text">Portfolio</span>
            </a>
            <a href="{{ url('/user/salon/products') }}" class="nav-item {{ request()->is('user/salon/products*') ? 'active' : '' }}">
                <i class="fas fa-box"></i>
                <span class="nav-item-text">Products</span>
            </a>
        </div>
        @endif

        @if($customerTheme == 24)
        <div class="nav-section">
            <span class="nav-section-title">Political</span>
            <a href="{{ url('/user/political/profiles') }}" class="nav-item {{ request()->is('user/political/profiles*') ? 'active' : '' }}">
                <i class="fas fa-id-badge"></i>
                <span class="nav-item-text">Profiles</span>
            </a>
            <a href="{{ url('/user/political/grievances') }}" class="nav-item {{ request()->is('user/political/grievances*') ? 'active' : '' }}">
                <i class="fas fa-comments"></i>
                <span class="nav-item-text">Grievances</span>
            </a>
            <a href="{{ url('/user/political/services') }}" class="nav-item {{ request()->is('user/political/services*') ? 'active' : '' }}">
                <i class="fas fa-hand-holding-heart"></i>
                <span class="nav-item-text">Services</span>
            </a>
            <a href="{{ url('/user/political/projects') }}" class="nav-item {{ request()->is('user/political/projects*') ? 'active' : '' }}">
                <i class="fas fa-road"></i>
                <span class="nav-item-text">Projects</span>
            </a>
            <a href="{{ url('/user/political/events') }}" class="nav-item {{ request()->is('user/political/events*') ? 'active' : '' }}">
                <i class="fas fa-calendar"></i>
                <span class="nav-item-text">Events</span>
            </a>
            <a href="{{ url('/user/political/volunteers') }}" class="nav-item {{ request()->is('user/political/volunteers*') ? 'active' : '' }}">
                <i class="fas fa-people-group"></i>
                <span class="nav-item-text">Volunteers</span>
            </a>
        </div>
        @endif

        @if($customerTheme == 20)
        <div class="nav-section">
            <span class="nav-section-title">Interior</span>
            <a href="{{ url('/user/interior/services') }}" class="nav-item {{ request()->is('user/interior/services*') ? 'active' : '' }}">
                <i class="fas fa-list-check"></i>
                <span class="nav-item-text">Services</span>
            </a>
            <a href="{{ url('/user/interior/projects') }}" class="nav-item {{ request()->is('user/interior/projects*') ? 'active' : '' }}">
                <i class="fas fa-briefcase"></i>
                <span class="nav-item-text">Projects</span>
            </a>
            <a href="{{ url('/user/interior/portfolio') }}" class="nav-item {{ request()->is('user/interior/portfolio*') ? 'active' : '' }}">
                <i class="fas fa-images"></i>
                <span class="nav-item-text">Portfolio</span>
            </a>
            <a href="{{ url('/user/interior/consultations') }}" class="nav-item {{ request()->is('user/interior/consultations*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span class="nav-item-text">Consultations</span>
            </a>
        </div>
        @endif

        @if($customerTheme == 23)
        <div class="nav-section">
            <span class="nav-section-title">Astrologer</span>
            <a href="{{ url('/user/astrologer/services') }}" class="nav-item {{ request()->is('user/astrologer/services*') ? 'active' : '' }}">
                <i class="fas fa-star"></i>
                <span class="nav-item-text">Services</span>
            </a>
            <a href="{{ url('/user/astrologer/consultations') }}" class="nav-item {{ request()->is('user/astrologer/consultations*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span class="nav-item-text">Consultations</span>
            </a>
            <a href="{{ url('/user/astrologer/reports') }}" class="nav-item {{ request()->is('user/astrologer/reports*') ? 'active' : '' }}">
                <i class="fas fa-file-lines"></i>
                <span class="nav-item-text">Reports</span>
            </a>
        </div>
        @endif

        @if($customerTheme == 22)
        <div class="nav-section">
            <span class="nav-section-title">Security</span>
            <a href="{{ url('/user/security/products') }}" class="nav-item {{ request()->is('user/security/products*') ? 'active' : '' }}">
                <i class="fas fa-video"></i>
                <span class="nav-item-text">Products</span>
            </a>
            <a href="{{ url('/user/security/surveys') }}" class="nav-item {{ request()->is('user/security/surveys*') ? 'active' : '' }}">
                <i class="fas fa-clipboard-list"></i>
                <span class="nav-item-text">Surveys</span>
            </a>
            <a href="{{ url('/user/security/projects') }}" class="nav-item {{ request()->is('user/security/projects*') ? 'active' : '' }}">
                <i class="fas fa-briefcase"></i>
                <span class="nav-item-text">Projects</span>
            </a>
            <a href="{{ url('/user/security/amc') }}" class="nav-item {{ request()->is('user/security/amc*') ? 'active' : '' }}">
                <i class="fas fa-wrench"></i>
                <span class="nav-item-text">AMC</span>
            </a>
        </div>
        @endif

        @if($customerTheme == 25)
        <div class="nav-section">
            <span class="nav-section-title">Influencer</span>
            <a href="{{ url('/user/influencer/stats') }}" class="nav-item {{ request()->is('user/influencer/stats*') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i>
                <span class="nav-item-text">Stats</span>
            </a>
            <a href="{{ url('/user/influencer/collaborations') }}" class="nav-item {{ request()->is('user/influencer/collaborations*') ? 'active' : '' }}">
                <i class="fas fa-handshake"></i>
                <span class="nav-item-text">Collaborations</span>
            </a>
            <a href="{{ url('/user/influencer/portfolio') }}" class="nav-item {{ request()->is('user/influencer/portfolio*') ? 'active' : '' }}">
                <i class="fas fa-images"></i>
                <span class="nav-item-text">Portfolio</span>
            </a>
        </div>
        @endif

        @if($customerTheme == 21)
        <div class="nav-section">
            <span class="nav-section-title">Solar</span>
            <a href="{{ url('/user/solar/solutions') }}" class="nav-item {{ request()->is('user/solar/solutions*') ? 'active' : '' }}">
                <i class="fas fa-solar-panel"></i>
                <span class="nav-item-text">Solutions</span>
            </a>
            <a href="{{ url('/user/solar/surveys') }}" class="nav-item {{ request()->is('user/solar/surveys*') ? 'active' : '' }}">
                <i class="fas fa-clipboard-list"></i>
                <span class="nav-item-text">Surveys</span>
            </a>
            <a href="{{ url('/user/solar/projects') }}" class="nav-item {{ request()->is('user/solar/projects*') ? 'active' : '' }}">
                <i class="fas fa-screwdriver-wrench"></i>
                <span class="nav-item-text">Projects</span>
            </a>
            <a href="{{ url('/user/solar/monitoring') }}" class="nav-item {{ request()->is('user/solar/monitoring*') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i>
                <span class="nav-item-text">Monitoring</span>
            </a>
            <a href="{{ url('/user/solar/amc') }}" class="nav-item {{ request()->is('user/solar/amc*') ? 'active' : '' }}">
                <i class="fas fa-wrench"></i>
                <span class="nav-item-text">AMC</span>
            </a>
        </div>
        @endif

        <!-- Medical Features (Theme 1: Medical) -->
        @if($customerTheme == 1)
        <div class="nav-section">
            <span class="nav-section-title">Medical</span>
            <a href="{{ url('/user/medical/profiles') }}" class="nav-item {{ request()->is('user/medical/profiles*') ? 'active' : '' }}">
                <i class="fas fa-hospital-user"></i>
                <span class="nav-item-text">Medical Profiles</span>
            </a>
            <a href="{{ url('/user/medical/appointments') }}" class="nav-item {{ request()->is('user/medical/appointments*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span class="nav-item-text">Appointments</span>
            </a>
            <a href="{{ url('/user/medical/payments') }}" class="nav-item {{ request()->is('user/medical/payments*') ? 'active' : '' }}">
                <i class="fas fa-rupee-sign"></i>
                <span class="nav-item-text">Payments</span>
            </a>
            <a href="{{ url('/user/medical/reviews') }}" class="nav-item {{ request()->is('user/medical/reviews*') ? 'active' : '' }}">
                <i class="fas fa-star"></i>
                <span class="nav-item-text">Reviews</span>
            </a>
        </div>
        @endif

        <!-- Creative/Photographer Features (Theme 2: Creative) -->
        @if($customerTheme == 2)
        <div class="nav-section">
            <span class="nav-section-title">Photography</span>
            <a href="{{ url('/user/creative/packages') }}" class="nav-item {{ request()->is('user/creative/packages*') ? 'active' : '' }}">
                <i class="fas fa-box-open"></i>
                <span class="nav-item-text">Packages</span>
            </a>
            <a href="{{ url('/user/creative/bookings') }}" class="nav-item {{ request()->is('user/creative/bookings*') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i>
                <span class="nav-item-text">Bookings</span>
            </a>
            <a href="{{ url('/user/creative/portfolio') }}" class="nav-item {{ request()->is('user/creative/portfolio*') ? 'active' : '' }}">
                <i class="fas fa-folder"></i>
                <span class="nav-item-text">Portfolio Categories</span>
            </a>
        </div>
        @endif

        <!-- Real Estate Features (Theme 6: Real Estate) -->
        @if($customerTheme == 6)
        <div class="nav-section">
            <span class="nav-section-title">Real Estate</span>
            <a href="{{ url('/user/real-estate/profiles') }}" class="nav-item {{ request()->is('user/real-estate/profiles*') ? 'active' : '' }}">
                <i class="fas fa-building"></i>
                <span class="nav-item-text">Property Profiles</span>
            </a>
            <a href="{{ url('/user/real-estate/properties') }}" class="nav-item {{ request()->is('user/real-estate/properties*') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span class="nav-item-text">Properties</span>
            </a>
            <a href="{{ url('/user/real-estate/site-visits') }}" class="nav-item {{ request()->is('user/real-estate/site-visits*') ? 'active' : '' }}">
                <i class="fas fa-walking"></i>
                <span class="nav-item-text">Site Visits</span>
            </a>
            <a href="{{ url('/user/real-estate/location-tracking') }}" class="nav-item {{ request()->is('user/real-estate/location-tracking*') ? 'active' : '' }}">
                <i class="fas fa-map-marker-alt"></i>
                <span class="nav-item-text">Location Tracking</span>
            </a>
        </div>
        @endif

        <!-- Talent/Entertainment Features (Theme 7: Entertainment) -->
        @if($customerTheme == 7)
        <div class="nav-section">
            <span class="nav-section-title">Talent</span>
            <a href="{{ url('/user/talent/profiles') }}" class="nav-item {{ request()->is('user/talent/profiles*') ? 'active' : '' }}">
                <i class="fas fa-theater-masks"></i>
                <span class="nav-item-text">Talent Profiles</span>
            </a>
            <a href="{{ url('/user/talent/portfolio') }}" class="nav-item {{ request()->is('user/talent/portfolio*') ? 'active' : '' }}">
                <i class="fas fa-film"></i>
                <span class="nav-item-text">Portfolio</span>
            </a>
            <a href="{{ url('/user/talent/bookings') }}" class="nav-item {{ request()->is('user/talent/bookings*') ? 'active' : '' }}">
                <i class="fas fa-ticket-alt"></i>
                <span class="nav-item-text">Bookings</span>
            </a>
            <a href="{{ url('/user/talent/social-stats') }}" class="nav-item {{ request()->is('user/talent/social-stats*') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i>
                <span class="nav-item-text">Social Stats</span>
            </a>
        </div>
        @endif

        <!-- E-Commerce Store (if enabled for user) -->
        @php
            $customer = \App\Models\customer::find(session('FRONT_USER_ID'));
            $storeEnabled = $customer?->userStoreSetting?->store_enabled ?? false;
        @endphp
        @if($storeEnabled)
        <div class="nav-section">
            <span class="nav-section-title">My Store</span>
            <a href="{{ url('/user/products') }}" class="nav-item {{ request()->is('user/products*') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i>
                <span class="nav-item-text">My Products</span>
            </a>
            <a href="{{ url('/user/store-settings') }}" class="nav-item {{ request()->is('user/store-settings*') ? 'active' : '' }}">
                <i class="fas fa-cog"></i>
                <span class="nav-item-text">Store Settings</span>
            </a>
        </div>
        @endif

        <!-- Social Section -->
        <div class="nav-section">
            <span class="nav-section-title">Social</span>
            <a href="{{ url('/mysocial') }}" class="nav-item {{ request()->is('mysocial*') ? 'active' : '' }}">
                <i class="fas fa-share-alt"></i>
                <span class="nav-item-text">Social Links</span>
            </a>
        </div>

        <!-- Settings Section -->
        <div class="nav-section">
            <span class="nav-section-title">Settings</span>
            <a href="{{ url('/profile-settings/visibility') }}" class="nav-item {{ request()->is('profile-settings/visibility') ? 'active' : '' }}">
                <i class="fas fa-eye"></i>
                <span class="nav-item-text">Feature Visibility</span>
            </a>
            <a href="{{ url('/changepassword') }}" class="nav-item {{ request()->is('changepassword') ? 'active' : '' }}">
                <i class="fas fa-lock"></i>
                <span class="nav-item-text">Change Password</span>
            </a>
            <a href="{{ url('/logout') }}" class="nav-item">
                <i class="fas fa-sign-out-alt"></i>
                <span class="nav-item-text">Logout</span>
            </a>
        </div>
    </nav>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-user-avatar">
                @if($customer?->profile)
                    <img src="{{ asset('public/frontend/user_images/' . $customer->profile) }}" alt="Profile">
                @else
                    <img src="{{ asset('assets/images/avatars/default.png') }}" alt="Profile">
                @endif
            </div>
            <div class="sidebar-user-info">
                <span class="sidebar-user-name">{{ session('FRONT_USER_NAME', 'User') }}</span>
                <span class="sidebar-user-role">Member</span>
            </div>
        </div>
    </div>
</aside>
