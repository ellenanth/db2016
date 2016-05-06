<?php
/*
 * file to control what happens on the page 'Update chapters' for a specific book
 * reachable via 'Update chapter'  > hyperlink on 'number of chapters' or 'name'
 */
 ?>
 <?php
namespace gb\controller;

require_once("gb/controller/PageController.php");


class UpdateChapterController extends PageController {
	
	private $chapters;
	
    function process() {
		if (strlen($_POST["chapter"]) > 0) && (strlen($_POST["old_text"]) == 0) {
			//TODO load old text
		}
		
        if (isset($_POST["update"])) {
            //TODO update text chapter
		}
	}
	
    
    function searchChaptersOfBook($book_uri) {
        $mapper = new \gb\mapper\ChapterMapper();
        return $mapper->getChaptersOfBook($genre_uri);
    }
    
    function listAllBooks() {
        $mapper = new \gb\mapper\BookMapper();
        return $mapper->getAllBooks();
    }
	
    function getSearchResult() {
        return $this->books;
    }
}

?>