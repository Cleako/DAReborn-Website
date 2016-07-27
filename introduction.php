<?php
/* Include Files *********************/
session_start();
include("head.php");



/*************************************/

if($logged_in)  {

$result = mysql_query("SELECT * FROM users WHERE username='$username'");

while($row = mysql_fetch_assoc($result))
   $user_level = $row["user_level"];
if ($user_level <= 100)
{
?>
<p>If you are new to the clan site, here is a guide on what to do. Firstly, if you dont know about something, check 
the <a href=faq.php>FAQ</a> on help on it. So, what do you do once you know about the clan? There are lots of things you can do. Most 
importabtly, stay active. Being active makes you popular and gives you a high reputation.
</p>
<p>
Once you get more involved and feel like helping the clan even more, take a job. Chose a job you wish to take 
and post about it on the <u>jobs board</u>(no board made yet, however). Go to the jobs page to find out more.
</p>
<p>
If you do these things more and more, you will earn respect and may very well be promoted. 
Here is a list of the things you can do to get a high position:
</p>
<ol align=left>
<li> Posting on the forum (share ideas, comment on ideas and comment on anything)</li>
<li> Sharing your msn/aim address (so that we can easily contact you)</li>
<li> Join a squad (see the ~squads~ page)</li>
<li> Coming along to clan events</li>
<li> Taking a job and contributing to it</li>
<li> Earning trust (show you are trustworthy and responsible)</li>
</ol>

<p>
After doing these things, you will very likely become an admin. So, try to be as active as possible and contribute 
but most importantly of all, have fun!
</p>

<p>Some people have done all of these and instantly been ranked up to the highest of positions.
Kane1245 is an example who was active, went to all of the events and showed he could be trusted.
He is now in the council of the top5!
<?php
}else{
echo 'You\'re not allowed to see this page';
}
 }else{
   echo 'Not logged in.';
}
include("foot.php");
?>


