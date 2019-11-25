PRAGMA foreign_keys = ON;

CREATE TRIGGER Restricao_Estado
BEFORE INSERT ON ClassificacaoPorCliente
FOR EACH ROW
WHEN exists (SELECT * FROM Reserva WHERE Reserva.idReserva = New.idReserva AND Reserva.idEstado != 0)
BEGIN
    SELECT RAISE(ROLLBACK, '<A reserva que pretende classificar ainda nao se encontra concluida>');
END;