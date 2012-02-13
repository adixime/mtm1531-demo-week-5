<?php

require_once 'includes/filter-wrapper.php';

$errors = array();

$dino_name = filter_input(INPUT_POST, 'dino_name', FILTER_SANITIZE_STRING);
$period = filter_input(INPUT_POST, 'period', FILTER_SANITIZE_STRING);

if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
	if(empty($dino_name)) {
		$errors['dino_name'] = true;
	}
	if (empty($period)) {
		$errors['period'] = true;
	}
	if (empty($errors)) {
		require_once 'includes/db.php';
		
		$sql = $db->prepare('
			INSERT INTO dinosaurs (dino_name, period)
			VALUES (:dino_name, :period)
		');
		$sql->bindValue(':dino_name', $dino_name, PDO::PARAM_STR);
		$sql->bindValue(':period', $period, PDO::PARAM_STR);
		$sql->execute();
		
		header('Location: index.php');
		exit;
	}
}

?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Add a Dinosaur</title>
</head>

<body>

	<form method="post" action="add.php">
    	<div>
        	<label for="">Dinosaur Name:<?php if (isset($errors['dino_name'])) : ?> <strong>is required</strong><?php endif; ?></label>
            <input id="dino_name" name="dino_name" value="<?php echo $dino_name; ?>" required>
        </div>
        <div>
        	<label for="period">Period<?php if (isset($errors['period'])) : ?> <strong>is required</strong><?php endif; ?></label>
            <input id="period" name="period" value="<?php echo $period; ?>" required>
        </div>
        <button type="submit">Add</button>
    </form>

</body>
</html>