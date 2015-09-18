<?php # navbar
session_start();

$row2 = $dbc->navBarHeader($pageId);

echo '<img src="' . $row2["iDir"] . $row2["iName"] .'" alt="" />';
echo '</header>';
echo '<input type="checkbox" id="menu" role="button">';
echo '<label for="menu" class="slide-toggle" onclick="">&#9776; Menu</label>';

echo '<nav id="navbar"  role="navbar">';

$navDetails = $dbc->navBarDetails();				// Returns an array containing navigation details details.

$listId  = ($pageId == 1) ? 'navBarLink' : '';		// Determine which navbar item should be highlighted.

$t_id = 999;
echo '<ul class="navigation">';

foreach ($navDetails as $row) {
	if ($t_id != $row['titleId'])
	{
		$listId  = ($row2["navTitle"] == $row["title"]) ? 'navBarLink' : '';

		if ($row['titleId'] != 0) {
			echo'</ul></li><li><a href="#" id="' . $listId . '">' . $row["title"] . "</a><ul>";
		} else {
			if ($t_id != 999) {
				echo'<li><a href="#" id="' . $listId . '">' . $row["title"] . "</a><ul>";
			} else {
				echo'<li><a href="index.php?pid=1" id="' . $listId . '">' . $row["title"] . "</a><ul>";
			}
		}
	}
	if ($row['titleId'] != 0) {						// Don't put an extra line under the HOME navbar button.
		echo '<li><a href="page.php?pid=' . $row["pageId"] . '">' . $row["zone"] . "</a></li>";
		$t_id = $row['titleId'];
	}
}

echo '</ul></li></ul></nav>';						// Finish the navigation lists.

?>