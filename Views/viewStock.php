
<h2>Add Stock</h2>
<form action="controllerStocks.php" method="post">
    <div>
        <label>Symbol</label>
        <input type="text" name="symbol"/></br> 
        <label>Company Name</label>
        <input type="text" name="companyName"/></br> 
        <label>Current Price</label>
        <input type="text" name="currentPrice"/></br> 
    </div>
    <div>
         <input type='hidden' name='action' value='addStock'/>
        <input id="button" type='submit' value='Add Stock'/></br>
    </div>
</form>

<h2>Update Stock</h2>
<form action="controllerStocks.php" method="post">
    <div>
         <?php include("Views/selectorStocks.php"); ?></br>
        <label>Company Name</label>
        <input type="text" name="companyName"/></br> 
        <label>Current Price</label>
        <input type="text" name="currentPrice"/></br> 
    </div>
    <div>
        <input type='hidden' name='action' value='updateStock'/>
        <input id="button" type='submit' value='Update Stock'/></br>
    </div>
</form>


<h2>Delete Stock</h2>
<form action="controllerStocks.php" method="post">
    <div>
         <?php include("Views/selectorStocks.php"); ?></br>
    </div>
    <div>
         <input type='hidden' name='action' value='deleteStock'/>
        <input id="buttonDelete" type='submit' value='Delete Stock'/></br>
    </div>
</form>


</body>
</html>
