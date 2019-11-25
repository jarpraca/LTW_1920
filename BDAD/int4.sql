PRAGMA foreign_keys = ON;

.mode	columns
.headers	on
.nullvalue	NULL

SELECT DISTINCT idHabitacao, maxHospedes, Cidade.nome AS cidade, (precoNoite*(JulianDay('2019-07-30') - JulianDay('2019-07-25')) + taxaLimpeza) AS precoT
FROM (Cidade NATURAL JOIN (Habitacao NATURAL JOIN Disponivel)) AS P
WHERE P.idCidade = 7 AND maxHospedes >= 2 AND data >= '2019-07-25' AND data <= '2019-07-30'
ORDER BY precoT;