
// show password
$(document).ready(function(){

    $('#showPass').on('click', function(){

       var passInput=$("#admin_password");
       if(passInput.attr('type')==='password')
         {
           passInput.attr('type','text');
       }else{
          passInput.attr('type','password');
       }

   })
    $('#showPassConfirm').on('click', function(){

       var passInput=$("#admin_password_confirm");
       if(passInput.attr('type')==='password')
         {
           passInput.attr('type','text');
       }else{
          passInput.attr('type','password');
       }

   })

  //  login password confirm
    $('#showPass').on('click', function(){

       var passInput=$("#admin_password_login");
       if(passInput.attr('type')==='password')
         {
           passInput.attr('type','text');
       }else{
          passInput.attr('type','password');
       }

   })


  })

  // admin auth

  $(document).ready(function(){
    $("#registation").click(function (event) {
      event.preventDefault();

      var admin_name = $("#admin_name").val() ? $("#admin_name").val() : false;
      var admin_email = $("#admin_email").val() ? $("#admin_email").val() : false;
      var admin_password = $("#admin_password").val() ? $("#admin_password").val() : false;
      var role = $("#role").val() ? $("#role").val() : false;
      var admin_password_confirm = $("#admin_password_confirm").val() ? $("#admin_password_confirm").val() : false;

      // validation error messgage show select

      if (admin_name == false) {

          Swal.fire({
              icon: "error",
              title: "Input field is empty",
              text: "Fill in the Name input field",
          });

          return 0;
      }
      if (admin_email == false) {

          Swal.fire({
              icon: "error",
              title: "Input field is empty",
              text: "Fill in the Email input field",
          });

          return 0;
      }
      if (admin_password == false) {

          Swal.fire({
              icon: "error",
              title: "Input field is empty",
              text: "Fill in the Admin Password input field",
          });

          return 0;
      }
      if (admin_password_confirm == false) {

          Swal.fire({
              icon: "error",
              title: "Input field is empty",
              text: "Fill in the Admin Confirm Password input field",
          });

          return 0;
      }

      if(admin_password != admin_password_confirm){
        Swal.fire({
          icon: "error",
          title: "Two password is not match",
          text: "Two password is not match",
      });

      return 0;
      }


      axios
          .post("/admin-registaion", {
            admin_name: admin_name,
            admin_email: admin_email,
            admin_password: admin_password,
          })
          .then(function (response) {

            if(response.status == 200 && response.data == 1){
              Swal.fire({
                icon: "success",
                title: "Registation Completed",
                text: "Thanks",
              });

              window.location.href = '/login';
            }else{
              Swal.fire({
                icon: "error",
                title: "Registaion Faild",
                text: response.data,
              });
            }



          })
          .catch(function (error) {
              Swal.fire({
                  position: "top-center",
                  icon: "error",
                  title: "Your form submission is not complete",
                  showConfirmButton: false,
                  timer: 1500,
              });
          });
    });


    $("#adminLogin").click(function (event) {
      event.preventDefault();

      var admin_email_login = $("#admin_email_login").val() ? $("#admin_email_login").val() : false;
      var admin_password_login = $("#admin_password_login").val() ? $("#admin_password_login").val() : false;

      axios
          .post("/admin-login", {
            admin_email_login: admin_email_login,
            admin_password_login: admin_password_login,
          })
          .then(function (response) {

            if(response.status == 200 && response.data == 1){
              Swal.fire({
                icon: "success",
                title: "Login Success Completed",
                text: "Thanks",
                timer: 1500,
              });

              window.location.href = '/admin';
            }else{
              Swal.fire({
                icon: "error",
                title: "Login Faild",
                text: "Please try again",
                timer: 1500,
              });
            }



          })
          .catch(function (error) {
              Swal.fire({
                  position: "top-center",
                  icon: "error",
                  title: error,
                  showConfirmButton: false,
                  timer: 1500,
              });
          });
    });

    $("#userLogout").click(function(event){
      event.preventDefault();

      axios
          .post("/admin-logout")
          .then(function (response) {

            if(response.status == 200 && response.data == 1){
              Swal.fire({
                icon: "success",
                title: "Logout Done",
                text: "Thanks",
                timer: 1500,
              });

              location.reload();

            }


          })
          .catch(function (error) {
              Swal.fire({
                  position: "top-center",
                  icon: "error",
                  title: "Server Error",
                  showConfirmButton: false,
                  timer: 1500,
              });
          });
    })

  })


  // jquery datatables

  $(document).ready(function () {
    $("#VisitorDt").DataTable();
    $(".dataTables_length").addClass("bs-select");
  });

  // image show
  $(document).ready(function () {

    $("#demo_img").change(function () {
      var reader = new FileReader();
      reader.readAsDataURL(this.files[0]);
      reader.onload = function (event) {
          var ImgSource = event.target.result;
          $("#show_image").attr("src", ImgSource);
      };
  });
  });


  // registation


  $("#registation").click(function (event) {
    event.preventDefault();

    var admin_name = $("#admin_name").val() ? $("#admin_name").val() : false;
    var admin_email = $("#admin_email").val() ? $("#admin_email").val() : false;
    var admin_password = $("#admin_password").val() ? $("#admin_password").val() : false;
    var role = $("#role").val() ? $("#role").val() : false;
    var admin_password_confirm = $("#admin_password_confirm").val() ? $("#admin_password_confirm").val() : false;

    // alert(admin_name+ "," + admin_email+ "," +admin_password+ "," +admin_password_confirm)

    // validation error messgage show select

    if (admin_name == false) {

        Swal.fire({
            icon: "error",
            title: "Input field is empty",
            text: "Fill in the Name input field",
        });

        return 0;
    }
    if (admin_email == false) {

        Swal.fire({
            icon: "error",
            title: "Input field is empty",
            text: "Fill in the Email input field",
        });

        return 0;
    }
    if (admin_password == false) {

        Swal.fire({
            icon: "error",
            title: "Input field is empty",
            text: "Fill in the Admin Password input field",
        });

        return 0;
    }
    if (admin_password_confirm == false) {

        Swal.fire({
            icon: "error",
            title: "Input field is empty",
            text: "Fill in the Admin Confirm Password input field",
        });

        return 0;
    }

    if(admin_password != admin_password_confirm){
      Swal.fire({
        icon: "error",
        title: "Two password is not match",
        text: "Two password is not match",
    });

    return 0;
    }


    axios
        .post("/admin-registaion", {
          admin_name: admin_name,
          admin_email: admin_email,
          admin_password: admin_password,
          role: role,
        })
        .then(function (response) {

          if(response.status == 200 && response.data == 1){
            Swal.fire({
              icon: "success",
              title: "Registation Completed",
              text: "Thanks",
            });

            window.location.href = '/admin';
          }else{
            Swal.fire({
              icon: "error",
              title: "Registaion Faild",
              text: response.data,
            });
          }



        })
        .catch(function (error) {
            Swal.fire({
                position: "top-center",
                icon: "error",
                title: "Your form submission is not complete",
                showConfirmButton: false,
                timer: 1500,
            });
        });
  });
