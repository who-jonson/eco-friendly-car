<?php
/**
 All Methods
 */

class Functions {

    private static $features = array(
        'ABS', 'Air Bags', 'Alloy Rims', 'AM/FM Radio', 'Air Conditioning', 'DVD Player', 'Immobilizer key', 'Keyless Entry',
        'Power Locks', 'Power Mirrors', 'Power Steering', 'Power Windows', 'Keyless Engine Start', 'Anti-Theft Alarm System w/Immobilizer',
        'Motion Sensor', 'SiriusXM Satellite Radio', 'Electric Power-Assist Steering', 'Permanent Locking Hubs'
    );

    public static function checkLogging(){
        if(!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']){
            header('Location: ' . ROOT_URL);
            exit();
        }
        else {
            if(time() - $_SESSION['last_logged_in'] > 900) { // 15 minutes * 60 = 900 seconds
                echo '<script>alert("No activity within 15 minutes; Please log in again.");</script>';

                unset($_SESSION['is_logged_in']);
                unset($_SESSION['user_data']);
                unset($_SESSION['last_logged_in']);

                session_destroy();
                header('Refresh:1; url='. ROOT_URL);
                exit();

            } else {
                $_SESSION['last_logged_in'] = time();
            }
        }
        return;
    }

    public static function createSlug($text, $table)
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        if (empty($text)) {
            $text =  'n-a';
        }
        $slug = $text;

        $db = new DbModel;
        $uniqueSlug = false;
        $count = 1;
        $stmt = 'SELECT * FROM ' . $table . ' WHERE slug = :slug';
        $db->query($stmt);

        do{
            $db->bind(':slug', $slug);

            $rows = $db->resultSet();
            if($rows){
                $slug = $text . '-' . $count;
                $count++;
            }
            else {
                $uniqueSlug = true;
            }

        }while(!$uniqueSlug);

        $db = null;

