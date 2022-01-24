<?php include('topNavigation.php');
?>
<link rel="stylesheet" href="styles.css"/>

<table class="tableTransaction">
    <tr>
        <th>ID</th>
        <th>Symbol</th>
        <th>Person Id</th>
        <th>Purchase Price</th>
        <th>Quantity</th>
        <th>Date</th>
    </tr>

    <?php foreach ($transaction as $purchases) { ?>
        <tr>
            <td><?php echo $purchases->getId() ?></td>
            <td><?php echo $purchases->getSymbol() ?></td>
            <td><?php echo $purchases->getPersonId() ?></td>
            <td><?php echo number_format($purchases->getPurchasePrice(), 4) ?></td>
            <td><?php echo $purchases->getQuantity() ?></td>
            <td><?php echo $purchases->getDateTime() ?></td>
        </tr>
    <?php } ?>
</table>

<h2>Search by Purchase Id</h2>
<form action="controllerTransactions.php" method="post">
    <div> 
        <label>ID</label>
        <input type="text" name="id"/></br> 
    </div>
    <div>
        <input id= "button" type='submit' value='Search Transaction'/></br>
    </div>
</form>
<div></div>

<h2>Search by User Id</h2>
<form action="controllerTransactions.php" method="post">
    <div> 
        <label>User ID</label>
        <input type="text" name="personId"/></br> 
    </div>
    <div>
        <input id= "button" type='submit' value='Search Transaction by User'/></br>
    </div>
</form>