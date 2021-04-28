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
      $name_of_center = $_GET['name_of_center'];
      $name_of_competency = $_GET['name_of_competency'];
      $country = $_GET['country'];
      $priority = $_GET['priority'];

    // Методы для защиты от sql инъекций...
      sanitize_text_field($name_of_center);
      sanitize_text_field($name_of_competency);
      sanitize_text_field($country);
      sanitize_text_field($priority);


    // Переменная для проверки, заполнил ли пользователь какие-нибудь поля, 
    // если нет, выводим сообщение...
      $is_show = 1;

      if ($name_of_center  === '') {

        if ($name_of_competency === '') {

          if ($country === '') {

          // Ничего не было введено для поиска...
            if ($priority === '') {
              $is_show = 0;
              echo '<p class="h4" align="center"><br><br><br><br>Вы не ввели ничего для поиска</p>';
            }

          // 0001
          // Поиск по приоритету...
            else {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT НазваниеЦентра, Страна, НазваниеКомпетенции, Приоритет 
                FROM ЦентрыКомпетенций
                WHERE Приоритет = %s", $priority));
            }

          }

        // Поиск по стране...
          else {

          // 0010
          // Поиск по стране...
            if ($priority === '') {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT НазваниеЦентра, Страна, НазваниеКомпетенции, Приоритет 
                FROM ЦентрыКомпетенций
                WHERE Страна = %s", $country));
            }

          // 0011
          // Поиск по стране, приоритету...
            else {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT НазваниеЦентра, Страна, НазваниеКомпетенции, Приоритет 
                FROM ЦентрыКомпетенций
                WHERE Страна = %s 
                AND Приоритет = %s", [$country, $priority]));
            }

          }

        }

      // Поиск по компетенции...
        else {

          if ($country === '') {

          // 0100
          // Поиск по компетенции...
            if ($priority === '') {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT НазваниеЦентра, Страна, НазваниеКомпетенции, Приоритет 
                FROM ЦентрыКомпетенций
                WHERE НазваниеКомпетенции = %s", $name_of_competency));
            }

          // 0101
          // Поиск по компетенции и приоритету...
            else {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT НазваниеЦентра, Страна, НазваниеКомпетенции, Приоритет 
                FROM ЦентрыКомпетенций 
                WHERE НазваниеКомпетенции = %s 
                AND Приоритет = %s", [$name_of_competency, $priority]));
            }

          }

          else {

          // 0110 
          // Поиск по компетенции и стране...
            if ($priority === '') {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT НазваниеЦентра, Страна, НазваниеКомпетенции, Приоритет 
                FROM ЦентрыКомпетенций 
                WHERE НазваниеКомпетенции = %s
                AND Страна = %s", [$name_of_competency, $country]));
            }

          // 0111
          // Поиск по компетенции, стране, приоритету...
            else {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT НазваниеЦентра, Страна, НазваниеКомпетенции, Приоритет 
                FROM ЦентрыКомпетенций 
                WHERE НазваниеКомпетенции = %s 
                AND Страна = %s
                AND Приоритет = %s", [$name_of_competency, $country, $priority]));
            }

          }
        }
      }

    // Поиск по названию центра...
      else
      {
        if ($name_of_competency === '') {

          if ($country === '') {

          //1000
          // Поиск по названию центра...
            if ($priority === '') {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT НазваниеЦентра, Страна, НазваниеКомпетенции, Приоритет 
                FROM ЦентрыКомпетенций
                WHERE НазваниеЦентра = %s", [$name_of_center]));
            }

          // 1001
          // Поиск по названию центра, приоритету...
            else {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT НазваниеЦентра, Страна, НазваниеКомпетенции, Приоритет 
                FROM ЦентрыКомпетенций
                WHERE НазваниеЦентра = %s
                AND Приоритет = %s", [$name_of_center, $priority]));
            }

          }

        // Поиск по названию центра, стране...
          else {

          // 1010
          // Поиск по названию центра, стране...
            if ($priority === '') {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT НазваниеЦентра, Страна, НазваниеКомпетенции, Приоритет 
                FROM ЦентрыКомпетенций
                WHERE Страна = %s", [$name_of_center, $country]));
            }

          // 1011
          // Поиск по названию центра, стране, приоритету...
            else {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT НазваниеЦентра, Страна, НазваниеКомпетенции, Приоритет 
                FROM ЦентрыКомпетенций
                WHERE Страна = %s 
                AND Приоритет = %s", [$name_of_center, $country, $priority]));
            }

          }

        }

      // Поиск по названию центра, компетенции...
        else {

          if ($country === '') {

          // 1100
          // Поиск по названию центра, компетенции...
            if ($priority === '') {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT НазваниеЦентра, Страна, НазваниеКомпетенции, Приоритет 
                FROM ЦентрыКомпетенций
                WHERE НазваниеКомпетенции = %s", $name_of_competency));
            }

          // 1101
          // Поиск по названию центра, компетенции и приоритету...
            else {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT НазваниеЦентра, Страна, НазваниеКомпетенции, Приоритет 
                FROM ЦентрыКомпетенций 
                WHERE НазваниеКомпетенции = %s 
                AND Приоритет = %s", [$name_of_competency, $priority]));
            }

          }

          else {

          // 1110 
          // Поиск по названию центра, компетенции и стране...
            if ($priority === '') {

              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT НазваниеЦентра, Страна, НазваниеКомпетенции, Приоритет 
                FROM ЦентрыКомпетенций 
                WHERE НазваниеКомпетенции = %s
                AND Страна = %s", [$name_of_competency, $country]));
            }

          // 1111
          // Поиск по названию центра, компетенции, стране, приоритету...
            else {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT НазваниеЦентра, Страна, НазваниеКомпетенции, Приоритет 
                FROM ЦентрыКомпетенций 
                WHERE НазваниеКомпетенции = %s 
                AND Страна = %s
                AND Приоритет = %s", [$name_of_competency, $country ,$priority]));
            }

          }
        }

      }

    // Если пользователь ввел какие-то значения для поиска...
      if ($is_show === 1) {

        echo '
        <div class="row">
        <div class="col-6">';


        if ($country === "Россия" or $country === '') {
          echo '
          <div class="search_box">
          <fieldset style="text-align: left">
          <form method="get" action="/centers_of_competence_chosen_by_district.php">

          <div class="search_box">
          <label for="district_label">Федеральный округ:</label><br>
          <input type="text" placeholder="Название округа" id="district" name="district" size="20"><br>
          <div id="search_box-district-result"></div>

          <label for="region_label">Регион:</label><br>
          <input type="text" placeholder="Название региона" id="region" name="region" size="20"><br><br>
          <div id="search_box-region-result"></div>

          <input type="text" style="display:none;" value="' . $name_of_center . '" name="name_of_center">
          <input type="text" style="display:none;" value="' . $name_of_competency . '" name="name_of_competency">
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
          </div>';
        }

        echo '
        </div>
        <div class="col-6">
        <div class="search_box">
        <fieldset style="text-align: right">
        <form method="get" action="/compet_choose_by_keyword.php">
        <label for="keyword_label">Поиск центров по ключевому слову:</label><br>
        <input type="text" placeholder="Ключевое слово" id="keyword" name="keyword" size="20"><br><br>
        <div id="search_box-keyword-result"></div>
        
        <input type="text" style="display:none;" value="' . $name_of_center . '" name="name_of_center">
        <input type="text" style="display:none;" value="' . $name_of_competency . '" name="name_of_competency">
        <input type="text" style="display:none;" value="' . $country . '" name="country">
        <input type="text" style="display:none;" value="' . $priority . '" name="priority">

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

        <p class="h4" style="text-align: center">Центры компетенций</p><br>
        <div class="table-responsive">
        <figure class="wp-block-table">
        <table class="table table-hover table-bordered" style="text-align:center">
        <thead class="thead-dark">
        <tr>
        <th scope="col">Название центра</th>
        <th scope="col">Страна</th>
        <th scope="col">Название компетенции</th>
        <th scope="col">Приоритет</th>
        </tr>
        </thead>
        <tbody>';


        foreach ($sql_select as $row) {
          echo '<tr> 
          <td> <a href="/centers_of_competence.php?name_of_center=' . $row->НазваниеЦентра . '&name_of_competency=&country=&priority=">' . $row->НазваниеЦентра . '</a></td>
          <td> <a href="/centers_of_competence.php?name_of_center=&country=' . $row->Страна . '&name_of_competency=&priority=">' . $row->Страна . '</a></td>
          <td> <a href="/centers_of_competence.php?name_of_center=&country=&name_of_competency=' . $row->НазваниеКомпетенции . '&priority=">' . $row->НазваниеКомпетенции . '</a></td>
          <td> <a href="/centers_of_competence.php?name_of_center=&country=&name_of_competency=&priority=' . $row->Приоритет . '">' . $row->Приоритет . '</a></td> </tr>';
        }

        echo '
        </tbody>
        </table>
        </figure>
        </div>
        </div>
        </div>';

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