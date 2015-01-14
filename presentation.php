<!doctype html>
<html>
<head>
	
	
	<link href="css/style.css" type="text/css" rel="stylesheet" />
	<script src="./ckeditor/ckeditor.js"></script>
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
						if( array_key_exists("view",$_REQUEST))	{
						 $pr_name=$_REQUEST['view'];
						 $_SESSION['presentation'] = $pr_name;
						  }
						 else{
						$pr_name =  $_SESSION['presentation'];
						}
						$pr_name;
						$conn=mysqli_connect($hname,$uname,$pwd,$dbname);
						if(! $conn )
							die("not connected to mysqli".mysqli_errno());
						

						$sql= "SELECT presentation_id from ".$tb_pr."_presentation_details where name_of_presentation= '".$pr_name."';";

						$result = mysqli_query($conn,$sql);
						$row = mysqli_fetch_array($result);
						 $pr_id1 = $row['presentation_id'];

						$sql1= "SELECT slide_name,slide_id from ".$tb_pr."_slide_details where presentation_id = ".$pr_id1.";";
						$result1 = mysqli_query($conn,$sql1);
						
						while($row1 = mysqli_fetch_array($result1))
						{
							$slidename = $row1['slide_name'];
							$slide=rawurlencode($slidename);
							echo "<tr><td><a href=presentation.php?updateslide=$slide&slideid=$row1[slide_id]>".$row1['slide_name']."</a></td></tr>";
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
							<td><a href='presentation.php?createslide'>Create Slide</a></td>\n
						</tr>\n
						<tr>\n
							<td><a href='viewpresent.php?present=$_SESSION[presentation]' target='_blank'>View Full Presentation</a></td>\n
							
						</tr>\n
					</table>\n</div>\n</div>";
					$_SESSION['cnt']=0;
				?>
			</div>
		</div>
		<div class="background main content">
		</div>
		<div class="center_block main content" style="overflow-y: scroll;top:-20px">
			<div class="content">
			<?php
				
				if( array_key_exists("createslide",$_REQUEST) ) {
					
					echo "<form id='frm4' action='presentation.php?saveslide' method='post'><div id='table1'> \n
					<div id='table2'>\n
					<table id='myTable' border='0'>\n";
					echo "<tr><td align='center'><input type='text' name='txttitle' style='width:530px' class='tb5' placeholder='Enter Ttile'/></td></tr>";
					echo "<tr><td align='center'><textarea name='editor1' id='editor1' rows='10' cols='80'></textarea></td></tr>
					
					 <script>
               					 // Replace the <textarea id='editor1'> with a CKEditor
				                // instance, using default configuration.
				                CKEDITOR.replace( 'editor1' );
				            </script>";
				           
				       echo "<tr><td align='center'><button class='mybutton'>Submit</button></td></tr>";
				       echo "</table>\n</div>\n</div></form>";
				}
				if( array_key_exists("saveslide", $_REQUEST)) {
					  $sql1 = "SELECT * from ".$tb_pr."_presentation_details WHERE name_of_presentation = '".$_SESSION['presentation']."';";
					 $result = mysqli_query($conn,$sql1);
					 $row = mysqli_fetch_array($result);
					 $pr_id = $row['presentation_id'];
					 $sql= "INSERT INTO ".$tb_pr."_slide_details VALUES(null,$pr_id,'$_REQUEST[txttitle]','$_REQUEST[editor1]');";
					if (!mysqli_query($conn,$sql))
  						echo "Error: ".mysqli_error($conn);
  					else {
  						echo "1 slide added";
  						header("Location: presentation.php?createslide");
  					}
				}
				if( array_key_exists("updateslide",$_REQUEST) ) {
					 $slidename = $_REQUEST['updateslide'];
					 $slideid = $_REQUEST['slideid'];
					 $conn=mysqli_connect($hname,$uname,$pwd,$dbname);
					 if(! $conn )
						die("not connected to mysqli".mysqli_errno());

					  $sql= "SELECT slide_content from ".$tb_pr."_slide_details where slide_id= ".$slideid.";";

					  $result = mysqli_query($conn,$sql);
					  $row = mysqli_fetch_array($result);
					 $s_content = $row['slide_content'];
					
					echo "<form id='frm5' action='presentation.php?updatecontent=$slideid&slidename=$slidename' method='post'><div id='table1'> \n
					<div id='table2'>\n
					<table id='myTable' border='0'>\n";
					echo "<tr><td align='center'><input type='text' name='txttitle' style='width:530px' value='$slidename' class='tb5' placeholder='Enter Ttile'/></td></tr>";
					echo "<tr><td align='center'><textarea name='editor1' id='editor1' rows='10' cols='80'>$s_content</textarea></td></tr>
					
					 <script>
               					 // Replace the <textarea id='editor1'> with a CKEditor
				                // instance, using default configuration.
				                CKEDITOR.replace( 'editor1' );
				            </script>";
				           
				       echo "<tr><td colspan='2' align='center'><button name='updat' class='mybutton'>Update</button>";
				        echo "<button name='del' class='mybutton'>Delete</button></td></tr>";
				       echo "</table>\n</div>\n</div></form>";
					
				}
				
				if( array_key_exists("updatecontent",$_REQUEST) ) {
					 $slidename=$_POST['txttitle'];
						 if (isset($_POST['updat'])) {
						        # Submit-button was clicked
						        //echo $slidename;
					 		$s_content=$_POST['editor1'];
					 		$conn=mysqli_connect($hname,$uname,$pwd,$dbname);
					 		if(! $conn )
								die("not connected to mysqli".mysqli_errno());
							 $sql= "UPDATE ".$tb_pr."_slide_details SET slide_content = '".$s_content."', slide_name ='".$slidename."' WHERE slide_id = ".$_REQUEST['updatecontent'].";";
							
							if (mysqli_query($conn,$sql))
								// $slidename;
								header("Location: presentation.php?updateslide=$slidename&slideid=$_REQUEST[updatecontent]");
							else
								echo "Slide is not Updated,try again";
    						}
					    elseif (isset($_POST['del'])) {
						        # Delete-button was clicked
						        $conn=mysqli_connect($hname,$uname,$pwd,$dbname);
					 		if(! $conn )
								die("not connected to mysqli".mysqli_errno());
							echo $sql1= "DELETE from ".$tb_pr."_slide_details WHERE slide_id =".$_REQUEST['updatecontent'].";";
							if (mysqli_query($conn,$sql1))
								header("Location: presentation.php");
							else
								echo "Slide is not delete,try again";
					    }
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
