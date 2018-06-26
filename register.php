<?php
    //Registration Page
    session_start();

    require 'config.php';
    require 'classes/DbModel.php';
    require 'classes/Functions.php';

    if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']) {
        header('Location: ' . ROOT_URL . 'cars');
        exit();
    }

    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if($post['submit']){
        $db = new DbModel;

        $dob = $post['dob'];
        $dob = date('Y-m-d', strtotime($dob));
        if($post['gender'] == 'female'){
            $img_url = ROOT_URL . 'assets/images/user-female.jpg';
        }
        else {
            $img_url = ROOT_URL . 'assets/images/user-male.jpg';
        }

        // Insert into MySQL
        $stmt = 'INSERT INTO 
                    users (full_name, user_name, email, password, dob, gender, address, post_code, country, user_type, img_url) 
                    VALUES(:full_name, :user_name, :email, :password, :dob, :gender, :address, :post_code, :country, :user_type, :img_url)';
        //prepare the statement
        $db->query($stmt);
        //bind values
        $db->bind(':full_name', $post['name']);
        $db->bind(':user_name', $post['user_name']);
        $db->bind(':email', $post['email']);
        $db->bind(':password', md5($post['password']));
        $db->bind(':dob', $dob);
        $db->bind(':gender', $post['gender']);
        $db->bind(':address', $post['address']);
        $db->bind(':post_code', $post['post_code']);
        $db->bind(':country', $post['country']);
        $db->bind(':user_type', 'user');
        $db->bind(':img_url', $img_url);

        $db->execute();
        // Verify
        if($db->lastInsertId()){
            // Redirect
            $dob = date_create($dob);
            $today = date_create(date('Y-m-d'));
            $age = date_diff($dob, $today);

            $_SESSION['is_logged_in'] = true;
            $_SESSION['last_logged_in'] = time();
            $_SESSION['user_data'] = array(
                'id'	        => $db->lastInsertId(),
                'name'	        => $post['name'],
                'user_name'     => $post['user_name'],
                'email'	        => $post['email'],
                'dob'           => $dob,
                'age'           => $age->format('Age: %y Years'),
                'img_url'       => $img_url,
                'gender'        => $post['gender'],
                'address'       => $post['address'],
                'post_code'     => $post['post_code'],
                'country'       => $post['country'],
                'type'          => 'user'
            );

            $db = null;
            Functions::countPageVisits();
            header('Location: ' . ROOT_URL . 'cars');
            exit();
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
                    <?php include 'viewIncludes/registration.php'; ?>
                </div>

            </div>
        </div>
    </div>

<?php include 'viewIncludes/index_footer.php'; ?>