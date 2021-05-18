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
    $keyword = $_GET['keyword'];
    
    
  // Sql injection protection...
    sanitize_text_field($keyword);

    if ($keyword === '') {
      $is_show = 0;
      echo '<p class="h4" align="center"><br><br><br><br>Вы не ввели ничего для поиска</p>';
    }

    else {
      $sql_select = $wpdb->get_results($wpdb->prepare("
        SELECT DISTINCT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна, 
        ЦентрыКомпетенций.НазваниеКомпетенции 
        FROM ЦентрыКомпетенций
        
        LEFT JOIN КодыКомпетенций
        ON ЦентрыКомпетенций.НазваниеКомпетенции = 
        КодыКомпетенций.НазваниеКомпетенции 
        
        LEFT JOIN КлючевыеСлова
        ON КодыКомпетенций.КодКомпетенции  = КлючевыеСлова.КодКомпетенции 
        
        LEFT JOIN Keywords
        ON КодыКомпетенций.КодКомпетенции  = Keywords.КодКомпетенции
        
        WHERE КлючевыеСлова.КлючевоеСлово = %s
        OR Keywords.Keyword = %s
        OR ЦентрыКомпетенций.НазваниеКомпетенции = %s", [$keyword, $keyword, $keyword]));

      if ($sql_select) {

        echo '
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

        <p class="h4" style="text-align: center">Центры компетенций</p><br>
        <div class="table-responsive" style="overflow-y: auto; min-height:200px; max-height: 600px;">
        <figure class="wp-block-table">
        <table class="table table-hover table-bordered" style="text-align:center">
        <thead class="thead-dark">
        <tr>
        <th scope="col">Название центра</th>
        <th scope="col">Страна</th>
        <th scope="col">Название компетенции</th>
        </tr>
        </thead>
        <tbody>';

        foreach ($sql_select as $row) {
          echo '<tr> 
          <td> <a href="/info_about_centers.php?name_of_center=' . $row->НазваниеЦентра . '" target="_blank">' . $row->НазваниеЦентра . '</a></td>
          <td> <a href="/centers_of_competence.php?country=' . $row->Страна . '&name_of_competency=&priority=" target="_blank">' . $row->Страна . '</a></td>
          <td> <a href="/centers_of_competence.php?country=&name_of_competency=' . $row->НазваниеКомпетенции . '&priority=" target="_blank">' . $row->НазваниеКомпетенции . '</a></td></tr>';
        }

        echo '
        </tbody>
        </table>
        </figure>
        </div>
        </div>
        </div>
        ';

      }

      else {
        echo '<p class="h4" align="center"><br><br><br><br>Записей не найдено</p>';
      }

    }

    ?>

    

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