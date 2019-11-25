.mode       columns
.headers    on
.nullvalue  NULL
PRAGMA foreign_keys = ON;

SELECT idCliente
FROM Cliente
WHERE idCliente NOT IN(
    SELECT idCliente 
    FROM Reserva NATURAL JOIN Efetua
    WHERE idEstado != 3
) AND EXISTS (
    SELECT idCliente
    FROM (Reserva NATURAL JOIN Efetua) AS E
    WHERE E.idCliente = Cliente.idCliente
);