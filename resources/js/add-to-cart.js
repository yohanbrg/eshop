$(function () {
    $('.add-to-cart').click(function () {
        var addToCartEndpoint = "addtocart/";
        var selectedProductId = $(this).data('product-id');
        $.post(addToCartEndpoint + selectedProductId, function (data) {
            $('#cart-count').text(data.new_count_items);
            $('#modal-success-add-cart-items').modal({
                show:true
            })
        }).fail(function(data){
            console.log('toto');
        });
    });
});