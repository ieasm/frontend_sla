<p><form action="#" method="POST"><textarea name="servicename"></textarea> Service name</p>
<p><textarea name="first_date"></textarea>Start time e.g. "12 december 2012 20:45" or "12/12/2012 20:45"</p>
<p><textarea name="second_date"></textarea>End time e.g. "13 december 2012 22:30"or "12/13/2012 22:30"</p>
<p><input type="submit">
</form>

<?php
if (isset($_POST['servicename']) and isset($_POST['first_date']) and isset($_POST['second_date'])) {

$servicename = $_POST['servicename'];
$first_date = $_POST['first_date'];
$second_date = $_POST['second_date'];
header('Content-Type: text/html; charset=UTF-8');
$host='172.16.220.18';
$database='zabbix';
$user='zabbix';
$pswd='naukazabb1xslanet';

$link = mysql_connect($host , $user , $pswd) or die ("Не могу соединиться с сервером");
mysql_select_db($database) or die ("пиздец :(");

$query="SET names utf8";
mysql_query($query);


$query3="SELECT * FROM `services` WHERE `name` = '$servicename'";
$res=mysql_query($query3);
//echo strtotime($first_date);
//echo " - ";
//echo strtotime($second_date);

$h=0; //счетчик

while ($row = mysql_fetch_array($res))
{
 $bdid[$h]=$row['serviceid'];
//echo  $bdid[$h];
$h=$h+1;
}

##echo $h;

$clock1 = strtotime($first_date);
$clock2 = strtotime($second_date);


$query2="DELETE FROM `service_alarms` WHERE (`serviceid` = $bdid[0]) AND (`clock` BETWEEN $clock1 AND $clock2)";

echo $query2;
$del=mysql_query($query2);

mysql_close($link);
}
?>
