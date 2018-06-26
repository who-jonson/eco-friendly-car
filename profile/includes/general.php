<!--Profile general-->
<div class="profile-general">
    <form class="form-horizontal" role="form" action="<?php echo ROOT_URL . 'profile/' ?>" method="post">
        <div class="form-group">
            <label for="name" class="col-sm-4 control-label">Name</label>
            <div class="col-sm-8">
                <input type="text" name="name" class="form-control" id="name" value="<?php echo $user['full_name']; ?>" placeholder="Your full name" required>
            </div>
        </div>

        <div class="form-group">
            <label for="userName" class="col-sm-4 control-label">User Name</label>
            <div class="col-sm-8">
                <input type="text" name="user_name" class="form-control" value="<?php echo $user['user_name']; ?>" id="userName" placeholder="username" required>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-4 control-label">Email</label>
            <div class="col-sm-8">
                <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" id="email" placeholder="john@email.com" required>
            </div>
        </div>

        <div class="form-group">
            <label for="dob" class="col-sm-4 control-label">Date of Birth</label>
            <div class="col-sm-8">
                <div class="input-group date">
                    <input name="dob" type="text" class="form-control" value="<?php echo date('m/d/Y', strtotime($user['dob'])); ?>" required>
                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="gender" class="col-sm-4 control-label">Gender</label>
            <div class="col-sm-8">
                <div class="radio">
                    <label>
                        <input type="radio" name="gender" id="optionsRadios1" value="male" <?php echo ($user['gender'] == 'male')? 'checked' : ''; ?> > Male
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="gender" id="optionsRadios2" value="female" <?php echo ($user['gender'] == 'female')? 'checked' : ''; ?> > Female
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="gender" id="optionsRadios2" value="other" <?php echo ($user['gender'] == 'others')? 'checked' : ''; ?>> Other
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="address" class="col-sm-4 control-label">Address</label>
            <div class="col-sm-8">
                <textarea name="address" id="address" class="form-control" rows="2" placeholder="Address"><?php echo $user['address']; ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="postCode" class="col-sm-4 control-label">Post Code</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" value="<?php echo $user['post_code']; ?>" placeholder="1209" name="post_code" id="postCode">
            </div>
        </div>

        <div class="form-group">
            <label for="country" class="col-sm-4 control-label">Country</label>
            <div class="col-sm-8">
                <select class="form-control" name="country" id="country">
                    <option class="text-muted">--- Select Your Country ---</option>
                    <option value="Bangladesh" <?php echo ($user['country'] == 'Bangladesh')? 'selected' : ''; ?>>Bangladesh</option>
                    <option value="India" <?php echo ($user['country'] == 'India')? 'selected' : ''; ?>>India</option>
                    <option value="Pakistan" <?php echo ($user['country'] == 'Pakistan')? 'selected' : ''; ?>>Pakistan</option>
                    <option value="China" <?php echo ($user['country'] == 'China')? 'selected' : ''; ?>>China</option>
                    <option value="U.A.E" <?php echo ($user['country'] == 'U.A.E')? 'selected' : ''; ?>>U.A.E</option>
                    <option value="U.K" <?php echo ($user['country'] == 'U.K')? 'selected' : ''; ?>>U.K</option>
                    <option value="U.S.A" <?php echo ($user['country'] == 'U.S.A')? 'selected' : ''; ?>>U.S.A</option>
                </select>
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <input name="update_general" type="submit" class="btn btn-default" value="Update Profile">
            </div>
        </div>
    </form>
    <script>
        var activeNav = document.getElementById("pro-side-general-active");
        activeNav.classList.add("active");
    </script>
</div>