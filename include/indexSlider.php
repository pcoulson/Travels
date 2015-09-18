<?php # Slider
echo '<div class="flexslider">';
echo '<ul class="slides">';
$sliderImageList = $dbc->getSliderImages($pageId);

foreach ($sliderImageList as $sliderImage) {
	echo '<li><img src="' . $imageDir . $sliderImage["iName"] . '" />';
	echo '<p class="flex-caption">' . $sliderImage["iTitle"] . '</p></li>';
}

echo '</ul>';
echo '</div> <!-- End flexslider -->';
?>