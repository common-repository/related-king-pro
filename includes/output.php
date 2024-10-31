<?php

// [relatedkingpro show="4" images=true width="295" height="180" placeholder=false]
function relatedkingpro_func( $atts ) {
	extract( shortcode_atts( array(
		'show' => '4',
                'images' => true,
                'width' => '295',
                'height' => '180',
                'placeholder' => false
	), $atts ) );
        
        $output = '';
        
        if ($images == 'false') $images = false;
        if ($placeholder == 'false') $placeholder = false;
        
        global $tags, $tag_query, $post;
        
        if (isset($post->ID)) :
            $posttags = get_the_tags($post->ID);

            if (!empty($posttags)) :
                $i=0; 

                foreach($posttags as $key => $tag) {

                   $tags[$i] = $tag->name;
                   $i++;                   
                }

                $show_tags_or = implode(",",$tags);
                $tag_query = 'tag='.$show_tags_or.'';
                query_posts($tag_query);
                $thePostID = $post->ID;
                $counter=1;

                while(have_posts()) : the_post();

                    if($counter<$show && $thePostID !=$post->ID): ob_start();
            ?>
                
                    <div class="relkp_article ra<?= $counter ?>"> 
                        <?php if ($images) : ?>
                        <div class="relkp_article_image">
                            <div class="img">
                                <a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark">
                                    <img src="<?= relkp_catch_that_image(get_the_ID(), 'src', $width, $height, $placeholder); ?>" alt="<?= relkp_catch_that_image(get_the_ID(), 'alt'); ?>" style="width: 100%;" />
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="relkp_article_title">
                            <a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
                        </div>
                    </div>
            <?php $counter++;
                $output .= ob_get_clean();
                  endif; 
                endwhile; 
                wp_reset_query(); 
             endif;
        endif;
        
        if (!empty($output)) $output = "<div class='relkp_container'>".$output."</div>";
        
	return $output;
}
add_shortcode( 'relatedkingpro', 'relatedkingpro_func' );
?>
