<?php

function getHabitationsCity($city, $type, $minNumberGuests, $minNumberBedroom, $minPriceNight, $maxPriceNight){
    global $db;
    $stmt = $db->prepare('SELECT Habitacao.* FROM Habitacao JOIN cidade USING (idCidade)
    WHERE cidade.nome = ? AND idTipo like ? AND Habitacao.maxHospedes >= ? AND Habitacao.numQuartos >= ? AND Habitacao.precoNoite >= ? AND Habitacao.precoNoite <= ?');
    $stmt->execute(array($city, $type, $minNumberGuests, $minNumberBedroom, $minPriceNight, $maxPriceNight));
    return $stmt->fetchAll();
}

function getHabitationsCountry($country, $type, $minNumberGuests, $minNumberBedroom, $minPriceNight, $maxPriceNight){
    global $db;
    $stmt = $db->prepare('SELECT Habitacao.* FROM Habitacao JOIN cidade USING (idCidade) JOIN Pais USING (idPais) JOIN TipoDeHabitacao USING (idTipo) 
    WHERE Pais.nome = ? AND idTipo like ? AND Habitacao.maxHospedes >= ? AND Habitacao.numQuartos >= ? AND Habitacao.precoNoite >= ? AND Habitacao.precoNoite <= ?');
    $stmt->execute(array($country, $type, $minNumberGuests, $minNumberBedroom, $minPriceNight, $maxPriceNight));
    return $stmt->fetchAll();
}

function getHabitationsHabitationName($name, $type, $minNumberGuests, $minNumberBedroom, $minPriceNight, $maxPriceNight){
    global $db;
    $stmt = $db->prepare('SELECT Habitacao.* FROM Habitacao JOIN TipoDeHabitacao USING (idTipo) 
    WHERE Habitacao.nome like ? AND idTipo like ? AND Habitacao.maxHospedes >= ? AND Habitacao.numQuartos >= ? AND Habitacao.precoNoite >= ? AND Habitacao.precoNoite <= ?');
    $stmt->execute(array("%$name%", $type, $minNumberGuests, $minNumberBedroom, $minPriceNight, $maxPriceNight));
    return $stmt->fetchAll();
}

function getHabitations($location, $type, $minNumberGuests, $minNumberBedroom, $minPriceNight, $maxPriceNight){
    if($type == null)
        $type = "%";

    if($minNumberGuests == null)
        $minNumberGuests = 1;

    if($minNumberBedroom == null)
        $minNumberBedroom = 1;

    if($minPriceNight == null)
        $minPriceNight = 0;

    if($maxPriceNight == null)
        $maxPriceNight = 99999;

    $habitations = array_merge(getHabitationsCity($location, $type, $minNumberGuests, $minNumberBedroom, $minPriceNight, $maxPriceNight), 
    getHabitationsCountry($location, $type, $minNumberGuests, $minNumberBedroom, $minPriceNight, $maxPriceNight), 
    getHabitationsHabitationName($location, $type, $minNumberGuests, $minNumberBedroom, $minPriceNight, $maxPriceNight));

    return array_unique($habitations, SORT_REGULAR);
}

function getProperties($user_id){
    global $db;
    $stmt = $db->prepare('SELECT * FROM Habitacao WHERE idUtilizador = ?');
    $stmt->execute(array($user_id));
    return $stmt->fetchAll();
}

function getReservationsByClient($user_id){
    global $db;
    $stmt = $db->prepare('SELECT idReserva FROM Reserva WHERE idUtilizador = ?');
    $stmt->execute(array($user_id));
    return $stmt->fetchAll();
}

function getReservationsByProperty($id){
    global $db;
    $stmt = $db->prepare('SELECT idReserva FROM Reserva WHERE idHabitacao = ?');
    $stmt->execute(array($id));
    return $stmt->fetchAll();
}

function getReservationById($id){
    global $db;
    $stmt = $db->prepare('SELECT * FROM Reserva WHERE idReserva = ?');
    $stmt->execute(array($id));
    return $stmt->fetch();
}

include_once("users.php");

function insertHabitation($name, $numQuartos, $maxHospedes, $morada, $precoNoite, $taxaLimpeza, $pais, $cidade, $tipo, $politica, $descricao, $idUser){
    global $db;

    $stmt = $db->prepare('SELECT idCidade FROM Cidade WHERE nome=? and idPais=?');
    $stmt->execute(array($cidade, $pais));
    $idCidade=$stmt->fetch()['idCidade'];
    if($idCidade == null){
        $stmt = $db->prepare('INSERT INTO Cidade(nome, idPais) VALUES(?, ?)');
        $stmt->execute(array($cidade, $pais));
        $idCidade = $db->lastInsertId();
    }

    $stmt = $db->prepare('INSERT INTO Habitacao(nome, numQuartos, maxHospedes, morada, precoNoite, taxaLimpeza, idCidade, idTipo, idPolitica, descricao, idUtilizador) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($name, $numQuartos, $maxHospedes, $morada, $precoNoite, $taxaLimpeza, $idCidade, $tipo, $politica, $descricao, $idUser));
    
    $id=$db->lastInsertId();
    return $id;
}

function removeHabitation($id){
    global $db;
    $stmt = $db->prepare('DELETE FROM Habitacao WHERE idHabitacao = ?');
    $stmt = $db->execute(array($id));
}

function updateHabitation($id, $name, $numQuartos, $maxHospedes, $morada, $precoNoite, $taxaLimpeza, $pais, $cidade, $tipo, $politica, $descricao){
    global $db;

    $stmt = $db->prepare('SELECT idCidade FROM Cidade WHERE nome=? and idPais=?');
    $stmt->execute(array($cidade, $pais));
    $idCidade=$stmt->fetch()['idCidade'];
    if($idCidade == null){
        $stmt = $db->prepare('INSERT INTO Cidade(nome, idPais) VALUES(?, ?)');
        $stmt->execute(array($cidade, $pais));
        $idCidade = $db->lastInsertId();
    }
    $stmt = $db->prepare('UPDATE Habitacao SET nome=?, numQuartos=?, maxHospedes=?, morada=?, precoNoite=?, taxaLimpeza=?, idCidade=?, idTipo=?, idPolitica=?, descricao=? WHERE idHabitacao=?');
    $stmt->execute(array($name, $numQuartos, $maxHospedes, $morada, $precoNoite, $taxaLimpeza, $idCidade, $tipo, $politica, $descricao, $id));
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
    $stmt = $db->prepare('SELECT percentagemReembolso FROM (PoliticaDeCancelamento JOIN Habitacao USING (idPolitica)) JOIN Reserva USING (idHabitacao) WHERE idReserva = ?');
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

function getHabitationById($id){
    global $db;
    $stmt = $db->prepare('SELECT * FROM Habitacao WHERE idHabitacao=?');
    $stmt->execute(array($id));

    return $stmt->fetch();
}
function getHabitationId($nome){
    global $db;
    $stmt = $db->prepare('SELECT * FROM Habitacao WHERE idHabitacao=?');
    $stmt->execute(array($id));

    return $stmt->fetch();
}

function getNameType($id){
    global $db;
    $stmt = $db->prepare('SELECT nome FROM TipoDeHabitacao WHERE idTipo=?');
    $stmt->execute(array($id));

    return $stmt->fetch();
}

function getTypeById($id){
    global $db;
    $stmt = $db->prepare('SELECT * FROM TipoDeHabitacao WHERE idTipo=?');
    $stmt->execute(array($id));

    return $stmt->fetch();
}

function getTypeId($name){
    global $db;
    $stmt = $db->prepare('SELECT idTipo FROM TipoDeHabitacao WHERE nome=?');
    $stmt->execute(array($name));

    return $stmt->fetch();
}

function getPolicy($id){
    global $db;
    $stmt = $db->prepare('SELECT * FROM PoliticaDeCancelamento WHERE idPolitica=?');
    $stmt->execute(array($id));

    return $stmt->fetch();
}

function getPolicyId($nome){
    global $db;
    $stmt = $db->prepare('SELECT idPolitica FROM PoliticaDeCancelamento WHERE nome=?');
    $stmt->execute(array($nome));

    return $stmt->fetch();
}

function getNameCity($id){
    global $db;
    $stmt = $db->prepare('SELECT nome FROM Cidade WHERE idCidade=?');
    $stmt->execute(array($id));

    return $stmt->fetch()['nome'];
}

function getCityById($id){
    global $db;
    $stmt = $db->prepare('SELECT * FROM Cidade WHERE idCidade=?');
    $stmt->execute(array($id));

    return $stmt->fetch();
}

function getCityId($name){
    global $db;
    $stmt = $db->prepare('SELECT idCidade FROM Cidade WHERE nome=?');
    $stmt->execute(array($name));

    return $stmt->fetch();
}

function getCountryCity($idCity){
    global $db;
    $stmt = $db->prepare('SELECT idPais FROM Cidade JOIN Pais USING (idPais) WHERE idCidade=?');
    $stmt->execute(array($idCity));

    return $stmt->fetch()['idPais'];
}

function getImagesProperty($id){
    global $db;
    $stmt = $db->prepare('SELECT * FROM Imagem WHERE idHabitacao=?');
    $stmt->execute(array($id));

    return $stmt->fetchAll();
}

function getAmenities($idHabitacao){
    global $db;
    $stmt = $db->prepare('SELECT nome FROM Comodidade JOIN Dispoe USING (idComodidade) WHERE idHabitacao=?');
    $stmt->execute(array($idHabitacao));

    return $stmt->fetchAll();
}

function getOwner($idHabitation){
    global $db;
    $stmt = $db->prepare('SELECT idUtilizador FROM Habitacao JOIN Utilizador USING (idUtilizador) WHERE idHabitacao=?');
    $stmt->execute(array($idHabitation));

    return $stmt->fetch();
}

/*function getUserPicture($idUser){
    global $db;
    $stmt = $db->prepare('SELECT  FROM Utilizador WHERE idUtilizador=?');
    $stmt->execute(array($idHabitation));

    return $stmt->fetch();
}*/

function getComments($idHabitation){
    global $db;
    $stmt = $db->prepare('SELECT idUtilizador FROM ClassificacaoPorCliente JOIN Reserva USING (idReserva) WHERE idHabitacao=?');
    $stmt->execute(array($idHabitation));

    return $stmt->fetchAll();
}

function getClientReservation($idReservation){
    global $db;
    $stmt = $db->prepare('SELECT idUtilizador FROM Reserva WHERE idReserva=?');
    $stmt->execute(array($idReservation));

    return $stmt->fetch();
}

function getHabitationPictures($id){
    global $db;
    $stmt = $db->prepare('SELECT * FROM Imagem WHERE idHabitacao=?');
    $stmt->execute(array($id));

    return $stmt->fetchAll();
}

?>