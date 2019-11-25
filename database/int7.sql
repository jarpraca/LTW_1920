PRAGMA foreign_keys = ON;

.mode	columns
.headers	on
.nullvalue	NULL

SELECT mes , cidade, max(sum) AS numReservas
FROM (SELECT strftime('%m', dataCheckIn) AS mes, Cidade.nome AS cidade, count(*) AS sum
      FROM  Cidade NATURAL JOIN (Reserva NATURAL JOIN Habitacao)
      GROUP BY  mes, cidade)
GROUP BY mes;
