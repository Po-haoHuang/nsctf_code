<div class="font-effect" style="font-size:20px">You can upload your Pokemon here.</div>
<form action="http://<?php echo $_SERVER['HTTP_HOST']; ?>/menu.php/upload/add/" method="post" enctype="multipart/form-data">
    <br>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <br><br>
    <input id="bigbutton" type="submit" value="Upload" name="submit">
</form>
<br><br>
