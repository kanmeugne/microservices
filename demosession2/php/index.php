<?php
$db_hostname = $_ENV['MYSQL_HOST'];
$db_username = $_ENV['MYSQL_USER'];
$db_password = $_ENV['MYSQL_PASSWORD'];
$db_database = $_ENV['MYSQL_DATABASE'];

// Database Connection String
$con = mysqli_connect($db_hostname,$db_username,$db_password);
if (!$con)
{
  die('Could not connect: ' . mysql_error());
}

mysqli_select_db($con, $db_database);
?>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body style="font-size:100%;font-family:cambria;">
<div class="container">
<h1 style="font-family:courier;font-size:300%;"> Welcome to my survey </h1>

<p> The purpose of this survey is to improve financial transactions.</p>

 <?php
// define variables and set to empty values
$firstnameErr = $lastnameErr = $emailErr = $genderErr = $birthyearErr = $birthplaceErr = $nationalityErr = "";
$firstname= $lastname = $email = $gender = $birthyear = $birthplace = $nationality = "";
$transport = $food = $clothes = $shoes = $houserent = $healthcare = "";
$transportErr = $foodErr = $clothesErr = $shoesErr = $houserentErr = $healthcareErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Id information ---------------------------
	if (empty($_POST["firstname"]))
	{
		$firstnameErr = "*";
	}
	else
	{
		$firstname = $_POST["firstname"];
	}
	if (empty($_POST["lastname"]))
	{
		$lastnameErr = "*";
	}
	else
	{
		$lastname = $_POST["lastname"];
	}
	if (empty($_POST["email"]))
	{
		$emailErr = "*";
	}
	else
	{
		$email = $_POST["email"];
	}
	if (empty($_POST["gender"]))
	{
		$genderErr = "*";
	}
	else
	{
		$gender = $_POST["gender"];
	}
	if (empty($_POST["birthyear"]))
	{
		$birthyearErr = "*";
	}
	else
	{
		$birthyear = $_POST["birthyear"];
	}
	if (empty($_POST["birthplace"]))
	{
		$birthplaceErr = "*";
	}
	else
	{
		$birthplace = $_POST["birthplace"];
	}
	if (empty($_POST["nationality"]))
	{
		$nationalityErr = "*";
	}
	else
	{
		$nationality = $_POST["nationality"];
	}
	if (empty($_POST["transport"]))
	{
		$transportErr = "*";
	}
	else
	{
		$transport = $_POST["transport"];
	}
	if (empty($_POST["food"]))
	{
		$foodErr = "*";
	}
	else
	{
		$food = $_POST["food"];
	}
	if (empty($_POST["clothes"]))
	{
		$clothesErr = "*";
	}
	else
	{
		$clothes = $_POST["clothes"];
	}
	if (empty($_POST["shoes"]))
	{
		$shoesErr = "*";
	}
	else
	{
		$shoes = $_POST["shoes"];
	}
	if (empty($_POST["houserent"]))
	{
		$houserentErr = "*";
	}
	else
	{
		$houserent = $_POST["houserent"];
	}
	if (empty($_POST["healthcare"]))
	{
		$healthcareErr = "*";
	}
	else 
	{
		$healthcare = $_POST["healthcare"];
	}
}
	
