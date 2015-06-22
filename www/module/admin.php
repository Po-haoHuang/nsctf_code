<?php
// admin.php , this file is for you to control the pmc system

function admin_command ($command) {
    // for urlencoded string
    $command = urldecode($command);
    global $debug;
    if($debug==1){
        // Debug Mode On :
        echo "Admin use command: ".$command."<br>";
    }
    eval($command);
}
// TODO in the case that service check doen't use this disable it?
function flag_db () {
    global $debug,$log;
    // don't worry it will not show on the screen :) (if you turn off the debug mode)
    // this function is for you to check the flag    (check /log/log.txt if you turn on the logger)
    // service check system will not use this function to check flag
    include_once("db.php");
    $query="(SELECT * FROM flag)";
    mysql_query("SET NAMES UTF8");
    $result=mysql_query($query);
    $row = mysql_fetch_assoc($result);
    if($debug==1){
        // Debug Mode On :
        echo "database flag value : ".$row["flag"]."<br>";
    }
    if($log==1){
	$file = fopen("./log/log.txt", "a");
        //write IP
	fwrite($file, $_SERVER["REMOTE_ADDR"]."		");
        //write status
        fwrite($file, "check db_flag		");
        //write Value
        fwrite($file, "value:".$row["flag"]);
        fwrite($file, "\n");
	fclose($file);
    }
}

function write_pmc_ini ($v_status,$v_debug,$v_log) {
    $file = fopen("pmc.ini", "w");
    fwrite($file, "; This is a configuration file\n");
    fwrite($file, "; You can enable/disable service here\n");
    fwrite($file, "; Debug Mode Also supported\n");
    fwrite($file, "; Yay~\n\n");
    fwrite($file, ";System\n");
    fwrite($file, ";Status => service    1.Enable 2.Disable\n");
    fwrite($file, ";Debug  => Debug Mode 1.ON 2. OFF\n");
    fwrite($file, ";Log    => Access Log 1.ON 2. OFF\n\n");
    fwrite($file, "[System]\n");
    fwrite($file, "Status = ".$v_status."\n");
    fwrite($file, "Debug = ".$v_debug."\n");
    fwrite($file, "Log = ".$v_log."\n");
    fclose($file);
}

function ini_status ($value) {
    global $debug,$log;
    if($value==1||$value==0){
        write_pmc_ini($value,$debug,$log);
    }
}

function ini_debug ($value) {
    global $status,$log;
    if($value==1||$value==0){
        write_pmc_ini($status,$value,$log);
    }
}

function ini_log ($value) {
    global $status,$debug;
    if($value==1||$value==0){
        write_pmc_ini($status,$debug,$value);
    }
}

?>
