<?php

require_once 'assets/php/header.php';

?>

<div class="container">
    <div class="row justify-content-center my-2">
        <div class="col-lg-6 mt-4" id="showAllNotification">
            <!-- <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="alert-heading">New Notification</h4>
                <p class="mb-0 lead">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis itaque expedita adipisci, saepe molestias error corrupti repudiandae sunt veniam ad.
                </p>
                <hr class="my-2">
                <p class="mb-0 float-left">Reply of feedback from Admin</p>
                <p class="mb-0 float-right">1 minute ago</p>
                <div class="clearfix"></div>
            </div> -->
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" ></script>


    <script>
        $(document).ready(function(){


            fetchNotification();
            //Fetch Notification of an User
            function fetchNotification(){
                $.ajax({
                    url:'assets/php/process.php',
                    method: 'post',
                    data: {action: 'fetchNotification'},
                    success:function(response){
                       // console.log(response);
                       $("#showAllNotification").html(response);
                    }
                });
            }

            checkNotification();
            //check Notification
            function checkNotification(){
                $.ajax({
                    url: 'assets/php/process.php',
                    method: 'post',
                    data: {action: 'checkNotification'},
                    success:function(response){
                        //console.log(response);
                        $("#checkNotification").html(response);
                    }
                });
            }

            //Remove Notification
            $("body").on("click",".close",function(e){
                e.preventDefault();

                notification_id = $(this).attr('id');

                $.ajax({
                    url: 'assets/php/process.php',
                    method: 'post',
                    data: {notification_id: notification_id},
                    success:function(response){
                        checkNotification();
                        fetchNotification();
                    }
                });
            });

             //Checking user is logged in or not
    $.ajax({
      url: 'assets/php/action.php',
      method: 'post',
      data: { action: 'checkUser'},
      success:function(response){
       if( response === 'bye'){
        window.location = 'index.php';
       }
      }
    });

        });
    </script>


</body>
</html>