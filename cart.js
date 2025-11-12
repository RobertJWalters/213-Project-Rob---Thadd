$(document).ready(function() {
    const $cart = $('.cart-sidebar');
    const $overlay = $('#cart-overlay');
    const $cartIcon = $('.cart');
    const $closeBtn = $('.close-btn');

    // Open cart when clicking cart icon
    $cartIcon.on('click', function(e) {
        e.stopPropagation();
        $cart.addClass('active');
        $overlay.addClass('active');
    });

    // Close cart when clicking close button
    $closeBtn.on('click', function() {
        $cart.removeClass('active');
        $overlay.removeClass('active');
    });

    // Close cart when clicking overlay
    $overlay.on('click', function() {
        $cart.removeClass('active');
        $overlay.removeClass('active');
    });

    // Prevent closing cart when clicking inside cart sidebar
    $cart.on('click', function(e) {
        e.stopPropagation();
    });

    // Close cart when clicking anywhere else on the page
    $(document).on('click', function() {
        $cart.removeClass('active');
        $overlay.removeClass('active');
    });

    // Remove item functionality
    $('.remove-btn').on('click', function() {
        $(this).closest('.cart-item').fadeOut(300, function() {
            $(this).remove();
        });
    });
});