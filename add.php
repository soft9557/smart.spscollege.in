<?php
                                $get_data = "SELECT * FROM student_data";
                                $run_data = mysqli_query($con,$get_data);
                                //$i = 0; 
                                if (mysqli_num_rows($run_data) > 0)
                                {
                                  foreach($run_data as $row)
                                  {
                                  //$sl = ++$i;
                                ?>
                                 
                                <tr>
                               
                                <td><?php echo $row['st_adm_no']; ?></td>
                                <td><?php echo $row['st_name']; ?><td>
                                <td><?php echo $row['cl_cd']; ?></td>
                                <td><?php echo $row['cl_sec']; ?></td>
                                <td><?php echo $row['st_fath']; ?></td>
                                <td><?php echo $row['st_moth']; ?></td>
                                <td><?php echo $row['st_fee']; ?></td>
                               
                                <td>                            
                                <button type="button" value="<?php echo $row['id']; ?>" class="btn btn-info btn-sm deletebtn">View</button>
                                </td> 
                                <td>
                                  <button type="button" value="<?php echo $row['id']; ?>" class="btn btn-info btn-sm deletebtn">Edit</button>
                                </td>
                                <td>
                                  <button type="button" value="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm deletebtn">Delete</button>
                                </td>
                              </tr>
                                <?php
                                }
                                }
                                else
                                {
                                ?>
                                  <tr>
                                      <td> No Record Found</td>
                                  </tr>
                                <?php
                                  }
                                ?>





<!------DELETE modal---->
<div class="modal fade" id="DeletSt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl">
          <div class="modal-content">
             <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Delete Student</h3>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                   </div>
                  <form action="addstudent1.php" method="POST">
                    <div class="modal-body">
                    </div>
                    <input type="text" name="delete_sid" class="delet_stu_id" >
                  <p>
                    Are you sure. you want to delete this data? 
                  </p>     
                     </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="Deletstu" class="btn btn-primary">Yes,Delete.!</button>
                </div>
                </form>
        </div>
      </div>
    </div>


    <button type="button" value="<?php echo $row['id']; ?>" class="btn btn-info btn-sm deletebtn">View</button>
                                <button type="button" value="<?php echo $row['id']; ?>" class="btn btn-info btn-sm deletebtn">Edit</button>
                         
