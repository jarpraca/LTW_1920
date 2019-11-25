.mode       columns
.headers    on
.nullvalue  NULL
PRAGMA foreign_keys = ON;

SELECT *
FROM Reserva NATURAL JOIN Efetua
WHERE idCliente = 1 AND idEstado = 1
ORDER BY dataCheckIn;