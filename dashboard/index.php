
<?php 
  include('includes/header.php') ;
  require('../php-includes/connect.php');

  $userid = $_SESSION['userid'];

  $query = mysqli_query($con, "SELECT * FROM leaves WHERE userid = '$userid' ");

  // $my_leaves = array();
  // while(mysqli_fetch_assoc($query))
  // {
  //     $my_leaves["
  //     {
  //       'reason': 'startdate',
  //       'enddate': 'status',
  //       'comment'
  //     }"
  //   ];
  // }
?>

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Employee Leave Request</h5>

              <!-- General Form Elements -->
              <form action="leave-request.php" method="post">
                
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-2 col-form-label">Start Date</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="startdate">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-2 col-form-label">End Date</label>
                  <div class="col-sm-10" >
                    <input type="date" class="form-control" name="enddate">
                  </div>
                </div>
            
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Reason for leave</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" style="height: 100px" name="reason"></textarea>
                  </div>
                </div>
               
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit Form</button>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>

        
</div>
        <div class="row">

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Logged Request Details</h5>

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Start date</th>
                    <th scope="col">End date</th>
                    <th scope="col">Reason for leave</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>2014-12-05</td>
                    <td>2012-06-11</td>
                    <td>Angus Grady</td>
                    <td>Approved</td>
                    
                  </tr>
                </tbody>
              </table>
              <!-- End Default Table Example -->
            </div>
          </div>

          </div>

            </div>
          </div>

        </div>
      </div>
    </section>


<?php include('includes/footer.php') ?>
    

  