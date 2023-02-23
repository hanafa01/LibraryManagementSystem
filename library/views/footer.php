<section class="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <span class="text-muted">&copy; Hana Fakhouri <?php echo date('Y'); ?></span>
      </div>
    </div>
  </div>
</section>



<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
// 1 for user and 0 for Librarian
$("#toggleLogin").click(function(){
  if($("#loginActive").val() == 1){
    $("#loginActive").val("0");
    $("#loginInTitle").html("Admin Login");
    $("#registerLink").hide();
    $("#forgotPasswordLink").hide();
    $("#toggleLogin").html(" User");
    $("#email").val("");
    $("#password").val("");
    $("#loginAlert").hide();
  }else{
    $("#loginActive").val("1");
    $("#loginInTitle").html("User Login");
    $("#registerLink").show();
    $("#forgotPasswordLink").show();
    $("#toggleLogin").html("Admin");
    $("#email").val("");
    $("#password").val("");
    $("#loginAlert").hide();
  }
});

$("#loginForUsersAndLibButton").click(function(){
  $.ajax({
    type: "POST",
    url: "actions.php?action=logInUserLibrarian",
    data: "email=" + $("#email").val() + "&password=" + $("#password").val() + "&loginActive=" + $("#loginActive").val(),
    success: function(data){
      if(data == 1){
        $("#loginAlert").hide();
        window.location.assign("admin/dashboard.php");
      }else if(data==2){
        $("#loginAlert").hide();
        window.location.assign("dashboard.php");
      }else{
        $("#loginAlert").html(data).show();
      }
    }
  });
});

</script>

</body>
</html>
