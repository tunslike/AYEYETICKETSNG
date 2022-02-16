<?php
   require APPROOT . '/views/includes/header.php';
?>

<div class="innerDiv">
<div class="innerHeaderDivider">
<div>
<div class="breadcrumb">
        <ul>
            <li><a href="<?php echo URLROOT; ?>/index"><i class="fas fa-home"></i></a></li>
            <li><i class="fas fa-chevron-right" style="color:#ff2364; font-size: 13px; margin: 0px -2px;"></i></li>    
        </ul>
    </div>

    <div class="innerfeaturedHdr">
        Account Login
    </div>
</div>

<div>
    
<div class="reminderButton">
                            <a href="<?php echo URLROOT; ?>/accounts/register" title="Load more events!">Create Account <i style="margin-left:5px;" class="fas fa-user"></i></a>
                        </div>
</div>
</div>

</div>


<div class="loginbox">
    <h5 class="logintitleheader"><i style="margin-right:5px;" class="fas fa-user"></i> Provide your login details to access your account</h5>
    <div class="errorMsgBox">
    <i class="fas fa-times" style="margin-right:5px; font-size:16px;"></i> Error: <span id="ermsg"></span>
    </div>
    <?php if(isset($_GET['r'])) : ?>
        <div class="successMsgBox">
        <i class="fas fa-check" style="margin-right:5px; font-size:16px;"></i> You have been successfully logged out!
        </div>
    <?php endif; ?>

    <?php if(!empty($data['fieldError']) && $data['fieldError'] != '') : ?>
        <div class="errorMsgBox" style="display:block">
        <i class="fas fa-times" style="margin-right:5px; font-size:16px;"></i> <?php echo $data['fieldError']; ?>
    </div>
    <?php endif; ?>
    
    <form action="<?php echo URLROOT; ?>/accounts/login" onsubmit="return validateLoginForm();" method ="POST">
    <div class="loginform">
    <i class="far fa-envelope loginicon"></i>
    <input type="text" name="username" id="usern" autocomplete="off" placeholder="Email Address or Customer Number">
    </div>
    <div class="loginform">
    <i class="fas fa-lock loginicon"></i>
    <input type="password" name="entry" id="entry" autocomplete="off" placeholder="Password">
    </div>
    <div class="loginBtn">
    <div>
            <button class="loginbutton">Sign In</button>
        </div>
        <div class="remboxme">
        <input type="checkbox" name="remberMe" id="">
            <label for="remberMe">Remember me</label>
        </div>
    </div>
</form>
    <br>
<div class="forgotpwd">
<a href="#">
        Forgot your password? Click here
    </a>
</div>
    
</div>


<?php
   require APPROOT . '/views/includes/footer.php';
?>