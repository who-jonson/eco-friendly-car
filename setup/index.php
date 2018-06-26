<?php
    //setup file
    require '../config.php';

    class Setup{

        protected $con;
        protected $db;

        public function __construct() {
            // Create connection
            $this->con = new mysqli(DB_HOST, DB_USER, DB_PASS);
            // Check connection
            if ($this->con->connect_error) {
                die("Connection failed: " . $this->con->connect_error);
            }

        }

        // Drop database
        public function dropDatabase(){

            $stmt = "DROP DATABASE IF EXISTS eco_friendly_car";

            if ($this->con->query($stmt)) {
                echo 'Database dropped successfully';
            }
            else {
                echo "Error: " . $this->con->error;
            }
            return;
        }

        // Create database
        public function createDatabase(){
            $stmt = "CREATE DATABASE eco_friendly_car";

            if ($this->con->query($stmt)) {
                echo 'Database created successfully';
                //select eco_friendly_car as database
                $this->con->select_db('eco_friendly_car');
            }
            else {
                echo "Error: " . $this->con->error;
            }
            return;
        }

        public function createTables(){
            //create users table
            $stmt = "CREATE TABLE users(
						id INT(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
						full_name VARCHAR(40) NOT NULL,
						user_name VARCHAR(30) NOT NULL UNIQUE,
						email VARCHAR(40) NOT NULL UNIQUE,
						password VARCHAR(32) NOT NULL,
						dob DATE,
						gender VARCHAR(10),
						address VARCHAR(255),
						post_code VARCHAR(10),
						country VARCHAR(20),
						user_type VARCHAR(10) NOT NULL,
						img_url VARCHAR(70),
						created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
						updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
					)";

            if(!$this->con->query($stmt)){
                echo "Error: " . $this->con->error;
            }

            //create cars table
            $stmt = "CREATE TABLE cars(
						id int(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
						category_id INT(11) NOT NULL,
						features VARCHAR (1024),
						slug VARCHAR(55) NOT NULL UNIQUE,
						model VARCHAR(40) NOT NULL,
						color VARCHAR(100) NOT NULL,
						img_url VARCHAR(255),
						price VARCHAR(20) NOT NULL,
						engine VARCHAR(20) NOT NULL,
						power VARCHAR(20) NOT NULL,
						top_speed VARCHAR(55),
						fuel_type VARCHAR(20) NOT NULL,
						brake VARCHAR(20) NOT NULL,
						gear VARCHAR(55) NOT NULL,
						wheel_size VARCHAR(20),
						wheel_material VARCHAR(40),
						rate_fuel INT(2) NOT NULL,
						rate_battery INT(2) NOT NULL,
						rate_car INT(2) NOT NULL,
						details VARCHAR(500),
						views INT(11),
						created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
						updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
					)";

            if(!$this->con->query($stmt)){
                echo "Error: " . $this->con->error;
            }

            //comments table
            $stmt = "CREATE TABLE comments(
						id INT(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
						user_id INT(11) NOT NULL,
						car_id INT(11),
						comment VARCHAR(555),
						created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
						updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
					)";

            if(!$this->con->query($stmt)){
                echo "Error: " . $this->con->error;
            }

            //categories table
            $stmt = "CREATE TABLE categories(
						id INT(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
						name VARCHAR(40) NOT NULL,
						slug VARCHAR(55) NOT NULL,
						created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
						updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
				)";

            if(!$this->con->query($stmt)){
                echo "Error: " . $this->con->error;
            }

            //user's history table
            $stmt = "CREATE TABLE histories(
                        id INT(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                        user_id INT(11) NOT NULL,
                        car_id INT(11) NOT NULL,
                        total_viewed INT(11),
                        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
                    )";

            if(!$this->con->query($stmt)){
                echo "Error: " . $this->con->error;
            }

            //user's favorites table
            $stmt = "CREATE TABLE favorites(
                        id INT(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                        user_id INT(11) NOT NULL,
                        car_id INT(11) NOT NULL,
                        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
                        )";

            if(!$this->con->query($stmt)){
                echo "Error: " . $this->con->error;
            }

            //site options table
            $stmt = "CREATE TABLE options(
                        id INT(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                        option_name VARCHAR(55) NOT NULL,
                        option_value VARCHAR(1024),
                        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
                        )";

            if(!$this->con->query($stmt)){
                echo "Error: " . $this->con->error;
            }

            echo 'All tables are created successfully!';

            $this->con->close();
            return;

        }

        public function insertDemoData(){



            echo 'Demo dat inserted successfully!';

            $this->con->close();
            return;
        }

    }

    $setup = new Setup;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Setup Admin</title>
    <link rel="icon" href="<?php echo ROOT_URL ?>favicon.ico">
    <meta name="robots" content="noindex, nofollow">

    <!-- Bootstrap -->
    <link href="<?php echo ROOT_URL ?>assets/styles/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

</head>
<body>

    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 text-center">
                <div class="panel panel-default">
                    <div class="panel-body text-danger">
                        <h3><?php $setup->dropDatabase(); ?></h3>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body text-success">
                        <h3><?php $setup->createDatabase(); ?></h3>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body text-success">
                        <h3><?php $setup->createTables(); ?></h3>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Create Admin</h3>
                    </div>
                    <div class="panel-body">
                        <a class="btn btn-info" href="<?php echo ROOT_URL ?>setup/add-admin">Create New Admin</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo ROOT_URL ?>assets/styles/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo ROOT_URL; ?>assets/plugins/jquery_validation/jquery.validate.min.js"></script>
    <script src="<?php echo ROOT_URL; ?>assets/js/formValidator.js"></script>
</body>
</html>

