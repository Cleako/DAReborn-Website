<?php
/* Include Files *********************/
session_start();
include("database.php");
include("login.php");
include("head2.php");
include("style.css");
/*************************************/
?>

<TITLE>Dragon Annihilators Reborn Gaming Company</TITLE>
<META NAME="Keywords" CONTENT="dragons,dar,dragon annihilators,cleako">
<META NAME="Description" CONTENT="We pwn all noobs">
<META NAME="Author" CONTENT="">
</head>
<body bgcolor="#000000" text="#FF0000" link="#0000FF" alink="#0080FF">

<center>
<?php
if($logged_in)
{
?>
<br><h6>Already logged in.  <a href="private.php">Continue to Members Area</a></h6><br>
<?php
}else{
displayLogin();
}
?>

</body>
</html>
<?php
include("foot.php");
?>