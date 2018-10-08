<div>
    <?php
    function getEstudiantes($dbh)
    {
        if ($_SESSION['usuario_tipo'] == 'psicologo') {
            $usuario_id = $_SESSION['usuario_id'];
            $query1 = 'SELECT * FROM `grupos` WHERE id_psicologo = :usuario_id;';
            $stmt = $dbh->prepare($query1);
            showEstudiantes($dbh, $stmt);
        } elseif (($_SESSION['usuario_tipo'] == 'co-tallerista')) {
            $usuario_id = $_SESSION['usuario_id'];
            $query1 = 'SELECT * FROM `grupos` WHERE  `id_co-tallerista`= :usuario_id;';
            $stmt = $dbh->prepare($query1);
            showEstudiantes($dbh, $stmt);
        } elseif (($_SESSION['usuario_tipo'] == 'director')) {
            //echo'<script language="javascript">window.location="director.php"</script>';
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
                    <form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">
                    <input type="hidden" name="name" value="' . $nombre . '" />
                    <input type="hidden" name="grado" value="' . $grado . '" />
                    <input type="hidden" name="edad" value="' . $edad . '" />
                    <input type="hidden" name="documento" value="' . $documento . '" />
                    <input type="hidden" name="colegio" value="' . $colegio . '" />
                    <input type="hidden" name="id" value="' . $row['id'] . '" />
                        <button type="submit" name="nombre" class="estudiante">
                                <p><b>Nombre:</b> ' . $nombre . '</br>
                                <b>Edad:</b> ' . $edad . '</br>
                                <b>Documento:</b> ' . $documento . '</br>
                                <b>Grado:</b> ' . $grado . '</br>
                                <b>Colegio:</b> ' . $colegio . '</p>
                        </button>
                    </form>
                    </div>
                ';
            }
        }

    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo '<h3>Estudiante: ' . $_POST['name'] . '</h3>';
        $query = 'SELECT * FROM presentacion_test WHERE id_estudiante=?';
        $stmt = $dbh->prepare($query);
        $stmt->execute([$_POST['id']]);
        $rows = $stmt->fetchAll();
        echo '<h4>Pruebas presentadas</h4>
        <table class="table">
        <tr>
            <th>Prueba</th>
            <th>Puntuación</th> 
        </tr>';
        foreach ($rows as $r) {
            $query = 'SELECT * FROM test WHERE id=?';
            $stmt = $dbh->prepare($query);
            $stmt->execute([$r['id_test']]);
            $pruebas_presentadas = $stmt->fetch();
            echo "<tr>
                    <th>" . $pruebas_presentadas['nombre'] . "</th>
                    <th>" . $r['score'] . '</th>
                    </tr>';

        }
        echo '</table>';
        $query = 'SELECT * FROM presentacion_test WHERE id_estudiante=?';
        $stmt = $dbh->prepare($query);
        $stmt->execute([$_POST['id']]);
        $rows = $stmt->fetchAll();
        echo '<h4>Pruebas sin presentar</h4>';
        $query = 'SELECT * FROM test WHERE id<>';
        $stmt = $dbh->prepare($query);
        $stmt->execute([$r['id_test']]);
        $pruebas = $stmt->fetchAll();
        foreach ($pruebas as $p) {
            echo 'Preuba:' . $p['nombre'] . '</br>';
        }

    } else {
        echo '<h3>Estudiantes:</h3>';
        getEstudiantes($dbh);
    }
    ?>
</div>