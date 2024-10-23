<?php

use Phalcon\Mvc\Controller;

class TestController extends Controller
{
    public function indexAction()
    {
        try {
            // Intentar conectar a la base de datos
            $db = $this->di->get('db');

            // Realizar la consulta para obtener datos de la tabla empleados
            $result = $db->query("SELECT * FROM test.empleados");

            // Verificar si la consulta se ejecutó correctamente
            if ($result) {
                // Obtener todos los resultados
                $data = $result->fetchAll();

                // Mostrar los resultados
                if (count($data) > 0) {
                    echo "<h3>Datos de Empleados:</h3>";
                    echo "<table border='1'>
                            <tr>
                                <th>ID</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Fecha de Nacimiento</th>
                                <th>ID Puesto</th>
                                <th>ID Tienda</th>
                                <th>Salario</th>
                            </tr>";

                    foreach ($data as $row) {
                        echo "<tr>
                                <td>{$row['id_empleado']}</td>
                                <td>{$row['nombres']}</td>
                                <td>{$row['apellidos']}</td>
                                <td>{$row['fecha_nac']}</td>
                                <td>{$row['id_puesto']}</td>
                                <td>{$row['id_tienda']}</td>
                                <td>{$row['salario']}</td>
                            </tr>";
                    }

                    echo "</table>";
                } else {
                    echo "No se encontraron empleados.";
                }
            }
        } catch (\Exception $e) {
            echo "Error al conectar a la base de datos: " . $e->getMessage();
        }
    }
}
