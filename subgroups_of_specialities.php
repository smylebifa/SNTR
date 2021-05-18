<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf8">
  <title>Коды специальностей</title>
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
    $code_of_speciality = $_GET['code_of_speciality'];
    
    
  // Sql injection protection...
    sanitize_text_field($code_of_speciality);

    $sql_select = $wpdb->get_results($wpdb->prepare("
      SELECT DISTINCT НаучныеСпециальности.КодСпециальности2Уровень, КодыСпециальностей.НазваниеСпециальности
      FROM НаучныеСпециальности

      LEFT JOIN КодыСпециальностей
      ON НаучныеСпециальности.КодСпециальности2Уровень = КодыСпециальностей.КодСпециальности

      LEFT JOIN ГруппаСпециальностей
      ON НаучныеСпециальности.КодСпециальности1Уровень = ГруппаСпециальностей.КодСпециальности

      LEFT JOIN ПодгруппаСпециальностей
      ON НаучныеСпециальности.КодСпециальности1Уровень = ПодгруппаСпециальностей.КодСпециальности

      WHERE НаучныеСпециальности.КодСпециальности1Уровень = %s
      ORDER BY НаучныеСпециальности.КодСпециальности2Уровень ASC", [$code_of_speciality]));

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

      <p class="h4" style="text-align: center">Коды специальностей</p><br>
      <div class="table-responsive" style="overflow-y: auto; min-height:200px; max-height: 600px;">
      <figure class="wp-block-table">
      <table class="table table-hover table-bordered" style="text-align:center">
      <thead class="thead-dark">
      <tr>
      <th scope="col">Код специальности</th>
      <th scope="col">Название компетенции</th>
      </tr>
      </thead>
      <tbody>';

      foreach ($sql_select as $row) {
        echo '<tr> 
        <td> <a href="/competence_of_speciality.php?name_of_speciality=' . $row->НазваниеСпециальности . '" target="_blank">' . $row->КодСпециальности2Уровень . '</a></td>
        <td> <a href="/competence_of_speciality.php?name_of_speciality=' . $row->НазваниеСпециальности . '" target="_blank">' . $row->НазваниеСпециальности . '</a></td></tr>';
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
        <a href="/groups-of-specialities" role="button" style="
        text-decoration: none;
        background: #ff6a3e;
        border: medium none;
        color: #fff;
        border-radius: 50px;
        font-size: 15px;
        line-height: 1.5;
        padding: 12px 25px;
        text-transform: uppercase;
        font-weight: 500; font: inherit; cursor: pointer;">Области науки</a>
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