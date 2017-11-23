<?php

// Идея: по дефолту "myFunction" должна к каждому элементу массива прибавлять единицу и выводить получившийся результат;
// после прибавления единицы, колбэком каждый элемент массива должен быть поделён на 2 и вывестись соответствующий результат.
$arr1 = [15, 12, 7, 21, 4, 17];
$arr2 = [8, 14, 2, 31, 11, 9];

/** ОСНОВНАЯ ФУНКЦИЯ
 * @param $array //входящий массив
 * @param $callback //дополнительная функция-обработчик
 * @return mixed
 */
function myFunction($array, $callback) {
    for ($i = 0; $i < count($array); $i++) {
        $array[$i] = $array[$i] + 1;
    }

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
    for ($i = 0; $i < count($array); $i++) {
        $array[$i] = $array[$i] / 2;
    }
    return $array;
};

$callback1 = "callbackFunction"; //ссылка на дополнительную функцию-обработчик

myFunction($arr1, $callback1); //первая обработка
echo "<br>";
myFunction($arr2, $callback1); //вторая обработка

?>