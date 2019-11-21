$(function () {
    var quantityInput = $('.cart-item-quantity');
    quantityInput.change(function () {
        var updateItemQuantityEndpoint = "update-item-quantity/";
        var selectedProductContainer = $(this).parents().eq(1);
        var selectedProductId = selectedProductContainer.data('product-id');
        var newSelectedQuantity = $(this).val();
        $.post(updateItemQuantityEndpoint + selectedProductId, {
            'new_selected_quantity' : newSelectedQuantity
        }).done(function(data){
            selectedProductContainer.find(quantityInput).removeClass('is-invalid');
            $('#cart-count').text(data.new_count_items);
            $('#cart-total-cost').text(data.new_total_cost);
        }).fail(function(data){
            var invalidBox = selectedProductContainer.find('.invalid-feedback');
            selectedProductContainer.find(quantityInput).addClass('is-invalid');
            if(newSelectedQuantity < 1){
                invalidBox.text("Sélectionner une quantité supérieure à 0");
            }
            else{
                invalidBox.text("Il ne reste plus que " + selectedProductContainer.data('product-stock') + " exemplaires de ce produit, merci de choisir une quantité inférieure");
            }
        }); 
            
    });
});