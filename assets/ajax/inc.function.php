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

function show_graph_line($data_charts, $type, $name){
	$html = '<br/><div style="width:100%"><canvas id="'. $name .'"></canvas></div>
	<script>
		var data_'.$name.' = {
			'. $data_charts .'
		}
		var options_'.$name.' = {
		    responsive: true,
		    scaleBeginAtZero: false
		}
		// Get the context of the canvas element we want to select
		var ctx = document.getElementById("'.$name.'").getContext("2d");';
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
?>