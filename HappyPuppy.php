<?php

/*
The MIT License

Copyright (c) 2007 Tiago Bastos ; 2009 Dave Roberts

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

define('__DEBUG__',true);
include_dir(DOCROOT.'/controllers/*.php');
function include_dir($pattern)
{
  ob_start();
  foreach (glob($pattern) as $file)
  {
    include_once($file);
  }
  ob_end_clean();
}

function Run()
{
  try { HappyPuppy::getInstance()->dispatch(); } catch (Exception $e)
  {
    if (__DEBUG__==true) {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Error!</title>
  </head>
  <body>
    <h1>Caught exception: <?php print $e->getMessage(); ?></h1>
    <h2>File: <?php print $e->getFile()?></h2>
    <h2>Line: <?php print $e->getLine()?></h2>
    <h3>Trace</h3>
    <pre><?php print_r ($e->getTraceAsString()); ?></pre>
    <h3>Exception Object</h3>
    <pre><?php print_r ($e); ?></pre>
    <h3>Var Dump</h3>
    <pre><?php debug_print_backtrace (); ?></pre>
  </body>
</html><?php
    }
  }
}

function R($pattern, $controller, $action, $http_method){
  HappyPuppy::getInstance()->add_url($pattern, $controller, $action, $http_method);
}

class HappyPuppy
{
  var $routes = array();
  static private $instance = NULL; 

  function __construct()
  {
    if (isset($_GET['url']))
      $this->url =trim( $_GET['url'], '/');
    else $this->url = '';
  }

  /* Add url to routes */
  public function add_url($rule, $klass, $klass_method, $http_method = 'GET')
  {
    $this->routes[] = array('/^' . str_replace('/','\/',$rule) . '$/', $klass,$klass_method,$http_method);
  }

  /* Process requests and dispatch */
  public function dispatch()
  {
    $found = false;
    $controller = ''; $action = ''; $args = '';
    // see if the path is matched in the routes file
    foreach($this->routes as $rule=>$conf)
    {
      // if we have a match
      if (preg_match($conf[0], $this->url, $matches) and $_SERVER['REQUEST_METHOD'] == $conf[3])
      {
        $args = $this->parse_urls_args($matches); //Only declared variables in url regex
        $controller = $conf[1]; $action = $conf[2];
        $found = true;
        break;
      }
    }
    if (!$found)
    {
      $url_pieces = explode("/", $this->url);
      $controller = $url_pieces[0]; $action = $url_pieces[1];
      unset($url_pieces[0]); unset($url_pieces[1]);
      $args = $url_pieces;
    }
    $phpaction = $action;
    if (function_exists($phpaction)) { $phpaction = "_".$phpaction; }
    if ($phpaction == 'list') { $phpaction = '_list'; }
    if ($phpaction == 'new') { $phpaction = '_new'; }
    if ($phpaction == '') { $phpaction = 'index'; }
    $klass = new $controller();
    $this->run_before_filters($klass, $phpaction);
    ob_start();
    call_user_func_array(array($klass , $phpaction),$args);  
    $out = ob_get_contents();
    ob_end_clean();
    // did the page explicitly call render?  if so just push out the contents and we are done
    if ($klass->rendered)
    {
      print($out);
      exit();
    }
    // if not, we need to collect class variables, package them and render here
    $out = $klass->render($controller, $action);
    print($out);
  }

  private function run_before_filters($klass, $action)
  {
    $this->run_filters($klass, $action, $klass->before, $klass->not_before);
  }
  private function run_filters($klass, $action, $filters, $unfiltered)
  {
    // Determine which filters to run
    $to_run = array();
    if ($filters != null) {
    foreach($filters as $filtered_action=>$filtered_methods)
    {
      if ($filtered_methods == "*"){ array_push($to_run, $filtered_action); continue; }
      foreach($filtered_methods as $method)
      {
        if ($method == $action){ array_push($to_run, $filtered_action); continue; }
      }
    } }
    if ($unfiltered != null) {
    foreach($unfiltered as $filtered_action=>$filtered_methods)
    {
      foreach($filtered_methods as $method)
      {
        if ($method == $action){ unset($to_run[array_search($method, $to_run)]); continue; }
      }
    } }
    foreach($to_run as $filtered_action)
    {
      call_user_func(array($klass , $filtered_action));
    }
  }

  private function parse_urls_args($matches)
  {
    $first = array_shift($matches);
    $new_matches = array();
    foreach($matches as $k=>$match){
      if (is_string($k)){
        $new_matches[$k]=$match;
      }
    }
    return $new_matches;
  }

  /* Singleton */
  public function getInstance()
  {
    if(self::$instance == NULL)
    {
      self::$instance = new HappyPuppy();
    }
    return self::$instance;
  }
}

function render_arr($file, $vars)
{
  $file = DOCROOT.'/views/'.$file.'.php';
  return Render::file_with_arr($file, $vars);
}

function render($file, $varname, $var)
{
  $file = DOCROOT.'/views/'.$file.'.php';
  return Render::file_with_var($file, $varname, $var);
}

class Render
{
  static function file_with_arr($file, $arr)
  {
    ob_start();
    foreach($arr as $key=>$value)
    {
      $$key = $value;
    }
    require($file);
    $out = ob_get_contents();
    ob_end_clean();
    return $out;
  }
  static function file_with_obj($file, $obj)
  {
    $vars = get_object_vars($obj);
    ob_start();
    if (!file_exists($file))
    {
      throw new Exception('View ['.$file.'] Not Found');
    }
    if (count($vars)>0)
    {
      foreach($vars as $key => $value)
      {
        $$key = $value;
      }
    }
    require($file);
    $out = ob_get_contents();
    ob_end_clean();
    return $out;
  }

  static function file_with_var($file, $varname, $var)
  {
    ob_start();
    $$varname = $var;
    require($file);
    $out = ob_get_contents();
    ob_end_clean();
    return $out;
  }

  static function file($file)
  {
    return Render::file_with_var($file, null, null);
  }
}

class C
{
  var $layout = true;
  var $layout_template = 'views/layout.php';
  var $view_template = '';
  var $view_header = '';
  var $rendered = false;

  public function render($controller, $action)
  {
    if ($action == null || $action == ''){ $action = 'index'; }
    $view_template = $this->view_template;
    if ($view_template == '') { $view_template = 'views/'.$controller.'/'.$action.'.php'; }
    if ($this->layout)
    {
      $content = Render::file_with_obj($view_template, $this);
      $head_template = 'views/'.$controller.'/'.$action.'.head.php';
      $head = "";
      if (file_exists($head_template))
      {
        $head = Render::file_with_obj($head_template, $this);
      }
      return Render::file_with_arr($this->layout_template, array('content'=>$content, 'head'=>$head));
    }
    else
    {
      return Render::file($view_template);
    }
  }
    
  public function redirect($url)
  {
    header("Location: {$url}");
    exit();
  } 
}

?>
