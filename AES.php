<?php 

class AES{
        function encrypt_decrypt($action, $string) {
                $output = false;
    
                $encrypt_method = "AES-256-CBC";
                $secret_key = 'sadgjakgdkjafkj';
                $secret_iv = 'This is my secret iv';
    
                $key = hash('sha256', $secret_key);
                
                $iv = substr(hash('sha256', $secret_iv), 0, 16);
    
                if ( $action == 'encrypt' ) {
                    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
                    $output = base64_encode($output);
                } else if( $action == 'decrypt' ) {
                    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
                }
    
                return $output;
            }
}
        
  /*          if(isset($_POST['submit'])){

                $data=$_POST['foo'];
                $encrypted=encrypt_decrypt( 'encrypt', $data);
                $decrypted=encrypt_decrypt( 'decrypt', $encrypted);
                echo '<h2>Original Data</h2>';
                echo '<p>'.$data.'</p>';
                echo '<h2>Encrypted Data</h2>';
                echo '<pre>'.$encrypted.'</pre>';
        
                echo '<h2>Decrypted Data</h2>';
                echo '<p>'.$decrypted.'</p>';
        }
         
        echo '<form method="post">
        <input type="text" name="foo">
        <input type="submit" name="submit" value="submit">
        </form>';*/
        ?>
