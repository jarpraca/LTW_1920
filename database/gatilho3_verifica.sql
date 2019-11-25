.mode       columns
.headers    on
.nullvalue  NULL
PRAGMA foreign_keys = ON;

SELECT data FROM Disponivel WHERE idHabitacao = 1;
INSERT INTO Reserva(idReserva, dataCheckIn, dataCheckOut, numHospedes, precoTotal, idHabitacao, idEstado) VALUES (100, '2019-07-20', '2019-07-27', 6, 260, 1, 1);
SELECT data FROM Disponivel WHERE idHabitacao = 1; 
