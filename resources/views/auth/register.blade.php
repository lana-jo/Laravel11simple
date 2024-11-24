  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Register - Sewa Barang</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <style>
          body {
              background: linear-gradient(120deg, #2980b9, #8e44ad);
              height: 100vh;
              display: flex;
              align-items: center;
              justify-content: center;
          }
          .register-container {
              width: 100%;
              max-width: 500px;
              background: white;
              padding: 30px;
              border-radius: 10px;
              box-shadow: 0 0 20px rgba(0,0,0,0.2);
          }
          .register-header {
              text-align: center;
              margin-bottom: 30px;
          }
          .register-header h1 {
              color: #2c3e50;
              font-size: 28px;
              font-weight: 600;
          }
          .form-group {
              margin-bottom: 20px;
              text-align: center;
          }
          .form-control {
              padding: 12px;
              border-radius: 5px;
              width: 100%;
              max-width: 400px;
              margin: 0 auto;
          }
          .form-label {
              display: block;
              text-align: center;
              margin-bottom: 8px;
              color: #2c3e50;
              font-weight: 500;
          }
          .btn-register {
              width: 100%;
              max-width: 400px;
              padding: 12px;
              background: #2980b9;
              border: none;
              color: white;
              font-weight: 600;
              border-radius: 5px;
              transition: all 0.3s;
              margin: 20px auto;
              display: block;
          }
          .btn-register:hover {
              background: #3498db;
              transform: translateY(-2px);
          }
          .login-link {
              text-align: center;
              margin-top: 20px;
          }
          .invalid-feedback {
              text-align: center;
              display: block;
          }
      </style>
  </head>
  <body>
      <div class="register-container">
          <div class="register-header">
              <h1>Create Account</h1>
              <p class="text-muted">Join Sewa Barang today</p>
          </div>

          <form method="POST" action="{{ route('register') }}">
              @csrf
              <div class="form-group">
                  <label for="name" class="form-label">Full Name</label>
                  <input type="text" 
                       class="form-control @error('name') is-invalid @enderror" 
                       name="name" 
                       id="name" 
                       value="{{ old('name') }}" 
                       placeholder="Enter your full name"
                       required>
                  @error('name')
                      <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
              </div>

              <div class="form-group">
                  <label for="email" class="form-label">Email Address</label>
                  <input type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       name="email" 
                       id="email" 
                       value="{{ old('email') }}" 
                       placeholder="Enter your email"
                       required>
                  @error('email')
                      <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
              </div>

              <div class="form-group">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       name="password" 
                       id="password" 
                       placeholder="Create a password"
                       required>
                  @error('password')
                      <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
              </div>

              <div class="form-group">
                  <label for="password-confirm" class="form-label">Confirm Password</label>
                  <input type="password" 
                       class="form-control" 
                       name="password_confirmation" 
                       id="password-confirm" 
                       placeholder="Confirm your password"
                       required>
              </div>

              <button type="submit" class="btn btn-register">Create Account</button>

              <div class="login-link">
                  <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
              </div>
          </form>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
  </html>
