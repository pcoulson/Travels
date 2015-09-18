<?php
// http://localhost/TravelsWithPaulTest/index.php

$pageTitle = 'Some of my Travels';
$pageId = 1;

require_once ('SQL/db_connect_class.php');	// Get all data pertaining to the index page.

$dbc = new dbConnect();
$row1 = $dbc->pageHeaderDetails($pageId);

$imageDir = $row1["iDir"];
$thumbDir = $row1["tDir"];
$bckgrnd  = $row1["iName"];

include ('include/checkmail.php');			// Check to see if any mail or comments have sent.
include ('include/header.html');			// Includes page header details to "wrapper".
include ('include/navbar.php');				// Build the navbar from details collected in the index class.

// echo '<div id="homePage" style="background-image: url(' . $imageDir . $bckgrnd . ')">';
echo '<div id="homePage" style="background: #eee">';

include ('include/indexSlider.php');		// Include the slider images.
include ('include/intro.html');				// Include the introduction html images.
include ('include/worldmap.php');			// Include the map options.
include ('include/carousel.php');			// Include the carousel on the page.
include ('include/footer.php');				// Add the footer.
?>