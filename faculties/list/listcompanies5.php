<?php

@session_save_path("../../session");
@session_start();

if ($_SESSION['faculty'] != "Faculty")
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../../index.php">';
else
{
	$_SESSION['generated']=time(); //refresh session content to last time use time
}

$activeuser = $_SESSION['user'];
$activename = $_SESSION['name'];
$activerole = $_SESSION['faculty'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<!-- Design by Free CSS Templates http://www.freecsstemplates.org Released for free under a Creative Commons Attribution 2.5 License -->
<meta http-equiv="content-type" content="text/html; charset=utf-8" /><title>Dextrix [IN] 2009 - Faculty</title>

<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="../../default.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {color: #333333}
.style2 {color: #999999; }
.style3 {color: #666666}
.style4 {font-size: 14px}
.style5 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>
</head>


<body>
<div id="header">
<h1>dextrix 09 | information  services </h1>
<h2>&nbsp;</h2>
</div>
<!-- end #header -->
<div id="menu">
<ul>
<li class="first"><a href="../faculty.php" accesskey="1" title="">home</a></li>
<li><a href="../add/addfaculty.php" accesskey="5" title="">faculties </a><a href="listcolleges5.php" accesskey="2" title="">colleges</a></li>
<li><a href="mycompanies.php" accesskey="3" title="">my companies</a></li>
<li><a href="listcompanies5.php" accesskey="5" title="">companies </a><a href="listevents5.php" accesskey="4" title="">events</a></li>
<li><a href="listtasks5.php" accesskey="4" title="">tasks</a><a href="../../index.php" accesskey="5" title="">log out </a></li>
</ul>
</div>
<!-- end #menu -->
<div id="content">
  <div style="clear: both;">
    <p><span class="style4">&nbsp;</span><span class="style5"><?php echo "Welcome $activename ! You are logged in as $activerole !"; ?></span> </p>
    <p>&nbsp;</p>
  </div>
<div id="posts">
<div class="post">
<h2 class="title">companies...</h2>
</div>
<div class="post">
  <div class="story">
<table width="150%" border="0">
  <tr>
    <td><?php 
    @ $rpp; 
    @ $cps; 
    @ $lps; 
    @ $a;
    @ $b;
    
	@mysql_connect("localhost","sundeep","321mysql"); 
    @mysql_select_db("mysql1") or die( "Unable to select database"); 
    
	if(empty($_GET["cps"])) 
    { 
        $cps = "0"; 
    } 
    else 
    { 
        $cps = $_GET["cps"]; 
    } 
    
    $a = $cps+1; 
    $rpp = "15"; 
    $lps = $cps - $rpp;

    if ($cps <> 0) 
    { 
        $prv =  "<a href='listcompanies5.php?cps=$lps'>Previous</a>"; 
    } 
    else    
    { 
        $prv =  "<font color='CCCCCC'>Previous</font>"; 
    } 
    $q="Select SQL_CALC_FOUND_ROWS * from companies WHERE contactstatus = 'Contacted' ORDER BY date Desc limit $cps, $rpp"; 
    $rs=mysql_query($q) or die(mysql_error()); 
    $nr = mysql_num_rows($rs);

    $q0="Select FOUND_ROWS()"; 
    $rs0=mysql_query($q0) or die(mysql_error()); 
    $row0=mysql_fetch_array($rs0); 
    $nr0 = $row0["FOUND_ROWS()"];

    if (($nr0 < 10) || ($nr < 10)) 
    { 
           $b = $nr0; 
    } 
    else 
    { 
        $b = ($cps) + $rpp; 
    } 
    ?> 
<br> 
<table width="936" height="100" border="1" align="center" cellpadding="2" cellspacing="2">
	<tr>
	<th><font face="Arial, Helvetica, sans-serif">Ref No</font></th>
	<th><font face="Arial, Helvetica, sans-serif">Company Name</font></th>
	<th><font face="Arial, Helvetica, sans-serif">Based at</font></th>
	<th><font face="Arial, Helvetica, sans-serif">Company Email</font></th>
	<th><font face="Arial, Helvetica, sans-serif">Person Contacting</font></th>
	<th><font face="Arial, Helvetica, sans-serif">Approach Status</font></th>
	<th><font face="Arial, Helvetica, sans-serif">Brand</font></th>
	<th><font face="Arial, Helvetica, sans-serif">Last Updated</font></th>
</tr>
    <? 
    while ($i < $row=mysql_fetch_array($rs)) 
    { 
        $cps = $cps + 1; 

        $f1=$row["refno"];
		$f2=$row["company"];
		$f3=$row["location"];
		$f4=$row["companyemail"];
		$f5=$row["mmanager"];
		$f6=$row["sponsorship"];
		$f7=$row["brand"];
		$f8=$row["date"];
	?>
		
    <tr>
	<td><font face="Arial, Helvetica, sans-serif"><?php echo $f1; ?></font></td>
	<td><font face="Arial, Helvetica, sans-serif"><?php echo $f2; ?></font></td>
	<td><font face="Arial, Helvetica, sans-serif"><?php echo $f3; ?></font></td>
	<td><font face="Arial, Helvetica, sans-serif"><?php echo $f4; ?></font></td>
	<td><font face="Arial, Helvetica, sans-serif"><?php echo $f5; ?></font></td>
	<td><font face="Arial, Helvetica, sans-serif"><?php echo $f6; ?></font></td>
	<td><font face="Arial, Helvetica, sans-serif"><?php echo $f7; ?></font></td>
	<td><font face="Arial, Helvetica, sans-serif"><?php echo $f8; ?></font></td>
	</tr>
    
	<?php 
    $i++;
	}
    echo "<tr><td align='right'>$prv"; 

    if ($cps == $nr0) 
    {      
        echo "  |  <font color='CCCCCC'>Next</font>"; 
    } 
    else 
    { 
        if ($nr0 > 1) 
        { 
            echo "  |  <a href='listcompanies5.php?cps=$cps&lps=$lps'>Next</a>"; 
        } 
    } 
    ?>
	</td>
  </tr>
</table>
<p>&nbsp;</p>
</div>
</div>
</div>
<!-- end #posts -->
<!-- end #links -->
<div style="clear: both;">&nbsp;</div>
</div>
<!-- end #content -->
<div id="footer">
<p id="legal">Copyright ?? 2009 DEXTRIX [AT] APIIT SD INDIA | <a href="http://dextrix.org" class="style2">dextrix.org</a> | <a href="http://register.dextrix.org" class="style2">register.dextrix.org</a> | <a href="http://alumniapiit.blogspot.com/" class="style2">alumni meet blog</a> | <a href="http://apiit.edu.in" class="style2">apiit.edu.in</a> | <a href="mailto:info@dextrix.org" class="style2">info@dextrix.org</a> </p>
</div>
<!-- end #footer -->
</body></html>