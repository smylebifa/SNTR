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
    $name = $_GET['name'];
    $competency = $_GET['competency'];
    $country = $_GET['country'];
    $priority = $_GET['priority'];

    $district = $_GET['district'];
    $region = $_GET['region'];
    
  // Sql injection protection...
    sanitize_text_field($district);
    sanitize_text_field($region);
    sanitize_text_field($competency);
    sanitize_text_field($country);
    sanitize_text_field($priority);


    // Проверяем, заполнил ли пользователь какие-нибудь поля...
    $is_show = 1;

    if ($competency === '') {

      if ($country === '') {

        if ($priority === '') {

          if ($district === '') {

            if ($region === '') {
              $is_show = 0;
              echo '<p class="h4" align="center"><br><br><br><br>Вы не ввели ничего для поиска</p>';
            }

        // 000 Поиск по региону...
            else {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, 
                ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Регион = %s", $region));
            }
          }


          else {

      // 000 Поиск по округу...
            if ($region === '') {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT НазваниеЦентра, НазваниеКомпетенции, Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Округ = %s", $district));
            }

      // 000 Поиск по округу и региону...
            else {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT НазваниеЦентра, НазваниеКомпетенции, Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Округ = %s
                AND РоссийскиеЦентры.Регион = %s", [$district, $region]));

            }
          }
        }

// 001
// Поиск по приоритету...
        else {

          if ($district === '') {

            if ($region === '') {
              $is_show = 0;
              echo '<p class="h4" align="center"><br><br><br><br>Вы не ввели ничего для поиска</p>';
            }

            else {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Регион = %s
                AND ЦентрыКомпетенций.Приоритет = %s", [$region, $priority]));
            }
          }

          else {

            if ($region === '') {

              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Округ = %s
                AND  ЦентрыКомпетенций.Приоритет = %s", [$district, $priority]));
            }

            else {

              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Округ = %s
                AND РоссийскиеЦентры.Регион = %s
                AND  ЦентрыКомпетенций.Приоритет = %s", [$district, $region, $priority]));
            }
          }
        }
      }

// 010
// Поиск по стране...
      else {

        if ($priority === '') {

          if ($district === '') {

            if ($region === '') {
              $is_show = 0;
              echo '<p class="h4" align="center"><br><br><br><br>Вы не ввели ничего для поиска</p>';
            }

            else {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Регион = %s
                AND ЦентрыКомпетенций.Страна = %s", [$region, $country]));
            }
          }

          else {

            if ($region === '') {

              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Округ = %s
                AND ЦентрыКомпетенций.Страна = %s", [$district, $country]));
            }

            else {

              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Округ = %s
                AND РоссийскиеЦентры.Регион = %s
                AND ЦентрыКомпетенций.Страна = %s", [$district, $region, $country]));
            }
          }
        }

          // 011
          // Поиск по стране, приоритету...
        else {

          if ($district === '') {

            if ($region === '') {
              $is_show = 0;
              echo '<p class="h4" align="center"><br><br><br><br>Вы не ввели ничего для поиска</p>';
            }

            else {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Регион = %s
                AND ЦентрыКомпетенций.Страна = %s
                AND ЦентрыКомпетенций.Приоритет = %s", [$region, $country, $priority]));
            }
          }

          else {

            if ($region === '') {

              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Округ = %s
                AND ЦентрыКомпетенций.Страна = %s
                AND ЦентрыКомпетенций.Приоритет = %s", [$district, $country, $priority]));
            }

            else {

              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Округ = %s
                AND РоссийскиеЦентры.Регион = %s
                AND ЦентрыКомпетенций.Страна = %s
                AND ЦентрыКомпетенций.Приоритет = %s", [$district, $region, $country, $priority]));

            }
          }
        }
      }
    }

      // Поиск по компетенции...
    //100
    else {

      if ($country === '') {

          // 0100
          // Поиск по компетенции...
        if ($priority === '') {

          if ($district === '') {

            if ($region === '') {
              $is_show = 0;
              echo '<p class="h4" align="center"><br><br><br><br>Вы не ввели ничего для поиска</p>';
            }

            else {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Регион = %s
                AND ЦентрыКомпетенций.НазваниеКомпетенции = %s", [$region, $competency]));
            }
          }

          else {

            if ($region === '') {

              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Округ = %s
                AND ЦентрыКомпетенций.НазваниеКомпетенции = %s", [$district, $competency]));
            }

            else {

              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Округ = %s
                AND РоссийскиеЦентры.Регион = %s
                AND ЦентрыКомпетенций.НазваниеКомпетенции = %s", [$district, $region, $competency]));
            }
          }
        }

          // 0101
          // Поиск по компетенции и приоритету...
        else {

          if ($district === '') {

            if ($region === '') {
              $is_show = 0;
              echo '<p class="h4" align="center"><br><br><br><br>Вы не ввели ничего для поиска</p>';
            }

            else {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Регион = %s
                AND ЦентрыКомпетенций.НазваниеКомпетенции = %s 
                AND ЦентрыКомпетенций.Приоритет = %s", [$region, $competency, $priority]));
            }
          }

          else {

            if ($region === '') {

              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Округ = %s
                AND ЦентрыКомпетенций.НазваниеКомпетенции = %s 
                AND ЦентрыКомпетенций.Приоритет = %s", [$district, $competency, $priority]));
            }

            else {

              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Округ = %s
                AND РоссийскиеЦентры.Регион = %s
                AND ЦентрыКомпетенций.НазваниеКомпетенции = %s 
                AND ЦентрыКомпетенций.Приоритет = %s", [$district, $region, $competency, $priority]));


            }
          }
        }
      }

      else {

          // 110 
          // Поиск по компетенции и стране...
        if ($priority === '') {

          if ($district === '') {

            if ($region === '') {
              $is_show = 0;
              echo '<p class="h4" align="center"><br><br><br><br>Вы не ввели ничего для поиска</p>';
            }

            else {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Регион = %s
                AND ЦентрыКомпетенций.НазваниеКомпетенции = %s
                AND РоссийскиеЦентры.Страна = %s", [$region, $competency, $country]));
            }
          }

          else {

            if ($region === '') {

              $sql_select = $wpdb->get_results($wpdb->prepare("
               SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
               FROM ЦентрыКомпетенций 
               INNER JOIN РоссийскиеЦентры
               ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
               WHERE РоссийскиеЦентры.Округ = %s
               AND ЦентрыКомпетенций.НазваниеКомпетенции = %s
               AND ЦентрыКомпетенций.Страна = %s", [$district, $competency, $country]));
            }

            else {

              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Округ = %s
                AND РоссийскиеЦентры.Регион = %s
                AND ЦентрыКомпетенций.НазваниеКомпетенции = %s
                AND ЦентрыКомпетенций.Страна = %s", [$district, $region, $competency, $country]));
            }
          }
        }

          // 111
          // Поиск по компетенции, стране, приоритету...
        else {

          if ($district === '') {

            if ($region === '') {
              $is_show = 0;
              echo '<p class="h4" align="center"><br><br><br><br>Вы не ввели ничего для поиска</p>';
            }

            else {
              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Регион = %s
                AND ЦентрыКомпетенций.НазваниеКомпетенции = %s
                AND ЦентрыКомпетенций.Страна = %s
                AND ЦентрыКомпетенций.Приоритет = %s", [$region, $competency, $country ,$priority]));
            }
          }

          else {

            if ($region === '') {

              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Округ = %s
                AND ЦентрыКомпетенций.НазваниеКомпетенции = %s
                AND ЦентрыКомпетенций.Страна = %s
                AND ЦентрыКомпетенций.Приоритет = %s", [$district, $competency, $country ,$priority]));
            }

            else {

              $sql_select = $wpdb->get_results($wpdb->prepare("
                SELECT ЦентрыКомпетенций.НазваниеЦентра, ЦентрыКомпетенций.НазваниеКомпетенции, ЦентрыКомпетенций.Приоритет 
                FROM ЦентрыКомпетенций 
                INNER JOIN РоссийскиеЦентры
                ON ЦентрыКомпетенций.НазваниеЦентра = РоссийскиеЦентры.НазваниеЦентра
                WHERE РоссийскиеЦентры.Округ = %s
                AND РоссийскиеЦентры.Регион = %s
                AND ЦентрыКомпетенций.НазваниеКомпетенции = %s
                AND ЦентрыКомпетенций.Страна = %s
                AND ЦентрыКомпетенций.Приоритет = %s", [$district, $region, $competency, $country ,$priority]));

            }
          }
        }
      }
    }


    if ($is_show === 1) {

      echo '
      <div class="row">
      <div class="col-6">

      <div class="search_box">
      <fieldset style="text-align: left">
      <form method="get" action="/competence_district.php">

      <div class="search_box">
      <label for="district_label">Федеральный округ:</label><br>
      <input type="text" placeholder="Название округа" id="district" name="district" size="20"><br>
      <div id="search_box-district-result"></div>

      <label for="region_label">Регион:</label><br>
      <input type="text" placeholder="Название региона" id="region" name="region" size="20"><br><br>
      <div id="search_box-region-result"></div>

      <input type="text" style="display:none;" value="' . $name . '" name="name">
      <input type="text" style="display:none;" value="' . $competency . '" name="competency">
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
      </div>
      
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
        <td> <a href="/compet_choose.php?name=' . $row->НазваниеЦентра . '&country=&competency=&priority=">' . $row->НазваниеЦентра . '</a></td>
        <td> <a href="/compet_choose.php?name=&country=&competency=' . $row->НазваниеКомпетенции . '&priority=">' . $row->НазваниеКомпетенции . '</a></td>
        <td> <a href="/compet_choose.php?name=&country=&competency=&priority=' . $row->Приоритет . '">' . $row->Приоритет . '</a></td></tr>';
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