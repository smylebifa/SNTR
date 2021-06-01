<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf8">
  <title>Поставщики компаний</title>
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
    $name_of_company = $_GET['name_of_company'];
    
  // Sql injection protection...
    sanitize_text_field($name_of_company);

    $is_show = 1;

    if ($name_of_company === '') {
          // Ничего не было введено для поиска...
      $is_show = 0;
      echo '<p class="h4" align="center"><br><br><br><br>Вы не ввели ничего для поиска</p>';
    }

    else {

      $sql_select = $wpdb->get_results($wpdb->prepare("
        SELECT ПоставщикиКомпаний.НазваниеПоставщика, ПоставщикиКомпаний.Страна,  
        ПоставщикиКомпаний.НазваниеКомпетенции AS НазваниеКомпетенции, 
        КодыКомпетенций.НазваниеКомпетенции AS ПодсказкаКомпетенции
        FROM ПоставщикиКомпаний

        LEFT JOIN КлючевыеСлова
        ON ПоставщикиКомпаний.НазваниеКомпетенции = КлючевыеСлова.КлючевоеСлово

        LEFT JOIN Keywords
        ON ПоставщикиКомпаний.НазваниеКомпетенции = Keywords.Keyword

        LEFT JOIN КодыКомпетенций
        ON ПоставщикиКомпаний.НазваниеКомпетенции = КодыКомпетенций.НазваниеКомпетенции
        OR (КлючевыеСлова.КодКомпетенции = КодыКомпетенций.КодКомпетенции
        OR Keywords.КодКомпетенции = КодыКомпетенций.КодКомпетенции)

        WHERE НазваниеЦентра = %s

        GROUP BY 
        ПоставщикиКомпаний.НазваниеПоставщика, ПоставщикиКомпаний.Страна,  
        ПоставщикиКомпаний.НазваниеКомпетенции", [$name_of_company]));
    }
    
    // Если пользователь ввел какие-то значения для поиска...
    if ($is_show === 1) {

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

        <p class="h4" style="text-align: center">Поставщики компании "' . $name_of_company .'"</p><br>
        <div class="table-responsive" style="overflow-y: auto; min-height:200px; max-height: 600px;">
        <figure class="wp-block-table">
        <table class="table table-hover table-bordered" style="text-align:center">
        <thead class="thead-dark">
        <tr>
        <th scope="col">Поставщик</th>
        <th scope="col">Страна</th>
        <th scope="col">Компетенция</th>
        </tr>
        </thead>
        <tbody>';

        $lastCenter = '';
        $lastCountry= '';

        foreach ($sql_select as $row) {
          if ($row->НазваниеПоставщика === $lastCenter &&
            $row->Страна === $lastCountry) {

            echo ', <a href="/centers_of_competence.php?name_of_competency=' . $row->НазваниеКомпетенции . '&country=&priority=" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="' . $row->ПодсказкаКомпетенции . '">' . $row->НазваниеКомпетенции . '</a>';
          }

          else {
            if($lastCountry != '') {
              echo '</td></tr>';
            }

            echo '<tr> 
            <td> <a href="/info_about_centers.php?name_of_center=' . $row->НазваниеПоставщика . '" target="_blank">' . $row->НазваниеПоставщика. '</a></td>

            <td> <a href="/centers_of_competence.php?name_of_competency=&country=' . $row->Страна . '&priority=" target="_blank">' . $row->Страна . '</a></td>

            <td> <a href="/centers_of_competence.php?name_of_competency=' . $row->НазваниеКомпетенции . '&country=&priority=" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="' . $row->ПодсказкаКомпетенции . '">' . $row->НазваниеКомпетенции . '</a>';
          }

          $lastCenter = $row->НазваниеПоставщика;
          $lastCountry = $row->Страна;

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
        echo '<p class="h4" align="center"><br><br><br><br>Поставщиков не найдено</p>';
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
        <a href="/company-suppliers" role="button" style="
        text-decoration: none;
        background: #ff6a3e;
        border: medium none;
        color: #fff;
        border-radius: 50px;
        font-size: 15px;
        line-height: 1.5;
        padding: 12px 25px;
        text-transform: uppercase;
        font-weight: 500; font: inherit; cursor: pointer;">Поставщики компаний</a>
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