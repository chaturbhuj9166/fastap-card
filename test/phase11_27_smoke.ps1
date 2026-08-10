$ErrorActionPreference = 'Stop'

$BaseUrl = 'http://127.0.0.1:8000'
$Email = 'testuser@example.com'
$Password = 'password123'

$session = New-Object Microsoft.PowerShell.Commands.WebRequestSession
$TestLog = New-Object System.Collections.Generic.List[object]

function Add-Result($name, $ok, $detail) {
    $TestLog.Add([pscustomobject]@{ Name = $name; Ok = $ok; Detail = $detail })
}

function Get-TokenFromHtml([string]$html) {
    if (-not $html) { return $null }
    $m = [regex]::Match($html, 'name="_token"\s+value="([^"]+)"')
    if ($m.Success) { return $m.Groups[1].Value }
    $m = [regex]::Match($html, 'name="csrf-token"\s+content="([^"]+)"')
    if ($m.Success) { return $m.Groups[1].Value }
    return $null
}

function Get-FirstMatch([string]$html, [string]$pattern) {
    if (-not $html) { return $null }
    $m = [regex]::Match($html, $pattern)
    if ($m.Success) { return $m.Groups[1].Value }
    return $null
}

function Invoke-Get($name, $path) {
    $url = $BaseUrl + $path
    try {
        $resp = Invoke-WebRequest -Uri $url -Method Get -WebSession $session -UseBasicParsing
        $ok = $resp.StatusCode -in 200,302
        Add-Result $name $ok "GET $path => $($resp.StatusCode)"
        return $resp
    } catch {
        $statusCode = $_.Exception.Response.StatusCode.value__ 2>$null
        $detail = "GET $path failed: $($_.Exception.Message)"
        if ($statusCode) { $detail += " (HTTP $statusCode)" }
        Add-Result $name $false $detail
        return $null
    }
}

function Invoke-Post($name, $path, $body) {
    $url = $BaseUrl + $path
    try {
        $resp = Invoke-WebRequest -Uri $url -Method Post -WebSession $session -UseBasicParsing -ContentType 'application/x-www-form-urlencoded' -Body $body
        $ok = $resp.StatusCode -in 200,302
        Add-Result $name $ok "POST $path => $($resp.StatusCode)"
        return $null
    } catch {
        $statusCode = $_.Exception.Response.StatusCode.value__ 2>$null
        $detail = "POST $path failed: $($_.Exception.Message)"
        if ($statusCode) { $detail += " (HTTP $statusCode)" }
        Add-Result $name $false $detail
        return $null
    }
}

function Invoke-PostForm($name, $path, $form) {
    $url = $BaseUrl + $path
    try {
        $resp = Invoke-WebRequest -Uri $url -Method Post -WebSession $session -Form $form -UseBasicParsing
        $ok = $resp.StatusCode -in 200,302
        Add-Result $name $ok "POST $path => $($resp.StatusCode)"
        return $null
    } catch {
        $statusCode = $_.Exception.Response.StatusCode.value__ 2>$null
        $detail = "POST $path failed: $($_.Exception.Message)"
        if ($statusCode) { $detail += " (HTTP $statusCode)" }
        Add-Result $name $false $detail
        return $null
    }
}
function Switch-Theme($themeId) {
    $page = Invoke-Get "Theme page" '/profile-theme'
    $token = Get-TokenFromHtml $page.Content
    if (-not $token) {
        Add-Result "Theme switch $themeId" $false 'CSRF token missing'
        return
    }
    Invoke-Post "Theme switch $themeId" '/profile-theme/select' @{ _token = $token; theme_id = $themeId }
}

function Invoke-PostWithHeaders($name, $path, $body, $headers) {
    $url = $BaseUrl + $path
    try {
        $resp = Invoke-WebRequest -Uri $url -Method Post -WebSession $session -UseBasicParsing -ContentType 'application/x-www-form-urlencoded' -Headers $headers -Body $body
        $ok = $resp.StatusCode -in 200,302
        Add-Result $name $ok "POST $path => $($resp.StatusCode)"
        return $null
    } catch {
        $statusCode = $_.Exception.Response.StatusCode.value__ 2>$null
        $detail = "POST $path failed: $($_.Exception.Message)"
        if ($statusCode) { $detail += " (HTTP $statusCode)" }
        Add-Result $name $false $detail
        return $null
    }
}
# Start local server (per DEPLOYMENT_GUIDE.md)
$server = Start-Process -FilePath php -ArgumentList @('-S','127.0.0.1:8000','-t','D:\my-files\technix-digital\projects\fastap\repo') -PassThru
$serverReady = $false
for ($i = 0; $i -lt 10; $i++) {
    try {
        Invoke-WebRequest -Uri ($BaseUrl + '/Login') -Method Get -WebSession $session -UseBasicParsing | Out-Null
        $serverReady = $true
        break
    } catch {
        Start-Sleep -Milliseconds 500
    }
}
if (-not $serverReady) {
    Stop-Process -Id $server.Id -Force -ErrorAction SilentlyContinue
    throw 'Server did not become ready on http://127.0.0.1:8000'
}

