<?php 
 
    include '../../conexion.php';
  
    if($_GET){
       $opcion  = isset($_GET['opcion']) ? $_GET['opcion'] : '';
       $valor = isset($_GET['valor']) ? $_GET['valor'] : '';
       $sql = ""; 

        switch($opcion){
            case 'id_busqueda':
                $sql = "SELECT casa.*, COUNT(imagenes.imagen) as imagenes_num 
                FROM casa 
                JOIN imagenes ON casa.id_casa = imagenes.id_casa
                WHERE casa.id_casa = ?";
             
             $stmt = $conexion->prepare($sql);
             $stmt->bind_param("i", $valor); 
             $stmt->execute();
             $result = $stmt->get_result();
        
             if ($result->num_rows > 0) {
                 while ($row = $result->fetch_assoc()) {
                     $casas[] = [
                         'imagenes' => $row['imagenes_num'],
                         'descprcion' => $row['descprcion'],
                         'titulo' => $row['titulo'],
                         'habitaciones' => $row['habitaciones'],
                         'id' => $row['id_casa'],
                         'precio' => $row['precio'],
                         'ciudad' => $row['ciudad'],
                         'comunidad_autonoma' => $row['comunidad_autonoma'],
                         'destacado' => $row['destacado'], 
                         'oculto' => $row['oculto']
                     ];
                 }
             }
             $stmt->close();
                 
            break;
            case 'precio':
            $sql ="SELECT casa.*, COUNT(imagenes.imagen) as imagenes_num 
            FROM casa 
            JOIN imagenes ON casa.id_casa = imagenes.id_casa
            WHERE casa.precio <= ?
            GROUP BY casa.precio"; 

                    $stmt = $conexion->prepare($sql);
                    $stmt->bind_param("i", $valor); 
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0){
                        while ($row = $result->fetch_assoc()) {
                            $casas[] = [
                                'imagenes' => $row['imagenes_num'],
                                'descprcion' => $row['descprcion'],
                                'titulo' => $row['titulo'],
                                'habitaciones' => $row['habitaciones'],
                                'id' => $row['id_casa'],
                                'precio' => $row['precio'],
                                'ciudad' => $row['ciudad'],
                                'comunidad_autonoma' => $row['comunidad_autonoma'],
                                'destacado' => $row['destacado'], 
                                'oculto' => $row['oculto']
                            ];
                        }
                    }
                    $stmt->close();
            break;
            case "comunidad":
                $sql = "SELECT casa.*, COUNT(imagenes.imagen) as imagenes_num 
                FROM casa 
                JOIN imagenes ON casa.id_casa = imagenes.id_casa
                WHERE casa.comunidad_autonoma = ? 
                GROUP BY casa.comunidad_autonoma";

                                    
                    $stmt = $conexion->prepare($sql);
                    $stmt->bind_param("s", $valor); 
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0){
                        while ($row = $result->fetch_assoc()) {
                            $casas[] = [
                                'imagenes' => $row['imagenes_num'],
                                'descprcion' => $row['descprcion'],
                                'titulo' => $row['titulo'],
                                'habitaciones' => $row['habitaciones'],
                                'id' => $row['id_casa'],
                                'precio' => $row['precio'],
                                'ciudad' => $row['ciudad'],
                                'comunidad_autonoma' => $row['comunidad_autonoma'],
                                'destacado' => $row['destacado'], 
                                'oculto' => $row['oculto']
                            ];
                        }
                    }
                    $stmt->close(); 
            break; 
            case "imagenes":
                $sql = "SELECT casa.*, COUNT(imagenes.imagen) as imagenes_num 
                FROM casa 
                JOIN imagenes ON casa.id_casa = imagenes.id_casa
                GROUP BY casa.id_casa
                HAVING COUNT(imagenes.imagen) = ?";

                                                
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param("i", $valor); 
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()) {
                        $casas[] = [
                            'imagenes' => $row['imagenes_num'],
                            'descprcion' => $row['descprcion'],
                            'titulo' => $row['titulo'],
                            'habitaciones' => $row['habitaciones'],
                            'id' => $row['id_casa'],
                            'precio' => $row['precio'],
                            'ciudad' => $row['ciudad'],
                            'comunidad_autonoma' => $row['comunidad_autonoma'],
                            'destacado' => $row['destacado'], 
                            'oculto' => $row['oculto']
                        ];
                    }
                }
                $stmt->close(); 
            break; 
            case "titulo":
                $sql = "SELECT casa.*, COUNT(imagenes.imagen) as imagenes_num 
                FROM casa 
                JOIN imagenes ON casa.id_casa = imagenes.id_casa
                WHERE casa.titulo LIKE ?
                GROUP BY casa.titulo";
        
        $valor = '%' . $valor . '%';
        
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $valor);
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
                $casas[] = [
                    'imagenes' => $row['imagenes_num'],
                    'descprcion' => $row['descprcion'],
                    'titulo' => $row['titulo'],
                    'habitaciones' => $row['habitaciones'],
                    'id' => $row['id_casa'],
                    'precio' => $row['precio'],
                    'ciudad' => $row['ciudad'],
                    'comunidad_autonoma' => $row['comunidad_autonoma'],
                    'destacado' => $row['destacado'], 
                    'oculto' => $row['oculto']
                ];
            }
        }
        $stmt->close();
        
            break;    
           case "todas":
            $sql = "SELECT casa.*, COUNT(imagenes.imagen) as imagenes_num 
            FROM casa 
            JOIN imagenes ON casa.id_casa = imagenes.id_casa
            GROUP BY casa.id_casa
            ORDER BY casa.id_casa";
 
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {
                    $casas[] = [
                        'imagenes' => $row['imagenes_num'],
                        'descprcion' => $row['descprcion'],
                        'titulo' => $row['titulo'],
                        'habitaciones' => $row['habitaciones'],
                        'id' => $row['id_casa'],
                        'precio' => $row['precio'],
                        'ciudad' => $row['ciudad'],
                        'comunidad_autonoma' => $row['comunidad_autonoma'],
                        'destacado' => $row['destacado'], 
                        'oculto' => $row['oculto']
                    ];
                }
            }
            $stmt->close();
            break;  
            case "": 
                $sql = "SELECT casa.*, COUNT(imagenes.imagen) as imagenes_num 
                FROM casa 
                JOIN imagenes ON casa.id_casa = imagenes.id_casa
                GROUP BY casa.id_casa
                ORDER BY casa.id_casa";
     
                $stmt = $conexion->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()) {
                        $casas[] = [
                            'imagenes' => $row['imagenes_num'],
                            'descprcion' => $row['descprcion'],
                            'titulo' => $row['titulo'],
                            'habitaciones' => $row['habitaciones'],
                            'id' => $row['id_casa'],
                            'precio' => $row['precio'],
                            'ciudad' => $row['ciudad'],
                            'comunidad_autonoma' => $row['comunidad_autonoma'],
                            'destacado' => $row['destacado'], 
                            'oculto' => $row['oculto']
                        ];
                    }
                }
                $stmt->close(); 
            break;
        }

            
     $result_final = isset($casas[0]["titulo"]) ? $casas : ["message" => "No se encontraron casas."];
     
    header("Content-Type: application/json"); 
    echo json_encode($result_final);
    $conexion->close(); 

    }
  


?>
