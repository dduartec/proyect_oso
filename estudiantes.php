<div>
    <?php
    function getEstudiantes($dbh)
    {

        if ($_SESSION['usuario_tipo'] == 'psicologo') {
            $usuario_id = $_SESSION['usuario_id'];
            $query1 = 'SELECT * FROM `grupos` WHERE id_psicologo = :usuario_id;';
            $stmt = $dbh->prepare($query1);
            func::showEstudiantes($dbh, $stmt);
        } elseif (($_SESSION['usuario_tipo'] == 'co-tallerista')) {
            $usuario_id = $_SESSION['usuario_id'];
            $query1 = 'SELECT * FROM `grupos` WHERE  `id_co-tallerista`= :usuario_id;';
            $stmt = $dbh->prepare($query1);
            func::showEstudiantes($dbh, $stmt);
        } elseif (($_SESSION['usuario_tipo'] == 'director')) {
            header("location:director.php");
        }
    }
    function showEstudiantes($dbh, $stmt)
    {

        $stmt->execute(array(':usuario_id' => $_SESSION['usuario_id']));

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $r) {
            $id = $r['id_estudiante'];
            $query = 'SELECT * FROM `estudiantes` WHERE  id = :id;';
            $stmt = $dbh->prepare($query);
            $stmt->execute(array(':id' => $id));
            $rowsTemp = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rowsTemp as $row) {
                $nombre = $row['nombre'];
                $grado = $row['grado'];
                $edad = $row['edad'];
                $documento = $row['documento'];
                $colegio = $row['colegio'];
                echo '
                    <div class="estudiantes-container">
                        <a href="login.php">
                        <div class="estudiante">
                                <p><b>Nombre:</b> ' . $nombre . '</br>
                                <b>Edad:</b> ' . $edad . '</br>
                                <b>Documento:</b> ' . $documento . '</br>
                                <b>Grado:</b> ' . $grado . '</br>
                                <b>Colegio:</b> ' . $colegio . '</p>
                            </div>
                        </a>
                    </div>
                ';
            }
        }

    }
    getEstudiantes($dbh);
    ?>
</div>