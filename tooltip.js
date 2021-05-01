$(document).ready(function() {  

  var $result_name = $('#search_box_name_of_center');

  var $result_competence = $('#search_box_name_of_competency');
  
  var $result_country = $('#search_box_name_of_country');
  
  var $result_keyword = $('#search_box_keyword');
  
  var $result_district = $('#search_box-district-result');
  
  var $result_region = $('#search_box-region-result');
  

  $('#name_of_center').on('keyup', function(){
    

    var name_of_center= $(this).val();

    if ((name_of_center != '') && (name_of_center.length > 1)){

      $.ajax({

        type: "POST",

        url: "/tooltip_search.php",

        data: {'name_of_center': name_of_center},

        success: function(msg){

          $result_name.html(msg);
          
          if(msg != ''){  

            $result_name.fadeIn();
            
          } else {

            $result_name.fadeOut(100);
            
          }

        }

      });

    } else {

      $result_name.html('');

      $result_name.fadeOut(100);

    }

  });
  
  
  $('#keyword').on('keyup', function(){
    

    var keyword= $(this).val();

    if ((keyword != '') && (keyword.length > 1)){

      $.ajax({

        type: "POST",

        url: "/tooltip_search.php",

        data: {'keyword': keyword},

        success: function(msg){

          $result_keyword.html(msg);
          
          if(msg != ''){  

            $result_keyword.fadeIn();
            
          } else {

            $result_keyword.fadeOut(100);
            
          }

        }

      });

    } else {

      $result_keyword.html('');

      $result_keyword.fadeOut(100);

    }

  });

  $('#name_of_competency').on('keyup', function(){
    
    var name_of_competency= $(this).val();

    if ((name_of_competency!= '') && (name_of_competency.length > 1)){

      $.ajax({

        type: "POST",

        url: "/tooltip_search.php",

        data: {'name_of_competency': name_of_competency},

        success: function(msg){

          $result_competence.html(msg);

          if(msg != ''){  

            $result_competence.fadeIn();

          } else {

            $result_competence.fadeOut(100);

          }

        }

      });

      

    } else {

      $result_competence.html('');

      $result_competence.fadeOut(100);

    }

  });
  
  
  $('#country').on('keyup', function(){

    var country= $(this).val();

    if ((country != '') && (country.length > 1)){

      $.ajax({

        type: "POST",

        url: "/tooltip_search.php",

        data: {'country': country},

        success: function(msg){

          $result_country.html(msg);
          
          if(msg != ''){  

            $result_country.fadeIn();
            
          } else {

            $result_country.fadeOut(100);
            
          }

        }

      });

    } else {

      $result_country.html('');

      $result_country.fadeOut(100);

    }

  });
  
  $('#district').on('keyup', function(){

    var district= $(this).val();

    if ((district != '') && (district.length > 1)){

      $.ajax({

        type: "POST",

        url: "/tooltip_search.php",

        data: {'district': district},

        success: function(msg){

          $result_district.html(msg);
          
          if(msg != ''){  

            $result_district.fadeIn();
            
          } else {

            $result_district.fadeOut(100);
            
          }

        }

      });

    } else {

      $result_district.html('');

      $result_district.fadeOut(100);

    }

  });

  
  
  $('#region').on('keyup', function(){

    var region= $(this).val();

    if ((region != '') && (region.length > 1)){

      $.ajax({

        type: "POST",

        url: "/tooltip_search.php",

        data: {'region': region},

        success: function(msg){

          $result_region.html(msg);
          
          if(msg != ''){  

            $result_region.fadeIn();
            
          } else {

            $result_region.fadeOut(100);
            
          }

        }

      });

    } else {

      $result_region.html('');

      $result_region.fadeOut(100);

    }

  });
  
  
  
  
  

  $(document).on('click', function(e){

    if (!$(e.target).closest('.search_box').length){

      $result_name.html('');

      $result_name.fadeOut(100);

      $result_competence.html('');

      $result_competence.fadeOut(100);
      
      $result_country.html('');

      $result_country.fadeOut(100);
      
      $result_keyword.html('');

      $result_keyword.fadeOut(100);
      
      $result_district.html('');

      $result_district.fadeOut(100);
      
      $result_region.html('');

      $result_region.fadeOut(100);

    }

  });

});