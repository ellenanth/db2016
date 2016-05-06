<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Writer.php" );
require_once( "gb/domain/Genre.php" );



class PeriodMapper extends Mapper {

    function __construct() {
        parent::__construct();
        $this->selectStmt = "SELECT * FROM book where uri = ?";
        $this->selectAllStmt = "SELECT * FROM book order by name";        
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
            $obj->setName($array["name"]);
            $obj->setDescription($array['description']);
			$obj->setOriginalLanguage($array['original_language']);
			$obj->setFirstPublicationDate($array['first_publication_date']);
			$obj->setNumberOfAwards($array['number_of_awards']);
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
        $values = array( $object->getName(), $object->getId(), $object->getId() ); 
        $this->updateStmt->execute( $values );
    }

    function selectStmt() {
        return $this->selectStmt;
    }
    
    function selectAllStmt() {
        return $this->selectAllStmt;
    }
    
	function getBooksByGenre($genre) {
		$con = $this->getConnectionManager();
        $selectStmt = "SELECT book.*, COUNT(award_uri) AS 'number_of_awards'
						from has_genre, book LEFT JOIN wins_award ON book.uri = wins_award.book_uri
						
						where book.uri = has_genre.book_uri 
						and has_genre.genre_uri like " ."\"" . $genre . "\"".
						
						"group by wins_award.book_uri";
        $books = $con->executeSelectStatement($selectStmt, array()); 
		#print $selectStmt;
        return $this->getCollection($books);
	}
	
	function getAllBooks () {
        $con = $this->getConnectionManager();
        $selectStmt = "SELECT book.*, COUNT(award_uri) AS 'number_of_awards'
						from has_genre, book LEFT JOIN wins_award ON book.uri = wins_award.book_uri
						
						where book.uri = has_genre.book_uri 
						group by wins_award.book_uri";
        $books = $con->executeSelectStatement($selectStmt, array()); 
        #print $selectStmt;
        return $this->getCollection($books);
    }
	
}


?>