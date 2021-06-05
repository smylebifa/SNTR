<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf8">
  <title>Список центров</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

  <script src="https://snipp.ru/cdn/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="container">

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
      <div class="col-12"><p></p></div>
    </div>

    <div class="row">
      <div class="col-1"></div>

      <div class="col-10">

        <h3 style="text-align: center"><b>Список центров</b></h3><br>
        <p>Поиск названий центров</p>
        <input class="form-control" id="myInput" type="text" placeholder="Найти.."><br>
        <div class="table-responsive" style="overflow-y: auto; min-height:200px; max-height: 500px;">
          <figure class="wp-block-table">
            <table class="table table-hover table-dark table-bordered" style="text-align:center;">
              <tbody id="centers">

                <?php
    // Подключение файла для обращения к базе данных...
                require_once('wp-load.php');

                global $wpdb;

    // Метод для отображения ошибки на странице...
    // $wpdb->show_errors(true);

                if(!empty($wpdb->error)) echo 'Не удалось подключиться';

                $sql_select = $wpdb->get_results($wpdb->prepare("
                  SELECT DISTINCT НазваниеЦентра
                  FROM ЦентрыКомпетенций"));

                foreach ($sql_select as $row) {
                  echo '
                  <tr> <td>' . $row->НазваниеЦентра . '</td></tr>';
                }

                ?>

              </tbody>
            </table>
          </figure>
        </div>
      </div>
      <div class="col-1"></div>
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


  <script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#centers tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>

</body>
</html>