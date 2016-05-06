<?php
/*
 * file to control what happens on page 'books & awards'
 */
 ?>
<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/Bookmapper.php");


class WinAwardController extends PageController {
    function process() {
        if (isset($_POST["search"])) {
            

	if ((strlen($_POST["genre"]) > 0) &&
                    (strlen($_POST["country"]) > 0) &&
                    (strlen($_POST["from_time"]) > 0))&&
                    (strlen($_POST["to_time"]) > 0))
	   { 
		// search books by genre, country, time
		$this->books = $this->searchBooksByGenreCountryOfWriterAndTime($_POST["genre"],
                                            $_POST["country_writer"], $_POST["time"]);
                
        }
    }
}

?>