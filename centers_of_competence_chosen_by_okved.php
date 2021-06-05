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


    if(!empty($wpdb->error)) echo 'Connection is failed';


              // Getting params from user entering in form...
    $code_of_competency_dev = $_GET['code_of_competency_dev'];
    $code_of_competency_apply = $_GET['code_of_competency_apply'];
    $code_of_competency_service = $_GET['code_of_competency_service'];

              // Sql injection protection...
    sanitize_text_field($code_of_competency_dev);
    sanitize_text_field($code_of_competency_apply);
    sanitize_text_field($code_of_competency_service);


    // Проверяем, заполнил ли пользователь какие-нибудь поля...
    $is_show = 1;

    if ($code_of_competency_dev === '') {

      if ($code_of_competency_apply === '') {

        // Ничего не было введено...
        if ($code_of_competency_service === '') {
          $is_show = 0;
          echo '<p class="h4" align="center"><br><br><br><br>Вы не ввели ничего для поиска</p>';
        }

        // 001
        else {
          $sql_select = $wpdb->get_results($wpdb->prepare("
            SELECT DISTINCT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна, КодыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет
            FROM ЦентрыКомпетенций

            RIGHT JOIN КодыКомпетенций
            ON ЦентрыКомпетенций.НазваниеКомпетенции = КодыКомпетенций.НазваниеКомпетенции

            INNER JOIN ОквэдВЧастиПредоставленияУслуг
            ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиПредоставленияУслуг.КодКомпетенции

            INNER JOIN КодыОквэд
            ON ОквэдВЧастиПредоставленияУслуг.НазваниеОквэд = КодыОквэд.НазваниеОквэд

            WHERE КодыОквэд.КодОквэд = %s
            AND КодыКомпетенций.НазваниеКомпетенции IS NOT NULL", $code_of_competency_service));
        }

      }

      
      else {

        // 010
        if ($code_of_competency_service === '') 
        {
          $sql_select = $wpdb->get_results($wpdb->prepare("
            SELECT DISTINCT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна, КодыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет
            FROM ЦентрыКомпетенций

            RIGHT JOIN КодыКомпетенций
            ON ЦентрыКомпетенций.НазваниеКомпетенции = КодыКомпетенций.НазваниеКомпетенции

            INNER JOIN ОквэдВЧастиПрименения
            ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиПрименения.КодКомпетенции
            
            INNER JOIN КодыОквэд
            ON ОквэдВЧастиПрименения.НазваниеОквэд = КодыОквэд.НазваниеОквэд
            
            WHERE КодыОквэд.КодОквэд = %s
            AND КодыКомпетенций.НазваниеКомпетенции IS NOT NULL", $code_of_competency_apply));
        }

        // 011
        else 
        {
         $sql_select = $wpdb->get_results($wpdb->prepare("
           SELECT DISTINCT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна, КодыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет
           FROM ЦентрыКомпетенций

           RIGHT JOIN КодыКомпетенций
           ON ЦентрыКомпетенций.НазваниеКомпетенции = КодыКомпетенций.НазваниеКомпетенции

           INNER JOIN ОквэдВЧастиПрименения
           ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиПрименения.КодКомпетенции

           INNER JOIN ОквэдВЧастиПредоставленияУслуг
           ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиПредоставленияУслуг.КодКомпетенции

           INNER JOIN КодыОквэд
           ON ОквэдВЧастиПрименения.НазваниеОквэд = КодыОквэд.НазваниеОквэд
           AND ОквэдВЧастиПредоставленияУслуг.НазваниеОквэд = КодыОквэд.НазваниеОквэд

           WHERE КодыОквэд.КодОквэд = %s
           AND КодыОквэд.КодОквэд = %s
           AND КодыКомпетенций.НазваниеКомпетенции", [$code_of_competency_apply, $code_of_competency_service]));
       }

     }

   }

   // 100
   else {

    if ($code_of_competency_apply === '') {

              // Ничего не было введено...
      if ($code_of_competency_service === '') {
        $sql_select = $wpdb->get_results($wpdb->prepare("
          SELECT DISTINCT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна, КодыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет
          FROM ЦентрыКомпетенций

          RIGHT JOIN КодыКомпетенций
          ON ЦентрыКомпетенций.НазваниеКомпетенции = КодыКомпетенций.НазваниеКомпетенции

          INNER JOIN ОквэдВЧастиРазработки
          ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиРазработки.КодКомпетенции

          INNER JOIN КодыОквэд
          ON ОквэдВЧастиРазработки.НазваниеОквэд = КодыОквэд.НазваниеОквэд

          WHERE КодыОквэд.КодОквэд = %s
          AND КодыКомпетенций.НазваниеКомпетенции IS NOT NULL", $code_of_competency_dev));
      }

      // 101
      else {
        $sql_select = $wpdb->get_results($wpdb->prepare("
          SELECT DISTINCT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна, КодыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет
          FROM ЦентрыКомпетенций

          RIGHT JOIN КодыКомпетенций
          ON ЦентрыКомпетенций.НазваниеКомпетенции = КодыКомпетенций.НазваниеКомпетенции

          INNER JOIN ОквэдВЧастиРазработки
          ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиРазработки.КодКомпетенции

          INNER JOIN ОквэдВЧастиПредоставленияУслуг
          ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиПредоставленияУслуг.КодКомпетенции

          INNER JOIN КодыОквэд
          ON ОквэдВЧастиРазработки.НазваниеОквэд = КодыОквэд.НазваниеОквэд
          AND ОквэдВЧастиПредоставленияУслуг.НазваниеОквэд = КодыОквэд.НазваниеОквэд

          WHERE КодыОквэд.КодОквэд = %s
          AND КодыОквэд.КодОквэд = %s
          AND КодыКомпетенций.НазваниеКомпетенции IS NOT NULL", [$code_of_competency_dev, $code_of_competency_service]));
      }

    }

    
    else {

      // 110
      if ($code_of_competency_service === '') 
      {
        $sql_select = $wpdb->get_results($wpdb->prepare("
          SELECT DISTINCT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна, КодыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет
          FROM ЦентрыКомпетенций

          RIGHT JOIN КодыКомпетенций
          ON ЦентрыКомпетенций.НазваниеКомпетенции = КодыКомпетенций.НазваниеКомпетенции

          INNER JOIN ОквэдВЧастиРазработки
          ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиРазработки.КодКомпетенции

          INNER JOIN ОквэдВЧастиПрименения
          ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиПрименения.КодКомпетенции

          INNER JOIN КодыОквэд
          ON ОквэдВЧастиРазработки.НазваниеОквэд = КодыОквэд.НазваниеОквэд
          AND ОквэдВЧастиПрименения.НазваниеОквэд = КодыОквэд.НазваниеОквэд

          WHERE КодыОквэд.КодОквэд = %s
          AND КодыОквэд.КодОквэд = %s
          AND КодыКомпетенций.НазваниеКомпетенции IS NOT NULL", [$code_of_competency_dev, $code_of_competency_apply]));
      }

      // 111
      else 
      {
        $sql_select = $wpdb->get_results($wpdb->prepare("
          SELECT DISTINCT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна, КодыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет
          FROM ЦентрыКомпетенций

          RIGHT JOIN КодыКомпетенций
          ON ЦентрыКомпетенций.НазваниеКомпетенции = КодыКомпетенций.НазваниеКомпетенции

          INNER JOIN ОквэдВЧастиРазработки
          ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиРазработки.КодКомпетенции

          INNER JOIN ОквэдВЧастиПрименения
          ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиПрименения.КодКомпетенции

          INNER JOIN ОквэдВЧастиПредоставленияУслуг
          ON КодыКомпетенций.КодКомпетенции = ОквэдВЧастиПредоставленияУслуг.КодКомпетенции

          INNER JOIN КодыОквэд
          ON ОквэдВЧастиРазработки.НазваниеОквэд = КодыОквэд.НазваниеОквэд
          AND ОквэдВЧастиПрименения.НазваниеОквэд = КодыОквэд.НазваниеОквэд
          AND ОквэдВЧастиПредоставленияУслуг.НазваниеОквэд = КодыОквэд.НазваниеОквэд

          WHERE КодыОквэд.КодОквэд = %s
          AND КодыОквэд.КодОквэд = %s
          AND КодыОквэд.КодОквэд = %s
          AND КодыКомпетенций.НазваниеКомпетенции IS NOT NULL", [$code_of_competency_dev, $code_of_competency_apply, $code_of_competency_service]));
      }
    }
  }


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


      <p class="h4" style="text-align:center">Центры компетенций</p><br>
      <div class="table-responsive" style="overflow-y: auto; min-height:200px; max-height: 600px;">
      <figure class="wp-block-table">
      <table class="table table-hover table-bordered" style="text-align:center">
      <thead class="thead-dark">
      <tr>
      <th scope="col">Название центра</th>
      <th scope="col">Страна</th>
      <th scope="col">Компетенция</th>
      <th scope="col">Приоритет</th>
      </tr>
      </thead>
      <tbody>';


      $lastCenter = '';
          $lastCountry= '';
          $lastCompetence = '';

          foreach ($sql_select as $row) {
            if ($row->НазваниеЦентра === $lastCenter &&
                $row->Страна === $lastCountry &&
                $row->НазваниеКомпетенции === $lastCompetence) {
              echo ', <a href="/centers_of_competence.php?name_of_competency=&country=&priority=' . $row->Приоритет . '" target="_blank">' . $row->Приоритет;
            }

            else {
              if($lastCompetence != '') {
                echo '</td></tr>';
              }

              echo '
              <tr>
              <td> <a href="/info_about_centers.php?name_of_center=' . $row->НазваниеЦентра . '" target="_blank">' . $row->НазваниеЦентра . '</a></td>

              <td> <a href="/centers_of_competence.php?name_of_competency=&country=' . $row->Страна . '&priority=" target="_blank">' . $row->Страна . '</a></td>

              <td> <a href="/centers_of_competence.php?name_of_competency=' . $row->НазваниеКомпетенции . '&country=&priority=" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="' . $row->ПодсказкаКомпетенции . '">' . $row->НазваниеКомпетенции . '</a></td>

              <td> <a href="/centers_of_competence.php?name_of_competency=&country=&priority=' . $row->Приоритет . '" target="_blank">' . $row->Приоритет . '</a>';
            }

            $lastCompetence = $row->НазваниеКомпетенции;
            $lastCenter = $row->НазваниеЦентра;
            $lastCountry = $row->Страна;

          }

          echo '
          </tbody>
          </table>
          </figure>
          </div>
          </div>
          </div>';

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
      <a href="/search-competence-and-centers-by-okved" role="button" style="
      text-decoration: none;
      background: #ff6a3e;
      border: medium none;
      color: #fff;
      border-radius: 50px;
      font-size: 15px;
      line-height: 1.5;
      padding: 12px 25px;
      text-transform: uppercase;
      font-weight: 500; font: inherit; cursor: pointer;">Поиск компетенций, центров по ОКВЭД</a>
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