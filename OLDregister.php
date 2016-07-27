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
function addNewUser($username, $password, $email, $name, $msn, $yahoo, $icq, $aim, $country, $birth, $attack, $defence, $strength, $hitpoints, $ranged, $prayer, $magic, $cooking, $woodcutting, $fletching, $fishing, $firemaking, $crafting, $smithing, $mining, $herblore, $agility, $thieving, $runecrafting, $combat, $overall, $user_level, $rs, $squad, $clanname, $url, $totmembers, $dl, $other){
   global $conn;
   $q = "INSERT INTO users (username,password,email,name,msn,yahoo,icq,aim,country,birth,attack,defence,strength,hitpoints,ranged,prayer,magic,cooking,woodcutting,fletching,fishing,firemaking,crafting,smithing,mining,herblore,agility,thieving,runecrafting,combat,overall,user_level,rs,squad,clanname,url,totmembers,dl,other) VALUES ('$username', '$password', '$email', '$name', '$msn', '$yahoo', '$icq', '$aim', '$country', '$birth', '$attack', '$defence', '$strength', '$hitpoints', '$ranged', '$prayer', '$magic', '$cooking', '$woodcutting', '$fletching', '$fishing', '$firemaking', '$crafting', '$smithing', '$mining', '$herblore', '$agility', '$thieving', '$runecrafting', '$combat', '$overall', '$user_level', '$rs', '$squad', '$clanname', '$url', '$totmembers', '$dl', '$other')";
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
<p>Thank you <b><?php echo $uname; ?></b>, your information has been send, You have to wait till a admin accepted you.</p>

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
<title>Registration Page</title>
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
   $_SESSION['reguname'] = $_POST['user'];
   $_SESSION['regresult'] = addNewUser($_POST['user'], $_POST['pass'], $_POST['email'], $_POST['name'], $_POST['msn'], $_POST['yahoo'], $_POST['icq'], $_POST['aim'], $_POST['country'], $_POST['birth'], $_POST['attack'], $_POST['defence'], $_POST['strength'], $_POST['hitpoints'], $_POST['ranged'], $_POST['prayer'], $_POST['magic'], $_POST['cooking'], $_POST['woodcutting'], $_POST['fletching'], $_POST['fishing'], $_POST['firemaking'], $_POST['crafting'], $_POST['smithing'], $_POST['mining'], $_POST['herblore'], $_POST['agility'], $_POST['thieving'], $_POST['runecrafting'], $_POST['combat'], $_POST['overall'], $_POST['user_level'], $_POST['rs'], $_POST['squad'], $_POST['clanname'], $_POST['url'],  $_POST['totmembers'], $_POST['dl'], $_POST['other']);
   $_SESSION['registered'] = true;
   echo "<meta http-equiv=\"Refresh\" content=\"0;url=$HTTP_SERVER_VARS[PHP_SELF]\">";
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
<strong><big>Must have </em><big><big><big><big>60+ HP</big></big></big></big><em>
          or</font><font face="Batang"> have a non combat skill above level 65</font><font
          face="Arial Black"> to join</big><br>
          </strong><br>
          <small><small><small>Exceptions: </small><br>
          <small>=Ex clan members permitted to rejoin - even if their combat is not past 60, those<BR>
          deleted for inactivity must comply with the current minimal level rules.</small><br>
          <small>=Family members of Admins may join, but under one condition, they be carefully<BR>
          watched, and kept under control by their blood relative, Administrator.</small><br>
          <small>=Those who actually are permitted to join who dont meet the minimum requirements<BR>
          must keep their mouth shut and try their best to act as NON noobish as possible.<BR><BR></small></small></small></font>
<form action="<?php echo $HTTP_SERVER_VARS['PHP_SELF']; ?>" method="post">
<table align="center" border="0" cellspacing="0" cellpadding="3">
<tr><td></td><td>These 3 fields are required:</td></tr>
<tr><td>Username:</td><td><input type="text" name="user" maxlength="30"></td></tr>
<tr><td>Password:</td><td><input type="password" name="pass" maxlength="30"></td></tr>
<tr><td>Email:</td><td><input type="text" name="email" maxlength="100"></td></tr>
<tr><td></td><td>Personal Details:</td></tr>
<tr><td>Real Name:</td><td><input type="text" name="name" maxlength="30"></td></tr>
<tr><td>MSN:</td><td><input type="text" name="msn" maxlength="30"></td></tr>
<tr><td>Yahoo:</td><td><input type="text" name="yahoo" maxlength="30"></td></tr>
<tr><td>ICQ:</td><td><input type="text" name="icq" maxlength="30"></td></tr>
<tr><td>AIM:</td><td><input type="text" name="aim" maxlength="30"></td></tr>
<tr><td>Country:</td><td><input type="text" name="country" maxlength="30"></td></tr>
<tr><td>Age (dd-mm-yyyy):</td><td><input type="text" name="birth" maxlength="30"></td></tr>
<tr><td></td><td>Runescape Stats:</td></tr>
<tr><td>Attack:</td><td><input type="text" name="attack" maxlength="4"></td></tr>
<tr><td>Defence:</td><td><input type="text" name="defence" maxlength="4"></td></tr>
<tr><td>Strength:</td><td><input type="text" name="strength" maxlength="4"></td></tr>
<tr><td>Hitpoints:</td><td><input type="text" name="hitpoints" maxlength="4"></td></tr>
<tr><td>Ranged:</td><td><input type="text" name="ranged" maxlength="4"></td></tr>
<tr><td>Prayer:</td><td><input type="text" name="prayer" maxlength="4"></td></tr>
<tr><td>Magic:</td><td><input type="text" name="magic" maxlength="4"></td></tr>
<tr><td>Cooking:</td><td><input type="text" name="cooking" maxlength="4"></td></tr>
<tr><td>Woodcutting:</td><td><input type="text" name="woodcutting" maxlength="4"></td></tr>
<tr><td>Fletching:</td><td><input type="text" name="fletching" maxlength="4"></td></tr>
<tr><td>Fishing:</td><td><input type="text" name="fishing" maxlength="4"></td></tr>
<tr><td>Firemaking:</td><td><input type="text" name="firemaking" maxlength="4"></td></tr>
<tr><td>Crafting:</td><td><input type="text" name="crafting" maxlength="4"></td></tr>
<tr><td>Smithing:</td><td><input type="text" name="smithing" maxlength="4"></td></tr>
<tr><td>Mining:</td><td><input type="text" name="mining" maxlength="4"></td></tr>
<tr><td>Herblore:</td><td><input type="text" name="herblore" maxlength="4"></td></tr>
<tr><td>Agility:</td><td><input type="text" name="agility" maxlength="4"></td></tr>
<tr><td>Thieving:</td><td><input type="text" name="thieving" maxlength="4"></td></tr>
<tr><td>Runecrafting:</td><td><input type="text" name="runecrafting" maxlength="4"></td></tr>
<tr><td>Combat:</td><td><input type="text" name="combat" maxlength="4"></td></tr>
<tr><td>Overall Skills:</td><td><input type="text" name="overall" maxlength="4"></td></tr>
<tr><td></td><td><input type="hidden" value="100" name="user_level" maxlength="4"></td></tr>
<tr><td>Which RS do you play?:</td><td><select name="rs">
<option value="RSC">RSC</option>
<option value="RS2">RS2</option>
</select>
</td></tr>

<tr><td></td><td><input type="hidden" value="none" name="squad" maxlength="4"></td></tr>
<tr><td>Anything else you'd like to tell us?:</td><td><textarea name="other" rows=6 cols=40></textarea>
<input type="hidden" value="none" name="clanname" maxlength="5">
<input type="hidden" value="none" name="url" maxlength="100">
<input type="hidden" value="none" name="totmembers" maxlength="100">

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
