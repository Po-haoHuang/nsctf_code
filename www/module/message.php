<?php
function add() {
    if(!isset($_POST["message"])){
        // there is no message , return
        return;
    }
    //write message into a file
    mt_srand(make_seed());
    $randval = mt_rand(1,50);
    $file = fopen("./message/".$randval.".txt", "w");
    fwrite($file, $_POST["message"]);
    fclose($file);
    html_div(100,10,"#ffffff",20);
    echo "Success, your message ID is ".$randval;
    html_div_end();
}

function make_seed()
{
    // random seed
    list($usec, $sec) = explode(' ', microtime());
    return (float) $sec + ((float) $usec * 100000);
}

function search($id)
{
    if(file_exists("./message/".$id.".txt")){
        // print message from file
	$file = fopen("./message/".$id.".txt", "r");
	$fsize = filesize("./message/".$id.".txt");
        $message = fread($file,$fsize);
        html_div(100,10,"#ffffff",20);
		// TODO check dirty input?
        echo "Your Message:<br>".$message."<br>";
        html_div_end();
    }
    else{
        html_div(100,10,"#ffffff",20);
        echo "Please check your message id.";
        html_div_end();
    }
}

function msg()
{
    if(isset($_POST["id"])){
        //redirect search by id
		// TODO check for dirty input?
        header("Location: http://".$_SERVER['HTTP_HOST']."/menu.php/message/search/".$_POST["id"]);
        die();
    }

    // search message template
    include_once("template/search.tpl");
    // leave message template
    include_once("template/form.tpl");
    // list everyone's msg 

    html_div(100,0,"#812919",30);
    echo "Message Board";
    html_div_end();
    html_div(100,40,"#ffffff",15);
    for($id=1;$id<50;$id++){
        if(file_exists("./message/".$id.".txt")){
            // print message from file
       	    $file = fopen("./message/".$id.".txt", "r");
	    $fsize = filesize("./message/".$id.".txt");
            $message = fread($file,$fsize);
            html_div(100,0,"#812919",20);
            echo "Message ID: ".$id."<br>";
            html_div_end();
            html_div(100,0,"#ffffff",20);

            // print message
			// TODO check for dirty input
            echo $message."<br>";
            html_div_end();
        }
    }
    html_div_end();
}



?>
