<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login — CypressIq Blog Platform</title>
  <link rel="stylesheet" href="{{ asset('css/design-system.css') }}" />
  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      background: var(--bg-body);
    }
    .login-wrapper {
      width: 100%;
      max-width: 420px;
      padding: 2rem;
    }
    .login-card {
      background: var(--bg-surface);
      border: 1px solid var(--border-subtle);
      border-radius: var(--radius-xl);
      padding: 2.5rem 2rem;
      box-shadow: var(--shadow-xl);
    }
    .login-header {
      text-align: center;
      margin-bottom: 2rem;
    }
    .login-logo {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      font-family: var(--font-display);
      font-weight: 800;
      font-size: 1.5rem;
      color: var(--text-primary);
      text-decoration: none;
      margin-bottom: 1rem;
    }
    .login-logo-icon {
      background: var(--gradient-primary);
      width: 36px;
      height: 36px;
      border-radius: var(--radius-md);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 1.1rem;
    }
    .error-alert {
      background: rgba(255, 107, 122, 0.1);
      border: 1px solid rgba(255, 107, 122, 0.2);
      color: #FF6B7A;
      padding: 1rem;
      border-radius: var(--radius-md);
      font-size: 0.9rem;
      margin-bottom: 1.5rem;
    }
    .form-group {
      margin-bottom: 1.25rem;
    }
    .form-label {
      display: block;
      margin-bottom: 0.5rem;
      font-size: 0.875rem;
      font-weight: 500;
      color: var(--text-secondary);
    }
    .form-input {
      width: 100%;
      background: var(--bg-body);
      border: 1px solid var(--border-subtle);
      color: var(--text-primary);
      padding: 0.75rem 1rem;
      border-radius: var(--radius-md);
      font-family: inherit;
      font-size: 1rem;
      transition: all 0.2s ease;
    }
    .form-input:focus {
      outline: none;
      border-color: var(--clr-primary);
      box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.1);
    }
    .checkbox-row {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-bottom: 1.5rem;
    }
    .checkbox-row input {
      accent-color: var(--clr-primary);
      width: 16px;
      height: 16px;
    }
    .checkbox-row label {
      font-size: 0.875rem;
      color: var(--text-secondary);
      cursor: pointer;
    }
  </style>
</head>
<body class="page-enter">
  <div class="login-wrapper">
    <div class="login-header">
      <a href="{{ route('home') }}" class="login-logo">
        <div class="login-logo-icon">⚡</div>
        <span>Cypressiq<span style="color:var(--clr-accent)">.</span></span>
      </a>
      <p style="color:var(--text-secondary); margin-top:0.5rem;">Sign in to CypressIq CMS</p>
    </div>

    <div class="login-card">
      @if ($errors->any())
        <div class="error-alert">
          {{ $errors->first() }}
        </div>
      @endif

      <form action="{{ route('admin.login.submit') }}" method="POST">
        @csrf
        <div class="form-group">
          <label class="form-label" for="email">Email Address</label>
          <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required autofocus placeholder="admin@cypressiq.agency" />
        </div>
        <div class="form-group">
          <label class="form-label" for="password">Password</label>
          <input type="password" id="password" name="password" class="form-input" required placeholder="••••••••" />
        </div>
        <div class="checkbox-row">
          <input type="checkbox" id="remember" name="remember" />
          <label for="remember">Remember me on this device</label>
        </div>
        <button type="submit" class="btn btn--primary" style="width:100%; justify-content:center;">Sign In →</button>
      </form>
    </div>
    
    <div style="text-align:center; margin-top:2rem; font-size:0.875rem; color:var(--text-muted);">
      &copy; 2026 CypressIq. All rights reserved.
    </div>
  </div>
</body>
</html>
