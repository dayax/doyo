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
    
    private function __construct(){}
        
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
    
    public function cleanupScripts()
    {
        
    }
}