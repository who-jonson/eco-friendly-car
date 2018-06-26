<div class="form-header">
    <h3>
        Login Form
        <span class="pull-right">
                                <i class="icofont icofont-ui-edit"></i>
                            </span>
    </h3>
</div>
<hr>
<form id="loginForm" action="<?php echo ROOT_URL; ?>" method="post" class="form-horizontal" role="form">

    <div class="form-group">
        <label for="userName" class="col-sm-3 control-label">User Name</label>
        <div class="col-sm-9">
            <input type="text" name="user_name" class="form-control" id="userName" placeholder="username">
        </div>
    </div>

    <div class="form-group">
        <label for="password" class="col-sm-3 control-label">Password</label>
        <div class="col-sm-9">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="check"> Check Yourself
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <input type="submit" name="login" class="btn btn-default pull-left" value="Login">
            <a class="forgot-password" href="#">Forgot Password?</a>
        </div>
    </div>
</form>