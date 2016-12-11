<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Requests</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
  
<h1><a href='requests_tester.php'>Test Get/POST</a> </h1>
  
  <form class="form-horizontal">
   
  <!--Row1 -->   
  <div class="form-group">
    <label class="control-label col-sm-2" for="request">Request Type</label>
    <div class="col-sm-10">
    <?php     echo getRequestDropdown($_GET['request_type']);     ?>
    </div>
 </div>

  <!--Row2 -->   
  <div class="form-group">
     <label class="control-label col-sm-2" for="url">URL:</label>
      <div class="col-sm-5">          
        <input type="text" class="form-control" id="url" name="url" placeholder="http://example.com/api/" value="<?php echo $_GET['url'] ; ?>">
      </div>
  </div>
  
  <!--Row3 -->  
    <div class="form-group">
      <label class="control-label col-sm-2" for="number_of_pairs_dropdown">Number of Key Value Pairs</label>
      <div class="col-sm-10">
         <?php     echo getPairsDropdown($_GET['number_of_pairs_dropdown']);     ?>
      </div>
    </div>
   
  <!--Row4 -->   
   
    <div class='row'>
      
   <div class='col-sm-8'>
    <div class="form-group">        
      <label class="control-label col-sm-5" >KEY</label>
      <label class="control-label col-sm-5" >VALUE</label>
    </div>
  <?php
    echo getMoreKeyValuePairs($_GET['number_of_pairs_dropdown']);
   ?>
    
    <div class="form-group">        
      <div class="col-sm-offset-5 col-sm-10">
        <button type="submit" class="btn btn-primary" value='submit' name='request'>Submit</button>
      </div>
    </div>
    
      </div>
     
     <div class='col-sm-4'>
     <pre>Result of JSON <?php echo $response; ?></pre> 
     </div>  
    </div>
      
  </form>
     
      
       
</div>
<?php

  function getMoreKeyValuePairs($number_of_pairs){

    
    $number_of_pairs = isset($number_of_pairs)? $number_of_pairs: 1;
    $html = "";
    for($i=1;$i<=$number_of_pairs; $i++){
      
      $key = isset($_GET["key$i"]) ? $_GET["key$i"] : "";
      $val = isset($_GET["val$i"]) ? $_GET["val$i"] : "";
      
      $html.='<div class="form-group">';        
      
      $html.='<div class="col-sm-5">';
      $html.='<input type="text" class="form-control" placeholder="Key #'.$i.'" name="key' . $i . '"  value="'.$key. '">'; 
      $html.='</div>';
      
       
      $html.='<div class="col-sm-5">';
      $html.='<input type="text" class="form-control" placeholder="Value #'.$i.'" name="value' . $i . '"  value="'.$val. '">'; 
      $html.='</div>';
      
      $html.='</div>';

     
    }
    return $html;   
 
    
  }
    
  
function getPairsDropdown($number_of_pairs){
  $html = "<select id='number_of_pairs_dropdown'  name='number_of_pairs_dropdown' onChange='this.form.submit()'>";
 
  for($i=1; $i<= 10; $i++){
    $select = $i == $number_of_pairs ? "selected" : "";
    $html .= "<option value='$i' $select>$i</option>";
  }
  $html .= "</select>";
  
  return $html;
}  
    
  
function getRequestDropdown($request_type){
  $html = "<select id='request' name='request_type'>";
  $requests = array('post','get');
  foreach($requests as $type){
    $select = $type == $request_type ? "selected" : "";
    $html .= "<option value='$type' $select>$type</option>";
  }
  $html .= "</select>";
  return $html;
}
?>


    
</body>
</html>
