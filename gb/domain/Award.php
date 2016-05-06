<?php
namespace gb\domain;

require_once( "gb/domain/DomainObject.php" );

class Award extends DomainObject {    
      
    private $uri;
    private $name;
    private $description;
	private $introducing_date;
	private $country_iso_code;
   
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
       
    function setName ( $name ) {
        $this->name = $name;        
    }
    
    function getName () {
        return $this->name;
    }
    
    function setDescription( $description) {
        $this->description = $description;
    }
    
    function getDescription () {
        return $this->description;
    }	
	
	function setIntroducingDate($introducing_date) {
        $this->introducing_date = $introducing_date;
    }
    function getIntroducingDate(  ) {
        return $this->introducing_date;
    }
	
	function setCountryIsoCode($country_iso_code) {
        $this->country_iso_code = $country_iso_code;
    }
    function getCountryIsoCode(  ) {
        return $this->country_iso_code;
    }

}

?>
