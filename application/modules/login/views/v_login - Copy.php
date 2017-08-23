<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 	 <link rel="shortcut icon" href="<?php echo base_url();?>asset/images/favicon.ico">


    <title>Login Page</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    <!-- uikit -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/bower_components/uikit/css/uikit.almost-flat.min.css"/>

    <!-- altair admin login page -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/assets/css/login_page.min.css" />

<style>
.md-card-list-item-avatar{
	border-radius:100%;
	padding:0px 8px 0px 8px;
}
.txtcaptcha{
	line-height:30px;
}
.txtcaptcha:focus{
	border:2px #39C solid;
	padding:2px;
}
</style>
</head>
<body class="login_page">

    <div class="login_page_wrapper">
        <div class="md-card" id="login_card">
            <div class="md-card-content large-padding" id="login_form">
                <div class="login_heading">
                    <div class="user_avatar"><img src="<?php echo base_url();?>asset/images/user.png" height="250" width="250"></div>
                </div>
                <form method="post" action="<?php echo base_url();?>login/Login/cek_login">
  <div class="uk-form-row">
 <h2 align="center">Login </h2>
  </div>
                    <div class="uk-form-row">
                        <label for="login_username">Username</label>
                        <input class="md-input" type="text" id="login_username" name="usr" required />
                    </div>
                    <div class="uk-form-row">
                        <label for="login_password">Password</label>
                        <input class="md-input" type="password" id="login_password" name="psw" required />
                    </div>
                    
<div class="uk-form-row">
                        <label for="login_password"></label>
     <p align="center"><?php echo $image;?></p>
     <p align="center"> <input name="txtcaptcha" placeholder="Type captcha above" required id="txtcaptcha" class="txtcaptcha"></p>
     <p align="center" style="color:#FC0">Use a Capital Letter</p> 
 
 
<!-- CAPTCHA GOOGLE-->
<div class="uk-form-row">
<?php
    $site_key = '6Lf2BC0UAAAAAHyE392Tif6AFzThAu2z2th3DDY8';
    $secret_key = '6Lf2BC0UAAAAANEmZj2zYS5Y1EsA59dlher98Trb';

?>
<div class="g-recaptcha" data-sitekey="<?php echo $site_key; ?>"></div>
</div>

<!-- END CAPTCHA GOOGLE-->    
   
                    </div>

                    
 
<p style="color:red"><?php echo isset($message)?$message:'' ;?></p>
                    <div class="uk-margin-medium-top">
                        <input name="btnlogin" type="submit" value="Login" class="md-btn md-btn-primary md-btn-block md-btn-large">
                    </div>
                    <div class="uk-margin-top">
                   
                        <!-- <span class="icheck-inline">
                            <input type="checkbox" name="login_page_stay_signed" id="login_page_stay_signed" data-md-icheck />
                           <label for="login_page_stay_signed" class="inline-label">Stay signed in</label>
                        </span> -->
                    </div>
                </form>
            </div>
            <div class="md-card-content large-padding uk-position-relative" id="login_help" style="display: none">
                <button type="button" class="uk-position-top-right uk-close uk-margin-right uk-margin-top back_to_login"></button>
                <h2 class="heading_b uk-text-success">Can't log in?</h2>
                <p>Here’s the info to get you back in to your account as quickly as possible.</p>
                <p>First, try the easiest thing: if you remember your password but it isn’t working, make sure that Caps Lock is turned off, and that your username is spelled correctly, and then try again.</p>
                <p>If your password still isn’t working, it’s time to <a href="#" id="password_reset_show">reset your password</a>.</p>
            </div>
            <div class="md-card-content large-padding" id="login_password_reset" style="display: none">
                <button type="button" class="uk-position-top-right uk-close uk-margin-right uk-margin-top back_to_login"></button>
                <h2 class="heading_a uk-margin-large-bottom">Reset password</h2>
                <form>
                    <div class="uk-form-row">
                        <label for="login_email_reset">Your email address</label>
                        <input class="md-input" type="text" id="login_email_reset" name="login_email_reset" />
                    </div>
                    <div class="uk-margin-medium-top">
                        <a href="index.html" class="md-btn md-btn-primary md-btn-block">Reset password</a>
                    </div>
                </form>
            </div>
            <div class="md-card-content large-padding" id="register_form" style="display: none">
                <button type="button" class="uk-position-top-right uk-close uk-margin-right uk-margin-top back_to_login"></button>
                <h2 class="heading_a uk-margin-medium-bottom">Create an account</h2>
                <form>
                    <div class="uk-form-row">
                        <label for="register_username">Username</label>
                        <input class="md-input" type="text" id="register_username" name="register_username" />
                    </div>
                    <div class="uk-form-row">
                        <label for="register_password">Password</label>
                        <input class="md-input" type="password" id="register_password" name="register_password" />
                    </div>
                    <div class="uk-form-row">
                        <label for="register_password_repeat">Repeat Password</label>
                        <input class="md-input" type="password" id="register_password_repeat" name="register_password_repeat" />
                    </div>
                    <div class="uk-form-row">
                        <label for="register_email">E-mail</label>
                        <input class="md-input" type="text" id="register_email" name="register_email" />
                    </div>
                    <div class="uk-margin-medium-top">
                        <a href="index.html" class="md-btn md-btn-primary md-btn-block md-btn-large">Sign Up</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="uk-margin-top uk-text-center">
            
        </div>
    </div>

    <!-- common functions -->
    <script src="<?php echo base_url();?>asset/assets/js/common.min.js"></script>
    <!-- altair core functions -->
    <script src="<?php echo base_url();?>asset/assets/js/altair_admin_common.min.js"></script>

    <!-- altair login page functions -->
    <script src="<?php echo base_url();?>asset/assets/js/pages/login.min.js"></script>

    <!-- Memuat API Google reCaptcha -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    
    
</body>
</html>