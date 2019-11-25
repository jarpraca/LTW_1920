PRAGMA foreign_keys = ON;

.mode	columns
.headers	on
.nullvalue	NULL

SELECT idHabitacao, idReserva, limpeza, valor, checkIn, localizacao, outros
FROM  ClassificacaoPorCliente NATURAL JOIN Reserva
WHERE idHabitacao = 1
order by idReserva;