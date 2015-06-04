<?php
include("inc.function.php");
include("../../config/config.php");

if((isset($_POST["lambda"]) || isset($_POST["p"])) && isset($_POST["n"]) && isset($_POST["radio-saisie-loi-poisson"])){
	// , to .
	$_POST["p"] = str_replace(',', '.', $_POST["p"]);
	$_POST["lambda"] = str_replace(',', '.', $_POST["lambda"]);
	if((int)$_POST["radio-saisie-loi-poisson"] == $_POST["radio-saisie-loi-poisson"] && (is_numeric($_POST["p"]) || is_numeric($_POST["lambda"])) && (int)$_POST["n"] == $_POST["n"]){
		//Check if P
		if($_POST["radio-saisie-loi-poisson"] == 1 && $_POST["p"] < 0 && $_POST["p"] > 1){
			api_check($api, json_encode(array("error" => "error_p")),"<span style=\"color:#a90329\">P doit être entre 0 et 1 exclu</span>");
		}else{
			if($_POST["radio-saisie-loi-poisson"] == 1){
				$lambda = $_POST["p"] * $_POST["n"];
			}else{
				$lambda = $_POST["lambda"];
			}
			if($lambda > 0){
				$denominateur = 0;
				// X = 
				$array_result_x_equal = array();
				for ($i=0; $i <= $_POST["n"] ; $i++) { 
					for ($x=0; $x <= $i ; $x++) { 
						if($x == 0){
							$denominateur = 1;
						}else{
							$denominateur *= $x;
						}
					}
					$array_result_x_equal[$i] = (exp(-$lambda) * pow($lambda, $i)) / ($denominateur);
				}
				// X <= && >=
				$array_result_x_inferior_equal = array();
				$array_result_x_superior_equal = array();
				$temp = 0.00;
				for ($i=0; $i <= $_POST["n"] ; $i++) { 
					$temp += $array_result_x_equal[$i];
					$array_result_x_inferior_equal[$i] = $temp;
					$array_result_x_superior_equal[$i] = 1 - $temp;
				}
				echo loi_graph_create($api, $array_result_x_inferior_equal, $array_result_x_equal, $array_result_x_superior_equal, "loi_poisson");
			}else{
				api_check($api, json_encode(array("error" => "error_numbers")),"<span style=\"color:#a90329\">Erreur de saisie</span>");
			}
		}
	}else{
		api_check($api, json_encode(array("error" => "error_numbers")),"<span style=\"color:#a90329\">Erreur de saisie</span>");
	}
}else{
	api_check($api, json_encode(array("error" => "bad_parameters")),"<span style=\"color:#a90329\">Les paramètres sont incorrects</span>");
}

?>