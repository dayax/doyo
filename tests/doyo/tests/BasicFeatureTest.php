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
class BasicFeatureTest extends ThemeTestCase
{
    public function testShouldLoadDoyoTheme()
    {
        $this->assertTrue( 'doyo' == wp_get_theme() );
        $this->assertFalse(Theme::getInstance()->isChildTheme());
    }
    
    public function testShouldLoadJquery()
    {
        $this->assertScriptLoaded('jquery');
    }
    
    public function testShouldLoadModernizr()
    {
        $this->assertScriptLoaded('modernizr');
    }
    
    public function testShouldLoadBootstrapCss()
    {        
        $this->assertStyleLoaded('doyo-bootstrap');
    }
    
    public function testShouldLoadBootstrapResponsiveCss()
    {        
        $this->assertStyleLoaded('doyo-responsive');
    }
    
    public function testShouldLoadThemeCss()
    {        
        $this->assertStyleLoaded('doyo-theme');
    }
}