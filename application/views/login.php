<div class="logo-box">
    <img src="<?= base_url(); ?>assets/img/internal/logo.jpg"/>
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
                <input class="btn span12" type="submit" value="Login"/>
                <div class="text-error text-center"><?php echo validation_errors(); ?></div>
            </form>
        </div>
        <p class="text-right text-info">Beta 1.0</p>
    </div>
</div>
<br/>
<p class="text-center muted">Copyright GregKodikara.com</p>



