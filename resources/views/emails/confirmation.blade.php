<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register email</title>
</head>
<body>
    <table>
        <tr><td>Dear {{$name}}</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Please click on below link to activate your account:
        </td></tr>

        <tr><td>&nbsp;</td></tr>
        <tr><td><a href="{{url('/confirm/'.$code)}}">confirm Account</a> </td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Thanks&regards</td></tr>
        <tr><td>ecomm website</td></tr>

    </table>
</body>
</html>