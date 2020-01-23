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
    // フォローしている仲間の情報ゲット
    $lockUser = $Users->getUser($postsRow['followedid']);
    // もしプライベートアカウントなら
    if($lockUser['privacy'] == 'lock'){
        //許可しているユーザーゲット
        $allow = $Users->getAllow($postsRow['followedid']);
        foreach($allow as $allowRow){
            //もし許されているのなら
            if($allowRow['allowUserid'] == $id){
                //そのユーザーのシェア全て取得
                $share = $Users->getShare($postsRow['followedid']);
                foreach($share as $shareRow){
                    $postCount = 0;
                    foreach($posts as $postsRow){
                        //もしすでにポストの中にあったら
                        if($postsRow['postid'] == $shareRow['postid']){
                            $postCount++;
                        }
                    }
                    //まだポストになかったら(カウントがゼロなら)
                    if($postCount == 0){
                        $posts[] = $Users->getPostAndUser($shareRow['postid']);
                    }
                
                }
            }
        }
    }else{
        $share = $Users->getShare($postsRow['followedid']);
        foreach($share as $shareRow){
            $postCount = 0;
            foreach($posts as $postsRow){
                //もしすでにポストの中にあったら
                if($postsRow['postid'] == $shareRow['postid']){
                    $postCount++;
                }
            }
            if($postCount == 0){
                $posts[] = $Users->getPostAndUser($shareRow['postid']);
            }
        }
    }
}
//　チャットのファンクション

$follow = $Users->getOrderedChat($id);
foreach($follow as $followRow){
    $count = 0;
    foreach($friends as $friendsRow){
        if($friendsRow['userid'] == $followRow['receiveid'] OR $friendsRow['userid'] == $followRow['sendid']){
            $count = 1;
        }
    }
    if($count == 0){
        if($followRow['sendid'] == $id){
            $friends[] = $Users->getUser($followRow['receiveid']);
        }else{
            $friends[] = $Users->getUser($followRow['sendid']);
        }
    }
}


if (isset($_SESSION['friendid'])) {
    $_POST['friendid'] = $_SESSION['friendid'];
}

$groupChat = $Users->getGroupChats($id);



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
                                                    <img src='uploads/" . $commentRow['picture'] . "'  class='pull-left comment_image'>
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

            <div class="col-6" style='margin-top: 100px;'>
                <?php
                // フレンドチャット
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

                    echo " <div class='row'>
                                    <form class='col-12 alert alert-light mb-3' method='post'>
                                    <input type='hidden' name='friendid' value='" . $friendsRow['userid'] . "'>
                                    <div class='pull-left mr-2'>
                                        <a href='profile.php?id=".$friendsRow['userid']."'  class='d-block'><img src='uploads/" . $friendsRow['picture'] . "' class='media-object dp img-circle' style='width: 100px;height:100px;'></a>
                                        <a href='homepageChat.php?id=".$friendsRow['userid']."'><i class='fas fa-comment fa-2x chat_icon'></i></a>
                                    </div>
                                    <div class='pull-right number_notyet mr-2'><h1>$sentenceCount</h1></div>
                                    <h1>" . $friendsRow['username'] . "</h1>
                                    <p ";
                                    if($latestSentence['chatCheck'] == 'notcheck' AND $latestSentence['receiveid'] == $id){
                                        echo "style='font-weight:bold; font-size: 20px;'";
                                    }
                    echo            ">" . $latestSentence['sentence'] . "</p>
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

                // グループチャット
                foreach($groupChat as $groupChatKey => $groupChatRow){
                    // 最新のセンテンス
                    $latestGroupChatSentence = $Users->latestGroupChatSentence($groupChatRow['groupid']);
                    //未読のカウント
                    $notYetCount = 0;
                    //そのグループのセンテンス全て取得
                    $sentence = $Users->getGroupChatSentence($groupChatRow['groupid']);
                    foreach($sentence as  $sectencdKey =>  $sentenceRow){
                      //送り主が自分以外の時
                      if($sentenceRow['userid'] !==  $id){
                        //既読済みのセンテンス取得
                        $alreadySentence = $Users->getCheckGroupChatSentence($id,$sentenceRow['groupChatSentenceid']);
                        //既読済みでない時
                        if($sentenceRow['groupChatSentenceid'] !== $alreadySentence['groupChatSentenceid']){
                          $notYetCount++;
                        }
                      }
                    }
                    echo " <div class='row'>
                            <form class='col-12 alert alert-success mb-3' method='post'>
                            <div class='pull-left mr-2'>
                                <a href='groupProfile.php?id=".$groupChatRow['groupid']."'  class='d-block'><img src='uploads/" . $groupChatRow['groupChatPicture'] . "' class='media-object dp img-circle' style='width: 100px;height:100px;'></a>
                                <a href='homepageGroupChat.php?id=".$groupChatRow['groupid']."' class='btn btn-secondary'>chat</a>
                                <input type='hidden' name='userid' value='$id'>
                                <input type='hidden' name='groupid' value='".$groupChatRow['groupid']."'>
                                <button class='btn btn-outline-danger' type='submit' name='deleteGroupChat'>delete</button>
                            </div>
                            <div class='pull-right number_notyet mr-2'><h1>$notYetCount</h1></div>
                            <h1>" . $groupChatRow['groupChatName'] . "</h1>
                            <p>" . $latestGroupChatSentence['groupChatSentence'] . "</p>
                            </form>
                            </div>";
                }
            
                ?>





            </div>
</body>