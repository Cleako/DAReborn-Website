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
<h1><b>These are the events that DTD have had. We have had many great events,
not recorded here but u can see on the moviez</b></h1><br><br>

<hr>
<br><br>

<center><h2>March 13th, 2004 PK TRIP</h2><br><br>

Ok I hold another one mainly for the pics. A good turnout! Even kylie wylie 
turned up (on his first pk trip).<br><br>

Ok, the following ppl came to the trip:
tnuac<br>
kosmo7<br>
i rule2<br>
kylie wylie<br>
davey coops<br>
kane1254<br>
pk redman<Br>
justin219<br>
purekilla75 (2nd part)<br><br>

We held it in 2 parts as we rejoined. I think kosmo7 and i rule2 took the lead
(having good pking xp). We tottaly annihilated some guy trapped in the castle :)<br><br>

PoWeR tO tHe TiGeRs!<br><br>
<hr>
<br><br>
<center><h2>January 8th, 2004 PK TRIP</h2>
<h4>posted by tnuac</h4>
<br>
<br>
Mainly quite good! We hadn't had a pk trip in ages so i held one and it was a great turnout!</h4>
<br>
People there were:<br>
<br>Tnuac
<br>Chopa pker (Chopa234)
<br>Kosmo7 (Jeremy9)
<br>Pk redman (gmac525 on aim)
<br>Kane1254
<br>Kill Osama
<br>Zeroskaboard
<br>BdmxKamiKazi
<br><br>
Those who were not in the clan but were a great help:
<br>Advanse
<br>lionsr4ever1
<br>Mirrabmx1<br>

(I'd say these ppl deserve to be in the clan for their hard work throughout the trip)<br><br>

So, it started. More and more people came which stalled us a bit but we finally went on our way with about 10 people!
I lead the clan for a bit then bdmxkamikazi (on truestoner) took over showing us his skills.<br>
     It ended up with people spreading and getting lost but we got a few kills on the way. Well done guys!<br><br>

In total we got about 10 kills! (I really have to work on my pking). You all worked end and it ended up great.
Nice one!<br><br>

My prayer saved my r2h 3 times! BdmxKamiKazi is working on new pk methods to help us out! Next pk trip will be more planned.<br><Br>
<br>
<img src=http://www.angelfire.com/ult/squadtea/jan8pk2.JPG alt="just setting off!">
<img src=http://www.angelfire.com/ult/squadtea/jan8pk3.JPG alt="a good starting pic :D">
<img src=http://www.angelfire.com/ult/squadtea/jan8pk.JPG alt="I died then came back">

dArK tIgErS oF dEaTh!<br><br>

<hr>
<br><br>

<center>h2>October 4th, 2003 PK TRIP</h2>
<center><h4>posted by cleako</h4>
<center><h4>w00t we had a pk trip last night, 6 ppl were able to make it on such short notice. In a half hour, we scored 4 kills, 2 mainily by me, with help of the others</h4>

----------------------------------------

<h3 align="center"><b><i>September 6th 2003</i></b></h3>

<p>K r i S t o F223: Hedg E POng: KRIS<br>
Hedg E POng: NOW<br>
Hedg E POng: what world did DA change their trip to?<br>
CLEAK0: he doesnt know!<br>
Muahahahaha gay Icydoom was defeated! He couldnt find us and we got 14 Kills! </p>

<p>Huge turnout with the following brave clan members:<br>
(11)<br>
Wildcat99672<br>
Braveheart49<br>
Musicchic135<br>
Chopa pker<br>
Sucid<br>
Hellwomen11<br>
Superman_389<br>
Cleako<br>
Fire Flocks<br>
Bla64<br>
Bdmxkamikazi<br>
<br>
Those who were not in the clan but were a major help to us:<br>
(5)<br>
Nomad312<br>
Midguardian<br>
Diddydude<br>
John????<br>
Macten1<br>
<br>
In all we had 16 pkers assemble for the Dragon Annihlators Clan.<br>
<br>
Final Survivors in the end were:<br>
(6)<br>
Fire Flocks<br>
Cleako<br>
Midguardian<br>
Nomad312<br>
Chopa Pker?<br>
Bdmxkamikazi<br>
<br>
Following died and lost:<br>
(3)<br>
Sucid: R2h ?Rune battle?<br>
Hellwomen11: R2h<br>
Grim667000: R2h<br>
Those that are not listed did not tell me/I can remember<br>
<br>
9 Kills! Major W00tage<br>
<br>
This was a great pk trip and I took 9 or so photos that will be posted soon.<br>
<br>
Suicide PKing seems to be a good idea. My 46 prayer on cleako saved my life 5 times!! <br>
Prayer = GOOD<br>
<br>
<?php
}else{
echo 'You\'re not allowed to see this page';
}
 }else{
   echo 'Not logged in.';
}
include("foot.php");
?>


