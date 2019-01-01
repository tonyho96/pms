<!DOCTYPE html>
<?php require_once "painttrack/includes/db.php"; ?>
<?php 
 $HomeSettings = HomeSettings::where('id',1)
							->take(1)
							->get();
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
   
    <title>Paint Management System</title>

    <!-- Styles -->

    <link href="/assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">

	
    <!-- Scripts -->
	
	<style>
		body{
			background-image: url("/images/bg.png");  
		}
		.navContainer{
			 position: relative; 
			 text-align: center;
			
		}
		.navbar-nav>li>a{
			color: white;
			position: absolute; 
			top: 2px;
			left: 0px;
			right: 0px;
			overflow: hidden;
			white-space: nowrap;
		}
		ul{
			list-style-type: none;
		}
		.bg2{
		    height: 350px;
			background-image: url("/images/room1.png");
		}
		.description{
			background-image: url("/images/wall-bg.jpg");
			background-repeat: no-repeat;
			background-size: 100% 100%;
			top: -100px;
			color: white;
			padding: 25px 20px;
			line-height: 30px;
		}
		.description i{
			color: white;
		}
		form{
			width: 90%;
			float: right;
		}
		.userName, .password{
			width: 100%;
			margin: 10px 0px;
			background: transparent;
			border: 1px solid #966060;
			color: #966060;
			padding-left: 5px;
			height: 35px;
		}
		::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
			color: #966060;
			opacity: 1; /* Firefox */
		}

		:-ms-input-placeholder { /* Internet Explorer 10-11 */
			color:#966060;
		}

		::-ms-input-placeholder { /* Microsoft Edge */
			color: #966060;
		}
		.submitBtn{
			float:right;
			background-color: red;
			color: white;
		}
		.circle {
			background-color:#fff;
			border:1px solid white;    
			height:80px;
			border-radius:50%;
			-moz-border-radius:50%;
			-webkit-border-radius:50%;
			width:80px;
			text-align: center;
			margin: 20px auto;
		}
		.circle img{
			padding-top: 20px;
		}
		.sologan h2{
			padding-left: 50px;
			padding-top: 30px;
			white-space: nowrap;
			position:absolute;
		}
		.navbar-nav{
			float: right;
		}
		.icon_content{
			text-align: center;
			margin-bottom: 20px;
		}
		@media (max-width: 1120px){
			.navbar-nav {
				float: left;
				margin: 150px auto 0;
				margin-top: 150px;
			}
			.description{
			top: 0px;
			}
		}
		@media (max-width: 768px){
			.description{
			top: 0px;
			}
		}
		.paintsaveImage{
			margin-left: 70px;
			margin-top: 20px;
			
		}
        .register{
            margin-right: 10px;
        }
	</style>
</head>
	
<body>
	<div class="container">
		<div class="header">
			<div class="row">
				<div class="col-sm-4 sologan">
					<img src="images/logo.png">
					<h2><b>Organize your paint projects</br>Like never before!</b></h2>
					
				</div>
				<div class="col-lg-8 row bg2">
					
					
					<nav class="navbar">
						<div class="container-fluid">
							<ul class="navbar-nav">
								<li class="navContainer">
									<img src="images/nav-bg1.png"/>
									<a href="#">Home</a>
								</li>
								<li class="navContainer">
									<img src="images/nav-bg2.png"/>	
									<a href="#">About</a>
								</li>
								<li class="navContainer">
									<img src="images/nav-bg3.png" style="width: 100%"/>
									<a href="#">How it work</a>
								</li>
								<li class="navContainer">
									<img src="images/nav-bg4.png"/>
									<a href="#">Contact</a>
								</li>
								<li class="navContainer">
									<img src="images/nav-bg5.png"/>
									<a href="#">Signup</a>
								</li>
								<li class="navContainer">
									<img src="images/nav-bg7.png"/>
									<a href="#">Buy Products</a>
								</li>
							</ul>
						</div>
					</nav>
				</div>
				
			</div>
		</div>
		
		<div class="row">
			<div class="description col-md-7">
				<h1>Welcome to Paint-Track</h1>
				<p>
					<?php echo $HomeSettings[0]->getAttribute('paragraph_1'); ?>
				</p>
				<div class="row">
					<div class="col-md-3 icon_content">
						<div  class="circle">
							<img src="images/project-icon.png">
						</div>
						<h3>PROJECT</h3>
					</div>
					<div class="col-md-3 icon_content">
						<div  class="circle">
							<img src="images/unit-icon.png">
						</div>
						<h3>UNIT</h3>
					</div>
					<div class="col-md-3 icon_content">
						<div  class="circle">
							<img src="images/room-icon.png">
						</div>
						<h3>ROOM</h3>
					</div>
					<div class="col-md-3 icon_content">
						<div  class="circle">
							<img src="images/item-icon.png">
						</div>
						<h3>ITEM</h3>
					</div>
				</div>
				<h2>Label Printing</h2>
				<p>
					<?php echo $HomeSettings[0]->getAttribute('paragraph_2');?>
				</p>

			</div>
			<div class="col-md-5">
				<form method="post" action="login.php">
					<div>
						<input type="email" placeholder="User Email" class="userName" name="email">
					</div>
					<div>
						<input type="password" placeholder="Password" class="password" name="password">
					</div>
					<div>
						<button type="submit" class="submitBtn btn" name="login_user">Login</button>
					</div>
                    <div>
                        <a href="register.php" class="submitBtn btn register">Register Now</a>
                    </div>
				</form>		
				
				<a href="http://wwww.paint-savers.com"><img class="paintsaveImage" src="/images/img1a.png" alt="http://wwww.paint-savers.com"></a>
			</div>
	
		</div>
	
	</div>

</body>