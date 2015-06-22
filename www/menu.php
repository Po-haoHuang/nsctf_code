<?php
header('Content-Type: text/html; charset=utf8');
// include library
include_once("common.php");
?>

<html>

<head>
    <title>PokeMon Center</title>
    <link href='http://fonts.googleapis.com/css?family=Black+Ops+One' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/CSS/style.css">
</head>

<body style="margin:0;">

<?php
    //template
    include_once("./template/menu.tpl");
    //call function
    initial();

    //hello message
    if(($module_name=="")&&($function_name=="")){
        html_div(100,0,"#ffffff",30);
        echo "Welcome to Pokemon Center.";
        html_div_end();
        html_img("http://".$_SERVER['HTTP_HOST']."/img/chansey.png");
    }

    //template
    include_once("./template/bottom.tpl");
?>

</body>

</html>
