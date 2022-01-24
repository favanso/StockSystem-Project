<?php

class modelTransactions {

    private $id;
    private $symbol;
    private $personId;
    private $purchasePrice;
    private $quantity;
    private $dateTime;

    public function __construct($id, $symbol, $personId, $purchasePrice, $quantity, $dateTime) {
        $this->id = $id;
        $this->symbol = $symbol;
        $this->personId = $personId;
        $this->purchasePrice = $purchasePrice;
        $this->quantity = $quantity;
        $this->dateTime = $dateTime;
    }

    public function getId() {
        return $this->id;
    }

    public function getSymbol() {
        return $this->symbol;
    }

    public function getPersonId() {
        return $this->personId;
    }

    public function getPurchasePrice() {
        return $this->purchasePrice;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getDateTime() {
        return $this->dateTime;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setSymbol($symbol): void {
        $this->symbol = $symbol;
    }

    public function setPersonId($personId): void {
        $this->personId = $personId;
    }

    public function setPurchasePrice($purchasePrice): void {
        $this->purchasePrice = $purchasePrice;
    }

    public function setQuantity($quantity): void {
        $this->quantity = $quantity;
    }

}

function convertFromDbToPurchaseObject($purchaseRow) {
    $purchase = new modelTransactions(
            $purchaseRow['id'],
            $purchaseRow['symbol'],
            $purchaseRow['personId'],
            $purchaseRow['purchasePrice'],
            $purchaseRow['quantity'],
            $purchaseRow['dateTime']
    );

    return $purchase;
}

function listTransaction($id, $personId) {

    require('database.php');

    if ($id == "" && $personId == "") {
        $query = 'select * from purchase';
        $statement = $db->prepare($query);
    } elseif ($id != "" && $personId == "") {
        $query = 'select * from purchase where id like :id';
        $statement = $db->prepare($query);
        $id = '%' . $id . '%';
        $statement->bindValue(':id', $id);
    } elseif ($personId != "" && $id == "") {
        $query = 'select * from purchase where personId like :personId';
        $statement = $db->prepare($query);
        $personId = '%' . $personId . '%';
        $statement->bindValue(':personId', $personId);
    }


    $statement->execute();

    $transactions = $statement->fetchAll();

    $transactionList = array();

    foreach ($transactions as $transactionRow) {
        $transactions = convertFromDbToPurchaseObject($transactionRow);
        array_push($transactionList, $transactions);
    }

    $statement->closeCursor();

    return $transactionList;
}

function updateTransaction($transaction) {
    require('database.php');

    $query = "update purchase set symbol = :symbol,"
            . " personId = :personId, "
            . " purchasePrice = :purchasePrice,"
            . " quantity = :quantity, "
            . " dateTime = :dateTime "
            . " where id = :id";

    $statement = $db->prepare($query);
    $statement->bindValue(':symbol', $transaction->getSymbol());
    $statement->bindValue(':personId', $transaction->getPersonId());
    $statement->bindValue(':purchasePrice', $transaction->getPurchasePrice());
    $statement->bindValue(':quantity', $transaction->getQuantity());
    $statement->bindValue(':dateTime', $transaction->getDateTime());
    $statement->bindValue(':id', $transaction->getId());

    $statement->execute();

    $statement->closeCursor();
}

function deleteTransaction($transaction) {
    require('database.php');

    $query = "delete from purchase "
            . " where id = :id";

    $statement = $db->prepare($query);

    $statement->bindValue(':id', $transaction->getId());

    $statement->execute();

    $statement->closeCursor();
}

function addTransaction($transaction) {
    require('database.php');
    require_once('Models/modelStock.php');

    $stock = findStock($transaction->getSymbol());

    $purchasePrice = $stock->getCurrentPrice();

    $query = "insert into purchase (symbol, personId, purchasePrice, quantity, dateTime)"
            . " values ( :symbol, :personId, :purchasePrice, :quantity, now())";

    $statement = $db->prepare($query);
    $statement->bindValue(':symbol', $transaction->getSymbol());
    $statement->bindValue(':personId', $transaction->getPersonId());
    $statement->bindValue(':purchasePrice', $purchasePrice);
    $statement->bindValue(':quantity', $transaction->getQuantity());

    $statement->execute();

    $statement->closeCursor();
}
