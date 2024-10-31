<div class="wrap">
    <?php screen_icon(); ?>
    <h2>Related King Pro</h2>
    
    <div class="kpp_block filled">
        <h2>Connect</h2>
        <div id="kpp_social">
            <div class="kpp_social facebook"><a href="https://www.facebook.com/KingProPlugins" target="_blank"><i class="icon-facebook"></i> <span class="kpp_width"><span class="kpp_opacity">Facebook</span></span></a></div>
            <div class="kpp_social twitter"><a href="https://twitter.com/KingProPlugins" target="_blank"><i class="icon-twitter"></i> <span class="kpp_width"><span class="kpp_opacity">Twitter</span></span></a></div>
            <div class="kpp_social google"><a href="https://plus.google.com/b/101488033905569308183/101488033905569308183/about" target="_blank"><i class="icon-google-plus"></i> <span class="kpp_width"><span class="kpp_opacity">Google+</span></span></a></div>
        </div>
        <h4>Found an issue? Post your issue on the <a href="http://wordpress.org/support/plugin/related-king-pro" target="_blank">support forums</a>. If you would prefer, please email your concern to <a href="mailto:plugins@kingpro.me">plugins@kingpro.me</a></h4>   
    </div>
    
    <div class="relkp_tabs">
        <a class="relkp_howto active">How-To</a>
        <a class="relkp_faq">FAQ</a>
    </div>
    
    <?php if (isset($_GET['settings-updated']) && $_GET['settings-updated'] === 'true') : ?>
    <div class="updated relkp_notice">
        <p><?php _e( "Settings have been saved", 'relkp_text' ); ?></p>
    </div>
    <?php elseif (isset($_GET['settings-updated']) && $_GET['settings-updated'] === 'false') : ?>
    <div class="error relkp_notice">
        <p><?php _e( "Settings have <strong>NOT</strong> been saved. Please try again.", 'relkp_text' ); ?></p>
    </div>
    <?php endif; ?>
    
    <div class="relkp_sections">

        <div id="relkp_howto" class="relkp_section active">
            <h2>How To</h2>
            <h3>Use Shortcodes</h3>
            <p>Shortcodes can be used in any page or post on your site. By default:</p>
            <pre>[relatedkingpro]</pre>
            <p>is defaulting to showing <strong>four</strong> related articles if it finds any matches, with images at 295px wide by 180px high and no placeholder. You can define your own settings by:</p>
            <pre>[relatedkingpro show="4" images=true width="295" height="180" placeholder=false]</pre>
            <p>To add this into a template, just use the "do_shortcode" function:</p>
            <pre>&lt;?php 
        if (function_exists('relatedkingpro_func'))
            echo do_shortcode("[relatedkingpro show='6']");
    ?&gt;</pre>
        </div>

        <div id="relkp_faq" class="relkp_section">
            <h2>FAQ</h2>
            <h4>Q. After activating this plugin, my site has broken! Why?</h4>
            <p>Nine times out of ten it will be due to your own scripts being added above the standard area where all the plugins are included. 
                If you move your javascript files below the function, "wp_head()" in the "header.php" file of your theme, it should fix your problem.</p>

            <h4>Found an issue? Post your issue on the <a href="http://wordpress.org/support/plugin/related-king-pro" target="_blank">support forums</a>. If you would prefer, please email your concern to <a href="mailto:plugins@kingpro.me">plugins@kingpro.me</a></h4>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery('.relkp_tabs a').click(function() {
        jQuery(this).parent().children('a.active').removeClass('active');
        jQuery('.relkp_sections').find('div.relkp_section.active').removeClass('active');
        
        var active = jQuery(this).attr('class');
        jQuery(this).addClass('active');
        jQuery("#"+active).addClass('active');
    });
</script>