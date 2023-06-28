<?php


function addUser($userData)
{

    $usersData = file_get_contents('dataset/users.json');
    $users = json_decode($usersData, true);


    $users[] = $userData;


    file_put_contents('dataset/users.json', json_encode($users));
}


function deleteUser($index)
{

    $usersData = file_get_contents('dataset/users.json');
    $users = json_decode($usersData, true);


    if (isset($users[$index])) {
        unset($users[$index]);
    }


    $users = array_values($users);


    file_put_contents('dataset/users.json', json_encode($users));
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $company = $_POST['company'];


    $newUser = array(
        'Name' => $name,
        'Username' => $username,
        'Email' => $email,
        'Address' => $address,
        'Phone' => $phone,
        'Company' => $company
    );


    addUser($newUser);

    header('Location: index.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {

    $index = $_GET['delete'];


    deleteUser($index);


    header('Location: index.php');
    exit();
}


$usersData = file_get_contents('dataset/users.json');
$users = json_decode($usersData, true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Table</title>

</head>
<body>
<div class="table-container">
    <table>
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Company</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users as $index => $user): ?>
            <tr>
                <td><?php echo $user['Name']; ?></td>
                <td><?php echo $user['Username']; ?></td>
                <td><a href="mailto:<?php echo $user['Email']; ?>"><?php echo $user['Email']; ?></a></td>
                <td><?php echo $user['Address']; ?></td>
                <td><?php echo $user['Phone']; ?></td>
                <td><?php echo $user['Company']; ?></td>
                <td>
                    <a href="?delete=<?php echo $index; ?>" onclick="return confirm('Are you sure you want to delete this user?')">REMOVE BUTTON</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<div class="add-user-form">
    <h2>ADD USER</h2>
    <form action="" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required>

        <label for="company">Company:</label>
        <input type="text" id="company" name="company" required>

        <button type="submit">SUBMIT BUTTON</button>
    </form>
</div>


</body>
</html>
