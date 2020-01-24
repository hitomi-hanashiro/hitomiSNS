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

$follower = $Users->getfollowers($id);
$follow = $Users->getfollows($id);

foreach ($follow as $followRow){
    if ($followRow['userid'] !== $id) {
        $follows[] = $followRow;
    }
}

$allowUsers = $Users->getAllow($user['userid']);








?>

<head>
    <meta charset="UTF-8">
    <title>homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/homepage.css">
    <link rel="stylesheet" href="styles/homepageChat.css">
    <link rel="stylesheet" href="styles/homepageChatfriend.css">
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
                        <a class="nav-link text-primary" href="followers.php"><i class="far fa-user">Followers</i></a>
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
                <a href='profile.php?id=<?php echo $id?>'>               
                    <div class="image_inner_container">
                        <img src='uploads/<?php echo $user['picture'] ?>'>
                    </div>
                </a>
            </div>
        </div>
        <h1 class="username"><?php echo $user['username'] ?></h1>

        <!-- ここからuser画面 -->
        <div class='row mt-5'>
            <?php

            foreach ($follower as $key => $row) {
                if($row['userid'] !== $id){
                    $followUser = $Users->getUser($row['userid']);

                    $followCount = 0;
                    foreach($follow as $followRow){
                        if($followRow['followedid'] == $followUser['userid']){
                            $followCount = 1;
                        }
                    }
                    $allowCount = 0;
                    foreach($allowUsers as $allowUsersRow){
                        if($allowUsersRow['allowUserid'] == $followUser['userid']){
                            $allowCount = 1;
                        }
                    }
                    echo "<form class='col-4 mb-3 edit' action='action.php' method='post'>
                                <div class='card text-left user'>
                                    <div class='card-header '>
                                        <div class='d-flex justify-content-center'>
                                            <div class='image_outer_container'>
                                                <div class='image_inner_container'>
                                                    <img src='uploads/" . $followUser['picture'] . "'>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='card-body'>
                                        <h4 class='card-title'>" . $followUser['username'] . "</h4>";

                                        if($followCount ==  0){
                                            echo "<button class='btn btn-outline-primary w-25 mr-1' type='submit' name='followFollower'>follow</button>";
                                        }
                        
                    echo                "<a href='profile.php?id=" . $followUser['userid'] . "' class='btn btn-outline-warning w-25'>profile</a>
                                        <button class='btn btn-outline-danger w-25' type='submit' name='deleteFolower'>Delete</button>";

                                        if($user['privacy'] == 'lock'){
                                            if($allowCount == 0){
                                                echo "<button class='btn btn-outline-secondary w-100' type='submit' name='allow'>Allow</button>";
                                            }
                                        }
                                        
                    echo                "<input type='hidden' name='userid' value='" . $id . "'>
                                        <input type='hidden' name='followedid' value='" . $followUser['userid'] . "'>
                                    </div>
                                    </div>
                                </form>";
                }
            }
            ?>
        </div>



    </div>
</body>