<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <table>
            @foreach($input as $key => $value)
                <tr>
                    <td>{{ Lang::get('parkcms-form::fields.' . $key) }}</td>
                    <td>{{ $value }}</td>
                </tr>
            @endforeach
        </table>
    </body>
</html>