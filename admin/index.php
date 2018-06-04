<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SGM</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
<script language="javascript">
function validasi(form){
  if (form.username.value == ""){
    alert("Anda belum mengisikan Username.");
    form.username.focus();
    return (false);
  }
     
  if (form.password.value == ""){
    alert("Anda belum mengisikan Password.");
    form.password.focus();
    return (false);
  }
  return (true);
}
</script>
    </head>
<body OnLoad="document.login.username.focus();">
        <div class="container">
			<section class="main">
			<form name="login" action="cek_login.php" method="POST" onSubmit="return validasi(this)" class="form-3">
				    <p class="clearfix">
				        <label for="login">Username</label>
				        <input type="text" name="username" id="login" placeholder="Username">
				    </p>
				    <p class="clearfix">
				        <label for="password">Password</label>
				        <input type="password" name="password" id="password" placeholder="Password"> 
				    </p>
				    <p class="clearfix">
				        <input type="submit" name="submit" value="Masuk">
				    </p>       
				</form>​
			</section>
        </div>
</body>
</html>