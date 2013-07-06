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
 * .main classes
 */
function dyMainClass()
{
    if (dyDisplaySidebar()) {
        // Classes on pages with the sidebar
        $class = 'span8';
    } else {
        // Classes on full width pages
        $class = 'span12';
    }
    if (is_page()) {
        $class .= " page";
    }
    return $class;
}

/**
 * .sidebar classes
 */
function dySidebarClass()
{
    return 'span4';
}

/**
 * Define which pages shouldn't have the sidebar
 *
 * See lib/sidebar.php for more details
 */
function dyDisplaySidebar()
{
    $sidebar_config = new \doyo\Sidebar(
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
             */ array(
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