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
	private $popular_genres;
	
    function process() {
        if (isset($_POST["search"])) {
			
			if ((strlen($_POST["start_period"]) > 0) &&
                (strlen($_POST["end_period"]) > 0)) {            
			//load the 15 most active writers and 15 most popular genres
			
			// search active writers                
            $this->active_writers = $this->searchActiveWriters($_POST["start_period"], $_POST["end_period"]);
			// search popular genres
			$this->popular_genres = $this->searchPopularGenres($_POST["start_period"], $_POST["end_period"]);
			}
		}
	}
	
    
    function searchActiveWriters($start_period, $end_period) {
        $mapper = new \gb\mapper\PeriodMapper();
        return $mapper->getActiveWriters($start_period, $end_period);
    }
    
    function searchPopularGenres($start_period, $end_period) {
        $mapper = new \gb\mapper\PeriodMapper();
        return $mapper->getPopularGenres($start_period, $end_period);
    }
	
    function getActiveWriters() {
        return $this->active_writers;
    }
	
	function getPopularGenres() {
        return $this->popular_genres;
    }
}

?>