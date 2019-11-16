<?php 

	/**
	 * 
	 */
	class Knowledge
	{
		
		function getKnowledge(){
			$url = 'brain_file.json'; 
		    $data = file_get_contents($url);
		    $characters = json_decode($data,true);
		    
		    $result = $characters['knowledge_base'];

		    return $result;
		}

	}

 ?>