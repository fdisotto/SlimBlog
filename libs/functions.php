<?php
/**
 * Thanks to http://stackoverflow.com/questions/8990007/display-post-excerpts-limited-by-word-count
 */
// just the excerpt
function first_n_words($text, $number_of_words) {
   // Where excerpts are concerned, HTML tends to behave
   // like the proverbial ogre in the china shop, so best to strip that
   $text = strip_tags($text);

   // \w[\w'-]* allows for any word character (a-zA-Z0-9_) and also contractions
   // and hyphenated words like 'range-finder' or "it's"
   // the /s flags means that . matches \n, so this can match multiple lines
   $text = preg_replace("/^\W*((\w[\w'-]*\b\W*){1,$number_of_words}).*/ms", '\\1', $text);

   // strip out newline characters from our excerpt
   return str_replace("\n", "", $text);
}

// excerpt plus link if shortened
function truncate_to_n_words($text, $number_of_words, $url, $readmore = 'Read More') {
   $text = strip_tags($text);
   $excerpt = first_n_words($text, $number_of_words);
   // we can't just look at the length or try == because we strip carriage returns
   if( str_word_count($text) !== str_word_count($excerpt) ) {
      $excerpt .= '... <a href="'.$url.'">'.$readmore.'</a>';
   }
   return $excerpt;
}