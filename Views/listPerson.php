<?php include('topNavigation.php'); 
?>
<link rel="stylesheet" href="styles.css"/>
<table class="tablePerson">
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Balance</th>
    </tr>

    <?php foreach ($people as $person) { ?>
           <tr>
            <td><?php echo $person->getId() ?></td>
            <td><?php echo $person->getFirstName() ?></td>
            <td><?php echo $person->getLastName() ?></td>
            <td><?php echo "$ " . number_format($person->getBalance(),   4) ?></td>
        </tr>
    <?php } ?>
</table>

<h2>Search by last name</h2>
<div class = "container">
<form action="controllerUser.php" method="get">
    <div> 
        <label>Last Name</label>
        <input type="text" name="lastName"/></br> 
    </div>
    <div>
        <input  id="button" type='submit' value='Search People'/></br>
    </div>
</div>
</form>