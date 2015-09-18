<?php
/*
 * Get all data pertaining to the index page.
 */
require_once ('SQL/globals.php');

class dbConnect
{
	protected $_db;

	/**
	 * Make a connection to the database using the global constants. The constructor in the
	 * mysqli class makes the connection.
	 */
	public function __construct()
	{
		$this->_db = @new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if (mysqli_connect_errno()) {
			throw new RuntimeException('Cannot access database: ' . mysqli_connect_error());
		}

	}

	/**
	 * Get the page header details.
	 */
	public function pageHeaderDetails($pageId)
	{
		$imageType = 'B';

		$query = "SELECT	page.pagetitle      as pTitle,
							page.imagedirectory	as iDir,
							page.thumbdirectory	as tDir,
							images.imagename	as iName
					FROM	page,
							images
				   WHERE	page.pageid      = ?
					 AND	images.pageid    = page.pageid
					 AND	images.imagetype = ?";

		$stmt = $this->_db->prepare($query);

		if($stmt === false) {
			trigger_error('Wrong SQL: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}


		/* Bind parameters. Types: s = string, i = integer, d = double,  b = blob */
		$stmt->bind_param("is", $pageId, $imageType);
		if($stmt === false) {
			trigger_error('Binding parameters failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}


		/* Execute statement */
		$stmt->execute();
		if($stmt === false) {
			trigger_error('Execute failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		/* Bind results statement */
		$stmt->bind_result($pTitle, $iDir, $tDir, $iName);
		if($stmt === false) {
			trigger_error('bind_results failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		/* Fetch statement */
		$stmt->fetch();
		if($stmt === false) {
			trigger_error('Fetch failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		$row1 = array();

		$row1["pTitle"] = $pTitle;
		$row1["iDir"] = $iDir;
		$row1["tDir"] = $tDir;
		$row1["iName"] = $iName;

		return $row1;
	}

	/**
	 * Get the navbar title details.
	 */
	public function navBarHeader($pageId)
	{
		$imageType = 'H';

		$query = "SELECT page.pagetitle			as pt,
						 page.imagedirectory	as iDir,
						 page.thumbdirectory	as tDir,
						 images.imagename		as iName,
						 navbar.title        	as navTitle
					FROM page,
						 images,
						 navbar
				   WHERE page.pageid      = ?
					 AND images.pageid    = page.pageid
					 AND images.imagetype = ?
					 AND navbar.pageid	  = page.pageid";

		$stmt = $this->_db->prepare($query);

		if($stmt === false) {
			trigger_error('Wrong SQL: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}


		/* Bind parameters. Types: s = string, i = integer, d = double,  b = blob */
		$stmt->bind_param("is", $pageId, $imageType);
		if($stmt === false) {
			trigger_error('Binding parameters failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}


		/* Execute statement */
		$stmt->execute();
		if($stmt === false) {
			trigger_error('Execute failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		/* Bind results statement */
		$stmt->bind_result($pt, $iDir, $tDir, $iName, $navTitle);
		if($stmt === false) {
			trigger_error('bind_results failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		/* Fetch statement - fetch results in bound variables  */
		$stmt->fetch();
		if($stmt === false) {
			trigger_error('Fetch failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		$row1 = array();

		$row1["pt"] = $pt;
		$row1["iDir"] = $iDir;
		$row1["tDir"] = $tDir;
		$row1["iName"] = $iName;
		$row1["navTitle"] = $navTitle;

		return $row1;
	}

	/**
	 * Get the navbar details. This does not need to be a prepared statement as no variables are used.
	 */
	public function navBarDetails()
	{
		$query = "SELECT titleid as titleId,
					  	 pageid  as pageId,
					     title   as title,
					     zone    as zone
				    FROM navbar
				ORDER BY titleid ASC, zone ASC";

		$rows = $this->_db->query($query);
		if ($rows === false) {
			trigger_error('Wrong SQL: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		return $rows->fetch_all(MYSQLI_ASSOC);	// Can only used with MySQL Named Driver, MySQL v5.4+
	}

	/**
	 * Get the index page slider image details.
	 */
	public function getSliderImages($pageId)
	{
		$imageType = 'S';

		$query = "SELECT imagename as iName,
						 imagetitle as iTitle
					FROM images
				   WHERE pageid = ?
					 AND imagetype = ?";

		$stmt = $this->_db->prepare($query);

		if($stmt === false) {
			trigger_error('Wrong SQL: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		/* Bind parameters. Types: s = string, i = integer, d = double,  b = blob */
		$stmt->bind_param("is", $pageId, $imageType);
		if($stmt === false) {
			trigger_error('Binding parameters failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		/* Execute statement */
		$stmt->execute();
		if($stmt === false) {
			trigger_error('Execute failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		$allRows = $stmt->get_result();
		if($allRows === false) {
			trigger_error('Fetch failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}
		return $allRows->fetch_all(MYSQLI_ASSOC);
	}

	/**
	 * Get the World Map Image name.
	 */
	public function getMapImage($pageId)
	{
		$imageType = 'M';

		$query = "SELECT imagename as iName
					FROM images
				   WHERE pageid = ?
					 AND images.imagetype = ?";

		$stmt = $this->_db->prepare($query);

		if($stmt === false) {
			trigger_error('Wrong SQL: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		/* Bind parameters. Types: s = string, i = integer, d = double,  b = blob */
		$stmt->bind_param("is", $pageId, $imageType);
		if($stmt === false) {
			trigger_error('Binding parameters failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}


		/* Execute statement */
		$stmt->execute();
		if($stmt === false) {
			trigger_error('Execute failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		/* Bind results statement */
		$stmt->bind_result($iName);
		if($stmt === false) {
			trigger_error('bind_results failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		$stmt->fetch();
		if($stmt === false) {
			trigger_error('Fetch failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		return $iName;
	}

	/**
	 * Get World Map Co-ordinates. This does not need to be a prepared statement as no variables are used.
	 */
	public function getMapCoords()
	{
		$query = "SELECT	pageid   as pId,
							imageid  as iId,
							x_coord  as xCo,
							y_coord  as yCo,
							radius   as rad,
							pintitle as pTitle
					FROM 	map";

		$rows = $this->_db->query($query);
		if ($rows === false) {
			trigger_error('Wrong SQL: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		return $rows->fetch_all(MYSQLI_ASSOC);	// Can only used with MySQL Named Driver, MySQL v5.4+
	}

	/**
	 * Get the carousel image details. This does not need to be a prepared statement as no variables are used.
	 */
	public function getCarouselImages()
	{
		$query = "SELECT	i.imagename  as pIname,
							i.imagetitle as pTitle,
							i2.imagename as tIname,
							i2.width     as tWidth,
							i2.height    as tHeight
					FROM	carousel c,
							images i,
							images i2
					WHERE	i.imageid  = c.imageid
					AND 	i2.imageid = i.photoid";

		$rows = $this->_db->query($query);
		if ($rows === false) {
			trigger_error('Wrong SQL: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		return $rows->fetch_all(MYSQLI_ASSOC);	// Can only used with MySQL Named Driver, MySQL v5.4+
	}


	/**
	 * Get the page section title details.
	 */
	public function getSectionList($pageId)
	{
		$query = "SELECT sectionid		as 	sectionId,
              			 sectiontitle	as sectionTitle,
              			 sectionheader	as sectionHeader
  		  			FROM section
        		   WHERE pageid = ?
       		    ORDER BY sectionid";

		$stmt = $this->_db->prepare($query);

		if($stmt === false) {
			trigger_error('Wrong SQL: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		/* Bind parameters. Types: s = string, i = integer, d = double,  b = blob */
		$stmt->bind_param("i", $pageId);
		if($stmt === false) {
			trigger_error('Binding parameters failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}


		/* Execute statement */
		$stmt->execute();
		if($stmt === false) {
			trigger_error('Execute failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		$allRows = $stmt->get_result();
		if($allRows === false) {
			trigger_error('Fetch failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		return $allRows->fetch_all(MYSQLI_ASSOC);
	}

	/**
	 * Get the photos for this page section.
	 */
	public function getImages($pageId, $sectionId)
	{
		$imageType = 'P';

		$query = "SELECT	i.imagename  as pIname,
							i.imagetitle as pTitle,
							i2.imagename as tIname,
							i2.width     as tWidth,
							i2.height    as tHeight
					FROM 	images i,
                  			images i2
					WHERE 	i.pageid    = ?
					AND 	i.sectionid = ?
					AND 	i.imagetype = ?
					AND 	i2.imageid  = i.photoid";

		$stmt = $this->_db->prepare($query);

		if($stmt === false) {
			trigger_error('Wrong SQL: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		/* Bind parameters. Types: s = string, i = integer, d = double,  b = blob */
		$stmt->bind_param("iis", $pageId, $sectionId, $imageType);
		if($stmt === false) {
			trigger_error('Binding parameters failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		/* Execute statement */
		$stmt->execute();
		if($stmt === false) {
			trigger_error('Execute failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		$allRows = $stmt->get_result();
		if($allRows === false) {
			trigger_error('Fetch failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		return $allRows->fetch_all(MYSQLI_ASSOC);
	}

	/**
	 * Get the carousel image details. This does not need to be a prepared statement as no variables are used.
	 */
	public function getFooterImage($pageId)
	{
		$imageType = 'F';

		$query = "SELECT	imagename
					FROM	images
					WHERE	pageid = ?
					AND		imagetype = ?";

		$stmt = $this->_db->prepare($query);

		if($stmt === false) {
			trigger_error('Wrong SQL: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}


		/* Bind parameters. Types: s = string, i = integer, d = double,  b = blob */
		$stmt->bind_param("is", $pageId, $imageType);
		if($stmt === false) {
			trigger_error('Binding parameters failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}


		/* Execute statement */
		$stmt->execute();
		if($stmt === false) {
			trigger_error('Execute failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		/* Bind results statement */
		$stmt->bind_result($iName);
		if($stmt === false) {
			trigger_error('bind_results failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		/* Fetch statement - fetch results in bound variables  */
		$stmt->fetch();
		if($stmt === false) {
			trigger_error('Fetch failed: ' . $query . ' Error: ' . $this->_db->error, E_USER_ERROR);
		}

		return $iName;
	}
}
?>