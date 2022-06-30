<?php

$a = 10;
$b = '10';
$c = 0;
$d = 0;

if ($a === $b) {
    echo $a . ' they are equal, so their types are similar <br>';
} else if ($a == $b) {
    echo $a . $b . ' they are equal by value, 
    but their types may be different <br>';
} //else ($a !== $b)
else {
    $b = 20;
    echo '<br>';
    echo $a . $b . '<br>'; 
}

var_dump($a + $b); //int(20)

echo '<br>' . ($a + $b);
echo '<br><br><br>';
$arr = array(2, 3, 4, 7, 5);

foreach ($arr as $item) {
    echo '<br>' . $item;
    echo '<br>' . $c += $item;

}

echo '<br><br><br>';
$arr_size = count($arr);
for ($i = 0; $i < $arr_size; $i++) {
    echo '<br>' . $arr[$i];
    echo '<br>' . $d += $arr[$i];
}

if ($c === $d) {
    echo '<br>it works correct';
}

echo '<br><br><br>';

$mobiles = [                                 //enum rainbow_colors { 1: "Green"; 2: "Red" ...
}
    'Iphone 13 Pro' => '1500$',
    'Samsung S22 Plus' => '1200$',
    'Xiaomi Note 10' => '600$',
    'Ayya' => "0$"
];

foreach ($mobiles as $mobile => $price) {
    echo "$mobile costs $price<br>";
}

class Singleton
{
    private static $instances = null;

    private function __construct()
    {
    }

    public function __clone()
    {
    }

    static public function getInstance()
    {
        if (is_null(self::$instances)) {
            self::$instances = new static();
        }

        return self::$instances;
    }

}

$single = Singleton::getInstance();
$singlet = Singleton::getInstance();
if ($single === $singlet)
{
    echo "<br>It's same instance<br>";
}
else
{
    echo "<br>It's not same instances<br>";
}

class Person
{
    private $name;
    private $surname;

    public function __construct($name, $surname)
    {
        $this->name = $name;
        $this->surname = $surname;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }
}

class Student extends Person
{
    private $group;
    private $university;

    public function __construct($group, $university)
    {
        parent::__construct($this->getName(), $this->getSurname());
        $this->group = $group;
        $this->university = $university;
    }

    public function setUniversity($university)
    {
        $this->university = $university;
    }

    public function getUniversity()
    {
        return $this->university;
    }

    public function getGroup()
    {
        return $this->group;
    }

    public function setGroup($group)
    {
        $this->group = $group;
    }
}

$s= new Person('Andrew', 'Giant');
echo $s->getSurname();







<html lang='en'>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/bootstrap-grid.css">
    <title>loot</title>
</head>
<?php
$conn = new mysqli("localhost", "root", "");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->select_db("books");
$result = $conn->query("SELECT DATABASE()");
$row = $result->fetch_row();
?>
<body>
<div class="search_result">
    <div class="Page_section">
        <h1>Результат пошуку</h1>
        <div class="row">


            <?php
            $query = $_GET['book'];
            $min_length = 3;
            $index = 0;
            if (strlen($query) >= $min_length) {
                $query = htmlspecialchars($query);
                $query = $conn->real_escape_string($query);
                $raw_results = $conn->query("SELECT * FROM catalog3
                            WHERE (`book_name` LIKE '%" . $query . "%') OR (`book_author` LIKE '%" . $query . "%') ");
                if ($raw_results->num_rows > 0) {
                    while ($results = $raw_results->fetch_array(MYSQLI_ASSOC) and $index < 15) {
                        $book_name = $results['book_name'];
                        $book_author = $results['book_author']; ?>
                        <div class="col">
                            <a  href='<?php echo "info_page.php?name=$book_name&author=$book_author"?>' >
                                <?php echo '<img src="data:image/png;base64,'
                                    . base64_encode($results['book_image']) . '" alt="Andjey - witcher"/>'; ?>
                            </a>
                            <div class='second_need'>

                        <span class="name"><?php echo $results['book_name'] ?><img src="./img/Vector.png"
                                                                                   alt="heart"></span>
                                <span class="author"><?php echo $results['book_author'] ?></span>
                                <div class='cartcatalog'>
                                    <span class="price"><?php echo $results['book_price']?>₴</span>
                                    <a href="#!" class="add_to_cart">
                                        <img src="./img/svg/Catalog_cart.svg" alt="cartcatalog">
                                    </a>
                                    <a href="#!" class="add_to_cart-mobile">
                                        <img src="./img/Cart.png" alt="cartcatalog">
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else {
                    echo "Немає результатів пошуку за вашим запитом";
                }
            } else {
                echo "Мінімальна довжина: " . $min_length;
            } ?>


        </div>
    </div>
</div>
</body>



<?php
session_start();

$username = "";
$usersurname = "";
$email    = "";
$errors = array();

$db = mysqli_connect('localhost', 'root', '', 'books');

if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $usersurname = mysqli_real_escape_string($db, $_POST['usersurname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);


    if (empty($username)) { array_push($errors, "Name is required"); }
    if (empty($usersurname)) { array_push($errors, "Surname is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    $user_check_query = "SELECT * FROM registration WHERE username='$username' AND usersurname='$usersurname' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['email'] === $email) {
            array_push($errors, "email already exists");
        }
    }

    if (count($errors) == 0) {
        $password = md5($password_1);
        $query = "INSERT INTO registration (username, usersurname, email, password) 
              VALUES('$username', '$usersurname', '$email', '$password')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['usersurname'] = $usersurname;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
    }
}

if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM registration WHERE email='$email' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['usersurname'] = $usersurname;
            $_SESSION['success'] = "Ти ввійшов в аккаунт";
            header('location: index.php');
        }else {
            array_push($errors, "Wrong email/password combination");
        }
    }
}
