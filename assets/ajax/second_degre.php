<?php
include("inc.function.php");
include("../../config/config.php");

//Check if all post are here
if(isset($_POST["a"]) && isset($_POST["b"]) && isset($_POST["c"]) && isset($_POST["min"]) && isset($_POST["max"]) && isset($_POST["step"])){
	//Convert , to .
	$_POST["a"] = str_replace(',', '.', $_POST["a"]);
	$_POST["b"] = str_replace(',', '.', $_POST["b"]);
	$_POST["c"] = str_replace(',', '.', $_POST["c"]);
	//Check if post are numeric and there type
	if(is_numeric($_POST["a"]) && is_numeric($_POST["b"]) && is_numeric($_POST["c"])){
		//Check if optional parameters are sent, or if we use default one
		$_POST["step"] = str_replace(',', '.', $_POST["step"]);
		if(is_numeric($_POST["min"]) && is_numeric($_POST["max"]) && (int)$_POST["min"] == $_POST["min"]  && (int)$_POST["max"] == $_POST["max"]){
			$min = $_POST["min"];
			$max = $_POST["max"];
		}else{
			if(!empty($_POST["min"]) || !empty($_POST["max"])){
				$error_result_ignored_interval = true;
			}
			$min = MIN_DEFAULT;
			$max = MAX_DEFAULT;
		}
		if(is_numeric($_POST["step"])){
			$step = $_POST["step"];
		}else{
			if(!empty($_POST["step"])){
				$error_result_ignored_step = true;
			}
			$step = STEP_DEFAULT;	
		}
		//Check if min < max
		if($min < $max){
			$a = $_POST["a"];
			$b = $_POST["b"];
			$c = $_POST["c"];
			if($a == 0 && $b != 0 && $c != 0){
				api_check($api, json_encode(array("error" => "a_should_not_equal_zero")), "<span style=\"color:#a90329\">A ne doit pas être égal à 0</span>");
			}else{
				if($a == 0 && $b == 0 && $c != 0){
					api_check($api, json_encode(array("error" => "a_and_b_should_not_equal_zero")),"<span style=\"color:#a90329\">A et B ne doivent pas être égales à 0</span>");
				}else{
					if($a == 0 && $b == 0 && $c == 0){
						api_check($api, json_encode(array("error" => "no",array("x1" => "-∞", "x2" => "+∞"))),"Les solutions sont de -∞ à +∞");
					}else{
						$tab_absisses = array();
						$tab_result = array();
						$tab_derive = array();
						$html = "";
						$index = 0;
						//Check if parameters are ignored
						if(isset($error_result_ignored_interval)){
							$html .= "<span style=\"color:#a90329\">Les paramètres des intervalles ont étés ignorés car ils sont incorrects.</span><br/>";
						}
						if(isset($error_result_ignored_step)){
							$html .= "<span style=\"color:#a90329\">Le paramètre de l'étape a été ignoré car il est incorrect.</span><br/>";
						}
						for ($i=$min; $i <= $max; $i+=$step) { 
							$tab_absisses[ $index ] = (string)$i;
							$tab_result[ $index ] = (string)(($i * pow($_POST["a"],2)) + ($_POST["b"] * $i) + $_POST["c"]);
							$tab_derive[ $index ] = (string)(2 * ($_POST["a"] * $i) + $_POST["b"]);
							$index++;
						}
						//Derivée
						if($_POST["a"] == 0){
							$derivee = $_POST["b"];
						}else{
							$derivee = 2 * $_POST["a"] . " x + " . $_POST["b"];
						}
						//Delta
						$delta = ($_POST["b"] * $_POST["b"]) - 4 *($_POST["a"] * $_POST["c"]);
						//Chart JS
						$data_charts = create_graph_date($tab_absisses, $tab_result, $tab_derive);
						if($delta > 0){
							$x1 = (-$_POST["b"] + sqrt($delta)) / ( 2 * $_POST["a"] );
							$x2 = (-$_POST["b"] - sqrt($delta)) / ( 2 * $_POST["a"] );
							$result_api = json_encode(array("error" => "no", "nb_solution" => "2", "delta" => $delta, "x1" => $x1, "x2" => $x2, "derivee" => $derivee, "tab_absisses" => $tab_absisses, "results" => $tab_result, "tab_derive" => $tab_derive));
							$html .= "Delta : " . $delta . "<br/>Il y a deux solutions :<br/> X1 : " . $x1 . "<br/>X2 : " . $x2 . "<br/>Dérivée : ". $derivee;
						}else if($delta == 0){
							$x1 = (-$_POST["b"]) + ( 2 * $_POST["a"] );
							$result_api = json_encode(array("error" => "no", "nb_solution" => "1", "delta" => $delta, "x1" => $x1, "derivee" => $derivee, "tab_absisses" => $tab_absisses, "results" => $tab_result, "tab_derive" => $tab_derive));
							$html .= "Delta : " . $delta . "<br/>Il y a une solution :<br/> X1 : " . $x1 . "<br/>Dérivée : ". $derivee;
						}else{
							$x1_2 = "((-" . $_POST["b"] . ") ± i * sqrt(" . $delta . ")) / 2 * " . $_POST["a"];
							$result_api = json_encode(array("error" => "no", "nb_solution" => "2i", "delta" => $delta, "x1_2" => $x1_2, "derivee" => $derivee, "tab_absisses" => $tab_absisses, "results" => $tab_result, "tab_derive" => $tab_derive));
							$html .= "Delta : " . $delta . "<br/>Il y a deux solutions imaginaires :<br/> X1 & 2 : " . $x1_2 . "<br/>Dérivée : ". $derivee;
						}
						api_check($api,$result_api,$html);
					}
				}
			}
		}else{
			api_check($api, json_encode(array("error" => "min_superior_max")),"<span style=\"color:#a90329\">Le minimum ne doit pas être supérieur au maximum</span>");
		}
	}else{
		api_check($api, json_encode(array("error" => "bad_type_parameters")),"<span style=\"color:#a90329\">Les paramètres entrés sont incorrects</span>");
	}
}else{
	api_check($api, json_encode(array("error" => "bad_parameters")),"<span style=\"color:#a90329\">Les paramètres sont incorrects</span>");
}

//If the graph data is present, we show the graph
if(isset($data_charts) && !$api){
	show_graph($data_charts);
}
?>