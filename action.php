<?php
include 'classes/Users.php';

$Users = new Users;

if(isset($_POST['legister'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $picture = $_FILES['image']['name'];
    $privacy = $_POST['privacy'];

    $users = $Users->getAllUser();
    $point = 0;
    foreach($users as $key => $row){
        if($username == $row['username']){
            $point ++;
        }elseif($password == $row['password']){
            $point ++;
        }
    }

    if($point == 0){
        $userid = $Users->addUser($username,$password,$picture,$privacy);
        $Users->addFollow($userid,$userid);
        $Users->addAllow($userid,$userid);
        header('location:login.php');
    }else{
        echo "Alredy this name or password is used";
    }

    
}elseif(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = $Users->login($username,$password);
    $deleteTime = $Users->deleteLoginTime($user['userid']);
    $loginTime = $Users->addLoginTime($user['userid']);
    if($user == false){
        if($loginTime == false){
            echo "login and getTime wrong";
        }else{
            echo "<div class='alert alert-warning'>Who are you</div>";
        }     
    }else{
        if($loginTime == false){
            echo "getTime wrong";
        }else{
            $_SESSION['userid'] = $user['userid'];
            header('location:homepage.php');
        }
    }   
}elseif(isset($_POST['addPost'])){
    $title = $_POST['title'];
    $vio = $_POST['vio'];
    $picture = $_FILES['image']['name'];
    $userid = $_POST['id'];

    $post = $Users->addPost($title,$vio,$picture,$userid);
    echo $post;
    $addPost = $Users->addShare($post,$userid);

    if($addPost == true){
        header('location:homepage.php');
    }else{
        echo "youcantadd";
    }
}elseif(isset($_POST['editUser'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $picture = $_FILES['image']['name'];
    $userid = $_POST['id'];

    $Users->editUser($username,$password,$picture,$userid);

}elseif(isset($_POST['deleteUser'])){
    $userid = $_POST['id'];
    $Users->deleteTable($userid);

}elseif(isset($_POST['search'])){
    $keyword = $_POST['keyword'];
    header("location:search.php?keyword=$keyword");

}elseif(isset($_POST['follow'])){
    $userid = $_POST['userid'];
    $followedid = $_POST['followedid'];
    $keyword = $_POST['keyword'];
    $result = $Users->addFollow($userid,$followedid);
    if($result == true){
        header("location:search.php?keyword=$keyword");
    }

}elseif(isset($_POST['deleteFolow'])){
    $id = $_POST['followid'];
    $followedid = $_POST['followerid'];
    $Users->deleteFollow($id,$followedid);

}elseif(isset($_POST['deleteFolower'])){
    $id = $_POST['followid'];
    $followedid = $_POST['followerid'];
    $Users->deleteFollow($id,$followedid);

}elseif(isset($_POST['submitSentence'])){
    $sentence = $_POST['sentence'];
    $sendid = $_POST['sendid'];
    $receiveid = $_POST['receiveid'];
    echo $receiveid,$sentence,$sendid;
    $result = $Users->addChat($sentence,$sendid,$receiveid);
   
    if($result == true){
        
        header("location:homepageChat.php?id=$receiveid");
    }

}elseif(isset($_POST['submitComment'])){
    $userid = $_POST['userid'];
    $comment = $_POST['comment'];
    $postid = $_POST['postid'];
    $Users->addPostComment($userid,$comment,$postid);

}elseif(isset($_POST['niceSubmit'])){
    $postid = $_POST['postid'];
    $userid = $_POST['userid'];
    $result = $Users->addNice($postid,$userid);
    if($result == true){
        header("location:homepage.php");
    }

}elseif(isset($_POST['unNiceSubmit'])){
    $postid = $_POST['postid'];
    $userid = $_POST['userid'];
    $profileid = $_POST['profileid'];
    $result = $Users->deleteNice($postid,$userid);
    if($result == true){
        header("location:homepage.php");
    }

}elseif(isset($_POST['niceSubmitProfile'])){
    $postid = $_POST['postid'];
    $userid = $_POST['userid'];
    $profileid = $_POST['profileid'];
    $result = $Users->addNice($postid,$userid);
    if($result == true){
        header("location:profile.php?id=$profileid");
    }

}elseif(isset($_POST['unNiceSubmitProfile'])){
    $postid = $_POST['postid'];
    $userid = $_POST['userid'];
    $profileid = $_POST['profileid'];
    $result = $Users->deleteNice($postid,$userid);
    if($result == true){
        header("location:profile.php?id=$profileid");
    }

}elseif(isset($_POST['allow'])){
    $userid = $_POST['userid'];
    $allowUserid = $_POST['allowUserid'];
    $result = $Users->addAllow($userid,$allowUserid);
    if($result == true){
        header("location:check.php");
    }

}elseif(isset($_POST['shareSubmit'])){
    $postid = $_POST['postid'];
    $userid = $_POST['userid'];
    $result = $Users->addShare($postid,$userid);
    if($result == true){
        header("location:homepage.php");
    }

}elseif(isset($_POST['unShareSubmit'])){
    $postid = $_POST['postid'];
    $userid = $_POST['userid'];
    $result = $Users->deleteShere($postid,$userid);
    if($result == true){
        header("location:homepage.php");
    }

}elseif(isset($_POST['shareSubmitProfile'])){
    $postid = $_POST['postid'];
    $userid = $_POST['userid'];
    $profileid = $_POST['profileid'];
    $result = $Users->addShare($postid,$userid);
    if($result == true){
        header("location:profile.php?id=$profileid");
    }

}elseif(isset($_POST['unShareSubmitProfile'])){
    $postid = $_POST['postid'];
    $userid = $_POST['userid'];
    $profileid = $_POST['profileid'];
    $result = $Users->deleteShere($postid,$userid);
    if($result == true){
        header("location:profile.php?id=$profileid");
    }
    
}elseif(isset($_POST['makeGroupChat'])){
    $usersid = $_POST['usersid'];
    $myid = $_POST['myid'];
    $groupid = $_POST['groupid'];
    $groupChatName = $_POST['groupChatName'];
    $usersid[] = $myid;
    $picture = $_FILES['image']['name'];
    foreach($usersid as $usersidRow){
        $Users->addGroupChat($groupChatName,$usersidRow,$picture,$groupid);
    }

    header('location:groupChat.php');
    
}elseif(isset($_POST['submitGroupChatSentence'])){
    $groupid = $_POST['groupid'];
    $userid = $_POST['userid'];
    $groupChatSentence = $_POST['sentence'];
    $Users->addGroupChatSentence($groupid,$userid,$groupChatSentence);
}elseif(isset($_POST['deleteGroupChat'])){
    $groupid = $_POST['groupid'];
    $userid = $_POST['userid'];
    $Users->deleteGroupChat($userid,$groupid);
}elseif(isset($_POST['inviteFriends'])){
    $groupid = $_POST['groupid'];
    $userid = $_POST['usersid'];
    $picture = $_POST['picture'];
    $groupChatName = $_POST['groupChatName'];
    foreach($userid as $usersRow){
        $return = $Users->addGroupChat2($groupChatName,$usersRow,$picture,$groupid);
    }

    if($return == true){
        header('location:groupChat.php');
    }else{
        echo "youcantadd";
    }
}
?>