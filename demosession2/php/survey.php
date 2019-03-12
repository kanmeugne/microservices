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

<body style="font-size:100%;font-family:cambria;">

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
 <form method="post" action="./survey.php">
	<table>
	  <tr>
		<td>First Name:</td>
		<td>
		  <input type="text" name="firstname"><span class="error" style="color:red;"><?php echo $firstnameErr;?></span>
		</td>
	  </tr>
	  <tr>
		<td>Last Name:</td>
		<td>
		  <input type="text" name="lastname"><span class="error" style="color:red;"><?php echo $lastnameErr;?></span>
		</td>
	  </tr>
	  <tr>
		<td>Gender:</td>
		<td>
		  <input type="radio" name="gender" value="female">Female
		  <input type="radio" name="gender" value="male">Male
		  <input type="radio" name="gender" value="other">Other
		  <span class="error" style="color:red;"><?php echo $genderErr;?></span>
		</td>
	  </tr>
	  <tr>
		<td>Birth Place (Country):</td>
		<td>
		  <input type="text" name="birthplace"><span class="error" style="color:red;"><?php echo $birthplaceErr;?></span>
		</td>
	  </tr>
	  <tr>
		<td>Birth Year:</td>
		<td>
		  <input type="integer" name="birthyear"><span class="error" style="color:red;"><?php echo $birthyearErr;?></span>
		</td>
	  </tr>
	  <tr>
		<td>Nationality:</td>
		<td>
		  <input type="text" name="nationality"><span class="error" style="color:red;"><?php echo $nationalityErr;?></span>
		</td>
	  </tr>
	  <tr>
		<td>Email:</td>
		<td>
		  <input type="text" name="email"><span class="error" style="color:red;"><?php echo $emailErr;?></span>
		</td>
	  </tr>
	  <tr>
		<th colspan="2" > Favorite paiement mode for </th>
	  </tr>
	  <tr>
		<td>Transport:</td>
		<td>
			<input type="radio" name="transport" value="check">Check
			<input type="radio" name="transport" value="cb">Credit Card
			<input type="radio" name="transport" value="bank_transfer">Bank Transfer
			<input type="radio" name="transport" value="cash">Cash
			<span class="error" style="color:red;"><?php echo $transportErr;?></span>
		</td>
	  </tr>
	  <tr>
		<td>Food:</td>
		<td>
			<input type="radio" name="food" value="check">Check
			<input type="radio" name="food" value="cb">Credit Card
			<input type="radio" name="food" value="bank_transfer">Bank Transfer
			<input type="radio" name="food" value="cash">Cash
			<span class="error" style="color:red;"><?php echo $foodErr;?></span>
		</td>
	  </tr>
	  <tr>
		<td>Clothes:</td>
		<td>
			<input type="radio" name="clothes" value="check">Check
			<input type="radio" name="clothes" value="cb">Credit Card
			<input type="radio" name="clothes" value="bank_transfer">Bank Transfer
			<input type="radio" name="clothes" value="cash">Cash
			<span class="error" style="color:red;"><?php echo $clothesErr;?></span>
		</td>
	  </tr>
	  <tr>
		<td>Shoes:</td>
		<td>			
			<input type="radio" name="shoes" value="check">Check
			<input type="radio" name="shoes" value="cb">Credit Card
			<input type="radio" name="shoes" value="bank_transfer">Bank Transfer
			<input type="radio" name="shoes" value="cash">Cash
			<span class="error" style="color:red;"><?php echo $shoesErr;?></span>
		</td>
	  </tr>
	  <tr>
		<td>House Rent:</td>
		<td>			
			<input type="radio" name="houserent" value="check">Check
			<input type="radio" name="houserent" value="cb">Credit Card
			<input type="radio" name="houserent" value="bank_transfer">Bank Transfer
			<input type="radio" name="houserent" value="cash">Cash
			<span class="error" style="color:red;"><?php echo $houserentErr;?></span>
		</td>
	  </tr>
	  <tr>
		<td>Healthcare service:</td>
		<td>			
			<input type="radio" name="healthcare" value="check">Check
			<input type="radio" name="healthcare" value="cb">Credit Card
			<input type="radio" name="healthcare" value="bank_transfer">Bank Transfer
			<input type="radio" name="healthcare" value="cash">Cash
			<span class="error" style="color:red;"><?php echo $healthcareErr;?></span>
		</td>
	  </tr>
	</table>
	
	<input type="submit" name="submit" value="Submit">

</form>

</body>
