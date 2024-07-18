<?php
include_once "data/DbData.php";
@session_start();
$data = new DbData();

?>
<!doctype html>
<html>

<head>
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
  <!--Import Google Icon Font-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WebStore</title>
  <link rel="stylesheet" href="/css/site.css" />
</head>

<body>

  <header>
    <div class="container grey darken-3">
      <div class="row subdiv-nav">
        <div class="col s3 m3 ">
          <a href="/" class="brand-logo left"><img src="/img/webshop-logo.png" /></a>
        </div>
        <div class="col s12 m6 ">
          <div class="div-search orange darken-3">
            <!-- <i class="material-icons prefix icon-search ">search</i> -->
            <input id="search-input" type="text" class="validate white search-input">
            <a href="" class="waves-effect waves-light orange darken-3 material-icons button-search"><i class="material-icons white-text">search</i></a>
          </div>
        </div>
        <div class="col s12 m3 ">
          <ul class="hr right">
          <li class="basket_li_quant">
              <?php
              if (isset($_SESSION['user'])) {
                $basketItemsCount = $data->countBasketItems($_SESSION['user']['id']);
                if ($basketItemsCount != 0) {
              ?>
                  <div class="orange darken-3 div_quant">
                    <span><?= $basketItemsCount ?></span>
                  </div>
              <?php }
              }else {
                if(isset($_SESSION['tempBasket'])){
                  if(count($_SESSION['tempBasket']) > 0){ ?>

                  <div class="orange darken-3 div_quant">
                    <span><?= count($_SESSION['tempBasket']) ?></span>
                  </div>

                 <?php }
              } }?>
              <a href="/basketview"><i class="material-icons white-text header_icons">shopping_cart</i></a>
            </li>
            <?php
            if (isset($_SESSION['user'])) { ?>
              <li><a class="dropdown-trigger circle-image" data-target="dropdownUserAuth"><img src="/avatar/<?= $_SESSION['user']["avatar"] ?>"></a></li>
            <?php } else {
              echo ('<li><a href="#auth-modal" class="modal-trigger"><i class="material-icons white-text header_icons">person_outline</i></a></li>');
            }
            ?>
            <!-- <li><a href="/cabinet"><i class="material-icons white-text">person_add</i></a></li> -->
           
            <!-- <li><a href="/api"><i class="material-icons white-text">table_chart</i></a></li> -->
          </ul>
        </div>
      </div>
    </div>
    </div>

    <main class="container">
      <?php include $page_body; ?>
      </div>

      <footer>
        <div class="container">
          <div class="footerLine">

          </div>
          <div class="row">
            <div class="col s12 m3 l2">
              <a href="/" class="brand-logo left"><img src="/img/webshop-logo.png" /></a>
            </div>
            <div class="col s12 m3 l3 push-l2 headerSpanDiv">
              <span>Час роботи Call-центру</span>
              <span>Пн.-Пт.: 08:00 - 22:00</span>
              <span>Сб.: 09:00 - 20:00</span>
              <span>Нд.: 09:00 - 19:00</span>
            </div>
            <div class="col s12 m3 l4 push-l3 headerSpanDiv">
              <span>Тел.+ 38 (044) 111-11-11</span>
              <span>e-mail: <a href="#"> info@WebStore.ua</a></span>
              <span>© 2008-2024 Інтернет-магазин «WebStore»</span>
              <span>Знак на товари і послуги WebStore використовується </span>
              <span>на підставі ліцензійного договору з правовласником знака</span>
            </div>
          </div>
        </div>
      </footer>


      <!-- Modal Structure -->
      <?php
      if (isset($_SESSION['user'])) {
        echo ('
    <ul id="dropdownUserAuth" class="dropdown-content">
      <li><a href="/cabinet"><i class="material-icons">other_houses</i>Кабінет</a></li>
      <li class="divider" tabindex="1"></li>
      <li><a id="signout-button"><i class="material-icons">logout</i>Вийти</a></li>
    </ul>
    ');
      }
      ?>
      <div id="auth-modal" class="modal login-wind modal-login">
        <div class="col s12" method="post" asp-action="/">
          <div class="modal-content mymodel">
            <h4 class="mymodel center-align"><span class="teal-text">LOG IN</span></h4>
            <div class="input-field col s6">
              <i class="material-icons prefix">email</i>
              <input id="user-input-email" type="text" class="validate" name="auth-email">
              <label for="user-input-email">Email</label>
            </div>
            <div class="input-field col s6">
              <i class="material-icons prefix">lock</i>
              <input id="user-input-password" type="password" class="validate" name="auth-password">
              <label for="user-input-password">Password</label>
            </div>
            <button class="btn-flat teal waves-light button-ligin-enter white-text" id="auth-button">Вхід</button>
            <button class="modal-close btn-floating grey button-ligin-exit material-icons">close</button>
            <div class="registr-button">
              <a href="/signup">Зареєструватися</a>
            </div>
          </div>
        </div>
      </div>


      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
      <script src="/js/site.js"></script>

</body>

</html>