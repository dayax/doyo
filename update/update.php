<?php
if (!isset($_POST['secret'])) {
    return dyShowUpdatePage();
}
$secret = $_POST['secret'];
$current = file_get_contents(__DIR__.'/../build/update.dat');

if ($secret !== $current) {
    dyShowUpdatePage('Secret key is not same');
    $content = array(
        'status'=>'Secret key is not same'
    );
}elseif(isset($_POST['doyoExecuteUpdate'])){
    doExecuteUpdate();
    $content = array('status'=>'success');
}
elseif(isset($_POST['doyoGetStatus'])){
    $content = doGetStatus();    
}else{
    $content = array('status'=>"Unknown Request");
}



function doGetStatus()
{
    $file = __DIR__."/../build/update-status.txt";
    $data = file($file);
    $line = $data[count($data)-1];
    return array(
        'status' => $line,
    );
}

function doExecuteUpdate()
{    
    $statusFile = __DIR__.'/../build/update-status.txt';
    file_put_contents($statusFile, "", LOCK_EX);
    $descriptorspec = array(
        0=>array("file", $statusFile, "r"), // stdin is a pipe that the child will read from
        1=>array("file", $statusFile, "w"), // stdout is a pipe that the child will write to
        2=>array("file", __DIR__."/../build/error-output.txt", "a") // stderr is a file to write to
    );
    $cwd = realpath(__DIR__.'/../../../../');
    $env = array('some_option'=>'aeiou');

    $cmd = 'COMPOSER_HOME=~/.composer ';
    $cmd .= realpath(__DIR__.'/../bin').'/composer.phar';
    $cmd .= " update -vvv";

    $resource = proc_open($cmd, $descriptorspec, $pipes, $cwd);
}

header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
echo json_encode($content);