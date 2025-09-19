<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>

<script>
    
    function deleteProduct(cod){
    
    bootbox.confirm("Desea ud. eliminar realmente el id " + cod, function(result) {
                if (result) {
                    window.location = "delete.php?q=" + cod;
                }
            });
    
    }
    
    function updateProduct(cod){
                    window.location = "edit.php?q=" + cod;
                }
    
    
    
    
    </script>
   
</head>

<body>
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
            $table = " <div class='table-responsive'><table class='table table-bordered table-striped' id='myTable'>
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
            <tbody>";
            include_once("config_products.php");
            include_once("db.class.php");
            $link = new Db();
            $sql = "select p.id_product,c.category_name,p.image,p.product_name,p.price, date_format(p.start_date,'%d/%m/%Y') as date from products p inner join categories c on p.id_category=c.id_category";
            $stmt = $link->run($sql);
            $data = $stmt->fetchAll();
            echo $table;
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
                        <a href="#" onclick="deleteProduct(<?php echo $row['id_product'] ?>)"> Eliminar Producto</a>
                    </td>
                    <td>
                        <a href="#" onclick="updateProduct(<?php echo $row['id_product'] ?>)"> Actualizar Producto</a>
                    </td>
                </tr>
        <?php
            } // foreach

            $table = " </tbody>
                </table> </div>";
            echo $table;
        }

        ?>

    </div>
    <script>
        let table = new DataTable('#myTable', {
            info: false,
            ordering: true,
            paging: false,
            // Descargar el archivo es-MX.json desde la pagina: https://datatables.net/plug-ins/i18n/Spanish_Argentina.html
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.3.4/i18n/es-AR.json',
            },
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.4/bootbox.min.js"> </script>
</body>
</html>