<?php

class modelStock {

    private $symbol;
    private $companyName;
    private $currentPrice;

    public function __construct($symbol, $companyName, $currentPrice) {
        $this->symbol = $symbol;
        $this->companyName = $companyName;
        $this->currentPrice = $currentPrice;
    }

    public function getSymbol() {
        return $this->symbol;
    }

    public function getCompanyName() {
        return $this->companyName;
    }

    public function getCurrentPrice() {
        return $this->currentPrice;
    }

    public function setSymbol($symbol): void {
        $this->symbol = $symbol;
    }

    public function setCompanyName($companyName): void {
        $this->companyName = $companyName;
    }

    public function setCurrentPrice($currentPrice): void {
        $this->currentPrice = $currentPrice;
    }

}

function convertFromDbToStockObject($stockRow) {
    $stock = new modelStock(
            $stockRow['symbol'],
            $stockRow['companyName'],
            $stockRow['currentPrice']
    );

    return $stock;
}

function findStock($symbol) {
    require('database.php');
    $query = 'select * from stock where symbol = :symbol';
    $statement = $db->prepare($query);
    $statement->bindValue(':symbol', $symbol);

    $statement->execute();
    $stock = convertFromDbToStockObject($statement->fetch());
    $statement->closeCursor();

    return $stock;
}

function listStock($companyName) {

    require('database.php');

    if ($companyName == "") {
        $query = 'select * from stock';
        $statement = $db->prepare($query);
    } else {
        $query = 'select * from stock where companyName like :companyName';
        $statement = $db->prepare($query);
        $companyName = '%' . $companyName . '%';
        $statement->bindValue(':companyName', $companyName);
    }

    $statement->execute();

    $stock = $statement->fetchAll();

    $stockList = array();

    foreach ($stock as $stockRow) {
        $stock = convertFromDbToStockObject($stockRow);
        array_push($stockList, $stock);
    }

    $statement->closeCursor();

    return $stockList;
}

function updateStock($stock) {
    require('database.php');

    $query = "update stock set symbol = :symbol, "
            . " companyName = :companyName, "
            . " currentPrice = :currentPrice "
            . " where symbol = :symbol";

    $statement = $db->prepare($query);
    $statement->bindValue(':symbol', $stock->getSymbol());
    $statement->bindValue(':companyName', $stock->getCompanyName());
    $statement->bindValue(':currentPrice', $stock->getCurrentPrice());

    $statement->execute();

    $statement->closeCursor();
}

function deleteStock($stock) {
    require('database.php');

    $query = "delete from stock "
            . " where symbol = :symbol";

    $statement = $db->prepare($query);

    $statement->bindValue(':symbol', $stock->getSymbol());

    $statement->execute();

    $statement->closeCursor();
}

function addStock($stock) {
    require('database.php');

    $query = "insert into stock (symbol, companyName, currentPrice )"
            . " values ( :symbol, :companyName, :currentPrice)";

    $statement = $db->prepare($query);
    $statement->bindValue(':symbol', $stock->getSymbol());
    $statement->bindValue(':companyName', $stock->getCompanyName());
    $statement->bindValue(':currentPrice', $stock->getCurrentPrice());

    $statement->execute();

    $statement->closeCursor();
}
