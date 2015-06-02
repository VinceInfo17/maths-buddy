<?php
include("inc.function.php");
include("../../config/config.php");

//If post are present
if(isset($_POST["statistiques_nom_"]) && isset($_POST["statistiques_numero_"])){
	//If the elements in the 2 arrays are the same 
	if(count($_POST["statistiques_numero_"]) == count($_POST["statistiques_nom_"])){
		//If array contains empty values
		if(!in_array("", $_POST["statistiques_nom_"]) && !in_array("", $_POST["statistiques_numero_"])){
			//Convert , to . and do the the somme
			$somme_numero = 0.00;
			for ($i=0; $i < count($_POST["statistiques_numero_"]); $i++) { 
				$_POST["statistiques_numero_"][$i] = str_replace(',', '.', $_POST["statistiques_numero_"][$i]);
				if(!is_numeric($_POST["statistiques_numero_"][$i])){
					$error_not_numeric_value = true;
				}else{
					$somme_numero += $_POST["statistiques_numero_"][$i];
				}
			}
			//If there isn't bad values in the array
			if(!isset($error_not_numeric_value)){
				$moyenne = 0.00;
				$mediane = 0.00;
				$place = 0.00;
				$mode = 0.00;
				$max_value = 0.00;
				$numerateur = 0.00;
				$html = "";
				$result_api = "";
				//Do the average
				$moyenne = $somme_numero/count($_POST["statistiques_numero_"]);
				//Sort array
				for ($i=0; $i < count($_POST["statistiques_numero_"]); $i++) { 
					for ($j=$i+1; $j < count($_POST["statistiques_numero_"]); $j++) { 
						//If there is an inferior value, we exchange it
						if($_POST["statistiques_numero_"][$j] < $_POST["statistiques_numero_"][$i]){
							list($_POST["statistiques_numero_"][$j], $_POST["statistiques_numero_"][$i]) = array ($_POST["statistiques_numero_"][$i], $_POST["statistiques_numero_"][$j]);
						}
					}
				}
				//Mediane calc
				if((count($_POST["statistiques_numero_"])%2) == 0){
					$mediane = ($_POST["statistiques_numero_"][(count($_POST["statistiques_numero_"])/2) - 1] + ($_POST["statistiques_numero_"][(count($_POST["statistiques_numero_"]) / 2)] / 2));
				}else{
					$mediane = $_POST["statistiques_numero_"][(count($_POST["statistiques_numero_"])/2) - 0.5];
				}
				$array_modified = array();
				$array_modified_values = array();
				$count_1 = 0;
				$count_2 = 1;
				//Calc for mode
				for ($i=0; $i < count($_POST["statistiques_numero_"]); $i++) {
					for ($j=$i+1; $j < count($_POST["statistiques_numero_"]); $j++) { 
						if($_POST["statistiques_numero_"][$j] == $_POST["statistiques_numero_"][$i]){
							$count_2++;
							if($j == count($_POST["statistiques_numero_"])-1){
								$i = $j;
							}
						}else{
							$array_modified[$count_1] = $count_2;
							$tab_mod_valeur[$count_1++] = $_POST["statistiques_numero_"][$i];
							$i = $j;
							$count_1 = 1;
						}
					}
				}
				for ($i=0; $i < count($_POST["statistiques_numero_"]); $i++) {
					$numerateur += pow($_POST["statistiques_numero_"][$i]-$moyenne, 2);
				}
				//Variance
				$variance = $numerateur / count($_POST["statistiques_numero_"]);
				//Écart-type
				$ecart_type = sqrt($variance);
				//Mode & Max Value
				$max_value = $tab_mod_valeur[0];
				for ($i=0; $i < $count_1; $i++) { 
					if ($tab_mod_valeur[$i] > $max_value){
						$place = $i;
						$max_value = $tab_mod_valeur[$i];
					}
				}
				$mode = $tab_mod_valeur[$place];
				$max_value = max($_POST["statistiques_numero_"]);
				$min_value = min($_POST["statistiques_numero_"]);
				if($api){
					$result_api = json_encode(array("error" => "no", "somme" => (string)$somme_numero, "moyenne" => (string)round($moyenne, ROUND_VALUE), "mediane" => (string)round($mediane, ROUND_VALUE), "numerateur" => (string)round($numerateur,ROUND_VALUE), "variance" => (string)round($variance, ROUND_VALUE), "ecart-type" => (string)round($ecart_type, ROUND_VALUE), "mode" => (string)$mode, "min" => (string)$min_value, "max" => (string)$max_value));
				}else{
					$html = "Somme : " . $somme_numero . "<br/>Moyenne : " . round($moyenne,ROUND_VALUE) . "<br/>Médiane : " . round($mediane,ROUND_VALUE) . "<br/>Numérateur : " . round($numerateur,ROUND_VALUE) . "<br/>Variance : " . round($variance,ROUND_VALUE) . "<br/>Écart-type : " . round($ecart_type,ROUND_VALUE) . "<br/>Mode : " . $mode . "<br/>Minimum : " . $min_value . " || Maximum : " . $max_value;
				}
				//Create graph data
				$data_charts = create_graph_statistiques($_POST["statistiques_nom_"],$_POST["statistiques_numero_"]);
				//Show content
				api_check($api,$result_api,$html);
			}else{
				api_check($api, json_encode(array("error" => "bad_parameters")),"<span style=\"color:#a90329\">Les paramètres sont incorrects</span>");
			}
		}else{
			api_check($api, json_encode(array("error" => "bad_parameters")),"<span style=\"color:#a90329\">Les paramètres sont incorrects</span>");
		}
	}else{
		api_check($api, json_encode(array("error" => "bad_parameters")),"<span style=\"color:#a90329\">Les paramètres sont incorrects</span>");
	}
}else{
	api_check($api, json_encode(array("error" => "bad_parameters")),"<span style=\"color:#a90329\">Les paramètres sont incorrects</span>");
}

//If the graph data is present, we show the graph
if(isset($data_charts) && !$api){
	echo show_graph_line($data_charts, "bar", "graph_statistiques");
}
?>