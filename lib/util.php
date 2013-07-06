<?php

/*
 * This file is part of the {project_name}.
 *
 * (c) Anthonius Munthi <me@itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

function dyOption($option_id, $default = null)
{
    /* get the saved options */
    $options = get_option('option_tree');

    /* look for the saved value */
    if (isset($options[$option_id]) && '' != $options[$option_id]) {
        return $options[$option_id];
    }
    return $default;
}

/**
 * $content_width is a global variable used by WordPress for max image upload sizes
 * and media embeds (in pixels).
 *
 * Example: If the content area is 640px wide, set $content_width = 620; so images and videos will not overflow.
 * Default: 940px is the default Bootstrap container width.
 */
if (!isset($content_width)) {
    $content_width = 940;
}

function dyTemplatePath()
{
    return \doyo\Wrapper::$main_template;
}

function dySidebarPath()
{
    return \doyo\Wrapper::sidebar();
}

/**
 * .main classes
 */
function dyMainClass() {
  if (dyDisplaySidebar()) {
    // Classes on pages with the sidebar
    $class = 'span8';
  } else {
    // Classes on full width pages
    $class = 'span12';
  }
  if(is_page()){
      $class .= " page";
  }
  return $class;
}

/**
 * .sidebar classes
 */
function dySidebarClass() {
  return 'span4';
}

/**
 * Define which pages shouldn't have the sidebar
 *
 * See lib/sidebar.php for more details
 */
function dyDisplaySidebar() {
  $sidebar_config = new doyo\Sidebar(
    /**
     * Conditional tag checks (http://codex.wordpress.org/Conditional_Tags)
     * Any of these conditional tags that return true won't show the sidebar
     *
     * To use a function that accepts arguments, use the following format:
     *
     * array('function_name', array('arg1', 'arg2'))
     *
     * The second element must be an array even if there's only 1 argument.
     */
    array(
      'is_404',
      //'is_front_page'
    ),
    /**
     * Page template checks (via is_page_template())
     * Any of these page templates that return true won't show the sidebar
     */
    array(
      'template-custom.php'
    )
  );

  return apply_filters('dyDisplaySidebar', $sidebar_config->display);
}

/**
 * $content_width is a global variable used by WordPress for max image upload sizes
 * and media embeds (in pixels).
 *
 * Example: If the content area is 640px wide, set $content_width = 620; so images and videos will not overflow.
 * Default: 940px is the default Bootstrap container width.
 */
if (!isset($content_width)) { $content_width = 940; }

/**
 * Page titles
 */
function dyPageTitle() {
  if (is_home()) {
    if (get_option('page_for_posts', true)) {
      echo get_the_title(get_option('page_for_posts', true));
    } else {
      echo _e('Latest Posts', 'doyo');
    }
  } elseif (is_archive()) {
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    if ($term) {
      echo $term->name;
    } elseif (is_post_type_archive()) {
      echo get_queried_object()->labels->name;
    } elseif (is_day()) {
      printf(__('Daily Archives: %s', 'doyo'), get_the_date());
    } elseif (is_month()) {
      printf(__('Monthly Archives: %s', 'doyo'), get_the_date('F Y'));
    } elseif (is_year()) {
      printf(__('Yearly Archives: %s', 'doyo'), get_the_date('Y'));
    } elseif (is_author()) {
      $author = get_queried_object();
      printf(__('Author Archives: %s', 'doyo'), $author->display_name);
    } else {
      printf(__('Category: %s', 'doyo'), single_cat_title('',false));
    }
  } elseif (is_search()) {
    printf(__('Search Results for %s', 'doyo'), get_search_query());
  } elseif (is_404()) {
    _e('Not Found', 'doyo');
  } else {
    the_title();
  }
}

