<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <div class="row">
      <div class="col-md-6">
      <h2 style="margin-top: 0px;">
      
       View User
      </h2>
      <p><a href="../admin/?p=dashboard"><i class="fa fa-dashboard"></i> Home</a> &nbsp;&nbsp; > &nbsp;&nbsp; <a class="active">All Users</a></p>
    </div>
     <!--<div class="col-md-4" style="text-align: left; margin-top: 10px;">  <a href="?p=new_category"> <button class="btn btn-primary" style="font-size: 16px; font-weight: 600;">Add New Category</button></a>  </div>-->
     

    </section>
     <!-- Main content -->
    <section class="content" style="margin-top: 0px; padding-top: 0px; ">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-10 col-xs-12" style="background-color: #fff; margin-left: 10px; border:solid; border-width: thin; border-color: #ddd;">

          <!-- small box -->
          <!-- <a href="add_product.php"><button style="background-color: #0060cc; height: 40px; width: 250px; border:none; border-radius: 5px; color: white; font-size: 16px;">ADD PRODUCT</button></a> -->
      
         <h4 style="color: green; font-weight: bold;"> </h4>
          <div style="dborder: solid; border-width: thin; border-color: #ccc; margin-top: 0px; padding: 1.5em; dheight: 500px; ">
      
<table class="table dtable-striped table-hover no-head-border" border="1" style="border:solid; border-color: black; font-size: 15px; border-width: thin;">
 <th style="border:solid; border-width: thin; border-color: #eee; color: white; background-color: #0060a0;">Full Name</th>
<!-- <th style="border:solid; border-width: thin; border-color: #eee; color: white; background-color: #0060a0;">Last Name</th>-->
 <th style="border:solid; border-width: thin; border-color: #eee; color: white; background-color: #0060a0;">Email</th>
 <th style="border:solid; border-width: thin; border-color: #eee; color: white; background-color: #0060a0;">Phone</th> 
 <th style="border:solid; border-width: thin; border-color: #eee; color: white; background-color: #0060a0;">Date Joined</th>
<th style="border:solid; border-width: thin; border-color: #eee; color: white; background-color: #0060a0;">Status</th>
<th colspan="4" style="border:solid; border-width: thin; border-color: #eee; color: white; background-color: #0060a0;">Action</th>
<!-- <th style="border:solid; border-width: thin; border-color: #eee;">Delete</th>-->
<?php

require 'config/config.php';


$id = $_GET['id'];
$sql=$con->query("SELECT * FROM auth WHERE id = '$id'") or die("Error2 : ". mysqli_error($con));

 $i=1;
   
  $rows=mysqli_fetch_array($sql);
   
    $id=$rows['id'];
    $fname = $rows['fullname'];
    $email=$rows['email'];
    $phone=$rows['phone'];
    $date_t =$rows['createdAt'];
    $status =$rows['status'];

    $date_t = date('d-M-Y',strtotime('+0 days',strtotime(str_replace('/', '-', $date_t))));
    
    
?>
<tr><td style="border:solid; border-width: thin; border-color: #eee;"><?php echo $fname; ?><td style="border:solid; border-width: thin; border-color: #eee;"><?php echo $email; ?> <td style="border:solid; border-width: thin; border-color: #eee;"><?php echo $phone; ?><td style="border:solid; border-width: thin; border-color: #eee;"><?php echo $date_t; ?><td style="border:solid; border-width: thin; border-color: #eee;"><?php echo $status; ?><td style="border:solid; border-width: thin; border-color: #eee;">
  <button class="btn btn-primary activate" id="<?php echo $id; ?>">Activate</button>
  <br>
  <br>
  <button onclick="deactivate('<?php echo $id; ?>')" class="btn btn-primary">De-activate</button>
  <br>
  <br>
  &nbsp;<button class="btn btn-primary" onclick="delete_user('<?php echo $id; ?>')">Delete</button>

</td></td></td></td></td></td></td></tr>
</table>

</div>







<script type="text/javascript">

// Reject KYC

