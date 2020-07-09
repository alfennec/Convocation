<?php

    include_once('includes/config.php');


    // if user click Login button
    if(isset($_POST['btnLogin'])) {

        // get username and password
        $apogee = $_POST['apogee'];

        // set time for session timeout
        $currentTime = time() + 25200;
        $expired = 3600;

        // create array variable to handle error
        $error = array();

        // check whether $username is empty or not
        if(empty($apogee)) {
            $error['apogee'] = "*Entre votre apogée.";
        }

       

        // if username and password is not empty, check in database
        if(!empty($apogee)) 
        {

            // change username to lowercase
            $apogee = strtolower($apogee);

            // get data from user table
            $sql_query = "SELECT * FROM convocation WHERE apogee = ? ";

            $stmt = $connect->stmt_init();
            if($stmt->prepare($sql_query)) {
                // Bind your variables to replace the ?s
                $stmt->bind_param('s', $apogee);
                // Execute query
                $stmt->execute();
                /* store result */
                $stmt->store_result();
                $num = $stmt->num_rows;
                // Close statement object
                $stmt->close();
                if($num != 0) 
                {
                    $_SESSION['apogee'] = $apogee;
                    $_SESSION['timeout'] = $currentTime + $expired;
                    header("location: dashboard.php");
                } else {
                    $error['failed'] = "Votre numéro Apogée n'est pas valide !";
                }
            }

        }
    }
?>

    <div class="login-box">
        <div class="card">
            <div class="body">
                <form method="POST">
                    <center>
                        <img src="assets/images/ic_launcher.png" width="200px" height="200px">
                        <br>
                        <div class="custom-padding1">
                            Convocation des Examens 2019/2020
                        </div>
                        <div class="custom-padding2 col-pink"><?php echo isset($error['failed']) ? $error['failed'] : '';?></div>
                    </center>
                    
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="apogee" placeholder="Numéro Apogée" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-8 p-t-5"></div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-blue waves-effect" type="submit" name="btnLogin">Valider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>