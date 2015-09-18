<?php
echo '<button id="buttonMap" class="boxclass">Open Map...</button>';

echo '<div id="imgBorder">';
echo '<div id="travelMap" class="travelMap">';

$worldMapImg = $dbc->getMapImage($pageId);

echo '<img src="' . $imageDir . $worldMapImg . '" alt="Places I have been to" usemap="#destinations" />';
echo '<map name="destinations">';

$worldMapCoords = $dbc->getMapCoords();		// Return an array containing the coordinates for the pins on the world map.
foreach ($worldMapCoords as $row) {
	echo '<area shape="circle" coords="' . $row["xCo"] . ',' . $row["yCo"] . ',' . $row["rad"] . '" href="page.php?pid=' . $row["pId"] . '" title="' .  $row["pTitle"] . '" alt="" />';
}

echo <<<_END
</map>
</div> <!-- End travelMap -->
<div id="justTheTravelMap" class="travelMap">
<img src="images/home/placesivebeento.jpg" alt="Places I have been to" />
</div> <!-- End justTheTravelMap -->
</div> <!-- End imgBorder -->
_END;
?>