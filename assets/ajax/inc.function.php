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

function create_graph_date($labels, $tab_result, $tab_derive){
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

function show_graph($data_charts){
	echo '<br/><div style="width:100%"><canvas id="graph_canvas"></canvas></div>
	<script>
		var data = {
			'. $data_charts .'
		}
		var options = {
		    responsive: true,
		}
		// Get the context of the canvas element we want to select
		var ctx = document.getElementById("graph_canvas").getContext("2d");
		var myNewChart = new Chart(ctx).Line(data, options);
	</script>';
}
?>