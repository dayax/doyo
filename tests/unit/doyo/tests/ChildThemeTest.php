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
use \doyo\Theme;
class ChildThemeTest extends ThemeTestCase
{

    public function setUp()
    {
        parent::setUp();
        switch_theme('doyo-child');        
    }

    public function testChildThemeShouldLoaded()
    {
        $theme = wp_get_theme();
        
        $this->assertEquals('Doyo Child Theme',$theme);
        $this->assertTrue(Theme::getInstance()->isChildTheme());
    }
    
    public function testShouldLoadChildStyle()
    {                        
        $this->assertStyleLoaded('doyo-child-style');        
    }
    
    
    
}