PRAGMA foreign_keys = ON;

CREATE TRIGGER Classificacao
AFTER INSERT ON ClassificacaoPorCliente
FOR EACH ROW
BEGIN
    UPDATE Anfitriao
    SET classificacaoAnfitriao = (
        SELECT AVG(classificacaoAnfitriao)
        FROM (ClassificacaoPorCliente NATURAL JOIN (Reserva NATURAL JOIN (Habitacao NATURAL JOIN Possui))) AS E
        WHERE E.idAnfitriao = Anfitriao.idAnfitriao
    )
    WHERE Anfitriao.idAnfitriao = (SELECT idAnfitriao FROM Possui WHERE Possui.idHabitacao = (SELECT idHabitacao FROM Reserva WHERE Reserva.idReserva = New.idReserva));

    UPDATE Habitacao
    SET classificacaoHabitacao = (
        (
        (SELECT AVG(limpeza)
        FROM (ClassificacaoPorCliente NATURAL JOIN Reserva) AS E
        WHERE E.idHabitacao = Habitacao.idHabitacao)
        +
        (SELECT AVG(valor)
        FROM (ClassificacaoPorCliente NATURAL JOIN Reserva) AS E
        WHERE E.idHabitacao = Habitacao.idHabitacao)
        +
        (SELECT AVG(checkIn)
        FROM (ClassificacaoPorCliente NATURAL JOIN Reserva) AS E
        WHERE E.idHabitacao = Habitacao.idHabitacao)
        +
        (SELECT AVG(localizacao)
        FROM (ClassificacaoPorCliente NATURAL JOIN Reserva) AS E
        WHERE E.idHabitacao = Habitacao.idHabitacao)
        ) / 4
    )
    WHERE Habitacao.idHabitacao = (SELECT idHabitacao FROM Reserva WHERE Reserva.idReserva = New.idReserva);
END;