<?php include('topNavigation.php'); 
?>
<link rel="stylesheet" href="styles.css"/>

<table class="tableStock">
    <tr>
        <th>Symbol</th>
        <th>Company Name</th>
        <th>Price</th>
    </tr>

      <?php foreach ($stock as $oneStock) { ?>
           <tr>
            <td><?php echo $oneStock->getSymbol() ?></td>
            <td><?php echo $oneStock->getCompanyName() ?></td>
            <td><?php echo "$ " . number_format($oneStock->getCurrentPrice(), 4) ?></td>
        </tr>
    <?php } ?>
</table>

<h2>Search by company name</h2>
<form action="controllerStocks.php" method="get">
    <div> 
        <label>Company Name</label>
        <input type="text" name="companyName"/></br> 
    </div>
    <div>
        <input id="button" type='submit' value='Search Company'/></br>
    </div>
</form>