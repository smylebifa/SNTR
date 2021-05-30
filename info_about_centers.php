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
    $name_of_center = $_GET['name_of_center'];

              // Sql injection protection...
    sanitize_text_field($name_of_center);


    if ($name_of_center === '') {
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
        WHERE НазваниеЦентра = %s", $name_of_center));

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

        <p class="h4" style="text-align: center">Информация по центру компетенций</p><br>
        <div class="table-responsive" style="overflow-y: auto; min-height:200px; max-height: 600px;">
        <figure class="wp-block-table">
        <table class="table table-hover table-bordered" style="text-align:center">
        <tbody>';


        foreach ($sql_select as $row) {
          echo '
          <tr>
          <td>Название центра</td><td>' . $row->НазваниеЦентра . '</td>
          </tr><tr>
          <td>Страна</td><td>' . $row->Страна . '</td>
          </tr><tr>
          <td>Руководители</td><td>' . $row->Руководители . '</td>
          </tr><tr>
          <td>Компетенции</td><td>' . $row->Компетенции . '</td>
          </tr><tr>
          <td>Описание</td><td>' . $row->Описание . '</td>
          </tr><tr>
          <td>Основные клиенты и партнеры</td><td>' . $row->ОсновныеКлиентыИПартнеры . '</td>
          </tr><tr>
          <td>Патентная активность</td><td>' . $row->ПатентнаяАктивность . '</td>
          </tr><tr>
          <td>Публикационная активность</td><td>' . $row->ПубликационнаяАктивность . '</td>
          </tr><tr>
          <td>Бенчмаркинг</td><td>' . $row->Бенчмаркинг . '</td>
          </tr><tr>
          <td>Общее число сотрудников</td><td>' . $row->ОбщееЧислоСотрудников . '</td>
          </tr><tr>
          <td>Ведущие специалисты</td><td>' . $row->ВедущиеСпециалисты . '</td>
          </tr><tr>
          <td>Структура компании</td><td>' . $row->СтруктураКомпании . '</td>
          </tr></tr>';
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