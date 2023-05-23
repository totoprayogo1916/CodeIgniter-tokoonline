<!doctype html>
<html>

<head>
	<title>Admin Page | Edit Product</title>
	<!-- Load JQuery dari CDN -->
	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>

	<!-- Load Bootstrap dari CDN -->
	<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
</head>

<body>
	<div class="container">
		<!-- dalam div row harus ada col yang maksimum nilainya 12 -->
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<h1>Edit Product</h1>
				
				<?= form_open_multipart(route_to('admin.product.update', $product->id), ['class' => 'form-horizontal'], ['id' => $product->id]) ?>

				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Product Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="name" placeholder="" value="<?= set_value('name', $product->name) ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Description</label>
					<div class="col-sm-10">
						<textarea class="form-control" name="description"><?= set_value('description', $product->description) ?></textarea>
					</div>
				</div>

				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Price</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="price" placeholder="" value="<?= set_value('price', $product->price) ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Available Stock</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="stock" placeholder="" value="<?= set_value('stock', $product->stock) ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Product Image</label>
					<div class="col-sm-10">
						<input type="file" class="form-control" name="userfile">
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default">Save</button>
					</div>
				</div>

				<?= form_close() ?>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>

</body>

</html>