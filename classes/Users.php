<?php
include 'Database.php';
class Users extends Database{

    public function addPreUser($username,$password,$picture,$key,$email,$token){
        $picture =  $_FILES['image']['name'];
        $target_dir =  'uploads/';
        $target_file = $target_dir.basename($picture);
        $sql = "INSERT INTO pre_user(username,password,picture,privacy,email,token)VALUES('$username','$password','$picture','$key','$email','$token')";
        $result = $this->conn->query($sql);
        $lastID = $this->conn->insert_id;

        if($result == false){
            die('YOU CANT ADD'.$this->conn->connect_error);
        }else{
            move_uploaded_file($_FILES['image']['tmp_name'],$target_file);
            return $lastID;
        }
    }

    public function addPost($title,$vio,$picture,$userid){
        $picture =  $_FILES['image']['name'];
        $target_dir =  'uploads/';
        $target_file = $target_dir.basename($picture);
        $sql = "INSERT INTO post(title,vio,postPicture,userid,postDay)VALUES('$title','$vio','$picture','$userid',NOW())";
        $result = $this->conn->multi_query($sql);
        $lastID = $this->conn->insert_id;
        

        if($result == false){
            die('YOU CANT ADD'.$this->conn->connect_error);
        }else{
            move_uploaded_file($_FILES['image']['tmp_name'],$target_file);
            return $lastID;
        }
    }

    public function addFollow($userid,$followedid){
        $sql = "INSERT INTO follow(userid,followedid)VALUES('$userid','$followedid')";
        $result = $this->conn->query($sql);

        if($result == false){
            die('YOU CANT FOLLOW'.$this->conn->connect_error);
        }else{
            return true;
        }
    }

    public function addChat($sentence,$sendid,$receiveid){
        $sql = "INSERT INTO chat(sentence,sendid,receiveid,sendTime)VALUES('$sentence','$sendid','$receiveid',NOW());
                -- UPDATE latestChat SET latestTime = NOW() WHERE sendid = '$sendid' AND receivedid = '$receiveid'; 
                -- UPDATE latestChat SET latestTime = NOW() WHERE sendid = '$receiveid' AND receivedid = '$sendid'";
                
        $result = $this->conn->query($sql);

        if($result == false){
            die('YOU CANT SEND'.$this->conn->connect_error);
        }else{
            return true;
        }
    }

    public function addPostComment($userid,$sentence,$postid){
        $sql = "INSERT INTO postComment(userid,postid,comment)VALUES('$userid','$postid','$sentence')";
        $result = $this->conn->query($sql);

        if($result == false){
            die('YOU CANT SEND'.$this->conn->connect_error);
        }else{
           return true;
        }   
    }

    public function addNice($postid,$userid){
        $sql = "INSERT INTO nice(postid,userid)VALUES('$postid','$userid')";
        $result = $this->conn->query($sql);

        if($result == false){
            die('YOU CANT SEND'.$this->conn->connect_error);
        }else{
            return true;
        }   
    }

    public function addAllow($userid,$allowUserid){
        $sql = "INSERT INTO allow(userid,allowUserid)VALUES('$userid','$allowUserid')";
        $result = $this->conn->query($sql);

        if($result == false){
            die('YOU CANT SEND'.$this->conn->connect_error);
        }else{
            return true;
        }   
    }

    public function addLoginTime($userid){
        $sql = "INSERT INTO loginTime(userid,time)VALUES('$userid', NOW())";
        $result = $this->conn->query($sql);

        if($result == false){
            return false;
        }else{
            return true;
        }   
    }

    public function addShare($postid,$userid){
        $sql = "INSERT INTO share(userid,postid)VALUES('$userid', '$postid')";
        $result = $this->conn->query($sql);

        if($result == false){
            die('youcantadd'.$this->conn->connect_error);
        }else{
            return true;
        }
    }

