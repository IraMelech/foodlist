<?php

namespace My\PrzepisBundle\Helpers;

class Search {
	
	protected $SearchResults;

	public function Search($data)
	{

		$ObjToCheck; // obiekt posiadajacy najmniej przepisow
	    $less=999;
	    $countData = count($data);

	    		//wyznaczanie ObjToCheck
	            foreach ($data as $result)
	            {
	            	$Sps = $result->getSp(); //id przepisow danego skladnika 
	            	$countSp = count($Sps);		
		            if ($less > $countSp)
		            	{
		            		$less = $countSp;
		            		$ObjToCheck = $Sps;
		            	}
	            	
	            }

	            // sprawdzanie czy przepisy maja wszystkie wybrane skladniki
	            $countIngredients = 0;
	            foreach ($ObjToCheck as $object) {
	            	$countIngredients = 0;
	            	$przepis = $object->getPrzepis();
	            	$skladniki = $przepis->getSp(); // id skladnikow danego przepisu
	            	foreach ($data as $result) {
	            		foreach ($skladniki as $skladnik) {
	            			$skladnik = $skladnik->getSkladnik()->getNazwa();
	            			$resultName = $result->getNazwa();
	            			if ($resultName == $skladnik){
	            				$countIngredients++;
	            			}
	            		}
	            	}
	            	if ($countIngredients == $countData){

	            		$this->SearchResults[] = $przepis;

	            	}

	            }
	    return $this->SearchResults;
	}

	
	            
}