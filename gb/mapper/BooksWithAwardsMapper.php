<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Book.php" );


class BooksWithAwardsMapper extends Mapper {

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
    
	
	function getBooksByGenreAndCountryWithAward($genre, $country_writer, $from_time, $to_time) {
		$con = $this->getConnectionManager();
        $selectStmt = "SELECT b.*, COUNT(b.uri) AS 'number_of_books_that_has_award'
						FROM has_genre g, book b, wins_award a, writes w, has_citizenship h
						WHERE 		b.uri = g.book_uri
								and b.uri = w.book_uri
								and w.writer_uri = h.person_uri
								and a.book_uri = b.uri
								and b.first_publication_date > " ."\"" ."%". $from_time . "%" . "\""
								."and b.first_publication_date < " ."\"" . $to_time . "%"."\""
								."and h.country_iso_code like " ."\"" . $country_writer . "%"."\""
								."and g.genre_uri like " ."\"" . $genre ."\"";    
        $books = $con->executeSelectStatement($selectStmt, array()); 
		#print $selectStmt;
        return $this->getCollection($books);
	}
}
	



?>
