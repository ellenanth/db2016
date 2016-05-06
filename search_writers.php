<?php
/*
 * file to determine the layout of the page 'Search writers'
 */
 ?>
<?php
	
$title = "Search writers";

require("template/top.tpl.php");
require_once("gb/controller/SearchWritersController.php");
require_once("gb/domain/Writer.php");
require_once("gb/mapper/CountryMapper.php");

$searchWriterController = new gb\controller\SearchWritersController();
$searchWriterController->process();

//collect all countries in the database
$countryMapper = new gb\mapper\CountryMapper();
$allCountries = $countryMapper->findAll();
 
?>    
<form method="post">
<table style="width: 100%">

<tr>
    <td colspan="4">
    <table style="width: 100%">
        <tr>
            <td>Writer name</td>
            <td><input type="text" name ="full_name"   ></td>
            <td>Date of birth</td>
            <td><input type="text" name ="date_of_birth" ></td>            
        </tr>
        <tr>
            <td>Country</td>            
            <td colspan="3" style="width: 85%">
                <select style="width: 50%" name="country">
                    <option value="">--------Select country ---------- </option>
                    <?php
					//load all countries in a combo box (showing the country name and selecting the iso-code of the country)
                    foreach($allCountries as $country) {
                        echo "<option value=\"", $country->getIsoCode(), "\">", $country->getCountryName(), "</option>" ;
                    }
                    ?>      
                </select>
            </td>          
        </tr>
        <tr>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td><input type ="submit" name="search_writer" value="Search" ></td>
            <td >&nbsp;</td>
    
        </tr>
    </table>
    </td>
</table>
</form>

<?php
	//load the result of the query to the variable $writers
    $writers = $searchWriterController->getSearchResult();
	//print the number of results
    print count($writers) . " writers found";
	//print the results if there are any
    if (count($writers) > 0) {
?>


<table style="width: 100%">
    <tr>
		<?php //create headings for the results ?>
        <td>Full name</td>
        <td>Birth date</td>
        <td>Death date</td>
        <td>Description</td>
    </tr>    
<?php
		//for each writer print it's name, birth date, death date and description
        foreach($writers as $writer) {
 ?>
       <tr>
		<td><?php echo $writer->getFullName(); ?></td>
                <td><?php echo $writer->getDateOfBirth(); ?></td>
                <td><?php echo $writer->getDateOfDeath(); ?></td>
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