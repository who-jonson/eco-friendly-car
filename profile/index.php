<?php
// profile index
session_start();

require '../config.php';
require '../classes/DbModel.php';
require '../classes/Functions.php';

Functions::checkLogging();

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if(isset($post['update_general'])){
    $db = new DbModel;

    $dob = $post['dob'];
    $dob = date('Y-m-d', strtotime($dob));
    $gender = (isset($post['gender']))? $post['gender'] : '';

    $stmt = 'UPDATE users SET full_name = :full_name, user_name = :user_name, email = :email, dob = :dob, gender = :gender,
                address = :address, post_code = :post_code, country = :country WHERE id = :id';
    $db->query($stmt);
    $db->bind(':full_name', $post['name']);
    $db->bind(':user_name', $post['user_name']);
    $db->bind(':email', $post['email']);
    $db->bind(':dob', $dob);
    $db->bind(':gender', $gender);
    $db->bind(':address', $post['address']);
    $db->bind(':post_code', $post['post_code']);
    $db->bind(':country', $post['country']);
    $db->bind(':id', $_SESSION['user_data']['id']);

    $db->execute();

    $db = null;

    //reset login
    Functions::refreshUserLogin($_SESSION['user_data']['id']);

    header('Refresh:1; url=' . ROOT_URL . 'profile');
    echo '<script>alert("Profile successfully updated.");</script>';
    exit();
}
//update password
if(isset($post['update_security'])){
    $db = new DbModel;

    $stmt = 'SELECT * FROM users WHERE id = :id';
    $db->query($stmt);
    $db->bind(':id', $_SESSION['user_data']['id']);
    $user = $db->single();

    if($user['password'] == md5($post['old_password'])){

        if($post['new_password'] != $post['conf_new_password']) {
            header('Refresh:1; url=' . ROOT_URL . 'profile/security');
            echo '<script>alert("New passwords did not match!");</script>';
            $db = null;
            exit();
        }
        else {
            $stmt = 'UPDATE users SET password = :password WHERE id = :id';
            $db->query($stmt);
            $db->bind(':password', md5($post['new_password']));
            $db->bind(':id', $_SESSION['user_data']['id']);
            $db->execute();

            header('Refresh:1; url=' . ROOT_URL . 'profile/security');
            echo '<script>alert("Password successfully updated.");</script>';
            $db = null;
            exit();
        }
    }
    else {
        header('Refresh:1; url=' . ROOT_URL . 'profile/security');
        echo '<script>alert("Old password is wrong.");</script>';
        $db = null;
        exit();
    }
}
//update profile image
if(isset($post['update_photo'])){
    $db = new DbModel;

    $stmt = 'UPDATE users SET img_url = :img_url WHERE id = :id';
    $db->query($stmt);
    $db->bind(':img_url', $post['img_url']);
    $db->bind(':id', $_SESSION['user_data']['id']);
    $db->execute();

    //reset login
    Functions::refreshUserLogin($_SESSION['user_data']['id']);

    header('Refresh:1; url=' . ROOT_URL . 'profile/photo');
    echo '<script>alert("Profile Picture successfully updated.");</script>';
    $db = null;
    exit();
}

$db = new DbModel;

$stmt = 'SELECT * FROM users WHERE id = :id';
$db->query($stmt);

$db->bind(':id', $_SESSION['user_data']['id']);

$user = $db->single();
$db = null;

if(!$user){
    header('Refresh:1; url='. ROOT_URL . 'cars');
    echo '<script>alert("Something went wrong!");</script>';
    exit();
}

?>

<?php include '../viewIncludes/header.php'; ?>

    <div class="page-title" style="background-image: url('<?php echo ROOT_URL; ?>assets/images/page-title-bg.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <h1><?php echo $_SESSION['user_data']['name']; ?></h1>
                </div>
                <div class="col-xs-12 col-sm-8">
                    <p class="text-right">
                        <a href="<?php echo ROOT_URL; ?>">Home </a> /
                        <span class="active"><?php echo $_SESSION['user_data']['user_name']; ?></span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="container">
            <div class="row">
               <div id="profile">
                   <div class="col-md-3">
                       <div class="profile-sidebar">
                            <ul>
                                <li><a id="pro-side-general-active" href="<?php echo ROOT_URL . 'profile'; ?>">General</a></li>
                                <li><a id="pro-side-photo-active" href="<?php echo ROOT_URL . 'profile/photo'; ?>">Photo</a></li>
                                <li><a id="pro-side-security-active" href="<?php echo ROOT_URL . 'profile/security'; ?>">Security</a></li>
                            </ul>
                       </div>
                   </div>
                   <div class="col-md-9">
                       <div class="profile-content">
                            <?php
                                if(isset($_GET['option']) && $_GET['option'] == 'photo') {
                                    include 'includes/photo.php';
                                }
                                else if(isset($_GET['option']) && $_GET['option'] == 'security'){
                                    include 'includes/security.php';
                                }
                                else {
                                    include 'includes/general.php';
                                }
                            ?>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>


<?php include '../viewIncludes/footer.php'; ?>