$('body').on('click','.rejectKyc',function(e){
  e.preventDefault()
  var userId = $(this).attr('id');
  console.log(userId);
  Swal.fire({
      title: 'Are you sure?',
      text: "Do You want to Reject this User KYC?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Reject KYC!'
      }).then((result) => {
      if (result.isConfirmed) {
          $.ajax({
              url:'pages/config/controller.php',
              method:'post',
              data:{rejectKYC:userId},
              success:(res)=>{
                console.log(res);
                if (res === "success") {
                  
                  Swal.fire({
                    title: "KYC Rejected",
                    icon: 'success',
                    text: "User KYC Rejected Successfully"
                  }).then(()=>{
                  location.reload()

                  })
                }
                if (res === "fail") {
                  Swal.fire({
                    title: "Server Error",
                    icon: 'error',
                    text: "Server Error Could not activate User "
                  })
                }
                if (res === "verified") {
                  Swal.fire({
                    title: "Account Activated",
                    icon: 'warning',
                    text: "User Account has already been Verified!"
                  })
                }  
                   
              }
          })
          
      }
  })
  
})

// Activate User
$('body').on('click','.activate',function(e){
  e.preventDefault()
  var userId = $(this).attr('id');
  console.log(userId);
  Swal.fire({
      title: 'Are you sure?',
      text: "Do You want to Activate this User!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Activate user!'
      }).then((result) => {
      if (result.isConfirmed) {
          $.ajax({
              url:'process/activate_user.php',
              method:'get',
              data:{id:userId},
              success:(res)=>{
                console.log(res);
                if (res === "success") {
                  
                  Swal.fire({
                    title: "Successful Activation",
                    icon: 'success',
                    text: "User Activated Successfully"
                  }).then(()=>{
                  location.reload()

                  })
                }
                if (res === "fail") {
                  Swal.fire({
                    title: "Server Error",
                    icon: 'error',
                    text: "Server Error Could not activate User "
                  })
                }
                if (res === "verified") {
                  Swal.fire({
                    title: "Account Activated",
                    icon: 'warning',
                    text: "User Account has already been Verified!"
                  })
                }  
                   
              }
          })
          
      }
  })
  
})

function activate(id)
{

var r = confirm ("Do you want to Activate this User?");

if (r == true) {
var dataString='id='+id;
$.ajax({
type:"GET",
url:"process/activate_user.php",
data:dataString,
jsonp:"callback",
jsonpCallback:"Sverify",
dataType:"jsonp",
crossDomain:true,
success: function(data){
var success = data.success;
if(data ==="success")
{
alert("User Activated Successfully!");
window.location = "?p=view_customer&id="+id;
}
else if (data = "fail")
{
 alert("An error Occured!");
}
},
beforeSend:function()
{
$('#loader').fadeOut(200).show();
},
error: function(jqXHR, textStatus, errorThrown)
{
    alert ("Could not connect to server");
    //$('#in').fadeOut(200).hide();

}

});
} 
else
{
} 
}
</script>


<script type="text/javascript">
function deactivate(id)
{

var r = confirm ("Do you want to Deactivate this User?");

if (r == true) {
var dataString='id='+id;
$.ajax({
type:"GET",
url:"process/deactivate_user.php",
data:dataString,
jsonp:"callback",
jsonpCallback:"Sverify",
dataType:"jsonp",
crossDomain:true,
success: function(data){
var success = data.success;
if(success == "Yes")
{
alert("User Deactivated Successfully!");
window.location = "?p=view_customer&id="+id;
}
else if (success = "No")
{
 alert("An error Occured!");
}
},
beforeSend:function()
{
$('#loader').fadeOut(200).show();
},
error: function(jqXHR, textStatus, errorThrown)
{
    alert ("Could not connect to server");
    //$('#in').fadeOut(200).hide();

}

});
} 
else
{
} 
}
</script>



<script type="text/javascript">
function delete_user(id)
{

var r = confirm ("Do you want to Delete this User?");

if (r == true) {
var dataString='id='+id;
$.ajax({
type:"GET",
url:"process/delete_user.php",
data:dataString,
jsonp:"callback",
jsonpCallback:"Sverify",
dataType:"jsonp",
crossDomain:true,
success: function(data){
var success = data.success;
if(success == "Yes")
{
alert("User Deleted Successfully!");
window.location = "?p=";
}
else if (success = "No")
{
 alert("An error Occured!");
}
},
beforeSend:function()
{
$('#loader').fadeOut(200).show();
},
error: function(jqXHR, textStatus, errorThrown)
{
    alert ("Could not connect to server");
    //$('#in').fadeOut(200).hide();

  }

});
} 
else 
{
} 
}
</script>



  
</div>
</div>
</div>
</section>
       

    
     
  <div class="col-lg-6 col-xs-12">
          <!-- small box -->
          <div>
        </div>
        </div>
     
      </div>
      <!-- /.row -->
      <!-- Main row -->



      <div class="row">
        <!-- Left col -->
     </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

   
<?php include('includes/js.php')?>
</body>
</html>



