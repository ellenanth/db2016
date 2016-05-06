<?php
/*
 * file to determine the layout of the page 'Update Chapters'
 */
 ?>
<?php
	
$title = "Update chapters of books";

require("template/top.tpl.php");
require_once("gb/controller/ChapterController.php");
require_once("gb/domain/Book.php");
require_once("gb/mapper/GenreMapper.php");

$chapterController = new gb\controller\ChapterController();
$chapterController->process();

//collect all genres in the database
$genreMapper = new gb\mapper\GenreMapper();
$allGenres = $genreMapper->findAll();

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
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td><input type ="submit" name="search" value="Search" ></td>
            <td >&nbsp;</td>
    
        </tr>
    </table>
    </td>
</table>
</form>

<?php
	//load the result of the query to the variable $books
    $books = $chapterController->getSearchResult();
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
        <td>Chapters</td>
        <td>Add chapters</td>       
    </tr>
<?php
		//for each book print it's name, number of chapters (with hyperlink to update book chapters) and the string 'Add chapter' (with hyperlink to add book chapter)
        foreach($books as $book) {
 ?>
       <tr>
        <td><a href="update_book_chapters.php?book_uri=http://dbpedia.org/resource/<?php echo $book->getName() ?>">
					<?php echo $book->getName() ?></a></td>
        <td><a href="update_book_chapters.php?book_uri=http://dbpedia.org/resource/<?php echo $book->getName() ?>">
					<?php echo $book->getNbChapters() ?></a></td>
        <td><a href="add_book_chapters.php?book_uri=http://dbpedia.org/resource/<?php echo $book->getName() ?>">
					Add chapter</a></td>
		
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