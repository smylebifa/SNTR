<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf8">
  <title>ОКВЭД</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
      <div class="col-12"><p></p></div>
    </div>

    <?php 
    
    require_once('wp-load.php');

    global $wpdb;
    
    $code = $_GET['code'];
    
       // Sql injection protection...
    sanitize_text_field($chapter);
    
    
    $sql_select = $wpdb->get_results($wpdb->prepare("
     SELECT Оквэд2Уровень.КодОквэд2Уровень, КодыОквэд.НазваниеОквэд 
     FROM Оквэд2Уровень
     INNER JOIN КодыОквэд
     ON Оквэд2Уровень.КодОквэд2Уровень = КодыОквэд.КодОквэд
     WHERE Оквэд2Уровень.КодОквэд1Уровень = %s
     ORDER BY Оквэд2Уровень.КодОквэд2Уровень", $code));

    if ($sql_select) {

      echo '
      
      <div class="row">

      <div class="col-12">

      <p class="h4" align="center">ОКВЭД</p><br>
      <div class="table-responsive" style="overflow-y: auto; min-height:200px; max-height: 600px;">
      <figure class="wp-block-table">
      <table class="table table-hover table-bordered" style="text-align:center">
      <thead class="thead-dark">
      <tr>
      <th scope="col">Код ОКВЭД</th>
      <th scope="col">Название ОКВЭД</th>
      </tr>
      </thead>
      <tbody>';
      
      
      
      
      foreach ($sql_select as $row) {
        
        echo '<tr>
        <td> <a href="/okved_level3.php?code=' . $row->КодОквэд2Уровень . '" target="_blank">' . $row->КодОквэд2Уровень . '</a></td>
        <td> <a href="/okved_level3.php?code=' . $row->КодОквэд2Уровень . '" target="_blank">' . $row->НазваниеОквэд . '</a></td>
        </tr>';
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

  </body>
  </html>