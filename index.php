<?php

    include_once 'config/Database.php';
    include_once 'Model/User.php';

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);

    $stmt= $user->read();
    $num = $stmt->rowCount();
    $users_arr["records"] = array();

    if($num>0) {

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    
            extract($row);
    
            $user_item = array(
                "id" => $id,
                "f_name" => $f_name,
                "l_name" => $l_name,
                "role" => $role,
                "status" => $status
            );
    
            array_push($users_arr["records"], $user_item);
        } 
        

    } 
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Users table</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/css/styles.css" rel="stylesheet">
  <div class="container">
    <div class="row flex-lg-nowrap">
      <div class="col">
        <div class="row flex-lg-nowrap">
          <div class="col mb-3">
            <div class="e-panel card">
              <div class="card-body">
              <div class="row">
                  <div class="col-6">
                    <h6 class=""><span>Users</span></h6>
                  </div>
                  <div class="col-2">
                    <div class="form-group">
                      <select class="form-control action-all" name="action_all" id="one-action">
                        <option value="0" selected>Please Select</option>
                        <option value="1">Set active</option>
                        <option value="2">Set not active</option>
                        <option value="3">Delete</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-1">
                    <div id='update-all-button' class='btn btn-primary pull-right m-b-15px add-user-button ml-2 update-all-user-button'>
                      <div>OK</div>
                    </div>
                  </div>
                  <div class="col-2">
                    <div id='add-user' class='btn btn-success pull-right m-b-15px add-user-button create-user-button'>
                      <div class="">Add <i class="fa fa-plus-square-o" aria-hidden="true"></i></div>
                    </div>
                  </div>
                </div>
                <div class="e-table">
                  <div class="table-responsive table-lg mt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="align-top">
                            <div
                              class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0">
                              <input type="checkbox" class="custom-control-input" id="all-items">
                              <label class="custom-control-label" for="all-items"></label>
                            </div>
                          </th>
                          <th class="max-width">Name</th>
                          <th class="sortable">Role</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php foreach($users_arr['records'] as $item): ?>
                        <tr id="record-<?=$item['id'] ?>">
                          <td class="align-middle">
                            <div
                              class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                              <input type="checkbox" class="custom-control-input item-checkbox" id="item-<?=$item['id'] ?>" data-id="<?=$item['id']?>">
                              <label class="custom-control-label" for="item-<?=$item['id'] ?>"></label>
                            </div>
                          </td>
                          <td class="text-nowrap align-middle" id="name-<?=$item['id'] ?>"><?= $item['l_name'].' '.$item['f_name'] ?></td>
                          <td class="text-nowrap align-middle" id="role-<?=$item['id'] ?>"><span><?php
                           if($item['role'] == 1){
                            echo 'User';
                           }
                           if($item['role'] == 2){
                            echo 'Admin';
                           }
                           ?></span></td>
                          <td class="text-center align-middle"><i class="fa fa-circle <?php
                          if($item['status'] == 1){
                            echo 'active-circle';
                          }
                          else {
                              echo 'not-active-circle';
                          }
                           
                          ?>" id="<?='status-'.$item['id'] ?>"></i></td>
                          <td class="text-center align-middle">
                            <div class="btn-group align-top">
                              <button class="btn btn-sm btn-outline-secondary badge edit-user-button" type="button" data-id="<?=$item['id'] ?>">Edit</button>
                              <button class="btn btn-sm btn-outline-secondary badge delete-user-button" type="button" data-id="<?=$item['id'] ?>"><i
                                  class="fa fa-trash"></i></button>
                            </div>
                          </td>
                        </tr>
                        <?php endforeach; ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-6">
                    <h6 class=""><span></span></h6>
                  </div>
                  <div class="col-2">
                  <div class="form-group">
                      <select class="form-control action-all" name="action_all" id="two-action"> 
                        <option value="0" selected>Please Select</option>
                        <option value="1">Set active</option>
                        <option value="2">Set not active</option>
                        <option value="3">Delete</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-1">
                    <div id='update-all-button' class='btn btn-primary pull-right m-b-15px add-user-button ml-2 update-all-user-button'>
                      <div>OK</div>
                    </div>
                  </div>
                  <div class="col-2">
                    <div id='add-user' class='btn btn-success pull-right m-b-15px add-user-button create-user-button'>
                      <div class="">Add <i class="fa fa-plus-square-o" aria-hidden="true"></i></div>
                    </div>
                  </div>
                </div>
            </div>
            
          </div>
        </div>

        <!-- User Form Modal -->
        <div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal">
          <div class="modal-dialog modal-lg" role="document">
            <form action="" id="userForm">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mainModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                <div class="py-1">
                    <div class="row">
                        <div class="col">
                        <div class="row">
                            <div class="col">
                            <div class="form-group">
                                <label>First Name</label>
                                <input class="form-control" type="text" name="f_name" id="f_name" required>
                            </div>
                            </div>
                            <div class="col">
                            <div class="form-group">
                                <label>Last name</label>
                                <input class="form-control" type="text" name="l_name" id="l_name" required>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Role</label>
                            <select class="form-control" id="role" name="role">
                            <option value="1" selected>User</option>
                            <option value="2">Admin</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <label for="">Status </label>
                            <div class="form-check form-check-inline ml-2">
                            <label class="switch">
                            <input type="checkbox" class="switch_checkbox">
                            <span class="slider round"></span>
                            </label>
                        </div>
                        </div>
                    </div>
                </div>
                </div>
            <div class="alert alert-danger errors" hidden>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-primary" id="store-user-button">Добавить</button>
                <button type="submit" class="btn btn-primary" id="update-user-button">Обновить</button>
            </div>
            </div>
          </form> 
          </div>
        </div>
      </div>

      <div class="modal" tabindex="-1" role="dialog" id="message-modal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="message-modal-title"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="message-modal-body">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger" id="remove-button" hidden>Delete</button>
            </div>
          </div>
        </div>
      </div>
    
  </div>

  
  <script src="assets/js/users/update-user.js"></script>
  <script src="assets/js/users/delete-user.js"></script>
  <script src="assets/js/users/create-user.js"></script>
  <script src="assets/js/users/update-all.js"></script>
  <style>
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }
    
    /* Hide default HTML checkbox */
    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }
    
    /* The slider */
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }
    
    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }
    
    input:checked + .slider {
      background-color: #2196F3;
    }
    
    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }
    
    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }
    
    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }
    
    .slider.round:before {
      border-radius: 50%;
    }
  </style>
</body>
</html>