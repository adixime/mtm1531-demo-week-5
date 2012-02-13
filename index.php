<?php 

require_once 'includes/filter-wrapper.php';

require_once 'includes/db.php';
//var_dump($db);
//->exec() allows us to perform SQ: and NOT expect results
//->query() allows us to perform SQL and expect results
$results = $db->query(' SELECT id, dino_name, period 
						FROM dinosaurs 
						ORDER BY dino_name ASC
					');
//var_dump($db->errorInfo());
//var_dump($results);

?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Dinosaurs!</title>
</head>

<body>

	<a href="add.php">Add a dinosaur!</a>
    
	<ul>
		<?php /*foreach ($results as $dino) {
                echo '<li>' . $dino['dino_name'] . '</li>';
              }*/
        ?>
        
        <?php foreach ($results as $dino) : ?>
        	<li>
            	<a href="single.php?id=<?php echo $dino['id']; ?>"><?php echo $dino['dino_name']; ?></a>
                &bull;
                <a href="edit.php?id=<?php echo $dino['id']; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $dino['id']; ?>">Delete</a>
            </li>
        <?php endforeach; ?>
	</ul>

</body>
</html>
