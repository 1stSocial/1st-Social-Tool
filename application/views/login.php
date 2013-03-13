<div class="logo-box">
    <img src="<?= base_url(); ?>assets/img/internal/logo.png"/>
</div>
<div class="login-box">
    <header><h4>Sign In</h4></header>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php echo form_open('verifylogin'); ?>
                <label for="username">Username:</label>
                <input class="span12" type="text" size="20" id="username" name="username"/>
                <br/>
                <label for="password">Password:</label>
                <input class="span12" type="password" size="20" id="password" name="password"/>
                <br/>
                <br/>
                <input class="btn btn-1st span12" type="submit" value="Login"/>
                <div class="text-error text-center"><?php echo validation_errors(); ?></div>
            </form>
        </div>
        <p class="text-right text-white">Beta 1.0</p>
    </div>
</div>
<br/>
<p class="text-center text-info">&#169; Copyright 1st Social 2013</p>



