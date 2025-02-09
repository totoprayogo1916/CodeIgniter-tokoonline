<?php

use Totoprayogo\Lib\Cart;

$cart = new Cart();
?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?= anchor(base_url(), 'Toko Online', ['class' => 'navbar-brand']) ?>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right">
                <li><?php echo anchor(base_url(), 'Home'); ?></li>
                <li>
                    <?php
                    $text_cart_url  = '<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>';
                    $text_cart_url .= ' Inside Cart: ' . $cart->total_items() . ' items';
                    ?>
                    <?= anchor(route_to('cart.view'), $text_cart_url) ?>
                </li>
                <?php if (session('username')) { ?>
                    <li>
                        <div style="line-height:50px;">You Are : <?= session('username') ?></div>
                    </li>
                    <li><?php echo anchor(route_to('logout'), 'Logout'); ?></li>
                <?php } else { ?>
                    <li><?= anchor(route_to('login.view'), 'Login'); ?></li>
                <?php } ?>
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>