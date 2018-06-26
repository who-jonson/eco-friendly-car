</section> <!-- #main .main -->

<section id="footer" class="footer">
    <div class="newsletter text-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                    <h2>Subscribe Newsletters</h2>
                    <p>
                        Subscribe to our newsletters to get all the latest car reviews.
                    </p>
                    <form action="" method="post">
                        <div class="input-group">
                            <input type="email" name="email" class="form-control" placeholder="Enter your E-mail" aria-describedby="email-submit-addon">
                            <span class="input-group-addon" id="email-submit-addon">
                                <input type="submit" name="subscribe" value="Subscribe" class="btn btn-success">
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="rss-feeds">
        <?php
        $url = ROOT_URL . 'feed.rss';
        $xml = simplexml_load_file($url);
        ?>
        <div class="container-fluid">
            <h3 class="text-center">RSS Feed</h3>
            <marquee onmouseover="this.stop();" onmouseout="this.start();">
                <ul>
                    <?php for($i = 0; $i < 7; $i++): ?>
                        <li>
                            <a href="<?php echo $xml->channel->item[$i]->link; ?>">
                                <h4><?php echo $xml->channel->item[$i]->title; ?></h4>
                                <p><?php echo $xml->channel->item[$i]->description; ?></p>
                                <p class="text-muted">Posted on: <?php echo $xml->channel->item[$i]->pubDate; ?></p>
                            </a>

                        </li>
                    <?php endfor; ?>
                </ul>
            </marquee>
        </div>
    </div>

    <div class="footer-links" style="background-image: url('<?php echo ROOT_URL; ?>assets/images/footer-bg.png');">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h4>Cars by Brand</h4>
                    <ul class="links">
                        <li>
                            <a href="<?php echo ROOT_URL; ?>cars/bmw">
                                <i class="icofont icofont-caret-right"></i> BMW
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo ROOT_URL; ?>cars/audi">
                                <i class="icofont icofont-caret-right"></i> AUDI
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo ROOT_URL; ?>cars/toyota">
                                <i class="icofont icofont-caret-right"></i> Toyota
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo ROOT_URL; ?>cars/ford">
                                <i class="icofont icofont-caret-right"></i> FORD
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo ROOT_URL; ?>cars/hyundai">
                                <i class="icofont icofont-caret-right"></i> Hyundai
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <h4>Quick Links</h4>
                    <ul class="links">
                        <li>
                            <a href="#">
                                <i class="icofont icofont-caret-right"></i> About Us
                            </a>
                        </li>
                        <li>
                            <a href="http://localhost/eco-friendly-car/feed.rss">
                                <i class="icofont icofont-caret-right"></i> RSS Feed
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icofont icofont-caret-right"></i> Post an Add
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icofont icofont-caret-right"></i> Privacy Policy
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icofont icofont-caret-right"></i> Contact Us
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <h4>Help Center</h4>
                    <ul class="links">
                        <li>
                            <a href="#">
                                <i class="icofont icofont-caret-right"></i> Help & Support
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icofont icofont-caret-right"></i> FAQs
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icofont icofont-caret-right"></i> Account Issue
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icofont icofont-caret-right"></i> Terms of Service
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo ROOT_URL; ?>history">
                                <i class="icofont icofont-caret-right"></i> History
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-12">
                    <ul class="social-links">
                        <li>
                            <a href="#">
                                <i class="icofont icofont-social-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icofont icofont-social-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icofont icofont-social-google-plus"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icofont icofont-social-linkedin"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icofont icofont-social-youtube"></i>
                            </a>
                        </li>
                    </ul>
                    <p class="footer-des">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce suscipit, ante in bibendum placerat, tortor magna varius ex,
                        vel efficitur leo massa eleifend enim. Morbi fermentum neque eget lacus tristique, ut laoreet arcu tempor. Proin justo dui,
                        finibus et hendrerit vitae, pharetra nec libero. Mauris sagittis, justo ut sollicitudin porttitor, tortor augue dictum purus.
                    </p>

                    <div class="hit-counter" title="Total page hits">
                        <div class="panel panel-default text-center">
                            <div class="panel-heading">
                                <h3 class="panel-title">Page Hits</h3>
                            </div>
                            <div class="panel-body">
                                <?php echo Functions::siteOptions()['view_count']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p class="text-center">
                        Copyright &copy; 2018 Eco-Friendly Car.
                        Designed & Developed by: <a href="https://fb.com/bijoy.bijoy.3551" target="_blank">Sourov Paul</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</section> <!-- #index-footer.index-footer -->

<!-- JS -->
<script src="<?php echo ROOT_URL; ?>assets/styles/bootstrap/js/bootstrap.min.js"></script>

<?php if($_SERVER['REQUEST_URI'] == '/eco-friendly-car/cars/'): ?>
    <script src="<?php echo ROOT_URL; ?>assets/plugins/list.min.js"></script>
    <script>
        var carList = new List('cars', {
            valueNames: [ 'model', 'category', 'update-date', 'price' ],
            page: 6,
            pagination: true
        });
    </script>
<?php endif; ?>

<?php if($_SERVER['REQUEST_URI'] == '/eco-friendly-car/favorites'): ?>
    <script src="<?php echo ROOT_URL; ?>assets/plugins/list.min.js"></script>
    <script>
        var carList = new List('cars', {
            valueNames: [ 'model', 'category', 'update-date', 'price' ],
            page: 12,
            pagination: true
        });
    </script>
<?php endif; ?>

<?php if($_SERVER['REQUEST_URI'] == '/eco-friendly-car/history'): ?>
    <script src="<?php echo ROOT_URL . 'assets/plugins/DataTables/datatables.min.js'; ?>"></script>
    <script>
        $(document).ready(function(){
            $('#historiesTable').dataTable();
        });
    </script>
<?php endif; ?>
<?php if($_SERVER['REQUEST_URI'] == '/eco-friendly-car/profile/'): ?>
    <script src="<?php echo ROOT_URL . 'assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'; ?>"></script>
    <script>
        $('.input-group.date').datepicker({
            immediateUpdates : true,
            autoclose: true
        });
    </script>
<?php endif; ?>

<?php if($_SERVER['REQUEST_URI'] == '/eco-friendly-car/profile/photo'): ?>
    <script src="<?php echo ROOT_URL . 'assets/plugins/ajax-img-up/script.js'; ?>"></script>
<?php endif; ?>

</body>
</html>