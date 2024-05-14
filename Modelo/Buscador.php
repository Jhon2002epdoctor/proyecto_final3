<?php 
 
    include '../conexion.php';
  
    $data = json_decode(file_get_contents("php://input"));
     
    $metodoBusqueda = $data->metodoBusqueda;
    $valorBuscador = $data->valorBuscador;

       $sql = ""; 
        switch($metodoBusqueda){
            case 'precio':
                $query = "
                SELECT
                    casa.*,
                    GROUP_CONCAT(CONCAT(imagenes.id_imagen, ':', imagenes.imagen, ':', imagenes.ocultoImagen) SEPARATOR ',') AS imagenes
                FROM
                    casa
                JOIN
                    imagenes ON casa.id_casa = imagenes.id_casa
                WHERE
                    casa.oculto = 0 AND casa.precio <= ?
                GROUP BY
                    casa.id_casa
                ";
                
                $stmt = $conexion->prepare($query);
                
                if ($stmt) {
                    // Vincula el parámetro precio a la consulta.
                    $stmt->bind_param("d", $valorBuscador);
                
                    // Ejecuta la consulta.
                    $stmt->execute();
                
                    // Obtén el resultado.
                    $result = $stmt->get_result();
                
                    // Verifica si hay resultados.
                    $casas = [];
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $imagenes = array_map(function ($imagen_str) {
                                list($id_imagen, $imagen_base64, $oculto) = explode(':', $imagen_str);
                                return [
                                    'id_imagen' => (int) $id_imagen,
                                    'imagen' => $imagen_base64,
                                    'ocultoImagen' => (int) $oculto,
                                ];
                            }, explode(',', $row['imagenes']));
                
                            // Agrega los datos de la casa al arreglo final.
                            $casas[] = [
                                'id_casa' => $row['id_casa'],
                                'descprcion' => $row['descprcion'],
                                'habitaciones' => $row['habitaciones'],
                                'titulo' => $row['titulo'],
                                'precio' => $row['precio'],
                                'comunidad_autonoma' => $row['comunidad_autonoma'],
                                'ciudad' => $row['ciudad'],
                                'destacado' => (int) $row['destacado'],
                                'oculto' => (int) $row['oculto'],
                                'imagenes' => $imagenes,
                            ];
                        }
                    } else {
                        $casas = ['message' => 'No se encontraron casas.'];
                    }
                
                    // Cierra la sentencia.
                    $stmt->close();
                } else {
                    // Si la sentencia no se pudo preparar, maneja el error.
                    $casas = ['error' => 'Error al preparar la consulta: ' . $conexion->error];
                }
            break; 
            case "titulo":
                                    $query = "
                        SELECT
                            casa.*,
                            GROUP_CONCAT(CONCAT(imagenes.id_imagen, ':', imagenes.imagen, ':', imagenes.ocultoImagen) SEPARATOR ',') AS imagenes
                        FROM
                            casa
                        JOIN
                            imagenes ON casa.id_casa = imagenes.id_casa
                        WHERE
                            casa.oculto = 0 AND casa.titulo = ?
                        GROUP BY
                            casa.id_casa
                        ";

                        $stmt = $conexion->prepare($query);

                            if ($stmt) {
                          
                                $stmt->bind_param("s", $valorBuscador);

                    
                                $stmt->execute();

                                $result = $stmt->get_result();

               
                                $casas = [];
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $imagenes = array_map(function ($imagen_str) {
                                            list($id_imagen, $imagen_base64, $oculto) = explode(':', $imagen_str);
                                            return [
                                                'id_imagen' => (int) $id_imagen,
                                                'imagen' => $imagen_base64,
                                                'ocultoImagen' => (int) $oculto,
                                            ];
                                        }, explode(',', $row['imagenes']));
                                        $casas[] = [
                                            'id_casa' => $row['id_casa'],
                                            'descprcion' => $row['descprcion'],
                                            'habitaciones' => $row['habitaciones'],
                                            'titulo' => $row['titulo'],
                                            'precio' => $row['precio'],
                                            'comunidad_autonoma' => $row['comunidad_autonoma'],
                                            'ciudad' => $row['ciudad'],
                                            'destacado' => (int) $row['destacado'],
                                            'oculto' => (int) $row['oculto'],
                                            'imagenes' => $imagenes,
                                        ];
                                    }
                                } else {
                                    $casas = ['message' => 'No se encontraron casas.'];
                                }

                                // Cierra la sentencia.
                                $stmt->close();
                            } else {
                                // Si la sentencia no se pudo preparar, maneja el error.
                                $casas = ['error' => 'Error al preparar la consulta: ' . $conexion->error];
                            }
                break;
                case "todos":
                    
                                        $query = "
                    SELECT
                        casa.*,
                        GROUP_CONCAT(CONCAT(imagenes.id_imagen, ':', imagenes.imagen, ':', imagenes.ocultoImagen) SEPARATOR ',') AS imagenes
                    FROM
                        casa
                    JOIN
                        imagenes ON casa.id_casa = imagenes.id_casa
                    WHERE
                        casa.oculto = 0
                    GROUP BY
                        casa.id_casa
                    ";

                    $stmt = $conexion->prepare($query);

                    if ($stmt) {
                        // Ejecuta la consulta.
                        $stmt->execute();

                        // Obtén el resultado.
                        $result = $stmt->get_result();

                        // Verifica si hay resultados.
                        $casas = [];
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $imagenes = array_map(function ($imagen_str) {
                                    list($id_imagen, $imagen_base64, $oculto) = explode(':', $imagen_str);
                                    return [
                                        'id_imagen' => (int) $id_imagen,
                                        'imagen' => $imagen_base64,
                                        'ocultoImagen' => (int) $oculto,
                                    ];
                                }, explode(',', $row['imagenes']));

                                // Agrega los datos de la casa al arreglo final.
                                $casas[] = [
                                    'id_casa' => $row['id_casa'],
                                    'descprcion' => $row['descprcion'],
                                    'habitaciones' => $row['habitaciones'],
                                    'titulo' => $row['titulo'],
                                    'precio' => $row['precio'],
                                    'comunidad_autonoma' => $row['comunidad_autonoma'],
                                    'ciudad' => $row['ciudad'],
                                    'destacado' => (int) $row['destacado'],
                                    'oculto' => (int) $row['oculto'],
                                    'imagenes' => $imagenes,
                                ];
                            }
                        } else {
                            $casas = ['message' => 'No se encontraron casas.'];
                        }

                        // Cierra la sentencia.
                        $stmt->close();
                    } else {
                        // Si la sentencia no se pudo preparar, maneja el error.
                        $casas = ['error' => 'Error al preparar la consulta: ' . $conexion->error];
                    }
                    
                break;     
        }

     $RespuestaNoencontrada = ["titulo" => "No se encontraron resultados"];
     $result_final =   isset($casas[0]["titulo"]) ? $casas : ["error" => "No se encontraron resultados"] ;
     
    header("Content-Type: application/json"); 
    echo json_encode($result_final);
    $conexion->close(); 
?>