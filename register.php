<?php
session_start(); 
include("database.php");
include("head2.php");

/**
 * Returns true if the username has been taken
 * by another user, false otherwise.
 */
function usernameTaken($username){
   global $conn;
   if(!get_magic_quotes_gpc()){
      $username = addslashes($username);
   }
   $q = "select username from users where username = '$username'";
   $result = mysql_query($q,$conn);
   return (mysql_numrows($result) > 0);
}

/**
 * Inserts the given (username, password) pair
 * into the database. Returns true on success,
 * false otherwise.
 */
function addNewUser($username, $password, $email, $name, $msn, $yahoo, $icq, $aim, $country, $birth, $user_level, $dl, $skype){
   global $conn;
   $q = "INSERT INTO users (username,password,email,name,msn,yahoo,icq,aim,country,birth,user_level,dl,skype) VALUES ('$username', '$password', '$email', '$name', '$msn', '$yahoo', '$icq', '$aim', '$country', '$birth', '$user_level', '$dl', '$skype')";
   return mysql_query($q,$conn);
}

/**
 * Displays the appropriate message to the user
 * after the registration attempt. It displays a 
 * success or failure status depending on a
 * session variable set during registration.
 */
function displayStatus(){
   $uname = $_SESSION['reguname'];
   if($_SESSION['regresult']){
?>

<h1>Registered!</h1>
<p>Thank you <b><?php echo $uname; ?></b>, an administrator will review your application shortly.</p>

<?php
   }
   else{
?>

<h1>Registration Failed</h1>
<p>We're sorry, but an error has occurred and your registration for the username <b><?php echo $uname; ?></b>, could not be completed.<br>
Please try again at a later time.</p>

<?php
   }
   unset($_SESSION['reguname']);
   unset($_SESSION['registered']);
   unset($_SESSION['regresult']);
}

if(isset($_SESSION['registered'])){
/**
 * This is the page that will be displayed after the
 * registration has been attempted.
 */
?>

<html>
<title>Registreren</title>
<body>

<?php displayStatus(); ?>

</body>
</html>

<?php
   return;
}

/**
 * Determines whether or not to show to sign-up form
 * based on whether the form has been submitted, if it
 * has, check the database for consistency and create
 * the new account.
 */
if(isset($_POST['subjoin'])){
   /* Make sure all fields were entered */
   if(!$_POST['user'] || !$_POST['pass']){
      die('You didn\'t fill in a required field.');
   }

   /* Spruce up username, check length */
   $_POST['user'] = trim($_POST['user']);
   if(strlen($_POST['user']) > 30){
      die("Sorry, the username is longer than 30 characters, please shorten it.");
   }

   /* Check if username is already in use */
   if(usernameTaken($_POST['user'])){
      $use = $_POST['user'];
      die("Sorry, the username: <strong>$use</strong> is already taken, please pick another one.");
   }

   /* Add the new account to the database */
   $md5pass = md5($_POST['pass']);
   $_SESSION['reguname'] = $_POST['user'];
   $_SESSION['regresult'] = addNewUser($_POST['user'], $md5pass, $_POST['email'], $_POST['name'], $_POST['msn'], $_POST['yahoo'], $_POST['icq'], $_POST['aim'], $_POST['country'], $_POST['birth'], $_POST['user_level'], $_POST['dl'], $_POST['skype']);
   $_SESSION['registered'] = true;
   echo "<meta http-equiv=\"Refresh\" content=\"0;url=$_SERVER[SCRIPT_NAME]\">";
   return;
}
else{
/**
 * This is the page with the sign-up form, the names
 * of the input fields are important and should not
 * be changed.
 */
?>

<html>
<title>Registration Page</title>
<body>
<h1>Register</h1><BR>

<BR>
</small></small></small></font>
<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
<table align="center" border="1" bordercolor=000000 cellspacing="0" cellpadding="3">
<tr><td colspan=2>These 3 fields are required:</td></tr>
<tr><td>Username:</td><td><input type="text" name="user" maxlength="30" style="background-color: rgb(0,0,0); color: rgb(0,0,255); border: medium inset rgb(0,0,255)"></td></tr>
<tr><td>Password:</td><td><input type="password" name="pass" maxlength="30" style="background-color: rgb(0,0,0); color: rgb(0,0,255); border: medium inset rgb(0,0,255)"></td></tr>
<tr><td>Email:</td><td><input type="text" name="email" maxlength="100" style="background-color: rgb(0,0,0); color: rgb(0,0,255); border: medium inset rgb(0,0,255)"></td></tr>
<tr><td colspan=2>Personal Details:</td></tr>
<tr><td>Real Name:</td><td><input type="text" name="name" maxlength="30" style="background-color: rgb(0,0,0); color: rgb(0,0,255); border: medium inset rgb(0,0,255)"></td></tr>
<tr><td>MSN:</td><td><input type="text" name="msn" maxlength="30" style="background-color: rgb(0,0,0); color: rgb(0,0,255); border: medium inset rgb(0,0,255)"></td></tr>
<tr><td>Yahoo:</td><td><input type="text" name="yahoo" maxlength="30" style="background-color: rgb(0,0,0); color: rgb(0,0,255); border: medium inset rgb(0,0,255)"></td></tr>
<tr><td>ICQ:</td><td><input type="text" name="icq" maxlength="30" style="background-color: rgb(0,0,0); color: rgb(0,0,255); border: medium inset rgb(0,0,255)"></td></tr>
<tr><td>AIM:</td><td><input type="text" name="aim" maxlength="30" style="background-color: rgb(0,0,0); color: rgb(0,0,255); border: medium inset rgb(0,0,255)"></td></tr>
<tr><td>SKYPE:</td><td><input type="text" name="skype" maxlength="30" style="background-color: rgb(0,0,0); color: rgb(0,0,255); border: medium inset rgb(0,0,255)"></td></tr>
<tr><td>Country:</td><td><input type="text" name="country" maxlength="30" style="background-color: rgb(0,0,0); color: rgb(0,0,255); border: medium inset rgb(0,0,255)"></td></tr>
<tr><td>Date of birth (dd-mm-yyyy):</td><td><input type="text" name="birth" maxlength="30" style="background-color: rgb(0,0,0); color: rgb(0,0,255); border: medium inset rgb(0,0,255)"></td></tr>

</td></tr>
<input type="hidden" value="10" name="user_level" maxlength="4">
<input type="hidden" value="Member" name="dl" maxlength="4">

<tr><td colspan="2" align="right"><input type="submit" name="subjoin" value="Join!"></td></tr>
</table>
</form>
</body>
</html>


<?php
}
include("foot.php");
?>
