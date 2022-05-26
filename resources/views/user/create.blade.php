<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация IT-Center</title>

    <link rel="stylesheet" href="{{asset("css/login/style.min.css")}}">
</head>
<body>

<div class="main">

    <!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Регистрация</h2>

                    @if($errors->any())
                        <ul class="error-list">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                        </ul>
                    @endif
                    @if(session()->has('success'))
                        <div class="card card-dark bg-success-gradient" style="background: linear-gradient(-45deg,#179d08,#31ce36)!important; border-radius: 5px; padding: 2px 20px; color: #fff; font-size: 12px;">
                            <div class="card-body bubble-shadow">
                                <h5 class="mb-0">{{session('success')}}</h5>
                            </div>
                        </div>

                    @endif


                    <form action="{{route('register.store')}}" method="POST" class="register-form" id="register-form">
                        @csrf
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="name" id="name" placeholder="Ваше имя..." value="{{old('name')}}"/>
                        </div>

                        <div class="form-group @error('email') has-error @enderror">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Ваш email..." value="{{old('email')}}"/>
                        </div>
                        <div class="form-group @error('password') has-error @enderror">
                            <label for="password"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="password" placeholder="Введите пароль..."/>
                        </div>
                        <div class="form-group @error('password_confirmation') has-error @enderror">
                            <label for="password_confirmation"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Повторите пароль..."/>
                        </div>

                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Зарегистрироваться"/>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="{{asset('img/login/signup-image.jpg')}}" alt="sing up image"></figure>
                    <a href="{{ route('login.create') }}" class="signup-image-link">Уже есть аккаунт?</a>
                </div>
            </div>
        </div>
    </section>



</div>

<!-- JS -->
<script src="{{asset("js/login/scripts.min.js")}}"></script>
</body>
</html>
