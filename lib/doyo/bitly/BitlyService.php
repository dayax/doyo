<?php

/*
 * This file is part of the {project_name}.
 *
 * (c) Anthonius Munthi <me@itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__.'/bitly/Bitly.php';

class BitlyService extends Bitly
{
    
    static private $instance;
        
    /**
     * Constructor PHP5.
     * 
     * @since 1.0.0
     */
    private function __construct()
    {
        
    }
    
    public function registerHooks()
    {
        /* Load the translation file for current language. */
        //load_plugin_textdomain('bitly-service', false, 'bitly-service/languages');

        /* Shortlink filter. */
        add_filter('pre_get_shortlink', array(&$this, 'getShortlink'), 10, 4);

        /* Rewrite Admin Bar (WP 3.1+). */
        //add_action('admin_bar_menu', array(&$this, 'adminBarMenu'), 99);

        /* Register QR Code shortcode. */
        add_action('init', array($this, 'shortcodes'));

        /* Admin functions. */
        add_action('wp_loaded', array(&$this, 'onWpLoaded'));
        
        
        add_action('save_post', array(&$this,'onSavePost'),99);
        doyo::log("hooks registered");
        
        /* Deactivation. */
        //register_deactivation_hook(__FILE__, array(&$this, 'bitly_desactivation'));
    }
    
    public function onSavePost($post_id)
    {        
        return;
        $url = get_permalink($post_id);

        $domain = ot_get_option('bitly_domain');
        $this->login(ot_get_option('bitly_login'));
        $this->apiKey(ot_get_option('bitly_api_key'));
        $shortlink = $this->shorten($url, $domain);

        if (!empty($shortlink)) {
            update_metadata('post', $post_id, '_bitly_shortlink', $shortlink);
            return $shortlink;
        }
        doyo::log('will save post');
    }
    
    /**
     * Return a shortlink for a post, page, attachment, or blog.
     * 
     * @since 1.0.0
     */
    public function getShortlink($shortlink, $id, $context, $allow_slugs)
    {        
        if(ot_get_option('bitly_service_active')=='no'){
            return false;
        }
       
        
        if (is_singular() && is_preview()){
            return false;
        }

        global $wp_query;
                

        $post_id = '';

        if ('query' == $context && is_singular())
            $post_id = $wp_query->get_queried_object_id();

        else if ('post' == $context) {
            $post = get_post($id);
            $post_id = $post->ID;
        }

        if ($shortlink = get_metadata('post', $post_id, '_bitly_shortlink', true)){
            return $shortlink;
        }
        
        if ( is_front_page() && !is_paged() ){
			return apply_filters( 'bitly_front_page', false );
        }

        $url = get_permalink($post_id);

        $domain = ot_get_option('bitly_domain');
        $this->login(ot_get_option('bitly_login'));
        $this->apiKey(ot_get_option('bitly_api_key'));
        $shortlink = $this->shorten($url, $domain);

        if (!empty($shortlink)) {
            update_metadata('post', $post_id, '_bitly_shortlink', $shortlink);
            return $shortlink;
        }

        return false;
    }

    /**
     * Creates new shortcodes for display the QR Code image.
     *
     * @since 1.1.0
     */
    public function shortcodes()
    {
        add_shortcode('qrcode', array($this, 'qrcodeShortcode'));
    }

    /**
     * Shortcode to display the QR Code image.
     *
     * @since 1.1.0
     * @param array $attr The arguments.
     */
    public function qrcodeShortcode($attr)
    {
        global $wp_query;

        $image = '';

        $attr = shortcode_atts(array(
            'url'=>'',
            'size'=>'',
                ), $attr);

        extract($attr);

        $info = $this->info($url);

        if (isset($info['error']) || empty($url)) {
            return;
        }

        $cache_dir = plugin_dir_path(__FILE__).'library/cache/';
        $cache_url = plugin_dir_url(__FILE__).'library/cache/';

        $image = $this->qrcode($url, absint($size), $cache_dir);

        list( $size ) = @getimagesize("{$cache_url}{$image}");

        $image = "<img class ='qrcode' src='{$cache_url}{$image}' alt='{$url}' width='{$size}' height='{$size}' />";

        return "<p><a class='bitly' href='{$url}' rel='shortlink'>{$image}</a></p>";
    }

    /**
     * Setup the admin hooks, actions and filters.
     * 
     * @since 1.0.0
     */
    public function onWpLoaded()
    {
        if (is_admin()) {
            //add_action('admin_menu', 'bitly_admin_setup');
            add_action('save_post', array(&$this, 'cacheDelete'));
            add_action('added_post_meta', array(&$this, 'cacheDelete'));
            add_action('updated_post_meta', array(&$this, 'cacheDelete'));
            add_action('deleted_post_meta', array(&$this, 'cacheDelete'));
            //add_filter('plugin_action_links', 'bitly_service_action_link', 10, 2);
        }
    }

    /**
     * Removes all the cache.
     *
     * @since 1.0.0
     */
    public function deactivation()
    {

        delete_metadata('post', false, '_bitly_shortlink', '', true);

        delete_option('bitly_settings');
    }

    /**
     * Removes the cache of a post.
     *
     * @since 1.0.0
     * @param int $post_ID A post or blog id.
     */
    public function cacheDelete($post_id)
    {
        delete_metadata('post', $post_id, '_bitly_shortlink');        
    }
    
    static public function getInstance()
    {
        if(is_null(self::$instance)){
            self::$instance = new BitlyService();
        }
        return self::$instance;
    }
}

BitlyService::getInstance()->registerHooks();