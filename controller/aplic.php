<?php
include('../model/vuelo.php');

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $vuelo = new Vuelo();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $vueloDetalle = $vuelo->traerVuelo($id);
        echo json_encode($vueloDetalle);
    } else {
        $datos = $vuelo->traerVuelos();
        echo json_encode($datos);
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"));
    $vuelo = new Vuelo(null, $data->nombre_aerolinea, $data->nvuelo, $data->destino);
    $vuelo->guardarVuelo();
    echo "Registro guardado exitosamente.";
} elseif ($_SERVER["REQUEST_METHOD"] === "PUT") {
    $data = json_decode(file_get_contents("php://input"));
    $vuelo = new Vuelo($data->id, $data->nombre_aerolinea, $data->nvuelo, $data->destino);
    $vuelo->actualizarVuelo();
    echo "Registro actualizado exitosamente.";
} elseif ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    $data = json_decode(file_get_contents("php://input"));
    $vuelo = new Vuelo($data->id);
    $vuelo->eliminarVuelo();
    echo "Registro eliminado exitosamente.";
}
?>
