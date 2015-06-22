<div class="font-effect" style="font-size:20px">You can search pokemon by id here.</div>
<form action="http://<?php echo $_SERVER['HTTP_HOST']; ?>/menu.php/db/search/" method="POST">
    <br>
    <input type="text" name="id" placeholder="pokemon id."><br>
    <br>
    <input id="bigbutton" type="submit" value="Submit" />
</form>
<br><br>
