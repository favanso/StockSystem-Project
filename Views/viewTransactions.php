<h2>Add Transaction</h2>
<form action="controllerTransactions.php" method="post">
    <div>
        <?php include("Views/selectorStocks.php"); ?></br>
        <?php include("Views/selectorUsers.php"); ?></br>
        <label>Quantity</label>
        <input type="text" name="quantity"/></br> 
    </div>
    <div>
        <input type='hidden' name='action' value='addTransaction'/>
        <input id="button" type='submit' value='Add Transaction'/></br>
    </div>
</form>

<h2>Update Transaction</h2>
<form action="controllerTransactions.php" method="post">
    <div>
       <?php include("Views/selectorTransactions.php"); ?></br>
        <label>Symbol</label>
        <input type="text" name="symbol"/></br> 
        <label>Person Id</label>
        <input type="text" name="personId"/></br> 
        <label>Purchase Price</label>
        <input type="text" name="purchasePrice"/></br>
        <label>Quantity</label>
        <input type="text" name="quantity"/></br>
        <label>date/time</label>
        <input type="text" name="datetime" placeholder = "Y-m-d h:m:s"/></br> 
    </div>
    <div>
        <input type='hidden' name='action' value='updateTransaction'/>
        <input id="button" type='submit' value='Update Transaction'/></br>
    </div>
</form>

<h2>Delete Transaction</h2>
<form action="controllerTransactions.php" method="post">
    <div>
         <?php include("Views/selectorTransactions.php");?></br>
    </div>
    <div>
        <input type='hidden' name='action' value='deleteTransaction'/>
        <input id="buttonDelete" type='submit' value='Delete Transaction'/></br>
    </div>
</form>

</body>
</html>