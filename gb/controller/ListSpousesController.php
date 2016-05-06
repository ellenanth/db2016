<?php
/*
 * file to control what happens on page 'writer spouses'
 */
 ?>
<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/SpouseMapper.php");


class ListSpousesController extends PageController {
	
	private $spouses;
	
	function process() {
		// list all writers whose spouses are writers
		$this->spouses = $this->listAllSpouses();
	}
    
    function listAllSpouses() {
        $mapper = new \gb\mapper\SpouseMapper();
        return $mapper->getAllSpouses();
    }
	
    function getSearchResult() {
        return $this->spouses;
    }
}

?>