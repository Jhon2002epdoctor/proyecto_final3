<?php 
 
    include '../conexion.php';
  
    $data = json_decode(file_get_contents("php://input"));
     
    $metodoBusqueda = $data->metodoBusqueda;
    $valorBuscador = $data->valorBuscador;


       $sql = ""; 
        switch($metodoBusqueda){
            case 'precio':
            $sql ="SELECT casa.*, COUNT(imagenes.imagen) as imagenes_num 
            FROM casa 
            JOIN imagenes ON casa.id_casa = imagenes.id_casa
            WHERE casa.precio <= ?
            GROUP BY casa.precio"; 

                    $stmt = $conexion->prepare($sql);
                    $stmt->bind_param("i", $valorBuscador); 
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
        $stmt->bind_param("s", $valorBuscador);
        
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
                ];
            }
        }
        $stmt->close();
        
            break;    
        }

            
     $result_final =   isset($casas[0]["titulo"]) ? $casas : array();
     
    header("Content-Type: application/json"); 
    echo json_encode($result_final);
    $conexion->close(); 


  


?>