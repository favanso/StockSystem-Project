<link rel="stylesheet" href="Views/styles.css"/>
<?php
$action = filter_input(INPUT_GET, 'action');

if ($action == "") {
    $action = filter_input(INPUT_POST, 'action');
}

// default action
if ($action == "" || $action == 'listStocks') {

    $companyName = htmlspecialchars(filter_input(INPUT_GET, 'companyName'));

    include('Models/modelStock.php');

    $stock = listStock($companyName);

    include('Views/listStocks.php');
} else if ($action == 'updateStock') {
    $symbol = htmlspecialchars(filter_input(INPUT_POST, 'symbol'));
    $companyName = htmlspecialchars(filter_input(INPUT_POST, 'companyName'));
    $currentPrice = filter_input(INPUT_POST, 'currentPrice', FILTER_VALIDATE_FLOAT);
    

    if ($symbol == '' || $companyName == '') {
        $error = "You must submit symbol and Company name, try again";
        include("Views/error.php");
    } else {
        include('Models/modelStock.php');
        $stock = new modelStock($symbol, $companyName, $currentPrice);
        updateStock($stock);
        header("Location: controllerStocks.php");
    }
} else if ($action == 'deleteStock') {

    $symbol = filter_input(INPUT_POST, 'symbol');

    if ($symbol == '') {
        $error = "You must submit a valid symbol";
        include('Views/error.php');
    } else {
        include('Models/modelStock.php');
        $stock = new modelStock($symbol, "", 0);
        deleteStock($stock);
        header("Location: controllerStocks.php");
    }
} else if ($action == 'addStock') {

    $symbol = htmlspecialchars(filter_input(INPUT_POST, 'symbol'));
    $companyName = htmlspecialchars(filter_input(INPUT_POST, 'companyName'));
    $currentPrice = filter_input(INPUT_POST, 'currentPrice', FILTER_VALIDATE_FLOAT);

   if ($symbol == '' || $companyName == '') {
        $error = "You must submit symbol and Company name, try again";
        include('Views/error.php');
    } else {
        include('Models/modelStock.php');
        $stock = new modelStock($symbol, $companyName, $currentPrice);
        addStock($stock);
        header("Location: controllerStocks.php");
    }
}

include('Views/viewStock.php');
