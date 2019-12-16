<?php 
if($dateTo==null || $dateFrom==null) 
    echo '<form id="comment_form" class="commentForm verticalForm" action="templates/forms/comment_action.php?id=<?=$idReserva?>&<?=$habitation?>" method="post">';
else
    echo '<form id="comment_form" class="commentForm verticalForm" action="templates/forms/comment_action.php?id=<?=$idReserva?>&<?=$habitation?>&<?=$dateFrom?>&<?=$dateTo?>" method="post">';
?>
    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
    <label> Cleaning
        <input type="number" name="cleaning" value="1" min="1" max="5" required>
    </label>
    <label> Location
        <input type="number" name="location" value="1" min="1" max="5" required>
    </label>
    <label> Value
        <input type="number" name="value" value="1" min="1" max="5" required>
    </label>
    <label> Check-In
        <input type="number" name="checkIn" value="1" min="1" max="5" required>
    </label>
    <label> Comment
        <textarea name="description" rows="5"></textarea>
    </label>
    <label>
        <input type="checkbox" name="anonimous" value="anonimous"> Anonimous Comment
    </label>
    <input class="submit" type="submit" value="Submit" id="submitComment">
</form>