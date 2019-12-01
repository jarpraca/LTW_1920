<?php

function getHabitationsCity($city){
    global $db;
    $stmt = $db->prepare('SELECT * FROM habitation JOIN cidade USING idCidade WHERE cidade.nome = ?');
    $stmt->execute(array($city));
    return $stmt->fetchAll();
}

function getHabitationsCountry($country){
    global $db;
    $stmt = $db->prepare('SELECT * FROM habitation JOIN cidade USING idCidade) JOIN Pais using idPais WHERE pais.nome = ?');
    $stmt->execute(array($country));
    return $stmt->fetchAll();
}

function getHabitationsHabitationName($name){
    global $db;
    $stmt = $db->prepare('SELECT * FROM habitation WHERE nome = ?');
    $stmt->execute(array($name));
    return $stmt->fetchAll();
}

function getHabitation($name){
    return array_merge(getHabitationsCity($name), getHabitationsCountry($name), getHabitationsHabitationName($name));
}

function getProperties($user_id){
    global $db;
    $stmt = $db->prepare('SELECT * FROM Habitation JOIN Possui USING IdHabitacao WHERE idAnfitriao = ?;');
    $stmt->execute(array($user_id));
    return $stmt->fetchAll();
}

function getReservations($user_id){
    global $db;
    $stmt = $db->prepare('SELECT * FROM (Habitation JOIN Reserva USING IdHabitacao) JOIN Efetua USING idReserva WHERE idCliente = ?');
    $stmt->execute(array($user_id));
    return $stmt->fetchAll();
}

function insertHabitation($idHab, $name, $numQuartos, $maxHospedes, $morada, $precoNoite, $taxaLimpeza, $nome_cidade, $nomeTipo, $nomePolitica, $descricao, $idUser){
    global $db;
    $stmt = $db->prepare('SELECT idCidade FROM Cidade WHERE nome = ?;');
    $stmt = $db->execute(array($nome_cidade));
    $idCidade = $stmt->fetch();

    $stmt = $db->prepare('SELECT idTipo FROM TipoHabitacao WHERE nome = ?;');
    $stmt = $db->execute(array($nomeTipo));
    $idTipo = $stmt->fetch();

    $stmt = $db->prepare('SELECT idPolitica FROM PoliticaDeCancelamento WHERE nome = ?;');
    $stmt = $db->execute(array($nomePolitica));
    $idPolitica = $stmt->fetch();

    $stmt = $db->prepare('INSERT INTO Habitacao(idHabitacao, nome, numQuartos, maxHospedes,morada, precoNoite, taxaLimpeza, classificacaoHabitacao, idCidade, idTipo, idPolitica, descricao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
    $stmt = $db->execute(array($idHab, $name, $numQuartos, $maxHospedes, $morada, $precoNoite, $taxaLimpeza, $idCidade, $idTipo, $idPolitica, $descricao));
    
    $stmt = $db->prepare('INSERT INTO Possui(idAnfitriao, idHabitacao) values (?, ?);');
    $stmt = $db->execute(array($idAnfitriao, $idHabitacao));
}

function removeHabitation($id){
    global $db;
    $stmt = $db->prepare('DELETE FROM Habitacao WHERE idHabitacao = ?');
    $stmt = $db->execute(array($id));
}

function addImage($idHab, $url, $description){
    global $db;
    $stmt = $db->prepare('INSERT INTO Imagem(insert into Imagem(urlImagem,legenda, idHabitacao) values (?, ?, ?);');
    $stmt = $db->execute(array($url, $description, $idHab));
}

function reserve($idRes, $idHab, $idUser, $dataCheckIn, $dataCheckOut, $numHospedes, $precoTotal){
    global $db;
    $stmt = $db->prepare('INSERT INTO Reserva(idReserva, dataCheckIn, dataCheckOut, numHospedes, precoTotal, idHabitacao, idEstado) VALUES (?, ?, ?, ?, ?, ?, 0);');
    $stmt = $db->execute(array($idRes, $dataCheckIn, $dataCheckOut, $numHospedes, $precoTotal, $idHab));
    $stmt = $db->prepare('INSERT INTO Efetua(idCliente, idReserva) VALUES (?, ?)');
    $stmt = $db->execute(array($idUser, $idRes));
}

function cancelReservation($idRes){
    global $db;
    $stmt = $db->prepare('UPDATE Reserva SET idEstado=3 WHERE idRes = ?');
    $stmt = $db->execute(array($idRes));
    $stmt = $db->prepare('SELECT percentagemReembolso FROM (PoliticaDeCancelamento JOIN Habitacao USING idPolitica) JOIN Reserva USING idHabitacao WHERE idReserva = ?');
    $stmt = $db->execute(array($idRes));
    $reembolso = $stmt->fetch();
    $stmt = $db->prepare('SELECT precoTotal FROM Reserva WHERE idReserva = ?');
    $stmt = $db->execute(array($idRes));
    $price = $stmt->fetch();
    $stmt = $db->prepare('INSERT INTO Cancelamento(reembolso, idReserva) VALUES (?, ?)');
    $stmt = $db->execute(array($idRes, $price * $reembolso));
}

function addComment($idRes, $limpeza, $valor, $checkIn, $localizacao, $description){
    global $db;
    $stmt = $db->prepare('INSERT INTO ClassificacaoPorCliente(limpeza, valor, checkIn, localizacao, outros, idReserva) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt = $db->execute(array($limpeza, $valor, $checkIn, $localizacao, $description, $idRes));
}

function getTypes(){
    global $db;
    $stmt = $db->prepare('SELECT * FROM TipoDeHabitacao');
    $stmt->execute();

    return $stmt->fetchAll();
}

function getCancellationPolicys(){
    global $db;
    $stmt = $db->prepare('SELECT * FROM PoliticaDeCancelamento');
    $stmt->execute();

    return $stmt->fetchAll();
}

?>