<?php
//Modify the footer admin
add_filter('update_footer', 'change_admin_footer', 999);
function change_admin_footer()
{
    $left = '<p id="footer-left" class="alignleft"><strong><i class="ui icon github"></i> </strong>Backfront</p>';
    $right = '<p id="footer-upgrade" class="alignright"><a href="http://alvesdouglas.com.br/projects/umbrella"><strong>Umbrella</strong></a><i> version ' . UMB_PLUGIN_VERSION . '</i></p>';
    return $left . $right;
}


//Remove menssage default of wordpress
add_filter('admin_footer_text', function() {
    return;
});
