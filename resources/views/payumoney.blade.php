<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{$endpoint}}" name="redirect" method="post">
        <input type="hidden" name="key" value="{{$parameters['key']}}" id="">
        <input type="hidden" name="hash" value="{{$hash}}" id="">
        <input type="hidden" name="txnid" value="{{$parameters['txnid']}}" id="">
        <input type="hidden" name="amount" value="{{$parameters['amount']}}" id="">
        <input type="hidden" name="firstname" value="{{$parameters['firstname']}}" id="">
        <input type="hidden" name="email" value="{{$parameters['email']}}" id="">
        <input type="hidden" name="phone" value="{{$parameters['phone']}}" id="">
        <input type="hidden" name="productinfo" value="{{$parameters['productinfo']}}" id="">
        <input type="hidden" name="surl" value="{{$parameters['surl']}}" id="">
        <input type="hidden" name="lastname" value="{{$parameters['lastname']}}" id="">
        <input type="hidden" name="furl" value="{{$parameters['furl']}}" id="">
        <input type="hidden" name="service_provider" value="{{$parameters['service_provider']}}" id="">
        <input type="hidden" name="curl" value="{{$parameters['curl'] or ''}}" id="">
        <input type="hidden" name="address1" value="{{$parameters['address1']}}" id="">
        <input type="hidden" name="address2" value="{{$parameters['address2']}}" id="">
        <input type="hidden" name="city" value="{{$parameters['city']}}" id="">
        <input type="hidden" name="state" value="{{$parameters['state']}}" id="">
        <input type="hidden" name="country" value="{{$parameters['country']}}" id="">
        <input type="hidden" name="zipcode" value="{{$parameters['zipcode']}}" id="">
    </form>
    <script language='javascript'>document,redirect.submit();</script>
</body>
</html>