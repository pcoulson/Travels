<?php # footer
echo '<footer id="footer" role="footer">';

$currentpage = ($pageId == 1) ? 'index.php' : 'page.php?pid=' . $pageId;

$pageFooterImage = $dbc->getFooterImage($pageId);		// Return an array containing the image information to create the carousel.
echo '<img src="' . $imageDir . $pageFooterImage . '" alt="" />';

echo <<<_END

<a class="alignleft" href="copyright.html" target="_blank">Copyright &copy; Slalombar Associates Limited 2015.&nbsp;All rights reserved.</a>
&nbsp;
<a class="alignright" href="#" onClick="openbox('Contact Me', 0)">Contact Me</a>

<div id="shadowing"></div>
<div id="box">
<span id="boxtitle"></span>
_END;

echo	'<form id="emailForm" method="POST" action="' . $currentpage . '" onSubmit="return validateForm(this)" target="_parent" >';

echo <<<_END

		<fieldset>
			<legend>Form Fields</legend>
			<p>
				<label for="fname" class="label">Name<sup>*</sup></label>
				<input type="text" name="fname" value="" maxlength="30" size="10" placeholder="First Name" autofocus="autofocus" />
				<input type="text" name="sname" value="" maxlength="60" size="20" placeholder="Surname" />
			</p>

			<p>
				<label for="phoneno" class="label">Phone Number<sup>*</sup></label>
				<input type="text" name="phoneno" value="" maxlength="15" size="15" placeholder="Contact Number" />
			</p>

			<p>
				<label for="email" class="label">Email address<sup>*</sup></label>
				<input type="text" name="email" value="" maxlength="60" size="30" placeholder="Your email address" />
			</p>

			<p>
				<label for="rptemail" class="label">Repeat Email address<sup>*</sup></label>
				<input type="text" name="rptemail" value="" maxlength="60" size="30" placeholder="Re-enter your email address" />
			</p>

			<p>
				<label for="comments" class="label">Your comments or questions</label>
				<textarea name="comments" cols="25" rows="5" id="comments"></textarea>
			</p>
		</fieldset>

		<fieldset>
			<legend>Captcha</legend>
			<p>
				<label for="captchafld" class="label">Copy characters here<sup>*</sup></label>
				<input type="text" name="captchafld" value="" maxlength="20" size="5" placeholder="" />
			</p>

			<img id="captcha" src="captcha/captcha.php" />
			<button type="button" id="refresh" onclick="changeCaptcha();">Refresh</button>
		</fieldset>

		<div id="buttons">
			<input type="submit" name="submit" id="send" value="Send" />
			<input type="button" name="cancel" id="cancel" value="Cancel" onClick="closebox()" />
		</div>

		<div id="rqdflds">Fields marked <sup>*</sup> are Mandatory</div>
	</form>
</div>
</footer>
</div> <!-- End content -->
</div> <!-- End wrapper -->
</body>
</html>
_END;

?>