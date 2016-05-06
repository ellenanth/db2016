<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Writer.php" );


class SpouseMapper extends Mapper {

    function __construct() {
        parent::__construct();
		$this->selectStmt = "SELECT * FROM writer where uri = ?";
        $this->selectAllStmt = "SELECT * FROM writer order by name"; 
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
            $obj = new \gb\domain\Writer( $array['uri'] );

            $obj->setUri($array['uri']);
            $obj->setFullName($array["full_name"]);
            $obj->setFullNameSpouse($array['full_name_spouse']); 
			$obj->setSpouseFromDate($array['from_date']);
			$obj->setSpouseToDate($array['to_date']);

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
	
	function getAllSpouses() {
		$con = $this->getConnectionManager();
		
		//TODO select statement for Writers whose spouses are writers (select writer.uri, writer.name, spouse.name, from_time, to_time) met hernoemingen;        
        $selectStmt = "SELECT a.*, b.*, c.full_name as 'full_name_spouse', e.from_time as 'from_date', e.to_time as 'to_date' 
		from person a, writer b, person c, writer d, is_spouse_of e where a.uri = b.writer_uri and c.uri = d.writer_uri
		and e.writer_uri = b.writer_uri and e.person_uri = c.uri";
			 
        $spouses = $con->executeSelectStatement($selectStmt, array()); 
        #print $selectStmt;
        return $this->getCollection($spouses);
	}
    
}


?>
