<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Please Sign In</h3>
            </div>
            <div class="panel-body">
                <?php echo form_open(base_url('login'), ['method' => 'post']); ?>
                    <?php if (!empty($message)) : ?>
                        <div class="alert alert-danger"><?php echo $message; ?></div>
                    <?php endif; ?>
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="E-mail" name="email" type="email" value="<?php echo $email; ?>" autofocus required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
                        </div>
                        <!-- Change this to a button or input when using this as a form -->
                        <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                        <a href="<?php echo base_url('register'); ?>" class="btn btn-md btn-primary btn-block">Register</a>
                    </fieldset>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>