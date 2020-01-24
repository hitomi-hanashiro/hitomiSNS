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
$friendid = $_GET['id'];
// ポストのファンクション
$follow = $Users->getfollows($id);
foreach ($follow as $followRow) {
    $allow = $Users->getAllow($followRow['followedid']);
    if ($followRow['privacy'] !== 'lock') {
        $follows[] = $followRow;
    } else {
        foreach ($allow as $allowRow) {
            if ($followRow['userid'] == $allowRow) {
                $follows[] = $folowRow;
            }
        }
    }
}

foreach ($follows as $postsRow) {
    $lockUser = $Users->getUser($postsRow['followedid']);
    if($lockUser['privacy'] == 'lock'){
        $allow = $Users->getAllow($postsRow['followedid']);
        foreach($allow as $allowRow){
            if($allowRow['allowUserid'] == $id){
                $share = $Users->getShare($postsRow['followedid']);
                foreach($share as $shareRow){
                $posts[]= $Users->getPostAndUser($shareRow['postid']);
                }
            }
        }
    }else{
        $share = $Users->getShare($postsRow['followedid']);
        foreach($share as $shareRow){
        $posts[] = $Users->getPostAndUser($shareRow['postid']);
        }
    }
    
}

//　チャットのファンクション
$followed = $Users->getfollowers($id);
foreach ($followed as $followedRow) {
    foreach ($follow as $followRow) {
        if ($followedRow['userid'] == $followRow['followedid'] and $followedRow['userid'] !== $id) {
            $friends[] = $Users->getUser($followRow['followedid']);
        }
    }
}




?>

