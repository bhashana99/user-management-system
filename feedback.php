<?php

require_once 'assets/php/header.php';

?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 mt-3">
            <?php if($verified == 'Verified!'): ?>
                <div class="card border-primary">

                    <div class="card-header lead text-center bg-primary text-white">
                        Send Feedback to Admin!
                    </div>

                    <div class="car-body">
                        <form action="#" method='post' class="px-4" id="feedback-form" >
                          <div class="form-group">
                            <input type="text" name="subject" placeholder="Write Your Subject" class="form-control-lg form-control rounded-0" required>
                          </div> 
                          <div class="form-group">
                            <textarea name="feedback" class="form-control-lg form-control rounded-0" placeholder="Write Your Feedback Here..." required row="8" col="10"></textarea>
                          </div> 
                          <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block btn-lg rounded-0" name="feedbackBtn" id="feedbackBtn" value="Send Feedback" >
                          </div>
                        </form>
                    </div>
                </div>
                <?php else:  ?>
                    <h1 class="text-center text-secondary mt-5">Verify Your E-Mail First to Send Feedback to Admin!</h1>
                    <?php endif; ?>

        </div>
    </div>
</div>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
    $(document).ready(function(){

        //Send Feedback to Admin Ajax Request
        $("#feedbackBtn").click(function(e){
            if($("#feedback-form")[0].checkValidity()){
                e.preventDefault();

                $(this).val('Please Wait...');

                $.ajax({
                    url: 'assets/php/process.php',
                    method:'post',
                    data: $("#feedback-form").serialize()+'&action=feedback',
                    success:function(response){
                       // console.log(response);
                       $("#feedback-form")[0].reset();
                       $("#feedbackBtn").val('Send Feedback');
                       Swal.fire({
                        title: 'Feedback Successfully sent to the Admin',
                        type: 'success'
                       });
                    }
                });

            }
        });

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