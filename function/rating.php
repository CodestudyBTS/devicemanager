<?php
        include ('header.php');
        session_start();
        include('../admin/connect.php');
        $id_ticket = $_GET['ticket_id'];        
        $team_member_email = $_GET['team_member_email'];
        $customer_email = $_GET['customer_email'];
        $ticket_subject  = $_GET['ticket_subject'];
        $ticket_create_date = $_GET['ticket_create_date']; 
        $ticket_rate = $_GET['ticket_rate'];
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

        $query_rating = "INSERT INTO rating (team_member_email, customer_email, ticket_id , ticket_subject, ticket_create_date, ticket_rate ) VALUES ('$team_member_email', '$customer_email', '$id_ticket', '$ticket_subject', '$ticket_create_date', '$ticket_rate') ";
                            if (mysqli_query($connect, $query_rating)) 
                            {
                                echo "Thêm record thành công";
                                } else {
                                echo 'Không thành công. Lỗi' . mysqli_error($connect);
                        }
                                                                                         
                        ?>                         
                                
                        
                        
                    </div>
                </div>
            </section> <!-- /#feature -->
                            
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