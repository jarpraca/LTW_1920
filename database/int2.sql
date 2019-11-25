PRAGMA foreign_keys = ON;

.mode	columns
.headers	on
.nullvalue	NULL

SELECT idAnfitriao, idHabitacao
FROM (Possui NATURAL JOIN Habitacao)
WHERE idAnfitriao = 1
order by idHabitacao;