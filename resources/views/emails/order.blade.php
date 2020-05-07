<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
<?php
use App\Cart;
use App\User;
?>
    <table width='700px' border="0" cellpadding="0" cellspacing="0">
        <tr><td><img  src="{{asset('/images/backend_images/products/small/201.jpg')}}" alt=""></td></tr>
        <tr><td>&nbsp;</td></tr>
      

        </td></tr>

        <tr><td>&nbsp;</td></tr>
        <tr><td>HELLO:{{$name}}</td></tr>
        <tr><td>type_your_payment:{{$type_your_payment}}</td></tr>
        
        <tr><td>&nbsp;</td></tr>
        <tr><td>
        THANKS you for shopping with us . your order details are as below:
            </td></tr>
        <tr><td>&nbsp;</td></tr>
            <tr bgcolor="#ccccc"><td>order no::{{$orderId}}</td></tr>
            
        <h3>Details your order , contains on : </h3>
            <table width='95%' cellpadding="5" cellspacing="5" bgcolor="#f7f4f4">
             
            @foreach($order as $ord)
            <tr bgcolor="#ccccc">
                <td>product id:{{$ord['product_id']}}</td>
            </tr>
            <?php 

        $sessionEmail=Session::get('sessionUser');
        $productCart=  Cart::where(['product_id'=>$ord->product_id,'user_email'=>$sessionEmail])->get();
        
       // echo '<pre>';print_r($productCart);die; 
        // echo '<pre>';print_r($orderProduct);die;
        ?>

        @foreach($productCart as $prod)
                  <?php $total_mount=0; ?>
        <tr>
                <td>product_name:{{$prod->product_name}}</td>
            </tr>
            <tr>
                <td>product_code:{{$prod->product_code}}</td>
            </tr>
            <tr>
                <td>product_quantity:{{$prod->product_quantity}}</td>
            </tr>
            <tr>
                <td>product_price:{{$prod->product_price}}</td>
            </tr>
            <tr>
                <td>total_mount:{{$total_mount=$total_mount + $prod->product_price * $prod->product_quantity}}</td>
            </tr>
            @endforeach
            @endforeach
                
            </table>
            <table width="100%">
                <tr>
                    <td width="50%">
                    <?php
        $billingUser=  User::where(['email'=>$sessionEmail])->first();//billing

                    ?>
                        <table>
                            <tr>
                                <td width="50%">Bill to:</td>
                            </tr>
                            <tr>
                            <td>Bill Address:{{$billingUser->email}}</td>

                            </tr>
                            <td width="50%">Name:{{$billingUser->name}}</td>

                            </tr>
                            <tr>

                            <td width="50%">address:{{$billingUser->address}}</td>

                            </tr>
                            <tr>
                            <td width="50%">city:{{$billingUser->city}}</td>

                            </tr>
                        </table>
                    </td>
            </table>


        <tr><td>&nbsp;</td></tr>
        <table width="100%">
                            <tr>
                                <td width="50%">Shipp to:</td>
                            </tr>
                            <tr>
                            <td>Bill Address:{{$shippingUserDetails->email}}</td>

                            </tr>
                            <td width="50%">Name:{{$shippingUserDetails->name}}</td>

                            </tr>
                            <tr>
                            <td width="50%">address:{{$shippingUserDetails->address}}</td>

                            </tr>
                            <tr>

                            <td width="50%">city:{{$shippingUserDetails->city}}</td>

                            </tr>
                        </table>
                    </td>
            </table>

            
        <tr><td>Thanks&regards</td></tr>
        <tr><td>ecomm website</td></tr>

    </table>
</body>
</html>