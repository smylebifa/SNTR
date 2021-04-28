<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf8">
  <title>Информация по центрам</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="/styles.css">
</head>

<body>
  <div class="container">

    <div class="row">
      <div class="col-12"><p></p></div>
    </div>
    
    <div class="row">
      <div class="col-12"><p></p></div>
    </div>
    
    <?php

    require_once('wp-load.php');

    global $wpdb;

              // $wpdb->show_errors(true);

              // If connecting is failed, show message...
    if(!empty($wpdb->error)) echo 'Connection is failed';


              // Getting params from user entering in form...
    $name = $_GET['name'];

              // Sql injection protection...
    sanitize_text_field($name);


    if ($name === '') {
      echo '<p class="h4" align="center"><br><br><br><br>Вы не ввели ничего для поиска</p>';
    }

                    // 0001
                    // Поиск по приоритету...
    else {
      $sql_select = $wpdb->get_results($wpdb->prepare("
        SELECT НазваниеЦентра, Страна, Руководители, Компетенции, Описание, 
        ОсновныеКлиентыИПартнеры, ПатентнаяАктивность, ПубликационнаяАктивность, 
        Бенчмаркинг, ОбщееЧислоСотрудников, ВедущиеСпециалисты, СтруктураКомпании
        FROM ИнформацияПоЦентрам
        WHERE НазваниеЦентра = %s", $name));

      echo '
      <div class="row">
      <div class="col-6">
      <div class="search_box">
      <fieldset style="text-align: left">
      <form method="get" action="/competence_district.php">
      
      <div class="search_box">
      <label for="district_label">Федеральный округ:</label><br>
      <input type="text" placeholder="Название округа" id="district" name="district" size="20"><br>
      <div id="search_box-district-result"></div>
      
      <label for="region_label">Регион:</label><br>
      <input type="text" placeholder="Название региона" id="region" name="region" size="20"><br><br>
      <div id="search_box-region-result"></div>
      
      <input type="text" style="display:none;" value="' . $name . '" name="name">

      
      <input id="submit" type="submit" value="Найти и вывести" style="
      text-decoration: none;
      background: #ff6a3e;
      border: medium none;
      color: #fff;
      border-radius: 50px;
      font-size: 15px;
      line-height: 1.5;
      padding: 12px 25px;
      text-transform: uppercase;
      font-weight: 500; font: inherit; cursor: pointer;"><br>
      
      </div>
      </form>
      </fieldset>
      </div>
      
      </div>
      
      <div class="col-6">
      <div class="search_box">
      <fieldset style="text-align: right">
      <form method="get" action="/compet_choose_by_keyword.php">
      <label for="keyword_label">Поиск центров по ключевому слову:</label><br>
      <input type="text" placeholder="Ключевое слово" id="keyword" name="keyword" size="20"><br><br>
      <div id="search_box-keyword-result"></div>
      <input id="submit" type="submit" value="Найти и вывести" style = "
      text-decoration: none;
      background: #ff6a3e;
      border: medium none;
      color: #fff;
      border-radius: 50px;
      font-size: 15px;
      line-height: 1.5;
      padding: 12px 25px;
      text-transform: uppercase;
      font-weight: 500; font: inherit; cursor: pointer;"><br>

      </form>
      </fieldset>
      </div>
      
      </div>
      </div>
      
      
      <div class="row">
      <div class="col-12"><p></p></div>
      </div>
      
      <div class="row">
      <div class="col-12"><p></p></div>
      </div>
      
      <div class="row">
      <div class="col-12"><p></p></div>
      </div>
      
      
      <div class="row">

      <div class="col-12">

      <p class="h4" style="text-align: center">Информация по центрам компетенций</p><br>
      <div class="table-responsive">
      <figure class="wp-block-table">
      <table class="table table-hover table-bordered" style="text-align:center">
      <tbody>';


      foreach ($sql_select as $row) {
        echo '
        <tr>
        <td>НазваниеЦентра</td><td>' . $row->НазваниеЦентра . '</td>
        </tr><tr>
        <td>Страна</td><td>' . $row->Страна . '</td>
        </tr><tr>
        <td>Руководители</td><td>' . $row->Руководители . '</td>
        </tr><tr>
        <td>Компетенции</td><td>' . $row->Компетенции . '</td>
        </tr><tr>
        <td>Описание</td><td>' . $row->Описание . '</td>
        </tr><tr>
        <td>ОсновныеКлиентыИПартнеры</td><td>' . $row->ОсновныеКлиентыИПартнеры . '</td>
        </tr><tr>
        <td>ПатентнаяАктивность</td><td>' . $row->ПатентнаяАктивность . '</td>
        </tr><tr>
        <td>ПубликационнаяАктивность</td><td>' . $row->ПубликационнаяАктивность . '</td>
        </tr><tr>
        <td>Бенчмаркинг</td><td>' . $row->Бенчмаркинг . '</td>
        </tr><tr>
        <td>ОбщееЧислоСотрудников</td><td>' . $row->ОбщееЧислоСотрудников . '</td>
        </tr><tr>
        <td>ВедущиеСпециалисты</td><td>' . $row->ВедущиеСпециалисты . '</td>
        </tr><tr>
        <td>СтруктураКомпании</td><td>' . $row->СтруктураКомпании . '</td>
        </tr></tr>';
      }
    }

    ?>
    
  </tbody>
</table>
</figure>
</div>
</div>
</div>


<div class="row">
  <div class="col-12"><p></p></div>
</div>

<div class="row">
  <div class="col-12"><p></p></div>
</div>

<div class="row">
  <div class="col-3"></div>
  <div class="col-6" style="text-align:center">
    <a href="/search-centers" role="button" style="
    text-decoration: none;
    background: #ff6a3e;
    border: medium none;
    color: #fff;
    border-radius: 50px;
    font-size: 15px;
    line-height: 1.5;
    padding: 12px 25px;
    text-transform: uppercase;
    font-weight: 500; font: inherit; cursor: pointer;">Поиск центров компетенций</a>
  </div>
  <div class="col-3"></div>
</div>

<div class="row">
  <div class="col-12"><p><br><br></p></div>
</div>

<script src="https://snipp.ru/cdn/jquery/2.1.1/jquery.min.js"></script>
<script src="/tooltip.js"></script>

</body>
</html>