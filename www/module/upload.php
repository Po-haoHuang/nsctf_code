<?php
function add() {
    //Upload your Pokemon (picture)
	$target_dir = "pc/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

        // flag for checking file
	$upload_check = 1;

	// Check if file already exists
	if (file_exists($target_file)) {
                html_div(100,0,"#ffffff",30);
		echo "Sorry, your Pokemon is already exists.";
                html_div_end();
		$upload_check = 0;
	}
        
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 1024000) {
                html_div(100,0,"#ffffff",30);
		echo "Sorry, your Pokemon is too large?!";
                html_div_end();
		$upload_check = 0;
	}
	// TODO check file extension
        // for example , these code is for Checking the Filename Extension. 
	// You should modify it.
        /*
        if($_FILES["fileToUpload"]["type"]!="image/jpeg"&&$_FILES["fileToUpload"]["type"]!="image/png"&&$_FILES["fileToUpload"]["type"]!="image/gif"){
            $upload_check=0;
        }
        */
	if ($upload_check == 0) {
            html_div(100,0,"#ffffff",30);
	    echo "Sorry, your Pokemon was not uploaded.";
            html_div_end();
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                html_div(100,0,"#ffffff",30);
		echo "The Pokemon ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                html_div_end();
	    } else {
                html_div(100,0,"#ffffff",30);
		echo "Sorry, there was an error uploading your Pokemon.";
                html_div_end();
	    }
	}
}

function search($name) {
    //Search engine
	if (file_exists("pc/".$name)) {
            html_div(100,0,"#ffffff",30);
	    echo "Here is your Pokemon";
            html_div_end();
            html_img("http://".$_SERVER['HTTP_HOST']."/pc/".$name);
	}else{
            html_div(100,0,"#ffffff",30);
            echo "Pokemon Not Found.";
            html_div_end();
        }

}

function dashboard() {
    //redirect to search engine
    if(isset($_POST["name"])){
        //search by name
		// TODO check for dirty input?
        header("Location: http://".$_SERVER['HTTP_HOST']."/menu.php/upload/search/".$_POST["name"]);
        die();
    }
    // Search / Upload Form template
    include_once("template/up_search.tpl");
    include_once("template/upload.tpl");
    // Pokemon Box list
    html_div(100,0,"#812919",30);
    echo "PokeMon Box";
    html_div_end();
    $PokemonBoxList = scandir("./pc/");
    foreach ($PokemonBoxList as $value) {
        if($value=="."||$value==".."){continue;}
        echo $value."<br>";
    }
}
?>
