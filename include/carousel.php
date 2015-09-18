<?php
echo <<<_END
<div class="jMyCarousel">
<ul>
_END;

$carouselImages = $dbc->getCarouselImages();		// Return an array containing the image information to create the carousel.
foreach ($carouselImages as $row) {
	echo '<li><a rel="lightbox[Travels]" href="' . $imageDir . $row["pIname"] . '" title="' . $row["pTitle"] . '"><img src="' . $thumbDir . $row["tIname"] . '" width="' . $row["tWidth"] . '" height="' . $row["tHeight"] . '" /></a></li>';
}

echo <<<_END
</ul>
</div> <!-- End jMyCarousel -->
_END;
?>