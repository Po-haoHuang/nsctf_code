<div class="font-effect" style="font-size:20px">You can search pokemon by name here.</div>
<form action="http://<?php echo $_SERVER['HTTP_HOST']; ?>/menu.php/db/search/" method="POST">
    <br>
    <input type="text" name="name" placeholder="pokemon name."><br>
    <br>
    <input id="bigbutton" type="submit" value="Submit" />
</form>
<br><br>
