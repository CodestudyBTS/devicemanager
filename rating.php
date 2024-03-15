<?php
        include ('header.php');
       // session_start();
        include('admin/connect.php');
        $id_ticket = isset($_GET['ticket_id']) ? $_GET['ticket_id'] : '' ;
        $team_member_email = isset($_GET['team_member_email']) ? $_GET['team_member_email'] : '' ;
        $customer_email = isset($_GET['customer_email']) ? $_GET['customer_email'] : '' ;
        $ticket_subject = isset($_GET['ticket_subject']) ? $_GET['ticket_subject'] : '' ;
        $ticket_create_date = isset($_GET['ticket_create_date']) ? $_GET['ticket_create_date'] : '' ;
        $ticket_rate = isset($_GET['ticket_rate']) ? $_GET['ticket_rate'] : '' ;
        $number_ticket = isset($_GET['number_ticket']) ? $_GET['number_ticket'] : '' ;
        $ticket_assigned = isset($_GET['ticket_assigned']) ? $_GET['ticket_assigned'] : '' ;
        $ticket_dept = isset($_GET['ticket_dept']) ? $_GET['ticket_dept'] : '' ;

       // $id_ticket = $_GET['ticket_id'];        
       // $team_member_email = $_GET['team_member_email'];
      //  $customer_email = $_GET['customer_email'];
       // $ticket_subject  = $_GET['ticket_subject'];
       // $ticket_create_date = $_GET['ticket_create_date']; 
      //  $ticket_rate = $_GET['ticket_rate'];
      //  $number_ticket = $_GET['number_ticket'];
      //  $ticket_assigned = $_GET['ticket_assigned'];
      //  $ticket_dept = $_GET['ticket_dept'];
    ?>
    <body>
            <section id="feature">
                <div class="container">
                    <div class="section-heading">
                        <h1 class="title wow fadeInDown" data-wow-delay=".3s">DASBOARD </h1>
                        <p class="wow fadeInDown" data-wow-delay=".5s">
                            Rating
                        </p>
                    </div>
                    <div class="row">
                        <?php 
        if (!empty($id_ticket)) 
        {
        $query_ck = "SELECT ticket_id from rating WHERE ticket_id='$id_ticket'" ;
        $result = mysqli_query($connect, $query_ck) ;
        $row = mysqli_fetch_array($result);
        if (is_null($row))      
        {   
        $query_rating = "INSERT INTO rating (team_member_email, customer_email, ticket_id,number_ticket, ticket_subject, ticket_create_date, ticket_rate, ticket_assigned, ticket_dept) VALUES ('$team_member_email', '$customer_email', '$id_ticket','$number_ticket', '$ticket_subject', '$ticket_create_date', '$ticket_rate', '$ticket_assigned', '$ticket_dept') ";
                    if (mysqli_query($connect, $query_rating)) 
                            {
                                ?>
                </div>
                </div>
            </section> <!-- /#feature -->
                                <!-- 
        ================================================== 
            Contact Section Start
        ================================================== -->
        <section id="contact-section">
            <div class="container">
                <div class="section-heading">
                    <div class="col-md-12">
                        <div class="title wow fadeInDown">
                            <h2 class="subtitle wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".3s"> Anh/chị đánh giá Team CNTT xử lý vấn đề  <?php echo "$ticket_subject" ; ?> </h2> 
                            <?php
                            if ($ticket_rate == 1 )
                            {
                                ?>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star unchecked"></span>
                                <span class="fa fa-star unchecked"></span>
                                <span class="fa fa-star unchecked"></span>
                                <span class="fa fa-star unchecked"></span>
                                <?php
                               
                            }
                            elseif ($ticket_rate == 2) {
                                ?>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star unchecked"></span>
                                <span class="fa fa-star unchecked"></span>
                                <span class="fa fa-star unchecked"></span>
                                <?php
                            }
                            elseif ($ticket_rate == 3) {
                                ?>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star unchecked"></span>
                                <span class="fa fa-star unchecked"></span>
                                <?php
                            }
                            elseif ($ticket_rate == 4) {
                                ?>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star unchecked"></span>
                                <?php
                            }
                            elseif ($ticket_rate == 5) {
                                ?>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <?php
                            }
                            ?>
                            <?php                              
                                
                                } else {
                                echo 'Không thành công. Lỗi' . mysqli_error($connect);
                        }                        
        
            }
    else
        {
                        ?>
                <div class="section-heading">   
                <h2 class="title wow fadeInDown"> Anh/chị đã đánh giá vấn đề  <?php echo "$ticket_subject" ; ?> </h2>
                </div>
        <?php
        }
}
        else
        {
            ?>
            <section class="moduler wrapper_404">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h1 class="wow fadeInUp animated cd-headline slide" data-wow-delay=".4s" >404</h1>
                            <h2 class="wow fadeInUp animated" data-wow-delay=".6s">Opps!</h2>
                            <p class="wow fadeInUp animated" data-wow-delay=".9s">Anh chị truy cập đường link đánh giá ko hợp lệ</p>                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
                <?php
             //header("Location: index.php");
        }
                                                                                         
                        ?>        
                           
     
                        </div>
                    </div>                   
                       </div>                
            </div>
        </section>           
                                                 
                                
                        
                        
                    
                            
            <!--
            ==================================================
            Portfolio Section Start
            ================================================== -->
                        
            <!--
            ==================================================
            Footer Section Start
            ================================================== -->
            <footer id="footer">
                <div class="container">
                    <div class="col-md-12">
                        <p class="copyright">Copyright: <span>System Biti's</span> . Design and Developed by Tiến Phạm</a></p>
                    </div>
                    <div class="col-md-4">
                        <!-- Social Media 
                        <ul class="social">
                            <li>
                                <a href="http://wwww.fb.com/themefisher" class="Facebook">
                                    <i class="ion-social-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="http://wwww.twitter.com/themefisher" class="Twitter">
                                    <i class="ion-social-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="Linkedin">
                                    <i class="ion-social-linkedin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="http://wwww.fb.com/themefisher" class="Google Plus">
                                    <i class="ion-social-googleplus"></i>
                                </a>
                            </li>
                        </ul>
                        -->
                    </div>
                </div>
            </footer> <!-- /#footer -->
                
        </body>