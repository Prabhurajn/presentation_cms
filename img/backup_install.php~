<?php

$str = "<?php\n"
.'$hname= "'.$_REQUEST['hostnametxt'].'";'."\n"
.'$uname= "'.$_REQUEST['dbusrtxt'].'";'."\n"
.'$pwd= "'.$_REQUEST['dbpwdtxt'].'";'."\n"
.'$dbname= "'.$_REQUEST['dbnametxt'].'";'."\n"
.'$tb_pr= "'.$_REQUEST['prefixtxt'].'";'."\n"
."?>";

echo $str;
$file = fopen("settings.php","w");
echo fwrite($file, $str);
fclose($file);

include('settings.php');
echo $dbname."<br />";

$conn = mysqli_connect($hname,$uname,$pwd,$dbname);

if(! $conn )
	die("not connected to mysqli".mysqli_errno());
else 
	echo "\nConnection Successfully done";

$var1 = 0;

/*--------------user_details--------------*/
$sql1="create table ".$tb_pr."_user_details (
user_id int(4) primary key AUTO_INCREMENT,
user_name varchar(15) not null UNIQUE,
pwd varchar(50) not null,
date_of_join date not null,
user_type int(2) not null,
gender varchar(6) not null,
email_id varchar(50) not null,
profile_picture varchar(50) not null
);";
echo "<br>";
if (mysqli_query($conn,$sql1))
{
	$var1 += 1; 
}
else 
{
	echo"<br>";
	echo"Error in creating table".mysqli_error($conn);
}



/*--------------session_details--------------*/
$sql2="create table ".$tb_pr."_session_details (
session_id int(10) primary key AUTO_INCREMENT,
user_id int(4),
log_status varchar(20) not null,
ip_address varchar(15) not null,
FOREIGN KEY(user_id) REFERENCES ".$tb_pr."_user_details(user_id) ON DELETE SET NULL ON UPDATE CASCADE
);";

if(mysqli_query($conn,$sql2))
{
	//echo"<br>";
	//echo"session_details table create succsessfully";
	$var1 += 1;
}
else 
{
	echo"<br>";
	echo"Error in creating table".mysqli_error($conn);
}


/*--------------structural_details--------------*/
$sql3="create table ".$tb_pr."_structural_details (
structure_id int(2) primary key,
structure_name varchar(20)
);";

if(mysqli_query($conn,$sql3))
{
	//echo"<br>";
	//echo"session_details table create succsessfully";
	$var1 += 1;
}
else 
{
	echo"<br>";
	echo"Error in creating table".mysqli_error($conn);
}


/*--------------effect_details--------------*/
$sql4="create table ".$tb_pr."_effect_details (
effect_id int(2) primary key,
effect_name varchar(20)
);";

if(mysqli_query($conn,$sql4))
{
	//echo"<br>";
	//echo"effect_details table create succsessfully";
	$var1 += 1;
}
else 
{
	echo"<br>";
	echo"Error in creating table".mysqli_error($conn);
}


/*--------------template_details--------------*/
$sql5="create table ".$tb_pr."_template_details (
template_id int(2) primary key,
template_name varchar(20)
);";

if(mysqli_query($conn,$sql5))
{
	//echo"<br>";
	//echo"template_details table create succsessfully";
	$var1 += 1;
}
else 
{
	echo"<br>";
	echo"Error in creating table".mysqli_error($conn);
}


/*--------------presentation_details--------------*/
$sql6="create table ".$tb_pr."_presentation_details (
presentation_id int(6) primary key AUTO_INCREMENT,
user_id int(4),
name_of_presentation varchar(20) not null,
date_of_creation date not null,
FOREIGN KEY(user_id) REFERENCES ".$tb_pr."_user_details(user_id) ON DELETE SET NULL ON UPDATE CASCADE);";

if(mysqli_query($conn,$sql6))
{
	//echo"<br>";
	//echo"presentation_details table create succsessfully";
	$var1 += 1;
}
else 
{
	echo"<br>";
	echo"Error in creating table".mysqli_error($conn);
}


/*--------------file_details--------------*/
$sql7="create table ".$tb_pr."_file_details (
file_id int(10) primary key,
presentation_id int(6),
file_name varchar(10) not null,
type_of_file varchar(10) not null,
file_path varchar(100) not null,
file_size int(2) not null,
FOREIGN KEY(presentation_id) REFERENCES ".$tb_pr."_presentation_details(presentation_id) ON DELETE SET NULL ON UPDATE CASCADE
);";

if(mysqli_query($conn,$sql7))
{
	//echo"<br>";
	//echo"file_details table create succsessfully";
	$var1 += 1;
}
else 
{
	echo"<br>";
	echo"Error in creating table".mysqli_error($conn);
}


/*--------------slide_details--------------*/
$sql8="create table ".$tb_pr."_slide_details (
slide_id int(10) primary key AUTO_INCREMENT,
presentation_id int(6),
slide_name varchar(20) not null,
slide_content varchar(1000) not null,
FOREIGN KEY(presentation_id) REFERENCES ".$tb_pr."_presentation_details(presentation_id) ON DELETE SET NULL ON UPDATE CASCADE
);";

if(mysqli_query($conn,$sql8))
{
	//echo"<br>";
	//echo"slide_details table create succsessfully";
	$var1 += 1;
}
else 
{
	echo"<br>";
	echo"Error in creating table".mysqli_error($conn);
}
echo"<br>";
if ($var1 == 8)
	echo "ok";
else
	echo "Database creation fail....";

mysqli_close($conn);
header("Location: first_user.php");
exit;

?>
