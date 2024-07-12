<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styleCheckout.css">
</head>
<body>
    
<div class="container">
    <div class="checkoutLayout">

        
        <div class="returnCart">
            <a href="/">keep shopping</a>
            <h1>List Product in Cart</h1>
            <div class="list">

                <div class="item">
                    <img src="images/1.jpg">
                    <div class="info">
                        <div class="name">Kelvin Momo  Kurhula</div>
                        <div class="price">$30/1 product</div>
                    </div>
                    <div class="quantity">5</div>
                    <div class="returnPrice">$433.3</div>
                </div>

            </div>
        </div>


        <div class="right">
            <h1>Checkout</h1>

            <div class="form">
                <div class="group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name">
                </div>
    
                <div class="group">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone">
                </div>
    
                <div class="group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address">
                </div>           
            </div>
            <div class="return">
                <div class="row">
                    <div>Total Quantity</div>
                    <div class="totalQuantity"></div>
                </div>
                <div class="row">
                    <div>Total Price</div>
                    <div class="totalPrice">$</div>
                </div>
            </div>
            <button class="buttonCheckout">CHECKOUT</button>
            </div>
    </div>
</div>


<script src="checkout.js"></script>

</body>
</html>