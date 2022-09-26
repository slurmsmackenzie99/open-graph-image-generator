<?php defined( 'ABSPATH' ) || exit; ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php echo get_bloginfo('charset');?>" />
        <title><?php echo get_bloginfo('name'); ?></title>
        <?php if( is_customize_preview() ) wp_head();?>
	</head>
    <body class="ogio-preview" leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
        <div id="ogio_preview_wrapper">
            <div class="ogio-preview-fbbox">
                <div class="ogio-preview-top"></div>
                <div class="ogio-preview-caption">Example og:description from the meta tag</div>
                <div class="ogio-preview-image">
                    <?php
                        if ( get_option( 'ogio_overlay_image' ) ) {
                        $overlay_image        = get_option( 'ogio_overlay_image' );
                        $overlay_image_url    = wp_get_attachment_url( $overlay_image );
                        $overlay_position_x   = get_option( 'ogio_overlay_position_x' );
                        $overlay_position_y   = get_option( 'ogio_overlay_position_y' );
                    ?>
                        <img
                        style="left: <?php echo $overlay_position_x ? $overlay_position_x : '0' ?>px; top: <?php echo  $overlay_position_y ? $overlay_position_y : '0' ?>px"
                        src="<?php echo $overlay_image_url; ?>" alt="Your Open Graph Image" />
                    <?php } ?>
                </div>
                <div class="ogio-preview-share-info">
                    <div class="preview-link-info-icon" title="Make sure you consider this icon as it can cover the overlay a bit!"></div>
                    <div class="preview-link-domain"></div>
                    <div class="preview-link-title"></div>
                    <div class="preview-link-description"></div>
                </div>
                <div class="ogio-preview-bottom"></div>
                <div class="footer-small-disclaimer">* Required resolution is 1200px x 630px</div>
            </div>
            <div class="next-step-direction">
                <h3>Setup instructions</h3>
                <p>After changing the settings to customize your blog social media presence click on 'Publish' in the top left corner</p>
            </div>
        </div>
        <div class="itsmereal-footer">Plugin for WordPress developed by <a href='' onClick="window.open('https://webcrafters.pl/', '_blank')">Webcrafters</a></div>
    <?php if( is_customize_preview() ) wp_footer();?>
    </body>
</html>
