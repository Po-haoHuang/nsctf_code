<?php
// set database username and password
// TODO change user pass?
$userName="joy";
$password="chansey";
$hostName="127.0.0.1";
$link=mysql_connect($hostName, $userName, $password);
mysql_select_db("pmc", $link);

function id($search) {
    //pokedex search by id
    //you can filter the "$search" here to protect SQL Injection
    //for example : use "preg_replace(pattern, replacement, string)" function to filter some special words
	// TODO check dirty input?
    $query="SELECT * FROM pm_list WHERE id=".$search;
    mysql_query("SET NAMES UTF8");
    $result=mysql_query($query);
    while($row = mysql_fetch_assoc($result)){
        html_div(100,10,"#ffffff",20);
        echo $row["id"]." ".$row["name"];
        html_div_end();
    }
}

function name($search) {
    //pokedex search by name
    //you can filter the "$search" here to protect SQL Injection
    //EX: use "preg_replace(pattern, replacement, string)" function to filter some special words
	// TODO check dirty input?
    $query="SELECT * FROM pm_list WHERE name='".$search."'";
    mysql_query("SET NAMES UTF8");
    $result=mysql_query($query);
    while($row = mysql_fetch_assoc($result)){
        html_div(100,10,"#ffffff",20);
        echo $row["id"]." ".$row["name"];
        html_div_end();
    }
}

function search() {
    //search form
    if(isset($_POST["id"])){
        //search by id
		// TODO check for dirty inpu?
        header("Location: http://".$_SERVER['HTTP_HOST']."/menu.php/db/id/".$_POST["id"]);
        die();
    }
    if(isset($_POST["name"])){
        //search by name
		// TODO check for dirty inpu?
        header("Location: http://".$_SERVER['HTTP_HOST']."/menu.php/db/name/".$_POST["name"]);
        die();
    }
    //include search engine template
    include_once("template/db_id.tpl");
    include_once("template/db_name.tpl");

    //list pokeDex
    html_div(100,0,"#812919",30);
    echo "PokeDex";
    html_div_end();

    $query="SELECT * FROM pm_list";
    mysql_query("SET NAMES UTF8");
    $result=mysql_query($query);

    html_div(100,25,"#ffffff",15);
    while($row = mysql_fetch_assoc($result)){
        html_div(100,10,"#ffffff",20);
        echo $row["id"]." ".$row["name"];
        html_div_end();
    }
    html_div_end();
}

?>
