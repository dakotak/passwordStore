<?php
session_start();

// Use the Databse
include 'db.php';

?>
<!doctype html>
<html>
    <head>
        <title>Password Store Demo</title>
    </head>
    <body>
        <div>
        <h1>Add Password</h1>
        <form action="addPassword.php" method="post">
            <input type="text" name="password" />
            <input type="submit" />
        </form>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Encrypted Password</th>
                    <?php
                    $result = $db->query("SELECT * FROM passwords");
                    foreach($results as $pass){
                        echo "<tr>";
                        echo "<td>" . $pass['id'] . "</td>";
                        echo "<td>" . $pass['title'] . "</td>";
                        echo "<td>" . base64_encode($pass['encryptedPass']) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tr>
            </table>
        </div>
        <div>
            <form action="addUser.php" method="post">
                Add User
                <input type="text" name="username" />
                <input type="submit" />
            </form>
            <table>
                <tr><th>ID</th><th>Username</th><th>Public Key</th><th>Private Key</th></tr>
                <?php
                $users = $db->query("SELECT * FROM users");
                foreach($users as $user){
                    echo "<tr>";
                    echo "<td>" . $user['id'] . "</td>";
                    echo "<td>" . $user['username'] . "</td>";
                    echo "<td>" . $user['publicKey'] . "</td>";
                    echo "<td>" . $user['privateKey'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </body>
</html>
