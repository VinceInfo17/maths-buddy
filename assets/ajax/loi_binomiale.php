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
			//If API
			if($api){
				$result_api = json_encode(array("error" => "no", "values_equals_k" => json_encode($array_values_equals_k), "values_inferior_equals_k" => json_encode($array_values_inferior_equals_k), "values_superior_equals_k" => json_encode($array_values_superior_equals_k)));
				echo $result_api;
			}else{
				$html = "<table class='table-result-show'><tr><th>P(X <= K)</th><th>P(X = K)</th><th>P(X >= K)</th></tr>";
				for ($i=0; $i <= $_POST["n"]; $i++) { 
					$html .= "<tr><td>P(X<=" . $i . ") = " . round($array_values_inferior_equals_k[$i],ROUND_VALUE) . "</td><td>P(X=" . $i . ") = " . round($array_values_equals_k[$i], ROUND_VALUE) . "</td><td>P(X>=" . $i . ") = " . round($array_values_superior_equals_k[$i], ROUND_VALUE) . "</td></tr>";
				}
				$data_charts_equals = create_graph_statistiques(range(0, $_POST['n']),$array_values_equals_k);
				$data_charts_inferior = create_graph_statistiques(range(0, $_POST['n']),$array_values_inferior_equals_k);
				$data_charts_superior = create_graph_statistiques(range(0, $_POST['n']),$array_values_superior_equals_k);
				$html .= '</table><br/><div class="type-saisie-radio" id="type-saisie-loi-binomiale">
				<input id="radio-type-saisie-loi-binomiale-1" name="radio-saisie-loi-binomiale" type="radio" value="1">
				<label for="radio-type-saisie-loi-binomiale-1">&lt;=</label>
				<input checked id="radio-type-saisie-loi-binomiale-2" name="radio-saisie-loi-binomiale" type="radio" value="2"><label for="radio-type-saisie-loi-binomiale-2">=</label>
				<input id="radio-type-saisie-loi-binomiale-3" name="radio-saisie-loi-binomiale" type="radio" value="3"><label for="radio-type-saisie-loi-binomiale-3">&gt;=</label></div>';
				$html .= '<script>
						var data_graph_binomiale  = {
						'. $data_charts_equals . '
						}
						var data_inferior  = {
						' . $data_charts_inferior . '
						}
						var data_superior  = {
						' . $data_charts_superior . '
						}
						$("#type-saisie-loi-binomiale").buttonset();
						$(\'#radio-type-saisie-loi-binomiale-1\').click(function(event) {
							$( "#div_graph_binomiale" ).html( "<div><canvas id=\'graph_binomiale\'></canvas></div>" );
							var ctxChart = document.getElementById("graph_binomiale").getContext("2d");
							window.myChart = new Chart(ctxChart).Bar(data_inferior, options_graph_binomiale);
							scroll();
					    });
						$(\'#radio-type-saisie-loi-binomiale-2\').click(function(event) {
							$( "#div_graph_binomiale" ).html( "<div><canvas id=\'graph_binomiale\'></canvas></div>" );
							var ctxChart = document.getElementById("graph_binomiale").getContext("2d");
							window.myChart = new Chart(ctxChart).Bar(data_graph_binomiale, options_graph_binomiale);
							scroll();
					    });
						$(\'#radio-type-saisie-loi-binomiale-3\').click(function(event) {
							$( "#div_graph_binomiale" ).html( "<div><canvas id=\'graph_binomiale\'></canvas></div>" );
							var ctxChart = document.getElementById("graph_binomiale").getContext("2d");
							window.myChart = new Chart(ctxChart).Bar(data_superior, options_graph_binomiale);
							scroll();
					    });
						function scroll(){
							if (!$(\'#bottom-result-loi-binomiale\').visible(true)) {
			                    $("html, body").animate({
			                        scrollTop: $(\'#bottom-result-loi-binomiale\').offset().top +
			                            -$(window).height() + 50
			                    }, 500);
			                }
						}
						</script>';
				$html .= show_graph_line($data_charts_equals, "bar", "graph_binomiale", false, false);
				
				echo $html;
			}
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