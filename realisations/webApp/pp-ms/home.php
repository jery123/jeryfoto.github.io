<?php
  include 'action.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CRUD App</title>
  <link rel="stylesheet" href="css/style.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css" />

  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
</head>

<body>
  <!-- <nav class="navbar navbar-expand-md bg-dark navbar-dark"> -->
    <!-- Brand -->
    <!-- <a class="navbar-brand" href="#">CRUD App</a> -->
    <!-- Toggler/collapsibe Button -->
    <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button> -->
    <!-- Navbar links -->
    <!-- <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
      </ul>
    </div>
    <form class="form-inline" action="/action_page.php">
      <input class="form-control mr-sm-2" type="text" placeholder="Search">
      <button class="btn btn-primary" type="submit">Search</button>
    </form>
  </nav> -->
  <!--  -->
  <nav>
    <div class="menu">
      <div class="logo">
        <a href="#">PP-Manager</a>
      </div>
      <ul>
      <li><a href="#home">Home</a></li>
        <li><a href="About.php">About</a></li>
        <li><a href="Network.php">Network</a></li>
            <li>
              <a href="Auth/log_out.php">Logout</a></li>
        <li>
          <div style="border-radius: 30px; width: 80px; height: 30px; background-color:aliceblue; text-align: center;">
            <?php echo "@.".$_SESSION['name'] ?>
          </div>
        </li>
     </ul>
    </div>
  </nav>
      <!--  -->
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <h3 class="text-center text-dark mt-2">Project Management System</h3>
        <hr>
        <?php if (isset($_SESSION['response'])) { ?>
        <div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissible text-center">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <b><?= $_SESSION['response']; ?></b>
        </div>
        <?php } unset($_SESSION['response']); ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <h3 class="text-center text-info">Add Project</h3>
        <form action="action.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $id; ?>">
          <div class="form-group">
            <input type="text" name="name" value="<?= $name; ?>" class="form-control" placeholder="Enter name" >
          </div>
          <div class="form-group">
          <textarea id="description" name="description" value="<?= $description; ?>" class="form-control" placeholder="Enter description" rows="4" cols="50"><?= $description; ?></textarea>
          </div>
          <div class="form-group">
            <input type="number" name="evolution" value="<?= $evolution; ?>" class="form-control" placeholder="Enter evolution" min="0" max="100" required>
          </div>
          <div class="form-group">
            <?php if ($update == true) { ?>
            <input type="submit" name="update" class="btn btn-success btn-block" value="Update Record">
            <?php } else { ?>
            <input type="submit" name="add" class="btn btn-primary btn-block" value="Add Record">
            <?php } ?>
          </div>
        </form>
      </div>
      <div class="col-md-8">
        <?php
          $sql = "SELECT * FROM projects where UID=".$_SESSION['id']."";
          $result = mysqli_query($conn, $sql);
        ?>
        <h3 class="text-center text-info">Your Projects</h3>
        <table class="table table-hover" id="data-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Image</th>
              <th>Name</th>
              <th>Description</th>
              <th>Progress</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td><?= $row['id']; ?></td>
              <td><img src="images/default_icon.png" width="25"></td>
              <td><?= $row['projectName']; ?></td>
              <td><?= $row['description']; ?></td>
              <td>
              <div class="progress"> 
               <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" aria-label="Warning striped example" style="width: <?= $row['evolution']; ?>%" aria-valuemin="0" aria-valuemax="100">
               </div>
               </div> 
              <td>
                <a href="details.php?details=<?= $row['id']; ?>" class="badge badge-primary p-2">Details</a> |
                <a href="action.php?delete=<?= $row['id']; ?>" class="badge badge-danger p-2" onclick="return confirm('Do you want delete this record?');">Delete</a> |
                <a href="home.php?edit=<?= $row['id']; ?>" class="badge badge-success p-2">Edit</a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div><br><br><br>
<!--  -->
  <footer class="footer bg-dark text-center text-white" id="footer">
    <div class="text-center p-3" > <p>&copy; 2023 Develop At Marwadi College Rajkot. All Rights
    Reserved | Design by:- Jeryh FOTO<o:p></o:p></p>
    </div>
    <!-- Copyright -->
    </footer>
  <script type="text/javascript">
  $(document).ready(function() {
    $('#data-table').DataTable({
      paging: true
    });
  });
  </script>
</body>

</html>