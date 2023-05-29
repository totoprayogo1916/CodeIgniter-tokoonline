<!DOCTYPE html>
<html lang="en">

<head>
	<title><?= esc($title ?? 'Toko Online CodeIgniter4') ?></title>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</head>

<body>

    <?= $this->renderSection('content') ?>

</body>

</html>
