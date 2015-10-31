<?php

/**
 * A simple function aiding autoloading
 * 
 * @param string $classname namespace and class name
 */

function __autoload($classname) {
  $classname = ltrim($classname, '\\');
  $filename = realpath (dirname(__FILE__)).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR;
  $namespace = '';
  if ($lastnspos = strripos($classname, '\\')) {
    $namespace = substr($classname, 0, $lastnspos);
    $classname = substr($classname, $lastnspos + 1);
    $filename  .= str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
  }
  $filename .= str_replace('_', DIRECTORY_SEPARATOR, $classname) . '.php';
  require $filename;
}
