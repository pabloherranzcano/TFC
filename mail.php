<?php
$to = "pablo.hc9@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: webmaster@example.com" . "\r\n" .
"CC: somebodyelse@example.com";

if(mail($to,$subject,$txt,$headers)) {
	echo '<p>Your message has been sent!</p>';
} else {
	echo '<p>Something went wrong, go back and try again!</p>';
}

?>