    public function addGroupChat($groupChatName,$usersid,$picture,$groupid){    
            $picture =  $_FILES['image']['name'];
            $target_dir =  'uploads/';
            $target_file = $target_dir.basename($picture);
            $sql = "INSERT INTO groupChat(groupChatName,userid,groupChatPicture,groupid)VALUES('$groupChatName','$usersid','$picture','$groupid')";
            $result = $this->conn->query($sql);
    
            if($result == false){
                die('YOU CANT ADD'.$this->conn->connect_error);
            }else{
                move_uploaded_file($_FILES['image']['tmp_name'],$target_file);
            }
    }

    public function addGroupChat2($groupChatName,$usersid,$picture,$groupid){    
        $sql = "INSERT INTO groupChat(groupChatName,userid,groupChatPicture,groupid)VALUES('$groupChatName','$usersid','$picture','$groupid')";
        $result = $this->conn->query($sql);

        if($result == false){
            die('YOU CANT ADD'.$this->conn->connect_error);
        }else{
            return true;
        }
}

    public function addGroupChatSentence($groupid,$userid,$groupChatSentence){
        $sql = "INSERT INTO groupChatSentence(groupid,userid,groupChatSentence,sendTime)VALUES('$groupid','$userid','$groupChatSentence',NOW());
                    UPDATE groupChat SET latestTime = NOW() WHERE groupid = '$groupid'";
        $result = $this->conn->multi_query($sql);

        if($result == false){
            die('YOU CANT SED'.$this->conn->connect_error);
        }else{
            header("location:homepageGroupChat.php?id=$groupid");
        }
    }

    public function addGroupChatSentenceCheck($groupChatSentenceid,$userid,$groupid){
        $sql = "INSERT INTO groupChatSentenceCheck(groupChatSentenceid,userid,groupid)VALUES('$groupChatSentenceid', '$userid','$groupid')";
        $result = $this->conn->query($sql);

        if($result == false){
            die('youcantadd'.$this->conn->connect_error);
        }else{
            return true;
        }
    }



