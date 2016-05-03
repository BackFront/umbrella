jQuery(document).ready(function ($) {
    $('.message .close').on('click', function () {
        $(this).closest('.message').transition('fade').hide( 300, function() { $(this).remove(); });
        //$( this ).parent().parent('.a').hide( 300, function() {$(this).remove();});
    });
});