<?php
	$servername="pearl.ils.unc.edu";
	$username="lmx";
	$password="mvH2w3Bx8u";
	$dbname="lmx_db";
	
	$conn=new mysqli($servername,$username,$password,$dbname);
	
	if ($conn->connect_error){
    	die("Connection failed: ".$conn->connect_error);
	}
	
	$a=$_POST['textarea'];
	
	$query="Insert into spam_judge (text) VALUES ('$a')";
	$result= mysqli_query($conn,$query);
	
	$query1= "CALL WekaCreateFeatures(@a,@b,@c,@d)";
	$querya= "select @a as a";
	$queryb= "select @b as b";
	$queryc= "select @c as c";
	$queryd= "select @d as d";
	$querye= "select @e as e";
	
	$result1 = mysqli_query($conn,$query1);
	
	$resulta = mysqli_query($conn,$querya);
	$rowa = mysqli_fetch_assoc($resulta);
	$A=$rowa['a'];
	
	$resultb = mysqli_query($conn,$queryb);
	$rowb = mysqli_fetch_assoc($resultb);
	$B=$rowb['b'];
	
	$resultc = mysqli_query($conn,$queryc);
	$rowc = mysqli_fetch_assoc($resultc);
	$C=$rowc['c'];
	
	$resultd = mysqli_query($conn,$queryd);
	$rowd = mysqli_fetch_assoc($resultd);
	$D=$rowd['d'];
	
	$query2= "CALL SpamDecisionTree($A,$B,$C,$D,@e)";
	
	$result2 = mysqli_query($conn,$query2);
	
	if($resulte = mysqli_query($conn,$querye)) {
	while ($rowe = mysqli_fetch_assoc($resulte)) 
		{
			if($rowe['e']==1){
				echo "spam email";}
			if($rowe['e']==0){
				echo "no spam";}
		}
	} 
	
	mysqli_close($conn);
?>