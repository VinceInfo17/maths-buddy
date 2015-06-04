<?php

//API check
$api = true;
if(isset($_GET["api"])){
	if($_GET["api"] == 0){
		$api = false;
	}
}

function api_check($api, $api_message, $normal_message){
	if($api){
		echo $api_message;
	}else{
		echo $normal_message;
	}
}

function create_graph_date_second_degre($labels, $tab_result, $tab_derive){
	$result = 'labels: ' . json_encode($labels) . ',
	datasets: [{
        title: "Résultats",
        fillColor: "rgba(220,220,220,0.2)",
        strokeColor: "rgba(220,220,220,1)",
        pointColor: "rgba(220,220,220,1)",
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: '. json_encode($tab_result) .'
    }, {
        title: "Dérivée",
        fillColor: "rgba(220,220,220,0.2)",
        strokeColor: "rgba(247,10,10,1)",
        pointColor: "rgba(247,10,10,1)",
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: '. json_encode($tab_derive) .'
    }]';
    return $result;
}

function create_graph_statistiques($labels, $data){
	$result = 'labels: ' . json_encode($labels) . ',
	datasets: [{
        title: "Valeurs",
        fillColor: "rgba(151,187,205,0.5)",
        strokeColor: "rgba(151,187,205,0.8)",
        highlightFill: "rgba(151,187,205,0.75)",
        highlightStroke: "rgba(151,187,205,1)",
        data: ' . json_encode($data) . '
    }]';
    return $result;
}

function show_graph_line($data_charts, $type, $name, $negative,$show_data){
	$html = '<br/><div id="div_'. $name .'" style="width:100%;"><div><canvas id="graph_'. $name .'"></canvas></div></div><script>';
	if($show_data){
		$html .= 'var data_'.$name.' = {
					'. $data_charts .'
				}';
	}	
	$html .= '
	var options_'.$name.' = {
		    responsive: true,
		    scaleBeginAtZero: ';
	if($negative){
		$html .= "false";
	}else{
		$html .= "true";
	}
	$html .= '}
		// Get the context of the canvas element we want to select
		var ctx = document.getElementById("graph_'.$name.'").getContext("2d");
		';
	switch ($type) {
		case 'line':
			$html .= 'var myNewChart_'.$name.' = new Chart(ctx).Line(data_'.$name.', options_'.$name.');</script>';
			break;
		case 'bar':
			$html .= 'var myNewChart_'.$name.' = new Chart(ctx).Bar(data_'.$name.', options_'.$name.');</script>';
			break;
		default:
			# code...
			break;
	}
	return $html;
}


function loi_graph_create($api, $array_result_x_inferior_equal, $array_result_x_equal, $array_values_superior_equals_k, $name){
	if($api){
		return json_encode(array("error" => "no", "values_equals_k" => json_encode($array_result_x_equal), "values_inferior_equals_k" => json_encode($array_result_x_inferior_equal), "values_superior_equals_k" => json_encode($array_result_x_superior_equal)));
	}else{
		$html = "<table class='table-result-show'><tr><th>P(X <= K)</th><th>P(X = K)</th><th>P(X >= K)</th></tr>";
		for ($i=0; $i <= $_POST["n"]; $i++) { 
			$html .= "<tr><td>P(X<=" . $i . ") = " . round($array_result_x_inferior_equal[$i],ROUND_VALUE) . "</td><td>P(X=" . $i . ") = " . round($array_result_x_equal[$i], ROUND_VALUE) . "</td><td>P(X>=" . $i . ") = " . round($array_values_superior_equals_k[$i], ROUND_VALUE) . "</td></tr>";
		}
		$data_charts_equals = create_graph_statistiques(range(0, $_POST['n']),$array_result_x_equal);
		$data_charts_inferior = create_graph_statistiques(range(0, $_POST['n']),$array_result_x_inferior_equal);
		$data_charts_superior = create_graph_statistiques(range(0, $_POST['n']),$array_values_superior_equals_k);
		$html .= '</table><br/><div class="type-saisie-radio" id="type-saisie-' . $name . '">
		<input id="radio-type-saisie-' . $name . '-1" name="radio-saisie-' . $name . '" type="radio" value="1">
		<label for="radio-type-saisie-' . $name . '-1">&lt;=</label>
		<input checked id="radio-type-saisie-' . $name . '-2" name="radio-saisie-' . $name . '" type="radio" value="2"><label for="radio-type-saisie-' . $name . '-2">=</label>
		<input id="radio-type-saisie-' . $name . '-3" name="radio-saisie-' . $name . '" type="radio" value="3"><label for="radio-type-saisie-' . $name . '-3">&gt;=</label></div>';
		$html .= '<script>
				var data_'. $name .' = {
				'. $data_charts_equals . '
				}
				var data_inferior_'. $name .' = {
				' . $data_charts_inferior . '
				}
				var data_superior_'. $name .' = {
				' . $data_charts_superior . '
				}
				$("#type-saisie-' . $name . '").buttonset();
				$(\'#radio-type-saisie-' . $name . '-1\').click(function(event) {
					$( "#div_'. $name .'" ).html( "<div><canvas id=\'graph_'. $name .'\'></canvas></div>" );
					var ctxChart = document.getElementById("graph_'. $name .'").getContext("2d");
					window.myChart = new Chart(ctxChart).Bar(data_inferior_'. $name .', options_'. $name .');
					scroll_'. $name .'();
			    });
				$(\'#radio-type-saisie-' . $name . '-2\').click(function(event) {
					$( "#div_'. $name .'" ).html( "<div><canvas id=\'graph_'. $name .'\'></canvas></div>" );
					var ctxChart = document.getElementById("graph_'. $name .'").getContext("2d");
					window.myChart = new Chart(ctxChart).Bar(data_'. $name .', options_'. $name .');
					scroll_'. $name .'();
			    });
				$(\'#radio-type-saisie-' . $name . '-3\').click(function(event) {
					$( "#div_'. $name .'" ).html( "<div><canvas id=\'graph_'. $name .'\'></canvas></div>" );
					var ctxChart = document.getElementById("graph_'. $name .'").getContext("2d");
					window.myChart = new Chart(ctxChart).Bar(data_superior_'. $name .', options_'. $name .');
					scroll_'. $name .'();
			    });
				function scroll_'. $name .'(){
					if (!$(\'#bottom-result-' . $name . '\').visible(true)) {
	                    $("html, body").animate({
	                        scrollTop: $(\'#bottom-result-' . $name . '\').offset().top +
	                            -$(window).height() + 50
	                    }, 500);
	                }
				}
				</script>';
		$html .= show_graph_line($data_charts_equals, "bar", $name, false, false);
		
		return $html;
	}
}
?>