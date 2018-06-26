<?php

if(isset($_GET['id'])){
    $current_id = $_GET['id'];
}
else {
    $current_id = null;
}

?>

</section>

<section class="footer" id="footer">
    <div class="container-fluid">
        <p class="text-center">2018 &copy; Sourov Paul</p>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo ROOT_URL; ?>assets/styles/bootstrap/js/bootstrap.min.js"></script>

<?php if($_SERVER['REQUEST_URI'] == '/eco-friendly-car/efc-admin/categories/' || $_SERVER['REQUEST_URI'] == '/eco-friendly-car/efc-admin/cars/' || $_SERVER['REQUEST_URI'] == '/eco-friendly-car/efc-admin/users' || $_SERVER['REQUEST_URI'] == '/eco-friendly-car/efc-admin/comments/'): ?>
    <script src="<?php echo ROOT_URL; ?>assets/plugins/DataTables/datatables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#allCategoriesTable').dataTable();
        });

        $(document).ready(function(){
            $('#allCarsTable').dataTable();
        });

        $(document).ready(function(){
            $('#allUsersTable').dataTable();
        });

        $(document).ready(function(){
            $('#allCommentsTable').dataTable();
        });

    </script>
<?php endif; ?>
<?php if($_SERVER['REQUEST_URI'] == '/eco-friendly-car/efc-admin/profile'): ?>
    <script src="<?php echo ROOT_URL; ?>assets/plugins/ajax-img-up/script.js"></script>
    <script src="<?php echo ROOT_URL; ?>assets/plugins/jquery_validation/jquery.validate.min.js"></script>
    <script src="<?php echo ROOT_URL; ?>assets/js/admin.js"></script>
<?php endif; ?>
<?php if($_SERVER['REQUEST_URI'] == '/eco-friendly-car/efc-admin/cars/add' || $_SERVER['REQUEST_URI'] == '/eco-friendly-car/efc-admin/cars/edit?id=' . $current_id): ?>
    <script src="<?php echo ROOT_URL; ?>assets/plugins/ajax-img-up/script.js"></script>
<?php endif; ?>
</body>
</html>