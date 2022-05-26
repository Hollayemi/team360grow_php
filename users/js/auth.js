$(document).ready(()=>{
   $('#signupBox').hide()
   $("#signupBox").css("display", "none")
   $('#signinBtn').click(()=>{
      $('#signupBox').hide()
      $('#signinBox').show()
      $('#forgotP').show();
   })
   $('#signupBtn').click(()=>{
      $('#signupBox').show()
      $('#signinBox').hide()
      $('#forgotP').hide();
   })
})

   //  j
    $('#register-btn').click((e) => {
       e.preventDefault()
       if ($("#register-form")[0].checkValidity()) {
         e.preventDefault()
          $('#register-btn').val('Please wait...')
          if ($('#r-password').val() !== $('#cpassword').val()) {
              $('#register-btn').val('Sign Up')
              $('#passMsg2').text("Passwords do not match")
          } else {
              $('#passMsg2').text("")
              $.ajax({
                  url: 'config/authCheck.php',
                  method: 'post',
                  data: $('#register-form').serialize() + "&action=register",
                  success: function(response) {
                     console.log(response);
                     $('#passMsg2').text(response)
                     if (response === 'Registered') {
                     //   window.location = "home.php"
                     } else {
                        $('#regAlert').html(response)
                        $('#register-btn').val('Sign Up')
                     }
                  }
              })
          }
      }

  })

  // Login script
$('#login-btn').click((e)=>{
   e.preventDefault();
   if($('#login-form')[0].checkValidity()){
         e.preventDefault()
         $('#login-btn').val('Please wait...')
         $.ajax({
            url: 'config/authCheck.php',
            method:'post',
            data:$('#login-form').serialize() + '&action=login',
            success:(res)=>{
               $('#passMsg').text(res)
               if(res === 'logged in'){
                     window.location = '../users/?p=dashboard';
               }else{
                  $('#loginAlert').html(res)
                  $('#login-btn').val('Sign in')
               }
            }
         })
   }
   console.log('here');
})

  // forgot script
   $('#forgot-btn').click(e=>{
      if($('#forgot-form')[0].checkValidity()){
         e.preventDefault()
         $('#forgot-btn').val('Please wait...')
         $.ajax({
            url:'../config/authCheck.php',
            method:'post',
            data:$('#forgot-form').serialize()+'&action=forgot',
            success:function(res){
               console.log(res);
               $('#passMsg').text(res)
               if(res === 'logged in'){
                     // window.location = 'Dashboard';
               }else{
                  $('#forgot-btn').val('Reset Password')
                  $('#forgot-form')[0].reset()
               }
               // $('#forgotAlert').html(res)
            }
          })
      }
   })


//   edit credentials
  $('#form-submit').click((e) => {
   e.preventDefault()
   if ($("#edit-form")[0].checkValidity()) {
     e.preventDefault()
      $('#edit-btn').val('Please wait...')
      if ($('#pass').val() !== $('#cpass').val()) {
          $('#edit-btn').val('Sign Up')
          $('#messErr').text("Passwords do not match")
      } else {
          $('#messErr').text("")
          $.ajax({
              url: 'config/authCheck.php',
              method: 'post',
              data: $('#edit-form').serialize() + "&action=edit",
              success: function(response) {
                  if (response === 'Password changed') {
                     $('#messSuss').text(response)
                     $('#editForm').hide();
                     $('.Submitted').show()
                  } else {
                     $('#messErr').text(response)
                     $('#regAlert').html(response)
                     $('#edit-btn').val('Save')
                  }
              }
          })
      }
  }

})



  // reset password
   $('#reset-btn').click((e) => {
      e.preventDefault()
      if ($("#reset-form")[0].checkValidity()) {
         e.preventDefault()
         $('#reset-btn').val('Please wait...')
         if ($('#pass').val() !== $('#cpass').val()) {
            $('#reset-btn').val('Sign Up')
            $('#passMsg').text("Passwords do not match")
         } else {
            $('#passMsg').text("")
            $.ajax({
               url: '../config/authCheck.php',
               method: 'post',
               data: $('#reset-form').serialize() + "&action=reset",
               success: function(response) {
                  console.log(response);
                  $('#passMsg').text(response)
                  if (response === 'done') {
                        
                  } else {
                     $('#regAlert').html(response)
                     $('#edit-btn').val('Save')
                  }
               }
            })
         }
      }
   });



   // new-invest

   $('#invest-submit').click((e) => {
      e.preventDefault()
      if ($("#invest-form")[0].checkValidity()) {
        e.preventDefault()
         $('#invest-btn').val('Please wait...')
         $('#messErr').text("")
         $.ajax({
            url: 'config/authCheck.php',
            method: 'post',
            data: $('#invest-form').serialize() + "&action=invest",
            success: function(response) {
               console.log(response);
               if (response === 'Invested') {
                  $('#messSuss').html('<div class="text-white leading-10 h-10 text-center px-10 bg-green-500">'+response+'</div>')
                  $('#editForm').hide();
                  $('.Submitted').show()
               } else {
                  $('#messErr').html('<div class="text-white leading-10 h-10 text-center px-10 bg-red-500">'+response+'</div>')
                  $('#regAlert').html(response)
                  $('#invest-btn').val('Save')
               }
            }
         })
      
      }
   
   })