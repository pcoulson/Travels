<?php # page.php

require_once ('SQL/db_connect_class.php');	// Get all data pertaining to this page.
$dbc = new dbConnect();

$pageId = $_GET['pid'];

$row1 = $dbc->pageHeaderDetails($pageId);

$pageTitle = $row1["pTitle"];
$imageDir  = $row1["iDir"];
$thumbDir  = $row1["tDir"];
$bckgrnd   = $row1["iName"];

include ('include/checkmail.php');			// Check to see if any mail or comments have sent.
include ('include/header.html');			// Includes page header details to "wrapper".
include ('include/navbar.php');				// Build the navbar from details collected in the index class.

echo '<div class="content">';
echo '<div style="background-image: url(' . $imageDir . $bckgrnd . '); background-size:100% auto">';
echo '<div id="photos">';
echo '<article class="gallery" role="main">';

$sectionList = $dbc->getSectionList($pageId);

foreach ($sectionList as $section) {
	echo '<section id="' . $section["sectionTitle"] . '">';
	echo '<h2>' . $section["sectionHeader"] . '</h2>';
	$sectionId = $section["sectionId"];

	$imageDetails = $dbc->getImages($pageId, $sectionId);

	foreach ($imageDetails as $images) {
        echo '<a rel="lightbox[' . $section["sectionTitle"] . ']" href="' . $imageDir . $images["pIname"] . '" title="' . $images["pTitle"] . '"><img src="' . $thumbDir . $images["tIname"] . '" /></a>';
	}
	echo '</section>';
}

echo '</article>';
echo '</div> <!-- End Photos -->';
echo '</div> <!-- End background photo -->';
include ('include/footer.php');
?>