<?php
/*
 * file to control what happens on page 'search books'
 */
 ?>
<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/BookMapper.php");


class BookController extends PageController {
	
	private $books;
	
    function process() {
        if (isset($_POST["search"])) {
            if (strlen($_POST["genre"]) > 0)
                {            
                //load the result of a search by genre to books
                $this->books = $this->searchBooksByGenre($_POST["genre"]);
			}
		
			else {
				//load the result of a general search to books (no genre selected, search all books)
				$this->books = $this->listAllBooks();
				}
		}
	}
	
    
    function searchBooksByGenre($genre_uri) {
        $mapper = new \gb\mapper\BookMapper();
        return $mapper->getBooksByGenre($genre_uri);
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