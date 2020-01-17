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
    $posts[] = $Users->getPostAndUser2($postsRow['followedid']);
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

if (isset($_SESSION['friendid'])) {
    $_POST['friendid'] = $_SESSION['friendid'];
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
            <a class="navbar-brand" href="homepage.php">HOME</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="addpost.php">Add Post <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="follows.php">Follows</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="edit.php">Edit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="logout.php">logout</a>
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
        <h1 class="username"><?php echo $user['username'] ?></h1>
        

        <div class="row">
            <div class="col-6">
                <!-- post start -->
                <?php foreach ($posts as $postsRow) : ?>
                    <?php foreach ($postsRow as $row) : ?>
                        <?php
                        $nice = $Users->getNice($row['postid']);
                        $niceAmount = 0;
                        $myNice = 0;
                        foreach ($nice as $niceRow) {
                            $niceAmount++;
                            if ($niceRow['userid'] == $id) {
                                $myNice++;
                            }
                        }
                        $share = $Users->getPostShare($row['postid']);
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
                                                        <a href=""><img class="img-fluid rounded-circle" src="uploads/<?php echo $row['picture'] ?>" alt="User"></a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h3 class="m-0"><?php echo $row['title'] ?></h3>
                                                    </div>
                                                </div>
                                                <!--/ media -->
                                            </div>
                                            <!--/ cardbox-heading -->

                                            <div class="cardbox-item">
                                                <img class="img-fluid" src="uploads/<?php echo $row['postPicture']; ?>" alt="Image">
                                            </div>
                                            <!--/ cardbox-item -->
                                            <form action="action.php" method="post" class="cardbox-base">
                                                <!-- postid and id send -->
                                                <input type='hidden' name='postid' value='<?php echo $row['postid'] ?>'>
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
                                                            if ($myShare == 0) {
                                                                echo "<button class='btn p-0' type='submit' name='shareSubmit'><i class='far fa-share-square''>$shareAmount</i></button>";
                                                            } else {
                                                                echo "<button class='btn p-0' type='submit' name='unShareSubmit'><i class='fas fa-share-square'>$shareAmount</i></button>";
                                                            }
                                                            ?>
                                                        </a></li>

                                                </ul>
                                                <ul>
                                                    <li><a><i class="fa fa-thumbs-up"></i></a></li>
                                                    <?php
                                                    foreach ($nice as $niceRow) {
                                                        $niceFriend = $Users->getuser($niceRow['userid']);
                                                        echo "<li><a href='#'><img src='uploads/" . $niceFriend['picture'] . "' class='img-fluid rounded-circle' alt='User'></a></li>";
                                                    }
                                                    ?>

                                                    <li><a><span><?php echo $niceAmount ?> Likes</span></a></li>
                                                </ul>
                                            </form>
                                            <!--/ cardbox-base -->
                                            <div class="cardbox-comments">
                                                <span class="comment-avatar float-left">
                                                    <a href=""><img class="rounded-circle" src="uploads/<?php echo $user['picture']; ?>" alt="..."></a>
                                                </span>
                                                <div class="search">
                                                    <input placeholder="Write a comment" type="text">
                                                    <button><i class="fa fa-camera"></i></button>
                                                </div>
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
                <?php endforeach; ?>
            </div>
            <!-- ここからチャット -->

            <div class="col-6 mt-5">
                <?php
                foreach ($friends as $friendsRow) {
                    //未読の取得
                    $notYetSentence = $Users->getNorYetSentence($friendsRow['userid'], $id);
                    $latestSentence = $Users->latestSentence($friendsRow['userid'], $id);
                    $sentenceCount = 0;
                    foreach ($notYetSentence as $notYetSentenceKey => $notYetSentenceRow) {
                        $sentenceCount++;
                    }
                    //時間の計算
                    $userLoginTime = $Users->getUsersLoginTime($id);
                    $friendLoginTime = $Users->getUsersLoginTime($friendsRow['userid']);

                    $userTime = $userLoginTime['time'];
                    $friendTime = $friendLoginTime['time'];

                    $timeStamp1 = strtotime($userTime);
                    $timeStamp2 = strtotime($friendTime);

                    $time = $timeStamp1 - $timeStamp2;

                    echo "  <div class='row'>
                                    <form class='col-12 alert alert-secondary mb-3' method='post'>
                                    <input type='hidden' name='friendid' value='" . $friendsRow['userid'] . "'>
                                    <div href='' class='pull-left mr-2'>
                                        <a href='#'  class='d-block'><img src='uploads/" . $friendsRow['picture'] . "' class='media-object dp img-circle' style='width: 100px;height:100px;'></a>
                                        <a href='homepageChat.php?id=".$friendsRow['userid']."' class='btn btn-secondary'>chat</a>
                                    </div>
                                    <div class='pull-right number_notyet mr-2'><h1>$sentenceCount</h1></div>
                                    <h1>" . $friendsRow['username'] . "</h1>
                                    <p>" . $latestSentence['sentence'] . "</p>
                                    <h3>";
                    //時間の計算
                    if ($time > 60 * 60 * 24) {
                        echo "over 1 day</h3>";
                    } elseif ($time > 60 * 60) {
                        $hTime = $time / 3600;
                        $mTime = $time % 3600 / 60;
                        $sTime = $time % 3600 % 60;
                        echo "before " . floor($hTime) . "h" . floor($mTime) . "m" . floor($sTime) . "s</h3>";
                    } elseif ($time > 60) {
                        $mTime = $time / 60;
                        $stime = $time % 60;
                        echo "before " . floor($mTime) . "m" . floor($sTime) . "s</h3>";
                    } else {
                        echo "before " . $time . "s</h3>";
                    }

                    echo  "</h3>
                                </form>
                                </div>";
                }
                ?>





            </div>
</body>