<?php 
    include('header.php');
?>

<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="../index.php"><b>Admin </b>IB</a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name">John Doe</div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="../dist/img/user1-128x128.jpg" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials">
      <div class="input-group">
        <input type="password" class="form-control" placeholder="password">

        <div class="input-group-append">
          <button type="button" class="btn">
            <i class="fas fa-arrow-right text-muted"></i>
          </button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    Enter your password to retrieve your session
  </div>
  <div class="text-center">Or
    <a href="login.php"> Sign in</a>
  </div>
  <div class="lockscreen-footer text-center">
      Copyright &copy; 2014-2021 <b><a href="https://dropshep.com" target="_blank" class="text-black">DROPSHEP <span class="text-orange"> </span></a></b><br>
      All rights reserved
  </div>
</div>
<!-- /.center -->


<?php
    include('footer.php');
?>
