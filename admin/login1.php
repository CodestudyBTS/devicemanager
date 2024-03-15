<?php 
			require 'xuly.php';
			?>
      <?php include 'header.php';?>
<section class="vh-100">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-5 text-black">        
        <div class="px-10 ms-xl-4">
          <a href="index.php" >
                            <img src="../images/logo.jpg" width="500" height="250" alt="">
                        </a>
        </div>

       <!-- <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5"> -->
        <div class="d-flex align-items-center h-custom-2 px-1 ms-xl-1 mt-1 pt-1 pt-xl-0 mt-xl-n1">
          <form action='login.php' class="dangnhap" method='POST'style="width: 30rem;">

            <!-- <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3> -->

            <div class="form-outline mb-4">
			<label class="form-label" for="form2Example18">Email address</label>
              <input type="text" id="form2Example18" name="txtUsername" class="form-control form-control-lg" />              
            </div>

            <div class="form-outline mb-4">
			<label class="form-label" for="form2Example28">Password</label>
              <input type="password" id="form2Example28" name="txtPassword" class="form-control form-control-lg" />              
            </div>

            <div class="pt-1">
             <!-- <button class="btn btn-info btn-lg btn-block" name="dangnhap" type="button">Login</button> -->
			  <input type='submit' name="dangnhap" class="btn btn-info btn-lg btn-block"   value='Login' />
            </div>
<!--
            <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
            <p>Don't have an account? <a href="#!" class="link-info">Register here</a></p>
			-->
          </form>

        </div>

      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block">
        <img src="../images/login_img.jpg"
          alt="Login image" class="w-100 vh-100" style="object-position: left;">
      </div>
    </div>
  </div>
</section>