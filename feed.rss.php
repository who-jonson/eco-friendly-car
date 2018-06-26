<?php
header("Content-Type: application/rss+xml; charset=ISO-8859-1");
echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
echo '<rss version="2.0">';

require 'config.php';
require 'classes/DbModel.php';
require 'classes/Functions.php';

$cars = Functions::allCars();
?>
    <channel>
        <title><?php echo SITE_TITLE; ?></title>
        <link><?php echo ROOT_URL; ?></link>
        <description>This is RSS feed of Eco-Friendly Car</description>
        <language>en-us</language>
        <copyright>Copyright (C) 2018 Eco-Friendly Car</copyright>

        <?php foreach($cars as $car): ?>
            <item>
                <title><?php echo Functions::getCategoryByCar($car['category_id'])['name'] . ' ' . $car['model']; ?></title>
                <?php
                    $excerpt = strip_tags($car['details']);
                    if (strlen($excerpt) > 70) {
                        $excerpt = substr($excerpt, 0, 70);
                        $excerpt = substr($excerpt, 0, strrpos($excerpt, ' '));
                        $excerpt .= '...';
                    } ?>
                <description><?php echo $excerpt; ?></description>
                <link><?php echo ROOT_URL . 'cars/' . Functions::getCategoryByCar($car['category_id'])['slug'] . '/' . $car['slug']; ?></link>
                <pubDate><?php echo date("D, d M Y H:i:s O", strtotime($car['updated_at'])); ?></pubDate>
            </item>
        <?php endforeach; ?>
    </channel>
</rss>
