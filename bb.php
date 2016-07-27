<?php
/* Include Files *********************/
session_start();
include("head3.php");



/*************************************/

if($logged_in)  {

$result = mysql_query("SELECT * FROM users WHERE username='$username'");

while($row = mysql_fetch_assoc($result))
   $user_level = $row["user_level"];
if ($user_level <= 10)
{
?>

<h1>The Forum BB Codes:</h1><BR><BR>

[url=URL]Link Name[/url]<BR>
[img=URL] (Just put in picture URL)<BR>
[b]bold[/b]<BR>
[i]italic[/i]<BR>
[u]underline[/u]<BR>
[s]strikeout[/s]<BR>
[left]left aligned text[/left]<BR>
[center]center aligned text[/center]<BR>
<center><a href="forum_list.php" name="Back to Forum List"></a></center>
[right]right aligned text[/right]<BR>



<div class="center"><script type="text/javascript">
<!-- WTF is this?? -->
<!--// DO NOT EDIT
function get_referrer(lk){var dc=document;if(dc.location==''){return 
true}var ru=escape(dc.location);var pu='';var 
du;if(lk!=null){if(lk.href!=null){du=lk.href;}else if(lk.form!=null && 
lk.form.referrer_url!=null){lk.form.referrer_url.value=dc.location;return true}}else 
if(pu!=''){du=pu}else{return true}if(du==null){return 
true}if(du.match(/\?/)){du=du+'&'}else{du=du+'?'}du=du+'referrer_url='+ru;if(lk!=null && 
lk.href!=null){lk.href=du}else{window.location=du;return false}return true}
-->
</script>
</object>
<?php
}else{
echo 'You\'re not allowed to see this page';
}
 }else{
   echo 'Not logged in.';
}
include("foot.php");
?>