# Login
$loginPage = Invoke-Get 'Login page' '/Login'
$loginToken = Get-TokenFromHtml $loginPage.Content
if (-not $loginToken) { throw 'Login CSRF token missing' }
Invoke-Post 'Login submit' '/loginuser/login_store' @{ _token = $loginToken; email = $Email; password = $Password }

# Get profile theme page and slug
$profileTheme = Invoke-Get 'Profile theme' '/profile-theme'
$slugLinkMatch = [regex]::Match($profileTheme.Content, 'href="([^"]+)"[^>]*>\s*<i[^>]*>\s*</i>\s*View Live Profile', [System.Text.RegularExpressions.RegexOptions]::Singleline)
$slugUrl = if ($slugLinkMatch.Success) { $slugLinkMatch.Groups[1].Value } else { $null }
if (-not $slugUrl) {
    $slugUrl = Get-FirstMatch $profileTheme.Content ('href="' + [regex]::Escape($BaseUrl) + '/([^"/]+)"')
    if ($slugUrl) { $slugUrl = "$BaseUrl/$slugUrl" }
}
if (-not $slugUrl) { throw 'Profile slug not found' }
$slug = ($slugUrl -split '/')[-1]

# Phase 11 - Restaurant (theme 13)
Switch-Theme 13
$null = Invoke-Get 'Restaurant profiles' '/user/restaurant/profiles'
$token = Get-TokenFromHtml (Invoke-Get 'Restaurant profiles for token' '/user/restaurant/profiles').Content
Invoke-Post 'Restaurant profile create' '/user/restaurant/profiles' @{ _token = $token; profile_type = 'restaurant'; profile_name = 'Test Restaurant' }

$tablesPage = Invoke-Get 'Restaurant tables' '/user/restaurant/tables'
$token = Get-TokenFromHtml $tablesPage.Content
$tableNumber = 'T-' + (Get-Random -Minimum 100 -Maximum 999)
Invoke-Post 'Restaurant table create' '/user/restaurant/tables' @{ _token = $token; table_number = $tableNumber; table_type = '4-seater'; seating_capacity = 4 }
$tablesPage = Invoke-Get 'Restaurant tables refresh' '/user/restaurant/tables'
$tableId = Get-FirstMatch $tablesPage.Content 'user/restaurant/tables/(\d+)'

$roomsPage = Invoke-Get 'Restaurant rooms' '/user/restaurant/rooms'
$token = Get-TokenFromHtml $roomsPage.Content
$roomNumber = 'R-' + (Get-Random -Minimum 100 -Maximum 999)
Invoke-Post 'Restaurant room create' '/user/restaurant/rooms' @{ _token = $token; room_number = $roomNumber; room_type = 'Deluxe' }
$roomsPage = Invoke-Get 'Restaurant rooms refresh' '/user/restaurant/rooms'
$roomId = Get-FirstMatch $roomsPage.Content 'user/restaurant/rooms/(\d+)'

$null = Invoke-Get 'Restaurant orders' '/user/restaurant/orders'
$null = Invoke-Get 'Restaurant events' '/user/restaurant/events'
$null = Invoke-Get 'Restaurant banquets' '/user/restaurant/banquets'
$banquetsPage = Invoke-Get 'Restaurant banquets create page' '/user/restaurant/banquets/create'
$token = Get-TokenFromHtml $banquetsPage.Content
Invoke-Post 'Restaurant banquet create' '/user/restaurant/banquets' @{ _token = $token; hall_name = 'Grand Hall'; capacity_min = 50; capacity_max = 200 }
$null = Invoke-Get 'Restaurant payments' '/user/restaurant/payments'
$null = Invoke-Get 'Restaurant kitchen' '/user/restaurant/kitchen'
$null = Invoke-Get 'Restaurant analytics' '/user/restaurant/analytics'

