<?php

/*
 * This file is part of the doyo package.
 *
 * (c) Anthonius Munthi <me@itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if(!is_file($file=__DIR__.'/autoload.php')){
    $file = __DIR__.'/autoload.php.dist';
}

if(!is_file($file)){
    throw new LogicException('File "autoload.php" or "autoload.php.dist" not exists');
}

require_once realpath($file);

/** Sets up WordPress vars and included files. */
require_once(ABSPATH.'wp-settings.php');