<?php

function randomCaptcha(){
	$captcha[0] = rand(0,20);
	$captcha[1] = rand(0,20);
	return ($captcha);
}

?>