# Menu management (restaurant theme)
$mymenu = Invoke-Get 'Menu management' '/mymenu'
$categoryCreate = Invoke-Get 'Menu category create page' '/mymenu/category/create'
$token = Get-TokenFromHtml $categoryCreate.Content
$categoryName = 'Starters ' + (Get-Random -Minimum 1000 -Maximum 9999)
$headers = @{ 'X-CSRF-TOKEN' = $token }
Invoke-PostWithHeaders 'Menu category create' '/mymenu/category/store' @{ _token = $token; name = $categoryName; description = 'Test category' } $headers
$mymenu = Invoke-Get 'Menu management refresh' '/mymenu'
$categoryId = Get-FirstMatch $mymenu.Content 'mymenu/category/(\d+)/items'
if ($categoryId) {
    $itemsPage = Invoke-Get 'Menu category items' ("/mymenu/category/$categoryId/items")
    $token = Get-TokenFromHtml $itemsPage.Content
    if ($token) {
        $headers = @{ 'X-CSRF-TOKEN' = $token }
        Invoke-PostWithHeaders 'Menu item create' '/mymenu/item/store' @{ _token = $token; name = 'Test Item'; category_id = $categoryId; price = 199 } $headers
    } else {
        Add-Result 'Menu item create' $false 'CSRF token missing on items page'
    }
    $itemsPage = Invoke-Get 'Menu category items refresh' ("/mymenu/category/$categoryId/items")
    $menuItemId = Get-FirstMatch $itemsPage.Content 'mymenu/item/(\d+)/edit'
}

# Public restaurant flows
if ($tableId -and $menuItemId) {
    $tableForm = Invoke-Get 'Public table order form' ("/$slug/table-order?table=$tableId")
    $token = Get-TokenFromHtml $tableForm.Content
    Invoke-Post 'Public table order submit' ("/$slug/table-order") @{ _token = $token; table_id = $tableId; ("items[$menuItemId]") = 1; notes = 'Test order' }
}
if ($roomId -and $menuItemId) {
    $roomForm = Invoke-Get 'Public room service form' ("/$slug/room-service?room=$roomId")
    $token = Get-TokenFromHtml $roomForm.Content
    Invoke-Post 'Public room service submit' ("/$slug/room-service") @{ _token = $token; room_id = $roomId; service_type = 'meal'; ("items[$menuItemId]") = 1; notes = 'Test room order' }
}
$eventForm = Invoke-Get 'Public event booking form' ("/$slug/event-booking")
$token = Get-TokenFromHtml $eventForm.Content
Invoke-Post 'Public event booking submit' ("/$slug/event-booking") @{ _token = $token; client_name = 'Event Client'; client_mobile = '9999999999'; event_type = 'Conference'; event_date = '2026-02-01' }

# Phase 12 - Production (theme 8)
Switch-Theme 8
$services = Invoke-Get 'Production services' '/user/production/services'
$token = Get-TokenFromHtml $services.Content
Invoke-Post 'Production service create' '/user/production/services' @{ _token = $token; category = 'Video'; service_name = 'Promo Shoot' }
$projects = Invoke-Get 'Production projects' '/user/production/projects'
$token = Get-TokenFromHtml $projects.Content
Invoke-Post 'Production project create' '/user/production/projects' @{ _token = $token; client_name = 'Acme Studio' }
$portfolios = Invoke-Get 'Production portfolios' '/user/production/portfolios'
$token = Get-TokenFromHtml $portfolios.Content
Invoke-Post 'Production portfolio create' '/user/production/portfolios' @{ _token = $token; project_title = 'Showreel' }
$team = Invoke-Get 'Production team' '/user/production/team'
$token = Get-TokenFromHtml $team.Content
Invoke-Post 'Production team create' '/user/production/team' @{ _token = $token; member_name = 'Jane Doe' }
$payments = Invoke-Get 'Production payments' '/user/production/payments'
$token = Get-TokenFromHtml $payments.Content
Invoke-Post 'Production payment create' '/user/production/payments' @{ _token = $token; amount = 100; payment_status = 'pending' }

$productionForm = Invoke-Get 'Public production booking form' ("/$slug/production-booking")
$token = Get-TokenFromHtml $productionForm.Content
Invoke-Post 'Public production booking submit' ("/$slug/production-booking") @{ _token = $token; client_name = 'Public Client'; client_mobile = '9999999999' }

# Phase 13 - Jewellery (theme 10)
Switch-Theme 10
$products = Invoke-Get 'Jewellery products' '/user/jewellery/products'
$token = Get-TokenFromHtml $products.Content
Invoke-Post 'Jewellery product create' '/user/jewellery/products' @{ _token = $token; category = 'Ring'; product_name = 'Diamond Ring' }
$rates = Invoke-Get 'Jewellery rates' '/user/jewellery/rates'
$token = Get-TokenFromHtml $rates.Content
Invoke-Post 'Jewellery rate create' '/user/jewellery/rates' @{ _token = $token; metal_type = 'Gold'; rate_per_gram = 5000 }
$orders = Invoke-Get 'Jewellery orders' '/user/jewellery/orders'
$token = Get-TokenFromHtml $orders.Content
Invoke-Post 'Jewellery order create' '/user/jewellery/orders' @{ _token = $token; client_name = 'Custom Client' }
$publicJewellery = Invoke-Get 'Public jewellery order form' ("/$slug/jewellery-order")
$token = Get-TokenFromHtml $publicJewellery.Content
Invoke-Post 'Public jewellery order submit' ("/$slug/jewellery-order") @{ _token = $token; client_name = 'Public Client'; client_mobile = '9999999999' }

