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
    $name_of_center = $_GET['name_of_center'];
    $name_of_competency = $_GET['name_of_competency'];
    $priority = $_GET['priority'];
    $district = $_GET['district'];
    $region = $_GET['region'];
    
    // Методы для защиты от sql инъекций...
    sanitize_text_field($name_of_center);
    sanitize_text_field($name_of_competency);
    sanitize_text_field($priority);
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

        if ($name_of_center === '') {

          if ($name_of_competency === '') {

            if ($priority === '') {
              $is_show = 0;
              echo '<p class="h4" align="center"><br><br><br><br>Вы не ввели ничего для поиска</p>';

            }

            // 001
            // Поиск приоритету...
            else {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, 
                ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Регион = %s
                AND ЦентрыКомпетенций.Приоритет = %s", [$region, $priority]));
            }
          }


          // Поиск по компетенции...
          else {

            // 010
            // Поиск по компетенции...
            if ($priority === '') {
             $sql_select = $wpdb->get_results($wpdb->prepare("
              SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
              FROM ЦентрыКомпетенций 
              INNER JOIN РоссийскиеЦентры
              ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
              WHERE РоссийскиеЦентры.Регион = %s
              AND ЦентрыКомпетенций.НазваниеКомпетенции = %s", [$region, $name_of_competency]));
           }

            // 011
            // Поиск по компетенции и приоритету...
           else {
            $sql_select = $wpdb->get_results($wpdb->prepare("
              SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
              FROM ЦентрыКомпетенций 
              INNER JOIN РоссийскиеЦентры
              ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
              WHERE РоссийскиеЦентры.Регион = %s
              AND ЦентрыКомпетенций.НазваниеКомпетенции = %s
              AND ЦентрыКомпетенций.Приоритет = %s", [$region, $name_of_competency, $priority]));
          }
        }
      }

      // Поиск по названию центра...
      else {

        if ($name_of_competency === '') {

          // 100
          // Поиск названию центра...
          if ($priority === '') {
            $sql_select = $wpdb->get_results($wpdb->prepare("
              SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, 
              ЦентрыКомпетенций.Приоритет 
              FROM ЦентрыКомпетенций 
              INNER JOIN РоссийскиеЦентры
              ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
              WHERE РоссийскиеЦентры.Регион = %s
              AND ЦентрыКомпетенций.НазваниеЦентра = %s", [$region, $name_of_center]));
          }

          // 101
          // Поиск названию центра и приоритету...
          else {
            $sql_select = $wpdb->get_results($wpdb->prepare("
              SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, 
              ЦентрыКомпетенций.Приоритет 
              FROM ЦентрыКомпетенций 
              INNER JOIN РоссийскиеЦентры
              ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
              WHERE РоссийскиеЦентры.Регион = %s
              AND ЦентрыКомпетенций.НазваниеЦентра = %s
              AND ЦентрыКомпетенций.Приоритет = %s", [$region, $name_of_center, $priority]));
          }
        }

        // Поиск по названию центра, компетенции...
        else {

          // 110
          // Поиск по названию центра, компетенции...
          if ($priority === '') {
           $sql_select = $wpdb->get_results($wpdb->prepare("
            SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
            FROM ЦентрыКомпетенций 
            INNER JOIN РоссийскиеЦентры
            ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
            WHERE РоссийскиеЦентры.Регион = %s
            AND ЦентрыКомпетенций.НазваниеЦентра = %s
            AND ЦентрыКомпетенций.НазваниеКомпетенции = %s", [$region, $name_of_center, $name_of_competency]));
         }

            // 111
            // Поиск по названию центра, компетенции и приоритету...
         else {
          $sql_select = $wpdb->get_results($wpdb->prepare("
            SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
            FROM ЦентрыКомпетенций 
            INNER JOIN РоссийскиеЦентры
            ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
            WHERE РоссийскиеЦентры.Регион = %s
            AND ЦентрыКомпетенций.НазваниеЦентра = %s
            AND ЦентрыКомпетенций.НазваниеКомпетенции = %s
            AND ЦентрыКомпетенций.Приоритет = %s", [$region, $name_of_center, $name_of_competency, $priority]));
        }
      }
    }
  }
}

    // Поиск по округу...
else {

      // Поиск по округу...
  if ($region === '') {

            if ($name_of_center === '') {

          if ($name_of_competency === '') {

            if ($priority === '') {
              $is_show = 0;
              echo '<p class="h4" align="center"><br><br><br><br>Вы не ввели ничего для поиска</p>';

            }

            // 001
            // Поиск приоритету...
            else {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, 
                ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Округ = %s
                AND ЦентрыКомпетенций.Приоритет = %s", [$district, $priority]));
            }
          }


          // Поиск по компетенции...
          else {

            // 010
            // Поиск по компетенции...
            if ($priority === '') {
             $sql_select = $wpdb->get_results($wpdb->prepare("
              SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
              FROM ЦентрыКомпетенций 
              INNER JOIN РоссийскиеЦентры
              ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
              WHERE РоссийскиеЦентры.Округ = %s
              AND ЦентрыКомпетенций.НазваниеКомпетенции = %s", [$district, $name_of_competency]));
           }

            // 011
            // Поиск по компетенции и приоритету...
           else {
            $sql_select = $wpdb->get_results($wpdb->prepare("
              SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
              FROM ЦентрыКомпетенций 
              INNER JOIN РоссийскиеЦентры
              ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
              WHERE РоссийскиеЦентры.Округ = %s
              AND ЦентрыКомпетенций.НазваниеКомпетенции = %s
              AND ЦентрыКомпетенций.Приоритет = %s", [$district, $name_of_competency, $priority]));
          }
        }
      }

      // Поиск по названию центра...
      else {

        if ($name_of_competency === '') {

          // 100
          // Поиск названию центра...
          if ($priority === '') {
            $sql_select = $wpdb->get_results($wpdb->prepare("
              SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, 
              ЦентрыКомпетенций.Приоритет 
              FROM ЦентрыКомпетенций 
              INNER JOIN РоссийскиеЦентры
              ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
              WHERE РоссийскиеЦентры.Округ = %s
              AND ЦентрыКомпетенций.НазваниеЦентра = %s", [$district, $name_of_center]));
          }

          // 101
          // Поиск названию центра и приоритету...
          else {
            $sql_select = $wpdb->get_results($wpdb->prepare("
              SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, 
              ЦентрыКомпетенций.Приоритет 
              FROM ЦентрыКомпетенций 
              INNER JOIN РоссийскиеЦентры
              ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
              WHERE РоссийскиеЦентры.Округ = %s
              AND ЦентрыКомпетенций.НазваниеЦентра = %s
              AND ЦентрыКомпетенций.Приоритет = %s", [$district, $name_of_center, $priority]));
          }
        }

        // Поиск по названию центра, компетенции...
        else {

          // 110
          // Поиск по названию центра, компетенции...
          if ($priority === '') {
           $sql_select = $wpdb->get_results($wpdb->prepare("
            SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
            FROM ЦентрыКомпетенций 
            INNER JOIN РоссийскиеЦентры
            ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
            WHERE РоссийскиеЦентры.Округ = %s
            AND ЦентрыКомпетенций.НазваниеЦентра = %s
            AND ЦентрыКомпетенций.НазваниеКомпетенции = %s", [$district, $name_of_center, $name_of_competency]));
         }

            // 111
            // Поиск по названию центра, компетенции и приоритету...
         else {
          $sql_select = $wpdb->get_results($wpdb->prepare("
            SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
            FROM ЦентрыКомпетенций 
            INNER JOIN РоссийскиеЦентры
            ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
            WHERE РоссийскиеЦентры.Округ = %s
            AND ЦентрыКомпетенций.НазваниеЦентра = %s
            AND ЦентрыКомпетенций.НазваниеКомпетенции = %s
            AND ЦентрыКомпетенций.Приоритет = %s", [$district, $name_of_center, $name_of_competency, $priority]));
        }
      }
    }

  }

      // Поиск по округу и региону...
  else {

            if ($name_of_center === '') {

          if ($name_of_competency === '') {

            if ($priority === '') {
              $is_show = 0;
              echo '<p class="h4" align="center"><br><br><br><br>Вы не ввели ничего для поиска</p>';

            }

            // 001
            // Поиск приоритету...
            else {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, 
                ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Округ = %s
                AND РоссийскиеЦентры.Регион = %s
                AND ЦентрыКомпетенций.Приоритет = %s", [$district, $region, $priority]));
            }
          }


          // Поиск по компетенции...
          else {

            // 010
            // Поиск по компетенции...
            if ($priority === '') {
             $sql_select = $wpdb->get_results($wpdb->prepare("
              SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
              FROM ЦентрыКомпетенций 
              INNER JOIN РоссийскиеЦентры
              ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
              WHERE РоссийскиеЦентры.Округ = %s
              AND РоссийскиеЦентры.Регион = %s
              AND ЦентрыКомпетенций.НазваниеКомпетенции = %s", [$district, $region, $name_of_competency]));
           }

            // 011
            // Поиск по компетенции и приоритету...
           else {
            $sql_select = $wpdb->get_results($wpdb->prepare("
              SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
              FROM ЦентрыКомпетенций 
              INNER JOIN РоссийскиеЦентры
              ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
              WHERE РоссийскиеЦентры.Округ = %s
              AND РоссийскиеЦентры.Регион = %s
              AND ЦентрыКомпетенций.НазваниеКомпетенции = %s
              AND ЦентрыКомпетенций.Приоритет = %s", [$district, $region, $name_of_competency, $priority]));
          }
        }
      }

      // Поиск по названию центра...
      else {

        if ($name_of_competency === '') {

          // 100
          // Поиск названию центра...
          if ($priority === '') {
            $sql_select = $wpdb->get_results($wpdb->prepare("
              SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, 
              ЦентрыКомпетенций.Приоритет 
              FROM ЦентрыКомпетенций 
              INNER JOIN РоссийскиеЦентры
              ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
              WHERE РоссийскиеЦентры.Округ = %s
              AND РоссийскиеЦентры.Регион = %s
              AND ЦентрыКомпетенций.НазваниеЦентра = %s", [$district, $region, $name_of_center]));
          }

          // 101
          // Поиск названию центра и приоритету...
          else {
            $sql_select = $wpdb->get_results($wpdb->prepare("
              SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, 
              ЦентрыКомпетенций.Приоритет 
              FROM ЦентрыКомпетенций 
              INNER JOIN РоссийскиеЦентры
              ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
              WHERE РоссийскиеЦентры.Округ = %s
              AND РоссийскиеЦентры.Регион = %s
              AND ЦентрыКомпетенций.НазваниеЦентра = %s
              AND ЦентрыКомпетенций.Приоритет = %s", [$district, $region, $name_of_center, $priority]));
          }
        }

        // Поиск по названию центра, компетенции...
        else {

          // 110
          // Поиск по названию центра, компетенции...
          if ($priority === '') {
           $sql_select = $wpdb->get_results($wpdb->prepare("
            SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
            FROM ЦентрыКомпетенций 
            INNER JOIN РоссийскиеЦентры
            ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
            WHERE РоссийскиеЦентры.Округ = %s
            AND РоссийскиеЦентры.Регион = %s
            AND ЦентрыКомпетенций.НазваниеЦентра = %s
            AND ЦентрыКомпетенций.НазваниеКомпетенции = %s", [$district, $region, $name_of_center, $name_of_competency]));
         }

            // 111
            // Поиск по названию центра, компетенции и приоритету...
         else {
          $sql_select = $wpdb->get_results($wpdb->prepare("
            SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
            FROM ЦентрыКомпетенций 
            INNER JOIN РоссийскиеЦентры
            ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
            WHERE РоссийскиеЦентры.Округ = %s
            AND РоссийскиеЦентры.Регион = %s
            AND ЦентрыКомпетенций.НазваниеЦентра = %s
            AND ЦентрыКомпетенций.НазваниеКомпетенции = %s
            AND ЦентрыКомпетенций.Приоритет = %s", [$district, $region, $name_of_center, $name_of_competency, $priority]));
        }
      }
    }

  }
}


if ($is_show === 1) {

  echo '
  <div class="row">
  <div class="col-6">
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

  <p class="h4" style="text-align:center">Российские центры компетенций</p><br>
  <div class="table-responsive">
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
    <td> <a href="/centers_of_competence.php?name_of_center=' . $row->НазваниеЦентра . '&country=&name_of_competency=&priority=">' . $row->НазваниеЦентра . '</a></td>
    <td> <a href="/centers_of_competence.php?name_of_center=&country=&name_of_competency=' . $row->НазваниеКомпетенции . '&priority=">' . $row->НазваниеКомпетенции . '</a></td>
    <td> <a href="/centers_of_competence.php?name_of_center=&country=&name_of_competency=&priority=' . $row->Приоритет . '">' . $row->Приоритет . '</a></td></tr>';
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