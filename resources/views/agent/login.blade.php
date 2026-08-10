<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Franchise Login</title>
  <link rel="icon" href="{{ url('frontendnew/images/fevicon.png')}}" type="image/x-icon" />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Public Sans', sans-serif;
    }

    body {
      background: #f4f6f8;
      display: flex;
      align-items: center;
      margin-top:40px;
      height: 100vh;
      flex-direction: column;
    }

    .logo-container {
      margin-bottom: 20px;
      text-align: center;
    }

    .logo-container img {
      height: 70px;
      width: auto;
    }

    .login-card {
      background: #ffffff;
      padding: 3rem 2.5rem;
      border-radius: 10px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
      width: 100%;
      max-width: 500px;
    }

    .login-card h4 {
      text-align: center;
      margin-bottom: 0.5rem;
      font-weight: 600;
      color: #333;
    }

    .login-card p {
      text-align: center;
      margin-bottom: 2rem;
      color: #777;
    }

    .form-label {
      font-weight: 600;
      margin-bottom: 0.5rem;
      display: block;
      color: #333;
    }

    .form-control {
      width: 100%;
      padding: 0.85rem 1rem;
      border-radius: 6px;
      border: 1px solid #ccc;
      margin-bottom: 1.5rem;
      font-size: 1rem;
    }

    .form-control:focus {
      border-color: #5c6bc0;
      outline: none;
      box-shadow: 0 0 0 2px rgba(92, 107, 192, 0.1);
    }

    .form-password-toggle {
      position: relative;
    }

    .form-password-toggle .bx {
      position: absolute;
      top: 35%;
      transform: translateY(-50%);
      right: 1rem;
      cursor: pointer;
      color: #aaa;
      font-size: 1.2rem;
      display: flex;
      align-items: center;
    }

    .form-check {
      display: flex;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .form-check input {
      margin-right: 8px;
    }

    .btn-primary {
      width: 100%;
      background: #5c6bc0;
      color: #fff;
      padding: 0.85rem;
      border: none;
      border-radius: 6px;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .btn-primary:hover {
      background: #3f51b5;
    }

    .text-danger {
      color: #e53935;
      font-size: 0.875rem;
      margin-top: -1rem;
      margin-bottom: 1.2rem;
      display: block;
    }
  </style>
</head>
<body>

  <!-- Logo outside the card -->
  <div class="logo-container">
    <img src="{{ url('frontend/assets/img/logo/fastap.png') }}" alt="FASTAP Logo">
  </div>

  <div class="login-card">
    <h4>Welcome to FASTAP 👋</h4>
    <p>Franchise Login to your account</p>

    <form method="POST" action="{{ route('login.auth') }}">
      @csrf

      <label for="email" class="form-label">Email</label>
      <input type="text" id="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" />
      @if ($errors->has('email'))
        <span class="text-danger">{{ $errors->first('email') }}</span>
      @endif

      <label for="password" class="form-label">Password</label>
      <div class="form-password-toggle">
        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" value="{{ old('password') }}" />
        <i class="bx bx-hide toggle-password" onclick="togglePasswordVisibility()"></i>
      </div>
      @if ($errors->has('password'))
        <span class="text-danger">{{ $errors->first('password') }}</span>
      @endif

      <div class="form-check">
        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label for="remember">Remember Me</label>
      </div>
      @if (session('error'))
        <span class="text-danger">{{ session('error') }}</span>
      @endif

      <button type="submit" class="btn-primary">Sign In</button>
    </form>
  </div>

  <script>
    function togglePasswordVisibility() {
      const passwordInput = document.getElementById('password');
      const icon = document.querySelector('.toggle-password');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('bx-hide');
        icon.classList.add('bx-show');
      } else {
        passwordInput.type = 'password';
        icon.classList.remove('bx-show');
        icon.classList.add('bx-hide');
      }
    }
  </script>

</body>
</html>