# Phase 14 - Tech (theme 11)
Switch-Theme 11
$techServices = Invoke-Get 'Tech services' '/user/tech/services'
$token = Get-TokenFromHtml $techServices.Content
Invoke-Post 'Tech service create' '/user/tech/services' @{ _token = $token; service_category = 'Web'; service_name = 'Web App' }
$techProjects = Invoke-Get 'Tech projects' '/user/tech/projects'
$token = Get-TokenFromHtml $techProjects.Content
Invoke-Post 'Tech project create' '/user/tech/projects' @{ _token = $token; client_name = 'Tech Client' }
$caseStudies = Invoke-Get 'Tech case studies' '/user/tech/case-studies'
$token = Get-TokenFromHtml $caseStudies.Content
Invoke-Post 'Tech case study create' '/user/tech/case-studies' @{ _token = $token; title = 'Case Study 1' }
$techInquiry = Invoke-Get 'Public tech inquiry form' ("/$slug/tech-inquiry")
$token = Get-TokenFromHtml $techInquiry.Content
Invoke-Post 'Public tech inquiry submit' ("/$slug/tech-inquiry") @{ _token = $token; client_name = 'Public Client'; client_email = 'public@example.com' }

# Phase 15 - Tour (theme 14)
Switch-Theme 14
$packages = Invoke-Get 'Tour packages' '/user/tour/packages'
$token = Get-TokenFromHtml $packages.Content
Invoke-Post 'Tour package create' '/user/tour/packages' @{ _token = $token; package_name = 'Goa Trip' }
$bookings = Invoke-Get 'Tour bookings' '/user/tour/bookings'
$token = Get-TokenFromHtml $bookings.Content
Invoke-Post 'Tour booking create' '/user/tour/bookings' @{ _token = $token; client_name = 'Tour Client' }
$publicTour = Invoke-Get 'Public tour booking form' ("/$slug/tour-booking")
$token = Get-TokenFromHtml $publicTour.Content
Invoke-Post 'Public tour booking submit' ("/$slug/tour-booking") @{ _token = $token; client_name = 'Public Client'; client_mobile = '9999999999' }

# Phase 16 - Fitness (theme 15)
Switch-Theme 15
$trainers = Invoke-Get 'Fitness trainers' '/user/fitness/trainers'
$token = Get-TokenFromHtml $trainers.Content
Invoke-Post 'Fitness trainer create' '/user/fitness/trainers' @{ _token = $token; trainer_name = 'Trainer One' }
$programs = Invoke-Get 'Fitness programs' '/user/fitness/programs'
$token = Get-TokenFromHtml $programs.Content
Invoke-Post 'Fitness program create' '/user/fitness/programs' @{ _token = $token; program_type = 'Yoga'; program_name = 'Morning Flow' }
$memberships = Invoke-Get 'Fitness memberships' '/user/fitness/memberships'
$token = Get-TokenFromHtml $memberships.Content
Invoke-Post 'Fitness membership create' '/user/fitness/memberships' @{ _token = $token; plan_name = 'Monthly Plan' }
$subscriptions = Invoke-Get 'Fitness subscriptions' '/user/fitness/subscriptions'
$token = Get-TokenFromHtml $subscriptions.Content
Invoke-Post 'Fitness subscription create' '/user/fitness/subscriptions' @{ _token = $token; member_name = 'Member One' }
$classes = Invoke-Get 'Fitness classes' '/user/fitness/classes'
$token = Get-TokenFromHtml $classes.Content
Invoke-Post 'Fitness class create' '/user/fitness/classes' @{ _token = $token; class_name = 'HIIT Class' }
$bookings = Invoke-Get 'Fitness bookings' '/user/fitness/bookings'
$token = Get-TokenFromHtml $bookings.Content
Invoke-Post 'Fitness booking create' '/user/fitness/bookings' @{ _token = $token; member_name = 'Member Two' }
$progress = Invoke-Get 'Fitness progress' '/user/fitness/progress'
$token = Get-TokenFromHtml $progress.Content
Invoke-Post 'Fitness progress create' '/user/fitness/progress' @{ _token = $token; member_mobile = '9999999999'; assessment_date = '2026-02-01' }
$transformations = Invoke-Get 'Fitness transformations' '/user/fitness/transformations'
$token = Get-TokenFromHtml $transformations.Content
Invoke-Post 'Fitness transformation create' '/user/fitness/transformations' @{ _token = $token; member_name = 'Member Three' }
$dietPlans = Invoke-Get 'Fitness diet plans' '/user/fitness/diet-plans'
$token = Get-TokenFromHtml $dietPlans.Content
Invoke-Post 'Fitness diet plan create' '/user/fitness/diet-plans' @{ _token = $token; plan_name = 'Lean Plan' }
$publicFitness = Invoke-Get 'Public fitness booking form' ("/$slug/fitness-booking")
$token = Get-TokenFromHtml $publicFitness.Content
Invoke-Post 'Public fitness booking submit' ("/$slug/fitness-booking") @{ _token = $token; member_name = 'Public Member'; member_mobile = '9999999999' }

