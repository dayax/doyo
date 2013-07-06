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

class Hooks
{
    static public function register()
    {
        \add_filter('template_include', array('doyo\Wrapper', 'wrap'), 99);
        \add_filter('doyo_wrap_base', array('doyo\Wrapper', 'cleanupWrap'));
        
        $theme = Theme::getInstance();
        add_action('wp_enqueue_scripts',array($theme,'enqueueScripts'));
        add_action('wp_enqueue_scripts',array($theme,'cleanupScripts'),999);
    }
}