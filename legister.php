<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!Doctype html>
<html>
<head>
     <meta charset="UTF-8">
     <title>Registration Form</title>
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" href="styles/legister.css">
</head>
<body>
 <div class="container">
 <!---heading---->
     <header class="heading"> Registration-Form</header><hr></hr>
	<!---Form starting----> 
	<form action="action.php" method="post" enctype="multipart/form-data" class="row">
	 <!--- For Name---->
         <div class="col-sm-12">
             <div class="row">
			     <div class="col-xs-4">
          	         <label class="firstname">User Name :</label> </div>
		         <div class="col-xs-8">
		             <input type="text" name="username" id="fname" placeholder="Enter your User" class="form-control ">
             </div>
		      </div>
		 </div>
		 
	 <!-----For Password and confirm password---->
          <div class="col-sm-12">
		         <div class="row">
				     <div class="col-xs-4">
		 	              <label class="pass">Password :</label></div>
				  <div class="col-xs-8">
			             <input type="password" name="password" id="password" placeholder="Enter your Password" class="form-control">
				 </div>
          </div>
		  </div>
	
	<!-----For email---->
			<div class="col-sm-12">
					<div class="row">
						<div class="col-xs-4">
							<label class="pass">Email :</label></div>
					<div class="col-xs-8">
							<input type="email" name="email" id="email" placeholder="Enter your Email" class="form-control">
					</div>
			</div>
			</div>
          
     <!-----For Picture and confirm---->
            <div class="col-sm-12">
		         <div class="row">
				     <div class="col-xs-4">
		 	              <label class="pass">Picture :</label></div>
				  <div class="col-xs-8">
			             <input type="file" name="image" id="picture" class="form-control">
				 </div>
            </div>
            </div>
		  
     <!-----------For Phone number-------->
         <div class="col-sm-12">
		     <div class ="row">
                 <div class="col-xs-4 ">
			       <label class="gender">Privacy:</label>
				 </div>
			 
			     <div class="col-xs-4 male">	 
				     <input type="radio" name="privacy"  id="gender" value="lock"> Lock</input>
				 </div>
				 
				 <div class="col-xs-4 female">
				     <input type="radio"  name="privacy" id="gender" value="unlock" > Unlock</input>
			     </div>
			
		  	 </div>
		     <div class="col-sm-12">
		         <button name="legister" class="btn btn-warning" type="submit">Submit</button>
            </div>
                <a href="login.php" class="btn btn-primary float-left login">Go Login Page</a>
		 </div>
	</form>	 
		 		 
		 
</div>

</body>		
</html>
	 
	 