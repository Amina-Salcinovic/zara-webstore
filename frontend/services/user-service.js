var UserService = {
  init: function () {

    var token = localStorage.getItem("user_token");
    if (token && token !== undefined) {
      window.location.replace("index.html");
    }

    // LOGIN VALIDATION
    if ($("#login-form").length) {
      $("#login-form").validate({
        submitHandler: function (form) {
          let entity = Object.fromEntries(new FormData(form).entries());
          UserService.login(entity);
        }
      });
    }

    // REGISTER VALIDATION 
    if ($("#register-form").length) {
      $("#register-form").validate({
        submitHandler: function (form) {
          let user = Object.fromEntries(new FormData(form).entries());
          UserService.register(user);
        }
      });
    }

  },

  login: function (entity) {
    $.ajax({
      url: Constants.PROJECT_BASE_URL + "auth/login",
      type: "POST",
      data: JSON.stringify(entity),
      contentType: "application/json",
      dataType: "json",
      success: function (result) {
        localStorage.setItem("user_token", result.data.token);
        window.location.replace("index.html");
      },
      error: function (xhr) {
        toastr.error(xhr.responseText || "Login failed");
      }
    });
  },

  register: function (user) {
     console.log("REGISTER PAYLOAD:", user);
    $.ajax({
      url: Constants.PROJECT_BASE_URL + "auth/register",
      type: "POST",
      data: JSON.stringify(user),
      contentType: "application/json",
      success: function () {
        toastr.success("Registration successful");
        $("#register-form")[0].reset();
        window.location.hash = "#login";
      },
      error: function (xhr) {
        toastr.error(xhr.responseText || "Registration failed");
      }
    });
  },

  logout: function () {
    localStorage.clear();
    window.location.replace("login.html");
  }
};
