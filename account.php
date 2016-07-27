<?php
include("head.php");
if($logged_in)
{
$query = "UPDATE users SET name = '$ud_name', password = 'md5($ud_password)', email = '$ud_email', msn = '$ud_msn', yahoo = '$ud_yahoo', google = '$ud_google', icq = '$ud_icq', aim = '$ud_aim', birth = '$ud_birth', country = '$ud_country', skype = '$ud_skype', avatar = '$ud_avatar', sig = '$ud_sig' WHERE username = '$ud_username'";
$ud_password=$_POST['ud_password'];
$ud_name=$_POST['ud_name'];
$ud_email=$_POST['ud_email'];
$ud_msn=$_POST['ud_msn'];
$ud_yahoo=$_POST['ud_yahoo'];
$ud_google=$_POST['ud_google'];
$ud_icq=$_POST['ud_icq'];
$ud_aim=$_POST['ud_aim'];
$ud_birth=$_POST['ud_birth'];
$ud_country=$_POST['ud_country'];
$ud_skype=$_POST['ud_skype'];
$ud_avatar=$_POST['ud_avatar'];
$ud_sig=$_POST['ud_sig'];

$query="UPDATE users SET name='$ud_name', password='md5($ud_password)', email='$ud_email', msn='$ud_msn', yahoo='$ud_google', yahoo='$ud_google', icq='$ud_icq', aim='$ud_aim', birth='$ud_birth', country='$ud_country', skype='$ud_skype', avatar='$ud_avatar', sig='$ud_sig' WHERE username='$ud_username'";
mysql_query($query);

$query=" SELECT * FROM users WHERE username='$username'";
$result=mysql_query($query);
$num=mysql_num_rows($result);


$i=0;
while ($i < $num) {
$username=mysql_result($result,$i,"username");
$name=mysql_result($result,$i,"name");
$password=mysql_result($result,$i,md5("ud_password"));
$email=mysql_result($result,$i,"email");
$msn=mysql_result($result,$i,"msn");
$yahoo=mysql_result($result,$i,"yahoo");
$google=mysql_result($result,$i,"google");
$icq=mysql_result($result,$i,"icq");
$aim=mysql_result($result,$i,"aim");
$birth=mysql_result($result,$i,"birth");
$country=mysql_result($result,$i,"country");
$skype=mysql_result($result,$i,"skype");
$avatar=mysql_result($result,$i,"avatar");
$sig=mysql_result($result,$i,"sig");

?>

<center>
<form action="account.php" method="post">
<input type="hidden" name="ud_username" value="<?php echo $username; ?>">
<table width="486" border="1" cellpadding=0 cellspacing=0 bordercolor=000000>
  <tr>
    <td width="219">Password:</td>
    <td width="251"><input type="text" name="ud_password" value="<?php echo $password; ?>" /></td>
    </tr>
  <tr>
    <td>Full Name:</td>
    <td><input type="text" name="ud_name" value="<?php echo $name; ?>" /></td>
    </tr>
  <tr>
    <td>Email:</td>
    <td><input type="text" name="ud_email" value="<?php echo $email; ?>" /></td>
  </tr>
  <tr>
    <td>MSN: </td>
    <td><input type="text" name="ud_msn" value="<?php echo $msn; ?>" /></td>
  </tr>
  <tr>
    <td>Yahoo: </td>
    <td><input type="text" name="ud_yahoo" value="<?php echo $yahoo; ?>" /></td>
  </tr>
  <tr>
    <td>Google: </td>
    <td><input type="text" name="ud_google" value="<?php echo $google; ?>" /></td>
  </tr>
  <tr>
    <td>ICQ:</td>
    <td><input type="text" name="ud_icq" value="<?php echo $icq; ?>" /></td>
  </tr>
  <tr>
    <td>AIM:</td>
    <td><input type="text" name="ud_aim" value="<?php echo $aim; ?>" /></td>
  </tr>
  <tr>
    <td>SKYPE: </td>
    <td><input type="text" name="ud_skype" value="<?php echo $skype; ?>" /></td>
  </tr>
  <tr>
    <td>Birthday (dd-mm-yy): </td>
    <td><input type="text" name="ud_birth" value="<?php echo $birth; ?>" /></td>
  </tr>
  <tr>
    <td>Country: </td>
    <td><input type="text" name="ud_country" value="<?php echo $country; ?>" /></td>
  </tr>

<TR><TD ALIGN="LEFT">Avatar(100X100):</TD>
<TD ALIGN="LEFT"><INPUT TYPE="TEXT" SIZE="20" NAME="ud_avatar" VALUE="<?php echo $avatar; ?>"></TD></TR>
<TR><TD ALIGN="LEFT">Signature(max400):</TD>
<TD ALIGN="LEFT"><textarea cols="40" rows=4 maxlength=400 NAME="ud_sig"><?php echo $sig; ?></textarea></TD></TR>
  <tr>
    <td colspan="2"><div align="center">
      <input name="Submit" type="Submit" value="Update" />
    </div></td>
    </tr>
</table>
<BR>

</form>
<?php
++$i;
}
}
else{
 echo 'Not logged in.';
}
include("foot.php");
?>
