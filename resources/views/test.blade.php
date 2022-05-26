<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>QR CODES</title>
</head>
<body>
<style>
    body {
        font-family: DejaVu Sans;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

     h1 {
        font-size: 8px;
        font-weight: bold;
        margin: 0;
        text-align: left;
    }
     p {
        font-size: 6px;
        font-weight: 400;
    }

    .border {
        border: 1px solid #222;
        padding: 3px;
    }

</style>


<table>
@foreach($objects as $object)

        @if($loop->index % 3 === 0)
            <tr>
        @endif

        <td width="33%" class="border">
            <table>
            <tr>
                <td width="30%">
                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('svg')->size(60)->generate(route('history.show', ['history' => $object->slug]))) !!} ">
                </td>
                <td width="70%">
                    <h1>{{$object->title}}</h1>
                    <p>{{$object->inv_number}}</p>
                </td>
            </tr>
            </table>
        </td>

                @if($loop->index % 3 === 2)
                </tr>
                @elseif($loop->last && $loop->index % 3 !== 2)
                </tr>
        @endif


@endforeach

</table>






</body>
</html>

