<!--Profile general-->
<div class="profile-security">
    <form class="form-horizontal" role="form" action="<?php echo ROOT_URL . 'profile/' ?>" method="post">
        <div class="form-group">
            <label for="old-password" class="col-sm-4 control-label">Old Password</label>
            <div class="col-sm-8">
                <input type="password" name="old_password" class="form-control" id="old-password" placeholder="Your old password" required>
            </div>
        </div>

        <div class="form-group">
            <label for="new-password" class="col-sm-4 control-label">New Password</label>
            <div class="col-sm-8">
                <input type="password" name="new_password" class="form-control" id="new-password" placeholder="New Password" required>
            </div>
        </div>

        <div class="form-group">
            <label for="conf-new-password" class="col-sm-4 control-label">Confirm Password</label>
            <div class="col-sm-8">
                <input type="password" name="conf_new_password" class="form-control" id="conf-new-password" placeholder="Confirm New Password" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <input name="update_security" type="submit" class="btn btn-default" value="Update Password">
            </div>
        </div>
    </form>
    <script>
        var activeNav = document.getElementById("pro-side-security-active");
        activeNav.classList.add("active");
    </script>
</div>