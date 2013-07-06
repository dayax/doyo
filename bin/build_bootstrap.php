#!/usr/bin/env php
<?php

/*
 * This file is part of the {project_name}.
 *
 * (c) Anthonius Munthi <me@itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use \Symfony\Component\Finder\Finder;
use \Symfony\Component\Filesystem\Filesystem;


$root_dir = realpath(__DIR__.'/../');
$vendor_dir = realpath($root_dir.'/vendor');
require_once $vendor_dir.'/autoload.php';

$fs = new Filesystem;

$finder = Finder::create()
        ->name('*.js')
        ->name('*.less')
        ->notPath('tests')
        ->notPath('docs')
        ->in($vendor_dir.'/twitter/bootstrap')
;
$fs->mirror($vendor_dir.'/twitter/bootstrap',$root_dir.'/lib/bootstrap',$finder->files(),array('override'=>true));

$md5 = '';
foreach($finder->files() as $file){
    $md5 .= md5_file($file->getPathName());
}
file_put_contents($root_dir.'/lib/bootstrap/checksum', md5($md5),LOCK_EX);

// bootstrap build
$finder = Finder::create()
        ->in(array(
            $vendor_dir.'/fortawesome/font-awesome/less',$vendor_dir.'/fortawesome/font-awesome/font',
        ))
;
$fs->mirror($vendor_dir.'/fortawesome/font-awesome',$root_dir.'/lib/font-awesome',$finder->files(),array('override'=>true));
// font-awesome patch
$content = file_get_contents($root_dir.'/lib/bootstrap/less/bootstrap.less');
$content = strtr($content,array(
    '@import "sprites.less";'=> '@import "../../font-awesome/less/font-awesome.less";'
));
file_put_contents($root_dir.'/lib/bootstrap/less/bootstrap.less', $content,LOCK_EX);
$md5 = "";
foreach($finder->files() as $file){
    $md5 .= md5_file($file->getPathName());
}
file_put_contents($root_dir.'/lib/font-awesome/checksum', md5($md5),LOCK_EX);
