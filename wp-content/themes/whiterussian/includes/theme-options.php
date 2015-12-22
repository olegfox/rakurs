<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  
  /* OptionTree is not loaded yet */
  if ( ! function_exists( 'ot_settings_id' ) )
    return false;
    
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( ot_settings_id(), array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => __( '<p>Sidebar content goes here!</p>', 'theme-options.php' )
    ),
    'sections'        => array( 
      array(
        'id'          => 'general',
        'title'       => __( 'General', 'theme-options.php' )
      ),
      array(
        'id'          => 'dev',
        'title'       => __( 'Dev', 'theme-options.php' )
      ),
      array(
        'id'          => 'brands',
        'title'       => __( 'Brands', 'theme-options.php' )
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'phone',
        'label'       => __( 'Phone', 'theme-options.php' ),
        'desc'        => __( 'Введите сюда номер телефона', 'theme-options.php' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'contacts',
        'label'       => __( 'Contacts', 'theme-options.php' ),
        'desc'        => __( 'Введите сюда контактные данные в подвал сайта', 'theme-options.php' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'ad',
        'label'       => __( 'Рекламный блок', 'theme-options.php' ),
        'desc'        => __( '220x366px', 'theme-options.php' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'adlink',
        'label'       => __( 'Ссылка', 'theme-options.php' ),
        'desc'        => __( 'Введите сюда ссылку с баннера', 'theme-options.php' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),      
      array(
        'id'          => 'head',
        'label'       => __( 'Head', 'theme-options.php' ),
        'desc'        => __( 'Enter custom code in head of your site', 'theme-options.php' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'dev',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'analytics',
        'label'       => __( 'Analytics', 'theme-options.php' ),
        'desc'        => __( 'Enter analytics code', 'theme-options.php' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'dev',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'custom_css',
        'label'       => __( 'Custom CSS', 'theme-options.php' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'dev',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'omron',
        'label'       => __( 'Omron', 'theme-options.php' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'brands',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'is_form',
            'label'       => __( 'Будет ли отображаться в форме', 'theme-options.php' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'checkbox',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
      array(
        'id'          => 'schneider_electric',
        'label'       => __( 'Schneider-electric', 'theme-options.php' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'brands',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'yaskawa',
        'label'       => __( 'Yaskawa', 'theme-options.php' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'brands',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'siemens',
        'label'       => __( 'Siemens', 'theme-options.php' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'brands',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'tr_electronic',
        'label'       => __( 'Tr-electronic', 'theme-options.php' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'brands',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'cognex',
        'label'       => __( 'Cognex', 'theme-options.php' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'brands',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'optex_fa',
        'label'       => __( 'Optex-fa', 'theme-options.php' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'brands',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings ); 
  }
  
  /* Lets OptionTree know the UI Builder is being overridden */
  global $ot_has_custom_theme_options;
  $ot_has_custom_theme_options = true;
  
}