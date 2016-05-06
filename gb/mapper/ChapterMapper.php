<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Chapter.php" );


class ChapterMapper($book_uri) extends Mapper {
	
	$selected_book = $book_uri;

    function __construct() {
        parent::__construct();
        $this->selectStmt = "SELECT book.name, chapter.* from book, chapter where book.uri = chapter.book_uri and book.uri = ? and chapter.chapter_number = ?";
        $this->selectAllStmt = "SELECT book.name, chapter.* from book, chapter where book.uri = chapter.book_uri order by book.name";        
    } 
    
    function getCollection( array $raw ) {
        
        $customerCollection = array();
        foreach($raw as $row) {
            array_push($customerCollection, $this->doCreateObject($row));
        }
        
        return $customerCollection;
    }

    protected function doCreateObject( array $array ) {
        
        $obj = null;        
        if (count($array) > 0) {
            $obj = new \gb\domain\Book( $array['uri'] );

            $obj->setUri($array['uri']);
			$obj->setName($array['name']);
            $obj->setNumberOfChapters($array["number_of_chapters"]);
        }
        
        return $obj;
    }

    protected function doInsert( \gb\domain\DomainObject $object ) {
        /*$values = array( $object->getName() ); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );*/
    }
    
    function update( \gb\domain\DomainObject $object ) {
        //$values = array( $object->getName(), $object->getId(), $object->getId() ); 
        //$this->updateStmt->execute( $values );
    }

    function selectStmt() {
        return $this->selectStmt;
    }
    
    function selectAllStmt() {
        return $this->selectAllStmt;
    }
	
	
	// returns book.* and number of chapters of a collection of books with the selected genre
	function getBooksByGenre($genre) {
		$con = $this->getConnectionManager();
        $selectStmt = "SELECT book.*, COUNT(chapter_number) AS 'number_of_chapters'
						from has_genre, book LEFT JOIN chapter ON book.uri = chapter.book_uri
						
						where book.uri = has_genre.book_uri 
						and has_genre.genre_uri like " ."\"" . $genre . "\"".
						
						"group by chapter.book_uri";
        $books = $con->executeSelectStatement($selectStmt, array()); 
		#print $selectStmt;
        return $this->getCollection($books);
	}
	
	// returns book.* and number of chapters of the collection of all books
	function getAllBooks () {
        $con = $this->getConnectionManager();
        $selectStmt = "SELECT book.*, COUNT(chapter_number) AS 'number_of_chapters'
						from book LEFT JOIN chapter ON book.uri = chapter.book_uri
						group by chapter.book_uri";
        $books = $con->executeSelectStatement($selectStmt, array()); 
        #print $selectStmt;
        return $this->getCollection($books);
    }
    
}


?>
