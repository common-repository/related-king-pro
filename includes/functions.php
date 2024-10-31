<?php
    function relkp_catch_that_image($post_ID, $data = 'src', $width = '295', $height = '180', $placeholder = false) {
    
        $post_thumbnail_id = get_post_thumbnail_id($post_ID);
        if ($post_thumbnail_id) {
            switch($data) {
                case 'src':
                    $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, array($width, $height));
                    return $post_thumbnail_img[0];
                    break;

                case 'alt':
                    $post_thumbnail_alt = get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true);
                    return $post_thumbnail_alt;
                    break;

                case 'title':
                    $post_thumbnail_title = get_the_title($post_thumbnail_id);
                    return $post_thumbnail_title;
                    break;
            }

        }

        $post_info = get_post($post_ID);
        $post_content = $post_info->post_content;


        $first_img = '';
        ob_start();
        ob_end_clean();
        switch($data) {
            case 'src':
                $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post_content, $matches);
                $first_img = $matches[1][0];
                break;

            case 'alt':
                $output = preg_match_all('/<img.+alt=[\'"]([^\'"]+)[\'"].*>/i', $post_content, $matches);
                $first_alt = $matches[1][0];
                if (empty($first_alt)) return '';
                else return $first_alt;
                break;

            case 'title':
                $output = preg_match_all('/<img.+title=[\'"]([^\'"]+)[\'"].*>/i', $post_content, $matches);
                $first_title = $matches[1][0];
                if (empty($first_title)) return '';
                else return $first_title;
                break;
        }
        
        if(empty($first_img) && $placeholder){ //Defines a default image
            $size = $width."x".$height;
          $first_img = "http://placehold.it/".$size;
        }
        return $first_img;
    }
    
    // Add scripts to page
    function relkp_styles() {
        wp_enqueue_style('relkp_default', plugins_url('css/relkp_default.css', dirname(__FILE__)), array(), '1.0', 'screen');
    }
    add_action('wp_enqueue_scripts', 'relkp_styles');
?>
