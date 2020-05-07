@extends('layout')
@section('content')


<section id="do-action">
    <div class="container">
        <div class="heading" align="center">
            <h3>YOUR CDO HAS BEEN PLACED</h3>
            <p>THANKS for the payment . we will proccess your order very soon</p>
            <p>Your order number is{{Session::get('sessionOrderId')}} and total amount paid is INR {{Session::get('sessionGrandTotal')}} </p>
            <table>
                <tr>
                    <!-- <td>product name</td>
                    <td>product code</td>
                    <td>size</td>
                    <td>color</td>
                    <td>quantity</td>
                    <td>price</td> -->
                    <td>product id</td>
                </tr>
                <?php
                use App\OrdersProduct;
                use App\Product;
                    $productsInOrder=OrdersProduct::where(['order_id'=>Session::get('sessionOrderId')])->get();//جبت كل البرودكتس اللي في هادا الاوردر


                ?>
            @foreach($productsInOrder as $productInOrder)
         
            <tr>
                <td>{{$productInOrder['product_id']}}</td>
            </tr>
            @endforeach
                
            </table>
        </div>
    </div>
</section>
@endsection