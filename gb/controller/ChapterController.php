<?php
/*
 * file to control what happens on page 'update chapters'
 */
 ?>
<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/ChapterMapper.php");


class ChapterController extends PageController {
    private $selectedBookUri;
	private $books;
    
    function process() {
        if (isset($_POST["search"])) {
            if (strlen($_POST["genre"]) > 0) {            
                // search by genre
                $this->books = $this->searchBooksByGenre($_POST["genre"]);
			}
		
			else {
				// list all books
				$this->books = $this->listAllBooks();
			}
		}
        
        if (isset($_POST["update"])) {
            $this->updateBookChapter();
        }
        
        if (isset($_POST["add_chapter"])) {
            $this->addBookChapter();
        }
        
        if (isset($_GET["book_uri"])) {
            $this->selectedBookUri = $_GET["book_uri"];
        }
    }
	
	function searchBooksByGenre($genre) {
		$mapper = new \gb\mapper\ChapterMapper(null);
        return $mapper->getBooksByGenre($genre);
	}
	
	function listAllBooks() {
        $mapper = new \gb\mapper\ChapterMapper(null);
        return $mapper->getAllBooks();
    }
    
    function updateBookChapter() {
        print "Please provide some piece of code to update the book chapter here!";
    }
    function addBookChapter() {
        print "Please provide some piece of code to add a new chapter for the selected books here!";
    }
    
    function getSelectedBookUri() {
        return $this->selectedBookUri;
    }
	
	function getSearchResult() {
        return $this->books;
    }
}

?>