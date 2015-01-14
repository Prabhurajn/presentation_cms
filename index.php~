<!doctype html>
<html>
<head>
	
	
	<link href="css/style.css" type="text/css" rel="stylesheet" />
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
	<link href="./css/style.css" type="text/css" rel="stylesheet" />
	<link href="./css/button.css" type="text/css" rel="stylesheet" />

	<style>
			.tb5 {
				border:2px solid #456879;
				border-radius:10px;
				height: 40px;
				width: 230px;
			}
			#table1 {
			    height: 100%;	
			    width: 100%;
			    display: table;
			    padding-top:90px;
			  }
			  #table2 {
			    vertical-align: middle;
			    display: table-cell;
			    height: 100%;
			    
			  }
			  #myTable {
			    margin: 0 auto;
			  }
  </style>
</head>
<body>
	<div class="content">
		<div class="top_block header">
			<div class="content">
			<a href='index.php' style="text-decoration:none"><img src="./img/logo.png" width="60" height="80" align="left"><h2> <?php echo $site_name; ?></a></h2></img>
				<font style="float:right"><?php  echo "Hello <b>". $_SESSION['user']."</b> ";
				 echo "<a href=index.php?logout>Logout</a>"."&nbsp;";
				 	if( array_key_exists("logout",$_REQUEST) ) {
				 		session_destroy();
				 		header("Location: ./login.php");
				 		exit;
				 	}
				 ?></font>
			</div>
		</div>
		<div class="background left">
		</div>
		<div class="left_block left">
			<div class="content">
				<a href='index.php'><img src='./img/home.png' width='50' height='50'></img></a>
					<?php
					echo "<div id='table1'> \n
					<div id='table2'>\n
					<table id='myTable' border='0'>\n";
					$conn=mysqli_connect($hname,$uname,$pwd,$dbname);
					$usrid1 = "";
						if(! $conn )
							die("not connected to mysqli".mysqli_errno());
					$usr=$_SESSION['user'];
					$sql1="select  user_id from ".$tb_pr."_user_details where user_name= '".$usr."';";
					$result = mysqli_query($conn,$sql1);
					$row = mysqli_fetch_array($result);
					 $usrid1 = $row['user_id'];
					$sql2= "SELECT * from ".$tb_pr."_presentation_details where user_id= ".$usrid1.";";
					$result1 = mysqli_query($conn,$sql2);
					while($row1 = mysqli_fetch_array($result1))
					{	 
						echo "<tr><td><a href='presentation.php?view=$row1[name_of_presentation]'>".$row1['name_of_presentation']."</a></tr></td>\n";
					}
					echo "</table></div></div>"
					?>
			</div>
		</div>
		<div class="background right">
		</div>
		<div class="right_block right">
			<div class="content">
				<?php
					echo "<div id='table1'> \n
					<div id='table2'>\n
					<table id='myTable' border='0'>\n
						<tr>\n
							<td><a href='index.php?create'>Create Presentation</a></td>\n
						</tr>\n
					</table>\n</div>\n</div>";
					
					
					
				?>
			</div>
		</div>
		<div class="background main content">
		
		</div>
		<div class="center_block main content">
			<div class="content" >
			<?php
				
				if( array_key_exists("create",$_REQUEST) ) {
						echo "<form id='frm2' action='index.php?createadd' method='post'>\n
						<div id='table1'> \n
							<div id='table2'>\n
							<table id='myTable' border='0'>\n
								<tr>\n
									<td>Presentation Name</td>\n
									<td> <input type = 'text' name = 'txttitle' class='tb5'></td>\n
								</tr>\n
								<tr>\n
									
									<td colspan='2' align='center'> <input type = 'submit' class='mybutton' value='Create'></td>\n
								</tr>\n
							</table>\n</div>\n</div></form>";
					}
				if( array_key_exists("createadd",$_REQUEST) ) {
					$date1 = date("Y/m/d");
					$user=$_SESSION['user'];
					$title = $_REQUEST['txttitle'];
					$_SESSION['presentation'] = $title;
					$sql1 = "SELECT * from ".$tb_pr."_user_details WHERE user_name ='$user';";
					$result = mysqli_query($conn,$sql1);
					$row = mysqli_fetch_array($result);
					$usr_id = $row['user_id'];
					$sql= "INSERT INTO ".$tb_pr."_presentation_details VALUES(null,$usr_id,'$title','$date1');";

					echo "<br/>";

					if (!mysqli_query($conn,$sql))
						die( "Error: ".mysqli_error($conn) );
					else{
  						header("Location: presentation.php");
  						exit; }


				}
			?>
			</div>
		</div>
		<div class="bottom_block footer">
			<div class="content">
			</div>
		</div>
	</div>

</body>
</html>
