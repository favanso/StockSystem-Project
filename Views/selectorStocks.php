

<label>Stocks</label>
<select name="symbol">
    <?php foreach ($stock as $oneStock) { ?>
        <option value=<?php echo $oneStock->getSymbol(); ?> > 
            <?php echo $oneStock->getCompanyName(); ?>
        </option>
    <?php } ?>
</select>
