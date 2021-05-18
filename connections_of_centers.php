  <!DOCTYPE html>
  <html lang="ru">
  <head>
    <meta charset="utf8">
    <title>Связанные ведущие центры</title>
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
      $name_of_connected_center = $_GET['name_of_connected_center'];

    // Методы для защиты от sql инъекций...
      sanitize_text_field($name_of_connected_center);



    // Переменная для проверки, заполнил ли пользователь какие-нибудь поля, 
    // если нет, выводим сообщение...
      $is_show = 1;

      if ($name_of_connected_center === '') {

          // Ничего не было введено для поиска...
        $is_show = 0;
        echo '<p class="h4" align="center"><br><br><br><br>Вы не ввели ничего для поиска</p>';
      }


      else {
        $sql_select = $wpdb->get_results($wpdb->prepare("
          SELECT DISTINCT НазваниеЦентра, Страны, ПереченьКомпетенций, СвязанныеЦентры 
          FROM СвязанныеВедущиеЦентры
          WHERE НазваниеЦентра = %s", $name_of_connected_center));
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

          <p class="h4" style="text-align: center">Связанные ведущие центры</p><br>
          <div class="table-responsive" style="overflow-y: auto; height: 600px;">
          <figure class="wp-block-table">
          <table class="table table-hover table-bordered" style="text-align:center">
          <thead class="thead-dark">
          <tr>
          <th scope="col">Название центра</th>
          <th scope="col">Страны</th>
          <th scope="col">Связанные центры</th>
          <th scope="col">Перечень компетенций</th>
          </tr>
          </thead>
          <tbody>';

          foreach ($sql_select as $row) {
            echo '<tr> 
            <td>' . $row->НазваниеЦентра . '</td>
            <td>' . $row->Страны . '</td>
            <td>' . $row->СвязанныеЦентры . '</td> 
            <td>' . $row->ПереченьКомпетенций . '</td></tr>';
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
          echo '<p class="h4" align="center"><br><br><br><br>Центр не найден</p>';
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
          <a href="/connections-of-centers" role="button" style="
          text-decoration: none;
          background: #ff6a3e;
          border: medium none;
          color: #fff;
          border-radius: 50px;
          font-size: 15px;
          line-height: 1.5;
          padding: 12px 25px;
          text-transform: uppercase;
          font-weight: 500; font: inherit; cursor: pointer;">Поиск связанных центров</a>
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