<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf8">
  <title>Разделы ОКВЭД</title>
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
    
    
    <div class="row">

      <div class="col-12">

        <p class="h4" style="text-align: center">Разделы ОКВЭД</p><br>
        <div class="table-responsive" style="overflow-y: auto; min-height:200px; max-height: 600px;">
          <figure class="wp-block-table">
            <table class="table table-hover table-bordered" style="text-align:center">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Раздел</th>
                  <th scope="col">Название ОКВЭД</th>
                </tr>
              </thead>
              <tbody>
                
                <?php 
                
                require_once('wp-load.php');

                global $wpdb;
                
                
                $sql_select = $wpdb->get_results($wpdb->prepare("
                 SELECT DISTINCT КодыОквэд.КодОквэд, КодыОквэд.НазваниеОквэд 
                 FROM КодыОквэд 
                 INNER JOIN Разделы
                 ON КодыОквэд.КодОквэд = Разделы.НазваниеРаздела
                 ORDER BY КодОквэд"));
                
                
                foreach ($sql_select as $row) {
                  echo '<tr> 
                  <td> <a href="/okved_level1.php?chapter=' . $row->КодОквэд .'" target="_blank">' . $row->КодОквэд . '</a></td>
                  <td> <a href="/okved_level1.php?chapter=' . $row->КодОквэд .'" target="_blank">' . $row->НазваниеОквэд . ' </a></td></tr>';
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