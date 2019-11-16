<?php 

	/**
	 * 
	 */
	class Scanner
	{
		
		function scanner($pesan){
            $ilang = preg_replace("/[^a-zA-Z0-9]+/", " ", $pesan);
            $kecil = strtolower($ilang);
            return $kecil;
        }
	}

 ?>