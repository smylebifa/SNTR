<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf8">
  <title>Центры компетенций</title>
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
    $competence_dev = $_GET['competence_dev'];
    $competence_apply = $_GET['competence_apply'];
    $competence_service = $_GET['competence_service'];

              // Sql injection protection...
    sanitize_text_field($competence_dev);
    sanitize_text_field($competence_apply);
    sanitize_text_field($competence_service);


        // Проверяем, заполнил ли пользователь какие-нибудь поля...
    $is_show = 1;

    if ($competence_dev === '') {

      if ($competence_apply === '') {

                    // Ничего не было введено...
        if ($competence_service === '') {
          $is_show = 0;
          echo '<p class="h4" align="center"><br><br><br><br>Вы не ввели ничего для поиска</p>';
        }

              // 001
        else {
          $sql_select = $wpdb->get_results($wpdb->prepare("
            SELECT DISTINCT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна, ЦентрыКомпетенций.НазваниеКомпетенции, КодыКомпетенций.КодКомпетенции
            FROM ЦентрыКомпетенций

            INNER JOIN КодыКомпетенций
            ON ЦентрыКомпетенций.НазваниеКомпетенции = КодыКомпетенций.НазваниеКомпетенции

            INNER JOIN ОквэдВЧастиПредоставленияУслуг
            ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиПредоставленияУслуг.КодКомпетенции
            WHERE КодыКомпетенций.КодКомпетенции = %s", $competence_service));
        }

      }

      
      else {

              // 010
        if ($competence_service === '') 
        {
          $sql_select = $wpdb->get_results($wpdb->prepare("
            SELECT DISTINCT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна, ЦентрыКомпетенций.НазваниеКомпетенции, КодыКомпетенций.КодКомпетенции
            FROM ЦентрыКомпетенций

            INNER JOIN КодыКомпетенций
            ON ЦентрыКомпетенций.НазваниеКомпетенции = КодыКомпетенций.НазваниеКомпетенции

            INNER JOIN ОквэдВЧастиПрименения
            ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиПрименения.КодКомпетенции
            WHERE КодыКомпетенций.КодКомпетенции = %s", $competence_apply));
        }

              // 011
        else 
        {
         $sql_select = $wpdb->get_results($wpdb->prepare("
          SELECT DISTINCT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна, ЦентрыКомпетенций.НазваниеКомпетенции, КодыКомпетенций.КодКомпетенции
          FROM ЦентрыКомпетенций

          INNER JOIN КодыКомпетенций
          ON ЦентрыКомпетенций.НазваниеКомпетенции = КодыКомпетенций.НазваниеКомпетенции

          INNER JOIN ОквэдВЧастиПрименения
          ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиПрименения.КодКомпетенции
          INNER JOIN ОквэдВЧастиПредоставленияУслуг
          ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиПредоставленияУслуг.КодКомпетенции
          WHERE КодыКомпетенций.КодКомпетенции = %s
          AND КодыКомпетенций.КодКомпетенции = %s", [$competence_service, $competence_apply]));
       }

     }

   }

          // 100
   else {

    if ($competence_apply === '') {

              // Ничего не было введено...
      if ($competence_service === '') {
        $sql_select = $wpdb->get_results($wpdb->prepare("
          SELECT DISTINCT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна, ЦентрыКомпетенций.НазваниеКомпетенции, КодыКомпетенций.КодКомпетенции
          FROM ЦентрыКомпетенций

          INNER JOIN КодыКомпетенций
          ON ЦентрыКомпетенций.НазваниеКомпетенции = КодыКомпетенций.НазваниеКомпетенции

          INNER JOIN ОквэдВЧастиРазработки
          ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиРазработки.КодКомпетенции
          WHERE КодыКомпетенций.КодКомпетенции = %s", $competence_dev));
      }

              // 101
      else {
        $sql_select = $wpdb->get_results($wpdb->prepare("
          SELECT DISTINCT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна, ЦентрыКомпетенций.НазваниеКомпетенции, КодыКомпетенций.КодКомпетенции
          FROM ЦентрыКомпетенций

          INNER JOIN КодыКомпетенций
          ON ЦентрыКомпетенций.НазваниеКомпетенции = КодыКомпетенций.НазваниеКомпетенции

          INNER JOIN ОквэдВЧастиРазработки
          ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиРазработки.КодКомпетенции
          INNER JOIN ОквэдВЧастиПредоставленияУслуг
          ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиПредоставленияУслуг.КодКомпетенции
          WHERE КодыКомпетенций.КодКомпетенции = %s
          AND КодыКомпетенций.КодКомпетенции = %s", [$competence_dev, $competence_service]));
      }

    }

    
    else {

              // 110
      if ($competence_service === '') 
      {
        $sql_select = $wpdb->get_results($wpdb->prepare("
          SELECT DISTINCT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна, ЦентрыКомпетенций.НазваниеКомпетенции, КодыКомпетенций.КодКомпетенции
          FROM ЦентрыКомпетенций

          INNER JOIN КодыКомпетенций
          ON ЦентрыКомпетенций.НазваниеКомпетенции = КодыКомпетенций.НазваниеКомпетенции

          INNER JOIN ОквэдВЧастиРазработки
          ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиРазработки.КодКомпетенции
          INNER JOIN ОквэдВЧастиПрименения
          ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиПрименения.КодКомпетенции
          WHERE КодыКомпетенций.КодКомпетенции = %s
          AND КодыКомпетенций.КодКомпетенции = %s", [$competence_dev, $competence_apply]));
      }

              // 111
      else 
      {
        $sql_select = $wpdb->get_results($wpdb->prepare("
          SELECT DISTINCT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна, ЦентрыКомпетенций.НазваниеКомпетенции, КодыКомпетенций.КодКомпетенции
          FROM ЦентрыКомпетенций

          INNER JOIN КодыКомпетенций
          ON ЦентрыКомпетенций.НазваниеКомпетенции = КодыКомпетенций.НазваниеКомпетенции

          INNER JOIN ОквэдВЧастиРазработки
          ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиРазработки.КодКомпетенции
          INNER JOIN ОквэдВЧастиПрименения
          ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиПрименения.КодКомпетенции
          INNER JOIN ОквэдВЧастиПредоставленияУслуг
          ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиПредоставленияУслуг.КодКомпетенции
          WHERE КодыКомпетенций.КодКомпетенции = %s
          AND КодыКомпетенций.КодКомпетенции = %s
          AND КодыКомпетенций.КодКомпетенции = %s", [$competence_dev, $competence_apply, $competence_service]));
      }

    }

  }




  if ($is_show === 1) {


    echo '
    <div class="row">
    <div class="col-6">
    <div class="search_box">
    <fieldset style="text-align: left">
    <form method="get" action="/competence_district.php">
    <div class="search_box">
    <label for="disrtict_label">Федеральный округ:</label><br>
    <input type="text" placeholder="Название округа" id="district" name="district" size="20"><br>
    <div id="search_box-district-result"></div>
    
    <label for="region_label">Регион:</label><br>
    <input type="text" placeholder="Название региона" id="region" name="region" size="20"><br><br>
    <div id="search_box-region-result"></div>
    
    <input type="text" style="display:none;" value="' . $name . '" name="name">
    <input type="text" style="display:none;" value="' . $competence . '" name="competence">
    <input type="text" style="display:none;" value="' . $country . '" name="country">
    <input type="text" style="display:none;" value="' . $priority . '" name="priority">
    
    
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


    <p class="h4" style="text-align:center">Центры компетенций</p><br>
    <div class="table-responsive">
    <figure class="wp-block-table">
    <table class="table table-hover table-bordered" style="text-align:center">
    <thead class="thead-dark">
    <tr>
    <th scope="col">Название центра</th>
    <th scope="col">Страна</th>
    <th scope="col">Компетенция</th>
    </tr>
    </thead>
    <tbody>';


    foreach ($sql_select as $row) {
      echo '<tr> 
      <td> <a href="/compet_choose.php?name=' . $row->НазваниеЦентра . '&competency=&country=&priority=">' . $row->НазваниеЦентра . '</a></td>
      <td> <a href="/compet_choose.php?name=&country=' . $row->Страна . '&competency=&priority=">' . $row->Страна . '</a></td>
      <td> <a href="/compet_choose.php?name=&country=&competency=' . $row->НазваниеКомпетенции . '&priority=">' . $row->НазваниеКомпетенции . '</a></td></tr>';
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