# Phase 17 - Lawyer (theme 17)
Switch-Theme 17
$lawServices = Invoke-Get 'Lawyer services' '/user/lawyer/services'
$token = Get-TokenFromHtml $lawServices.Content
Invoke-Post 'Lawyer service create' '/user/lawyer/services' @{ _token = $token; practice_area = 'Civil' }
$lawCases = Invoke-Get 'Lawyer cases' '/user/lawyer/cases'
$token = Get-TokenFromHtml $lawCases.Content
Invoke-Post 'Lawyer case create' '/user/lawyer/cases' @{ _token = $token; client_name = 'Case Client' }
$lawCases = Invoke-Get 'Lawyer cases refresh' '/user/lawyer/cases'
$caseId = Get-FirstMatch $lawCases.Content 'user/lawyer/cases/(\d+)/status'
$hearings = Invoke-Get 'Lawyer hearings' '/user/lawyer/hearings'
$token = Get-TokenFromHtml $hearings.Content
if ($caseId) {
    Invoke-Post 'Lawyer hearing create' '/user/lawyer/hearings' @{ _token = $token; case_id = $caseId; hearing_date = '2026-02-10' }
}
$consultations = Invoke-Get 'Lawyer consultations' '/user/lawyer/consultations'
$token = Get-TokenFromHtml $consultations.Content
Invoke-Post 'Lawyer consultation create' '/user/lawyer/consultations' @{ _token = $token; client_name = 'Consult Client' }
$publicLaw = Invoke-Get 'Public lawyer consultation form' ("/$slug/legal-consultation")
$token = Get-TokenFromHtml $publicLaw.Content
Invoke-Post 'Public lawyer consultation submit' ("/$slug/legal-consultation") @{ _token = $token; client_name = 'Public Client'; client_mobile = '9999999999' }

# Phase 18 - Salon (theme 19)
Switch-Theme 19
$salonServices = Invoke-Get 'Salon services' '/user/salon/services'
$token = Get-TokenFromHtml $salonServices.Content
Invoke-Post 'Salon service create' '/user/salon/services' @{ _token = $token; service_category = 'Hair'; service_name = 'Haircut' }
$artists = Invoke-Get 'Salon artists' '/user/salon/artists'
$token = Get-TokenFromHtml $artists.Content
Invoke-Post 'Salon artist create' '/user/salon/artists' @{ _token = $token; artist_name = 'Stylist One' }
$appointments = Invoke-Get 'Salon appointments' '/user/salon/appointments'
$token = Get-TokenFromHtml $appointments.Content
Invoke-Post 'Salon appointment create' '/user/salon/appointments' @{ _token = $token; client_name = 'Salon Client' }
$packages = Invoke-Get 'Salon packages' '/user/salon/packages'
$token = Get-TokenFromHtml $packages.Content
Invoke-Post 'Salon package create' '/user/salon/packages' @{ _token = $token; package_name = 'Bridal Package' }
$portfolio = Invoke-Get 'Salon portfolio' '/user/salon/portfolio'
$token = Get-TokenFromHtml $portfolio.Content
Invoke-Post 'Salon portfolio create' '/user/salon/portfolio' @{ _token = $token; title = 'Before/After' }
$products = Invoke-Get 'Salon products' '/user/salon/products'
$token = Get-TokenFromHtml $products.Content
Invoke-Post 'Salon product create' '/user/salon/products' @{ _token = $token; product_name = 'Shampoo' }
$publicSalon = Invoke-Get 'Public salon booking form' ("/$slug/salon-booking")
$token = Get-TokenFromHtml $publicSalon.Content
Invoke-Post 'Public salon booking submit' ("/$slug/salon-booking") @{ _token = $token; client_name = 'Public Client'; client_mobile = '9999999999' }

