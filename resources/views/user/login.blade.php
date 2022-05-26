<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация IT-Center</title>

    <link rel="stylesheet" href="{{asset("css/login/style.min.css")}}">
</head>
<body>

<div class="main">

    <!-- Sign up form -->
    <section class="signin">
        <div class="container">
            <div class="signin-content">
                <div class="signin-form">
                    <h2 class="form-title">Авторизация</h2>

                    @if($errors->any())
                        <ul class="error-list">
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    @endif

                    @if(session()->has('error'))
                        <ul class="error-list">
                            <li>{{session('error')}}</li>
                        </ul>
                    @endif

                    <form action="{{route('login.store')}}" method="POST" class="register-form" id="register-form">
                        @csrf

                        <div class="form-group @error('email') has-error @enderror">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Ваш email..." />
                        </div>
                        <div class="form-group @error('password') has-error @enderror">
                            <label for="password"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="password" placeholder="Введите пароль..."/>
                        </div>

                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Войти"/>
                        </div>
                    </form>
                </div>
                <div class="signip-image">
                    <figure><img src="{{asset('img/login/signin-image.jpg')}}" alt="sing up image"></figure>
                    <a href="{{ route('register.create') }}" class="signup-image-link">Нет аккаунта?</a>
                </div>
            </div>
        </div>
    </section>



</div>

<!-- JS -->
<script src="{{asset("js/login/scripts.min.js")}}"></script>
</body>
</html>
