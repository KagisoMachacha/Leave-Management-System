<?php 
  include('includes/header.php');
  require('../php-includes/connect.php');

  $userid = $_SESSION['userid'];

  $query = mysqli_query($con, "SELECT * FROM leaves WHERE userid = '$userid' ");

  $my_leaves = array();
  while ($row = mysqli_fetch_assoc($query)) {

    array_push($my_leaves, array(
      'userid' => $row['userid'], 
      'startdate' => $row['startdate'],                                                   
      'enddate' => $row['enddate'],                                                   
      'reason' => $row['reason'],                                                   
      'status' => $row['status'],
      'comment' => $row['comment'],
    ));
  }

  $all_leaves = array();
  $query2 = mysqli_query($con, "SELECT * FROM leaves ");

  while ($row = mysqli_fetch_assoc($query2)) {

    array_push($all_leaves, array(
      'id'=> $row['id'],
      'userid' => $row['userid'], 
      'startdate' => $row['startdate'],                                                   
      'enddate' => $row['enddate'],                                                   
      'reason' => $row['reason'],                                                   
      'status' => $row['status'],
      'comment' => $row['comment'],
    ));
  }

  function get_username_form_id($id)
  {
    require('../php-includes/connect.php');

    $query = mysqli_query($con, "select * from users where id='$id'");

    if($query)
    {
        $udata = mysqli_fetch_assoc($query);

        return $udata['username'];
    }

    return null;
  }

  function get_number_of_leaves($status)
  {
    require('../php-includes/connect.php');

    $query = mysqli_query($con, "select * from leaves where status='$status' ");

    return mysqli_num_rows($query);
  }

?>

    <div class="pagetitle">
      <h1>Welcome <?php echo $_SESSION['usertype'];?> 😊</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>

    <?php if($_SESSION['usertype'] == 'user' ){?>

      <section class="section">
        <div class="row">

          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Employee Leave Request</h5>

                <form action="leave-request.php" method="post">
                  
                  <div class="row mb-3">
                    <label for="inputDate" class="col-sm-2 col-form-label">Start Date</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" name="startdate" required>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputDate" class="col-sm-2 col-form-label">End Date</label>
                    <div class="col-sm-10" >
                      <input type="date" class="form-control" name="enddate" required>
                    </div>
                  </div>
              
                  <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Reason for leave</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" style="height: 100px" name="reason" required></textarea>
                    </div>
                  </div>
                
                  <div class="row mb-3">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Submit Form</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

          </div>

          <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">My Leave Requests</h5>

                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Start date</th>
                      <th scope="col">End date</th>
                      <th scope="col">Reason for leave</th>
                      <th scope="col">Status</th>
                      <th scope="col">Admin Comment</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach(array_reverse($my_leaves) as $leave){?>
                    <tr>
                      <td><?php echo $leave['startdate']; ?></td>
                      <td><?php echo $leave['enddate']; ?></td>
                      <td><?php echo $leave['reason']; ?></td>
                      <td><?php echo $leave['status']; ?></td>
                      <td><?php echo $leave['comment']; ?></td>
                      
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>

            </div>

              </div>
            </div>

          </div>
        </div>
      </section>
    <?php }?>

    <?php if($_SESSION['usertype'] == 'admin' ){?>
      <section class="section">
        <div class="row">
            <!-- Approved Leave Requests Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Approved Leave Requests</h5>
                        <p class="card-text"><?php echo get_number_of_leaves('approved'); ?></p>
                    </div>
                </div>
            </div>

            <!-- Rejected Leave Requests Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Rejected Leave Requests</h5>
                        <p class="card-text"><?php echo get_number_of_leaves('rejected') ?></p>
                    </div>
                </div>
            </div>

            <!-- Pending Leave Requests Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Pending Leave Requests</h5>
                        <p class="card-text"><?php echo get_number_of_leaves('pending'); ?></p>
                    </div>
                </div>
            </div>

        </div>
      
        <!-- DataTable -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Employees Leave Requests</h5>
                        <table class="table" id="leaveTable">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th>Comment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Leave request rows will be added here -->
                              <?php foreach(array_reverse($all_leaves) as $leave){?>
                                <form action="update-leave.php" method="post">
                                  <tr>
                          
                                    <td><?php echo get_username_form_id($leave['userid']); ?></td>
                                    <td><?php echo $leave['startdate']; ?></td>
                                    <td><?php echo $leave['enddate']; ?></td>
                                    <td><?php echo $leave['reason']; ?></td>
                                    <td>

                                      <select class="form-select" name="status">
                                        <option <?php if($leave['status'] == "pending"){echo "selected";} ?> value="pending">Pending</option>
                                        <option <?php if($leave['status'] == "approved"){echo "selected";} ?> value="approved">Approved</option>
                                        <option <?php if($leave['status'] == "rejected"){echo "selected";} ?> value="rejected" >Rejected</option>
                                      </select>
                                      <input type="text" name="leaveid" value="<?php echo $leave['id'];?>" hidden/>
                                    </td>
                                    <td> 
                                      <textarea class="form-control" rows="1" name="comment"><?php echo $leave['comment']; ?> </textarea>
                                    </td>
                                    <td><button class="btn btn-success" type="submit">Save</button></td>
                                  </tr>
                                </form>
                              <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      </section>
    <?php }?>

<?php include('includes/footer.php') ?>
    

  