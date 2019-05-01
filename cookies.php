<?php

function logged_in_cookie() {
	if(isset($_COOKIE['SPIDERTRONIX_USER_ID']) && !empty($_COOKIE['SPIDERTRONIX_USER_ID'])) {
		return true;
	}
	else {
		return false;
	}
}
?>