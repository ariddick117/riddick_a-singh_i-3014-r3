<?php
function createUser($fname, $username, $password, $email){
    $pdo = Database::getInstance()->getConnection();

    //TODO: build the proper SQL query with the information above
    // execute it to create a user in tbl_user
    $create_user_query = 'INSERT INTO tbl_user(user_fname, user_name, user_pass, user_email)'.  
    $create_user_query = ' VALUES(:fname, :username, :password, :email)';
    $create_user_set = $pdo->prepare($create_user_query);
    $create_user_result = $create_user_set->execute(
        array(
            ':fname'=>$fname,
            ':username'=>$username,
            ':password'=>$password,
            ':email'=>$email
        )
    );
    //TODO: based on the execution result, if everything goes through
    //redirect to the index.php
    //Otherwise, return an error message
    
    if($create_user_result){
        redirect_to('index.php');
    }else{
        return 'You are bad and you should feel bad';
    };
}

function getSingleUser($id){
    // TODO: set up database connection
    $pdo = Database::getInstance()->getConnection();

    // TODO: run the proper SQL query to fetch user based on $id
    $fetch_user_query = 'SELECT * FROM tbl_user WHERE user_id =:id';
    $get_user_set = $pdo->prepare($fetch_user_query);
    $get_user_result = $get_user_set->execute(
        array(
            ':id'=>$id
        )
    );

    // handy to debug pdo->prepare
    // echo $get_user_set->debugDumpParams();
    // exit;

    // TODO: return the user data if the above query works, otherwise return an error
    if($get_user_result && $get_user_set->rowCount()){
        return $get_user_set;
    }else{
        return 'There was a problem accessing this info';
    }
}

function editUser($id, $fname, $username, $password, $email){
    //TODO: get the database connection
    $pdo = Database::getInstance()->getConnection();

    //TODO: run the proper SQL query to update tbl_user
    $update_user_info_query = 'UPDATE tbl_user SET user_fname=:fname, user_name=:username';
    $update_user_info_query .= ', user_pass=:password, user_email=:email WHERE user_id=:id';
    $update_user_set = $pdo->prepare($update_user_info_query);
    $update_user_result = $update_user_set->execute(
        array(
            ':fname'=>$fname,
            ':username'=>$username,
            ':password'=>$password,
            ':email'=>$email,
            ':id'=>$id
        )
    );

    //TODO: if the update SQL query went through redirect user to index.php, otherwise return some error message
    if($update_user_result){
        redirect_to('index.php');
    }else{
        return 'We were unable to update your information at this time.';
    }
}