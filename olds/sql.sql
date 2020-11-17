
/*
SELECT CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END DIA;
SELECT * FROM PH_DIAS_ENTREGA WHERE NRO_LOCAL = 9;

ID_ALUMNO int NOT NULL AUTO_INCREMENT primary KEY,
*/

DELIMITER //

CREATE PROCEDURE TRAER_PROX_FECHA(
	IN VAR_LOCAL INT
)
BEGIN
	


SELECT 
CASE 
/*LUNES*/
	WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 0 AND MIERCOLES = 1 THEN 'MIERCOLES'
	WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 0 AND JUEVES = 1 THEN 'JUEVES'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 0 AND VIERNES = 1 THEN 'VIERNES'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 0 AND SABADO = 1 THEN 'SABADO'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 0 AND DOMINGO = 1 THEN 'DOMINGO'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 0 AND LUNES = 1 THEN 'LUNES, PROXIMA SEMANA'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 0 AND MARTES = 1 THEN 'MARTES, PROXIMA SEMANA'
/*MARTES*/
	WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 1 AND JUEVES = 1 THEN 'JUEVES'
	WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 1 AND VIERNES = 1 THEN 'VIERNES'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 1 AND SABADO = 1 THEN 'SABADO'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 1 AND DOMINGO = 1 THEN 'DOMINGO'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 1 AND LUNES = 1 THEN 'LUNES'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 1 AND MARTES = 1 THEN 'MARTES, PROXIMA SEMANA'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 1 AND MIERCOLES = 1 THEN 'MIERCOLES, PROXIMA SEMANA'
/*MIERCOLES*/
	WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 2 AND VIERNES = 1 THEN 'VIERNES'
	WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 2 AND SABADO = 1 THEN 'SABADO'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 2 AND DOMINGO = 1 THEN 'DOMINGO'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 2 AND LUNES = 1 THEN 'LUNES'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 2 AND MARTES = 1 THEN 'MARTES'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 2 AND MIERCOLES = 1 THEN 'MIERCOLES, PROXIMA SEMANA'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 2 AND JUEVES = 1 THEN 'JUEVES, PROXIMA SEMANA'
/*JUEVES*/
	WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 3 AND SABADO = 1 THEN 'SABADO'
	WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 3 AND DOMINGO = 1 THEN 'DOMINGO'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 3 AND LUNES = 1 THEN 'LUNES'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 3 AND MARTES = 1 THEN 'MARTES'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 3 AND MIERCOLES = 1 THEN 'MIERCOLES'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 3 AND JUEVES = 1 THEN 'JUEVES, PROXIMA SEMANA'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 3 AND VIERNES = 1 THEN 'VIERNES, PROXIMA SEMANA'
/*VIERNES*/
	WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 4 AND DOMINGO = 1 THEN 'DOMINGO'
	WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 4 AND LUNES = 1 THEN 'LUNES'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 4 AND MARTES = 1 THEN 'MARTES'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 4 AND MIERCOLES = 1 THEN 'MIERCOLES'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 4 AND JUEVES = 1 THEN 'JUEVES'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 4 AND VIERNES = 1 THEN 'VIERNES, PROXIMA SEMANA'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 4 AND SABADO = 1 THEN 'SABADO, PROXIMA SEMANA'
/*SABADO*/
	WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 5 AND LUNES = 1 THEN 'LUNES'
	WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 5 AND MARTES = 1 THEN 'MARTES'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 5 AND MIERCOLES = 1 THEN 'MIERCOLES'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 5 AND JUEVES = 1 THEN 'JUEVES'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 5 AND VIERNES = 1 THEN 'VIERNES'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 5 AND SABADO = 1 THEN 'SABADO, PROXIMA SEMANA'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 5 AND DOMINGO = 1 THEN 'DOMINGO, PROXIMA SEMANA'
/*DOMINGO*/
	WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 6 AND MARTES = 1 THEN 'MARTES'
	WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 6 AND MIERCOLES = 1 THEN 'MIERCOLES'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 6 AND JUEVES = 1 THEN 'JUEVES'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 6 AND VIERNES = 1 THEN 'VIERNES'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 6 AND SABADO = 1 THEN 'SABADO'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 6 AND DOMINGO = 1 THEN 'DOMINGO, PROXIMA SEMANA'
    WHEN (CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END) = 6 AND LUNES = 1 THEN 'LUNES, PROXIMA SEMANA'
END PROX_ENTREGA
FROM PH_DIAS_ENTREGA 
WHERE NRO_LOCAL = VAR_LOCAL;

END //

DELIMITER ;

CALL TRAER_PROX_FECHA(9);