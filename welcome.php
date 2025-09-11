<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
    
<!-- font-awesome -->
<nav class="navtop">
        <div>
            <h1>Panel Administrador</h1>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
</nav>
 <div class="content">
<?php
 session_start();
 if ($_SESSION['logueado']) {
            echo "Bienvenido/a, " . $_SESSION['username'];
            echo "<br>";
            echo "Horario de Conexión: " . $_SESSION['time'];
            echo "<br>";
            echo "<br>";
            echo "<a href='insert_products.php'>INSERTAR PRODUCTOS</a>";
            echo "<br>";
            ?>
            <table class='table table-bordered table-striped'>
                    <thead class='thead-dark'>
                <tr>
                    <th>Id</th>
                    <th>Producto</th>
                    <th>Categoria</th>
                    <th>Precio</th>
                    <th>Fecha de Alta</th>
                    <th>Eliminar</th>
                    <th>Actualizar</th>
                </tr>
            </thead>
            <tbody>
            <?php
            include_once("config_products.php");
            include_once("db.class.php"); 
            $link = new Db();
              /* Id del producto, descripción del producto, nombre de la categoria, precio, fecha de alta.*/
              $sql="SELECT products.id_product, products.price, products.product_name, products.start_date as date, categories.category_name FROM products  INNER JOIN categories ON products.id_category = categories.id_category";
              $stmt = $link->run($sql);
              $data = $stmt->fetchAll();
             /* echo $table; */
              foreach ($data as $row) {
              ?>
              <tr>
                      <td>
                          <?php echo $row['id_product']; ?>
                      </td>
                      <td>
                          <?php echo $row['product_name']; ?>
                      </td>
                      <td>
                          <?php echo $row['category_name']; ?>
                      </td>
                      <td>
                          <?php echo $row['price']; ?>
                      </td>
                      <td>
                          <?php echo $row['date']; ?>
                      </td>
                      <td>
                          <a href="#"> Eliminar Producto</a>
                      </td>
                      <td>
                          <a href="#"> Actualizar Producto</a>
                      </td>
                  </tr>

              <?php
              }
              ?>
              </tbody>
              </table>

 <?php
   }
  ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>