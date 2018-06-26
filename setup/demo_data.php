<?php

//require '../classes/DbModel.php';
//adding categories in category table


function addCategories(){
    $categories = array(
        array(
            'name' => 'BMW',
            'slug' => 'bmw'
        ),
        array(
            'name' => 'Lamborgini',
            'slug' => 'lamborgini'
        ),
        array(
            'name' => 'Toyota',
            'slug' => 'toyota'
        ),
        array(
            'name' => 'Ferrari',
            'slug' => 'ferrari'
        ),
        array(
            'name' => 'Hyundai',
            'slug' => 'hyundai'
        ),
        array(
            'name' => 'Ford',
            'slug' => 'ford'
        ),
        array(
            'name' => 'Audi',
            'slug' => 'audi'
        ),
        array(
            'name' => 'Lexus',
            'slug' => 'lexus'
        ),
        array(
            'name' => 'Nissan',
            'slug' => 'nissan'
        ),
        array(
            'name' => 'Marcedes',
            'slug' => 'marcedes'
        )
    );

    $db = new DbModel;
    // Insert into MySQL
    $stmt = 'INSERT INTO categories (name, slug) VALUES(:name, :slug)';
    $db->query($stmt);

    foreach ($categories as $category){
        $db->bind(':name', $category['name']);
        $db->bind(':slug', $category['slug']);
        $db->execute();
    }


}

