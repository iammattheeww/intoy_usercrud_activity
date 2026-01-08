<?php
include '../classes/class.user.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'new':
        create_new_user();
        break;
    case 'update':
        update_user();
        break;
    case 'deactivate':
        deactivate_user();
        break;
    case 'activate':
        activate_user();
        break;
    case 'delete':
        delete_user();
        break;
}

function create_new_user()
{
    $user = new User();
    $email = $_POST['email'];
    $lastname = ucwords($_POST['lastname']);
    $firstname = ucwords($_POST['firstname']);
    $access = ucwords($_POST['access']);
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    $result = $user->new_user($email, $password, $lastname, $firstname, $access);
    if ($result) {
        $id = $user->get_user_id($email);
        header('location: ../index.php?page=settings&subpage=users&action=profile&id=' . $id);
    }
}

// updated update_user function, where it can retrieve and pass email, password, and status
function update_user()
{
    $user = new User();
    $user_id = $_POST['userid'];
    $lastname = ucwords($_POST['lastname']);
    $firstname = ucwords($_POST['firstname']);
    $access = ucwords($_POST['access']);

    // Retrieval of the optional fields from the POST data
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
    $status = isset($_POST['status']) ? $_POST['status'] : null;


    $result = $user->update_user($lastname, $firstname, $access, $user_id, $email, $password, $status);
    if ($result) {
        header('location: ../index.php?page=settings&subpage=users&action=profile&id=' . $user_id);
    }
}

// added activate user for another, optionally
function activate_user()
{
    $user = new User();
    $user_id = $_POST['userid'];
    $result = $user->activate_user($user_id);
    if ($result) {
        header('location: ../index.php?page=settings&subpage=users&action=profile&id=' . $user_id);
    }
}

function deactivate_user()
{
    $user = new User();
    $user_id = $_POST['userid'];
    $result = $user->deactivate_user($user_id);
    if ($result) {
        header('location: ../index.php?page=settings&subpage=users&action=profile&id=' . $user_id);
    }
}

function delete_user()
{
    $user = new User();
    $user_id = $_POST['userid'];
    $result = $user->delete_user($user_id);
    if ($result) {
        header('location: ../index.php?page=settings&subpage=users');
    }
}
