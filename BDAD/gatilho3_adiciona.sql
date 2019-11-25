PRAGMA foreign_keys = ON;

CREATE TRIGGER Disponibilidade
AFTER INSERT ON Reserva
FOR EACH ROW
BEGIN
    DELETE FROM Disponivel
    WHERE Disponivel.idHabitacao = New.idHabitacao AND Disponivel.data >= New.dataCheckIn AND Disponivel.data <= New.dataCheckOut;
END;