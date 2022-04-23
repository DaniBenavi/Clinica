<?php
class crud
{
    private $db;
    function __construct($conn)
    {
        $this->db = $conn;
    }
    //Muestra los datos en la tabla
    
    public function dataview($query)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute() > 0;
        
        echo '<a href="new_paciente.php"><button type="button" class="btn btn-success btn-sm">Agregar Paciente</button><br></a><br>';
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>

            <tr>

                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['apellido']; ?></td>
                <td><?php echo $row['direccion']; ?></td>
                <td><?php echo $row['telefono']; ?></td>
                <td><?php echo $row['dui']; ?></td>
                <td align="center">
                    <a href="edit_pacientes.php?edit_id=<?php echo $row['id'] ?>"><button type="button" class="btn btn-success btn-sm">Editar</button></a>

                </td>
                <td align="center">

                    <a href="delete_pacientes.php?delete_id=<?php echo $row['id'] ?>" >
                    <button type="button" class="btn btn-danger btn-sm">Eliminar</button></a>
                </td>
            </tr>
            
<?php

        }
    }

    public function update($id, $nombre, $apellido, $direccion, $telefono, $dui)
    {
        try {
            $stmt = $this->db->prepare("UPDATE pacientes SET nombre=:nombre, apellido=:apellido,direccion=:direccion,telefono=:telefono,dui=:dui
            WHERE id=:id");
            $stmt->bindparam(":nombre", $nombre);
            $stmt->bindparam(":apellido", $apellido);
            $stmt->bindparam(":direccion", $direccion);
            $stmt->bindparam(":telefono", $telefono);
            $stmt->bindparam(":dui", $dui);
            $stmt->bindparam(":id", $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function delete($id/*, $nombre, $apellido, $direccion, $telefono, $dui*/)
    {
        try {
            $stmt = $this->db->prepare("DELETE from pacientes WHERE id=:id");
            $stmt->bindparam(":id", $id);
            /*$stmt->bindparam(":nombre", $nombre);
            $stmt->bindparam(":apellido", $apellido);
            $stmt->bindparam(":direccion", $direccion);
            $stmt->bindparam(":telefono", $telefono);
            $stmt->bindparam(":dui", $dui);*/
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function getID($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM pacientes WHERE id=:id");
        $stmt->execute(array(":id" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    
}
