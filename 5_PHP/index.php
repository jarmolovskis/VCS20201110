<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP paskaita</title>
</head>

<body>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "php2011";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo "Pavyko prisijungti prie DB!<br><br><br>";

    if(isset($_GET["id"])) {

        $id = $_GET["id"];
        $sql = "DELETE FROM `profiles` WHERE id = $id";

        if($conn->query($sql) == true) {
            header("Location: index.php?status=deleted");
        } else {
            echo "Nepavyko! " . $conn->error;
        }
    }

    if(isset($_GET["name"])) {

        print_r($_GET);
        echo "<br>";
        echo $_GET["name"];
        echo "<br>";

        $name = $_GET["name"];
        $city = $_GET["city"];
        $age = $_GET["age"];

        $sql = "INSERT INTO `profiles` (`id`, `name`, `city`, `age`) VALUES (null, '$name', '$city', '$age')";

        if($conn->query($sql) == true) {
            header("Location: index.php?status=success");
        } else {
            echo "Nepavyko! " . $conn->error;
        }
    }


    echo "<br><br>";

    $sql = "SELECT id, name, city, age FROM profiles";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        // id, name  , city   , age
        // 1 , Petras, Vilnius, 34
        // 2 , Egle,   Kaunas, 29

        // Petras (Vilnius, 34m.)

        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $tekstas = $row["name"] . " (" . $row["city"] . ", " . $row["age"] . "m.)" . ""; ?>

            <form action="">
                <?php echo $tekstas; ?>
                <input name="id" type="number" value="<?php echo $row["id"] ?>" hidden>
                <button>Delete</button>
            </form>

        <?php }
    
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>

    <h1>PHP paskaita</h1>
    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi quidem natus, illo rerum itaque est vel sequi dolorum atque, soluta impedit, minus mollitia repellendus. Ut enim porro saepe praesentium sequi!</p>

    <?php
    $kintamojo_pavadinimas = "Kintamojo reikšmė";

    ?>

    <p><?php echo $kintamojo_pavadinimas; ?></p>


    <form action="">
        <input name="name" type="text">
        <input name="city" type="text">
        <input name="age" type="number">
        <button>Išsaugoti</button>
    </form>

</body>

</html>