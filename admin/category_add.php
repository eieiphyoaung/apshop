<?php
  session_start();
  require '../config/config.php';
  require '../config/common.php';

  if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])){
    header('Location: login.php');
  }

  if($_SESSION['role'] != 1){
      header('Location: login.php');
  }

  if($_POST){
      if(empty($_POST['name']) || empty($_POST['description'])){
            if(empty($_POST['name'])){
                $nameError = 'Name cannot be null';
            }
            if(empty($_POST['description'])){
                $descriptionError = 'Description cannot be null';
            }
      }else{
            $name = $_POST['name'];
            $description = $_POST['description'];

            $stmt = $pdo->prepare("INSERT INTO categories(name,description) VALUES(:name,:description)");
            $result = $stmt->execute(
                            array(':name' => $name, ':description' => $description)
                        );
            if($result){
                echo "<script>alert('Category added');window.location.href='category.php';</script>";
            }
      }
  }

?>

  <?php
    include('header.php');
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="category_add.php" method="post">
                        <input name="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">
                        <div class="form-group">
                            <label for="name">Name</label> <p style="color:red;"><?php echo empty($nameError) ? '' : '* '.$nameError; ?> </p>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label><p style="color:red;"><?php echo empty($descriptionError) ? '' : '* '.$descriptionError; ?> </p>
                            <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="SUBMIT">
                            <a href="index.php" class="btn btn-warning">Back</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <?php
    include('footer.html');
  ?>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
