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

?>