<?php
require_once 'dbconn.php';
require_once 'generatetoken.php';

class TokenManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function storeToken($response)
    
    {
        // session_start();
        $response = json_decode($response, true);

        if (isset($response['access_token'])) 
        {
            $accessToken = $response['access_token'];
            //   var_dump($accessToken);
             
            if (isset( $_SESSION['email'])) 
            { 
                $email = $_SESSION['email'];
                //    var_dump($email);


                $this->insertTokenToDatabase($email, $accessToken);
                //  echo 'success';
                
                return true;
            }
        }
    }

    private function insertTokenToDatabase($email, $accessToken)
    {
        $sql = "INSERT INTO generatetoken (email, generated_time, token) VALUES ('$email', now(), '$accessToken')";
        //  echo $sql;
        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            //    echo 'Token inserted successfully';
        } else {
            echo 'Error inserting token: ' . mysqli_error($this->conn);
        }
    }
   
}


$tokenManager = new TokenManager($conn);
$tokenManager->storeToken($response);

?>