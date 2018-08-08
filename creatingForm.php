<?php
/**
 * Created by PhpStorm.
 * User: alexanderpanteleev
 * Date: 07.08.18
 * Time: 8:07
 */
$elements = [
    [
        "element" => "input",
        "htmltype" => "text",
        "name" => "firstname",
        "type" => "string",
        "placeholder" => "Введите имя"
    ],
    [
        "element" => "input",
        "htmltype" => "text",
        "name" => "age",
        "type" => "integer",
        "placeholder" => "Введите возраст"
    ],
    [
        "element" => "input",
        "htmltype" => "radio",
        "name" => "gender",
        "type" => "boolean",
        "value" => "male",
        "label" => "мужской"
    ],
    [
        "element" => "input",
        "htmltype" => "radio",
        "name" => "gender",
        "value" => "female",
        "type" => "boolean",
        "label" => "женский"
    ],
    [
        "element" => "input",
        "htmltype" => "submit",
        "value" => "Отправить"
    ],
];
// свой массив для сравнения с заданным массивом - $elements
$formArray = [
    "element",
    "htmltype",
    "name",
    "type",
    "placeholder",
    "value",
    "label"
];
// переменные POST
// принимает значение имени
$firstName = isset($_POST[$elements[0]["name"]]) ? $_POST[$elements[0]["name"]] : "";
// принимает знаыение возраста
$age = isset($_POST[$elements[1]["name"]]) ? $_POST[$elements[1]["name"]] : "";
// принимает значение пола, можно обойтись одной перемнной.
$genderM = isset($_POST[$elements[2]["name"]]) ? $_POST[$elements[2]["name"]] : "";
//$genderF = isset($_POST[$elements[2]["name"]]) ? $_POST[$elements[2]["name"]] : "";
/*
 * Функция принимает заданный массив с элементами формы, сравнивает его с
 * имеющимся массивом значениий, определяет переменные и выводит форму. Так же функция
 * принимает переменные POST для сохранения после отправки формы.
 */

function inputForm(array $array, array $comparisonArray, $firstName,$age,$genderM) {
    // первый уровень вложенности
    foreach ($array as $innerValue) {
        // обнуление элементов
        $element = $htmltype = $formName = $type = $placeholder = $formValue = $label = $labalId = $checkedM =  "";
        // второй уровень вложенности. Фильтруем данные и создаем переменные
        foreach ($innerValue as $key => $value) {
            global $element, $htmltype, $formName, $type, $placeholder, $formValue, $label;
            if($key == $comparisonArray[0])
                $element = $value;
            if($key == $comparisonArray[1])
                $htmltype = $value;
            if ($key == $comparisonArray[2])
                $formName = $value;
            if($key == $comparisonArray[3])
                $type = $value;
            if($key == $comparisonArray[4])
                $placeholder = $value;
            if($key == $comparisonArray[5])
                $formValue = $value;
            if($key == $comparisonArray[6])
                $label = $value ;
        }
        // условия, чтобы для каждого элемента значения переопределялись заново
        if($firstName && $formName == $array[0]["name"])
            $firstName = "value ='$firstName'";
        if($age && $formName == $array[1]["name"])
            $firstName = "value ='$age'";
        if($genderM  == $formValue)
            $checkedM = "checked";
//        if($genderF == $formValue)
//            $checkedF = "checked";
        if($htmltype)
            $htmltype = "type='$htmltype'";
        if($formName)
            $formName = "name='$formName'";
        if($placeholder)
            $placeholder = "placeholder='$placeholder'";
        if($formValue)
            $formValue = "value='$formValue'";
        if($label) {
            $labalId = $label;
            $label = " <label for=\"$label\">$label</label>";
        }
        // вывод, можно переделать в return
        echo <<<STATEMENT
 <div class="form-group">
 <input $htmltype  $formName $formValue $placeholder id = "$labalId" $firstName $checkedM>
 $label
</div>
STATEMENT;
        $firstName = "";
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!--    подключаем бутстрап-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <!--    свои стили-->
    <style>
        body {
            width: 40%;
            margin: 0 auto;
        }
        
        form {
            margin: 40px 0;
        }

    </style>
</head>
<body>
    <form action="#" method="POST">
        <?php
        inputForm($elements, $formArray,$firstName,$age,$genderM);
        ?>
    </form>
</body>
</html>
