<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/eb83b1af77.js" crossorigin="anonymous"></script>
<!------ Include the above in your HEAD tag ---------->
<!----- PHP ------>
<?php
include 'action.php';
$id = $_SESSION['userid'];
$user = $Users->getUser($id);
$keyword = $_GET['keyword'];
$users = $Users->getFriends($keyword);
$followsid = $Users->getfollows($id);
?>

<head>
    <meta charset="UTF-8">
    <title>homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/homepage.css">
    <link rel="stylesheet" href="styles/homepageChat.css">
    <link rel="stylesheet" href="styles/homepageChatfriend.css">
    <link rel="stylesheet" href="styles/search.css">
    <link rel="stylesheet" href="styles/edit.css">
    <link href="https://fonts.googleapis.com/css?family=Rokkitt" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


</head>

<!--Coded with love by Mutiullah Samim-->

<body>
    <div class="container">
        <!-- navi bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="homepage.php"><i class="fas fa-home">HOME</i></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="addpost.php"><i class="fas fa-plus-square">AddPost</i><span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="makeGorup.php"><i class="fas fa-users">Group</i><span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="follows.php"><i class="fas fa-user">Follows</i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="followers.php"><i class="far fa-user">Followers</i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="edit.php"><i class="fas fa-user-edit">edit</i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="logout.php"><i class="fas fa-sign-out-alt">logout</i></a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" action="action.php" method="post">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="keyword">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="search">Search</button>
                </form>
            </div>
        </nav>

        <!-- youser icon -->
        <div class="d-flex justify-content-center">
            <div class="image_outer_container">
                <div class="green_icon"></div>
                <div class="image_inner_container">
                    <img src='uploads/<?php echo $user['picture'] ?>'>
                </div>
            </div>
        </div>
        <h1 class="username mb-5"><?php echo $user['username'] ?></h1>

        <!-- ここから編集フォーム -->
        <div class="row">
            <div class="col-8 mx-auto">
                <div class="card edit mb-5">
                    <div class="card-header">
                        <h1>edit</h1>
                    </div>
                    <div class="card-body">
                        <form action="action.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $id?>">
                            <label>User Name:</label>
                            <input type="text" name="username" id="fname" value='<?php echo $user['usename']?>' class="form-control mb-3">
                            <label for="">password</label>
                            <input type="password" name="password" id="password" value='<?php echo $user['password']?>' class="form-control mb-3">
                            <label for="">picture:</label>
                            <input type="file" name="image" id="picture" class="form-control mb-3">
                            <label class="gender">Privacy:</label>
                            <input type="radio" name="privacy"  id="gender" value="lock"> Lock</input>
                            <input type="radio"  name="privacy" id="gender" value="unlock" > Unlock</input>

                            <button name="editUser" class="btn btn-outline-primary text-center d-block w-25 mx-auto" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>