<head>
    <meta charset="UTF-8">
    <title>homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/homepage.css">
    <link rel="stylesheet" href="styles/homepageChat.css">
    <link rel="stylesheet" href="styles/homepageChatfriend.css">
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

        <!-- ここからポスト -->
        <div class="row">
            <div class="col-6">
                <!-- post start -->
                <?php foreach ($posts as $postsRow) : ?>
                        <?php
                        $nice = $Users->getNice($postsRow['postid']);
                        $niceAmount = 0;
                        $myNice = 0;
                        foreach ($nice as $niceRow) {
                            $niceAmount++;
                            if ($niceRow['userid'] == $id) {
                                $myNice++;
                            }
                        }
                        $share = $Users->getPostShare($postsRow['postid']);
                        $shareAmount = 0;
                        $myShare = 0;
                        foreach ($share as $niceRow) {
                            $shareAmount++;
                            if ($niceRow['userid'] == $id) {
                                $myShare++;
                            }
                        }
                        $shareAmount--;
                        ?>
                        <section class="hero">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="cardbox shadow-lg bg-white">
                                            <div class="cardbox-heading">
                                                <div class="media m-0">
                                                    <div class="d-flex mr-3">
                                                        <a href="profile.php?id=<?php echo $postsRow['userid']?>"><img class="img-fluid rounded-circle" src="uploads/<?php echo $postsRow['picture'] ?>" alt="User"></a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h3 class="m-0"><?php echo $postsRow['title'] ?></h3>
                                                    </div>
                                                </div>
                                                <!--/ media -->
                                            </div>
                                            <!--/ cardbox-heading -->

                                            <div class="cardbox-item">
                                                <img class="img-fluid" src="uploads/<?php echo $postsRow['postPicture']; ?>" alt="Image">
                                            </div>
                                            <!--/ cardbox-item -->
                                            <form action="action.php" method="post" class="cardbox-base">
                                                <p class="p-3"><?php echo $postsRow['vio'] ?></p>
                                                <!-- postid and id send -->
                                                <input type='hidden' name='postid' value='<?php echo $postsRow['postid'] ?>'>
                                                <input type='hidden' name='userid' value='<?php echo $id ?>'>
                                                <ul class="float-right">
                                                    <li><a>
                                                            <?php
                                                            if ($myNice == 0) {
                                                                echo "<button class='btn p-0' type='submit' name='niceSubmit'><i class='far fa-heart'>$niceAmount</i></button>";
                                                            } else {
                                                                echo "<button class='btn p-0' type='submit' name='unNiceSubmit'><i class='fas fa-heart'>$niceAmount</i></button>";
                                                            }
                                                            ?>
                                                        </a></li>

                                                    <li><a>
                                                            <?php
                                                            if($id !== $postsRow['userid']){
                                                                if ($myShare == 0) {
                                                                    echo "<button class='btn p-0' type='submit' name='shareSubmit'><i class='far fa-share-square''>$shareAmount</i></button>";
                                                                } else {
                                                                    echo "<button class='btn p-0' type='submit' name='unShareSubmit'><i class='fas fa-share-square'>$shareAmount</i></button>";
                                                                }
                                                            }
                                                            ?>
                                                        </a></li>

                                                </ul>
                                                <ul>
                                                    <li><a><i class="fa fa-thumbs-up"></i></a></li>
                                                    <?php
                                                    foreach ($nice as $niceRow) {
                                                        $niceFriend = $Users->getuser($niceRow['userid']);
                                                        echo "<li><a href='profile.php?id=" . $niceFriend['userid'] . "'><img src='uploads/" . $niceFriend['picture'] . "' class='img-fluid rounded-circle' alt='User'></a></li>";
                                                    }
                                                    ?>

                                                    <li><a><span><?php echo $niceAmount ?> Likes</span></a></li>
                                                </ul>
                                            </form>
                                            <?php
                                            $comment = $Users->getComment($postsRow['postid']);
                                            foreach ($comment as $commentRow) {
                                                echo "<div class='comments'>
                                                        <a href='profile.php?id=".$commentRow['userid']."'><img src='uploads/" . $commentRow['picture'] . "'  class='pull-left comment_image'></a>
                                                        <p class='comment_post'>" . $commentRow['comment'] . "</p>
                                                </div>";
                                            }
                                            ?>

                                            <!--/ cardbox-base -->
                                            <div class="cardbox-comments">
                                                <span class="comment-avatar float-left">
                                                    <a href="profile.php?id=<?php echo $id?>"><img class="rounded-circle" src="uploads/<?php echo $user['picture']; ?>" alt="..."></a>
                                                </span>
                                                <form class="search" method='post' action="action.php">
                                                    <input type="hidden" name="postid" value="<?php echo $postsRow['postid'] ?>">
                                                    <input type="hidden" name="userid" value="<?php echo $id ?>">
                                                    <input type="hidden" name="friendid" value="<?php echo $friendid ?>">
                                                    <input placeholder="Write a comment" type="text" name="comment">
                                                    <button type="submit" name='submitCommentChat'><i class="fa fa-paper-plane"></i></button>
                                                </form>
                                                <!--/. Search -->
                                            </div>
                                            <!--/ cardbox-like -->

                                        </div>
                                        <!--/ cardbox -->
                                    </div>
                                </div>
                                <!--/ row -->
                            </div>
                            <!--/ container -->
                        </section>
                    <?php endforeach; ?>
            </div>
            <!-- ここからチャット -->

            <div class="col-6 mt-5 side_by_side" style="height: 800px; overflow: scroll;">
                <?php
                $dialog = $Users->getChat($id, $friendid);
                echo "<div class='row rounded-lg overflow-hidden shadow'>
                                <div class='col-12 px-0'>
                                <div class='bg-white'>";
                foreach ($dialog as $dialogRow) {
                    $user = $Users->getUser($dialogRow['sendid']);
                    if ($dialogRow['sendid'] == $id) {
                        echo "<div class='media w-50 ml-auto mb-3'>
                                        <div class='media-body'>
                                            <div class='bg-primary rounded py-2 px-3 mb-2'>
                                                <p class='text-small mb-0 text-white'>" . $dialogRow['sentence'] . "</p>
                                            </div>";
                        if ($dialogRow['chatCheck'] == 'check') {
                            echo "<p class='small text-muted'>check</p>";
                        }
                        echo "</div>
                                    </div>";
                    } else {
                        $Users->checkedChat($dialogRow['chatid']);
                        echo "<div class='media w-50 mb-3'><img src='uploads/" . $user['picture'] . "' alt='user' width='50' class='rounded-circle'>
                                        <div class='media-body ml-3'>
                                            <div class='bg-light rounded py-2 px-3 mb-2'>
                                                <p class='text-small mb-0 text-muted'>" . $dialogRow['sentence'] . "</p>
                                            </div>
                                        </div>
                                    </div>";
                    }
                }
                echo "  <form action='action.php' method='post' class='bg-light'>
                                    <div class='input-group'>
                                        <input type='text' name='sentence' placeholder='Type a message' aria-describedby='button-addon2' class='form-control rounded-0 border-0 py-4 bg-light'>
                                        <input type='hidden' name='sendid' value='$id'>
                                        <input type='hidden' name='receiveid' value='$friendid'>
                                        <div class='input-group-append'>
                                            <button id='button-addon2' type='submit' class='btn btn-link' name='submitSentence'> <i class='fa fa-paper-plane' ></i></button>
                                        </div>
                                    </div>
                                </form>
                                </div>
                                </div>  
                                </div>
                                <a class='btn btn-outline-primary' href='homepage.php'>back</button>";
                ?>





            </div>
</body>