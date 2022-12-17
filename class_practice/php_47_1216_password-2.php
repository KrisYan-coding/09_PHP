
<?php 
    $pass = '123456';
    
    echo password_hash($pass, PASSWORD_DEFAULT);

    $hash = password_hash($pass, PASSWORD_DEFAULT);

    echo '<br>';
    

    echo password_verify($pass, $hash);


 ?>