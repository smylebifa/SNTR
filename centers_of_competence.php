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

      if(!empty($wpdb->error)) echo 'Не удалось подключиться';

      // Получение параметров...
      $name_of_competency = $_GET['name_of_competency'];
      $country = $_GET['country'];
      $priority = $_GET['priority'];

    // Методы для защиты от sql инъекций...
      sanitize_text_field($name_of_competency);
      sanitize_text_field($country);
      sanitize_text_field($priority);


    // Переменная для проверки, заполнил ли пользователь какие-нибудь поля, 
    // если нет, выводим сообщение...
      $is_show = 1;

      if ($name_of_competency === '') {

        if ($country === '') {

          // Ничего не было введено для поиска...
          if ($priority === '') {
            $is_show = 0;
            echo '<p class="h4" align="center"><br><br><br><br>Вы не ввели ничего для поиска</p>';
          }

          // 001
          // Поиск по приоритету...
          else {
            $sql_select = $wpdb->get_results($wpdb->prepare("
              SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна,  
              ЦентрыКомпетенций.НазваниеКомпетенции AS НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет, 
              КодыКомпетенций.НазваниеКомпетенции AS ПодсказкаКомпетенции
              FROM ЦентрыКомпетенций

              LEFT JOIN КлючевыеСлова
              ON ЦентрыКомпетенций.НазваниеКомпетенции = КлючевыеСлова.КлючевоеСлово

              LEFT JOIN Keywords
              ON ЦентрыКомпетенций.НазваниеКомпетенции = Keywords.Keyword

              LEFT JOIN КодыКомпетенций
              ON ЦентрыКомпетенций.НазваниеКомпетенции = КодыКомпетенций.НазваниеКомпетенции
              OR (КлючевыеСлова.КодКомпетенции = КодыКомпетенций.КодКомпетенции
              OR Keywords.КодКомпетенции = КодыКомпетенций.КодКомпетенции)

              WHERE ЦентрыКомпетенций.Приоритет = %s

              GROUP BY 
              ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна,  ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет", $priority));
          }

        }

        // Поиск по стране...
        else {

          // 010
          // Поиск по стране...
          if ($priority === '') {
            $sql_select = $wpdb->get_results($wpdb->prepare("
              SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна, 
              ЦентрыКомпетенций.НазваниеКомпетенции AS НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет, 
              КодыКомпетенций.НазваниеКомпетенции AS ПодсказкаКомпетенции
              FROM ЦентрыКомпетенций

              LEFT JOIN КлючевыеСлова
              ON ЦентрыКомпетенций.НазваниеКомпетенции = КлючевыеСлова.КлючевоеСлово

              LEFT JOIN Keywords
              ON ЦентрыКомпетенций.НазваниеКомпетенции = Keywords.Keyword

              LEFT JOIN КодыКомпетенций
              ON ЦентрыКомпетенций.НазваниеКомпетенции = КодыКомпетенций.НазваниеКомпетенции
              OR (КлючевыеСлова.КодКомпетенции = КодыКомпетенций.КодКомпетенции
              OR Keywords.КодКомпетенции = КодыКомпетенций.КодКомпетенции)

              WHERE ЦентрыКомпетенций.Страна = %s
              GROUP BY 
              ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна,  ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет", $country));
          }

          // 011
          // Поиск по стране, приоритету...
          else {
            $sql_select = $wpdb->get_results($wpdb->prepare("
              SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна, 
              ЦентрыКомпетенций.НазваниеКомпетенции AS НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет, 
              КодыКомпетенций.НазваниеКомпетенции AS ПодсказкаКомпетенции
              FROM ЦентрыКомпетенций

              LEFT JOIN КлючевыеСлова
              ON ЦентрыКомпетенций.НазваниеКомпетенции = КлючевыеСлова.КлючевоеСлово

              LEFT JOIN Keywords
              ON ЦентрыКомпетенций.НазваниеКомпетенции = Keywords.Keyword

              LEFT JOIN КодыКомпетенций
              ON ЦентрыКомпетенций.НазваниеКомпетенции = КодыКомпетенций.НазваниеКомпетенции
              OR (КлючевыеСлова.КодКомпетенции = КодыКомпетенций.КодКомпетенции
              OR Keywords.КодКомпетенции = КодыКомпетенций.КодКомпетенции)

              WHERE ЦентрыКомпетенций.Страна = %s 
              AND ЦентрыКомпетенций.Приоритет = %s

              GROUP BY 
              ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет", [$country, $priority]));
          }

        }

      }

      // Поиск по компетенции...
      else {

        if ($country === '') {

          // 100
          // Поиск по компетенции...
          if ($priority === '') {
            $sql_select = $wpdb->get_results($wpdb->prepare("
              SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна,  
              ЦентрыКомпетенций.НазваниеКомпетенции AS НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет, 
              КодыКомпетенций.НазваниеКомпетенции AS ПодсказкаКомпетенции
              FROM ЦентрыКомпетенций

              LEFT JOIN КлючевыеСлова
              ON ЦентрыКомпетенций.НазваниеКомпетенции = КлючевыеСлова.КлючевоеСлово

              LEFT JOIN Keywords
              ON ЦентрыКомпетенций.НазваниеКомпетенции = Keywords.Keyword

              LEFT JOIN КодыКомпетенций
              ON ЦентрыКомпетенций.НазваниеКомпетенции = КодыКомпетенций.НазваниеКомпетенции
              OR (КлючевыеСлова.КодКомпетенции = КодыКомпетенций.КодКомпетенции
              OR Keywords.КодКомпетенции = КодыКомпетенций.КодКомпетенции)

              WHERE ЦентрыКомпетенций.НазваниеКомпетенции = %s
              
              GROUP BY 
              ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна, 
              ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет", $name_of_competency));
          }

          // 101
          // Поиск по компетенции и приоритету...
          else {
            $sql_select = $wpdb->get_results($wpdb->prepare("
             SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна,  
             ЦентрыКомпетенций.НазваниеКомпетенции AS НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет, 
             КодыКомпетенций.НазваниеКомпетенции AS ПодсказкаКомпетенции
             FROM ЦентрыКомпетенций

             LEFT JOIN КлючевыеСлова
             ON ЦентрыКомпетенций.НазваниеКомпетенции = КлючевыеСлова.КлючевоеСлово

             LEFT JOIN Keywords
             ON ЦентрыКомпетенций.НазваниеКомпетенции = Keywords.Keyword

             LEFT JOIN КодыКомпетенций
             ON ЦентрыКомпетенций.НазваниеКомпетенции = КодыКомпетенций.НазваниеКомпетенции
             OR (КлючевыеСлова.КодКомпетенции = КодыКомпетенций.КодКомпетенции
             OR Keywords.КодКомпетенции = КодыКомпетенций.КодКомпетенции)

             WHERE ЦентрыКомпетенций.НазваниеКомпетенции = %s 
             AND ЦентрыКомпетенций.Приоритет = %s

             GROUP BY 
             ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна,  ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет", [$name_of_competency, $priority]));
          }

        }

        else {

          // 110 
          // Поиск по компетенции и стране...
          if ($priority === '') {
            $sql_select = $wpdb->get_results($wpdb->prepare("
              SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна,  
              ЦентрыКомпетенций.НазваниеКомпетенции AS НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет, 
              КодыКомпетенций.НазваниеКомпетенции AS ПодсказкаКомпетенции
              FROM ЦентрыКомпетенций

              LEFT JOIN КлючевыеСлова
              ON ЦентрыКомпетенций.НазваниеКомпетенции = КлючевыеСлова.КлючевоеСлово

              LEFT JOIN Keywords
              ON ЦентрыКомпетенций.НазваниеКомпетенции = Keywords.Keyword

              LEFT JOIN КодыКомпетенций
              ON ЦентрыКомпетенций.НазваниеКомпетенции = КодыКомпетенций.НазваниеКомпетенции
              OR (КлючевыеСлова.КодКомпетенции = КодыКомпетенций.КодКомпетенции
              OR Keywords.КодКомпетенции = КодыКомпетенций.КодКомпетенции)

              WHERE ЦентрыКомпетенций.НазваниеКомпетенции = %s
              AND ЦентрыКомпетенций.Страна = %s

              GROUP BY 
              ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна,  ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет", [$name_of_competency, $country]));
          }

          // 111
          // Поиск по компетенции, стране, приоритету...
          else {
            $sql_select = $wpdb->get_results($wpdb->prepare("
             SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна,  
             ЦентрыКомпетенций.НазваниеКомпетенции AS НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет, 
             КодыКомпетенций.НазваниеКомпетенции AS ПодсказкаКомпетенции
             FROM ЦентрыКомпетенций

             LEFT JOIN КлючевыеСлова
             ON ЦентрыКомпетенций.НазваниеКомпетенции = КлючевыеСлова.КлючевоеСлово

             LEFT JOIN Keywords
             ON ЦентрыКомпетенций.НазваниеКомпетенции = Keywords.Keyword

             LEFT JOIN КодыКомпетенций
             ON ЦентрыКомпетенций.НазваниеКомпетенции = КодыКомпетенций.НазваниеКомпетенции
             OR (КлючевыеСлова.КодКомпетенции = КодыКомпетенций.КодКомпетенции
             OR Keywords.КодКомпетенции = КодыКомпетенций.КодКомпетенции)

             WHERE ЦентрыКомпетенций.НазваниеКомпетенции = %s 
             AND ЦентрыКомпетенций.Страна = %s
             AND ЦентрыКомпетенций.Приоритет = %s

             GROUP BY 
             ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.Страна,  ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет", [$name_of_competency, $country, $priority]));
          }

        }
      }


    // Если пользователь ввел какие-то значения для поиска...
      if ($is_show === 1) {

        if ($sql_select) {

          if ($country === "Россия") {
            echo '
            <div class="row">
            <div class="col-6">
            <div class="search_box">
            <fieldset style="text-align: left">
            <form method="get" action="/centers_of_competence_chosen_by_district.php" target="_blank">

            <div class="search_box">
            <label for="district_label">Федеральный округ:</label><br>
            <input type="text" placeholder="Название округа" id="district" name="district" size="20"><br>
            <div id="search_box-district-result"></div>

            <label for="region_label">Регион:</label><br>
            <input type="text" placeholder="Название региона" id="region" name="region" size="20"><br><br>
            <div id="search_box-region-result"></div>
            
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
            </div>';
          }

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
          <table class="table table-hover table-bordered" style="text-align:center;">
          <thead class="thead-dark">
          <tr>
          <th scope="col">Название центра</th>
          <th scope="col">Страна</th>
          <th scope="col">Название компетенции</th>
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