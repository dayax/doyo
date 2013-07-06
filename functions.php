<?php
umask(0000);
if(is_file($file=realpath(__DIR__.'/vendor/autoload.php'))){
require_once $file;
}
doyo\Hooks::register();


$files = array(
    'lib/util.php',
);

foreach($files as $file){    
    require_once __DIR__.'/'.$file;
}
?>