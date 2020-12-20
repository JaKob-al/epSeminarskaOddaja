<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "header.css" ?>">
<meta charset="UTF-8" />
<title>Search results</title>
</div> 
<h1>Search results</h1>

<ul>
    
    <?php foreach ($books as $book): ?>
        
        <li><a><?= $book["author"] ?>: 
        	<?= $book["title"] ?> (<?= $book["year"] ?>)</a></li>
        
    <?php endforeach; ?>

</ul>

