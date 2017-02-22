<?php

require_once __DIR__ . '/vendor/autoload.php';


$kirby->set('tag', 'random', array(
  'attr' => array('length', 'type'),
  'html' => function($tag) {
    

    $random = explode(',', (string)$tag->attr('random'));
    $type = $tag->attr('type');
    $length = $tag->attr('length') ? intval($tag->attr('length')) : false;


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
				return implode(',', $s);
  			} else {
  				$poolkeys = array_rand($random, $l);
  				return implode(',', array_intersect_key($random, array_flip($poolkeys)));
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
      		return $lipsum->paragraphs($length);
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
));
