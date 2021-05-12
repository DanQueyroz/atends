<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atends / Login</title>

    <!-- Importando CSS -->
    <link rel="stylesheet" href="{{ asset('css/login.css')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">

</head>
<body>
    
    <div class="container">
        <div class="card card-container">
            <!-- <img class="login-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="login-img" class="login-img-card" src="https://laravel.com/img/logotype.min.svg" alt="Logo">
           
            <p id="login-name" class="login-name-card h4">Atends</p>

            <!-- Exibindo sucesso -->
            @if (session('success'))
                <div id="alert" class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Exibindo errors -->
            @if (session('error'))
                <div id="alert" class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    <strong>{{ session('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form class="mt-5" autocomplete="" name="formLogin" method="POST" action="{{route('logar.usuario')}}">
                @csrf

                <label class="sr-only border-primary text-dark" for="inlineFormInputGroup">E-mail</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-user-secret"></i></div>
                        </div>
                    <input type="text" id="email" name="email" minlength="5" maxlength="25" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}" autocomplete="email" autofocus placeholder="E-mail" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <label class="sr-only border-primary" for="inlineFormInputGroup">Senha</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-lock"></i></div>
                        </div>
                    <input type="password" id="senha" name="senha" minlength="4" maxlength="25" class="form-control @error('senha') is-invalid @enderror"  value="{{ old('senha') }}" autocomplete="senha" autofocus placeholder="Senha *" required>
                    @error('senha')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mt-5">
                    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Entrar</button>
                </div>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>