function addCars(){
    $cars = array(
        array(
            'category_id'       => 1,
            'features'          => '/ABS, Air Bags, Alloy Rims, AM/FM Radio, Air Conditioning, DVD Player, Immobilizer key, Keyless Entry, Power Locks, Power Mirrors, Power Steering, Power Windows',
            'slug'              => 'i8',
            'model'             => 'i8',
            'color'             => 'black',
            'img_url'           => ROOT_URL . 'assets/images/demo_images/1.jpg',
            'price'             => '$149,900',
            'engine'            => '1499',
            'power'             => '228bhp@5800rpm',
            'top_speed'         => '250 Kmph',
            'fuel_type'         => 'Petrol',
            'brake'             => 'Adaptive',
            'gear'              => 'Manual',
            'wheel_size'        => '20 Inch',
            'wheel_material'    => 'Alloy wheels',
            'rate_fuel'         => 4,
            'rate_battery'      => 5,
            'rate_car'          => 4,
            'details'           => 'BMW i8 is comfortable and fuel efficient car.',
            'views'             => 3
        ),
        array(
            'category_id'       => 2,
            'features'          => 'ABS, Air Bags, Alloy Rims, AM/FM Radio, Air Conditioning, DVD Player, Immobilizer key, Keyless Entry, Power Locks, Power Mirrors, Power Steering, Power Windows',
            'slug'              => 'aventador',
            'model'             => 'Aventador',
            'color'             => 'Orange',
            'img_url'           => ROOT_URL . 'assets/images/demo_images/2.jpg',
            'price'             => '$393,695',
            'engine'            => '6498 cc',
            'power'             => '730bhp@8400rpm',
            'top_speed'         => '350 Kmph',
            'fuel_type'         => 'Petrol',
            'brake'             => 'Anti-Lock Braking system',
            'gear'              => 'Manual',
            'wheel_size'        => '20 Inch',
            'wheel_material'    => 'Tubeless,Radial',
            'rate_fuel'         => 4,
            'rate_battery'      => 4,
            'rate_car'          => 4,
            'details'           => 'Lamborgini Aventor has Anti-Lock Braking system and it also have passenger airbags.',
            'views'             => 2
        ),
        array(
            'category_id'       => 3,
            'features'          => 'Air bags, Air Conditioning, Power Steering',
            'slug'              => 'innova-crysta-car',
            'model'             => 'Innova Crysta Car',
            'color'             => 'White/Black',
            'img_url'           => ROOT_URL . 'assets/images/demo_images/3.jpg',
            'price'             => 'RS 14.71 lakh',
            'engine'            => '2755 cc',
            'power'             => '171.5bhp@3400rpm',
            'top_speed'         => '120 Kmph',
            'fuel_type'         => 'Diesel',
            'brake'             => 'Adaptive',
            'gear'              => 'Manual',
            'wheel_size'        => '2750 mm',
            'wheel_material'    => 'Alloy',
            'rate_fuel'         => 5,
            'rate_battery'      => 4,
            'rate_car'          => 4,
            'details'           => 'This car contains manual gear system and air conditioning system.',
            'views'             => 4
        ),
        array(
            'category_id'       => 4,
            'features'          => 'Air Bags, Alloy Rims, AM/FM Radio, Air Conditioning',
            'slug'              => 'enzo',
            'model'             => 'Enzo',
            'color'             => 'Red',
            'img_url'           => ROOT_URL . 'assets/images/demo_images/4.jpg',
            'price'             => '$ 659330',
            'engine'            => 'V12',
            'power'             => '660 @ 7800 RPM',
            'top_speed'         => '217 mph',
            'fuel_type'         => 'Diesel',
            'brake'             => 'Brembo disc brakes',
            'gear'              => 'Semi Automatic Transmission',
            'wheel_size'        => '19 Inches',
            'wheel_material'    => 'Alloy',
            'rate_fuel'         => 5,
            'rate_battery'      => 4,
            'rate_car'          => 4,
            'details'           => 'The Enzo was designed by Ken Okuyama, the Japanese former Pininfarina head designer, and initially announced at the 2002 Paris Motor Show with a limited production run of 399 and at US $659,330.',
            'views'             => 5
        ),
        array(
            'category_id'       => 5,
            'features'          => 'Air coditioning, Air Bags, Alloy Rims, AM/FM Radio',
            'slug'              => 'azera',
            'model'             => 'Azera',
            'color'             => 'Red',
            'img_url'           => ROOT_URL . 'assets/images/demo_images/5.jpg',
            'price'             => '$ 34955',
            'engine'            => 'Regular Unleaded V-6, 3.3 L',
            'power'             => '255 @ 5200 RPM',
            'top_speed'         => '110 kmph',
            'fuel_type'         => 'Gasoline Direct Injection',
            'brake'             => 'Adaptive',
            'gear'              => 'Manual',
            'wheel_size'        => 'P245/45VR18',
            'wheel_material'    => 'Alloy',
            'rate_fuel'         => 4,
            'rate_battery'      => 4,
            'rate_car'          => 4,
            'details'           => 'From its quiet cabin and refined power train to its handsome yet mild styling, the Azera offers plenty to appreciate. Touchscreen navigation is standard, with Blue Link, Apple CarPlay, and Android Auto.',
            'views'             => 3
        ),
        array(
            'category_id'       => 6,
            'features'          => 'Air Bags, Alloy Rims, AM/FM Radio, Air Conditioning, DVD Player, Immobilizer key, Keyless Entry, Power Locks',
            'slug'              => 'eco-sport',
            'model'             => 'Eco Sport',
            'color'             => 'Red/Black/White',
            'img_url'           => ROOT_URL . 'assets/images/demo_images/6.jpg',
            'price'             => '$ 22000',
            'engine'            => '1497 cc',
            'power'             => '121.36bhp@6500rpm',
            'top_speed'         => '220 kmph',
            'fuel_type'         => 'Petrol',
            'brake'             => 'Adaptive',
            'gear'              => '5 Speed',
            'wheel_size'        => '15 Inch',
            'wheel_material'    => 'Alloy ',
            'rate_fuel'         => 4,
            'rate_battery'      => 5,
            'rate_car'          => 4,
            'details'           => 'The new EcoSport can be had with either a 1.5-litre petrol, or a 1.5-litre Diesel engine. The three-cylinder petrol engine makes 123PS and 150Nm, whereas the four-cylinder diesel is good for 100PS and 205Nm.',
            'views'             => 3
        ),
        array(
            'category_id'       => 7,
            'features'          => 'Anti-Theft Alarm System w/Immobilizer, motion sensor, SiriusXM Satellite Radio,  keyless engine start',
            'slug'              => 'a4',
            'model'             => 'A4',
            'color'             => 'White',
            'img_url'           => ROOT_URL . 'assets/images/demo_images/7.jpg',
            'price'             => '$50,000',
            'engine'            => '1968 cc',
            'power'             => '188bhp@4200rpm',
            'top_speed'         => '202 Kmph',
            'fuel_type'         => 'Diesel',
            'brake'             => 'Adaptive',
            'gear'              => '7 Manual',
            'wheel_size'        => '17 inch',
            'wheel_material'    => 'Alloy',
            'rate_fuel'         => 4,
            'rate_battery'      => 4,
            'rate_car'          => 4,
            'details'           => 'All variants of the Audi A4 are pretty much feature-laden and full of the expected technical specs. A4 Diesel engine specification include an engine of 1968cc, which musters up a torque measuring to 400Nm@1750-2500rpm and maximum power of 188bhp@4200rpm.',
            'views'             => 2
        ),
        array(
            'category_id'       => 8,
            'features'          => 'Air Bags, Alloy Rims, AM/FM Radio, Air Conditioning, DVD Player, Immobilizer key',
            'slug'              => 'gs-f',
            'model'             => 'GS F',
            'color'             => 'Black',
            'img_url'           => ROOT_URL . 'assets/images/demo_images/8.jpg',
            'price'             => '$ 85345',
            'engine'            => 'Premium Unleaded V-8 5.0L/303 cc',
            'power'             => '467 @ 7100 rpm',
            'top_speed'         => '250 Kmph',
            'fuel_type'         => 'Petrol',
            'brake'             => 'Adaptive',
            'gear'              => 'Automatic',
            'wheel_size'        => '19*10 inch',
            'wheel_material'    => 'Alloy',
            'rate_fuel'         => 4,
            'rate_battery'      => 5,
            'rate_car'          => 4,
            'details'           => '4 doors, 5 passengers, rear-wheel drive; 16/24 mpg city/hwy (est), 5.0-liter 8-cylinder engine; 467 hp, 389 lb-ft; 8-speed automatic transmission',
            'views'             => 4
        ),
        array(
            'category_id'       => 9,
            'features'          => 'ABS, Air Bags, Alloy Rims, AM/FM Radio, Air Conditioning, DVD Player, Immobilizer key, Keyless Entry, Power Locks, Power Mirrors, Power Steering, Power Windows',
            'slug'              => 'armada-suv',
            'model'             => 'Armada Suv',
            'color'             => 'White',
            'img_url'           => ROOT_URL . 'assets/images/demo_images/9.jpg',
            'price'             => '$ 34500',
            'engine'            =>  '5.6 v8',
            'power'             => '305 @ 4900 rpm',
            'top_speed'         => '160 kmph',
            'fuel_type'         => 'Petrol',
            'brake'             => 'Adaptive',
            'gear'              => '5-Speed Automatic',
            'wheel_size'        => '20 inch',
            'wheel_material'    => 'Alloy',
            'rate_fuel'         => 4,
            'rate_battery'      => 4,
            'rate_car'          => 4,
            'details'           => 'Nissan’s Armada SUV continues in 2006 to be a full-size SUV for full-size lives. Featuring a powerful 5.6-liter V8 engine, three-row, eight-passenger seating and up to 9,100-pound maximum towing capacity, the Armada is primed for adventures of all sizes.',
            'views'             => 5
        ),
        array(
            'category_id'       => 10,
            'features'          => 'Air Bags, Alloy Rims, AM/FM Radio, Air Conditioning, DVD Player, Immobilizer key, Keyless Entry, Power Locks, Power Mirrors, Power Steering',
            'slug'              => 'a-class-a-180-night-edition',
            'model'             => 'A Class A 180 Night Edition',
            'color'             => 'Bottle Green/Black/white',
            'img_url'           => ROOT_URL . 'assets/images/demo_images/10.jpeg',
            'price'             => '$ 48000',
            'engine'            => '1595 cc',
            'power'             => '122/155 @ RPM',
            'top_speed'         => '180',
            'fuel_type'         => 'Petrol',
            'brake'             => 'Adaptive',
            'gear'              => '7 Automatic',
            'wheel_size'        => '20 Inch',
            'wheel_material'    => 'Adaptive',
            'rate_fuel'         => 4,
            'rate_battery'      => 5,
            'rate_car'          => 4,
            'details'           => 'The A-Class takes most of Mercedes’ traditional qualities – a classy interior, impressive quality and good looks – and condenses them into a convincing small car package.',
            'views'             => 3
        )
    );

    $db = new DbModel;
    // Insert into MySQL
    $stmt = 'INSERT INTO cars (category_id, features, slug, model, color, img_url, price, engine, power, top_speed, fuel_type, brake, gear, wheel_size, wheel_material, rate_fuel, rate_battery, rate_car, details, views) 
              VALUES(:category_id, :features, :slug, :model, :color, :img_url, :price, :engine, :power, :top_speed, :fuel_type, :brake, :gear, :wheel_size, :wheel_material, :rate_fuel, :rate_battery, :rate_car, :details, :views)';
    $db->query($stmt);

    foreach ($cars as $car){
        $db->bind(':category_id', $car['category_id']);
        $db->bind(':features', $car['features']);
        $db->bind(':slug', $car['slug']);
        $db->bind(':model', $car['model']);
        $db->bind(':color', $car['color']);
        $db->bind(':img_url', $car['img_url']);
        $db->bind(':price', $car['price']);
        $db->bind(':engine', $car['engine']);
        $db->bind(':power', $car['power']);
        $db->bind(':top_speed', $car['top_speed']);
        $db->bind(':fuel_type', $car['fuel_type']);
        $db->bind(':brake', $car['brake']);
        $db->bind(':gear', $car['gear']);
        $db->bind(':wheel_size', $car['wheel_size']);
        $db->bind(':wheel_material', $car['wheel_material']);
        $db->bind(':rate_fuel', $car['rate_fuel']);
        $db->bind(':rate_battery', $car['rate_battery']);
        $db->bind(':rate_car', $car['rate_car']);
        $db->bind(':details', $car['details']);
        $db->bind(':views', $car['views']);

        $db->execute();
    }
}

