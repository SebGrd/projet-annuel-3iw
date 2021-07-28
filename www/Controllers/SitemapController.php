<?php

namespace App\Controllers;
use App\Core\View;

class SitemapController
{

  public function main()
  {
    $view = new View('incl.sitemap', 'sitemap');
    $urls = \App\Core\Router::getRoutes();
    $json = json_encode($urls);
    $keys = array_keys(json_decode($json, true));
    $forbidden = ['/admin', '/setup', '/delete-my-account', '/new-order'];
    foreach ($keys as $key) {
      if (preg_match('((/admin)+[/a-zA-Z]+[a-zA-Z])', $key)) {
        array_push($forbidden,  $key);
      }
      unset($key);
    }
    
    $keys = array_diff($keys, $forbidden);

    $view->assign('urls', $keys);
  }
}