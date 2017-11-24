<?php
//1
$array = [5, 9, 12, -4, 15, -25, 10, -7];
$arrayCount = count($array);
echo $arrayCount."<br>";
echo ""."<br>";
//2
/**
 * @param $array
 */
function positiveNumbers($array) {
    for ($i = 0; $i < count($array); $i++) {
        if ($array[$i] % 5 == 0 && $array[$i] > 0) {
            echo $array[$i]."<br>";
        }
    }
};
echo positiveNumbers($array);
echo ""."<br>";
//3
/**
 * @param $array
 */
function filesWithNumbers($array) {
    foreach($array as $number){
        switch($number) {
            case $number > 0:
                $file1 = fopen("file1.txt", "a");
                fwrite($file1, $number);
                fclose($file1);
                break;
            case $number < 0:
                $file2 = fopen("file2.txt", "a");
                fwrite($file2, $number);
                fclose($file2);
        }
    }
};
echo filesWithNumbers($array);

// метод пузырьков

/**
 * @param $array
 */
function bubble($array) {
    for($i=0; $i<count($array); $i++){
        for($j=$i+1; $j<count($array); $j++){
            if($array[$i] > $array[$j]){
                $temp = $array[$j];
                $array[$j] = $array[$i];
                $array[$i] = $temp;
            }
        }
    }
    print_r($array);
};
echo bubble($array);

?>


