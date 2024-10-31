<?php
class RelatedKingPro_Widget extends WP_Widget {

	public function __construct() {
            parent::__construct(
                    'relatedkingpro_widget', // Base ID
                    'RelatedKingPro', // Name
                    array( 'description' => __( 'Display related posts by tags', 'text_domain' ), ) // Args
            );
	}

	public function widget( $args, $instance ) {
            
            extract( $args );
            $title = apply_filters( 'widget_title', $instance['title'] );
            $shownum = apply_filters( 'widget_shownum', $instance['shownum'] );
            $images = apply_filters( 'widget_images', $instance['images'] );
            $width = apply_filters( 'widget_width', $instance['width'] );
            $height = apply_filters( 'widget_height', $instance['height'] );
            $placeholder = apply_filters( 'widget_placeholder', $instance['placeholder'] );
            ?>
            <div class='relkp_widget'>
                <?php if ($title !== '') : ?><h4><?= $title ?></h4><?php endif; ?>
                <?php
                if (function_exists('relatedkingpro_func')){ 
                    echo do_shortcode('[relatedkingpro show="'.$shownum.'" width="'.$width.'" height="'.$height.'" placeholder="'.$placeholder.'"]');
                }
                ?>
            </div>
            <?php
	}

 	public function form( $instance ) {
            if ( isset( $instance[ 'title' ] ) ) {
                    $title = $instance[ 'title' ];
            }
            else {
                    $title = __( 'RELATED ARTICLES', 'text_domain' );
            }
            
            if ( isset( $instance[ 'shownum' ] ) ) {
                    $shownum = $instance[ 'shownum' ];
            }
            else {
                    $shownum = __( '4', 'text_domain' );
            }
            
            if ( isset( $instance[ 'images' ] ) ) {
                    $images = $instance[ 'images' ];
            }
            else {
                    $images = __( '1', 'text_domain' );
            }
            
            if ( isset( $instance[ 'width' ] ) ) {
                    $width = $instance[ 'width' ];
            }
            else {
                    $width = __( '295', 'text_domain' );
            }
            
            if ( isset( $instance[ 'height' ] ) ) {
                    $height = $instance[ 'height' ];
            }
            else {
                    $height = __( '180', 'text_domain' );
            }
            
            if ( isset( $instance[ 'placeholder' ] ) ) {
                    $placeholder = $instance[ 'placeholder' ];
            }
            else {
                    $placeholder = __( '0', 'text_domain' );
            }
            ?>
            <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'shownum' ); ?>"><?php _e( 'Number of Articles to show:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'shownum' ); ?>" name="<?php echo $this->get_field_name( 'shownum' ); ?>" type="text" value="<?php echo esc_attr( $shownum ); ?>" />
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'images' ); ?>"><?php _e( 'Display Images:' ); ?></label> 
            <input name="<?php echo $this->get_field_name( 'images' ); ?>" type="hidden" value="0" />
            <input class="widefat" id="<?php echo $this->get_field_id( 'images' ); ?>" name="<?php echo $this->get_field_name( 'images' ); ?>" type="checkbox" value="1"<?= (esc_attr( $images ) == "1") ? ' checked' : '' ?> />
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'width' ); ?>"><?php _e( 'Image Width:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>" />
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'height' ); ?>"><?php _e( 'Image Height:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo esc_attr( $height ); ?>" />
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'placeholder' ); ?>"><?php _e( 'Display Placeholder:' ); ?></label> 
            <input name="<?php echo $this->get_field_name( 'placeholder' ); ?>" type="hidden" value="0" />
            <input class="widefat" id="<?php echo $this->get_field_id( 'placeholder' ); ?>" name="<?php echo $this->get_field_name( 'placeholder' ); ?>" type="checkbox" value="1"<?= (esc_attr( $placeholder ) == "1") ? ' checked' : '' ?> />
            </p>
            <?php 
	}

	public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            $instance['shownum'] = ( !empty( $new_instance['shownum'] ) ) ? strip_tags( $new_instance['shownum'] ) : '4';
            $instance['images'] = ( !empty( $new_instance['images'] ) || $new_instance['images'] == '1' ) ? true : false;
            $instance['width'] = ( !empty( $new_instance['width'] ) ) ? strip_tags( $new_instance['width'] ) : '295';
            $instance['height'] = ( !empty( $new_instance['height'] ) ) ? strip_tags( $new_instance['height'] ) : '180';
            $instance['placeholder'] = ( !empty( $new_instance['placeholder'] ) || $new_instance['placeholder'] == '1' ) ? true : false;

            return $instance;
	}

}

function relkp_widget_registration() {
    register_widget( 'RelatedKingPro_Widget' );
}

add_action( 'widgets_init', 'relkp_widget_registration');
?>
