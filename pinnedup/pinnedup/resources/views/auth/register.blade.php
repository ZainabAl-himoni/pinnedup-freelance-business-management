<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}">

  <title>Pinned Up</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Custom Styles -->
  <style>
    body {
      font-family: "Kanit", serif;
      background-color: #f8f9fa;
      height: 80vh;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 9vh;
    }

    .card {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 15px;
      border: none;
    }

    .card-header {
      background-color: #00a1b5;
      color: white;
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
      font-weight: 700;
      text-align: center;
    }

    .form-control:focus {
      border-color: #00a1b5;
      box-shadow: 0 0 5px rgba(0, 161, 181, 0.5);
    }

    .btn-register {
      background-color: #00a1b5;
      color: white;
      font-weight: 600;
      transition: all 0.3s ease-in-out;
    }

    .btn-register:hover {
      background-color: white;
      color: #00a1b5;
      border: 2px solid #00a1b5;
    }

    .already-registered {
      text-align: center;
      font-size: 0.9rem;
    }

    .already-registered a {
      color: #de0050;
      font-weight: 500;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .already-registered a:hover {
      color: #00a1b5;
    }

    .logo-section img {
      max-width: 100%;
      border-radius: 15px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row align-items-center">
    <!-- Registration Form Section -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3>Create an Account</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('register') }}" method="POST">
            @csrf
            <!-- Name Field -->
            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter your full name" value="{{ old('name') }}" required>
              @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Email Field -->
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email address" value="{{ old('email') }}" required>
              @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Password Field -->
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" required>
              @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Confirm Password Field -->
            <div class="mb-3">
              <label for="password_confirmation" class="form-label">Confirm Password</label>
              <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Re-enter your password" required>
            </div>

            <!-- Submit Button -->
            <div class="d-grid">
              <button type="submit" class="btn btn-register">Register</button>
            </div>
          </form>
        </div>

        <!-- Already Registered Section -->
        <div class="card-footer bg-white">
          <p class="already-registered">Already have an account? <a href="{{ route('login') }}">Log in here</a></p>
        </div>
      </div>
    </div>

    <!-- Logo Section -->
    <div class="col-md-6 text-center logo-section">
      <img src="{{ asset('assets/logo.png') }}" alt="Pinned Up Logo" width="250" height="250" >
      <h4 class="mt-4 " style="color:#00a1b5">Welcome to Pinned Up</h4>
      <p>Your ultimate business management platform.</p>
    </div>
  </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
