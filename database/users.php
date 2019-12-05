<?php

function modifyUser($id, $newData){
    global $db;
    $stmt = $db->prepare('DELETE FROM Utilizador WHERE idUtilizador = ?');
    $stmt->execute(array($id));
    $stmt = $db->prepare('INSERT INTO Utilizador(idUtilizador, hashedPassword, nome, dataNascimento, email, telefone, morada, codigoPostal, idPais) values (?, ?, ?, ?, ?, ?, ?, ?, ?);');
    $stmt->execute(array_merge(array($id), $newData));
}

function createUser($hashedPassword, $primeiroNome, $ultimoNome, $dataNascimento, $email, $telefone, $idPais){
    global $db;
    $stmt = $db->prepare('INSERT INTO Utilizador(hashedPassword, primeiroNome, ultimoNome, dataNascimento, email, telefone, morada, codigoPostal, idPais) values (?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($hashedPassword, $primeiroNome, $ultimoNome, $dataNascimento, $email, $telefone, $idPais));
}

function addPhotoProfile($id, $urlPhoto, $description){
    global $db;
    $stmt = $db->prepare('UPDATE Utilizador SET foto=?, altFoto=? WHERE idUtilizador=?');
    $stmt = $db->execute(array($urlPhoto, $description, $id));
}

function getCountries(){
    global $db;
    $stmt = $db->prepare('SELECT * FROM Pais');
    $stmt->execute();
    return $stmt->fetchAll();
}

function getCountryId($name){
    global $db;
    $stmt = $db->prepare('SELECT idPais FROM Pais WHERE nome=?');
    $stmt->execute(array($name));
    return $stmt->fetch();
}

function getUserByEmail($email){
    global $db;
    $stmt = $db->prepare('SELECT * from Utilizador WHERE email=?');
    $stmt->execute(array($email));
    return $stmt->fetch();
}

function getUserPassword($id){
    global $db;
    $stmt = $db->prepare('SELECT hashedPassword from Utilizador WHERE idUtilizador=?');
    $stmt->execute(array($id));
    return $stmt->fetch();
}

?>