<div class="font-effect" style="font-size:20px">You can Leave a message here.</div>
<form action="http://<?php echo $_SERVER['HTTP_HOST']; ?>/menu.php/message/add/" method="POST">
    <textarea name="message" style="width:80%;height:25%;" placeholder="Leave a message."></textarea>
    <br><br>
    <input id="bigbutton" type="submit" value="Submit" />
</form>
<br><br>
