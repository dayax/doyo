<?php

/*
 * This file is part of the {project_name}.
 *
 * (c) Anthonius Munthi <me@itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace doyo;

class Theme
{
    static $instance;
    
    protected $options = array(
        'mode' => 'live',
    );
    
    private function __construct()
    {
        $this->init();
    }
        
    /**
     * @return Theme
     */
    static public function getInstance()
    {
        if(!is_object(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function isChildTheme()
    {
        return get_template_directory() !== get_stylesheet_directory();
    }
    
    public function enqueueScripts()
    {
        wp_enqueue_style('doyo-bootstrap',__DIR__.'/less/bootstrap.less');
        if($this->isChildTheme()){            
            wp_enqueue_style('doyo-child-style',get_stylesheet_uri());
        }        
    }
    
    public function init()
    {
        global $ot_loader;
        
        $options = get_option('option_tree');
        
    }
    
    /**
     * Sets up theme defaults and registers the various WordPress features that
     * doyo theme supports.
     *
     * @uses load_theme_textdomain() For translation/localization support.
     * @uses add_editor_style() To add a Visual Editor stylesheet.
     * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
     * 	custom background, and post formats.
     * @uses register_nav_menu() To add support for navigation menus.
     * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
     *
     * @since doyo 1.0
     */
    public function setup()
    {
        // Makes doyo available for translation.
        load_theme_textdomain('doyo', get_template_directory().'/languages');

        // This theme styles the visual editor with editor-style.css to match the theme style.
        add_editor_style();

        // Adds RSS feed links to <head> for posts and comments.
        add_theme_support('automatic-feed-links');

        // This theme supports a variety of post formats.
        add_theme_support('post-formats', array('aside', 'image', 'link', 'quote', 'status'));

        // This theme uses wp_nav_menu() in one location.
        register_nav_menu('primary', __('Primary Menu', 'twentytwelve'));

        /*
         * This theme supports custom background color and image, and here
         * we also set up the default background color.
         */
        add_theme_support('custom-background', array(
            'default-color'=>'e6e6e6',
        ));

        // This theme uses a custom image size for featured images, displayed on "standard" posts.
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size( 750, 9999 ); // Unlimited height, soft crop
    }
    
    public function cleanupScripts()
    {
        
    }
    
    public function isLive()
    {
        return $this->options['mode']==='live' ? true:false;
    }
}