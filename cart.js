$(document).ready(function() {

    $(document).ready(function() {
        // Increase quantity
        $(document).on('click', '.increase-qty', function() {
            const $input = $(this).closest('.quantity-control').find('.qty-input');
            $input.val(parseInt($input.val()) + 1);
            updateCart();
        });

        // Decrease quantity
        $(document).on('click', '.decrease-qty', function() {
            const $input = $(this).closest('.quantity-control').find('.qty-input');
            if (parseInt($input.val()) > 1) {
                $input.val(parseInt($input.val()) - 1);
                updateCart();
            }
        });

        // Remove item
        $(document).on('click', '.remove-btn', function() {
            $(this).closest('.cart-item').remove();
            updateCart();
        });

        // Update cart totals
        function updateCart() {
            let subtotal = 0;

            $('.cart-item').each(function() {
                const $priceText = $(this).find('.price').text();
                const price = parseFloat($priceText.replace(/[^\d.]/g, ''));
                const qty = parseInt($(this).find('.qty-input').val());
                subtotal += price * qty;
            });

            const tax = subtotal * 0.17;
            const shipping = subtotal > 100 ? 0 : 9.99;
            const total = subtotal + tax + shipping;

            $('#subtotal').text('$' + subtotal.toFixed(2));
            $('#tax').text('$' + tax.toFixed(2));
            $('#shipping').text(shipping === 0 ? 'Free' : '$' + shipping.toFixed(2));
            $('#total').text('$' + total.toFixed(2));
        }

        // Initial cart update
        updateCart();
    });
});