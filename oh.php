<?php 

	/**
	 * 
	 */
	class OH
	{
		
		function preBmBc($string) {
            $len = strlen($string);
            $table = array();
            for ($i=0; $i < $len; $i++) { 
                $table[$string[$i]] = $len - $i - 1; 
            }
            return $table;
        }
	}

 ?>