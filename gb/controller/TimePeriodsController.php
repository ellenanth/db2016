<?php
/*
 * file to control what happens on page 'information about time periods'
 */
 ?>
<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/PeriodMapper.php");


class TimePeriodsController extends PageController {
	
	private $active_writers;
	
    function process() {
        if (isset($_POST["search_period"])) {
			
			//2 dates given
			if ((strlen($_POST["start_period"]) > 0) &&
                (strlen($_POST["end_period"]) > 0)) { 
				
				//error: end period before start period
				if ($_POST["start_period"] > $_POST["end_period"]) {
					print "ERROR: the end date must be after the start date";
				}
				else {
				// search active writers 
				$this->active_writers = $this->searchActiveWriters($_POST["start_period"], $_POST["end_period"]);
				}
			}
			
			//only an end date given
			else if ((strlen($_POST["start_period"]) == 0) &&
                (strlen($_POST["end_period"]) > 0)) {   
				// search active writers from '0000-00-00' to the given date             
				$this->active_writers = $this->searchActiveWriters('0000-00-00', $_POST["end_period"]);
			}
			
			//only a start date given
			else if ((strlen($_POST["start_period"]) > 0) &&
                (strlen($_POST["end_period"]) == 0)) {   
				// search active writers from the given date to today    
				$this->active_writers = $this->searchActiveWriters($_POST["start_period"], date('Y-m-d'));
			}
			
			//no dates given
			else {
				print 'please insert at least one date in the format YYYY-MM-DD';
			}
		}
	}
	
    //return the result of getActiveWriters with the given period in PeriodMapper
    function searchActiveWriters($start_period, $end_period) {
        $mapper = new \gb\mapper\PeriodMapper();
        return $mapper->getActiveWriters($start_period, $end_period);
    }
    
	//return the value of the local variable active_writers
    function getActiveWriters() {
        return $this->active_writers;
    }
}

?>