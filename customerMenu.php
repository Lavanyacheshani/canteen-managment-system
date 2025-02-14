<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS - Food Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./CSS/customerMenu.css">
    <script src="https://kit.fontawesome.com/babd782b9c.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #dc3545 !important;
        }
        .navbar-brand, .navbar-nav .nav-link, .balance {
            color: white !important;
        }
        .modal-header {
            background-color: #dc3545;
            color: white;
        }
        .food-menu-box {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .food-menu-img img {
            width: 100%;
            border-radius: 10px;
        }
        .food-menu-desc {
            text-align: center;
            padding-top: 10px;
        }
        .addtocart {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .addtocart:hover {
            background-color: #b02a37;
        }
        .cart-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fa-solid fa-utensils"></i> CMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="customerView.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="customerView.php#about">About</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="customerFeedback.php">Feedback</a></li>
                </ul>
                <span class="balance me-3">Balance: <?php echo $row['userBalance'] ?> <i class="fas fa-plus-circle" onclick="addBal()"></i></span>
                <a href="log_in.php?logOut=true" onclick="sessionStorage.clear()"><i class="fa-solid fa-arrow-right-from-bracket sign_out"></i></a>
            </div>
        </div>
    </nav>
    
    <section class="container mt-4">
        <h2 class="text-center mb-4">Menu Items</h2>
        <div class="row">
            <?php
            $sql = "SELECT * FROM `menu`";
            $result = mysqli_query($db, $sql);
            while($row = mysqli_fetch_array($result)){
                echo '<div class="col-md-4">
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <img src="./Pictures/Food/'.$row['foodImage'].'">
                            </div>
                            <div class="food-menu-desc">
                                <h4>'.$row['foodName'].'</h4>
                                <p class="price">TK '.$row['foodPrice'].'/-</p>
                                <button class="addtocart">Add To Cart</button>
                            </div>
                        </div>
                    </div>';
            }
            ?>
        </div>
    </section>
    
    <div class="cart-container">
        <h4>Cart</h4>
        <table>
            <thead>
                <tr><th>Product</th><th>Price</th></tr>
            </thead>
            <tbody id="carttable"></tbody>
        </table>
        <hr>
        <table>
            <tr><td>Items: <span id="itemsquantity">0</span></td><td>Total: Tk <span id="total">0</span></td></tr>
        </table>
        <div class="mt-2">
            <button id="emptycart" class="btn btn-secondary">Empty Cart</button>
            <button id="checkout" class="btn btn-danger">Checkout</button>
        </div>
    </div>
    
    <footer class="text-center">
        <p>&copy; 2025 CMS | Independent University, Sri lanka</p>
    </footer>
    
    <script>
        function addBal() {
            let bal = parseInt(prompt("Enter amount to be added:"));
            $.ajax({
                type: "POST",
                url: "reqBalance.php",
                data: { bal: bal },
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 1) {
                        alert("Balance request sent!");
                    } else {
                        alert("You have already requested for balance.");
                    }
                }
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
