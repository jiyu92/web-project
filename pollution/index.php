<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Registration Panel</title>
  <link rel="shortcut icon" href="pol.jpg">
  <link href="style.css" rel="stylesheet" type="text/css">
  <link href="new_styles.css" rel="stylesheet" type="text/css">
  <script src="jquery.js"></script>
  <script src="main.js"></script>
  </head>
  <body>
    <div id="main">
      <!--
      <div id="admin_panel">
        <h1>Enter As Administrator</h1>
        <form method="GET" action="">
          <p>E-mail: <input type="text" name="mail" size="20">
        	<p>Password: <input type="password" name="pass" size="20">
          <input type="submit" name="action" value="Enter as Admin">
        </form>
      </div> -->

      <div id="registration_panel">
        <h1>Registration</h1>
        <form method="GET" action="">
          <p>E-mail: <input type="text" name="mail" size="20">
        	<p>Password: <input type="password" name="pass" size="20">
          <input type="submit" name="action" value="registration">
        </form>
      </div>
      <div id="login_panel">
        <h1>Login</h1>
        <form method="GET" action="">
          <p>E-mail: <input type="text" name="mail" size="20">
        	<p>Password: <input type="password" name="pass" size="20">
          <input type="submit" name="action" value="login">
        </form>
      </div>
    </div>
    <div id="user_logged" style="display: none;">
    </div>
  </body>
</html>
