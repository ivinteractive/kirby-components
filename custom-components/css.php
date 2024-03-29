<?php

/**
 * Kirby CSS Tag Component
 *
 * @package   Kirby CMS
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      http://getkirby.com
 * @copyright Bastian Allgeier
 * @license   http://getkirby.com/license
 */
class CustomCSS extends \Kirby\Component\CSS {

  /**
   * Builds the html link tag for the given css file
   * 
   * @param string $url
   * @param null|string $media
   * @return string
   */
  public function tag($url, $media = null) {

    if(is_array($url)) {
      $css = array();
      foreach($url as $u) $css[] = $this->tag($u, $media);
      return implode(PHP_EOL, $css) . PHP_EOL;
    }

    // auto template css files
    if($url == '@auto') {

      $file = $this->kirby->site()->page()->intendedTemplate() . '.css';
      $root = $this->kirby->roots()->autocss() . DS . $file;
      $url  = $this->kirby->urls()->autocss() . '/' . $file;

      if(!file_exists($root)) return false;

    }

    if(str::startsWith($url, 'async|')):
      $url = url(str_replace('async|', '', $url));
      $extra = '  media="print" onload="this.media=\'all\'"';
    else:
      $url = url($url);
      $extra = '';
    endif;

    $attrValue = $url.r(str::contains($url, url::host()), '?v='.md5(site()->assetVersion()->value()));

    return '<link rel="stylesheet" media="'.$media.'" href="'.$attrValue.'"'.$extra.' />';

  }

}
