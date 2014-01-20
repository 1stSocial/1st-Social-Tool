<div class="container">
<div class="login">
    <div class="login-screen">
     <div class="login-icon">
            <img src="<?= base_url(); ?>assets/img/internal/logo.png"/>
        </div>
        <div class="login-form">
            <?php echo form_open('verifylogin'); ?>
            <div class="form-group">
                <span class="label label-default">Username:</span>
                <!--<label for="username">Username:</label>-->
                <input class="form-control login-field" type="text" size="20" id="username" name="username"/>
                <label class="login-field-icon fui-user" for="login-name"></label>
             </div>
            <div class="form-group">
               <span class="label label-default">Password :</span>
                <input class="form-control login-field" type="password" size="20" id="password" name="password"/>
                <label class="login-field-icon fui-lock" for="login-pass"></label>
           </div>
                <input class="btn btn-primary btn-lg btn-block" type="submit" value="Login"/>
                <div class="text-error text-center"><?php echo validation_errors(); ?></div>
            </form>
            <p class="text-center text-info">&#169; Copyright 1st Social 2013</p>
        </div>
        <p class="text-right text-white">Beta 1.0</p>
    </div>
</div>
</div>