// http://wordpress.stackexchange.com/a/12450
function dyJqueryLocalFallback($src, $handle) {
  static $add_jquery_fallback = false;

  if ($add_jquery_fallback) {
    echo '<script>window.jQuery || document.write(\'<script src="' . get_template_directory_uri() . '/assets/js/jquery-1.10.1.min.js"><\/script>\')</script>' . "\n";
    $add_jquery_fallback = false;
  }

  if ($handle === 'jquery') {
    $add_jquery_fallback = true;
  }

  return $src;
}

function dyGoogleAnalytics() {
?>
<script>
  (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
  function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
  e=o.createElement(i);r=o.getElementsByTagName(i)[0];
  e.src='//www.google-analytics.com/analytics.js';
  r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
  ga('create','<?php echo ot_get_option('google_analytics_id'); ?>');ga('send','pageview');
</script>

<?php }
if ('' !== ot_get_option('google_analytics_id','')) {
  add_action('wp_footer', 'dyGoogleAnalytics', 20);
}



function dyIsElementEmpty($element) {
  $element = trim($element);
  return empty($element) ? false : true;
}

function dyRemoveSpaceInComma($text)
{
    $text = preg_replace('/\s*,\s*/', ',', $text);
    return $text;
}

function dyHighlighter()
{
    if(!is_single()){
        echo '<script type="text/javascript">var doyoHighlightedWords = null;</script>';
        return;
    }
    
    $words = get_post_meta(get_the_id(),'doyo_highlight_code');
    $words = implode(',',$words);
    $words = dyRemoveSpaceInComma($words);    
    $words = explode(',',$words);
    
    doyo::getInstance()->log('HIGHLIGHTED :'.print_r($words,true));
    
    $json = json_encode($words);
    $content = '<script type="text/javascript">var doyoHighlightedWords = '.$json.';</script>';
    echo $content;
}
add_action('wp_footer','dyHighlighter',0);

/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own twentyeleven_posted_on to override in a child theme
 *
 * @since Twenty Eleven 1.0
 */
function dyPostedOn() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'doyo' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'doyo' ), get_the_author() ) ),
		get_the_author()
	);
}

/**
 * Resize images dynamically using wp built in functions
 * Victor Teixeira
 *
 * Modified by Foxinni, 23-07-2012 (Added multisite support)
 * Modified by Anthonius Munthi, 2013-07-02 (Wordpress compatibility)
 *
 * php 5.2+
 *
 * Exemplo de uso:
 * 
 * <?php 
 * $thumb = get_post_thumbnail_id(); 
 * $image = vt_resize( $thumb, '', 140, 110, true );
 * ?>
 * <img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" />
 * 
 * @global int $blog_id
 * @param int $attach_id
 * @param string $img_url
 * @param int $width
 * @param int $height
 * @param bool $crop
 * @return array
 */
