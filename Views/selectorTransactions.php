<label>Company/ Person ID</label>
<select name="id">
    <?php foreach ($transaction as $purchases) { ?>
        <option value=<?php echo $purchases->getId(); ?> > 
            <?php echo $purchases->getSymbol() . " " . $purchases->getPersonId(); ?>
        </option>
    <?php } ?>
</select>