<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general_settings',
        'title'       => 'General Settings'
      ),
      array(
        'id'          => 'social_profile_url',
        'title'       => 'Social Profile Url'
      ),
      array(
        'id'          => 'javascripts',
        'title'       => 'Javascripts'
      ),
      array(
        'id'          => 'bitly',
        'title'       => 'bitly service'
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'theme_mode',
        'label'       => 'Development Mode',
        'desc'        => '',
        'std'         => 'live',
        'type'        => 'radio',
        'section'     => 'general_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'live',
            'label'       => 'Live',
            'src'         => ''
          ),
          array(
            'value'       => 'development',
            'label'       => 'Development',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'website_description',
        'label'       => 'Website Description',
        'desc'        => '',
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'general_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'profile_photo',
        'label'       => 'Profile Photo',
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'google_analytics_id',
        'label'       => 'Google Analytics ID',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'general_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'facebook_url',
        'label'       => 'Facebook',
        'desc'        => '',
        'std'         => 'https://facebook.com/toni.munthi',
        'type'        => 'text',
        'section'     => 'social_profile_url',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'twitter_url',
        'label'       => 'Twitter',
        'desc'        => '',
        'std'         => 'https://twitter.com/tonimunthi',
        'type'        => 'text',
        'section'     => 'social_profile_url',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'google_url',
        'label'       => 'Google',
        'desc'        => '',
        'std'         => 'https://plus.google.com/109658097907501597403',
        'type'        => 'text',
        'section'     => 'social_profile_url',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'github_url',
        'label'       => 'GitHub',
        'desc'        => '',
        'std'         => 'https://github.com/tonimunthi',
        'type'        => 'text',
        'section'     => 'social_profile_url',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'google_api_client_id',
        'label'       => 'Google API Client ID',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_profile_url',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'twitter_user_name',
        'label'       => 'Twitter User Name for this site',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_profile_url',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'facebook_app_id',
        'label'       => 'Facebook Application ID',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_profile_url',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'facebook_app_secret',
        'label'       => 'Facebook Application Secret',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_profile_url',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'twitter_app_id',
        'label'       => 'Twitter Application ID',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_profile_url',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'javascript_bootstrap',
        'label'       => 'Bootstrap',
        'desc'        => '',
        'std'         => 'a:4:{i:0;s:25:"doyo-bootstrap-transition";i:1;s:20:"doyo-bootstrap-modal";i:2;s:23:"doyo-bootstrap-dropdown";i:5;s:18:"doyo-bootstrap-tab";}',
        'type'        => 'checkbox',
        'section'     => 'javascripts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'doyo-bootstrap-transition',
            'label'       => 'Transitions',
            'src'         => ''
          ),
          array(
            'value'       => 'doyo-bootstrap-modal',
            'label'       => 'Modals',
            'src'         => ''
          ),
          array(
            'value'       => 'doyo-bootstrap-dropdown',
            'label'       => 'Dropdowns',
            'src'         => ''
          ),
          array(
            'value'       => 'doyo-bootstrap-scrollspy',
            'label'       => 'Scrollspy',
            'src'         => ''
          ),
          array(
            'value'       => 'doyo-bootstrap-tab',
            'label'       => 'Togglable Tabs',
            'src'         => ''
          ),
          array(
            'value'       => 'doyo-bootstrap-tooltip',
            'label'       => 'Tooltips',
            'src'         => ''
          ),
          array(
            'value'       => 'doyo-bootstrap-popover',
            'label'       => 'Popovers (requires Tooltips)',
            'src'         => ''
          ),
          array(
            'value'       => 'doyo-bootstrap-affix',
            'label'       => 'Affix',
            'src'         => ''
          ),
          array(
            'value'       => 'doyo-bootstrap-alert',
            'label'       => 'Alert Messages',
            'src'         => ''
          ),
          array(
            'value'       => 'doyo-bootstrap-button',
            'label'       => 'Buttons',
            'src'         => ''
          ),
          array(
            'value'       => 'doyo-bootstrap-collapse',
            'label'       => 'Collapse',
            'src'         => ''
          ),
          array(
            'value'       => 'doyo-bootstrap-carousel',
            'label'       => 'Carousel',
            'src'         => ''
          ),
          array(
            'value'       => 'doyo-bootstrap-typeahead',
            'label'       => 'Typeahead',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'javascript_theme',
        'label'       => 'Theme',
        'desc'        => '',
        'std'         => 'a:2:{i:0;s:12:"doyo-fittext";i:1;s:15:"doyo-theme-main";}',
        'type'        => 'checkbox',
        'section'     => 'javascripts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'doyo-fittext',
            'label'       => 'Fit Text',
            'src'         => ''
          ),
          array(
            'value'       => 'doyo-prismjs',
            'label'       => 'PrismJS Syntax Highlighting',
            'src'         => ''
          ),
          array(
            'value'       => 'doyo-theme-main',
            'label'       => 'Theme Main Javascript',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'bitly_service_active',
        'label'       => 'Use Bitly Shortener',
        'desc'        => '',
        'std'         => 'no',
        'type'        => 'radio',
        'section'     => 'bitly',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => 'no',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'bitly_login',
        'label'       => 'Bitly API Login',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'bitly',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'bitly_api_key',
        'label'       => 'Bitly API Key',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'bitly',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'bitly_domain',
        'label'       => 'Bitly Domain',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'bitly',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}