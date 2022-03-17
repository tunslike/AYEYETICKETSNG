<!DOCTYPE html>
<html lang="en">
<style>
.ticketbody {
    margin-left: auto;
    margin-right: auto;
    width: 650px;
    height: 200px;
    display: flex;
    flex-direction: row;
    border-width: 1px;
    border-style: solid;
    border-color: #abc8d9;
    margin-top: 40px;
    border-radius:10px;
    background-image: url('<?php echo URLROOT; ?>/public/images/ticketbg.jpeg');
    background-position: center; 
    background-repeat: no-repeat; 
    backgroubd-cover: cover;
    background-position-x: 20%;
    background-position-y: 40%;
}

.panel1 {
    flex-basis: 75%;
    border-radius:10px;
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    align-items: center;
}

.panel2 {
    flex-basis: 25%;
    border-left-color: #3c4b54;
    border-left-width: 3px;
    border-left-style: dashed;
    padding: 5px;
    text-align:center;
}

.ticketImg {
    background-image: url('<?php echo URLROOT; ?>/public/images/eventimg7.jpeg');
    height:200px;
    width: 180px; 
    border-bottom-left-radius: 10px;
    border-top-left-radius: 10px;
    background-position: center; 
    background-repeat: no-repeat; 
    background-size: 100% 100%;
}

.ticketClass {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    border-radius: 5px;
    color: #ff2364;
    margin-top:-30px;
}

.address {
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; 
    font-size:10px; 
    color:#3c4b54; 
    font-weight: bold;
    margin-top: -15px;
}

.date {
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; 
    font-size:20px; 
    color:#6738ac; 
    font-weight: bold;
    margin-top:15px;
}
</style>
    <head></head>
    <body>
        <div class="ticketbody">
            <div class="panel1">
                <div class='ticketImg'>
                   
                </div>
                <div style="padding:10px; margin-top:25px;">
                    <h1 style="color:#3c4b54; font-size:18px; font-family: Arial, Helvetica, sans-serif; font-weight:bolder">SPINNAL Part of the Dream 22</h1>
                    <div class="ticketClass">
                        <div style="margin-top:-20px;"><h5 style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-size:25px; color:#68757d; font-weight: lighter;">REGULAR 2</h5>
                        <h6 style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-size:8px;  margin-top:-40px; margin-bottom:10px; color:#ff2364; font-weight: bold;">TICKET ADMITS ONE ONLY</h6>
                    </div>
                        <div><h5 style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-size:25px; color:#ff2364; font-weight: bolder;">₦ 7,800</h5></div>
                    </div>
                    <div class="address">
                        Altantic Hotel, Eko Hotel Waters, Victoria Island Lagos
                    </div>
                    <div class="date">
                    15 MARCH - 8.00PM
                    </div>
                    <h6 style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-size:10; color:#68757d; margin-top:10px; font-weight: lighter;">Terms and Conditions Apply</h6>
                </div>
            </div>
            <div class="panel2">
                <div>
                    <h6 style="margin-top:10px; text-decoration:underline; color:#6738ac; font-family: Arial, Helvetica, sans-serif; font-weight:bold">TICKET NUMBER</h6>
                    <h5 style="margin-top:-20px; color:#3c4b54; font-size:18px; font-family: Arial, Helvetica, sans-serif; font-weight:bold">8020920290</h5>
                    <div style="background-color:#000; margin-top:-20px; border-radius:5px; margin-left:10px; height:120px; width: 140px;">

                    </div>
                    <h6 style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-size:10; margin-top:2px; color:#68757d; font-weight: lighter;">www.ayeyetickets.com</h6>
                </div>
            </div>
        </div>
    </body>
</html>