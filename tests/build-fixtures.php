<?php
use \Symfony\Component\Finder\Finder;
use \Symfony\Component\Filesystem\Filesystem;

$rootDir = realpath(__DIR__.'/../');

$fs = new Filesystem;

// cleanup wordpress
if(is_dir($target=__DIR__.'/fixtures/wordpress')){
    $finder = Finder::create()
              ->in(__DIR__.'/fixtures/wordpress')
    ;
    $fs->remove(new DirectoryIterator(__DIR__.'/fixtures/wordpress'));
}
        
        
// copy
$finder = Finder::create()
     ->notPath(('.git'))
     ->in($rootDir.'/vendor/wordpress/wordpress')
;
        

$fs->mirror($rootDir.'/vendor/wordpress/wordpress',$target,$finder->files(),array('override'=>true));

$finder = Finder::create()
        ->notPath('.git')
        ->notPath('vendor')
        ->notPath('tests')
        ->notPath('nbproject')
        ->in($rootDir)
;
$fs = new Filesystem;
$fs->mirror($rootDir,$target.'/wp-content/themes/doyo',$finder->files(),array('override'=>true));

$finder = Finder::create()
        ->in(__DIR__.'/fixtures/skeleton')
;
// copy skeleton
$fs->mirror(__DIR__.'/fixtures/skeleton',$target,$finder->files(),array('override'=>true));
?>