<?php

use Totoprayogo\Lib\Cart;

$cart = new Cart();
?>

<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?= $this->include('layout/top_menu') ?>

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

<?= $this->endSection() ?>
