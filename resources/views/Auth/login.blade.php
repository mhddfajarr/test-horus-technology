<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Login</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-sm" style="width: 23rem; height: 32rem">
            <div class="card-body d-flex flex-column justify-content-center align-items-center p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <h1 class="card-title text-center mb-5 fs-1 fw-bold">Login</h1>
                <form action="/login" method="POST" class="w-100">
                    @csrf
                    <div class="mb-3">
                        <label for="login" class="form-label">Email or Username</label>
                        <input type="text" class="form-control" id="login" name="login" required>
                    </div>
                    <div class="mb-5">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Log in</button>
                </form>
                <div class="mt-3 text-center">
                    <p class="mb-0">Belum mempunyai akun? <a href="/registrasi" class="text-decoration-none">Registrasi</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>