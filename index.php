<?php

// inisialisasi variabel
$key = "";
$code = "";
$error = "";
$valid = true;
$color = "#FF0000";

// if form was submit
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	// declare encrypt and decrypt funtions
	require_once('vigenere.php');
	
	// set the variables
	$key = $_POST['key'];
	$code = $_POST['code'];
	
	// check if password is provided
	if (empty($_POST['key']))
	{
		$error = "Please enter a password!";
		$valid = false;
	}
	
	// check if text is provided
	else if (empty($_POST['code']))
	{
		$error = "Please enter some text or code to encrypt or decrypt!";
		$valid = false;
	}
	
	// check if password is alphanumeric
	else if (isset($_POST['key']))
	{
		if (!ctype_alpha($_POST['key']))
		{
			$error = "Password should contain only alphabetical characters!";
			$valid = false;
		}
	}
	
	// inputs valid
	if ($valid)
	{
		// jika menekan tombol enkripsi
		if (isset($_POST['encrypt']))
		{
			$code = encrypt($key, $code);
			$error = "Text encrypted successfully!";
			$color = "#526F35";
		}
			
		// jika menekan tombol dekripsi
		if (isset($_POST['decrypt']))
		{
			$code = decrypt($key, $code);
			$error = "Code decrypted successfully!";
			$color = "#526F35";
		}
	}
}

?>

<html>
	<head>
		<title>XBCrypt - Vigenere Cipher</title>
		<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="maldini.css">
		<script type="text/javascript" src="Script.js"></script>
	</head>
	<body>
		<br><br><br>
		<form action="index.php" method="post">
			<table cellpadding="5" align="center" cellpadding="2" border="7">
				<caption><b>CATUR EDI PRASETYO_V3920014</b><hr></caption>
				<tr>
					<td align="center">Key: <input type="text" name="key" id="pass" value="<?php echo htmlspecialchars($key); ?>" /></td>
				</tr>
				<tr>
					<td align="center"><textarea id="box" name="code"><?php echo htmlspecialchars($code); ?></textarea></td>
				</tr>
				<tr>
					<td><input type="submit" name="encrypt" class="button" value="Enkripsi" onclick="validate(1)" /></td>
				</tr>
				<tr>
					<td><input type="submit" name="decrypt" class="button" value="Deskripsi" onclick="validate(2)" /></td>
				</tr>
				<tr>
					<td><center><div style="color: <?php echo htmlspecialchars($color) ?>"><?php echo htmlspecialchars($error) ?></div></center></td>
				</tr>
			</table>
		</form>
	</body>
</html>