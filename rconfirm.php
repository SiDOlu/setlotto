<?php
    $GLOBALS['z']=0;
    function printCombination($arr, $n, $r)
    {
        $data = Array();
        combinationUtil($arr, $n, $r, 0, $data, 0);
    }
    
    function combinationUtil($arr, $n, $r, $index, $data, $i)
    {
        if ($index == $r)
        {
            for ($j = 0; $j < $r; $j++)
                echo $data[$j], " ";
                echo "<br>";
            echo "\n";
            $GLOBALS['z'] = $GLOBALS['z'] +1;
            return;
        }
    
        if ($i >= $n)
            return;
    
        $data[$index] = $arr[$i];
        combinationUtil($arr, $n, $r, $index + 1, $data, $i + 1);
        combinationUtil($arr, $n, $r, $index, $data, $i + 1);
    }
		/** Start Constant Values **/
		include('include/connector.php');
		$frombonus;
		$sqidl = "SELECT * FROM `xxoxx`";
		$result = $conn->query($sqidl);
		$row = $result->fetch_assoc();
			
		$url = $row["devurl"];
		$username = $row["l_username"];
		$password = $row["l_password"];
		$terminalid = $row["l_terminalid"];
		$operaterID = $row["l_operaterId"]; 
		$phoneNumber = $row["l_phonenumber"];
		
		$newbonusbalance;
		$newbalance;
		$wagerid;


		$userid = $_POST["userid"]; // User ID
		$userloader = $_POST["userloader"]; // User
		
		
		
		//Get Wallet Balance		
		$sqlw = "SELECT * FROM wallets WHERE user_id = $userid";
		$resultw = $conn->query($sqlw);
		$roww = $resultw->fetch_assoc();
		
		
		//Get Bonus Balance
		$sqidlb = "SELECT * FROM b_wallets WHERE user_id = $userid";
		$resultb = $conn->query($sqidlb);
		$rowb = $resultb->fetch_assoc();
		
		$currencyid = $_POST["currencyid"]; // Currency ID
		$currencysymbol = $_POST["currencysymbol"]; // Currency Symbol
		$my_game = $_POST["my_game"]; //Game Type
		$betAmount = $_POST["total"]; // Stake Amount
		$playType = $_POST["play_type"]; //Play Type
		
		// Split Draw Name & Draw ID
		$GameNameAndID = explode(";", $_POST["drawIDs"]);
		// DrawIDs and Game (Draw) Name
		$drawIDs = array($GameNameAndID[0]); // Draw ID
		$GameName = $GameNameAndID[1]; // Game Name 
		
		$transactionId = $_POST["transactionId"]; // Transaction ID
		$mybalance = $roww["fiat"]; // Main Balance
		$bonus_balance = $rowb["fiat"]; //Bonus Balance
		$status = "NIL";
/** End Constant Values **/

	
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome  - SET 5/90</title>
    
    <link rel="stylesheet" href="https://setlottonig.com/v6/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://setlottonig.com/v6/assets/css/jquery-jvectormap-2.0.3.min.css"/>
    <link rel="stylesheet" href="https://setlottonig.com/v6/assets/css/morris.min.css" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="https://setlottonig.com/v6/assets/css/main.css">
    <link rel="stylesheet" href="https://setlottonig.com/v6/assets/css/color_skins.css">
    <link rel="stylesheet" href="https://setlottonig.com/v6/assets/css/bootstrap-select.min.css">
    <style type="text/css">
    .jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;
    background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);
    -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
    color: white;font: 10px arial, san serif;text-align: left;
    white-space: nowrap;padding: 5px;border: 1px solid white;
    box-sizing: content-box;z-index: 10000;}
    .jqsfield { color: white;font: 10px arial, san serif;text-align: left;}
    .bitcoin .body {position: absolute;word-break: break-all;}
    .remove{cursor: pointer;}
    .top_navbar{border-bottom: none }
    .navbar-nav>li>a .label-count{position: unset;}
    .menu_dark .sidebar {box-shadow: none !important;}
            </style>


    <style>
