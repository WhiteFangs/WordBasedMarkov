<?php
/*
    Word-based PHP Markov Chain text generator
	by WhiteFangs <https://github.com/WhiteFangs/WordBasedMarkov>
	Fork of the PHP Markov Chain text generator 1.0
    Copyright (c) 2008, Hay Kranen <http://www.haykranen.nl/projects/markov/>
    
    License (MIT / X11 license)    
    
    Permission is hereby granted, free of charge, to any person
    obtaining a copy of this software and associated documentation
    files (the "Software"), to deal in the Software without
    restriction, including without limitation the rights to use,
    copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the
    Software is furnished to do so, subject to the following
    conditions:
    
    The above copyright notice and this permission notice shall be
    included in all copies or substantial portions of the Software.
    
    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
    EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
    OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
    NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
    HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
    WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
    FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
    OTHER DEALINGS IN THE SOFTWARE.
*/

function generate_markov_table($text, $order) {
    
    // walk through the text and make the index table for words
    $wordsTable = explode(' ',trim($text)); 
	$table = array();
	$tableKeys = array();
	$i = 0;
	
	foreach($wordsTable as $key=>$word){
		$nextWord = "";
		for($j = 0; $j < $order; $j++){
			if($key + $j + 1 != sizeof($wordsTable) - 1)
				$nextWord .= " " . $wordsTable[$key + $j + 1];
		}
		if (!isset($table[$word . $nextWord])){
			$table[$word . $nextWord] = array();
		};
	}
	
    $tableLength = sizeof($wordsTable);
	
    // walk the array again and count the numbers
	for($i = 0; $i < $tableLength - 1; $i++){
		$word_index = $wordsTable[$i];		
		$word_count = $wordsTable[$i+1];
		if (isset($table[$word_index][$word_count])) {
			$table[$word_index][$word_count] += 1;
		} else {
			$table[$word_index][$word_count] = 1;	  
		}
	}
	
    return $table;
}

function sentenceBegin($str){
	return $str == ucfirst($str);
}

function generate_markov_text($length, $table) {
    // get first word
	do{
		$word = array_rand($table);
	}while(!sentenceBegin($word));
		
    $o = $word;

    while(strlen($o) < $length){
        $newword = return_weighted_word($table[$word]);            
        
        if ($newword) {
            $word = $newword;
            $o .= " " . $newword;
        } else {       
            do{
				$word = array_rand($table);
			}while(!sentenceBegin($word));
        }
    }
    
	
    return $o;
}
    

function return_weighted_word($array) {
    if (!$array) return false;
    
    $total = array_sum($array);
    $rand  = mt_rand(1, $total);
    foreach ($array as $item => $weight) {
        if ($rand <= $weight) return $item;
        $rand -= $weight;
    }
}
?>