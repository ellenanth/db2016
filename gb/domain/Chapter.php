<?php
namespace gb\domain;

require_once( "gb/domain/DomainObject.php" );

class Chapter extends DomainObject {    
      
    private $book_uri;
    private $chapter_number;
    private $text;
   
    function __construct( $id=null ) {
        //$this->name = $name;
        parent::__construct( $id );
    }
    
    function setBookUri($uri) {
        $this->uri = $uri;
    }
    function getBookUri(  ) {
        return $this->uri;
    }
       
    function setChapterNumber ( $chapter_number ) {
        $this->chapter_number = $chapter_number;        
    }
    
    function getChapterNumber () {
        return $this->chapter_number;
    }
    
    function setText( $text) {
        $this->text = $text;
    }
    
    function getText () {
        return $this->text;
    }	

}

?>
