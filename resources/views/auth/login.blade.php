<!doctype html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Todo App</title>

```
<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<link rel="stylesheet"
      href="{{ asset('dist/css/adminlte.css') }}">
```

</head>

<body class="login-page bg-body-secondary">

<div class="login-box">

```
<div class="login-logo">
    <a href="#">
        <b>Todo</b> App
    </a>
</div>

<div class="card">

    <div class="card-body login-card-body">

        <p class="login-box-msg">
            Login menggunakan WorkOS SSO
        </p>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="d-grid">

            <a href="{{ route('workos.login') }}"
               class="btn btn-success">

                <i class="bi bi-shield-lock me-2"></i>

                Login dengan WorkOS

            </a>

        </div>

    </div>

</div>
```

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>

</body>
</html>
