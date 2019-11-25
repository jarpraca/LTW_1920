.mode       columns
.headers    on
.nullvalue  NULL
PRAGMA foreign_keys = ON;

SELECT * FROM ClassificacaoPorCliente WHERE idReserva = 3;
insert into ClassificacaoPorCliente(limpeza, valor, checkIn, localizacao, outros, classificacaoAnfitriao, descricaoAnfitriao, idCliente, idReserva ) values (5,4,4,3,NULL,4,"Anfitriao atencioso e preocupado", 4, 5);
SELECT * FROM ClassificacaoPorCliente WHERE idReserva = 3;