function addUsers(){
    $password = '123456';
    $password = md5($password);
    $users = array(
        array(
            'full_name'     => 'Sourov Paul',
            'user_name'     => 'paul',
            'email'         => '1000456@daffodil.ac',
            'password'      => $password,
            'dob'           => date('Y-m-d', strtotime('1994-10-14')),
            'gender'        => 'male',
            'address'       => 'Daffodil Concord Tower,  19/1, Panthapath,Dhaka – 1205, Bangladesh',
            'post_code'     => '1205',
            'country'       => 'Bangladesh',
            'user_type'     => 'user',
            'img_url'       => ROOT_URL . 'assets/images/user-male.jpg'
        ),
        array(
            'full_name'     => 'Arpita Kona',
            'user_name'     => 'kona',
            'email'         => 'arpita@gmail.com',
            'password'      => $password,
            'dob'           => date('Y-m-d', strtotime('2000-09-29')),
            'gender'        => 'female',
            'address'       => 'Dhanmondi',
            'post_code'     => '1209',
            'country'       => 'Bangladesh',
            'user_type'     => 'user',
            'img_url'       => ROOT_URL . 'assets/images/user-female.jpg'
        )
    );

    $db = new DbModel;
    // Insert into MySQL
    $stmt = 'INSERT INTO users (full_name, user_name, email, password, dob, gender, address, post_code, country, user_type, img_url) 
                    VALUES(:full_name, :user_name, :email, :password, :dob, :gender, :address, :post_code, :country, :user_type, :img_url)';
    //prepare the statement
    $db->query($stmt);

    foreach($users as $user) {
        //bind values
        $db->bind(':full_name', $user['full_name']);
        $db->bind(':user_name', $user['user_name']);
        $db->bind(':email', $user['email']);
        $db->bind(':password', $password);
        $db->bind(':dob',  $user['dob']);
        $db->bind(':gender', $user['gender']);
        $db->bind(':address', $user['address']);
        $db->bind(':post_code', $user['post_code']);
        $db->bind(':country', $user['country']);
        $db->bind(':user_type', 'user');
        $db->bind(':img_url', $user['img_url']);

        $db->execute();
    }
    $db = null;
}

function addOptions(){

    //options = view_count, site_title, contact_email, contact_phone
    $db = new DbModel;

    $stmt = 'INSERT INTO options (option_name, option_value) VALUES(:option_name, :option_value)';
    $db->query($stmt);

    $db->bind(':option_name', 'view_count');
    $db->bind(':option_value', 100);
    $db->execute();

    $db->bind(':option_name', 'site_title');
    $db->bind(':option_value', 'Eco-Friendly Car');
    $db->execute();

    $db->bind(':option_name', 'contact_email');
    $db->bind(':option_value', 'paulsourov1@gmail.com');
    $db->execute();

    $db->bind(':option_name', 'contact_phone');
    $db->bind(':option_value', '+8801751667835');
    $db->execute();

    $db = null;
    return;
}


