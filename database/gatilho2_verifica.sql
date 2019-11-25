.mode       columns
.headers    on
.nullvalue  NULL
PRAGMA foreign_keys = ON;

SELECT classificacaoAnfitriao FROM Anfitriao WHERE idAnfitriao = 2;
SELECT classificacaoHabitacao FROM Habitacao WHERE idHabitacao = 7;
insert into ClassificacaoPorCliente(limpeza, valor, checkIn, localizacao, outros, classificacaoAnfitriao, descricaoAnfitriao, idReserva, idCliente) values (5,4,4,3,NULL,5,"Anfitriao bastante atencioso, acompanhou de perto a nossa estadia tendo-nos feito sentir confortaveis e em casa. Recomendo vivamente.", 14, 3);
SELECT classificacaoAnfitriao FROM Anfitriao WHERE idAnfitriao = 2;
SELECT classificacaoHabitacao FROM Habitacao WHERE idHabitacao = 7;
insert into ClassificacaoPorCliente(limpeza, valor, checkIn, localizacao, outros, classificacaoAnfitriao, descricaoAnfitriao, idReserva, idCliente) values (3,5,5,2,NULL,2,"Anfitriao bastante conflituoso, não regressarei a nenhuma das suas habitações.", 15, 5);
SELECT classificacaoAnfitriao FROM Anfitriao WHERE idAnfitriao = 2;
SELECT classificacaoHabitacao FROM Habitacao WHERE idHabitacao = 7;
