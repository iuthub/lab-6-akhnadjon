<?php
	error_reporting(0);
	$pattern="";
	$text="";
	$replaceText="";
	$replacedText="";
	$isEmail="Not checked yet.";
	$match="Not checked yet.";
	$isPhone="Not checked yet.";
	$phone  = '/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/';
	$email = '/[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/'; 
if ($_SERVER["REQUEST_METHOD"]=="POST") {
	$pattern=$_POST["pattern"];
	$text=$_POST["text"];
	$textfix=$_POST["textfix"];
	$replaceText=$_POST["replaceText"];
	$replacedText=preg_replace($pattern, $replaceText, $text);
	
	if(preg_match($pattern, $text)) {
						$match="Match!";
					} else {
						$match="Does not match!";
					}

	if(preg_match($email, $text)) {
					$isEmail="It is a valid email";
				} else {
					$isEmail = "It is not valid email";
				}

	if(preg_match($phone, $text)) {
					$isPhone="It is a valid phone number";
				} else {
					$isPhone = "It is not a valid phone number";
				}			
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Valid Form</title>
</head>
<body>
	<form action="regex_valid_form.php" method="post">
		<dl>
			<dt>Pattern</dt>
			<dd><input type="text" name="pattern" value="<?= $pattern ?>"></dd>

			<dt>Text</dt>
			<dd><input type="text" name="text" value="<?= $text ?>"></dd>

			<textarea rows="4" cols="50" name="textfix" value="<?=$textfix ?>">
				Enter text to fix
			</textarea>
	
			<dt>Replace Text</dt>
			<dd><input type="text" name="replaceText" value="<?= $replaceText ?>"></dd>
			
			<dt>&nbsp;</dt>
			<dt>Output Text</dt>
			<dd><?=	$match ?></dd>

			<dt>&nbsp;</dt>
			<dt>Replaced Text</dt>
			<dd> <code><?=	$replacedText ?></code></dd>
			
			<dt>&nbsp;</dt>			
			<dt>Results</dt>
			<dd><?=	$isEmail ?></dd>
			<dd><?=	$isPhone ?></dd>
			
			<dt>&nbsp;</dt>
			<dt>Text without spaces</dt>
			<dd><?php 
					$str=preg_replace('/\s/', '', $text);
					print($str);
				?></dd>
			
			<dt>&nbsp;</dt>
			<dt>Nonnumerics removed (except for dot and comma):</dt>
			<dd>  <?php 
					$str=preg_replace('/[^0-9\.\,]*/', '', $text);
					print($str);
				?></dd>
			
			<dt>&nbsp;</dt>
			<dt>New lines removed:</dt>
			<dd>  <?php 
					$str=preg_replace('/$\s+/', '', $textfix);
					print($str);
				?></dd>
			
			<dt>&nbsp;</dt>
			<dt>Select words inside parathesis:</dt>
			<dd>  <?php 
				 $in = $textfix;
    			preg_match_all('/\[([A-Za-z0-9 ]+?)\]/', $in, $out);
    			preg_replace('/[\[]*[\]]*/', '', $out);
    			foreach ($out[0] as  $value) {
    				print($value);
    			};
				?></dd>


			<dt>&nbsp;</dt>
			<dd><input type="submit" value="Check"></dd>
		</dl>

	</form>
</body>
</html>