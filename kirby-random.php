<?php

require_once __DIR__ . '/vendor/autoload.php';

class KirbyRandom {
  public static function random($random, $type = false, $length = false, $calle = '') {
    // LIST
    if(count($random) > 1) {
      if(strtolower($type) == 'between') {
        $min = intval($random[0]);
        $max = intval($random[count($random)-1]);
        return (string)random_int($min, $max);

      } else if(strtolower($type) == 'pool') {
        $l = $length && $length <= count($random) ? $length : count($random);
        if($l == count($random)) {
          $s = $random;
          shuffle($s);
        return implode(', ', $s);
        } else {
          $poolkeys = array_rand($random, $l);
          return implode(', ', array_intersect_key($random, array_flip($poolkeys)));
        }
        

      } else {
        return (string)$random[random_int(0, count($random)-1)];
      }
    } 

    // LOREM using https://github.com/joshtronic/php-loremipsum
    else if ($length && count($random) > 0 && strtolower($random[0]) == 'lorem') {
      $lipsum = new joshtronic\LoremIpsum();
      if($type == 'sentences') {
        return $lipsum->sentences($length);
      }
      else if($type == 'paragraphs') {
        if($calle == 'site::method') {
          $pa = $lipsum->paragraphsArray($length);
          $re = '';
          foreach ($pa as $p) {
            $re .= '<p>'.$p.'</p>';
          }
          return $re;
        } else {
          return $lipsum->paragraphs($length);
        }
      }
      else if($type == 'chars') {
        return substr($lipsum->words($length), 0, $length);
      }
      else {
        return $lipsum->words($length);
      }
    }

    // RANDOM positive non-zero number
    else if($length && strtolower($type) == 'number') {
      return (string)random_int(1, $length);
    } 

    // RANDOM string
    else {
      $l = $length ? $length : intval($random[0]);
      $t = $type ? $type : false;
      return $t ? str::random($l, $t) : str::random($l);
    }
  }
}

$kirby->set('site::method', 'random', 
  function($page, $random, $type = false, $length = false) {

    if(gettype($random) == 'string') {
      $random = explode(',', str_replace(', ', ',', $random));
    } else if(gettype($random) == 'integer') {
      $random = array($random);
    }
    return KirbyRandom::random($random, $type, $length, 'site::method');
});

$kirby->set('tag', 'random', array(
  'attr' => array('length', 'type'),
  'html' => function($tag) {

    $random = explode(',', str_replace(', ', ',', (string)$tag->attr('random')));
    $type = $tag->attr('type');
    $length = $tag->attr('length') ? intval($tag->attr('length')) : false;

    return KirbyRandom::random($random, $type, $length, 'tag'); 
  }
));
