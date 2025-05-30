<?php
    $myimg = isset($_FILES['myimg'])? $_FILES['myimg'] : 'nofile';
    $mydata = isset($_POST['data'])? $_POST['data'] : 'nodata';
    
    //header (this file) is valid
    // $id = isset($_POST['id'])? $_POST['id'] : -1;
    // if($id > 0) header('Location:http://localhost:3000/module/SQL_on_PHP/POST.php');
  
?>

<p> data: <?=$_POST['data']?> </p>
<p> file: <?=var_dump($_FILES['myimg']['tmp_name'])?> </p>


<?php
    
    foreach($_FILES['myimg']['tmp_name'] as $filename){      
?>
        
        <p> from: <?=$filename?> </p>
        <img src=data:image/png;base64,<?=base64_encode(file_get_contents($filename))?> />
        
<?php
    }
?>







