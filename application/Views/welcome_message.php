<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?= $this->include('layout/top_menu') ?>

<div class="container">

    <!-- Tampilkan semua produk -->
    <div class="row">
        <!-- looping products -->
        <?php foreach ($products as $product) : ?>
            <div class="col-sm-3 col-md-3">
                <div class="thumbnail">
                    <?= img([
                        'src'   => 'uploads/' . $product->image,
                        'style' => 'max-width: 100%; max-height:100%; height:100px'
                    ]) ?>
                    <div class="caption">
                        <h3 style="min-height:60px;"><?= $product->name ?></h3>
                        <p><?= $product->description ?></p>
                        <p>
                            <?= anchor(route_to('cart.add', $product->id), 'Buy', [
                                'class' => 'btn btn-primary',
                                'role'  => 'button'
                            ]) ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <!-- end looping -->
    </div>
</div>

<?= $this->endSection() ?>
