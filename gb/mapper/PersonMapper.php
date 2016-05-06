<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Person.php" );


class PersonMapper extends Mapper {

    function __construct() {
        parent::__construct();
        $this->selectStmt = "SELECT * FROM person where uri = ?";
        $this->selectAllStmt = "SELECT * FROM person order by full_name";        
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
            $obj = new \gb\domain\Person( $array['uri'] );

            $obj->setUri($array['uri']);
            $obj->setFullName($array["full_name"]);
            $obj->setDescription($array['description']); 
			$obj->setDateOfDeath($array['death_date']);
			$obj->setDateOfBirth($array['birth_date']);
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
    
}


?>