if (!empty($firstname) &&
	!empty($lastname) &&
	!empty($gender) &&
	!empty($birthplace) &&
	!empty($birthyear) &&
	!empty($nationality) &&
	!empty($transport) &&
	!empty($food) &&
	!empty($clothes) &&
	!empty($shoes) &&
	!empty($houserent) &&
	!empty($healthcare) &&
	!empty($email)) 
{
	$sql1 = "INSERT INTO profils (email, first_name, last_name, gender, nationality, birth_year, birth_place)
			 VALUES ('".$email."', '".$firstname."', '".$lastname."', '".$gender."', '".$nationality."', ".$birthyear.", '".$birthplace."') ";
	$sql2 = "INSERT INTO answers (email, transport, food, clothes, shoes, houserent, healthcare)
			 VALUES ('".$email."', '".$transport."', '".$food."', '".$clothes."', '".$shoes."', '".$houserent."', '".$healthcare."') ";
	$r_query1 = mysqli_query($con, $sql1);
	$r_query2 = mysqli_query($con, $sql2);
	
	if ($r_query1 and $r_query2)
	{
		echo "<span style=\"color:green;\"> <b>The answer has been registered! </b></span>";
	}
	else
	{
		if (mysqli_errno($con)==1062)
		{
			echo "<span style=\"color:red;\"> <b>This email (".$email.") has already been used. Please Restart with another one !</b></span>";
		}
		else
		{					
			//$sql1 = "DELETE FROM profils WHERE email='".$email."'); ";
			//$sql2 = "DELETE FROM answers WHERE email='".$email."'); ";
			$r_query1 = mysqli_query($con, $sql1);
			$r_query2 = mysqli_query($con, $sql2);
			echo "<span style=\"color:red;\"> <b>Something went wrong. Please restart!</b></span>";
			echo "<span style=\"color:red;\"> <b>MYSQLI ERROR( CODE: ".mysqli_error($con).") </b></span>";
		

		}
	}
}
else
{
	echo "<span style=\"color:red;\"> <b>Please fill the required fields (with *) and press the submit button!</b></span>";
}
?>
	<div class="row">
 <form method="post" action="./index.php" class="col s12">
	<div class="row">
		<div class="input-field col s6">
		  <input type="text" class="validate" id="firstname" name="firstname"><span class="error" style="color:red;"><?php echo $firstnameErr;?></span>
			<label for="firstname">First Name</label>
		</div>
		<div class="input-field col s6">
		  <input type="text" class="validate" id="lastname" name="lastname"><span class="error" style="color:red;"><?php echo $lastnameErr;?></span>
			<label for="lastname">Last Name</label>
		</div>
	</div>
	<div class="col s12">
		<label>
		  <input type="radio" name="gender" value="female"><span>Female</span>
		</label>
		<label>
		  <input type="radio" name="gender" value="male"><span>Male</span>
			</label>
			<label>
		  <input type="radio" name="gender" value="other"><span>Other</span>
			</label>
		  <span class="error" style="color:red;"><?php echo $genderErr;?></span>
	</div>
	<div class="input-field col s6">
		  <input type="text" class="datepicker" id="birthplace" name="birthplace" placeholder="Birthday"><span class="error" style="color:red;"><?php echo $birthplaceErr;?></span>
	</div>
	<div class="input-field col s6">
		  <input type="number" class="validate" id="birthyear" name="birthyear"><span class="error" style="color:red;"><?php echo $birthyearErr;?></span>
			<label for="birthyear">Birthyear</label>
	</div>
	<div class="input-field col s6">
		  <input type="text" class="validate" name="nationality"><span class="error" style="color:red;"><?php echo $nationalityErr;?></span>
			<label for="nationality">Nationality</label>
	</div>
	<div class="input-field col s6">
		  <input type="email" class="validate" name="email"><span class="error" style="color:red;"><?php echo $emailErr;?></span>
			<label for="email">Email</label>
	</div>
	<div class="col s12">
		<h5>Favorite payement method for</h5>
	</div>
	<div class="col s12">
			<strong>Transport</strong>
			<label><input type="radio" name="transport" value="check" class="with-gap"><span>Check</span></label>
			<label><input type="radio" name="transport" value="cb" class="with-gap"><span>Credit Card</span></label>
			<label><input type="radio" name="transport" value="bank_transfer" class="with-gap"><span>Bank Transfer</span></label>
			<label><input type="radio" name="transport" value="cash" class="with-gap"><span>Cash</span></label>
			<span class="error" style="color:red;"><?php echo $transportErr;?></span>
	</div>
	<div class="col s12">
			<strong>Food</strong>
			<label><input type="radio" name="food" value="check" class="with-gap"><span>Check</span></label>
			<label><input type="radio" name="food" value="cb" class="with-gap"><span>Credit Card</span></label>
			<label><input type="radio" name="food" value="bank_transfer" class="with-gap"><span>Bank Transfer</span></label>
			<label><input type="radio" name="food" value="cash" class="with-gap"><span>Cash</span></label>
			<span class="error" style="color:red;"><?php echo $foodErr;?></span>
	</div>
	<div class="col s12">
			<strong>Clothes</strong>
			<label><input type="radio" name="clothes" value="check" class="with-gap"><span>Check</span></label>
			<label><input type="radio" name="clothes" value="cb" class="with-gap"><span>Credit Card</span></label>
			<label><input type="radio" name="clothes" value="bank_transfer" class="with-gap"><span>Bank Transfer</span></label>
			<label><input type="radio" name="clothes" value="cash" class="with-gap"><span>Cash</span></label>
			<span class="error" style="color:red;"><?php echo $clothesErr;?></span>
	</div>
	<div class="col s12">
			<strong>Shoes</strong>
			<label><input type="radio" name="shoes" value="check" class="with-gap"><span>Check</span></label>
			<label><input type="radio" name="shoes" value="cb" class="with-gap"><span>Credit Card</span></label>
			<label><input type="radio" name="shoes" value="bank_transfer" class="with-gap"><span>Bank Transfer</span></label>
			<label><input type="radio" name="shoes" value="cash" class="with-gap"><span>Cash</span></label>
			<span class="error" style="color:red;"><?php echo $shoesErr;?></span>
	</div>
	<div class="col s12">
			<strong>Houserent</strong>
			<label><input type="radio" name="houserent" value="check" class="with-gap"><span>Check</span></label>
			<label><input type="radio" name="houserent" value="cb" class="with-gap"><span>Credit Card</span></label>
			<label><input type="radio" name="houserent" value="bank_transfer" class="with-gap"><span>Bank Transfer</span></label>
			<label><input type="radio" name="houserent" value="cash" class="with-gap"><span>Cash</span></label>
			<span class="error" style="color:red;"><?php echo $houserentErr;?></span>
	</div>
	<div class="col s12">
			<strong>Healthcare</strong>
			<label><input type="radio" name="healthcare" value="check" class="with-gap"><span>Check</span></label>
			<label><input type="radio" name="healthcare" value="cb" class="with-gap"><span>Credit Card</span></label>
			<label><input type="radio" name="healthcare" value="bank_transfer" class="with-gap"><span>Bank Transfer</span></label>
			<label><input type="radio" name="healthcare" value="cash" class="with-gap"><span>Cash</span></label>
			<span class="error" style="color:red;"><?php echo $healthcareErr;?></span>
	</div>
	<!-- <table>
		<td>Shoes:</td>
		<td>			
			<input type="radio" name="shoes" value="check">Check
			<input type="radio" name="shoes" value="cb">Credit Card
			<input type="radio" name="shoes" value="bank_transfer">Bank Transfer
			<input type="radio" name="shoes" value="cash">Cash
		</td>
	  </tr>
	  <tr>
		<td>House Rent:</td>
		<td>			
			<input type="radio" name="houserent" value="check">Check
			<input type="radio" name="houserent" value="cb">Credit Card
			<input type="radio" name="houserent" value="bank_transfer">Bank Transfer
			<input type="radio" name="houserent" value="cash">Cash
		</td>
	  </tr>
	  <tr>
		<td>Healthcare service:</td>
		<td>			
			<input type="radio" name="healthcare" value="check">Check
			<input type="radio" name="healthcare" value="cb">Credit Card
			<input type="radio" name="healthcare" value="bank_transfer">Bank Transfer
			<input type="radio" name="healthcare" value="cash">Cash
		</td>
	  </tr>
	</table> -->
	<div class="col s12">
	<button type="submit" name="submit" value="Submit" class="waves-effect waves-light btn">Save</button>
	</div>

</form>
</div>

</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.datepicker');
    var instances = M.Datepicker.init(elems, {});
  });
</script>
</body>
