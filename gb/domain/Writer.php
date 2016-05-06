<?php
namespace gb\domain;

require_once( "gb/domain/Person.php" );

class Writer extends Person {    
      
    private $writer_uri;
	private $active_from_year;
    private $active_to_year;
	private $number_of_books;
   
    function __construct( $id=null ) {
        //$this->name = $name;
        parent::__construct( $id );
    }
    
	function setUri($uri) {
        $this->uri = $uri;
    }
    function getUri(  ) {
        return $this->uri;
    }
	
    function setActiveFromYear($year) {
        $this->active_from_year = $year;
    }
    function getActiveFromYear(  ) {
        return $this->active_from_year;
    }
       
    function setActiveToYear($year) {
        $this->active_to_year = $year;
    }
    function getActiveToYear(  ) {
        return $this->active_to_year;
    }
	
	function setNumberOfBooks($number) {
        $this->number_of_books = $number;
    }
    function getNumberOfBooks(  ) {
        return $this->number_of_books;
    }

}

?>
