<?php

if (!empty($_POST['name_of_center'])) {

  require_once('wp-load.php');

  global $wpdb;
  
  $name_of_center = $_POST['name_of_center'];
  
  sanitize_text_field($name_of_center);
  
  $result = $wpdb->get_results($wpdb->prepare("SELECT DISTINCT НазваниеЦентра FROM ИнформацияПоЦентрам 
    WHERE НазваниеЦентра LIKE '{$name_of_center}%' ORDER BY НазваниеЦентра LIMIT 0, 5"));
  
  if ($result) {
    ?>
    <div class="search_result">
      <table>
        <?php foreach ($result as $row): ?>
          <tr>
            <td class="search_result-name">
              <button type="button" style="font: inherit; color: inherit; background-color: transparent;"
              onClick="document.getElementById('name_of_center').value = '<?php echo $row->НазваниеЦентра ?>'">
              <?php echo $row->НазваниеЦентра; ?></button> 
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <?php
  }
}

if (!empty($_POST['name_of_competency'])) {

  require_once('wp-load.php');

  global $wpdb;
  
  $name_of_competency = $_POST['name_of_competency'];
  
  sanitize_text_field($name_of_competency);

  $result = $wpdb->get_results($wpdb->prepare("SELECT DISTINCT НазваниеКомпетенции FROM ЦентрыКомпетенций
    WHERE НазваниеКомпетенции LIKE '{$name_of_competency}%' ORDER BY НазваниеКомпетенции LIMIT 0, 5"));
  
  
  if ($result) {
    ?>
    <div class="search_result">
      <table>
        <?php foreach ($result as $row): ?>
          <tr>
            <td class="search_result-name">
              <button type="button" style="font: inherit;color: inherit;background-color: transparent;"
              onClick="document.getElementById('name_of_competency').value = '<?php echo $row->НазваниеКомпетенции ?>'">
              <?php echo $row->НазваниеКомпетенции; ?></button>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <?php
  }
}

if (!empty($_POST['country'])) {

  require_once('wp-load.php');

  global $wpdb;
  
  $country = $_POST['country'];
  
  sanitize_text_field($country);

  $result = $wpdb->get_results($wpdb->prepare("SELECT DISTINCT Страна FROM ЦентрыКомпетенций
    WHERE Страна LIKE '{$country}%' ORDER BY Страна LIMIT 0, 5"));
  
  
  if ($result) {
    ?>
    <div class="search_result">
      <table>
        <?php foreach ($result as $row): ?>
          <tr>
            <td class="search_result-name">
              <button type="button" style="font: inherit;color: inherit;background-color: transparent;" 
              onClick="document.getElementById('country').value = '<?php echo $row->Страна ?>'">
              <?php echo $row->Страна; ?></button>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <?php
  }
}

if (!empty($_POST['keyword'])) {

  require_once('wp-load.php');

  global $wpdb;
  
  $keyword = $_POST['keyword'];
  
  sanitize_text_field($keyword);

  $result = $wpdb->get_results($wpdb->prepare("
    SELECT DISTINCT КлючевоеСлово
    FROM КлючевыеСлова
    WHERE КлючевоеСлово LIKE '{$keyword}%'
    UNION
    SELECT DISTINCT Keyword
    FROM Keywords
    WHERE Keyword LIKE '{$keyword}%'
    ORDER BY КлючевоеСлово LIMIT 0, 5"));
  
  
  if ($result) {
    ?>
    <div class="search_result">
      <table>
        <?php foreach ($result as $row): ?>
          <tr>
            <td class="search_result-name">
              <button type="button"
              style="font: inherit;color: inherit;background-color: transparent;" onClick="document.getElementById('keyword').value = '<?php echo $row->КлючевоеСлово ?>'">
              <?php echo $row->КлючевоеСлово; ?></button>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <?php
  }
}


if (!empty($_POST['district'])) {

  require_once('wp-load.php');

  global $wpdb;
  
  $district = $_POST['district'];
  
  sanitize_text_field($district);
  
  $result = $wpdb->get_results($wpdb->prepare("SELECT DISTINCT Округ FROM РоссийскиеЦентры 
    WHERE Округ LIKE '{$district}%' ORDER BY Округ LIMIT 0, 5"));
  
  if ($result) {
    ?>
    <div class="search_result">
      <table>
        <?php foreach ($result as $row): ?>
          <tr>
            <td class="search_result-name">
              <button type="button"  class="btn btn-link"  
              onClick="document.getElementById('district').value = '<?php echo $row->Округ ?>'">
              <?php echo $row->Округ; ?></button>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <?php
  }
}


if (!empty($_POST['region'])) {

  require_once('wp-load.php');

  global $wpdb;
  
  $region = $_POST['region'];
  
  sanitize_text_field($region);
  
  $result = $wpdb->get_results($wpdb->prepare("SELECT DISTINCT Регион FROM РоссийскиеЦентры 
    WHERE Регион LIKE '{$region}%' ORDER BY Регион LIMIT 0, 5"));
  
  if ($result) {
    ?>
    <div class="search_result">
      <table>
        <?php foreach ($result as $row): ?>
          <tr>
            <td class="search_result-name">
              <button type="button"  class="btn btn-link" 
              onClick="document.getElementById('region').value = '<?php echo $row->Регион ?>'">
              <?php echo $row->Регион; ?></button>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <?php
  }
}

?>