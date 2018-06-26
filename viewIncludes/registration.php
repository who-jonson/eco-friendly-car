<div class="form-header">
    <h3>
        Registration Form
        <span class="pull-right">
            <i class="icofont icofont-ui-edit"></i>
        </span>
    </h3>
</div>
<hr>
<form action="<?php echo ROOT_URL; ?>register" method="post" class="form-horizontal" id="registrationForm">
    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Name</label>
        <div class="col-sm-9">
            <input type="text" name="name" class="form-control" id="name" placeholder="Your Full Name">
        </div>
    </div>

    <div class="form-group">
        <label for="userName" class="col-sm-3 control-label">User Name</label>
        <div class="col-sm-9">
            <input type="text" name="user_name" class="form-control" id="userName" placeholder="username">
        </div>
    </div>

    <div class="form-group">
        <label for="email" class="col-sm-3 control-label">Email</label>
        <div class="col-sm-9">
            <input type="email" name="email" class="form-control" id="email" placeholder="john@email.com">
        </div>
    </div>

    <div class="form-group">
        <label for="password" class="col-sm-3 control-label">Password</label>
        <div class="col-sm-9">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
        </div>
    </div>

    <div class="form-group">
        <label for="confPassword" class="col-sm-3 control-label">Confirm Password</label>
        <div class="col-sm-9">
            <input type="password" name="conf_password" class="form-control" id="confPassword" placeholder="Confirm Password">
        </div>
    </div>

    <div class="form-group">
        <label for="dob" class="col-sm-3 control-label">Date of Birth</label>
        <div class="input-group date">
            <input name="dob" type="text" class="form-control" value="<?php echo date("m/d/Y"); ?>" required>
            <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
        </div>
    </div>

    <div class="form-group">
        <label for="gender" class="col-sm-3 control-label">Gender</label>
        <div class="col-sm-9">
            <div class="radio">
                <label>
                    <input type="radio" name="gender" id="optionsRadios1" value="male" checked> Male
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="gender" id="optionsRadios2" value="female"> Female
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="gender" id="optionsRadios2" value="other"> Other
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="address" class="col-sm-3 control-label">Address</label>
        <div class="col-sm-9">
            <textarea name="address" id="address" class="form-control" rows="2" placeholder="Address"></textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="postCode" class="col-sm-3 control-label">Post Code</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" placeholder="1209" name="post_code" id="postCode">
        </div>
    </div>

    <div class="form-group">
        <label for="country" class="col-sm-3 control-label">Country</label>
        <div class="col-sm-9">
            <select class="form-control" name="country" id="country">
                <option class="text-muted"></option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="India">India</option>
                <option value="Pakistan">Pakistan</option>
                <option value="China">China</option>
                <option value="U.A.E">U.A.E</option>
                <option value="U.K">U.K</option>
                <option value="U.S.A">U.S.A</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="check" required> Check Yourself
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <input name="submit" type="submit" class="btn btn-default" value="Register">
        </div>
    </div>
</form>