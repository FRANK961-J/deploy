<?php

// DATABASE CONNECTION
$conn = mysqli_connect("localhost","root","","php");

if(!$conn){
    die("Database connection failed");
}

// SAVE USER + REDIRECT TO CHAT
if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];

    $sql = "INSERT INTO users(name,email,password,phone)
            VALUES('$name','$email','$password','$phone')";

    mysqli_query($conn,$sql);

    // SAVE THEN GO TO CHAT PAGE
    header("Location: chat.html");
    exit();
}

// FETCH USERS
$result = mysqli_query($conn,"SELECT * FROM users ORDER BY id DESC");
$count = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html lang="rw">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration System</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>

body{
    font-family:'Poppins',sans-serif;
    background:linear-gradient(135deg,#065f46,#10b981);
    margin:0;
    padding:30px;
    color:white;
}

.container{
    max-width:1200px;
    margin:auto;
}

.header{
    text-align:center;
    margin-bottom:30px;
}

.header h1{
    font-size:40px;
}

.main{
    display:grid;
    grid-template-columns:1fr 1.5fr;
    gap:20px;
}

.card{
    background:rgba(255,255,255,0.12);
    padding:25px;
    border-radius:15px;
    backdrop-filter:blur(10px);
}

input{
    width:100%;
    padding:12px;
    margin:10px 0;
    border:none;
    border-radius:10px;
}

button{
    width:100%;
    padding:14px;
    border:none;
    background:#06b6d4;
    color:white;
    font-size:16px;
    border-radius:10px;
    cursor:pointer;
}

button:hover{
    background:#0284c7;
}

table{
    width:100%;
    margin-top:20px;
    background:white;
    color:black;
    border-collapse:collapse;
}

th,td{
    padding:12px;
    border:1px solid #ddd;
}

.user-count{
    background:#06b6d4;
    padding:5px 10px;
    border-radius:20px;
}

</style>

</head>

<body>

<div class="container">

<div class="header">
    <h1>✨ Sisitemu yo Kwiyandikisha</h1>
    <p>PHP + MySQL System</p>
</div>

<div class="main">

<!-- FORM -->
<div class="card">

<h2>Iyandikishe</h2>

<form method="POST">

    <input type="text" name="name" placeholder="Amazina" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Ijambobanga" required>
    <input type="text" name="phone" placeholder="Telefone">

    <button type="submit" name="submit">
        Iyandikishe
    </button>

</form>

</div>

<!-- USERS -->
<div class="card">

<h2>Abiyandikishije <span class="user-count"><?php echo $count; ?></span></h2>

<table>

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Date</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['phone']; ?></td>
    <td><?php echo $row['created_at']; ?></td>
</tr>

<?php } ?>

</table>

</div>

</div>

</div>

</body>
</html>