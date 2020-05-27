<?php   ?>

 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Chat</title>

    

    <link rel="stylesheet" href="<? base_url(''); ?>assets/css/style.css" type="text/css">

    <link rel="stylesheet" href="<?= base_url(''); ?>assets/css/bootstrap.css">
    <link href="<?= base_url('assets/img/favicon.ico'); ?>" rel="icon" type="image/x-icon">

</head>
<body>

    <div class="container">
        <p hidden data-id="<?= $id; ?>"></p>

        <div class="col-lg-12 col-md-6 mt-5 shadow" style=" height: 655px;">

        <!--side left  -->
        <div class="row">
        <div class="col-md-3 bg-light shadow scroll" style="height: 650px;" id="style_1" >
            
            <!-- notif online  -->
            <div class="row">
            <?php foreach ($userActive as $active) : ?>
            <div class="card" style="width: 18rem;">
            
            <a data-id="<?= $active['id']; ?>" style="text-decoration:none ;" class="user_target">
                <ul class="list-group list-group-flush">
                
                  <li class="bor list-group-item list-group-item-action status-online"><img class="rounded" src="<? base_url(''); ?>assets/img/<?= $active['image']; ?>" width="60" height="60"> <?= $active['name']; ?></li>
                
                </ul>
                </a>
                
              </div>
              <?php endforeach; ?>
            </div>
        </div>
        <!-- end side left -->


       
        <div class="col-lg ml-0 shadow bg-info rounded" style="height: 80px;">
            
            <!-- As a link -->
            <div>
            
            
            <div id="fototarget" class="row d-flex align-items-center pt-2 ml-3 mb-5">
            <a>
                
                <img src="" class="rounded-circle float-left" alt="" width="60px" height="60px">
            </a>
            <h4 class="ml-2"><b class="text text-light"></b></h4>
            </div>

        <!-- end link -->
<div class="container-fluid scroll d-flex align-items-start mb-2" id="scroll" style="height: 470px;">
            <div class="col-md-12">
                <ul>
                    <div id="in" class="in">
                    
                    </div>
                    
                    <div id="out" class="out">
                    
                    </div>
                </ul>

                    </div>
                </div>

                <!-- message -->
            </div>

             <!-- form text message -->
         <div style="background-color: antiquewhite;"> 
            
            <div class="input-group" style="height: 100%;">
            <input id="message" name="message" type="text" class="form-control" placeholder="write your message" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button id="send" class="btn btn-outline-secondary" type="button">send</button>
            </div>
          </div>
        
        </div>
           
        </div>
        
        

        </div>
       
            
        
        </div>

        
    </div>
   


<script src="<?= base_url(''); ?>assets/js/jquery-3.4.1.min.js"></script>
<script src="https://js.pusher.com/6.0/pusher.min.js"></script>
<script src="<?= base_url(''); ?>assets/js/popper.min.js"></script>
<script src="<?= base_url(''); ?>assets/js/bootstrap.js"></script>
<script src="<? base_url(''); ?>assets/js/script.js"></script>


</body>
</html>