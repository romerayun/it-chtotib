<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Письмо с сайта</title>
</head>
<body>

    <h1>Здравствуйте, {{$claim->fio}}</h1>
    <p>Мы получили Вашу заявку, для отслеживания статуса перейдите по <a href="#">ссылке</a>.
        <br>Номер отслеживания: <span><b>00023{{$claim->id}}</b></span>
    </p>
{{--    <p></p>--}}

</body>
</html>
