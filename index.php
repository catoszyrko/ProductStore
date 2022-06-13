<?php 

    include_once('inc/dbconfig.php');
    include_once('inc/class.crud.article.php');

    $article = new ARTICLE();
    
    if($_POST['action']=="delete"){
        $article->delete($link,$_POST['id']);
        $msg = "<b>Important:</b> Action finished.";
    }

    if($_POST['action']=="add"){
        $article->create($link,$_POST['nombre'],$_POST['sku'],$_POST['marca'], $_POST['costo'], $_POST['categoria'], $_POST['detail_1'], $_POST['detail_2']);
        // here depending on the object we add differents attr.
        $msg = "<b>Congratulations:</b> Article created";
    }

    if($_POST['action']=="update"){
        $articleDetails = $article->find($link,$_POST['id']);
    }

    if($_POST['action']=="updateOk"){
        $article->update($link,$_POST['nombre'],$_POST['sku'],$_POST['marca'], $_POST['costo'], $_POST['id'],  $_POST['categoria'],  $_POST['detail_1'],  $_POST['detail_2']);
        $msg = "<b>Congratulations:</b> Article updated";
        $articleDetails = $article->find($link,$_POST['id']);
    }

    if($_POST['action']=="update"){
        $articleDetails = $article->find($link,$_POST['id']);
    }

    $results = $article->read($link);
    
?>
<?php include_once('includes/head.php');?>