function vt_resize($attach_id = null, $width, $height, $crop = false)
{
    global $blog_id;
    
    $image_src = wp_get_attachment_image_src($attach_id, 'full');        
    doyo::log($attach_id. " ".print_r($image_src,TRUE));    
    // this is an attachment, so we have the ID
    if(false==$image_src) {

        $file_path = parse_url($attach_id);
        $file_path = $_SERVER['DOCUMENT_ROOT'].$file_path['path'];

        //Check for MultiSite blogs and str_replace the absolute image locations
        if (is_multisite()) {
            $blog_details = get_blog_details($blog_id);
            $file_path = str_replace($blog_details->path.'files/', '/wp-content/blogs.dir/'.$blog_id.'/files/', $file_path);
        }

        //$file_path = ltrim( $file_path['path'], '/' );
        //$file_path = rtrim( ABSPATH, '/' ).$file_path['path'];

        $orig_size = getimagesize($file_path);

        $image_src[0] = $attach_id;
        $image_src[1] = $orig_size[0];
        $image_src[2] = $orig_size[1];
    }else{
        $file_path = get_attached_file($attach_id);
    }
    $file_info = pathinfo($file_path);
    
    $extension = '.'.$file_info['extension'];

    // the image path without the extension
    $no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];

    /* Calculate the eventual height and width for accurate file name */

    if ($crop == false) {
        $proportional_size = wp_constrain_dimensions($image_src[1], $image_src[2], $width, $height);
        $width = $proportional_size[0];
        $height = $proportional_size[1];
    }

    $cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;

    // checking if the file size is larger than the target size
    // if it is smaller or the same size, stop right here and return
    if ($image_src[1] > $width || $image_src[2] > $height) {

        // the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
        if (file_exists($cropped_img_path)) {

            $cropped_img_url = str_replace(basename($image_src[0]), basename($cropped_img_path), $image_src[0]);

            $vt_image = array(
                'url'=>$cropped_img_url,
                'width'=>$width,
                'height'=>$height
            );

            return $vt_image;
        }

        // $crop = false
        if ($crop == false) {

            // calculate the size proportionaly
            $proportional_size = wp_constrain_dimensions($image_src[1], $image_src[2], $width, $height);
            $resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;

            // checking if the file already exists
            if (file_exists($resized_img_path)) {

                $resized_img_url = str_replace(basename($image_src[0]), basename($resized_img_path), $image_src[0]);

                $vt_image = array(
                    'url'=>$resized_img_url,
                    'width'=>$proportional_size[0],
                    'height'=>$proportional_size[1]
                );

                return $vt_image;
            }
        }

        // no cache files - let's finally resize it
        $new_img_path = dyImageResize($file_path, $width, $height, $crop);
        $new_img_size = getimagesize($new_img_path);
        $new_img = str_replace(basename($image_src[0]), basename($new_img_path), $image_src[0]);

        // resized output
        $vt_image = array(
            'url'=>$new_img,
            'width'=>$new_img_size[0],
            'height'=>$new_img_size[1]
        );        

        return $vt_image;
    }

    // default output - without resizing
    $vt_image = array(
        'url'=>$image_src[0],
        'width'=>$image_src[1],
        'height'=>$image_src[2]
    );

    return $vt_image;
}

function dyImageResize($file, $max_w, $max_h, $crop = false, $suffix = null, $dest_path = null, $jpeg_quality = 90)
{
    //_deprecated_function(__FUNCTION__, '3.5', 'wp_get_image_editor()');

    $editor = wp_get_image_editor($file);
    if (is_wp_error($editor))
        return $editor;
    $editor->set_quality($jpeg_quality);

    $resized = $editor->resize($max_w, $max_h, $crop);
    if (is_wp_error($resized))
        return $resized;

    $dest_file = $editor->generate_filename($suffix, $dest_path);
    $saved = $editor->save($dest_file);

    if (is_wp_error($saved))
        return $saved;

    return $dest_file;
}

function dyFeaturedImage($max_width=null,$max_height=null)
{
    $thumb_id = get_post_thumbnail_id();
    if(is_null($thumb_id)){
        $thumb_id = get_template_directory_uri().'/assets/img/icon/articles.jpg';
        
    }
    $image = vt_resize($thumb_id,$max_width,$max_height);
    return $image;
}

function dyFeaturedImageThumb($max_width=50,$max_height=50)
{
    $thumb_id = get_post_thumbnail_id();
    if (is_null($thumb_id) || $thumb_id == '') {
        $thumb_id = get_template_directory_uri().'/assets/img/icon/articles.jpg';        
    }
    $image = vt_resize($thumb_id,$max_width,$max_height,true);
    return $image;
}

function dyPostMeta($key,$single=true)
{
    $meta = get_post_meta(get_the_ID(),$key,$single);    
    return $meta=='' || $meta==null ? null:$meta;
}

function dyGetPostLink()
{
    $option = ot_get_option('general_use_shortlink','true');    
    if($option=='true'){        
        return wp_get_shortlink(get_the_ID());
    }
    return get_permalink();
}


?>