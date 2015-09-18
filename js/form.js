$(document).ready(function () {
        $('.navigation li').hover(
            function () {$('ul', this).stop().fadeIn();},
            function () {$('ul', this).stop().fadeOut();}
        );
    }
);

//----------------------------------------------------------------------------

var RecaptchaOptions = {
    theme : 'custom',
    custom_theme_widget: 'recaptcha_widget'
};
 
//----------------------------------------------------------------------------

function changeCaptcha() {
    document.getElementById('captcha').src = 'captcha/captcha.php?' + Math.random();
    return;
}

//----------------------------------------------------------------------------

$(function() {
	$( "#box" ).draggable();
});

//----------------------------------------------------------------------------

function validateForm(emailForm)
{
    fail  = validateFirstName(emailForm.fname.value);
    fail += validateSurname(emailForm.sname.value);
    fail += validatePhoneNo(emailForm.phoneno.value);
    fail += validateEmailAddr(emailForm.email.value);
    fail += validateRptEmailAddr(emailForm.rptemail.value,emailForm.email.value);
    fail += validateCaptcha(emailForm.captchafld.value);
    
    if (fail == "") {
    	return true;
    }
    else {
        alert(fail);
        return false;
    }
}

//----------------------------------------------------------------------------

function validateFirstName(fname)
{
    if (fname == "") return "No First Name was entered.\n";
    return "";
}

//----------------------------------------------------------------------------

function validateSurname(sname)
{
    if (sname == "") return "No Surname was entered.\n";
    return "";
}

//----------------------------------------------------------------------------

function validatePhoneNo(phoneno)
{
    if (phoneno == "") return "No Phone number was entered.\n";
    else
        if (isNaN(phoneno)) return "Invalid phone number entered\n";
    return "";
}

//----------------------------------------------------------------------------

function validateEmailAddr(emailaddr)
{
    if (emailaddr == "") return "No email address entered.\n";
    else
    {
        if ( !((emailaddr.indexOf(".") > 0) && (emailaddr.indexOf("@") > 0))
             ||
             (/[^a-zA-Z0-9.@_-]/.test(emailaddr))
           )
        {
            return "Invalid email address.\n";
        }
    }

    return "";
}

//----------------------------------------------------------------------------

function validateRptEmailAddr(rptemail,emailaddr)
{
    if (rptemail == "") return "No repeat email address entered.\n";
    else
    {
    	if (rptemail != emailaddr)
    	{
            return "Email addresses should be the same.\n";
    	}
    }

    return "";
}

//----------------------------------------------------------------------------

function validateCaptcha(captchafld)
{
    if (captchafld == "") return "No captcha value was entered.\n";
    if (captchafld.length != 5) return"Insufficient characters in captcha field.\n";
    return "";
}

//----------------------------------------------------------------------------

function gradient(id, level)
{
    var box = document.getElementById(id);
    box.style.opacity = level;
    box.style.MozOpacity = level;
    box.style.KhtmlOpacity = level;
    box.style.filter = "alpha(opacity=" + level * 100 + ")";
    box.style.display="block";
    return;
}

//----------------------------------------------------------------------------

function fadein(id) 
{
    var level = 0;
    while(level <= 1)
    {
	setTimeout( "gradient('" + id + "'," + level + ")", (level*1000) + 10);
	level += 0.01;
    }
    return;
}

//----------------------------------------------------------------------------

// Open the lightbox


function openbox(formtitle, fadin)
{
    var box = document.getElementById('box'); 
    document.getElementById('shadowing').style.display='block';

    var btitle = document.getElementById('boxtitle');

    btitle.innerHTML = formtitle;

    if(fadin)
    {
        gradient("box", 0);
        fadein("box");
    }
    else
    {
        box.style.display='block';
    }  	
    return;
}

//----------------------------------------------------------------------------

// Close the lightbox

function closebox()
{
    document.getElementById('box').style.display='none';
    document.getElementById('shadowing').style.display='none';
    return;
}

//----------------------------------------------------------------------------