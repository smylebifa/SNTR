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

    // Подключение файла для обращения к базе данных...
    require_once('wp-load.php');

    global $wpdb;

    // Метод для отображения ошибки на странице...
    // $wpdb->show_errors(true);

    if(!empty($wpdb->error)) echo 'Connection is failed';

    // Получение параметров...
    $district = $_GET['district'];
    $region = $_GET['region'];
    
    // Методы для защиты от sql инъекций...
    sanitize_text_field($district);
    sanitize_text_field($region);


    // Переменная для проверки, заполнил ли пользователь какие-нибудь поля, 
    // если нет, выводим сообщение...
    $is_show = 1;

    if ($district === '') {
      if ($region === '') {
        $is_show = 0;
        echo '<p class="h4" align="center"><br><br><br><br>Вы не ввели ничего для поиска</p>';
      }

      // Поиск по региону...
      else {
        $sql_select = $wpdb->get_results($wpdb->prepare("
          SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, 
          ЦентрыКомпетенций.Приоритет 
          FROM ЦентрыКомпетенций 
          INNER JOIN РоссийскиеЦентры
          ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
          WHERE РоссийскиеЦентры.Регион = %s", [$region]));
      }
    }
  // Поиск по округу...
    else {

    // Поиск по округу...
      if ($region === '') {
        $sql_select = $wpdb->get_results($wpdb->prepare("
          SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, 
          ЦентрыКомпетенций.Приоритет 
          FROM ЦентрыКомпетенций 
          INNER JOIN РоссийскиеЦентры
          ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
          WHERE РоссийскиеЦентры.Округ = %s", [$district]));
      }

        // 01
        // Поиск по округу и региону...
      else {
        $sql_select = $wpdb->get_results($wpdb->prepare("
          SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, 
          ЦентрыКомпетенций.Приоритет 
          FROM ЦентрыКомпетенций 
          INNER JOIN РоссийскиеЦентры
          ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
          WHERE РоссийскиеЦентры.Округ = %s
          AND РоссийскиеЦентры.Регион = %s", [$district, $region]));
      }
    }


    if ($is_show === 1) {

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

      <p class="h4" style="text-align:center">Российские центры компетенций</p><br>
      <div class="table-responsive" style="overflow-y: auto; min-height:200px; max-height: 600px;">
      <figure class="wp-block-table">
      <table class="table table-hover table-bordered" style="text-align:center">
      <thead class="thead-dark">
      <tr>
      <th scope="col">Название центра</th>
      <th scope="col">Компетенция</th>
      <th scope="col">Приоритет</th>
      </tr>
      </thead>
      <tbody>';

      foreach ($sql_select as $row) {
        echo '<tr> 
        <td> <a href="/info_about_centers.php?name_of_center=' . $row->НазваниеЦентра . '" target="_blank">' . $row->НазваниеЦентра . '</a></td>
        <td> <a href="/centers_of_competence.php?&country=&name_of_competency=' . $row->НазваниеКомпетенции . '&priority=" target="_blank">' . $row->НазваниеКомпетенции . '</a></td>
        <td> <a href="/centers_of_competence.php?&country=&name_of_competency=&priority=' . $row->Приоритет . '" target="_blank">' . $row->Приоритет . '</a></td> </tr>';
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