<body>

    <?php include_once('includes/header.php');?>

    <!-- content -->
    <div class="container mt-4">
        <?php if(!empty($_POST['action'])){?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-primary alert-sm" role="alert">
                        <?=$msg?>
                    </div>
                </div>
            </div>
        <?php }?>
        <div class="row my-auto">

            <div class="col-3">
                <form action="" method="post" class="form-control">
                    <?php if($_POST['action']=="update"){?><h5>Actualizar Articulo</h5><?php }else{?><h5>Agregar Articulo</h5><?php }?>
                    <input type="text" class="form-control" placeholder="Nombre" required name="nombre" value="<?=$articleDetails['nombre']?>"><br>
                    <input type="text" class="form-control" placeholder="SKU" required name="sku" value="<?=$articleDetails['sku']?>"><br>
                    <input type="text" class="form-control" placeholder="Costo" required name="costo" value="<?=$articleDetails['costo']?>"><br>
                    <input type="marca" class="form-control" placeholder="Marca" required name="marca" value="<?=$articleDetails['marca']?>"><br>
                    <select name="categoria" class="form-control" onchange="showDetails(this)">
                        <option>Seleccione Categoría</option>
                        <option value="televisor" <?php if($articleDetails['categoria']=="televisor"){echo "selected";}?>>Televisor</option>
                        <option value="laptop" <?php if($articleDetails['categoria']=="laptop"){echo "selected";}?>>Laptop</option>
                        <option value="zapato" <?php if($articleDetails['categoria']=="zapato"){echo "selected";}?>>Zapatos</option>
                    </select><br>

                    <div id="categoriaDetails">
                    <?php  switch($articleDetails['categoria']){
                            case 'televisor': ?>
                                <div>
                                    <input class="form-check-input" type="radio" name="detail_1" value="LED" <?php if($articleDetails['detail_1']=="LED"){echo "checked";}?>>
                                    <label class="form-check-label" for="detail_1">
                                        LED
                                    </label>
                                    <input class="form-check-input" type="radio" name="detail_1"  value="LCD" <?php if($articleDetails['detail_1']=="LCD"){echo "checked";}?>>
                                    <label class="form-check-label" for="detail_2">
                                        LCD
                                    </label>
                                    <input type="text" name="detail_2" placeholder="Tamaño de la Pantalla" class="form-control" value="<?=$articleDetails['detail_2']?>">
                                </div>  
                        <?php  break;
                            case 'zapato':?>
                                <div>
                                    <input class="form-check-input" type="radio" name="detail_1" value="Piel" <?php if($articleDetails['detail_1']=="Piel"){echo "checked";}?>>
                                    <label class="form-check-label" for="detail_1">
                                        Piel
                                    </label>
                                    <input class="form-check-input" type="radio" name="detail_1" value="Plastico" <?php if($articleDetails['detail_1']=="Plastico"){echo "checked";}?>>
                                    <label class="form-check-label" for="flexRadioDefault2" >
                                        Plástico
                                    </label>
                                    <input type="text" name="detail_2" placeholder="Número / Tamaño" class="form-control" value="<?=$articleDetails['detail_2']?>">
                                </div>  
                        <?php  break;
                            case 'laptop':?>
                                <div>
                                    <input class="form-check-input" type="radio" value="INTEL"  name="detail_1"  <?php if($articleDetails['detail_1']=="INTEL"){echo "checked";}?>>
                                    <label class="form-check-label" for="detail_1">
                                        INTEL
                                    </label>
                                    <input class="form-check-input" type="radio" value="AMD" name="detail_1" <?php if($articleDetails['detail_1']=="AMD"){echo "checked";}?>>
                                    <label class="form-check-label" for="detail_1">
                                        AMD
                                    </label>
                                    <input type="text" name="detail_2" placeholder="Memoria Ram" class="form-control" value="<?=$articleDetails['detail_2']?>">
                                </div>  
                        <?php  break;
                    }  ?>
                        
                        
                        
                    </div>
                    <hr>
                    <?php if($_POST['action']=="update" || $_POST['action']=="updateOk" ){?>
                        <input type="hidden" name="action" value="updateOk">
                        <input type="hidden" name="id" value="<?=$articleDetails['id']?>">
                        <button class="btn btn-primary form-control btn-sm">Actualizar</button>
                        <a href="./" class="btn btn-warning form-control btn-sm mt-3">Limpiar / Nuevo</a>
                    <?php }else{?>
                        <input type="hidden" name="action" value="add">
                        <button class="btn btn-primary form-control btn-sm">Agregar</button>
                    <?php }?>
                </form>
            </div>

            <div class="col-9 d-flex justify-content-center s">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>SKU</th>
                            <th>Marca</th>
                            <th>Costo</th>
                            <th>Precio</th>
                            <th>Detalle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($result = mysqli_fetch_array($results)){
                            $precio = $article->price($result['categoria'], $result['costo']);

                            
                            
                        ?>
                            <tr>
                                <td><?=$result['id']?></td>
                                <td><?=ucwords($result['nombre'])?></td>
                                <td><?=ucwords($result['categoria'])?></td>
                                <td><?=$result['sku']?></td>
                                <td><?=ucwords($result['marca'])?></td>
                                <td>$<?=$result['costo']?></td>
                                <td>$<?=$precio?></td>
                                <td><?=$result['detail_1']?> - <?=$result['detail_2']?></td>
                                <td>
                                    <form method="post" class="d-inline-flex">
                                        <input type="hidden" value="<?=$result['id']?>" name="id">
                                        <input type="hidden" value="update" name="action">
                                        <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('¿Desea modificar... ?')">
                                            <i class="fa icon-edit"></i>
                                        </button>
                                    </form>
                                    <form method="post" class="d-inline-flex">
                                        <input type="hidden" value="<?=$result['id']?>" name="id">
                                        <input type="hidden" value="delete" name="action">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar... ?')">
                                            <i class="fa icon-remove"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php }?>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    
    <?php include_once('includes/footer.php');?>

    <script>
        function showDetails(selectObject){
            
            element = document.getElementById('categoriaDetails');


            switch(selectObject.value) {
                case 'televisor':
                    element.innerHTML = 
                        `<div>
                            <input class="form-check-input" type="radio" name="detail_1" value="LED">
                            <label class="form-check-label">
                                LED
                            </label>
                            <input class="form-check-input" type="radio" name="detail_1" value="LCD">
                            <label class="form-check-label" >
                                LCD
                            </label>
                            <input type="text" name="detail_2" placeholder="Tamaño de la Pantalla" class="form-control">
                        </div>`;
                break;
                case 'zapato':
                    element.innerHTML = `
                        <div>
                            <input class="form-check-input" type="radio" name="detail_1" value="Piel">
                            <label class="form-check-label" >
                                Piel
                            </label>
                            <input class="form-check-input" type="radio" name="detail_1" value="Plastico">
                            <label class="form-check-label" >
                                Plástico
                            </label>
                            <input type="text" name="detail_2" placeholder="Número / Tamaño" class="form-control">
                        </div>
                        `;
                break;
                case 'laptop':
                    element.innerHTML = `
                        <div>
                            <input class="form-check-input" type="radio" value="INTEL"  name="detail_1" value="INTEL">
                            <label class="form-check-label">
                                INTEL
                            </label>
                            <input class="form-check-input" type="radio" value="AMD" name="detail_1" value="AMD">
                            <label class="form-check-label">
                                AMD
                            </label>
                            <input type="text" name="detail_2" placeholder="Memoria Ram" class="form-control">
                        </div>`;
                break;
            }

            

        }
    </script>
</body>
</html>