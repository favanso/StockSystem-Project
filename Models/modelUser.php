<?php

class modelUser{

    private $id;
    private $first_name;
    private $last_name;
    private $balance;

    public function __construct($first_name, $last_name, $balance, $id = 0) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->balance = $balance;
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setFirstName($first_name): void {
        $this->first_name = $first_name;
    }

    public function setLastName($last_name): void {
        $this->last_name = $last_name;
    }

    public function setBalance($balance): void {
        $this->balance = $balance;
    }

}

function convertFromDbToUserObject($personRow) {
    $user = new modelUser(
            $personRow['firstName'],
            $personRow['lastName'],
            $personRow['balance'],
            $personRow['id']
    );

    return $user;
}

function listPerson($last_name) {

    require('database.php');

    if ($last_name == "") {
        $query = 'select * from person';
        $statement = $db->prepare($query);
    } else {
        $query = 'select * from person where lastName like :lastName';
        $statement = $db->prepare($query);
        $last_name = '%' . $last_name . '%';
        $statement->bindValue(':lastName', $last_name);
    }

    $statement->execute();

    $people = $statement->fetchAll();

    $personList = array();

    foreach ($people as $personRow) {
        $person = convertFromDbToUserObject($personRow);
        array_push($personList, $person);
    }

    $statement->closeCursor();

    return $personList;
}

function findPerson($id) {

    require('database.php');
    $query = 'select * from person where id = :id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);

    $statement->execute();
    $person = convertFromDbToUserObject($statement->fetch());
    $statement->closeCursor();

    return $person;
}

function updatePerson($person) {
    require('database.php');
    $query = "update person set firstName = :firstName, "
            . " lastName = :lastName, "
            . " balance = :balance "
            . " where id = :id";

    $statement = $db->prepare($query);
    $statement->bindValue(':firstName', $person->getFirstName());
    $statement->bindValue(':lastName', $person->getLastName());
    $statement->bindValue(':balance', $person->getBalance());
    $statement->bindValue(':id', $person->getId());

    $statement->execute();

    $statement->closeCursor();
}

function deletePerson($person) {
    require('database.php');

    $query = "delete from person "
            . " where id = :id";

    $statement = $db->prepare($query);
    $statement->bindValue(':id', $person->getId());

    $statement->execute();

    $statement->closeCursor();
}

function addPerson($person) {
    require('database.php');

    $query = "insert into person (firstName, lastName, balance )"
            . " values ( :firstName, :lastName, :balance)";

    $statement = $db->prepare($query);
    $statement->bindValue(':firstName', $person->getFirstName());
    $statement->bindValue(':lastName', $person->getLastName());
    $statement->bindValue(':balance', $person->getBalance());

    $statement->execute();

    $statement->closeCursor();
}
