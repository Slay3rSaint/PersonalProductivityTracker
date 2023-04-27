<?php
session_start();
ob_start();
require_once('db_config.php');

if (isset($_POST['submit']) && !empty($_POST['amount']) && !empty($_POST['expense_category_name'])) {
  // echo print_r($_POST);
  $amount = mysqli_real_escape_string($con, $_POST['amount']);
  $expense_category_name = mysqli_real_escape_string($con, $_POST['expense_category_name']);
  $created_at = date('Y-m-d');

  $sql = "SELECT expense_category_name  FROM expense_category_tbl WHERE expense_category_name = '$expense_category_name' ";
  $query = mysqli_query($con, $sql);
  if ($one = mysqli_num_rows($query) == 1) {
    echo '
         <script type="text/javascript">
          alert("' . ucfirst($expense_category_name) . ' already exist");
         </script>';
    header('expense_category.php');
  }


  $data = mysqli_query($con, "INSERT INTO expense_category_tbl(expense_category_name, created_at, amount) VALUES('" . $expense_category_name . "', '" . $created_at . "','" . $amount . "')");
}

//if data inserted successfully
if (@$data === TRUE) {
  echo '
         <script type="text/javascript">
          alert("Success!");
         </script>';
} else {
  $message = "All fields are required";
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Item Category</title>
  <!-- BOOTSTRAP STYLES-->
  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  <!-- FONTAWESOME STYLES-->
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <!-- MORRIS CHART STYLES-->

  <!-- CUSTOM STYLES-->
  <link href="assets/css/custom.css" rel="stylesheet" />
  <!-- GOOGLE FONTS-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
  <!-- TABLE STYLES-->
  <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

  <!--ASWESOME ICON-->
  <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../CSS/common.css">

  <!--  <script language="javascript" type="text/javascript">
function removeSpaces(string) {
 return string.split(' ').join('');
}
</script> -->



  <script language="JavaScript">
    function trim(strText) {
      // this will get rid of leading spaces
      while (strText.substring(0, 1) == ' ')
        strText = strText.substring(1, strText.length);

      // this will get rid of trailing spaces
      while (strText.substring(strText.length - 1, strText.length) == ' ')
        strText = strText.substring(0, strText.length - 1);

      return strText;
    }
    //-->
  </script>




</head>

<body>
  <div id="wrapper">

    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">
      <div id="page-inner">
        <!--  Modals-->
        <!-- <div class="panel panel-default"></div> -->
        <!-- <div class="panel-heading">
                            Modals Example
                        </div> -->
        <div class="panel-body">

          <!-- <button class="btn btn-primary btn-sm" onclick="location.href='../layout.php'" type="button">Home</button> -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">Add Expense Category</h4>
                </div>
                <div class="modal-body">
                  <div class="header">
                    <!--<h3 >Add New Department</h3>-->
                  </div>
                  <div class="content">
                    <!-- <div> -->
                    <form action="expense_category.php" method="POST" enctype="multipart/form-data">
                      <!-- <div style=" margin-left:100px;"> -->

                      <div class="row">
                        <div class="form-group col-md-12">
                          <label>Expense Name : </label>
                          <input type="text" name="expense_category_name" id="expense_category_name" class="form-control" placeholder="PLease Enter Expense Name" required>
                        </div>

                        <br>



                        <div class="form-group col-md-12">
                          <label> Enter Amount : </label>
                          <input type="text" name="amount" id="amount" class="form-control" placeholder="Please Enter Expense Name :" onBlur="this.value=trim(this.value);" required>
                        </div>
                      </div>
                      <?php if (isset($message)) {
                        echo "<font color='FF0000'><h5>$message</font></h5>";
                      } ?>


                      <!-- </div> -->
                      <!--  </div> -->
                      <div class="modal-footer">

                        <input type="submit" id="submit" name="submit" value="Add" class="btn btn-primary" style="" />
                        <input type="reset" id="rest" value="Cancel / Reset" class="btn btn-danger" style="" />

                      </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- End Modals-->






        <div class="row">
          <div class="col-md-12">
            <!-- Advanced Tables -->
            <!-- <div class="panel panel-default"></div> -->
            <div class="panel-heading">
              Category List
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>

                    <th>Expense Name</th>
                    <th>Amount </th>
                    <th>Date Created</th>
                    <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>


                    <?php
                    // session_start();
                    // $u_id = $_SESSION['username'];
                    $u_id = 0;

                    // $sql = mysqli_query($con, "SELECT * FROM expense_category_tbl WHERE u_id = '' order by expense_category_name ASC");

                    $sql = mysqli_prepare($con, "SELECT * FROM expense_category_tbl WHERE u_id = ? ORDER BY expense_category_name ASC");
                    mysqli_stmt_bind_param($sql, "s", $u_id);
                    mysqli_stmt_execute($sql);
                    $sql = mysqli_stmt_get_result($sql);

                    // $this->query("SELECT * FROM expense_category_tbl WHERE u_id = ? ORDER BY expense_category_name ASC", [$u_id]);

                    while ($row = mysqli_fetch_array($sql)) {
                    ?>
                      <tr>
                        <td><?php echo $row['expense_category_name'] ?></td>
                        <td><?php echo number_format((float)$row['amount'], 2, '.', '') ?></td>
                        <td><?php echo $date = DATE_FORMAT(new DateTime($row['created_at']), 'd-M-Y') ?></td>
                        <td>
                          <button type="button" class="btn btn-info btn-xs" data-target="#modal_update<?php echo $row['expense_category_id'] ?>" data-toggle='modal'><span class='glyphicon glyphicon-pencil'></span> Edit</button>
                          <input type="hidden" name="cat_id" value="<?php echo $row['expense_category_id'] ?>">

                        </td>

                        <div class="modal fade" id="modal_update<?php echo $row['expense_category_id'] ?>" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title">Update Expense</h3>
                              </div>
                              <form action="update_expense.php" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">

                                  <!-- <center><h4>Are you sure you want to delete this expense?</h4></center> -->
                                  <!-- hidden fields -->
                                  <input type="hidden" id="getID" name="getID" value="<?php echo $row['expense_category_id'] ?>">

                                  <div class="row">
                                    <div class="form-group col-md-12">
                                      <label>Expense Name</label>
                                      <input type="text" name="expense_name" id="expense_name" class="form-control" value="<?php echo $row['expense_category_name'] ?>" required="">
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="form-group col-md-12">
                                      <label>Expense Amount</label>
                                      <input type="text" name="amount" id="amount" class="form-control" value="<?php echo $row['amount'] ?>" required="">

                                    </div>
                                  </div>
                                </div>

                                <!-- <div class="row" >
               <div class="form-group">  -->
                                <div class="modal-footer">
                                    <button type="button" class="no" data-dismiss="modal">No</button>
                                    <input type="submit" id="submit" name="cat_id" value="Yes" class="btn btn-danger" />
                                    <!-- <input type="submit" id="delete" value="Delete" class="btn btn-danger" style="" /> -->
                                    <input type="hidden" name="cat_id" value="<?php echo $row['expense_category_id'] ?>">
                                    <input type="submit" name="delete" value="Delete" class="btn btn-danger" />

                                    <!-- <button type="submit" class="btn btn-danger" name="delete">Delete</button> -->
                                 
                                </div>
                                <!-- </div>
               </div> -->
                              </form>
                            </div>
                          </div>
                        </div>
                      <?php
                    }
                    ob_flush();
                      ?>

                  </tbody>
                </table>

              </div>

            </div>
            <button class="shadow_btn" data-toggle="modal" data-target="#myModal">
              <i class="fa fa-plus-circle fa-2x"></i><span id="EE_text"> Expense Category</span>
            </button>
          </div>
          <!--End Advanced Tables -->
        </div>
      </div>
      <!-- /. ROW  -->
      <div class="row"><!-- /. PAGE INNER  -->
      </div>
      <!-- /. PAGE WRAPPER  -->
      <!-- /. WRAPPER  -->
      <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
      <!-- JQUERY SCRIPTS -->
      <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
      <script src="assets/js/bootstrap.min.js"></script>
      <!-- METISMENU SCRIPTS -->
      <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- DATA TABLE SCRIPTS -->
      <script src="assets/js/dataTables/jquery.dataTables.js"></script>
      <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      <script>
        $(document).ready(function() {
          $('#dataTables-example').dataTable();
        });
      </script>
      <!-- CUSTOM SCRIPTS -->
      <script src="assets/js/custom.js"></script>



</body>

</html>