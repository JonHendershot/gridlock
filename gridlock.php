<?php
	
	// Settings :: Used to create number of elements and create a ceiling 
	$iterations = 150; // Max Number
	$post_num = rand(5,150); // Number of Elements 
	$random_gutter = rand(0,30); // Get a random numer to apply to the gutter class
	
	if($random_gutter%5 === 0 || $random_gutter%3 === 0){ // Only use multiples of 5 or 3
		$gutter = 'gutter-' . $random_gutter . 'px';
	}else {
		$gutter = 'gutter-0px';
	}
	
	// Preparation :: Setup Grid Numbers to ensure the last row is full [used for evaluation in Display Logic]
	$grid_lock = array(
		"grid_a" => array(
				"key" => "norm",
				"values" => array() 
			),
		"grid_b" => array(
				"key" => "alt",
				"values" => array() 
			),
		"grid_c" => array(
				"key" => "alt-inv",
				"values" => array() 
			),
		"grid_d" => array(
				"key" => "r-1",
				"values" => array() 
			),
		"grid_e" => array(
				"key" => "r-2",
				"values" => array()
		)
	);
	
	// Evaluation :: Push in to arrays
	for($nn = 5; $nn <= $iterations; $nn++){
		if($nn % 3 == 0){ // is divisible by 3
			$grid_lock["grid_a"]["values"][] = $nn;
		} else if($nn % 5 == 0 || $nn % 5 === 3){
			$grid_lock["grid_b"]["values"][] = $nn;
		} else if($nn % 5 == 2){
			$grid_lock["grid_c"]["values"][] = $nn;
		} else if($nn % 3 == 1){
			$grid_lock["grid_d"]["values"][] = $nn;
		} else if($nn % 3 == 2){
			$grid_lock["grid_e"]["values"][] = $nn;
		} else { // catchall
			$grid_lock["grid_f"]["values"][] = $nn;
		}
	}

// Display Arrays
/*
	echo "<pre>";
	print_r($grid_lock);
	echo "</pre>";
*/
	
	// Display Logic :: Check post count in arrays and setup class
	foreach($grid_lock as $set){
		if(in_array($post_num, $set["values"])){
			$display_class = $set["key"];
		}
	}
	
	// Loop and Create Posts
	echo "<div class='gridlock-container $gutter'>";
		for($xx = 1; $xx <= $post_num; $xx++){
			echo "<div class='grid-item $display_class $gutter'>
					<h1>Item<br />$xx of $post_num</h1>
				</div>";
		}
	echo "</div>";