    public function getUserAndLatestTime($friend,$id){
        $sql = "SELECT * FROM latestChat INNER JOIN user ON latestChat.sendid = user.userid WHERE latestChat.sendid = '$friend' AND latestChat.receivedid ='$id' ORDER BY latestTime DESC ";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            return $result->fetch_assoc();
        }else{
            return false;
        }
    }

    public function getUser($id){
        $sql = "SELECT * FROM user WHERE userid = '$id'";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            return $result->fetch_assoc();
        }else{
            return false;
        }
    }

    public function getPreUser($id){
        $sql = "SELECT * FROM pre_user WHERE pre_userid = '$id'";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            return $result->fetch_assoc();
        }else{
            return false;
        }
    }

    public function getAllUser(){
        $sql = "SELECT * FROM user";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $row = array();
            while($rows =  $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return false;
        }
    }

    public function getPost($id){
        $sql = "SELECT * FROM post WHERE userid = '$id'";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $row = array();
            while($rows =  $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return false;
        }
    }

    public function getSpecificPost($id){
        $sql = "SELECT * FROM post WHERE postid = '$id'";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            return $result->fetch_assoc();
        }else{
            return false;
        }
    }

    public function getAllPost(){
        $sql = "SELECT * FROM post";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $row = array();
            while($rows =  $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return false;
        }
    }

    public function getFriends($keyword){
        $sql = "SELECT * FROM user WHERE username LIKE '%$keyword%'";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return false;
        }
    }

    public function getfollows($id){
        $sql = "SELECT * FROM follow WHERE userid = '$id'";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return false;
        }
    }

    public function getfollows2($id){
        $sql = "SELECT * FROM follow INNER JOIN user ON follow.followedid = user.userid WHERE follow.userid = '$id'";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return false;
        }
    }

    public function getfollowers($id){
        $sql = "SELECT * FROM follow WHERE followedid = '$id'";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return false;
        }
    }

    public function getfollowers2($id){
        $sql = "SELECT * FROM follow INNER JOIN user ON follow.userid = user.userid WHERE followedid = '$id'";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return false;
        }
    }

    public function getfollowers3($id){
        $sql = "SELECT * FROM follow INNER JOIN user ON follow.userid = user.userid WHERE follow.followedid = '$id'";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return false;
        }
    }

    public function getChat($userid,$friendid){
        $sql = "SELECT * FROM chat WHERE (sendid = '$userid' AND receiveid = '$friendid') OR  (receiveid = '$userid' AND sendid = '$friendid')";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return false;
        }
    }

    public function getOrderedChat($userid){
        $sql = "SELECT * FROM chat WHERE sendid = '$userid' OR  receiveid = '$userid' ORDER BY sendTime DESC";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return false;
        }
    }

    public function getNotYetChack($userid,$friendid){
        $sql = "SELECT * FROM chat WHERE receiveid = '$userid' AND sendid = '$friendid' AND chatCheck='notcheck'";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return false;
        }
    }

    public function getComment($postid){
        $sql = "SELECT * FROM postComment INNER JOIN user ON postComment.userid = user.userid WHERE postid = '$postid'";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return false;
        }
    }

    public function getNice($postid){
        $sql = "SELECT * FROM nice WHERE postid = '$postid'";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return false;
        }
    }

    public function getAllow($userid){
        $sql = "SELECT * FROM allow WHERE userid = '$userid'";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return false;
        }
    }

    public function getPostAndUser($postid){
        $sql = "SELECT * FROM post INNER JOIN user ON post.userid = user.userid WHERE post.postid = '$postid'";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            return $result->fetch_assoc();
        }else{
            return false;
        }
    }

    public function getPostAndUser2($userid){
        $sql = "SELECT * FROM post INNER JOIN user ON post.userid = user.userid WHERE post.userid = '$userid'";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return false;
        }
    }

    public function getUsersLoginTime($userid){
        $sql = "SELECT * FROM loginTime WHERE userid = '$userid'";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            return $result->fetch_assoc();
        }else{
            return false;
        }
    }

    public function getShare($userid){
        $sql = "SELECT * FROM share WHERE userid = '$userid'";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return false;
        }
    }

    public function getPostShare($postid){
        $sql = "SELECT * FROM share WHERE postid = '$postid'";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return false;
        }
    }

    public function getNorYetSentence($sendid,$receiveid){
        $sql = "SELECT * FROM chat WHERE sendid = '$sendid' AND receiveid = '$receiveid' AND chatCheck = 'notcheck'";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return false;
        }
    }

    public function latestSentence($sendid,$receiveid){
        $sql = "SELECT * FROM chat WHERE (sendid = '$sendid' AND receiveid = '$receiveid') OR (receiveid = '$sendid' AND sendid = '$receiveid') ORDER BY chatid DESC LIMIT 1";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            return $result->fetch_assoc();
        }else{
            return false;
        }
    }

    public function latestGroupChatSentence($groupid){
        $sql = "SELECT * FROM groupChatSentence WHERE groupid = '$groupid' ORDER BY groupChatSentenceid DESC LIMIT 1";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            return $result->fetch_assoc();
        }else{
            return false;
        }
    }

    public function getCheckGroupChatSentence($userid,$groupChatSentenceid){
        $sql = "SELECT * FROM groupChatSentenceCheck WHERE userid = '$userid' AND groupChatSentenceid = '$groupChatSentenceid'";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            return $result->fetch_assoc();
        }else{
            return false;
        }
    }

    public function getGroupChats($userid){
        $sql = "SELECT * FROM groupChat WHERE userid = '$userid' ORDER BY latestTime DESC ";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return false;
        }
    }

    public function getGroupChat2($groupid){
        $sql = "SELECT * FROM groupChat WHERE groupid = '$groupid' LIMIT 1";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            return $result->fetch_assoc();
        }else{
            return false;
        }
    }

    public function getGroupChat3($groupid){
        $sql = "SELECT * FROM groupChat WHERE groupid = '$groupid' ";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return false;
        }
    }

    public function getGroupChatsSentenceCheck($groupChatSentenceid){
        $sql = "SELECT * FROM groupChatSentenceCheck WHERE groupChatSentenceid = '$groupChatSentenceid' ";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            return $result;
        }else{
            return false;
        }
    }

    public function getLatestGroupChats(){
        $sql = "SELECT * FROM groupChat ORDER BY groupid DESC LIMIT 1";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            return $result->fetch_assoc();
        }else{
            return false;
        }
    }

    public function getGroupChatSentence($groupid){
        $sql = "SELECT * FROM groupChatSentence WHERE groupid = '$groupid'";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return false;
        }
    }



    public function editUser($username,$password,$picture,$userid){
        $picture =  $_FILES['image']['name'];
        $target_dir =  'uploads/';
        $target_file = $target_dir.basename($picture);
        $sql = "UPDATE user SET username='$username',password='$password',picture='$picture' WHERE userid = '$userid'";
        $result = $this->conn->query($sql);

        if($result == false){
            die('YOU CANT EDIT'.$this->conn->connect_error);
        }else{
            move_uploaded_file($_FILES['image']['tmp_name'],$target_file);
            header('location:homepage.php');
        }
    }

    public function checkedChat($chatid){
        $sql = "UPDATE chat SET chatCheck = 'check' WHERE chatid = '$chatid'";
        $result = $this->conn->query($sql);

        if($result == false){
           die('YOU CANT CHECK'.$this->conn->connect_error);
        }else{
            return true;
        }
    }

    public function deleteFollow($id,$followedid){
        $sql = "DELETE FROM follow WHERE userid = $id AND followedid = $followedid";
        $result = $this->conn->query($sql);

        if($result == false){
            die('YOU CANT DELETE'.$this->conn->connect_error);
        }else{
            return true;
        }
    }

    public function deleteNice($postid,$userid){
        $sql = "DELETE FROM nice WHERE userid = $userid AND postid = $postid";
        $result = $this->conn->query($sql);

        if($result == false){
            die('YOU CANT DELETE'.$this->conn->connect_error);
        }else{
            return true;
        }
    }

    public function deleteTable($userid){
        $Delete = "DELETE FROM user WHERE userid = '$userid';
        DELETE FROM allow WHERE userid = '$userid';
        DELETE FROM chat WHERE sendid = '$userid';
        DELETE FROM follow WHERE userid = '$userid';
        DELETE FROM nice WHERE userid = '$userid';
        DELETE FROM user WHERE userid = '$userid';
        DELETE FROM postComment WHERE userid = '$userid'"; 
        $result = $this->conn->multi_query($Delete);

        if($result == false){
            die('YOU CANT DELETE'.$this->conn->connect_error);
        }else{
            header('location:login.php');
        }
    }

    public function deleteGroupChat($userid,$groupid){
        $Delete = " DELETE FROM groupChat WHERE groupid = '$groupid' AND userid = '$userid';
                    DELETE FROM groupChatSentence WHERE groupid = '$groupid' AND userid = '$userid';
                    DELETE FROM groupChatSentenceCheck WHERE groupid = '$groupid' AND userid = '$userid';
                    "; 
        $result = $this->conn->multi_query($Delete);

        if($result == false){
            die('YOU CANT DELETE'.$this->conn->connect_error);
        }else{
            header('location:homepage.php');
        }
    }

    public function deleteLoginTime($userid){
        $sql = "DELETE FROM loginTime WHERE userid = $userid";
        $result = $this->conn->multi_query($sql);

        if($result == false){
            return true;
        }else{
            return false;
        }
    }

    public function deleteShere($postid,$userid){
        $sql = "DELETE FROM share WHERE postid = '$postid' AND userid='$userid'";
        $result = $this->conn->multi_query($sql);

        if($result == false){
            die('youcantdelete'.$this->conn->connect_error);
        }else{
            return true;
        }
    }

    public function login($username,$password){
        $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            return $result->fetch_assoc();
        }else{
            return false;
        }
    }
        
}
?>