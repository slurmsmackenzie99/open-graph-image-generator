<?php

defined('ABSPATH') || exit;

/**
 * Add Customizer Stuff
 */
function customize_author($wp_customize)
{
    if (is_author()) {
        $my_custom_avatar = get_avatar(get_the_author_meta('ID'), 200);
        $document = new DOMDocument();
        @$document->loadHTML($my_custom_avatar);
        $nodes = $document->getElementsByTagName('img');
        ?>
            <meta property="og:image" content="<?php echo $nodes->item(0)->getAttribute('src'); ?>" />
            <?php
    }
}

function ogio_customizer_fields($wp_customize)
{
    /**
     * Include custom controls
     */

    require_once __DIR__ .'/custom-controls.php';

    $wp_customize->add_section('ogio_settings', array(
        'title'      => 'OG Image Generator',
        'priority'   => 100,
    ));

    $wp_customize->add_setting('ogio_fallback_image', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'ogio_fallback_image', array(
        'label'       => __('Choose the fallback Image', 'ogio'),
        'description' => __('Choose the fallback Image. Its going the be used if the og:image tag is not present. Resolution required 1200px by 630px', 'ogio'),
        'section'     => 'ogio_settings',
        'settings'    => 'ogio_fallback_image',
    )));

    $wp_customize->add_setting('ogio_overlay_image', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'ogio_overlay_image', array(
        'label'       => __('Overlay Image', 'ogio'),
        'description' => __('Choose image overlay. (overlay width should not exceed fallback image width)', 'ogio'),
        'section'     => 'ogio_settings',
        'settings'    => 'ogio_overlay_image',
    )));

    $wp_customize->add_setting('ogio_overlay_position_x', array(
        'transport'         => 'refresh',
        'type'              => 'option',
        'sanitize_callback' => 'absint',
        'validate_callback' => 'validate_required_number',
        'default'           => 0,
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ogio_overlay_position_x', array(
        'label'       => __('Overlay postion on X axis', 'ogio'),
        'description' => __('Overlay postion on X axis', 'ogio'),
        'section'     => 'ogio_settings',
        'settings'    => 'ogio_overlay_position_x',
        'type'        => 'number',
        'input_attrs' => array(
            'min'     => 0
        ),
    )));

    $wp_customize->add_setting('ogio_overlay_position_y', array(
        'transport'         => 'refresh',
        'type'              => 'option',
        'sanitize_callback' => 'absint',
        'validate_callback' => 'validate_required_number',
        'default'           => 0,
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ogio_overlay_position_y', array(
        'label'       => __('Overlay postion on Y axis', 'ogio'),
        'description' => __('Overlay postion on Y axis', 'ogio'),
        'section'     => 'ogio_settings',
        'settings'    => 'ogio_overlay_position_y',
        'type'        => 'number',
        'input_attrs' => array(
            'min'     => 0
        ),
    )));

    $wp_customize->add_setting('ogio_select_author', array(
        'default'   => 'brak_autora',
        'transport' => 'refresh',
        'type'      => 'option',
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ogio_select_author', array(
        'label'        => __('Display author\'s name', 'ogio'),
        'section'      => 'ogio_settings',
        'settings'     => 'ogio_select_author',
        'type'         => 'radio',
        'choices'      => array(
            'autor'    => 'Yes',
            'brak_autora' => 'No'
        ),
    )));

    //ACF fields
    $wp_customize->add_setting('ogio_want_acf', array(
        'default'   => 'no_acf',
        'transport' => 'refresh',
        'type'      => 'option',
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ogio_want_acf', array(
        'label'        => __('Do you want to add ACF tags', 'ogio'),
        'description'  => __('ACF tags supported - og:title and og:description', 'ogio'),
        'section'      => 'ogio_settings',
        'settings'     => 'ogio_want_acf',
        'type'         => 'radio',
        'choices'      => array(
            'want_acf'    => 'Yes',
            'no_acf' => 'No'
        ),
    )));

        $wp_customize->add_setting('ogio_acf', array(
            'default'   => 'Price',
            'transport' => 'refresh',
            'type'      => 'text',
        ));



    $wp_customize->add_setting('ogio_select_seo_plugin', array(
        'default'   => 'other',
        'transport' => 'refresh',
        'type'      => 'option',
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ogio_select_seo_plugin', array(
        'label'        => __('Choose SEO plugin', 'ogio'),
        'section'      => 'ogio_settings',
        'settings'     => 'ogio_select_seo_plugin',
        'type'         => 'radio',
        'choices'      => array(
            'yoast'    => 'Yoast Seo',
            'rankmath' => 'Rank Math',
            'other'    => 'Don\'t turn on automatic integration (not recommended)'
        ),
    )));

    $wp_customize->add_setting('ogio_plugin_compatibility_notice', array());
    $wp_customize->add_control(new Info_Custom_control($wp_customize, 'ogio_plugin_compatibility_notice', array(
        'label'       => __('This plugin works best with either of these SEO: Yoast SEO or Rank Math SEO. If you\'re not using either of them you can manually set the Open Graph Image.', 'ogio'),
        'settings'    => 'ogio_plugin_compatibility_notice',
        'section'     => 'ogio_settings',
    )));

    $wp_customize->add_setting('ogio_select_seo_plugin', array(
        'default'   => 'other',
        'transport' => 'refresh',
        'type'      => 'option',
    ));
}

add_action('customize_register', 'ogio_customizer_fields');

function validate_required_number($validity, $value)
{
    if ($value < 0 || $value == '') {
        $validity->add('required', __('Selecting a numer is required.'));
    }
    return $validity;
}

function validate_required_choice($validity, $value)
{
    if (empty($value)) {
        $validity->add('required', __('You need to select one of the options'));
    }
    return $validity;
}
