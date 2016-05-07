<?php
/*
 * file to control what happens on page 'books & awards'
 */
 ?>
<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/BooksWithAwardsMapper.php");


class WinAwardController extends PageController {
	private $books;
    function process() {
        if (isset($_POST["search"])) {
            

	if ((strlen($_POST["genre"]) > 0) &&
                    (strlen($_POST["country_writer"]) > 0) &&
                    (strlen($_POST["from_time"]) > 0)&&
                    (strlen($_POST["to_time"]) > 0))
	   { 
		// search books by genre, country, time
		$this->books = $this-> getBooksByGenreAndCountryWithAward($_POST["genre"],
                                            $_POST["country_writer"], $_POST["from_time"], $_POST["to_time"]);
                
        }
    }
	
	}
	
	 function getBooksByGenreAndCountryWithAward($genre, $country_writer, $from_time, $to_time) {
        $mapper = new \gb\mapper\BooksWithAwardsMapper();
        return $mapper->getBooksByGenreAndCountryWithAward($genre, $country_writer, $from_time, $to_time);
    }
	function getSearchResult() {
        return $this->books;
    }
}
?>
