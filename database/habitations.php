<?php

function getHabitationsCity($city, $type, $minNumberGuests, $minNumberBedroom, $minPriceNight, $maxPriceNight){
    global $db;
    $stmt = $db->prepare('SELECT Habitacao.* FROM Habitacao JOIN cidade USING (idCidade)
    WHERE cidade.nome = ? AND idTipo like ? AND Habitacao.maxHospedes >= ? AND Habitacao.numQuartos >= ? AND Habitacao.precoNoite >= ? AND Habitacao.precoNoite <= ? ORDER BY nome');
    $stmt->execute(array($city, $type, $minNumberGuests, $minNumberBedroom, $minPriceNight, $maxPriceNight));
    return $stmt->fetchAll();
}

function getHabitationsCountry($country, $type, $minNumberGuests, $minNumberBedroom, $minPriceNight, $maxPriceNight){
    global $db;
    $stmt = $db->prepare('SELECT Habitacao.* FROM Habitacao JOIN cidade USING (idCidade) JOIN Pais USING (idPais) JOIN TipoDeHabitacao USING (idTipo) 
    WHERE Pais.nome = ? AND idTipo like ? AND Habitacao.maxHospedes >= ? AND Habitacao.numQuartos >= ? AND Habitacao.precoNoite >= ? AND Habitacao.precoNoite <= ? ORDER BY nome');
    $stmt->execute(array($country, $type, $minNumberGuests, $minNumberBedroom, $minPriceNight, $maxPriceNight));
    return $stmt->fetchAll();
}

function getHabitationsHabitationName($name, $type, $minNumberGuests, $minNumberBedroom, $minPriceNight, $maxPriceNight){
    global $db;
    $stmt = $db->prepare('SELECT Habitacao.* FROM Habitacao JOIN TipoDeHabitacao USING (idTipo) 
    WHERE Habitacao.nome like ? AND idTipo like ? AND Habitacao.maxHospedes >= ? AND Habitacao.numQuartos >= ? AND Habitacao.precoNoite >= ? AND Habitacao.precoNoite <= ? ORDER BY nome');
    $stmt->execute(array("%$name%", $type, $minNumberGuests, $minNumberBedroom, $minPriceNight, $maxPriceNight));
    return $stmt->fetchAll();
}

function getHabitations($location, $type, $minNumberGuests, $minNumberBedroom, $minPriceNight, $maxPriceNight, $dateFrom, $dateTo){
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

    $habitationsAux = array_merge(getHabitationsCity($location, $type, $minNumberGuests, $minNumberBedroom, $minPriceNight, $maxPriceNight), 
    getHabitationsCountry($location, $type, $minNumberGuests, $minNumberBedroom, $minPriceNight, $maxPriceNight), 
    getHabitationsHabitationName($location, $type, $minNumberGuests, $minNumberBedroom, $minPriceNight, $maxPriceNight));

    $habitations = [];
    foreach($habitationsAux as $habitation) {
        if(isAvailable($habitation['idHabitacao'], $dateFrom, $dateTo))
            $habitations[] = $habitation;
    }    
    return array_unique($habitations, SORT_REGULAR);
}

function getProperties($user_id){
    global $db;
    $stmt = $db->prepare('SELECT * FROM Habitacao WHERE idUtilizador = ? ORDER BY nome');
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

function insertHabitation($name, $numQuartos, $maxHospedes, $morada, $precoNoite, $taxaLimpeza, $pais, $cidade, $tipo, $politica, $descricao, $latitude, $longitude, $idUser){
    global $db;

    $stmt = $db->prepare('SELECT idCidade FROM Cidade WHERE nome=? and idPais=?');
    $stmt->execute(array($cidade, $pais));
    $idCidade=$stmt->fetch()['idCidade'];
    if($idCidade == null){
        $stmt = $db->prepare('INSERT INTO Cidade(nome, idPais) VALUES(?, ?)');
        $stmt->execute(array($cidade, $pais));
        $idCidade = $db->lastInsertId();
    }

    $stmt = $db->prepare('INSERT INTO Habitacao(nome, numQuartos, maxHospedes, morada, precoNoite, taxaLimpeza, idCidade, idTipo, idPolitica, descricao, latitude, longitude, idUtilizador) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($name, $numQuartos, $maxHospedes, $morada, $precoNoite, $taxaLimpeza, $idCidade, $tipo, $politica, $descricao, $latitude, $longitude, $idUser));
    
    $id=$db->lastInsertId();
    return $id;
}

function removeHabitation($id){
    global $db;
    $stmt = $db->prepare('DELETE FROM Habitacao WHERE idHabitacao = ?');
    $stmt->execute(array($id));

    removeAllImages($id);
    removeReservationsHabitation($id);
}

function updateHabitation($id, $name, $numQuartos, $maxHospedes, $morada, $precoNoite, $taxaLimpeza, $pais, $cidade, $tipo, $politica, $descricao, $latitude, $longitude){
    global $db;

    $stmt = $db->prepare('SELECT idCidade FROM Cidade WHERE nome=? and idPais=?');
    $stmt->execute(array($cidade, $pais));
    $idCidade=$stmt->fetch()['idCidade'];
    if($idCidade == null){
        $stmt = $db->prepare('INSERT INTO Cidade(nome, idPais) VALUES(?, ?)');
        $stmt->execute(array($cidade, $pais));
        $idCidade = $db->lastInsertId();
    }
    $stmt = $db->prepare('UPDATE Habitacao SET nome=?, numQuartos=?, maxHospedes=?, morada=?, precoNoite=?, taxaLimpeza=?, idCidade=?, idTipo=?, idPolitica=?, descricao=?, latitude=?, longitude=? WHERE idHabitacao=?');
    $stmt->execute(array($name, $numQuartos, $maxHospedes, $morada, $precoNoite, $taxaLimpeza, $idCidade, $tipo, $politica, $descricao, $latitude, $longitude, $id));
}


function addImage($idHab, $url, $description){
    global $db;
    $stmt = $db->prepare('SELECT * FROM Imagem WHERE urlImagem=?');
    $stmt->execute(array($url));
    
    if ($stmt->fetch() == null){
        $stmt = $db->prepare('INSERT INTO Imagem(urlImagem, legenda, idHabitacao) values (?, ?, ?)');
        $stmt->execute(array($url, $description, $idHab));
    }
}

function removeAllImages($idHab){   
    $pictures = getHabitationPictures($idHab);

    foreach($pictures as $picture){
        unlink($picture['urlImagem']);
    }
    
    global $db;
    $stmt = $db->prepare('DELETE FROM Imagem WHERE idHabitacao=?');
    $stmt->execute(array($idHab));
}

function reserve($idRes, $idHab, $idUser, $dataCheckIn, $dataCheckOut, $numHospedes, $precoTotal){
    global $db;
    $stmt = $db->prepare('INSERT INTO Reserva(idReserva, dataCheckIn, dataCheckOut, numHospedes, precoTotal, idHabitacao, idEstado) VALUES (?, ?, ?, ?, ?, ?, 0)');
    $stmt->execute(array($idRes, $dataCheckIn, $dataCheckOut, $numHospedes, $precoTotal, $idHab));
    $stmt = $db->prepare('INSERT INTO Efetua(idCliente, idReserva) VALUES (?, ?)');
    $stmt->execute(array($idUser, $idRes));
}

function cancelReservation($idRes){
    global $db;
    $stmt = $db->prepare('UPDATE Reserva SET idEstado=3 WHERE idRes = ?');
    $stmt->execute(array($idRes));
    $stmt = $db->prepare('SELECT percentagemReembolso FROM (PoliticaDeCancelamento JOIN Habitacao USING (idPolitica)) JOIN Reserva USING (idHabitacao) WHERE idReserva = ?');
    $stmt->execute(array($idRes));
    $reembolso = $stmt->fetch();
    $stmt = $db->prepare('SELECT precoTotal FROM Reserva WHERE idReserva = ?');
    $stmt->execute(array($idRes));
    $price = $stmt->fetch();
    $stmt = $db->prepare('INSERT INTO Cancelamento(reembolso, idReserva) VALUES (?, ?)');
    $stmt->execute(array($idRes, $price * $reembolso));
}

function removeReservationsHabitation($id){
    global $db;
    $stmt = $db->prepare('DELETE FROM Reserva WHERE idHabitacao = ?');
    $stmt->execute(array($id));
}

function addComment($idRes, $limpeza, $valor, $checkIn, $localizacao, $description, $anonimo){
    global $db;
    $stmt = $db->prepare('INSERT INTO ClassificacaoPorCliente(limpeza, valor, checkIn, localizacao, outros, anonimo, idReserva) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($limpeza, $valor, $checkIn, $localizacao, $description, $anonimo, $idRes));
    $stmt = $db->prepare('UPDATE Reserva SET idEstado=2 WHERE idReserva=?');
    $stmt->execute(array($idRes));
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
    $stmt = $db->prepare('SELECT * FROM Habitacao WHERE nome=?');
    $stmt->execute(array($nome));

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

function getNameCountry($idCity){
    global $db;
    $stmt = $db->prepare('SELECT Pais.nome as nome FROM Cidade JOIN Pais USING (idPais) WHERE idCidade=?');
    $stmt->execute(array($idCity));

    return $stmt->fetch()['nome'];
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
    $stmt = $db->prepare('SELECT * FROM ClassificacaoPorCliente JOIN Reserva USING (idReserva) WHERE idHabitacao=?');
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

function addAmenity($idHabitation, $amenity){
    global $db;

    $stmt = $db->prepare('SELECT idComodidade FROM Comodidade WHERE nome=?');
    $stmt->execute(array($amenity));
    $idAmenity=$stmt->fetch()['idComodidade'];
    if ($idAmenity == null)
    {
        $stmt = $db->prepare('INSERT INTO Comodidade(nome) VALUES(?)');
        $stmt->execute(array($amenity));
        $idAmenity=$db->lastInsertId();
    }
    else{
        $stmt = $db->prepare('SELECT * FROM Dispoe WHERE idComodidade=? and idHabitacao=?');
        $stmt->execute(array($idAmenity, $idHabitation));
        $dispoe=$stmt->fetch();
        if ($dispoe != null)
            return;
    }

    $stmt = $db->prepare('INSERT INTO Dispoe(idComodidade, idHabitacao) VALUES (?, ?)');
    $stmt->execute(array($idAmenity, $idHabitation));
}

function addAgenda($idHabitation, $agenda_from, $agenda_to){
    global $db;
    $stmt = $db->prepare('SELECT idAgenda FROM Agenda WHERE dataInicio=? and dataFim=?');
    $stmt->execute(array($agenda_from, $agenda_to));
    $idAgenda=$stmt->fetch()['idAgenda'];
    if ($idAgenda == null)
    {
        $stmt = $db->prepare('INSERT INTO Agenda(dataInicio, dataFim) VALUES(?, ?)');
        $stmt->execute(array($agenda_from, $agenda_to));
        $idAgenda=$db->lastInsertId();
    }
    else{
        $stmt = $db->prepare('SELECT * FROM Disponivel WHERE idAgenda=? and idHabitacao=?');
        $stmt->execute(array($idAgenda, $idHabitation));
        $dispoe=$stmt->fetch();
        if ($dispoe != null)
            return;
    }
    $stmt = $db->prepare('INSERT INTO Disponivel(idAgenda, idHabitacao) VALUES (?, ?)');
    $stmt->execute(array($idAgenda, $idHabitation));
}

function getAmenitiesByHabitation($idHabitation){
    global $db;
    $stmt = $db->prepare('SELECT * FROM Dispoe JOIN Comodidade USING (idComodidade) WHERE idHabitacao=?');
    $stmt->execute(array($idHabitation));

    return $stmt->fetchAll();
}

function getAgendaByHabitation($idHabitation){
    global $db;
    $stmt = $db->prepare('SELECT * FROM Agenda JOIN Disponivel  USING (idAgenda) WHERE idHabitacao=?');
    $stmt->execute(array($idHabitation));

    return $stmt->fetchAll();
}

function getResNotCommentedByUser($idHabitation, $idUser){
    global $db;
    $stmt = $db->prepare('SELECT * FROM Reserva WHERE idHabitacao=? and idUtilizador=? and idEstado=1');
    $stmt->execute(array($idHabitation, $idUser));

    return $stmt->fetchAll();
}

function isAvailableDay($idHabitation, $date){
    global $db;
    $stmt = $db->prepare('SELECT * FROM Agenda JOIN Disponivel USING (idAgenda) WHERE idHabitacao=?');
    $stmt->execute(array($idHabitation));
    $agendas = $stmt->fetchAll();

    $available=false;
    foreach($agendas as $agenda){
        if ($date >= $agenda['dataInicio'] && $date <= $agenda['dataFim']){
            $available=true;
            break;
        }
    }
    if (!$available)
        return false;

    global $db;
    $stmt = $db->prepare('SELECT * FROM Reserva WHERE idHabitacao=?');
    $stmt->execute(array($idHabitation));
    $reservations = $stmt->fetchAll();

    foreach($reservations as $reservation){
        if ($date >= $reservations['dateCheckIn'] && $date <= $reservations['dateCheckOut']){
            $available=false;
            break;
        }
    }

    return $available;
}

function isAvailable($idHabitation, $dateFrom, $dateTo){
    $begin = new DateTime($dateFrom);
    $end = new DateTime($dateTo);

    $allAvailable=true;
    for($i = $begin; $i <= $end; $i->modify('+1 day')){
        $date = $i->format("Y-m-d");
        if (!isAvailableDay($idHabitation, $date)){
            $allAvailable = false;
            break;
        }
    }

    return $allAvailable;
}

function getStateName($idState){
    global $db;
    $stmt = $db->prepare('SELECT * FROM Estado WHERE idEstado=?');
    $stmt->execute(array($idState));

    return $stmt->fetch()['estado'];
}

?>