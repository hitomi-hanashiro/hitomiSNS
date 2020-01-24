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

$followed = $Users->getfollowers($id);
foreach ($followed as $followedRow) {
    foreach ($followsid as $followRow) {
        if ($followedRow['userid'] == $followRow['followedid'] and $followedRow['userid'] !== $id) {
            $friends[] = $Users->getUser($followRow['followedid']);
        }
    }
}

$latestGroup = $Users->getLatestGroupChats();
$groupid = $latestGroup['groupid'];
$groupid = $groupid + 1;

?>

<head>
    <meta charset="UTF-8">
    <title>homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/homepage.css">
    <link rel="stylesheet" href="styles/homepageChat.css">
    <link rel="stylesheet" href="styles/homepageChatfriend.css">
    <link rel="stylesheet" href="styles/search.css">
    <link rel="stylesheet" href="styles/makeGroup.css">
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
                <a href='profile.php?id=<?php echo $id ?>'>
                    <div class="image_inner_container">
                        <img src='uploads/<?php echo $user['picture'] ?>'>
                    </div>
                </a>
            </div>
        </div>
        <h1 class="username mb-5"><?php echo $user['username'] ?></h1>

        <!-- ここからグループ作るやつ -->
        <div class="row">
            <div class="col-8 mx-auto mb-5 edit">
                <div class="card">
                    <div class="card-header">
                        <h1>Add Post</h1>
                    </div>
                    <div class="card-body">
                        <form action="action.php" method="post" enctype="multipart/form-data">
                            <label for="">Group Name</label>
                            <input type="text" class="form-control mb-3" name="groupChatName">
                            <label for="">picture</label>
                            <input type="file" class="form-control mb-5" name="image">
                            <input type="hidden" name="myid" value='<?php echo $id?>'>
                            <input type="hidden" name="groupid" value='<?php echo $groupid?>'>
                            
                            <div class='row mb-4'>
                                <?php
                                    foreach($friends as $friendsRow){
                                        echo "
                                                <div class='col-2 boxes p-2 ml-5'>
                                                    <div class='clearfix'>
                                                    <img src='uploads/".$friendsRow['picture']."' class='pull-left friend_image d-block'>
                                                    </div>
                                                    <div class='clearfix'>
                                                    <input type='checkbox' name='usersid[]' id='box-".$friendsRow['userid']."' value='".$friendsRow['userid']."'>
                                                    <label for='box-".$friendsRow['userid']."'>".$friendsRow['username']."</label>
                                                    </div>
                                                </div>";
                                    }
                                ?>
                            </div>
                            
                            <button type="submit" class="btn btn-outline-primary form-control" name="makeGroupChat">Add!!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </div>

</body>