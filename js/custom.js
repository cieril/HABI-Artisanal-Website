$(document).ready(function () {

    $(document).on('click','.increment_btn', function (e) {
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input_qty').val();

        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value; 
        if(value < 10) {
            value++; 
            $(this).closest('.product_data').find('.input_qty').val(value);
        }
    });
    
    $(document).on('click','.decrement_btn', function (e) {
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input_qty').val();

        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value; 
        if(value > 1) {
            value--; 
            $(this).closest('.product_data').find('.input_qty').val(value);
        }
    });
 
    $(document).on('click','.addToCartBtn', function (e) {
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input_qty').val();
        var prod_id = $(this).val();
        
        $.ajax ({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "add" 
            },
            success: function(response) {
                if (response == 201) {
                    alertify.success("Product added to cart");
                } else if (response == "existing") {
                    alertify.success("Product already in cart");
                } else if (response == 401) {
                    alertify.success("Login to continue");
                } else if (response == 500) {
                    alertify.success("Something went wrong");
                }
            }
        });

    });

    $(document).on('click','.updateQty', function () {
        var qty = $(this).closest('.product_data').find('.input_qty').val();
        var prod_id = $(this).closest('.product_data').find('.prodId').val();

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "update" 
            },
            success: function (response) {
                
            }
        });
    });

    $(document).on('click','.deleteItem', function () {
        var cart_id = $(this).val();
        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "cart_id": cart_id,
                "scope": "delete" 
            },
            success: function (response) {
                if (response == 200) {
                    alertify.success("Item deleted successfully");
                    $('#mycart').load(location.href +  " #mycart")
                } else {
                    alertify.success(response);
                }
            }
        });
    });

    $(document).on('click','.addToWishListBtn', function (e) {
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input_qty').val();
        var prod_id = $(this).val();
        
        $.ajax ({
            method: "POST",
            url: "functions/handlewishlist.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "add" 
            },
            success: function(response) {
                if (response == 201) {
                    alertify.success("Product added to wishlist");
                } else if (response == "existing") {
                    alertify.success("Product already in wishlist");
                } else if (response == 401) {
                    alertify.success("Login to continue");
                } else if (response == 500) {
                    alertify.success("Something went wrong");
                }
            }
        });

    });

    $(document).on('click','.deleteItem', function () {
        var cart_id = $(this).val();
        $.ajax({
            method: "POST",
            url: "functions/handlewishlist.php",
            data: {
                "cart_id": cart_id,
                "scope": "delete" 
            },
            success: function (response) {
                if (response == 200) {
                    alertify.success("Item deleted successfully");
                    $('#mycart').load(location.href +  " #mycart")
                } else {
                    alertify.success(response);
                }
            }
        });
    });

});