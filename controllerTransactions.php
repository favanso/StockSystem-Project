<link rel="stylesheet" href="Views/styles.css"/>
<?php
$action = filter_input(INPUT_GET, 'action');

if ($action == "") {
    $action = filter_input(INPUT_POST, 'action');
}

// default action
if ($action == "" || $action == 'listTransaction') {

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $personId = filter_input(INPUT_POST, 'personId', FILTER_VALIDATE_INT);
    $companyName = "";
    $lastName = "";

    include('Models/modelTransactions.php');
    include('Models/modelUser.php');
    include('Models/modelStock.php');

    $transaction = listTransaction($id, $personId);
    $stock = listStock($companyName);
    $people = listPerson($lastName);

    include('Views/listTransactions.php');
} else if ($action == 'updateTransaction') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $symbol = htmlspecialchars(filter_input(INPUT_POST, 'symbol'));
    $personId = filter_input(INPUT_POST, 'personId', FILTER_VALIDATE_INT);
    $purchasePrice = filter_input(INPUT_POST, 'purchasePrice', FILTER_VALIDATE_FLOAT);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
    $datetime = htmlspecialchars(filter_input(INPUT_POST, 'datetime'));

    if ($id == 0 || $symbol == '' || $personId == '' || $purchasePrice == 0 || $quantity == 0 || $datetime == '') {
        $error = "You must update all fields";
        include("Views/error.php");
    } else {
        include('Models/modelTransactions.php');
        $transaction = new modelTransactions($id, $symbol, $personId, $purchasePrice, $quantity, $datetime);
        updateTransaction($transaction);
        header("Location: controllerTransactions.php");
    }
} else if ($action == 'deleteTransaction') {

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($id == 0) {
        $error = "you must submit a valid user id to delete";
        include('Views/error.php');
    } else {
        include('Models/modelTransactions.php');
        $transaction = new modelTransactions($id, "", 0, 0, 0, 0);
        deleteTransaction($transaction);
        header("Location: controllerTransactions.php");
    }
} else if ($action == 'addTransaction') {

    $symbol = htmlspecialchars(filter_input(INPUT_POST, 'symbol'));
    $personId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

    if ($symbol == '' || $personId == ''  || $quantity == 0) {
        $error = "Try again";
        include('Views/error.php');
    } else {
        include('Models/modelTransactions.php');
        include('Models/modelUser.php');
        include('Models/modelStock.php');
        
        $person = findPerson($personId);
        $balance = $person->getBalance();
        $stock = findStock($symbol);
        $purchasePrice = $stock->getCurrentPrice();
        $totalPurchase = $purchasePrice * $quantity;
        
        if($totalPurchase > $balance){
            $error = "Do not have enough funds";
            include('Views/error.php');
        }else{
            $person->setBalance($balance - $totalPurchase);
            $transaction = new modelTransactions("",$symbol, $personId, $totalPurchase, $quantity,"");
            addTransaction($transaction);
            header("Location: controllerTransactions.php");
        }
    }
}

include('Views/viewTransactions.php');
