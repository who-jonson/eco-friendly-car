<!--Profile general-->
<div class="profile-photo">
    <div class="main-up">
        <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
            <div id="image_preview">
                <?php if($user['img_url'] == null): ?>
                    <img class="img-responsive img-circle img-thumbnail" id="previewing" src="<?php echo ROOT_URL; ?>assets/images/user.png" >
                <?php else: ?>
                    <img class="img-responsive img-circle img-thumbnail" id="previewing" src="<?php echo $user['img_url']; ?>" >
                <?php endif; ?>
            </div>
            <hr id="line">
            <div id="selectImage">
                <label>Select Your Image</label><br/>
                <input type="file" name="file" id="file" required />
                <input type="submit" value="Upload" class="submit" />
            </div>
        </form>
        <h4 id='loading' >loading..</h4>
        <div id="message" class="text-center"></div>
        <!--Update img-->
    </div>
    <form class="form-horizontal" role="form" action="<?php echo ROOT_URL . 'profile/' ?>" method="post">

        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <input type="hidden" name="img_url" value="<?php echo $user['img_url']; ?>" id="new-img-url">
                <input name="update_photo" type="submit" class="btn btn-default" value="Update Photo">
            </div>
        </div>
    </form>
    <script>
        var activeNav = document.getElementById("pro-side-photo-active");
        activeNav.classList.add("active");
    </script>
</div>