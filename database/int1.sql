PRAGMA foreign_keys = ON;

.mode	columns
.headers	on
.nullvalue	NULL

SELECT idHabitacao, data
FROM Disponivel
order by idHabitacao;