# Phase 19 - Political (theme 24)
Switch-Theme 24
$politicalProfiles = Invoke-Get 'Political profiles' '/user/political/profiles'
$token = Get-TokenFromHtml $politicalProfiles.Content
Invoke-Post 'Political profile create' '/user/political/profiles' @{ _token = $token; party_name = 'Civic Party' }
$politicalServices = Invoke-Get 'Political services' '/user/political/services'
$token = Get-TokenFromHtml $politicalServices.Content
Invoke-Post 'Political service create' '/user/political/services' @{ _token = $token; service_name = 'Public Helpdesk' }
$politicalProjects = Invoke-Get 'Political projects' '/user/political/projects'
$token = Get-TokenFromHtml $politicalProjects.Content
Invoke-Post 'Political project create' '/user/political/projects' @{ _token = $token; project_name = 'Road Upgrade' }
$politicalEvents = Invoke-Get 'Political events' '/user/political/events'
$token = Get-TokenFromHtml $politicalEvents.Content
Invoke-Post 'Political event create' '/user/political/events' @{ _token = $token; event_title = 'Town Hall' }
$politicalVolunteers = Invoke-Get 'Political volunteers' '/user/political/volunteers'
$token = Get-TokenFromHtml $politicalVolunteers.Content
Invoke-Post 'Political volunteer create' '/user/political/volunteers' @{ _token = $token; volunteer_name = 'Volunteer One' }
$politicalGrievances = Invoke-Get 'Political grievances' '/user/political/grievances'
$token = Get-TokenFromHtml $politicalGrievances.Content
Invoke-Post 'Political grievance create' '/user/political/grievances' @{ _token = $token; complainant_name = 'Citizen'; complainant_mobile = '9999999999'; issue_description = 'Road issue' }
$publicGrievance = Invoke-Get 'Public grievance form' ("/$slug/grievance")
$token = Get-TokenFromHtml $publicGrievance.Content
Invoke-Post 'Public grievance submit' ("/$slug/grievance") @{ _token = $token; complainant_name = 'Public Citizen'; complainant_mobile = '9999999999'; issue_description = 'Streetlight issue' }

# Phase 20 - Interior (theme 20)
Switch-Theme 20
$interiorServices = Invoke-Get 'Interior services' '/user/interior/services'
$token = Get-TokenFromHtml $interiorServices.Content
Invoke-Post 'Interior service create' '/user/interior/services' @{ _token = $token; service_name = 'Design Consultation' }
$interiorProjects = Invoke-Get 'Interior projects' '/user/interior/projects'
$token = Get-TokenFromHtml $interiorProjects.Content
Invoke-Post 'Interior project create' '/user/interior/projects' @{ _token = $token; client_name = 'Interior Client' }
$interiorPortfolio = Invoke-Get 'Interior portfolio' '/user/interior/portfolio'
$token = Get-TokenFromHtml $interiorPortfolio.Content
Invoke-Post 'Interior portfolio create' '/user/interior/portfolio' @{ _token = $token; project_title = 'Living Room' }
$interiorConsults = Invoke-Get 'Interior consultations' '/user/interior/consultations'
$token = Get-TokenFromHtml $interiorConsults.Content
Invoke-Post 'Interior consultation create' '/user/interior/consultations' @{ _token = $token; client_name = 'Consult Client' }
$publicInterior = Invoke-Get 'Public interior consultation form' ("/$slug/design-consultation")
$token = Get-TokenFromHtml $publicInterior.Content
Invoke-Post 'Public interior consultation submit' ("/$slug/design-consultation") @{ _token = $token; client_name = 'Public Client'; client_mobile = '9999999999' }

# Phase 21 - Education (theme 16)
Switch-Theme 16
$courses = Invoke-Get 'Education courses' '/user/education/courses'
$token = Get-TokenFromHtml $courses.Content
Invoke-Post 'Education course create' '/user/education/courses' @{ _token = $token; course_name = 'Maths 101' }
$batches = Invoke-Get 'Education batches' '/user/education/batches'
$token = Get-TokenFromHtml $batches.Content
Invoke-Post 'Education batch create' '/user/education/batches' @{ _token = $token; batch_name = 'Batch A' }
$faculty = Invoke-Get 'Education faculty' '/user/education/faculty'
$token = Get-TokenFromHtml $faculty.Content
Invoke-Post 'Education faculty create' '/user/education/faculty' @{ _token = $token; faculty_name = 'Dr. Smith' }
$admissions = Invoke-Get 'Education admissions' '/user/education/admissions'
$token = Get-TokenFromHtml $admissions.Content
Invoke-Post 'Education admission create' '/user/education/admissions' @{ _token = $token; student_name = 'Student One' }
$attendance = Invoke-Get 'Education attendance' '/user/education/attendance'
$token = Get-TokenFromHtml $attendance.Content
Invoke-Post 'Education attendance create' '/user/education/attendance' @{ _token = $token; student_name = 'Student One'; attendance_date = '2026-02-01' }
$tests = Invoke-Get 'Education tests' '/user/education/tests'
$token = Get-TokenFromHtml $tests.Content
Invoke-Post 'Education test create' '/user/education/tests' @{ _token = $token; test_name = 'Midterm' }
$results = Invoke-Get 'Education results' '/user/education/results'
$token = Get-TokenFromHtml $results.Content
Invoke-Post 'Education result create' '/user/education/results' @{ _token = $token; exam_year = '2026' }
$materials = Invoke-Get 'Education materials' '/user/education/materials'
$token = Get-TokenFromHtml $materials.Content
Invoke-Post 'Education material create' '/user/education/materials' @{ _token = $token; title = 'Notes' }
$feeStructures = Invoke-Get 'Education fee structures' '/user/education/fee-structures'
$token = Get-TokenFromHtml $feeStructures.Content
Invoke-Post 'Education fee structure create' '/user/education/fee-structures' @{ _token = $token; registration_fee = 1000 }
$studentFees = Invoke-Get 'Education student fees' '/user/education/student-fees'
$token = Get-TokenFromHtml $studentFees.Content
Invoke-Post 'Education student fee create' '/user/education/student-fees' @{ _token = $token; student_name = 'Student One' }
$publicAdmission = Invoke-Get 'Public education admission form' ("/$slug/admission")
$token = Get-TokenFromHtml $publicAdmission.Content
Invoke-Post 'Public education admission submit' ("/$slug/admission") @{ _token = $token; student_name = 'Public Student'; mobile = '9999999999' }

