
<?php
/*
 * file to determine the layout of the page 'information about time periods'
 */
 ?>
<?php
$title = "Time period information";

require("template/top.tpl.php");
require_once("gb/controller/TimePeriodsController.php");


$timePeriodsController = new gb\controller\TimePeriodsController();
$timePeriodsController->process();

?>    
<form method="post">
<table style="width: 100%">

<tr>
    <td colspan="4">
    <table style="width: 100%">
        <tr>
            <td>start period</td>
            <td><input type="text" name ="start_period"   ></td>
            <td>end period</td>
            <td><input type="text" name ="end_period" ></td>            
        </tr>
        <tr>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td><input type ="submit" name="search_period" value="search" ></td>
            <td >&nbsp;</td>
    
        </tr>
    </table>
    </td>
</table>
</form>

<?php
	//load the result of the query to a variable
    $active_writers = $timePeriodsController->getActiveWriters();
	
	if (count($active_writers) == 0) {
			print "0 writers found";
		}
		
	//print the results if there are any
    if (count($active_writers) > 0) {
		//keep only the first 15 writers
		$active_writers = array_slice($active_writers, 0, 15, true);
		
?>

<?php //table with 15 most active writers ?>
15 most active writers
<table style="width: 100%">
    <tr>
		<?php //create headings for the results ?>
        <td>Name</td>
        <td>Number of books</td>
        <td>Description</td>
    </tr>    
<?php
		//for each writer print it's name, number of books written in this period and description
		//TODO select only the first 15 tuples
        foreach($active_writers as $writer) {
 ?>
       <tr>
		<td><?php echo $writer->getFullName(); ?></td>
				<td><?php echo $writer->getNumberOfBooks(); ?></td>
                <td><?php echo $writer->getDescription(); ?></td>
		
	</tr>     
<?php        
        }
?>
</table>

<?php
	}
?>


<?php
	require("template/bottom.tpl.php");
?>