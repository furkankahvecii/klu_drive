<?php $this->load->view('template/v_header'); ?>

<body themebg-pattern="theme6">

  <section class="login-block">

    <div class="container-fluid">
      <a class="hiddenanchor" id="accounting"></a>
      <a class="hiddenanchor" id="personal"></a>
      <a class="hiddenanchor" id="admin"></a>
      <div class="row">
        <div class="col-sm-12">

          <form class="md-float-material form-material" method="post"
            action='<?php echo base_url();?>Login/LoginControl'>
            <div class="text-center">
              <h3> KLU DRIVE</h3>
            </div>
            <div class="auth-box card">
              <div class="card-block">
                <div class="row m-b-20">
                  <div class="col-md-12">
                    <h3 class="text-center txt-primary">Login</h3>
                  </div>
                </div>

                <div class="form-group form-primary">
                  <input type="text" name="email" id="email" class="form-control" required="">
                  <span class="form-bar"></span>
                  <label class="float-label">Email Adresi</label>
                </div>
                <div class="form-group form-primary">
                  <input type="password" name="password" id="password" class="form-control" required="">
                  <span class="form-bar"></span>
                  <label class="float-label">Parola</label>
                </div>

                <div class="row m-t-30">
                  <div class="col-md-12">
                    <button class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20" id="login"
                      name="login">LOGIN</button>
                  </div>
                </div>

              </div>
            </div>
          </form>

        </div>

      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="auth-box card">
            <div class="card-block">
              <div class="text-center">
                <div class="card">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                      <h5>Login Credentials</h5>
                    </li>
                    <li class="list-group-item">personal/personal</li>
                    <li class="list-group-item">student/student</li>
                    <li class="list-group-item">admin/admin</li>
                  </ul>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

  </section>

  <?php $this->load->view('template/v_footer'); ?>
  <script>
    document.getElementById("email").autofocus;
    document.getElementById("password").autofocus;
    document.getElementById("button").autofocus;
  </script>


</body>