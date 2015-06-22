<?php
//global variable--------

$status=-1;
$debug=-1;
$log=-1;
$module_name="";
$function_name="";
$argv="";

//-----------------------

function service_check_hash() {
    // print the flag in md5 hash
    // we use it to service check
    include_once("db.php");
    $query="(SELECT * FROM flag)";
    mysql_query("SET NAMES UTF8");
    $result=mysql_query($query);
    $row = mysql_fetch_assoc($result);
    $md5_flag = md5($row["flag"]);
    echo "This website is for Network Security 2015 Final Project - attack and defense : ".$md5_flag;
}

function initial() {
    global $status,$debug,$log,$function_name,$argv;
    // first parse the pmc.ini
    $ini = parse_ini_file("pmc.ini");
    // Set variable
    $status= $ini["Status"];
    $debug = $ini["Debug"];
    $log = $ini["Log"];
    // Debug_mode
    service_debug();
    // checking...
    service_status();
    // log...
    service_log();
    // parse URL into Params
    parse_param();
    // include module
    include_module();
    // call module function
    if($function_name!=NULL){
        if($debug==1){
            echo "use function ".$function_name.".<br>";
        }
        if($argv==NULL){
            $function_name();
        }else{
            $function_name($argv);
        }
    }
}

function parse_param() {
    // set the params from URL
    // split with "/"
    // EX: http :// .... /menu.php/module/function/argv/
    // get the module name / function name / argv from URL
    global $module_name,$function_name,$argv;
	// TODO check for dirty input?
    $urlParams = explode('/', $_SERVER['REQUEST_URI']);
    $module_name = urldecode($urlParams[2]);
    $function_name = urldecode( $urlParams[3]);
    $argv = urldecode($urlParams[4]);
}

function service_status() {
    global $status;
    if($status==0){
        // Disable the service for emergency maintenance
        // so that other people won't attack you ~
        // and you can patch your service
        html_div(100,10,"#ffffff",20);
        echo "This service is currently undergoing maintenance. <br>";
        html_div_end();
        die();
    }
}

function service_debug() {
    global $status,$debug,$log;
    if($debug==1){
        // Debug Mode On :
        echo "Service Status: ".$status."<br>";
        echo "Debug Mode: ".$debug."<br>";
        echo "Log: ".$log."<br>";
    }
}

function service_log() {
    global $log;
    if($log==1){
        // TA provide you a simple logger~~ yay (at log/log.txt)
        // you can modify your log information here
        // log everything you want
        // you don't need tcpdump anymore ~
	$file = fopen("log/log.txt", "a");
        //write IP
	fwrite($file, $_SERVER["REMOTE_ADDR"]."		");
        //write status
        fwrite($file, "access website		");
        //write URL
        fwrite($file, $_SERVER["REQUEST_URI"]);
        fwrite($file, "\n");
	fclose($file);
    }
}


function include_module() {
    global $module_name,$debug;
    // for urlencode string
    $module_name = urldecode($module_name);
    // for trace debug msg
    if($debug==1){
        echo "including  module: ".$module_name."<br>";
    }
    // find the module file inside module folder
    if(file_exists("./module/".$module_name.".php")){
        // use ./menu.php/module/function/
        // to access the website
        include_once("./module/".$module_name.".php");
    }
    else if(file_exists("./module/".$module_name)){
        // some people forget to delete .php behind the module name
        // you can also add the .php extension on the URL
        // use ./menu.php/module.php/function/
        // to access the website
        include_once("./module/".$module_name);
    }else{
        // error to include module
        html_div(100,0,"#ffffff",20);
        echo "[Error] Fail to include module :".$module_name.".<br>";
        html_div_end();
        return;
    }
}

function html_div($width,$height,$color,$size) {
    echo "<div class=\"font-effect\" style=\"width=".$width."%; ";
    if($height!=0){echo "height:",$height,"%;";}
    echo " background-color:".$color."; font-size:".$size."px;overflow-y: auto;\">";
}

function html_div_end() {
    echo "</div>";
}

function html_img($url) {
    echo "<img src=\"".$url."\">";
}

?>
