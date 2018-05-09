
<?php
/**
this scripts is an example to solve the "Problem A. Standing Ovation"
https://code.google.com/codejam/contest/6224486/dashboard
*/
function readFileToArray($file) {

	$result = array();

	if (($handle = fopen($file, "r")) !== FALSE) {
		$row = 0;
	    while (($data = fgetcsv($handle, 10000, " ")) !== FALSE) {
	        $num = count($data);
	        if($row > 0) {
	        	$result[] = $data;
	        }
	        $row++;
	        /*
	        for ($c=0; $c < $num; $c++) {
	            echo $data[$c] . "<br />\n";
	        }
	        */
	    }
	    fclose($handle);
	}

	return $result;

}


function calculateFriends($S, $audience) {
	$cntClappers = 0;
	$cntAddedFriends = 0;

	if ($S != (strlen($audience) - 1)) die("wrong input");

	for($i=0; $i<strlen($audience); $i++) {
		$shynessLevel = $i;
		if ($shynessLevel == 0) {
			$cntClappers = $audience[$shynessLevel];
		}
		else {
			if ($cntClappers >= $shynessLevel) {
				$cntClappers = $cntClappers + $audience[$shynessLevel];
			}
			else {
				$newAddedFriends = ($shynessLevel - $cntClappers);
				$cntAddedFriends += $newAddedFriends;
				$cntClappers +=  $audience[$shynessLevel] + $newAddedFriends;
			}
		}
	}
	return $cntAddedFriends;
}


function main($inputFile) {
	$a = readFileToArray($inputFile);

	foreach($a as $key=>$test) {
		echo sprintf("Case #%d: %d%s", $key+1, calculateFriends($test[0], $test[1]), PHP_EOL);
	}

}
//echo calculateFriends(4, '12345') . PHP_EOL;
//echo calculateFriends(5, '110011') . PHP_EOL;

main($argv[1]);
?>
