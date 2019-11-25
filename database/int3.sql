.mode       columns
.headers    on
.nullvalue  NULL
PRAGMA foreign_keys = ON;

SELECT idCliente, Cidade.nome AS cidade, idHabitacao
FROM (Cliente NATURAL JOIN (Efetua NATURAL JOIN (Reserva NATURAL JOIN (Habitacao NATURAL JOIN Cidade)))) AS P
WHERE P.idCliente = 1 AND P.idCidade = 7 AND P.idEstado = 0
ORDER BY idHabitacao;