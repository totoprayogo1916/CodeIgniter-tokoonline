<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?= $this->include('layout/top_menu') ?>

<div class="container">

    <div><?php // validation_errors()
            ?></div>
    <div><?php //=session()->flashdata('error')
            ?></div>

    <?= form_open(route_to('login.auth'), ['class' => 'form-horizontal']) ?>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="username">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="password">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                    <input type="checkbox"> Remember me
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Sign in</button>
        </div>
    </div>
    <?= form_close() ?>

</div>

<?= $this->endSection() ?>
