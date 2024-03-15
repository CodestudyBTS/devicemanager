<?php
        include ('header.php');
        session_start();
        include('../admin/connect.php');
    ?> 
    <?php

// Database Connection 
//$conn = new mysqli('hostname', 'username', 'password', 'database');
//Check for connection error
//$select = "SELECT * FROM `infopdf`";
//$result = $conn->query($select);
//while($row = $result->fetch_object()){
 // $pdf = $row->filename;
//  $path = $row->directory;
//  $date = $row->created_date;
  $file = "../tailieu/123.pdf";
//}
// Add header to load pdf file
//header('Content-type: application/pdf'); 
//header('Content-Transfer-Encoding: binary'); 
//header('Accept-Ranges: bytes'); 
//@readfile($file);  


?>
<body>
            <section id="feature">
                <div class="container">
                        <!--
                    <div class="section-heading">
                        <h1 class="title wow fadeInDown" data-wow-delay=".3s">DASBOARD </h1>
                        <p class="wow fadeInDown" data-wow-delay=".5s">
                            Quản lý Backup application 
                        </p>
                    </div>
            -->
                            
                        </div>                                   
                                
                        <div class="col-md-12 col-lg-12 col-xs-12">
                                <div class="col-lg-3"> 
                                <ul class="col-lg-3">
                                        <li >kbbkfvldfv</li>
                                        <li>kbbkfvldfv</li>
                                        <li>kbbkfvldfv</li>
                                        <li>kbbkfvldfv</li>
                                       <iframe width="420" height="345" src="https://www.youtube.com">
</iframe>
                                </ul>                               
                                </div>
                                <div class="col-lg-9">
                                <iframe src="<?php echo $file; ?>" width="100%" height="750px"> </iframe>
                                </div>
                        </div>
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
                    <div class="col-md-8">
                        <p class="copyright">Copyright: <span>System Biti's</span> . Design and Developed by Tiến Phạm</a></p>
                    </div>
                </div>

            </footer> <!-- /#footer -->
                
        </body>