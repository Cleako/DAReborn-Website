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
<p>For those of you who are new, for those of you who want to 
remember their past, here is the history of the clan! Ill update
this as events come to us</p>
<h1></u>erez gold's view</h1></u>
<r>Well,not much here,i joined the clan on august 2000,at that time cleako was full leading,
bdmxkamikazi and icydoom were his "sidekicks". fast enough 
i gained respect,because of my towely bet story." i gained the nick name towel boy.
a new clan mascot was born. not too long after that.i noticed a lot of blank user messages.
only later i discovered it was icydoom that for no apparent reason went postal instantly.
he was the evil guy of those days,the site was badly damaged.
cleako and i worked and revived it. people joined,until one day, some dawnbuggie kid came along
and didnt like me being popular. same story here,went postal,kicked out.
anyways,everything was usual. people posting,pk trips every once in a while.
everything was fine. but,when the dawnzombie movie came out,the golden age arrived,and the clan prospered.
then one day not much later on, a boy a lil younger than me,tnuac joined. i decided to give him my guidance 
and be his guidor. later on he became one of my best friends in the clan, and the first clan member to be crowned towely!
</p>

<p>then,with the clan growing,i had a revolutionary idea-squads! anyways one day,for no apparent reason,cleako had decided to leave the clan and passed the leadership onto me and tnuac.
we worked hard,but it was like trying to empty a water bowl with a fork. luckily for us he decided to come back just berly in time and saved the clan and changed its name to DARK TIGERS OF DEATH
then after learning from his past mistakes he decided to form a leading council wich will rule with him back at those days it was named COUNCIL OF TIGERS.
everything was kinda fine,until one day my parents got pissed at me, and i got axhiled from the clan and the web. only later on i finally came back,and found out we have changed ourname back to DRAGON ANNIHILATORS
and we now have a new leader-50cent hobo.

(note:im aware that ive skipped a few things,well im not allknowing...just allmighty towelon :))






<h1><u>tnuacs view</u></h1>
<p>So, it begins..I have started very early on. I need anyone before
my time to fill in the parts i missed out.</p>

<hr>

<p>When I joined, I was brought into dragon annihilators. We had 
pk trips quite often. Cleako was in full lead and a lot of people were active. 
Also, a lot played runescape making it very easy to hold events. The problem was
that Dawnbuggie was in the clan, being the noob he was. At that time, Icydoom was 
now seen as a hacker, and everyone hated him.</p>

<p>Later on, Dawnbuggie had been kicked out for dillaberately annoying clan members.
Everyone celebrated and movies were made fun of Dawnbuggie (aka Dawnzombie).</p>

<p>Cleako decided that we needed a new name. Dragon Annihilators reminded us of the rule
by kinoobng, the noob who abandoned the clan when he was leader. We had a vote, giving 
the members a wide range of names and Dark Tigers of Death came along with the most number of
votes (about 7), so we officialy changed our name to Dark Tigers of Death (DTD / DTOD)</p>

<p>Then came a very important change. Cleako decided to have a rule where it was 'shared'
into members, instead of just one leader. We discussed this over msn and aim alot and finally
came up with a solution. We made 8 admins to be in the admin council, to lead over. We also then 
introduced 5 'squads' to organise the clan into groups. Erez Gold turned his into an acedemy for
wilderness tactics (see it <a href=http://www.avidgamers.com/tareborn>here</a>) and one of our leaders
could no longer lead the squad. We organised a few members into the remaining squads. This will work in
the future.</p>

<p>At this moment in time, there are no squads. That is because erez gold decided to start a whole new 
clan idea (with cleako not being able to be as active as he was before). Erez gold ordered the squads to
be put on hold while changes are being made. We try recruiting more members for a more active and strong clan.
New ranking systems are to be put in once scripts have been installed and information ot be organised.</p>

<p>There is a (kinda) brief history of the clan. Im sure that we will add to it as time goes on, and I hope that
the next to be leaders will do the same.</p>  

<p>~Lead us undertand the history, put our foot down on the present, and tread on to the future~</p>
<?php
}else{
echo 'You\'re not allowed to see this page';
}
 }else{
   echo 'Not logged in.';
}
include("foot.php");
?>


