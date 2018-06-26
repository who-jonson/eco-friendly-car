<?php
    //Main index & Login Page
    session_start();

    require 'config.php';
    require 'classes/DbModel.php';
    require 'classes/Functions.php';

    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //Logout user
    if(isset($post['logout_val']) && $post['logout_val'] == '1'){
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['user_data']);
        session_destroy();
        // Redirect
        header('Location: '. ROOT_URL);
        exit();
    }

    //Redirect user if logged in
    if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']) {
        header('Location: ' . ROOT_URL . 'cars');
        exit();
    }

    //Login
    if(isset($post['login'])){

        if(isset($_COOKIE['login_failed']) && $_COOKIE['login_failed']) {
            $time_left = intval($_COOKIE['login_failed'] - time());

            header('Refresh:1; url='. ROOT_URL);
            echo '<script>alert("Too many attempts! PLease try after ' . $time_left . '")</script>';
            exit();
        }

        $db = new DbModel;

        $stmt = 'SELECT * FROM users WHERE user_name = :user_name AND password = :password';
        $db->query($stmt);
        $db->bind(':user_name', $post['user_name']);
        $db->bind(':password', md5($post['password']));

        $row = $db->single();
        $db = null;
        if($row){

            $dob = date_create($row['dob']);
            $today = date_create(date('Y-m-d'));
            $age = date_diff($dob, $today);

            $_SESSION['is_logged_in'] = true;
            $_SESSION['last_logged_in'] = time();
            $_SESSION['user_data'] = array(
                'id'	        => $row['id'],
                'name'	        => $row['full_name'],
                'user_name'     => $row['user_name'],
                'email'	        => $row['email'],
                'dob'           => ($dob == null)? '' : $dob,
                'age'           => $age->format('Age: %y Years'),
                'img_url'       => $row['img_url'],
                'gender'        => $row['gender'],
                'address'       => $row['address'],
                'post_code'     => $row['post_code'],
                'country'       => $row['country'],
                'type'          => $row['user_type']
            );

            Functions::countPageVisits();
            header('Location: ' . ROOT_URL . 'cars');
            exit();
        }
        else {
            if(!isset($_COOKIE['login_attempt_count'])){
                setcookie('login_attempt_count', 1, time() + 300);
            }
            else {
                if((int)$_COOKIE['login_attempt_count'] > 1){
                    setcookie('login_failed', true, time() + 300);
                }
                setcookie('login_attempt_count', $_COOKIE['login_attempt_count']+1, time() + 300);
            }
            echo '<script>alert("Wrong user details.");</script>';
        }
    }

?>



<?php include 'viewIncludes/index_header.php'; ?>

    <div class="container">
        <div class="row">
            <div class="hidden-xs hidden-sm col-md-5">
                <div class="index-slogan">
                    <p class="text-center">
                        Welcome To <br><strong>Eco-Friendly Car</strong>
                        <br><br>
                        <span class="index-slogan-tag">Keeping ahead through latest cars</span>
                    </p>
                </div>
            </div>

            <div class="col-md-7">
                <div class="registration-form">
                    <?php include 'viewIncludes/loginView.php'; ?>
                </div>

            </div>
        </div>
    </div>


<?php include 'viewIncludes/index_footer.php'; ?>