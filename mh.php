<?php 

	/**
	 * 
	 */
	class MH
	{
		
		function preBmGs($pattern){

        	$panjang = strlen($pattern);
        	$suff[$panjang - 1] = $panjang;
        	$g = $panjang - 1;
        	$f = 0;
        	// === Pre Suffix ===
        	for ($i= $panjang -2 ; $i >= 0; $i--) {
        	if (isset($suff)) {
        		$pjg = isset($suff[$i + $panjang - 1 - $f]) ? $suff[$i + $panjang - 1 - $f] : 0;
        		if ($i>$g AND ($pjg < $i-$g)) {
        			$suff[$i] = $pjg;
        		}else{
        			if ($i<$g) {
        				$g = $i;
        				$f = $i;
        				while ($g >= 0 && $pattern[$g] == $pattern[$g + $panjang - 1 - $f]) {
        					$g--;
        					$suff[$i] = $f - $g;
        				}
        			}
        		}
        	 } 
        	}
    
        	// === Pre BmGs ===
        	for ($i=0; $i < $panjang; $i++) { 
        		$bmGs[$i] = $panjang;
        	}
    
        	for ($i=$panjang - 1; $i >= -1 ; $i--) { 
        		if(isset( $suff[$i]))
    	    		if ($i == -1 || $suff[$i] == $i+1) {
    	    			for ($j=0; $j < $panjang-1-$i; $j++) { 
    	    				if ($bmGs[$j] == $panjang) {
    	    					$bmGs[$j] = $panjang-1-$i;
    	    				}
    	    			}
    	    		}
        	}
    
        	for ($i=0; $i <= $panjang-2 ; $i++) { 
       			$bmGs[$panjang-1-$suff[$i]] = $panjang-1-$i;
        	}
        	return $bmGs;
    	}
	}

 ?>