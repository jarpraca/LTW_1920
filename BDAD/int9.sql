.mode       columns
.headers    on
.nullvalue  NULL
PRAGMA foreign_keys = ON;

SELECT H1.idHabitacao AS idH1, H1.numQuartos, TipoDeHabitacao.nome AS tipo, Cidade.nome AS cidade, H2.idHabitacao AS idH2, H2.numQuartos, TipoDeHabitacao.nome AS tipo, Cidade.nome AS cidade
FROM (Habitacao H1 JOIN Habitacao H2 USING(numQuartos, idCidade, idTipo)), Cidade, TipoDeHabitacao
WHERE H1.idHabitacao > H2.idHabitacao AND H1.idTipo = TipoDeHabitacao.idTipo AND H1.idCidade = Cidade.idCidade;
