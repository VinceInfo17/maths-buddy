<?php
include("inc.function.php");
include("../../config/config.php");

//If post are presents
if(isset($_POST["n"]) && isset($_POST["p"])){
	//If their type is ok
	$_POST["p"] = str_replace(',', '.', $_POST["p"]);
	if((int)$_POST["n"] == $_POST["n"] && is_numeric($_POST["p"])){
		if($_POST["p"] > 0 && $_POST["p"] < 1){
			$array_values_equals_k = array();
			$html = "";
			//When X = K
			for ($i=0; $i <= $_POST["n"]; $i++) { 
				$array_values_equals_k[$i] = combinaison($i, $_POST["n"]) * pow($_POST["p"], $i) * pow(1 - $_POST["p"], $_POST["n"] - $i);
			}

			//When X <= K
			$array_values_inferior_equals_k = array();
			for ($i=0; $i <= $_POST["n"] ; $i++) { 
				$temp = 0.00;
				for ($y=0; $y <= $i; $y++) { 
					$temp += $array_values_equals_k[$y];
				}
				$array_values_inferior_equals_k[$i] = $temp;
			}

			//When X >= K
			$array_values_superior_equals_k = array();
			for ($i=0; $i <= $_POST["n"]; $i++) { 
				if($i == 0){
					$array_values_superior_equals_k[0] = 1;
				}else{
					$array_values_superior_equals_k[$i] = (1 - $array_values_inferior_equals_k[$i - 1]);
				}
			}
			echo loi_graph_create($api, $array_values_inferior_equals_k, $array_values_equals_k, $array_values_superior_equals_k, "loi_binomiale");
		}else{
			api_check($api, json_encode(array("error" => "p_error")),"<span style=\"color:#a90329\">P doit être en 0 et 1</span>");
		}

	}else{
		api_check($api, json_encode(array("error" => "bad_parameters")),"<span style=\"color:#a90329\">Les paramètres entrés sont de mauvais type</span>");
	}
}else{
	api_check($api, json_encode(array("error" => "bad_parameters")),"<span style=\"color:#a90329\">Les paramètres sont incorrects</span>");
}


function combinaison($k, $n){
	if($k == 0){
		return 1;
	}else if($k == $n){
		return 1;
	}else if($k == 1){
		return $n;
	}else{
		$numerateur = $n;
		$denominateur = $k;
		for ($i=1; $i < $k; $i++) { 
			$numerateur *= ($n - $i);
			$denominateur *= ($k - $i);
		}
		return $numerateur/$denominateur;
	}
}
?>