<h2>Add Person</h2>
<form action="controllerUser.php" method="post">
    <div>
        <label>First Name</label>
        <input type="text" name="firstName"/></br> 
        <label>Last Name</label>
        <input type="text" name="lastName"/></br> 
        <label>Balance</label>
        <input type="text" name="balance"/></br> 
    </div>
    <div>
        <input type='hidden' name='action' value='addPerson'/>
        <input id="button" type='submit' value='Add Person'/></br>
    </div>
</form>

<h2>Update Person</h2>
<form action="controllerUser.php" method="post">
    <div>
        <?php include("Views/selectorUsers.php"); ?></br>
        <label>First Name</label>
        <input type="text" name="firstName"/></br> 
        <label>Last Name</label>
        <input type="text" name="lastName"/></br> 
        <label>Balance</label>
        <input type="text" name="balance"/></br> 
    </div>
    <div>
        <input type='hidden' name='action' value='updatePerson'/>
        <input id="button" type='submit' value='Update Person'/></br>
    </div>
</form>


<h2>Delete Person</h2>
<form action="controllerUser.php" method="post">
    <div>
         <?php include("Views/selectorUsers.php"); ?></br>
    </div>
    <div>
        <input type='hidden' name='action' value='deletePerson'/>
        <input id="buttonDelete" type='submit' value='Delete Person'/></br>
    </div>
</form>

</body>
</html>
