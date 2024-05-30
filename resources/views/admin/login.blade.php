<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="Orbitor,business,company,agency,modern,bootstrap4,tech,software">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puskesmas Sekura{{ $title ?? '' }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
    <link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/52c63e43bb.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .login-card {
            padding: 1rem;
            background-color: white;
            box-shadow: 0 0 30px -10px #aaa;
            width: 100%;
            border-radius: 1rem
        }

        @media(min-width:768px) {
            .login-card {
                width: 25rem;
            }

            .login-container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100%;
            }
        }
    </style>
</head>

<body>
    <main class="gray-bg vh-100 vw-100">
        <div class="container login-container">
            <div class="login-card">
                <div class="text-center">
                    <img src="{{ asset('images/logo.png') }}" height="75px">
                    <h3 class="mt-3">Welcome Back!</h3>
                    <p>Login to your account to access admin panel</p>
                </div>
                <form action="/admin/login" method="POST">
                    @csrf
                    @if (session()->has('fails'))
                        <div class="alert alert-danger mb-3" role="alert">
                            {{ session()->get('fails') }}
                        </div>
                    @endif
                    <input type="email" name="email" id="email" placeholder="Masukkan Email"
                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <input type="password" name="password" id="password" placeholder="Masukkan Password"
                        class="form-control mt-3 @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <button class="btn btn-success w-100 mt-3">Login</button>
                </form>


            </div>
        </div>
    </main>

    <script src="/plugins/jquery/jquery.js"></script>
    <script src="/plugins/bootstrap/js/popper.js"></script>
    <script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="/js/additional.js"></script>
    <script src="/js/admin.js"></script>
    <script>
        @if (session()->has('success'))
            Success.fire({
                text: "{{ session()->get('success') }}"
            })
        @endif
    </script>
</body>

</html>
