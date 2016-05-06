<?php//TODO write comments?>

<?php
/*
 * file to determine the layout of the page 'Update chapters' for a specific book
 * reachable via 'Update chapter'  > hyperlink on 'number of chapters' or 'name'
 */
 ?>
<?php
	
require_once("gb/controller/ChapterController.php");
$chapterController = new gb\controller\ChapterController();
$chapterController->process();

//collect all chapters of one book in the database
$chapterMapper = new gb\mapper\ChapterMapper();
$allChapters = $chapterMapper->findAll();

$title = "Update chapter";
require("template/top.tpl.php");    

?>
<form method="post">
<table style="width: 100%">

<tr>
    <td colspan="2">
    <table style="width: 100%">        
        <tr>
            <td>Chapter</td>            
            <td style="width: 85%">
                <select style="width: 50%" name="chapter">
                    <option value="1">--------Chapter ---------- </option>  
                    <?php
                    foreach($allChapters as $chapter) {
                        echo "<option value=\"", $chapter->getName(), "\">", $chapter->getName(), "</option>" ;
                    }
                    
                    ?>                    
                </select>
            </td>          
        </tr>
        <tr>
            <td>Old text:</td>
            <td><textarea name="old_text" cols="60" rows="6"></textarea></td>
        </tr>
        <tr>
            <td>New text:</td>
            <td><textarea name="new_text" cols="60" rows="6"></textarea></td>
        </tr>
        <tr>
            <td >&nbsp;</td>            
            <td><input type ="submit" name="update" value="Update" ></td>
        </tr>
    </table>
    </td>
</table>
</form>



<?php
	require("template/bottom.tpl.php");
?>