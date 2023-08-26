<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home page</title>.
    <link rel="stylesheet" type = "text/css" href="style.css">
    <style>

    .container{
      background: #F5F5DC;
      justify-content: space-between;
      display: flex;
      text-align:inherit;
      cursor: pointer;

    }
    .Box1{
      flex: 1;
      padding: 30px;
      position: relative;
      display: inline;
    }
    .Box1_content{
      position: absolute;
      top:30px;
      right: 0px;

      background-color: #F0FFFF;
      text-align: left;
      min-width: 30%;
      display: none;
    }
    .Box1_content a{
        display:inline-table;
    }
    .Box1:hover .Box1_content{

      display:grid;
    }
    .Box2{
      flex: 1;
      padding: 30px;
      position: relative;
      display: inline;
    }
    .Box2_content{
      position: absolute;
      top:30px;
      right: 0px;

      background-color: #F0FFFF;
      text-align: left;
      min-width: 30%;
      display: none;
    }
    .Box2_content a{
        display:inline-table;
    }
    .Box2:hover .Box2_content{

      display:grid;
    }
    .Box3{
      flex: 1;
      padding: 30px;
      position: relative;
      display: inline;
    }
    .Box3_content{
      position: absolute;
      top:30px;
      right: 0px;

      background-color: #F0FFFF;
      text-align: left;
      min-width: 30%;
      display: none;
    }
    .Box3_content a{
        display:inline-table;
    }
    .Box3:hover .Box3_content{

      display:grid;
    }
    .Box4{
      flex: 1;
      padding: 30px;
      position: relative;
      display: inline;
    }
    .Box4_content{
      position: absolute;
      top:30px;
      right: 0px;

      background-color: #F0FFFF;
      text-align: left;
      min-width: 30%;
      display: none;
    }
    .Box4_content a{
        display:inline-table;
    }
    .Box4:hover .Box4_content{

      display:grid;
    }
    </style>
    <div class="Top">
      <h2 >Welcome to home page</h2>
    </div>
  </head>
  <body>


      <div class="container">
        <div class="Box1">
          <a href="">Student</a>
          <div class="Box1_content">
            <a href="login.php">Login</a>
            <a href="student_registration.php">Registration</a>
          </div>
      </div>

        <div class="Box2">
          <a href="">Hospital</a>
          <div class="Box2_content">
            <a href="login.php">Login</a>
            <a href="Hospital_reg.php">Registration</a>
          </div>
        </div>
        <div class="Box3">
          <a href="">University</a>
          <div class="Box3_content">
            <a href="login.php">Login</a>
            <a href="University_reg.php">Registration</a>
          </div>
        </div>
        <div class="Box4">
          <a href="">Admin</a>
          <div class="Box4_content">
            <a href="login.php">Login</a>
          </div>
        </div>

    </div>
  </body>
</html>
