$(function () {
    $('.remove-cart-item').click(function(){
        var removeFromCartEndpoint = "remove-from-cart/";
        var selectedProductContainer = $(this).parents().eq(1);
        var selectedProductId = selectedProductContainer.data('product-id');
        $.post(removeFromCartEndpoint + selectedProductId, function (data) {
            if(data.new_count_items < 1){
                $('.cart-list').hide();
                $('.no-items-in-cart-message').show();
            }
            $('#cart-count').text(data.new_count_items);
            selectedProductContainer.hide();
            $('#cart-total-cost').text(data.new_total_cost);
        });
    });
});