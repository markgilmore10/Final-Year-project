<?php

class ControllerUsers {

    public function UserLogin() {

        if(isset($_POST["loginUser"])) {

            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["loginUser"]) && 
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["loginPassword"])) {
                
                $table = 'users';

                $item = 'user';
                $value = $_POST["loginUser"];

                $answer = UserModel::ModelShowUser($table, $item, $value);

                if($answer["user"] == $_POST["loginUser"] && $answer["password"] == $_POST["loginPassword"]){

                    $_SESSION["loggedIn"] == "ok";

                        echo '<script>

                            window.location = "dashboard";

                        </script>';

                    

                }else{
                    
                    echo '<br><div class="alert alert-danger">User does not exist</div>';
                
                }

                
            
            }
        }
    }
}