<?php

use Totoprayogo\Lib\Cart;

$cart = new Cart();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Front-End Toko Online by Kursus-PHP.com</title>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</head>

<body>
	<?= view('layout/top_menu') ?>

	<div class="container">

		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Product</th>
					<th>Qty</th>
					<th>Price</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 0;
				foreach ($cart->contents() as $items) :
					$i++;
				?>
					<tr>
						<td><?= $i ?></td>
						<td><?= $items['name'] ?></td>
						<td><?= $items['qty'] ?></td>
						<td align="right"><?= number_format($items['price'], 0, ',', '.') ?></td>
						<td align="right"><?= number_format($items['subtotal'], 0, ',', '.') ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<td align="right" colspan="4">Total </td>
					<td align="right"><?= number_format($cart->total(), 0, ',', '.'); ?></td>
				</tr>
			</tfoot>
		</table>
		<div align="center">
			<?= anchor(route_to('cart.clear'), 'Clear Cart', ['class' => 'btn btn-danger']) ?>
			<?= anchor('/', 'Continue Shopping', ['class' => 'btn btn-primary']) ?>
			<?= anchor('order', 'Check Out', ['class' => 'btn btn-success']) ?>
		</div>

	</div>
</body>

</html>