        return $slug;

    }

    public static function countPageVisits(){
        if(!isset($_COOKIE['page_visited']) || !$_COOKIE['page_visited']){
            $db = new DbModel;

            $stmt = 'SELECT * FROM options WHERE option_name = :option_name';
            $db->query($stmt);

            $db->bind(':option_name', 'view_count');
            $option = $db->single();

            if($option){
                $view_count = $option['option_value'];
                $view_count = intval($view_count);
                $view_count += 1;

                $stmt = 'UPDATE options SET option_value = :option_value WHERE option_name = :option_name';
                $db->query($stmt);

                $db->bind(':option_value', $view_count);
                $db->bind(':option_name', 'view_count');
                $db->execute();
                $db = null;

                setcookie('page_visited', true, (time() + (24*60*60)), '/');
            }
        }
        return;
    }

    public static function addHistory($user_id, $car_id){
        $db = new DbModel;

        $stmt = 'SELECT * FROM histories WHERE user_id = :user_id AND car_id = :car_id';
        $db->query($stmt);

        $db->bind(':user_id', $user_id);
        $db->bind(':car_id', $car_id);
        $row = $db->single();

        if($row){
            $total_viewed = $row['total_viewed'];
            $total_viewed += 1;

            $stmt = 'UPDATE histories SET total_viewed = :total_viewed WHERE user_id = :user_id AND car_id = :car_id';
            $db->query($stmt);

            $db->bind(':total_viewed', $total_viewed);
            $db->bind(':user_id', $user_id);
            $db->bind(':car_id', $car_id);
            $db->execute();
        }
        else {
            $stmt = 'INSERT INTO histories (user_id, car_id, total_viewed) VALUES (:user_id, :car_id, :total_viewed)';
            $db->query($stmt);

            $db->bind(':user_id', $user_id);
            $db->bind(':car_id', $car_id);
            $db->bind(':total_viewed', 1);
            $db->execute();
        }

        $db = null;
        return;
    }

    public static function refreshUserLogin($id) {
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['user_data']);
        unset($_SESSION['last_logged_in']);

        $db = new DbModel;

        $stmt = 'SELECT * FROM users WHERE id = :id';
        $db->query($stmt);
        $db->bind(':id', $id);

        $row = $db->single();
        $db = null;
        if ($row) {

            $dob = date_create($row['dob']);
            $today = date_create(date('Y-m-d'));
            $age = date_diff($dob, $today);

            $_SESSION['is_logged_in'] = true;
            $_SESSION['last_logged_in'] = time();
            $_SESSION['user_data'] = array(
                'id' => $row['id'],
                'name' => $row['full_name'],
                'user_name' => $row['user_name'],
                'email' => $row['email'],
                'dob' => ($dob == null) ? '' : $dob,
                'age' => $age->format('Age: %y Years'),
                'img_url' => $row['img_url'],
                'gender' => $row['gender'],
                'address' => $row['address'],
                'post_code' => $row['post_code'],
                'country' => $row['country'],
                'type' => $row['user_type']
            );
        }
        return;
    }

    // helpers
    public static function numOfCarsByCategory($category_id){
        $db = new DbModel;
        $cars = 0;
        $stmt = 'SELECT * FROM cars WHERE category_id = :category_id';
        $db->query($stmt);

        $db->bind(':category_id', $category_id);
        $rows = $db->resultSet();
        $db = null;
        if($rows){
            $cars = count($rows);
            return $cars;
        }
        else {
            return $cars;
        }
    }

    public static function carsByCategoryId($id){
        $db = new DbModel;

        $stmt = 'SELECT * FROM cars WHERE category_id = :category_id ORDER BY id DESC';
        $db->query($stmt);

        $db->bind(':category_id', $id);
        $cars = $db->resultSet();
        $db = null;

        return $cars;
    }

    public static function allCategories(){
        $db = new DbModel;

        $stmt = 'SELECT * FROM categories ORDER BY id DESC';
        $db->query($stmt);
        $categories = $db->resultSet();
        $db = null;

        return $categories;
    }

    public static function getCategoryByCar($category_id){
        $db = new DbModel;
        //Select Categories
        $stmt = 'SELECT * FROM categories WHERE id = :id';
        $db->query($stmt);

        $db->bind(':id', $category_id);
        $category = $db->single();

        $db = null;
        return $category;

    }

    public static function allFeatures(){
        return self::$features;
    }

    public static function checkIfFeatureSelected($single, $features){
        foreach($features as $feature){
            if($feature == $single){
                return true;
                break;
            }
        }
        return false;
    }

    public static function allCars(){
        $db = new DbModel;

        $stmt = 'SELECT * FROM cars ORDER BY updated_at DESC';
        $db->query($stmt);
        $cars = $db->resultSet();
        $db = null;

        return $cars;
    }

    public static function carById($id){
        $db = new DbModel;

        $stmt = 'SELECT * FROM cars WHERE id = :id';
        $db->query($stmt);

        $db->bind(':id', $id);

        $car = $db->single();
        $db = null;

        return $car;
    }

    public static function siteOptions(){
        $db = new DbModel;

        $stmt = 'SELECT * FROM options';
        $db->query($stmt);
        $rows = $db->resultSet();
        $db = null;

        $options = array();
        $views = '';

        foreach($rows as $row){
            $options[$row['option_name']] = $row['option_value'];
        }

        if(strlen($options['view_count']) < 8) {
            $less = 8 - strlen($options['view_count']);

            for($i=1; $i<=$less; $i++){
                $views .= '0';
            }
            $views = $views . $options['view_count'];
        }
        $options['view_count'] = $views;

        return $options;
    }

    public static function commentsByCarId($id){
        $db = new DbModel;

        $stmt = 'SELECT * FROM comments WHERE car_id = :car_id ORDER BY created_at DESC';
        $db->query($stmt);

        $db->bind(':car_id', $id);
        $comments = $db->resultSet();

        $db = null;

        return $comments;
    }

    public static function getUserById($id){
        $db = new DbModel;

        $stmt = 'SELECT * FROM users WHERE id = :id';
        $db->query($stmt);

        $db->bind(':id', $id);
        $user = $db->single();

        $db = null;

        return $user;
    }

    public static function isFavorite($car_id, $user_id){
        $db = new DbModel;

        $stmt = 'SELECT * FROM favorites WHERE user_id = :user_id AND car_id = :car_id';
        $db->query($stmt);

        $db->bind(':user_id', $user_id);
        $db->bind(':car_id', $car_id);

        if(!$db->resultSet()){
            return false;
        }
        else {
            return true;
        }
    }
}