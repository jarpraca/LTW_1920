.mode       columns
.headers    on
.nullvalue  NULL
PRAGMA foreign_keys = ON;

SELECT idHabitacao, limpeza, valor, checkIn, localizacao
FROM (
    (SELECT limpeza, MAX(count), idHabitacao
    FROM (
        SELECT limpeza, COUNT(limpeza) AS count, idHabitacao
        FROM (ClassificacaoPorCliente NATURAL JOIN Reserva)
        WHERE idHabitacao = 6
        GROUP BY limpeza
    )),
    (SELECT valor, MAX(count)
    FROM (
        SELECT valor, COUNT(valor) AS count
        FROM (ClassificacaoPorCliente NATURAL JOIN Reserva)
        WHERE idHabitacao = 6
        GROUP BY valor
    )),
    (SELECT checkIn, MAX(count)
    FROM (
        SELECT checkIn, COUNT(checkIn) AS count
        FROM (ClassificacaoPorCliente NATURAL JOIN Reserva)
        WHERE idHabitacao = 6
        GROUP BY checkIn
    )),
    (SELECT localizacao, MAX(count)
    FROM (
        SELECT localizacao, COUNT(localizacao) AS count
        FROM (ClassificacaoPorCliente NATURAL JOIN Reserva)
        WHERE idHabitacao = 6
        GROUP BY localizacao
    ))
);
