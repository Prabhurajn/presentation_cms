<html>
<head>
	<style>
	div.ex1 {
		width:60%;
		border:5px solid gray;
		height: 11%;
		margin-top:2%;
		margin-left:2%;		
		overflow-x:auto;
		overflow-y:auto;
	}
	div.ex2 {
		width:60%;
		border:5px solid gray;
		height: 50%;
		margin-left:2%;
		margin-top:2%;	
		overflow-y:auto;
		overflow-x:auto;
		
	}
	div.ex3 {
		width:60%;
		border:5px solid gray;
		height: 13%;
		margin-left:2%;
		margin-top:2%;	
		overflow-y:auto;
		
		
	}
	div.ex4 {
		height:90%;
		width:18%;
		border:0px solid gray;
		float:left;
	}
	div.ex5 {
		height:90%;
		width:15%;
		margin-top:-40%;
		border:5px solid gray;
		float:right;
	}
	</style>
	
	<?php
		session_start();
		if( $_SESSION['user'] == "")
		{
			header("Location: login.php");
			exit;
		}
		else {
			include('./inc/settings.php');
		
			$conn=mysqli_connect($hname,$uname,$pwd,$dbname);
			if(! $conn )
				die("not connected to mysqli".mysqli_errno());
		}
	?>
	<?php include("inc/site.inc.php"); ?>
	
	<title> <?php echo $site_name; ?> </title>
	<?php
	$pr_name = $_SESSION['presentation']; 
		$conn=mysqli_connect($hname,$uname,$pwd,$dbname);
			if(! $conn )
				die('not connected to mysqli'.mysqli_errno());
			$sql= "SELECT presentation_id from ".$tb_pr."_presentation_details where name_of_presentation= '".$pr_name."';";

		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result);
		 $pr_id1 = $row['presentation_id'];
		$sql1= "SELECT * From ".$tb_pr."_slide_details where presentation_id = ".$pr_id1.";";
		$result1 = mysqli_query($conn,$sql1);
				$row1 = mysqli_fetch_object($result1);
				$_SESSION['cnt'];
				$_SESSION['row']=$row1;
				$_SESSION['results']=$result1;
				$_SESSION['sqlquery']=$sql1;
	?>
</head>
<body bgcolor="white">
	<?php
	echo "<div class='ex4'>\n
	</div>\n
	<div class='ex1' id='name'>\n
	</div>\n
	<div class='ex2'>\n";
		if(array_key_exists("next", $_REQUEST)) {

				$_SESSION['results'] = mysqli_query($conn,$_SESSION['sqlquery']);
				
				mysqli_data_seek($_SESSION['results'],$_SESSION['cnt']);
				$_SESSION['row'] = mysqli_fetch_object($_SESSION['results']);
				$result1=$_SESSION['results'];
				$sql1=$_SESSION['sqlquery'];
				$row1=$_SESSION['row'];
				$name=$_SESSION['row']->slide_name;
				echo "<script>
				document.getElementById('name').innerHTML='<h2 align=center>$name</h2>';
				</script>";
				
				echo "<h3>".$_SESSION['row']->slide_content."</h3>";
				$_SESSION['cnt']=$_SESSION['cnt']+1;
				$rowcount=mysqli_num_rows($result1);
				if( $_SESSION['cnt']-1 >= $rowcount )
					$_SESSION['cnt']=1;
				
		}
		if(array_key_exists("prev", $_REQUEST)) {
				if( $_SESSION['cnt'] > 1 )
				{
				 $_SESSION['cnt']=$_SESSION['cnt']-1;
				
			
				$_SESSION['results'] = mysqli_query($conn,$_SESSION['sqlquery']);
				
				mysqli_data_seek($_SESSION['results'],$_SESSION['cnt']);
				$_SESSION['row'] = mysqli_fetch_object($_SESSION['results']);
				$result1=$_SESSION['results'];
				$sql1=$_SESSION['sqlquery'];
				$row1=$_SESSION['row'];
				$name=$_SESSION['row']->slide_name;
				echo "<script>
				document.getElementById('name').innerHTML='<h2 align=center>$name</h2>';
				</script>";
				
				echo "<h3>".$_SESSION['row']->slide_content."</h3>";
				
				$rowcount=mysqli_num_rows($result1);
				}
				else {
					mysqli_data_seek($_SESSION['results'],0);
					$_SESSION['row'] = mysqli_fetch_object($_SESSION['results']);
				$result1=$_SESSION['results'];
				$sql1=$_SESSION['sqlquery'];
				$row1=$_SESSION['row'];
				$name=$_SESSION['row']->slide_name;
				echo "<script>
				document.getElementById('name').innerHTML='<h2 align=center>$name</h2>';
				</script>";
				echo "<h3>".$_SESSION['row']->slide_content."</h3>";
				
				}
				
		}		
				
	echo "</div>\n
	<div class='ex3'>\n
		<center><a href='viewpresentframe.php?prev'><img src='./img/playprev.png' alt='previous' height='40' width='30' ></img></a>	
		<a href='viewpresentframe.php?next'><img src='./img/playnext.png' alt='next' height='40' width='30' ></img></a></center>
		
		<h6 style=float:left>Slide Number: $_SESSION[cnt]</h6>
	</div>\n";
	?>
</body>
</html>
