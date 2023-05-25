<?php

class Pedido 
{

    function __construct(){

        require_once 'conexion.php';
        $this->conn = new Conexion;
        $this->cid = $this->conn->conectar();
        
    }

    public function insertarEncabezado($siguienteTalon, $nroSucurs){
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        
        $dbh = $this->cid;

        $stmt = $dbh->prepare("INSERT INTO ph_pedidos_enc (NRO_PEDIDO, NRO_LOCAL, HORA) VALUES(?, ?, ? )");
        $hourMin = date('Hi');
        $stmt->bindParam(1, $siguienteTalon);
        $stmt->bindParam(2, $nroSucurs);
        $stmt->bindParam(3, $hourMin);
        $stmt->execute();
    }

    public function insertarDetalle($nroSucurs, $siguienteTalon, $cod, $cant, $renglon){
        $dbh = $this->cid;
        $stmt = $dbh->prepare("INSERT INTO ph_pedidos_det (NRO_LOCAL, NRO_PEDIDO, RENGLON, COD_GUSTO, CANT_PED, CANT_PENDI) VALUES(?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $nroSucurs);
        $stmt->bindParam(2, $siguienteTalon);
        $stmt->bindParam(3, $renglon);
        $stmt->bindParam(4, $cod);
        $stmt->bindParam(5, $cant);
        $stmt->bindParam(6, $cant);
        $stmt->execute();
    }


    public function traerFiltrado($nroSucurs){
        $dbh = $this->cid;
        $stmt = $dbh->prepare("SELECT * FROM ph_pedidos_enc WHERE NRO_LOCAL = ? ORDER BY FECHA_PED DESC");
        $stmt->bindParam(1, $nroSucurs);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;

    }

    public function historial($nroSucurs){
        $dbh = $this->cid;
        $stmt = $dbh->prepare("SELECT A.FECHA_PED, A.TALON, A.NRO_LOCAL, A.NRO_PEDIDO, SUM(B.CANT_PED) CANT FROM ph_pedidos_enc A INNER JOIN ph_pedidos_det B ON A.NRO_LOCAL = B.NRO_LOCAL AND A.NRO_PEDIDO = B.NRO_PEDIDO WHERE A.NRO_LOCAL = :nroSucurs GROUP BY A.FECHA_PED, A.TALON, A.NRO_LOCAL, A.NRO_PEDIDO ORDER BY FECHA_PED DESC");

        $stmt->bindValue(':nroSucurs', $nroSucurs);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;
        
    }


    public function pendientesTodos($nroSucurs,$desde,$hasta){
        $dbh = $this->cid;
        $stmt = $dbh->prepare("SELECT A.NRO_LOCAL, C.LOCAL NOMBRE_LOCAL, A.FECHA_PED, CAST(A.FECHA_PED+2 AS DATE) FECHA_ENTREGA, A.TALON, A.NRO_LOCAL, A.NRO_PEDIDO, SUM(B.CANT_PED) CANT_PED, SUM(B.CANT_ENT) CANT_ENT, D.DESC_ESTADO
        FROM ph_pedidos_enc A INNER JOIN ph_pedidos_det B ON A.NRO_LOCAL = B.NRO_LOCAL AND A.NRO_PEDIDO = B.NRO_PEDIDO INNER JOIN ph_locales C ON A.NRO_LOCAL = C.NRO_LOCAL
        INNER JOIN ph_estado_pedidos D ON A.ESTADO = D.ID_ESTADO    where FECHA_PED between '{$desde}' and '{$hasta}' GROUP BY A.FECHA_PED, A.TALON, A.NRO_LOCAL, A.NRO_PEDIDO ORDER BY FECHA_PED ;");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;
        
    }

    public function pendientesAbiertos($nroSucurs){
        $dbh = $this->cid;
        $stmt = $dbh->prepare("SELECT A.NRO_LOCAL, C.LOCAL NOMBRE_LOCAL, A.FECHA_PED, CAST(A.FECHA_PED+2 AS DATE) FECHA_ENTREGA, A.TALON, A.NRO_LOCAL, A.NRO_PEDIDO, SUM(B.CANT_PED) CANT_PED, SUM(B.CANT_ENT) CANT_ENT, D.DESC_ESTADO
        FROM ph_pedidos_enc A INNER JOIN ph_pedidos_det B ON A.NRO_LOCAL = B.NRO_LOCAL AND A.NRO_PEDIDO = B.NRO_PEDIDO INNER JOIN ph_locales C ON A.NRO_LOCAL = C.NRO_LOCAL
        INNER JOIN ph_estado_pedidos D ON A.ESTADO = D.ID_ESTADO WHERE A.ESTADO IN (1, 2) GROUP BY A.FECHA_PED, A.TALON, A.NRO_LOCAL, A.NRO_PEDIDO ORDER BY FECHA_PED");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;
        
    }



    public function pendientesGustos(){
        $dbh = $this->cid;
        $stmt = $dbh->prepare("SELECT  
        B.COD_GUSTO, D.DESC_GUSTO, SUM(B.CANT_PED) CANT_PED, SUM(B.CANT_ENT) CANT_ENT, SUM(B.CANT_PENDI) CANT_PENDI
        FROM ph_pedidos_enc A 
        INNER JOIN ph_pedidos_det B ON A.NRO_LOCAL = B.NRO_LOCAL AND A.NRO_PEDIDO = B.NRO_PEDIDO 
        INNER JOIN ph_locales C ON A.NRO_LOCAL = C.NRO_LOCAL
        INNER JOIN ph_gustos D ON B.COD_GUSTO = D.COD_GUSTO
        WHERE A.ESTADO IN (1, 2) 
        GROUP BY B.COD_GUSTO, D.DESC_GUSTO ;");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;
        
    }





    public function pendientesTraerUno($nroPedido){
        $dbh = $this->cid;
        $stmt = $dbh->prepare("SELECT C.LOCAL NOMBRE_LOCAL, D.FECHA_PED, CAST(D.FECHA_PED+2 AS DATE) FECHA_ENTREGA, A.NRO_PEDIDO, A.COD_GUSTO, A.CANT_PED, A.CANT_ENT, A.CANT_PENDI, B.DESC_GUSTO
        FROM ph_pedidos_det A 
        INNER JOIN ph_gustos B ON A.COD_GUSTO = B.COD_GUSTO 
        INNER JOIN ph_locales C ON A.NRO_LOCAL = C.NRO_LOCAL 
        INNER JOIN ph_pedidos_enc D ON A.NRO_PEDIDO = D.NRO_PEDIDO
        WHERE A.NRO_PEDIDO = ?
        ORDER BY A.RENGLON");
        $stmt->bindParam(1, $nroPedido);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;
        
    }

    public function traerDetalleFiltrado($nroSucurs, $nroPedido){
        $dbh = $this->cid;
        $stmt = $dbh->prepare("SELECT A.NRO_LOCAL, A.NRO_PEDIDO, A.COD_GUSTO, B.DESC_GUSTO, A.CANT_PED, A.CANT_ENT FROM ph_pedidos_det A INNER JOIN ph_gustos B ON A.COD_GUSTO = B.COD_GUSTO WHERE A.NRO_LOCAL = ? AND A.NRO_PEDIDO = ?");
        $stmt->bindParam(1, $nroSucurs);
        $stmt->bindParam(2, $nroPedido);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;

    }

    public function buscarEstado($nroPedido){
        $dbh = $this->cid;
        $stmt = $dbh->prepare("SELECT ESTADO FROM ph_pedidos_enc WHERE NRO_PEDIDO = ?");
        $stmt->bindParam(1, $nroPedido);
        $stmt->execute();
        $dato = $stmt->fetchColumn(0); 

    }

    public function modificarEstado($nroPedido, $estado){
        $dbh = $this->cid;
        $stmt = $dbh->prepare("UPDATE ph_pedidos_enc SET ESTADO = ? WHERE NRO_PEDIDO = ?");
        $stmt->bindParam(1, $estado);
        $stmt->bindParam(2, $nroPedido);
        $stmt->execute();
    }

    public function actualizarCantidad($nroPedido){
        $dbh = $this->cid;
        $stmt = $dbh->prepare("UPDATE ph_pedidos_det SET CANT_ENT = CANT_PED, CANT_PENDI = 0 WHERE NRO_PEDIDO =  ?");
        $stmt->bindParam(1, $nroPedido);
        $stmt->execute();
    }

    public function actualizarCantidades($nroPedido, $codGusto, $cant){
        $dbh = $this->cid;
        $stmt = $dbh->prepare("UPDATE ph_pedidos_det SET CANT_ENT = ? WHERE NRO_PEDIDO =  ? AND COD_GUSTO = ?");
        $stmt->bindParam(1, $cant);
        $stmt->bindParam(2, $nroPedido);
        $stmt->bindParam(3, $codGusto);
        $stmt->execute();
    }


    public function armarPedidoTachoAux($nroPedido, $partida, $numTacho){
        $dbh = $this->cid;
        $stmt = $dbh->prepare("INSERT INTO ph_pedidos_tachos_armado_aux
        (NRO_LOCAL,  NRO_PEDIDO,  COD_GUSTO,   PESO,  PARTIDA,  NUM_TACHO)
        SELECT A.NRO_LOCAL, A.NRO_PEDIDO, B.COD_GUSTO, B.PESO, B.PARTIDA, B.NUM_TACHO 
        FROM ph_pedidos_enc A,
        ph_stock B
        WHERE NRO_PEDIDO = ? 
        AND PARTIDA = ?
        AND NUM_TACHO = ?");
        $stmt->bindParam(1, $nroPedido);
        $stmt->bindParam(2, $partida);
        $stmt->bindParam(3, $numTacho);

        $stmt->execute();
    }


    public function traerPedidoArmando($nroPedido){
        $dbh = $this->cid;
        $stmt = $dbh->prepare("SELECT A.COD_GUSTO, B.DESC_GUSTO, A.PARTIDA, A.NUM_TACHO, A.PESO 
        FROM ph_pedidos_tachos_armado_aux A
        INNER JOIN ph_gustos B
        ON A.COD_GUSTO = B.COD_GUSTO
        WHERE A.NRO_PEDIDO = ?");
        $stmt->bindParam(1, $nroPedido);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;

    }

    public function preConfirmarTachos($nroPedido){
        $dbh = $this->cid;
        $stmt = $dbh->prepare("SELECT A.COD_GUSTO, B.DESC_GUSTO, CANT_PED, CANT_ENT, CANT_PENDI, CANT_TACHOS
        FROM
        (
            SELECT COD_GUSTO, SUM(CANT_PED) CANT_PED, SUM(CANT_ENT) CANT_ENT, SUM(CANT_PENDI) CANT_PENDI, SUM(CANT_TACHOS) CANT_TACHOS
            FROM
            (
                SELECT A.COD_GUSTO, CANT_PED, CANT_ENT, CANT_PENDI, 0 CANT_TACHOS 
                FROM ph_pedidos_det A
                WHERE A.NRO_PEDIDO = ?
                UNION ALL
                SELECT A.COD_GUSTO, 0 CANT_PED, 0 CANT_ENT, 0 CANT_PENDI, COUNT(A.COD_GUSTO) CANT_TACHOS
                FROM ph_pedidos_tachos_armado_aux A
                WHERE A.NRO_PEDIDO = ?
                GROUP BY A.COD_GUSTO
            )A
            GROUP BY COD_GUSTO
        )A
        INNER JOIN ph_gustos B
        ON A.COD_GUSTO = B.COD_GUSTO");
        $stmt->bindParam(1, $nroPedido);
        $stmt->bindParam(2, $nroPedido);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;

    }

    public function actualizarCantidadesPedidoTacho($nroPedido){
        $dbh = $this->cid;
        $stmt = $dbh->prepare("UPDATE ph_pedidos_det A
        INNER JOIN
        (
        SELECT A.COD_GUSTO, B.DESC_GUSTO, CANT_PED, CANT_ENT, CANT_PENDI, CANT_TACHOS
        FROM
        (
            SELECT COD_GUSTO, SUM(CANT_PED) CANT_PED, SUM(CANT_ENT) CANT_ENT, SUM(CANT_PENDI) CANT_PENDI, SUM(CANT_TACHOS) CANT_TACHOS
            FROM
            (
                SELECT A.COD_GUSTO, CANT_PED, CANT_ENT, CANT_PENDI, 0 CANT_TACHOS 
                FROM ph_pedidos_det A
                WHERE A.NRO_PEDIDO = ?
                UNION ALL
                SELECT A.COD_GUSTO, 0 CANT_PED, 0 CANT_ENT, 0 CANT_PENDI, COUNT(A.COD_GUSTO) CANT_TACHOS
                FROM ph_pedidos_tachos_armado_aux A
                WHERE A.NRO_PEDIDO = ?
                GROUP BY A.COD_GUSTO
            )A
            GROUP BY COD_GUSTO
        )A
        INNER JOIN ph_gustos B
        ON A.COD_GUSTO = B.COD_GUSTO
        )B
        ON A.COD_GUSTO = B.COD_GUSTO
        SET A.CANT_ENT = A.CANT_ENT + B.CANT_TACHOS, A.CANT_PENDI = A.CANT_PENDI - B.CANT_TACHOS
        
        WHERE A.NRO_PEDIDO = ?");
        $stmt->bindParam(1, $nroPedido);
        $stmt->bindParam(2, $nroPedido);
        $stmt->bindParam(3, $nroPedido);

        $stmt->execute();
    }


    public function insertarTachosPedido($nroPedido){
        $dbh = $this->cid;
        $stmt = $dbh->prepare("INSERT INTO ph_pedidos_tachos_armado (FECHA, NRO_LOCAL, NRO_PEDIDO, COD_GUSTO, PESO, PARTIDA, NUM_TACHO)
        SELECT DATE_FORMAT(now(),'%Y/%m/%d'), NRO_LOCAL, NRO_PEDIDO, COD_GUSTO, PESO, PARTIDA, NUM_TACHO
        FROM ph_pedidos_tachos_armado_aux A
        WHERE A.NRO_PEDIDO = ?      
        ");
        $stmt->bindParam(1, $nroPedido);

        $stmt->execute();
    }


    public function tachosEnPedido($nroPedido){
        $dbh = $this->cid;
        $stmt = $dbh->prepare("
        SELECT A.*, B.DESC_GUSTO FROM ph_pedidos_tachos_armado A
        INNER JOIN ph_gustos B
        ON A.COD_GUSTO = B.COD_GUSTO
        WHERE NRO_PEDIDO = ?
        ");
        $stmt->bindParam(1, $nroPedido);
        
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;

    }



    public function pendientesOrdenados(){
        $dbh = $this->cid;
        $stmt = $dbh->prepare("
        SELECT COD_GUSTO, DESC_GUSTO, 
        sum(Villa_adelina) Villa_adelina, 
        sum(Munro) Munro, 
        sum(Olivos) Olivos, 
        sum(Caseros) Caseros, 
        sum(Villa_ballester) Villa_ballester, 
        sum(San_andres) San_andres, 
        sum(San_martin) San_martin, 
        sum(San_fernando) San_fernando, 
        sum(Santos_Lugares) Santos_Lugares, 
        sum(Martinez) Martinez, 
        sum(San_isidro) San_Isidro, 
        sum(Garin) Garin, 
        sum(Escobar) Escobar, 
        sum(Villa_Bosch) Villa_Bosch, 
        sum(Tigre) Tigre, 
        sum(San_Miguel) San_Miguel, 
        sum(Ramos_Mejia) Ramos_Mejia, 
        sum(Moron) Moron
        FROM
        (
        SELECT COD_GUSTO, DESC_GUSTO, CANT_PED Villa_adelina, 0 Munro, 0 Olivos, 0 Caseros, 0 Villa_ballester, 0 San_andres, 0 San_martin, 0 San_fernando, 0 Santos_Lugares, 0 Martinez, 0 San_Isidro, 0 Garin, 0 Escobar, 0 Villa_Bosch, 0 Tigre, 0 San_Miguel, 0 Ramos_Mejia, 0 Moron FROM PH_PEDIDOS_ABIERTOS WHERE NRO_LOCAL = 1
        UNION
        SELECT COD_GUSTO, DESC_GUSTO, 0 Villa_adelina, CANT_PED Munro, 0 Olivos, 0 Caseros, 0 Villa_ballester, 0 San_andres, 0 San_martin, 0 San_fernando, 0 Santos_Lugares, 0 Martinez, 0 San_Isidro, 0 Garin, 0 Escobar, 0 Villa_Bosch, 0 Tigre, 0 San_Miguel, 0 Ramos_Mejia, 0 Moron FROM PH_PEDIDOS_ABIERTOS WHERE NRO_LOCAL = 2
        UNION
        SELECT COD_GUSTO, DESC_GUSTO, 0 Villa_adelina, 0 Munro, CANT_PED Olivos, 0 Caseros, 0 Villa_ballester, 0 San_andres, 0 San_martin, 0 San_fernando, 0 Santos_Lugares, 0 Martinez, 0 San_Isidro, 0 Garin, 0 Escobar, 0 Villa_Bosch, 0 Tigre, 0 San_Miguel, 0 Ramos_Mejia, 0 Moron FROM PH_PEDIDOS_ABIERTOS WHERE NRO_LOCAL = 3
        UNION
        SELECT COD_GUSTO, DESC_GUSTO, 0 Villa_adelina, 0 Munro, 0 Olivos, CANT_PED Caseros, 0 Villa_ballester, 0 San_andres, 0 San_martin, 0 San_fernando, 0 Santos_Lugares, 0 Martinez, 0 San_Isidro, 0 Garin, 0 Escobar, 0 Villa_Bosch, 0 Tigre, 0 San_Miguel, 0 Ramos_Mejia, 0 Moron FROM PH_PEDIDOS_ABIERTOS WHERE NRO_LOCAL = 4
        UNION
        SELECT COD_GUSTO, DESC_GUSTO, 0 Villa_adelina, 0 Munro, 0 Olivos, 0 Caseros, CANT_PED Villa_ballester, 0 San_andres, 0 San_martin, 0 San_fernando, 0 Santos_Lugares, 0 Martinez, 0 San_Isidro, 0 Garin, 0 Escobar, 0 Villa_Bosch, 0 Tigre, 0 San_Miguel, 0 Ramos_Mejia, 0 Moron FROM PH_PEDIDOS_ABIERTOS WHERE NRO_LOCAL = 5
        UNION
        SELECT COD_GUSTO, DESC_GUSTO, 0 Villa_adelina, 0 Munro, 0 Olivos, 0 Caseros, 0 Villa_ballester, CANT_PED San_andres, 0 San_martin, 0 San_fernando, 0 Santos_Lugares, 0 Martinez, 0 San_Isidro, 0 Garin, 0 Escobar, 0 Villa_Bosch, 0 Tigre, 0 San_Miguel, 0 Ramos_Mejia, 0 Moron FROM PH_PEDIDOS_ABIERTOS WHERE NRO_LOCAL = 6
        UNION
        SELECT COD_GUSTO, DESC_GUSTO, 0 Villa_adelina, 0 Munro, 0 Olivos, 0 Caseros, 0 Villa_ballester, 0 San_andres, CANT_PED San_martin, 0 San_fernando, 0 Santos_Lugares, 0 Martinez, 0 San_Isidro, 0 Garin, 0 Escobar, 0 Villa_Bosch, 0 Tigre, 0 San_Miguel, 0 Ramos_Mejia, 0 Moron FROM PH_PEDIDOS_ABIERTOS WHERE NRO_LOCAL = 7
        UNION
        SELECT COD_GUSTO, DESC_GUSTO, 0 Villa_adelina, 0 Munro, 0 Olivos, 0 Caseros, 0 Villa_ballester, 0 San_andres, 0 San_martin, CANT_PED San_fernando, 0 Santos_Lugares, 0 Martinez, 0 San_Isidro, 0 Garin, 0 Escobar, 0 Villa_Bosch, 0 Tigre, 0 San_Miguel, 0 Ramos_Mejia, 0 Moron FROM PH_PEDIDOS_ABIERTOS WHERE NRO_LOCAL = 8
        UNION
        SELECT COD_GUSTO, DESC_GUSTO, 0 Villa_adelina, 0 Munro, 0 Olivos, 0 Caseros, 0 Villa_ballester, 0 San_andres, 0 San_martin, 0 San_fernando, CANT_PED Santos_Lugares, 0 Martinez, 0 San_Isidro, 0 Garin, 0 Escobar, 0 Villa_Bosch, 0 Tigre, 0 San_Miguel, 0 Ramos_Mejia, 0 Moron FROM PH_PEDIDOS_ABIERTOS WHERE NRO_LOCAL = 9
        UNION
        SELECT COD_GUSTO, DESC_GUSTO, 0 Villa_adelina, 0 Munro, 0 Olivos, 0 Caseros, 0 Villa_ballester, 0 San_andres, 0 San_martin, 0 San_fernando, 0 Santos_Lugares, CANT_PED Martinez, 0 San_Isidro, 0 Garin, 0 Escobar, 0 Villa_Bosch, 0 Tigre, 0 San_Miguel, 0 Ramos_Mejia, 0 Moron FROM PH_PEDIDOS_ABIERTOS WHERE NRO_LOCAL = 10
        UNION
        SELECT COD_GUSTO, DESC_GUSTO, 0 Villa_adelina, 0 Munro, 0 Olivos, 0 Caseros, 0 Villa_ballester, 0 San_andres, 0 San_martin, 0 San_fernando, 0 Santos_Lugares, 0 Martinez, CANT_PED San_Isidro, 0 Garin, 0 Escobar, 0 Villa_Bosch, 0 Tigre, 0 San_Miguel, 0 Ramos_Mejia, 0 Moron FROM PH_PEDIDOS_ABIERTOS WHERE NRO_LOCAL = 11
        UNION
        SELECT COD_GUSTO, DESC_GUSTO, 0 Villa_adelina, 0 Munro, 0 Olivos, 0 Caseros, 0 Villa_ballester, 0 San_andres, 0 San_martin, 0 San_fernando, 0 Santos_Lugares, 0 Martinez, 0 San_Isidro, CANT_PED Garin, 0 Escobar, 0 Villa_Bosch, 0 Tigre, 0 San_Miguel, 0 Ramos_Mejia, 0 Moron FROM PH_PEDIDOS_ABIERTOS WHERE NRO_LOCAL = 12
        UNION
        SELECT COD_GUSTO, DESC_GUSTO, 0 Villa_adelina, 0 Munro, 0 Olivos, 0 Caseros, 0 Villa_ballester, 0 San_andres, 0 San_martin, 0 San_fernando, 0 Santos_Lugares, 0 Martinez, 0 San_Isidro, 0 Garin, CANT_PED Escobar, 0 Villa_Bosch, 0 Tigre, 0 San_Miguel, 0 Ramos_Mejia, 0 Moron FROM PH_PEDIDOS_ABIERTOS WHERE NRO_LOCAL = 13
        UNION
        SELECT COD_GUSTO, DESC_GUSTO, 0 Villa_adelina, 0 Munro, 0 Olivos, 0 Caseros, 0 Villa_ballester, 0 San_andres, 0 San_martin, 0 San_fernando, 0 Santos_Lugares, 0 Martinez, 0 San_Isidro, 0 Garin, 0 Escobar, CANT_PED Villa_Bosch, 0 Tigre, 0 San_Miguel, 0 Ramos_Mejia, 0 Moron FROM PH_PEDIDOS_ABIERTOS WHERE NRO_LOCAL = 14
        UNION
        SELECT COD_GUSTO, DESC_GUSTO, 0 Villa_adelina, 0 Munro, 0 Olivos, 0 Caseros, 0 Villa_ballester, 0 San_andres, 0 San_martin, 0 San_fernando, 0 Santos_Lugares, 0 Martinez, 0 San_Isidro, 0 Garin, 0 Escobar, 0 Villa_Bosch, CANT_PED Tigre, 0 San_Miguel, 0 Ramos_Mejia, 0 Moron FROM PH_PEDIDOS_ABIERTOS WHERE NRO_LOCAL = 15
        UNION
        SELECT COD_GUSTO, DESC_GUSTO, 0 Villa_adelina, 0 Munro, 0 Olivos, 0 Caseros, 0 Villa_ballester, 0 San_andres, 0 San_martin, 0 San_fernando, 0 Santos_Lugares, 0 Martinez, 0 San_Isidro, 0 Garin, 0 Escobar, 0 Villa_Bosch, 0 Tigre, CANT_PED San_Miguel, 0 Ramos_Mejia, 0 Moron FROM PH_PEDIDOS_ABIERTOS WHERE NRO_LOCAL = 16
        UNION
        SELECT COD_GUSTO, DESC_GUSTO, 0 Villa_adelina, 0 Munro, 0 Olivos, 0 Caseros, 0 Villa_ballester, 0 San_andres, 0 San_martin, 0 San_fernando, 0 Santos_Lugares, 0 Martinez, 0 San_Isidro, 0 Garin, 0 Escobar, 0 Villa_Bosch, 0 Tigre, 0 San_Miguel, CANT_PED Ramos_Mejia, 0 Moron FROM PH_PEDIDOS_ABIERTOS WHERE NRO_LOCAL = 17
        UNION
        SELECT COD_GUSTO, DESC_GUSTO, 0 Villa_adelina, 0 Munro, 0 Olivos, 0 Caseros, 0 Villa_ballester, 0 San_andres, 0 San_martin, 0 San_fernando, 0 Santos_Lugares, 0 Martinez, 0 San_Isidro, 0 Garin, 0 Escobar, 0 Villa_Bosch, 0 Tigre, 0 San_Miguel, 0 Ramos_Mejia, CANT_PED Moron FROM PH_PEDIDOS_ABIERTOS WHERE NRO_LOCAL = 18
        )A
        group by COD_GUSTO, DESC_GUSTO;
        ");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;
        
    }

    public function pedidosGustoPorLocal($desde, $hasta){
        $dbh = $this->cid;
        $stmt = $dbh->prepare("
        select a.*, b.LOCAL, c.DESC_GUSTO from
        (
        select a.NRO_LOCAL, COD_GUSTO, sum(CANT_PED) CANT_PEDIDA 
        from ph_pedidos_enc a
        inner join ph_pedidos_det b on a.NRO_LOCAL = b.NRO_LOCAL and a.NRO_PEDIDO = b.NRO_PEDIDO
        where FECHA_PED between '{$desde}' and '{$hasta}'
        GROUP BY a.NRO_LOCAL, COD_GUSTO
        )a 
        inner join ph_locales b on a.NRO_LOCAL = b.NRO_LOCAL  
        inner join ph_gustos c on a.COD_GUSTO = c.COD_GUSTO
        ");
        
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;

    }    


}