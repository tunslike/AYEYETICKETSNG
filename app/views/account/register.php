<?php
   require APPROOT . '/views/includes/header.php';
?>

<div class="innerDiv2">

<div class="innerHeaderDivider">

<div>
<div class="breadcrumb">
        <ul>
            <li><a href="<?php echo URLROOT; ?>/index"><i class="fas fa-home"></i></a></li>
            <li><i class="fas fa-chevron-right" style="color:#ff2364; font-size: 13px; margin: 0px -2px;"></i></li>
            <li><a href="<?php echo URLROOT; ?>/index">Account</a></li>
            <li><i class="fas fa-chevron-right" style="color:#ff2364; font-size: 13px; margin: 0px -2px;"></i></li>
    
        </ul>
    </div>

    <div class="innerfeaturedHdr">
    Register a new account
    </div>
</div>
<div>
<div class="signBackIn">
                            <a href="<?php echo URLROOT; ?>/account/login" title="Load more events!">Back to Sign In <i style="margin-left:5px;" class="fas fa-sign-in-alt"></i></a>
                        </div>

</div>

</div>


</div>


<form action="<?php echo URLROOT; ?>/accounts/register" onsubmit="return validationRegistrationForm();" method ="POST">

<div class="loginbox">

    <h5><i style="margin-right:5px;" class="fas fa-user"></i> Provide your details to register a new account</h5>

    <div class="errorMsgBox">
    <i class="fas fa-times" style="margin-right:5px; font-size:16px;"></i> Error: <span id="ermsg"></span>
    </div>

    <?php if($data['errorMessage'] != '') : ?>
        <div class="errorMsgBox" style="display:block;">
    <i class="fas fa-times" style="margin-right:5px; font-size:16px;"></i> <?php echo $data['errorMessage']; ?>
    </div>
    <?php endif; ?>

    <?php if($data['status'] == 'true') : ?>
        <div class="successMsgBox">
        <i class="fas fa-check" style="margin-right:5px; font-size:16px;"></i> Your registration was successful! Please check your email for further action
        </div>
    <?php endif; ?>

    <div class="loginform">
    <i class="fas fa-user-alt loginicon"></i>
    <input type="text" name="fname" id="fname" placeholder="First Name *">
    </div>

    <div class="loginform">
    <i class="far fa-user loginicon"></i>
    <input type="text" name="lname" id="lastname" placeholder="Last Name *">
    </div>

    <div class="loginform">
    <i class="far fa-envelope loginicon"></i>
    <input type="email" name="email" id="email" placeholder="Email Address *">
    </div>

    <div class="loginform">
    <i class="fas fa-phone-alt loginicon"></i>
    <input type="text" onkeypress='checkNumber(event)' name="phone" maxlength="13" id="phone" placeholder="Phone Number *">
    </div>

    <div class="loginform">
    <i class="fas fa-map-marker-alt loginicon"></i>
    <select name="state" id="state">
        <option selected="selected" value="">State</option>
        <option value='Abia'>Abia</option>
<option value='Adamawa'>Adamawa</option>
<option value='Akwa Ibom'>Akwa Ibom</option>
<option value='Anambra'>Anambra</option>
<option value='Bauchi'>Bauchi</option>
<option value='Bayelsa'>Bayelsa</option>
<option value='Benue'>Benue</option>
<option value='Borno'>Borno</option>
<option value='Cross River'>Cross River</option>
<option value='Delta'>Delta</option>
<option value='Ebonyi'>Ebonyi</option>
<option value='Edo'>Edo</option>
<option value='Ekiti'>Ekiti</option>
<option value='Enugu'>Enugu</option>
<option value='Gombe'>Gombe</option>
<option value='Imo'>Imo</option>
<option value='Jigawa'>Jigawa</option>
<option value='Kaduna'>Kaduna</option>
<option value='Kano'>Kano</option>
<option value='Katsina'>Katsina</option>
<option value='Kebbi'>Kebbi</option>
<option value='Kogi'>Kogi</option>
<option value='Kwara'>Kwara</option>
<option value='Lagos'>Lagos</option>
<option value='Nasarawa'>Nasarawa</option>
<option value='Niger'>Niger</option>
<option value='Ogun'>Ogun</option>
<option value='Ondo'>Ondo</option>
<option value='Osun'>Osun</option>
<option value='Oyo'>Oyo</option>
<option value='Plateau'>Plateau</option>
<option value='Rivers'>Rivers</option>
<option value='Sokoto'>Sokoto</option>
<option value='Taraba'>Taraba</option>
<option value='Yobe'>Yobe</option>
<option value='Zamfara'>Zamfara</option>
<option value='FCT'>FCT</option>
    </select>
    </div>
<br>
    <div style="text-align:center; margin-top:40px">
    <button class="regbutton">Register New Account</button>
    </div>

    <br>
    
</div>

</form>


<?php
   require APPROOT . '/views/includes/footer.php';
?>