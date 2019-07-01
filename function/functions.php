<?php 
	function space($number){
		for($i = 0; $i < $number; $i++)
			echo "&nbsp;";
	}
	
	function wait(){
		
		for($i = 0; $i < 50000; $i++){}
	}
?>