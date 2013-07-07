<?php

/*
 * This file is part of the {project_name}.
 *
 * (c) Anthonius Munthi <me@itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace doyo\tests;

use \dayax\wordpress\ThemeTestCase as BaseTestCase;

abstract class ThemeTestCase extends BaseTestCase
{
    public function setUp()
    {
        parent::setUp();
        $GLOBALS['wp_theme_directories'][] = dirname(DOYO_ROOT_DIR);
        switch_theme('doyo','doyo');
        require_once DOYO_ROOT_DIR.'/functions.php';
    }
    
    public function assertStyleLoaded($style)
    {        
        do_action('wp_enqueue_scripts');
        $ret = wp_style_is($style);        
        if(false===$ret){
            throw new \PHPUnit_Framework_ExpectationFailedException(sprintf(
                'Failed asserting that style "%s" is loaded', $style
            ));
        }
        $this->assertTrue($ret);
    }
    
    public function assertScriptLoaded($script,$message="")
    {
        $this->assertFalse(wp_script_is($script));
        do_action('wp_enqueue_scripts');
        $ret = wp_script_is($script);
        if(false===$ret){
            throw new \PHPUnit_Framework_ExpectationFailedException(sprintf(
                'Failed asserting that script "%s" is loaded', $script
            ));
        }
        $this->assertTrue($ret);
    }
}