#footer, #footer2{
    padding: 60px 0;
    background-color: #fff;
}

#footer{
	padding-bottom: 0;
}

#footer2{
	padding-top: 0;
}

#footer .card{
}

#footer .section-title {
    text-align: center;
    color: #007b5e;
    margin-bottom: 50px;
    text-transform: uppercase;
}
#footer h5{
	padding-left: 10px;
    border-left: 3px solid #eeeeee;
    padding-bottom: 6px;
    margin-bottom: 20px;
    
}
#footer a {
    
    text-decoration: none !important;
    -webkit-text-decoration-skip: objects;
}
#footer ul.social li{
	padding: 3px 0;
}
#footer ul.social li a i {
    margin-right: 5px;
	font-size:25px;
	-webkit-transition: .5s all ease;
	-moz-transition: .5s all ease;
	transition: .5s all ease;
}
#footer ul.social li:hover a i {
	font-size:30px;
	margin-top:-10px;
}
#footer ul.social li a,
#footer ul.quick-links li a{
	color: #333;
}
#footer ul.social li a:hover{
	color:#eeeeee;
}
#footer ul.quick-links li{
	padding: 3px 0;
	-webkit-transition: .5s all ease;
	-moz-transition: .5s all ease;
	transition: .5s all ease;
}
#footer ul.quick-links li:hover{
	padding: 3px 0;
	margin-left:5px;
	font-weight:700;
}
#footer ul.quick-links li a i{
	margin-right: 5px;
}
#footer ul.quick-links li:hover a i {
    font-weight: 700;
}

@media (max-width:767px){
	#footer h5 {
    padding-left: 0;
    border-left: transparent;
    padding-bottom: 0px;
    margin-bottom: 10px;
}
}
</style>
    <script src="https://setlottonig.com/v6/js/vue.min.js"></script>
    
</head>
<body class="theme-cyan menu_dark" id="app">
<div class="page-loader-wrapper" id="mycover">
    <div class="loader">
        <!-- div class="m-t-30"><img class="zmdi-hc-spin" src="https://setlottonig.com/v6/assets/images/logo.svg" width="48" height="48" alt="sQuare"></div -->
        <div class="m-t-30"><img class="zmdi-hc-spin" src="https://setlottonig.com/v22/assets/img/logo/white_logo.png" width="48" height="48" alt="sQuare"></div>
        <p>Please wait...</p>        
    </div>
</div>
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<nav class="top_navbar">
    <div class="container">
        <div class="row clearfix">
            <div class="col-12">
                            </div>
        </div>
        <div class="row clearfix">
            <div class="col-12">
        </div>
        </div>        
    </div>
</nav> --}}

<!-- Right Sidebar -->
<section class="content">
    <div class="container">
        <div class="row cleatfix">
        </div>
        
    <div class="row">
        <div class="col-md-3">
    <div class="card ">
        <!-- overflowhidden -->
        <div class="header">
            <h2><strong>Nigerian Naira</strong> Main Balance</h2>
        </div>
        <div class="body">
            <small></small> 
           
            <h2 style="margin-bottom: 0;">₦<?php echo number_format($mybalance, 2,'.',','); ?></h2>
            <!--  -->
        </div>
        
    </div>
 
             
    <div class="list-group">
        
    </div>
    </div>
    <div class="col-md-9 ">
<style>

.open-button {
}

/* The popup form - hidden by default */
.form-popup {
overflow: auto;
  position: fixed;
  bottom: 1px;
  right: 1px;
  top: 1px;
  left: 1px;
  border: 3px solid #f1f1f1;
  z-index: 9;
  background: #d30a0a69;
  padding: 5% 20%;
}
.form-popup h3
{
	text-align: center;
}
.form-container
{
  background: #fff;
  padding: 5%;
}
.stake
{
	padding: 1px 20%;
}

@media  only screen and (max-width: 768px)
{
.form-container
{
  padding: 25% 5%;
}
.form-popup {
  padding: 5%;
}
.stake
{
	padding: 1px 2px;
}
}


}


