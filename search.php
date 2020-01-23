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
                <a href='profile.php?id=<?php echo $id?>'>               
                    <div class="image_inner_container">
                        <img src='uploads/<?php echo $user['picture'] ?>'>
                    </div>
                </a>
            </div>
        </div>
        <h1 class="username"><?php echo $user['username'] ?></h1>

        <?php if(empty($users)):?>
            <?php header("refresh:5;url=homepage.php");?>
            
            <div class="row">
                <div class="col-6">
                    <img src="uploads/flower.gif" alt="">
                </div>
                <div class="col-6" style="margin-top: 200px;">
                    <div class="alert alert-light">
                        <h2>I can't find users sorry</h2>
                        <p>I will go back home after 5seconds</p>
                    </div>
                </div>
            </div>
            

        <?php else:?>
        <div class='row mt-5'>
            <?php

            foreach ($users as $key => $row) {
                $count = 0;
                foreach ($followsid as $keys => $rows) {
                    if ($rows['followedid'] == $row['userid']) {
                        $count++;
                    } elseif ($user['userid'] == $row['userid']) {
                        $count += 2;
                    } else {
                        continue;
                    }
                }
                if ($count == 0) {
                    echo "<form class='col-4 mb-3' action='action.php' method='post'>
                            <div class='card text-left user'>
                                <div class='card-header '>
                                    <div class='d-flex justify-content-center'>
                                        <div class='image_outer_container'>
                                            <div class='image_inner_container'>
                                                <img src='uploads/".$row['picture']."'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='card-body'>
                                    <h4 class='card-title'>".$row['username']."</h4>
                                    <button class='btn btn-outline-primary w-25 mr-3' type='submit' name='follow'>follow</button>
                                    <a href='profile.php?id=".$row['userid']."' class='btn btn-outline-danger w-25'>profile</a>
                                    <input type='hidden' name='followedid' value='".$row['userid']."'>
                                    <input type='hidden' name='keyword' value='".$keyword."'>
                                    <input type='hidden' name='userid' value='".$id."'>
                                </div>
                                </div>
                            </form>";
                } elseif ($count == 1) {
                    echo "<div class='col-4 mb-3 user'>
                            <div class='card text-left'>
                                <div class='card-header '>
                                    <div class='d-flex justify-content-center'>
                                        <div class='image_outer_container'>
                                            <div class='image_inner_container'>
                                                <img src='uploads/".$row['picture']."'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='card-body'>
                                    <h4 class='card-title'>".$row['username']."</h4>
                                    <a href='profile.php?id=".$row['userid']."' class='btn btn-outline-danger w-25'>profile</a>
                                </div>
                            </div>
                        </div>";
                } else {
                    continue;
                }
            }
            ?>
           
        </div>
        <?php endif?>



    </div>

</body>