<?php

// Идея: по дефолту "myFunction" должна к каждому элементу массива прибавлять единицу и выводить получившийся результат;
// после прибавления единицы, колбэком каждый элемент массива должен быть поделён на 2 и вывестись соответствующий результат.
$arrFst = [15, 12, 7, 21, 4, 17];
$arrNd = [8, 14, 2, 31, 11, 9];

/** ОСНОВНАЯ ФУНКЦИЯ
 * @param $array //входящий массив
 * @param $callback //дополнительная функция-обработчик
 * @return mixed
 */
function myFunction($array, $callback) {
    foreach ($array as &$i) {
       $i = $i + 1;
    };

    if(is_callable($callback)) {
        $array = call_user_func($callback, $array);
    }
    return print_r($array);
}

/** ДОПОЛНИТЕЛЬНАЯ ФУНКЦИЯ-ОБРАБОТЧИК (callback)
 * @param $array //входящий массив
 * @return mixed
 */
function callbackFunction ($array) {
    foreach ($array as &$i) {
        $i = $i / 2;
    };
    return $array;
};

$callbackFst = "callbackFunction"; //ссылка на дополнительную функцию-обработчик

myFunction($arrFst, $callbackFst); //первая обработка
echo "<br>";
myFunction($arrNd, $callbackFst); //вторая обработка

?>;