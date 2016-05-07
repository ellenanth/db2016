<?php
/*
 * file to determine the layout of the page 'Books & awards'
 */
 ?>
<?php
	
$title = "Books that win awards";

require("template/top.tpl.php");
require_once("gb/controller/WinAwardController.php");
require_once("gb/domain/Book.php");
require_once("gb/mapper/GenreMapper.php");
require_once("gb/mapper/CountryMapper.php");

$winAwardController = new gb\controller\WinAwardController();
$winAwardController->process();

//collect all genres in the database
$genreMapper = new gb\mapper\GenreMapper();
$allGenres = $genreMapper->findAll();

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
            <td>Genre</td>            
            <td colspan="3" style="width: 85%">
                <select style="width: 50%" name="genre">
                    <option value="">--------Book genres ---------- </option>  
					<?php
					//load all genres in a combo box (showing the genre name and selecting the uri of the genre)
                    foreach($allGenres as $genre) {
                        echo "<option value=\"", $genre->getUri(), "\">", $genre->getName(), "</option>" ;
                    }
                    
                    ?> 
                </select>
            </td>          
        </tr>
        <tr>
            <td>Writer country</td>            
            <td colspan="3" style="width: 85%">
                <select style="width: 50%" name="country_writer">
                    <option value="">--------Country ---------- </option>       
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
            <td>From time</td>
            <td><input type="text" name ="from_time"   ></td>
            <td>To time</td>
            <td><input type="text" name ="to_time" ></td>            
        </tr>
        <tr>
            <td >&nbsp;</td>            
            <td><input type ="submit" name="search" value="Search" ></td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
    
        </tr>
    </table>
    </td>
</table>
</form>

<?php
	//load the result of the query to the variable $books
    $books = $winAwardController->getSearchResult();
	//print the number of results
    print count($books) . " books found";
	//print the results if there are any
    if (count($books) > 0) 
	{
?>


<table style="width: 100%">
    <tr>
		<?php //create headings for the results ?>
        <td>Book name</td>
        <td>Description</td>        
    </tr>   
<?php
		//for each book in the result print it's name and description
        foreach($books as $book) {
 ?>
			<tr>
			<td><?php echo $book->getName(); ?></td>
			<td><?php echo $book->getDescription(); ?></td>
		
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
