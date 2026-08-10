<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('page_title')</title>

  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
  :root {
    --primary: #5c6bc0;
    --background: #f8f9fa;
    --sidebar-bg: #ffffff;
    --active-bg: #e9f3ff;
    --active-border: #5c6bc0;
    --text-color: #5c6bc0;
    --bg-primary: #5c6bc0;
  }

  body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: var(--background);
  }

  .sidebar {
    width: 240px;
    background-color: var(--sidebar-bg);
    color: var(--text-color);
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    display: flex;
    flex-direction: column;
    box-shadow: 2px 0 8px rgba(0,0,0,0.05);
    z-index: 1000;
  }

  .sidebar-header {
    padding: 16px 20px;
    font-size: 20px;
    font-weight: 600;
    border-bottom: 1px solid #ddd;
    color: var(--primary);
    text-align: center;
    background-color: #f1f1f1;
  }

  .sidebar a {
    padding: 12px 20px;
    color: var(--text-color);
    text-decoration: none;
    display: block;
    border-left: 4px solid transparent;
    transition: all 0.3s;
  }

  .sidebar a:hover,
  .sidebar a.active {
    background-color: var(--active-bg);
    border-left: 4px solid var(--active-border);
    font-weight: 500;
    color: var(--primary);
  }

  .logout-btn {
    margin-top: auto;
    padding: 16px 20px;
    background-color: #ffe5e5;
    color: #b30000;
    text-align: center;
    font-weight: bold;
    cursor: pointer;
  }

  .navbar {
    background-color: #5c6bc0;
    color: var(--text-color);
    padding: 10px 20px;
    position: sticky;
    top: 0;
    left: 0;
    right: 0;
    z-index: 999;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
  }

  .navbar .nav-toggle {
    font-size: 24px;
    background: none;
    border: none;
    color: var(--text-color);
  }

  .user-avatar img {
    height: 40px;
    width: 40px;
    border-radius: 50%;
  }
  .user-avatar {
  display: block !important;
}

  .main-content {
    margin-left: 240px;
    padding: 20px;
    transition: margin-left 0.3s ease;
  }

  @media (max-width: 768px) {
    .sidebar {
      transform: translateX(-100%);
      position: fixed;
      transition: transform 0.3s ease;
    }

    .sidebar.active {
      transform: translateX(0);
    }

    .main-content {
      margin-left: 0;
    }
  }

  footer {
    position: static;
    bottom: 0;
    margin-left: 16%;
  }
</style>

</head>

<body>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
       <a href="{{ url('agent/dashboard') }}" class="app-brand-link">
                        <img class="normal-logo" src="{{ url('frontend/assets/img/logo/fastap.png') }}" alt="logo"
                            style="height:50px; width:100px;">
                        <span class="app-brand-text demo menu-text fw-bolder ms-2"> FASTAP </span>
                    </a>
    <a href="{{ url('agent/dashboard') }}" class="{{ Request::is('agent/dashboard') ? 'active' : '' }}">Dashboard</a>
    <a href="/Product">New Order</a>
    <a href="{{ url('agent/allorders') }}" class="{{ Request::is('agent/allorders') ? 'active' : '' }}">All Orders</a>
    <a href="{{ url('agent/myprofile') }}">My Profile</a>
  </div>

  <!-- Navbar -->
 <nav class="navbar d-flex justify-content-between align-items-center">
  <button class="nav-toggle d-md-none" id="sidebarToggle">
    <i class="fa fa-bars" style="
    color: #fff;
"></i>
  </button>

  <div class="dropdown ms-auto">
    <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
      <img src="{{ url('public/frontend/user_images/placeholder.png') }}" 
           alt="User" 
           class="rounded-circle" 
           width="40" height="40">
    </a>
    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
      <li><a class="dropdown-item" href="{{ url('/logout') }}">Logout</a></li>
    </ul>
  </div>
</nav>



  <!-- Main Content -->
  <div class="main-content" id="mainContent">
    