/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

}
</style>
    <div class="form-popup" id="myForm">
    <form  action="playtest1.php" method="POST" id="voucher_form" class="form-container">
    <h3>Confirm Stake</h3>
    <div class="col-xs-12 col-lg-12 stake" style="text-align:center;">
    <div class="form-group">
    	<label for="stake" style="font-weight:bold"><b>Stake Amount: </b><strong>₦ <?php echo $betAmount; ?></strong></label>
    </div>
    <div class="form-group">
    	<label for="playtype" style="font-weight:bold"><b>Game: </b><strong><?php echo $GameName."  - ".$playType." ".$my_game; ?></strong></label>
    </div>
    <div class="form-group">
    	<label for="noofline" style="font-weight:bold"><b>Number of Line(s): </b>
    	<strong>
    	<?php
		if($my_game  == "Direct")
    		{
    			$betAmount = $_POST["total"];?> <input type="hidden" name="betAmount" value="<?php echo $betAmount;?>"><?php
    			$permBetAmount = $betAmount;?> <input type="hidden" name="permBetAmount" value="<?php echo $permBetAmount;?>">
    			
	    		<input type="hidden" name="myarraybetNumbers" value="<?php echo $_POST['directvalues'];?>">
	    		
	    		<?php
	    		$quickPick = "false";?> <input type="hidden" name="quickPick" value="<?php echo $quickPick;?>"><?php
    			$newbalance = $bonus_balance - $permBetAmount;
    			$frombonus = 1;
    			if($newbalance<0)
    			{
    				$newbalance = $mybalance - $permBetAmount;
    				$frombonus = 0;
    			}?>
    			<input type="hidden" name="newbalance" value="<?php echo $newbalance;?>">
    			<input type="hidden" name="frombonus" value="<?php echo $frombonus;?>"> <?php

    			echo 1;?> <input type="hidden" name="number_of_lines" value="1">
    			<div class="form-group">
    				<label for="playtype"><b>Bet Numbers: </b><strong><?php echo $_POST['directvalues'];?></strong></label>
    			</div>
    		<?php
    		}
    		else if($my_game  == "Against")
    		{
    			$betAmount = $_POST["total"];?> <input type="hidden" name="betAmount" value="<?php echo $betAmount;?>"><?php
    			echo $number_of_lines = intval($_POST["number_of_lines"]);?> <input type="hidden" name="number_of_lines" value="<?php echo $number_of_lines;?>"><?php
    			$permBetAmount = $betAmount * $number_of_lines;?> <input type="hidden" name="permBetAmount" value="<?php echo $permBetAmount;?>">    			
    			
	    		<input type="hidden" name="directvalues" value="<?php echo $_POST['directvalues'];?>">
	    		
	    		<?php    			
    			$quickPick = "false"; // Quick Pick
    			$fixednumbers = $number_of_lines . " Lines";
    			$newbalance = $bonus_balance - $permBetAmount;
    			$frombonus = 1;
    			if($newbalance<0)
    			{
    				$newbalance = $mybalance - $permBetAmount;
    				$frombonus = 0;
    			}?>
    			<input type="hidden" name="newbalance" value="<?php echo $newbalance;?>">
    			<input type="hidden" name="frombonus" value="<?php echo $frombonus;?>"> <?php

    			// $_POST["number_of_lines"];?>
    			
    			<div class="form-group">
    				<label for="playtype"><b>Bet Numbers: </b><strong><?php echo $_POST['directvalues'];?></strong></label>
    			</div>
    		<?php }
    		else if($my_game == "Permutation")
    		{
    			
    			$betAmount = $_POST["total"];?> <input type="hidden" name="betAmount" value="<?php echo $betAmount;?>"><?php
        		$lotto_number_count = $_POST["lotto_number_count"];?> <input type="hidden" name="lotto_number_count" value="<?php echo $lotto_number_count;?>"><?php
        		$myarraybetNumbers = $_POST['directvalues'];?><input type="hidden" name="directvalues" value="<?php echo $_POST['directvalues'];?>">
        		<?php
        		//$betNumbers = implode(',',$myarraybetNumbers);
        		$betNumbers = implode(',', (array)$myarraybetNumbers);
        		?> 
        		<input type="hidden" name="betNumbers" value="<?php echo $betNumbers;?>">
        		<?php
	        	// Driver Code
        		$arr = explode(',',$_POST['directvalues']);?> <input type="hidden" name="permnumbers" value="<?php echo $permnumbers;?>"><?php
        		$r = $playType;
	        	$n = sizeof($arr);?>
    			<div style="display:none">
    			<?php
    			printCombination($arr, $n, $r);
    			?>
    			</div>
    			<?php
        		$permBetAmount = $betAmount * $z;?> <input type="hidden" name="permBetAmount" value="<?php echo $permBetAmount;?>"><?php
        		$quickPick = "false"; // Quick Pick
    			$newbalance = $bonus_balance - $permBetAmount;
    			$frombonus = 1;
    			if($newbalance<0)
    			{
    				$newbalance = $mybalance - $permBetAmount;
    				$frombonus = 0;
    			}?>
    			<input type="hidden" name="newbalance" value="<?php echo $newbalance;?>">
    			<input type="hidden" name="frombonus" value="<?php echo $frombonus;?>"> <?php

    			echo $z."<br><br>";
    			?>
    			
    			
    			
    			
    			<div class="form-group">
    				<label for="playtype"><br><b>Bet Numbers: </b><strong><?php echo $_POST['directvalues'];?></strong></label>
    			</div>
    		<?php }
    		else if($my_game == "Combination")
    		{
    			$betAmount = $_POST["total"];?> <input type="hidden" name="betAmount" value="<?php echo $betAmount;?>"><?php
    			$lotto_number_count = $_POST["lotto_number_count"];?> <input type="hidden" name="lotto_number_count" value="<?php echo $lotto_number_count;?>"><?php
    			
    			//Fixed Numbers
    			$myarrayFixedNumbers = $_POST['gameFixedinput'];?><input type="hidden" name="FixedNumbers" value="<?php echo $_POST['gameFixedinput'];?>"><?php
    			
    			//Variable Numbers
    			$myarrayVariableNumbers = $_POST['variable'];?> <input type="hidden" name="VariableNumbers" value="<?php echo $_POST['variable'];?>"><?php
    			
    			$arr = explode(',',$_POST['variable']);
    			$r = sizeof(explode(',',$_POST['gameFixedinput']));
    			$n = sizeof($arr);?>
    			<!-- div style="none;">
    			<?php
    			printCombination($arr, $n, $r);
    			?>
    			</div -->
    			<?php
    			echo $n;
    			$permBetAmount = $betAmount * $n;?> <input type="hidden" name="permBetAmount" value="<?php echo $permBetAmount;?>"><?php
    			$quickPick = "false";
    			$newbalance = $bonus_balance - $permBetAmount;
    			$frombonus = 1;
    			if($newbalance<0)
    			{
    				$newbalance = $mybalance - $permBetAmount;
    				$frombonus = 0;
    			}?>
    			
    			
    			<div class="form-group">
    				<label for="playtype"><b>Fixed Numbers: </b><strong><?php echo $_POST['gameFixedinput'];?></strong></label>
    			</div>
    			
    			<div class="form-group">
    				<label for="playtype"><b>Variable Numbers: </b><strong><?php echo $_POST['variable'];?></strong></label>
    			</div>
    			<input type="hidden" name="newbalance" value="<?php echo $newbalance;?>">
    			<input type="hidden" name="frombonus" value="<?php echo $frombonus;?>"> <?php
    		}
    	?>
    	</strong>
    	</label>
    </div>
    <div class="form-group" style="font-weight: 700;">
    	<label for="totalbet"><b>Total Bet Amount: </b><strong>₦ <?php echo $permBetAmount; ?></strong></label>
    </div>
    <?php
    	if($newbalance<0)
    	{ ?>
    		<label  class="btn-danger">Sorry, You cannot Stake this high</label>
    		<a href="https://setlottonig.com/v6/deposit" class="btn btn-primary btn-round">Add Funds</a>
    		<a href="https://setlottonig.com/v6/play_games" class="btn btn-block btn-danger">Cancel</a>
    	<?php }
    	
    	else
    	{?>
    		<div id="confirmbtn" onclick="confirmbtn()"><button type="submit" class="btn btn-block btn-primary">Confirm</button></div>
    		<a href="https://setlottonig.com/v6/play_games" class="btn btn-block btn-danger">Cancel</a>
    	<?php }?>
    
