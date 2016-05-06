<?php
/*
 * file to determine the layout of the page 'Writer spouses'
 */
 ?>
<?php
	
$title = "Writers whose spouses are writers";

require("template/top.tpl.php");
require_once("gb/controller/ListSpousesController.php");
require_once("gb/domain/Writer.php");

$listSpousesController = new gb\controller\listSpousesController();
$listSpousesController->process();

?>  

<?php
	//load the result of a pre-defined query to the variable $writers
    $writers = $listSpousesController->getSearchResult();
	//print the number of results
    print count($writers) . " writers found";
	//print the results if there are any
    if (count($writers) > 0) {
?>
  
<form method="post">
<table style="width: 100%">

<tr>
		<?php //create headings for the results ?>
        <td>Writer</td>
        <td>Spouse</td>
        <td>From time</td>  
        <td>To time </td>
    </tr>  
<?php
		//for each writer print it's full name, full name of it's spouse and the begin and end date of their marriage
        foreach($writers as $writer) {
 ?>
       <tr>
       		<td><?php echo $writer->getFullName(); ?></td>
                <td><?php echo $writer->getFullNameSpouse(); ?></td>
                <td><?php echo $writer->getSpouseFromDate(); ?></td>
                <td><?php echo $writer->getSpouseToDate(); ?></td>	
	</tr>     
<?php        
        }
?>	      
</table>
</form>
<?php
    }
?>

<?php
	require("template/bottom.tpl.php");
?>