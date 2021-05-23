<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

<style>
  input[type="button"]:not(.default), input[type="submit"]:not(.default) {
   -webkit-border-radius: 3px;
   -webkit-background-clip: padding-box;
   -moz-border-radius: 3px;
   -moz-background-clip: padding;
   border-radius: 3px;
   background-clip: padding-box;
   -webkit-transition: color 0.2s ease, border 0.2s ease, background 0.2s ease, -webkit-box-shadow 0.2s ease;
   -moz-transition: color 0.2s ease, border 0.2s ease, background 0.2s ease, -moz-box-shadow 0.2s ease;
   -o-transition: color 0.2s ease, border 0.2s ease, background 0.2s ease, box-shadow 0.2s ease;
   transition: color 0.2s ease, border 0.2s ease, background 0.2s ease, box-shadow 0.2s ease;
   position: relative;
   margin: 0 7px;
   display: inline-block;
   min-width: 144px;
   max-width: 100%;
   padding: 15px 25px;
   font-family: "Arial", "Helvetica Neue", Arial, Helvetica, sans-serif;
   font-size: 14px;
   font-weight: 600;
   text-transform: uppercase;
   line-height: 1;
   border-width: 1px;
   border-style: solid;
   background-color: steelblue;
   color: #ddd;
 }
 .form {
   zoom: 1;
   display: block;
   width: auto;
   padding: 25px 0 0;
 }
 .form:before,
 .form:after {
   content: "";
   display: table;
 }
 .form:after {
   clear: both;
 }
 .form .form-group {
   zoom: 1;
   position: relative;
   margin-bottom: 25px;
 }
 .form .form-group:before,
 .form .form-group:after {
   content: "";
   display: table;
 }
 .form .form-group:after {
   clear: both;
 }
 .form .form-group:after {
   content: '';
   display: block;
   clear: both;
 }
 .form .form-group[class*="col-"] input[type=text],
 .form .form-group[class*="col-"] input[type=email],
 .form .form-group[class*="col-"] input[type=password] {
   display: inline-block;
   width: 100%;
   min-width: 0;
   max-width: 100%;
 }
 .form .form-control {
   -webkit-border-radius: 0;
   -webkit-background-clip: padding-box;
   -moz-border-radius: 0;
   -moz-background-clip: padding;
   border-radius: 0;
   background-clip: padding-box;
   -webkit-box-shadow: none;
   -moz-box-shadow: none;
   box-shadow: none;
   height: auto;
   font-size: 17px;
   font-weight: 300;
   background-color: #ffffff;
   border-style: solid;
   border-width: 1px 1px 1px 3px;
   border-top-color: #d7d7d7;
   border-right-color: #d7d7d7;
   border-bottom-color: #d7d7d7;
 }
 input[type=text],
 input[type=email],
 input[type=password] {
   -webkit-transition: color 0.2s ease, background 0.3s ease;
   -moz-transition: color 0.2s ease, background 0.3s ease;
   -o-transition: color 0.2s ease, background 0.3s ease;
   transition: color 0.2s ease, background 0.3s ease;
   -webkit-border-radius: 0;
   -webkit-background-clip: padding-box;
   -moz-border-radius: 0;
   -moz-background-clip: padding;
   border-radius: 0;
   background-clip: padding-box;
   -webkit-box-shadow: none;
   -moz-box-shadow: none;
   box-shadow: none;
   margin: 0;
   vertical-align: top;
   display: inline-block;
   width: 100%;
   font-size: 17px;
   color: #8d8d8d;
   background-color: #ffffff;
   border-style: solid;
   border-width: 1px 1px 1px 3px;
   border-top-color: #d7d7d7;
   border-right-color: #d7d7d7;
   border-bottom-color: #d7d7d7;
   outline: none;
 }
 input[type=text]:hover,
 input[type=email]:hover,
 input[type=password]:hover {
   color: #000000;
 }
 input[type=text]:focus,
 input[type=email]:focus,
 input[type=password]:focus {
   outline: none;
   border-left-color: steelblue;
 }
 .well h3 {
   text-shadow: -1px -1px #FFF, -2px -2px #FFF, -1px 1px #FFF, -2px 2px #FFF, 1px 1px #FFF, 2px 2px #FFF, 1px -1px #FFF, 2px -2px #FFF, -3px -3px 2px #BBB, -3px 3px 2px #BBB, 3px 3px 2px #BBB, 3px -3px 2px #BBB;
   color: steelblue;
   transition: all 1s;
 }
</style>

<?php  
$args = array(  
  'redirect' => home_url(),   
  'id_username' => 'user',  
  'id_password' => 'pass',  
)   
;?> 

<div class="container">

  <div class="row">
    <div class="col-12"><p></p></div>
  </div>

  <div class="row">
    <div class="col-12"><p></p></div>
  </div>

  <div class="row">  
   <div class="col-md-6 col-md-offset-3 well">
     <h3 class="text-center">Авторизация</h3>
     <form name="loginform" class="form" id="loginform" action="/wp-login.php" method="post">

       <div class="col-xs-12">
         <div class="form-group">

          <p class="login-username">
            <label for="user_login">Логин</label>

            <input type="text" class="form-control" placeholder="Введите Имя" name="log" id="user_login" class="input" value="" size="20" tabindex="10" />
          </p>

        </div>
      </div>

      <div class="col-xs-12">
       <div class="form-group">

        <p class="login-password">
          <label for="user_pass">Пароль</label>
          <input type="password" class="form-control" placeholder="Введите пароль" name="pwd" id="user_pass" class="input" value="" size="20" tabindex="20" />
        </p>

      </div>
    </div>

    <div class="col-xs-12">
     <div class="form-group">

      <p class="login-remember"><label><input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90" /> Запомнить меня</label>
      </p>

    </div>
  </div>


  <div class="text-center col-xs-12">

    <p class="login-submit">
      <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-default" value="Войти" tabindex="100" />
      <input type="hidden" name="redirect_to" value="http://wp-kama.ru/s" />
    </p>

  </div>

</form>

</div>
</div>
</div>