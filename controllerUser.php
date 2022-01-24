<link rel="stylesheet" href="Views/styles.css"/>
<?php
$action = filter_input(INPUT_GET, 'action');

if ($action == "") {
    $action = filter_input(INPUT_POST, 'action');
}

// default action
if ($action == "" || $action == 'listPeople') {

    $lastName = htmlspecialchars(filter_input(INPUT_GET, 'lastName'));

    include('Models/modelUser.php');

    $people = listPerson($lastName);

    include('Views/listPerson.php');
} else if ($action == 'updatePerson') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $first_name = htmlspecialchars(filter_input(INPUT_POST, 'firstName'));
    $last_name = htmlspecialchars(filter_input(INPUT_POST, 'lastName'));
    $balance = filter_input(INPUT_POST, 'balance', FILTER_VALIDATE_FLOAT);

    if ($id == 0 || $first_name == '' || $last_name == '') {
        $error = "You must include ID, First Name, Last Name to update";
        include("Views/error.php");
    } else {
        include('Models/modelUser.php');
        $person = new modelUser($first_name, $last_name, $balance, $id);
        updatePerson($person);
        header("Location: controllerUser.php");
    }
} else if ($action == 'deletePerson') {

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($id == 0) {
        $error = "you must submit a valid user id to delete";
        include('Views/error.php');
    } else {
        include('Models/modelUser.php');
        $person = new modelUser("", "", 0, $id);
        deletePerson($person);
        header("Location: controllerUser.php");
    }
} else if ($action == 'addPerson') {

    $first_name = htmlspecialchars(filter_input(INPUT_POST, 'firstName'));
    $last_name = htmlspecialchars(filter_input(INPUT_POST, 'lastName'));
    $balance = filter_input(INPUT_POST, 'balance', FILTER_VALIDATE_FLOAT);

    if ($first_name == '' || $last_name == '') {
        $error = "you must submit first and last name, try again";
        include('Views/error.php');
    } else {
        include('Models/modelUser.php');
        $person = new modelUser($first_name, $last_name, $balance);
        addPerson($person);
        header("Location: controllerUser.php");
    }
}

include('Views/viewUser.php');