</div>

    <input type="hidden" name="userid" value="<?php echo $userid;?>">
    <input type="hidden" name="userloader" value="<?php echo $userloader;?>">
    <input type="hidden" name="currencyid" value="<?php echo $currencyid;?>">
    <input type="hidden" name="currencysymbol" value="<?php echo $currencysymbol;?>">
    <input type="hidden" name="my_game" value="<?php echo $my_game;?>">
    <input type="hidden" name="GameName" value="<?php echo $GameName;?>">
    <input type="hidden" name="playType" value="<?php echo $playType;?>">
    <input type="hidden" name="drawIDs" value="<?php echo implode(',',$drawIDs);?>">
    <input type="hidden" name="transactionId" value="<?php echo $transactionId;?>">
    <input type="hidden" name="mybalance" value="<?php echo $newbalance;?>">
    
  </form>
</div>

<script>

function closeForm()
{
	header("Location: https://setlottonig.com/v6/play_games");
}

function confirmbtn() {
  document.getElementById("mycover").style.display = "block";
}
</script>


        </div>
    </div>

    
        <!--         <!-- div class="row clearfix">
                   </div>
         -->
    </div>
      <!-- Scripts >
      <section id="footer" class="hidden">
		<div class="container">
			<div class="row text-center text-xs-center text-sm-left text-md-left">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="card l-blue">
                    <div class="body block-header">
                    	<h5>Help and Support</h5>
                    	<ul class="list-unstyled quick-links">
						<li><a href="https://setlottonig.com/v6/page/4"><i class="fa fa-angle-double-right"></i>About</a></li>
						<li><a href="https://setlottonig.com/v6/page/5""><i class="fa fa-angle-double-right"></i>FAQ</a></li>
						<li><a href="https://setlottonig.com/v6/page/3"><i class="fa fa-angle-double-right"></i>Terms of Use</a></li>
						<li><a href="https://setlottonig.com/v6/page/2"><i class="fa fa-angle-double-right"></i>Privacy Policy</a></li>
					</ul>
                    </div>
                	</div>
					
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="card overflowhidden l-seagreen">
		        		<div class="body">
			            	
			            	<div class="clearfix"></div>
			        	</div>
		    		</div>
					
				</div>
				
		</div>
</section>
<section id="footer2">
	<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center ">
					
				</div>
			</div>	
		</div>
</section> -->
</section>
    <!-- Jquery Core Js --> 
    <script src="https://setlottonig.com/v6/assets/js/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) --> 
    <script src="https://setlottonig.com/v6/assets/js/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->
    <script src="https://setlottonig.com/v6/assets/js/morrisscripts.bundle.js"></script><!-- Morris Plugin Js -->
    <script src="https://setlottonig.com/v6/assets/js/jvectormap.bundle.js"></script> <!-- JVectorMap Plugin Js -->
    <script src="https://setlottonig.com/v6/assets/js/knob.bundle.js"></script> <!-- Jquery Knob-->
    <script src="https://setlottonig.com/v6/assets/js/mainscripts.bundle.js"></script>
    <script src="https://setlottonig.com/v6/assets/js/infobox-1.js"></script>
    <script src="https://setlottonig.com/v6/assets/js/index.js"></script>
    

	
</body>
</html>