# Phase 22 - Solar (theme 21)
Switch-Theme 21
$solutions = Invoke-Get 'Solar solutions' '/user/solar/solutions'
$token = Get-TokenFromHtml $solutions.Content
Invoke-Post 'Solar solution create' '/user/solar/solutions' @{ _token = $token; solution_name = 'Rooftop Solar' }
$surveys = Invoke-Get 'Solar surveys' '/user/solar/surveys'
$token = Get-TokenFromHtml $surveys.Content
Invoke-Post 'Solar survey create' '/user/solar/surveys' @{ _token = $token; client_name = 'Solar Client' }
$projects = Invoke-Get 'Solar projects' '/user/solar/projects'
$token = Get-TokenFromHtml $projects.Content
Invoke-Post 'Solar project create' '/user/solar/projects' @{ _token = $token; project_name = 'Site A' }
$monitoring = Invoke-Get 'Solar monitoring' '/user/solar/monitoring'
$token = Get-TokenFromHtml $monitoring.Content
Invoke-Post 'Solar monitoring create' '/user/solar/monitoring' @{ _token = $token; system_name = 'Plant 1' }
$amc = Invoke-Get 'Solar AMC' '/user/solar/amc'
$token = Get-TokenFromHtml $amc.Content
Invoke-Post 'Solar AMC create' '/user/solar/amc' @{ _token = $token; client_name = 'AMC Client' }
$publicSolar = Invoke-Get 'Public solar survey form' ("/$slug/solar-survey")
$token = Get-TokenFromHtml $publicSolar.Content
Invoke-Post 'Public solar survey submit' ("/$slug/solar-survey") @{ _token = $token; client_name = 'Public Client'; client_mobile = '9999999999' }

# Phase 23 - CA (theme 18)
Switch-Theme 18
$caServices = Invoke-Get 'CA services' '/user/ca/services'
$token = Get-TokenFromHtml $caServices.Content
Invoke-Post 'CA service create' '/user/ca/services' @{ _token = $token; service_name = 'GST Filing' }
$caCases = Invoke-Get 'CA cases' '/user/ca/cases'
$token = Get-TokenFromHtml $caCases.Content
Invoke-Post 'CA case create' '/user/ca/cases' @{ _token = $token; client_name = 'Case Client' }
$caConsults = Invoke-Get 'CA consultations' '/user/ca/consultations'
$token = Get-TokenFromHtml $caConsults.Content
Invoke-Post 'CA consultation create' '/user/ca/consultations' @{ _token = $token; client_name = 'Consult Client' }
$caDeadlines = Invoke-Get 'CA deadlines' '/user/ca/deadlines'
$token = Get-TokenFromHtml $caDeadlines.Content
Invoke-Post 'CA deadline create' '/user/ca/deadlines' @{ _token = $token; compliance_type = 'ITR'; due_date = '2026-03-31' }
$publicCa = Invoke-Get 'Public CA consultation form' ("/$slug/ca-consultation")
$token = Get-TokenFromHtml $publicCa.Content
Invoke-Post 'Public CA consultation submit' ("/$slug/ca-consultation") @{ _token = $token; client_name = 'Public Client'; client_mobile = '9999999999' }

