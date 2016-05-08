<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Chapter.php" );
require_once( "gb/domain/Book.php");


class ChapterMapper extends Mapper {

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
            $obj = new \gb\domain\Chapter( $array['chapter_number'] );

            $obj->setBookUri($array['book_uri']);
			$obj->setChapterNumber($array['chapter_number']);
            $obj->setText($array["text"]);
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
	
	// returns a collection of all the chapters from the given book
	// TODO momenteel wordt nog een lege lijst teruggegeven
	function getAllChaptersOfBook($given_book_uri) {
		$con = $this->getConnectionManager();
        $selectStmt = "	SELECT	*
						FROM	chapter
						WHERE	book_uri like " ."\"" . $given_book_uri ."\"";
        $chapters = $con->executeSelectStatement($selectStmt, array()); 
        return $this->getCollection($chapters);
	}
    
}


?>
