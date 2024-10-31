<?php

function relkp_check_page($hook) {
    global $current_screen;
    $relkp_pages = array('king-pro-plugins_page_relatedkingpro', "toplevel_page_kpp_menu");
    
    if (in_array($hook, $relkp_pages)) return true;
    return false;
}

// Styling for the custom post type icon
function wpt_relkp_icons() {
    ?>
    <style type="text/css" media="screen">
        #toplevel_page_kpp_menu .wp-menu-image {
            background: url(<?= plugins_url('/images/kpp-icon_16x16_sat.png', dirname(__FILE__)) ?>) no-repeat center center !important;
        }
	#toplevel_page_kpp_menu:hover .wp-menu-image, #toplevel_page_kpp_menu.wp-has-current-submenu .wp-menu-image {
            background: url(<?= plugins_url('/images/kpp-icon_16x16.png', dirname(__FILE__)) ?>) no-repeat center center !important;
        }
	#icon-options-general.icon32-posts-kpp_menu, #icon-kpp_menu.icon32 {background: url(<?= plugins_url('/images/kpp-icon_32x32.png', dirname(__FILE__)) ?>) no-repeat;}
    </style>
<?php }
add_action( 'admin_head', 'wpt_relkp_icons' );

function relkp_enqueue($hook) {
    if (relkp_check_page($hook)) :
        wp_register_style( 'relkp_css', plugins_url('css/relatedkingpro-styles.css', dirname(__FILE__)), false, '1.0.0' );
        wp_register_style( 'fontawesome', plugins_url('css/font-awesome.min.css', dirname(__FILE__)), false, '3.2.1');

        wp_enqueue_style( 'relkp_css' );
        wp_enqueue_style( 'fontawesome' );
        wp_enqueue_style( 'thickbox' );
        wp_enqueue_script( 'thickbox' );
    endif;
}
add_action( 'admin_enqueue_scripts', 'relkp_enqueue' );

// Add King Pro Plugins Section
if(!function_exists('find_kpp_menu_item')) {
  function find_kpp_menu_item($handle, $sub = false) {
    if(!is_admin() || (defined('DOING_AJAX') && DOING_AJAX)) {
      return false;
    }
    global $menu, $submenu;
    $check_menu = $sub ? $submenu : $menu;
    if(empty($check_menu)) {
      return false;
    }
    foreach($check_menu as $k => $item) {
      if($sub) {
        foreach($item as $sm) {
          if($handle == $sm[2]) {
            return true;
          }
        }
      } 
      else {
        if($handle == $item[2]) {
          return true;
        }
      }
    }
    return false;
  }
}

function relkp_add_parent_page() {
  if(!find_kpp_menu_item('kpp_menu')) {
    add_menu_page('King Pro Plugins','King Pro Plugins', 'manage_options', 'kpp_menu', 'kpp_menu_page');
  }
//  if(!function_exists('remove_submenu_page')) {
//    unset($GLOBALS['submenu']['kpp_menu'][0]);
//  }
//  else {
//    remove_submenu_page('kpp_menu','kpp_menu');
//  }
  
  add_submenu_page('kpp_menu', 'Related King Pro', 'Related King Pro', 'manage_options', 'relatedkingpro', 'relkp_settings_output');
}
add_action('admin_menu', 'relkp_add_parent_page');

if(!function_exists('kpp_menu_page')) {
    function kpp_menu_page() {
        include 'screens/kpp.php';
    }
}

function relkp_settings_output() {
    include 'screens/settings.php';
}
?>
