

<label>Person</label>
<select name="id">
    <?php foreach ($people as $person) { ?>
        <option value=<?php echo $person->getId(); ?> > 
            <?php echo $person->getFirstName() . " " . $person->getLastName(); ?>
        </option>
    <?php } ?>
</select>

