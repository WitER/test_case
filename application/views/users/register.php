<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Please Sign In</h3>
            </div>
            <div class="panel-body">
                <?php echo form_open(base_url('register'), ['method' => 'post']); ?>
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger"><?php echo validation_errors(); ?></div>
                    <?php endif; ?>
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="First name" name="first_name" type="text" value="<?php echo $user->first_name; ?>" autofocus required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Last name" name="last_name" type="text" value="<?php echo $user->last_name; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Day of birth</label>
                            <input class="form-control" placeholder="Day of birth" name="dob" type="date" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"  value="<?php echo $user->dob; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Sex</label>
                            <label class="radio-inline">
                                <input type="radio" name="sex" id="" value="0" <?php if ($user->sex == 0) : ?>checked=""<?php endif; ?>> No!
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="sex" id="" value="1" <?php if ($user->sex == 1) : ?>checked=""<?php endif; ?>> Male
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="sex" id="" value="2"> <?php if ($user->sex == 2) : ?>checked=""<?php endif; ?> Female
                            </label>
                        </div>
                        <div class="form-group">
                            <select class="form-control chosen-select" data-placeholder="Choose a country..." id="countries" placeholder="Country" name="country_id" required>
                                <option>Chose a country...</option>
                                <?php foreach ($countries as $country) : ?>
                                    <option value="<?php echo $country->id; ?>"><?php echo $country->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control chosen-select" data-placeholder="Choose a city..." id="cities" placeholder="City" name="city_id" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="E-mail" name="email" type="email" value="<?php echo $user->email; ?>" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
                        </div>
                        <!-- Change this to a button or input when using this as a form -->
                        <button type="submit" class="btn btn-lg btn-success btn-block">Register</button>
                        <a href="<?php echo base_url('login'); ?>" class="btn btn-md btn-primary btn-block">Log In</a>
                    </fieldset>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>