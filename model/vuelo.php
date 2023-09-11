<?php
include('conexion.php');

class Vuelo
{
    private $id;
    private $nombre_aerolinea;
    private $nvuelo;
    private $destino;

    public function __construct($id = null, $nombre_aerolinea = null, $nvuelo = null, $destino = null)
    {
        $this->id = $id;
        $this->nombre_aerolinea = $nombre_aerolinea;
        $this->nvuelo = $nvuelo;
        $this->destino = $destino;
    }

    public function guardarVuelo()
    {
        $pdo = new conexion();
        try {
            $sql = "INSERT INTO `viaje` (`nombre_aerolinea`, `nvuelo`, `destino`) VALUES (:nombre_aerolinea, :nvuelo, :destino)";
            $query = $pdo->prepare($sql);
            $query->bindParam(':nombre_aerolinea', $this->nombre_aerolinea, PDO::PARAM_STR);
            $query->bindParam(':nvuelo', $this->nvuelo, PDO::PARAM_STR);
            $query->bindParam(':destino', $this->destino, PDO::PARAM_STR);
            $query->execute();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . "\n";
        }
    }

    public function actualizarVuelo()
    {
        $pdo = new conexion();
        try {
            $sql = "UPDATE `viaje` SET `nombre_aerolinea` = :nombre_aerolinea, `nvuelo` = :nvuelo, `destino` = :destino WHERE `id` = :id";
            $query = $pdo->prepare($sql);
            $query->bindParam(':nombre_aerolinea', $this->nombre_aerolinea, PDO::PARAM_STR);
            $query->bindParam(':nvuelo', $this->nvuelo, PDO::PARAM_STR);
            $query->bindParam(':destino', $this->destino, PDO::PARAM_STR);
            $query->bindParam(':id', $this->id, PDO::PARAM_INT);
            $query->execute();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . "\n";
        }
    }

    public function eliminarVuelo()
    {
        $pdo = new conexion();
        try {
            $sql = "DELETE FROM `viaje` WHERE `id` = :id";
            $query = $pdo->prepare($sql);
            $query->bindParam(':id', $this->id, PDO::PARAM_INT);
            $query->execute();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . "\n";
        }
    }

    public function traerVuelos()
    {
        $pdo = new conexion();
        try {
            $sql = "SELECT * FROM viaje";
            $query = $pdo->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . "\n";
        }
    }

    public function traerVuelo($id)
    {
        $pdo = new conexion();
        try {
            $sql = "SELECT * FROM `viaje` WHERE id = :id";
            $query = $pdo->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . "\n";
        }
    }
}
?>
