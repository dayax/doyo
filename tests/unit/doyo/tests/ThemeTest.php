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

use doyo\tests\BaseTestCase;
use doyo\Theme;

class FooTheme extends Theme
{
    public function __construct()
    {
        $this->init();
    }
}
/**
 * Description of ThemeTest
 *
 * @author Anthonius Munthi <me@itstoni.com>
 */
class ThemeTest extends BaseTestCase
{
    /**
     * @dataProvider getDefaultState
     */
    public function testShouldConfiguredDefaultState($method,$expected)
    {        
        
        $theme = new FooTheme();        
        $this->assertEquals($theme->$method(),$expected);        
    }
    
    public function getDefaultState()
    {
        return array(
            array('isLive',true)
        );
    }
}