# Phase 24 - Astrologer (theme 23)
Switch-Theme 23
$astroServices = Invoke-Get 'Astrologer services' '/user/astrologer/services'
$token = Get-TokenFromHtml $astroServices.Content
Invoke-Post 'Astrologer service create' '/user/astrologer/services' @{ _token = $token; service_name = 'Horoscope' }
$astroConsults = Invoke-Get 'Astrologer consultations' '/user/astrologer/consultations'
$token = Get-TokenFromHtml $astroConsults.Content
Invoke-Post 'Astrologer consultation create' '/user/astrologer/consultations' @{ _token = $token; client_name = 'Consult Client' }
$astroReports = Invoke-Get 'Astrologer reports' '/user/astrologer/reports'
$token = Get-TokenFromHtml $astroReports.Content
Invoke-Post 'Astrologer report create' '/user/astrologer/reports' @{ _token = $token; client_name = 'Report Client' }
$publicAstro = Invoke-Get 'Public astrologer consultation form' ("/$slug/astro-consultation")
$token = Get-TokenFromHtml $publicAstro.Content
Invoke-Post 'Public astrologer consultation submit' ("/$slug/astro-consultation") @{ _token = $token; client_name = 'Public Client'; client_mobile = '9999999999' }

# Phase 25 - Security (theme 22)
Switch-Theme 22
$securityProducts = Invoke-Get 'Security products' '/user/security/products'
$token = Get-TokenFromHtml $securityProducts.Content
Invoke-Post 'Security product create' '/user/security/products' @{ _token = $token; product_name = 'CCTV Camera' }
$securitySurveys = Invoke-Get 'Security surveys' '/user/security/surveys'
$token = Get-TokenFromHtml $securitySurveys.Content
Invoke-Post 'Security survey create' '/user/security/surveys' @{ _token = $token; client_name = 'Survey Client' }
$securityProjects = Invoke-Get 'Security projects' '/user/security/projects'
$token = Get-TokenFromHtml $securityProjects.Content
Invoke-Post 'Security project create' '/user/security/projects' @{ _token = $token; project_name = 'Install Site' }
$securityAmc = Invoke-Get 'Security AMC' '/user/security/amc'
$token = Get-TokenFromHtml $securityAmc.Content
Invoke-Post 'Security AMC create' '/user/security/amc' @{ _token = $token; client_name = 'AMC Client' }
$publicSecurity = Invoke-Get 'Public security survey form' ("/$slug/security-survey")
$token = Get-TokenFromHtml $publicSecurity.Content
Invoke-Post 'Public security survey submit' ("/$slug/security-survey") @{ _token = $token; client_name = 'Public Client'; client_mobile = '9999999999' }

# Phase 26 - Influencer (theme 25)
Switch-Theme 25
$stats = Invoke-Get 'Influencer stats' '/user/influencer/stats'
$token = Get-TokenFromHtml $stats.Content
Invoke-Post 'Influencer stats create' '/user/influencer/stats' @{ _token = $token; platform = 'Instagram'; followers_count = 10000 }
$collabs = Invoke-Get 'Influencer collaborations' '/user/influencer/collaborations'
$token = Get-TokenFromHtml $collabs.Content
Invoke-Post 'Influencer collaboration create' '/user/influencer/collaborations' @{ _token = $token; brand_name = 'Brand X' }
$portfolio = Invoke-Get 'Influencer portfolio' '/user/influencer/portfolio'
$token = Get-TokenFromHtml $portfolio.Content
Invoke-Post 'Influencer portfolio create' '/user/influencer/portfolio' @{ _token = $token; title = 'Reel 1' }
$publicInfluencer = Invoke-Get 'Public influencer collaboration form' ("/$slug/brand-collaboration")
$token = Get-TokenFromHtml $publicInfluencer.Content
Invoke-Post 'Public influencer collaboration submit' ("/$slug/brand-collaboration") @{ _token = $token; brand_name = 'Public Brand'; brand_email = 'brand@example.com'; brand_mobile = '9999999999' }

# Phase 27 - Cross-theme checks (verify profile page loads with location tracker)
$profilePage = Invoke-Get 'Public profile page' ("/$slug")
if ($profilePage -and ($profilePage.Content -match 'fastap-location-tracked' -or $profilePage.Content -match 'profile.location.track')) {
    Add-Result 'Location tracker present' $true 'Location tracker script detected'
} else {
    Add-Result 'Location tracker present' $false 'Location tracker script missing'
}

$TestLog | Format-Table -AutoSize

$failed = $TestLog | Where-Object { -not $_.Ok }
$failedCount = @($failed).Count
if ($failedCount -gt 0) {
    Write-Host "FAILED: $failedCount" -ForegroundColor Red
    $failed | Format-Table -AutoSize
    Stop-Process -Id $server.Id -Force -ErrorAction SilentlyContinue
    exit 1
}

Write-Host 'All tests completed.'
Stop-Process -Id $server.Id -Force -ErrorAction SilentlyContinue
