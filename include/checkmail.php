<?php
function spam_scrubber($value) {
	$spamtips = array('to:',
					  'cc:',
					  'bcc',
					  'content-type:',
					  'mime-version:',
					  'multipart-mixed:',
					  'content-transfer-encoding:');
	foreach ($spamtips as $v) {
		if (strpos($value, $v) !== false) {
			return '';
		}
	}
	$value = str_replace(array("\\r", "\\n", "%0a", "%0d")," ",$value);
	return trim($value);
}

session_start();

if (isset($_REQUEST["email"]) && ($_REQUEST["email"]) != '')
{
	if($_POST['captchafld'] != $_SESSION['textstr']) {
		echo 'Sorry, the CAPTCHA code entered was incorrect!<br />';
	} else {
		$scrubbed = array_map('spam_scrubber',$_REQUEST);
		if (!empty($scrubbed["email"]) &&
			!empty($scrubbed["fname"]) &&
			!empty($scrubbed["sname"]) &&
			!empty($scrubbed["phoneno"]) &&
			!empty($scrubbed["comments"]))
		{
			$to      = 'pcoulson_101@yahoo.co.uk';
			$subject = 'Phone: ' . $scrubbed["phoneno"];
			$body    = wordwrap($scrubbed["comments"],70);
			$from    = 'From: ' . $scrubbed["email"];
			mail($to, $subject, $body, $from);
		}
	}
}

session_destroy();

?>