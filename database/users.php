<?php

function modifyUser($id, $newData){
    global $db;
    $stmt = $db->prepare('DELETE FROM Utilizador WHERE idUtilizador = ?');
    $stmt->execute(array($id));
    $stmt = $db->prepare('INSERT INTO Utilizador(idUtilizador, hashedPassword, nome, dataNascimento, email, telefone, morada, codigoPostal, idPais) values (?, ?, ?, ?, ?, ?, ?, ?, ?);');
    $stmt->execute(array_merge(array($id), $newData));
}

function createUser($id, $Data){
    global $db;
    $stmt = $db->prepare('INSERT INTO Utilizador(idUtilizador, hashedPassword, nome, dataNascimento, email, telefone, morada, codigoPostal, idPais) values (?, ?, ?, ?, ?, ?, ?, ?, ?);');
    $stmt->execute(array_merge(array($id), $newData));
    $stmt = $db->prepare('INSERT INTO Cliente(idCliente) VALUES (?);');
    $stmt->execute(array($id));
    $stmt = $db->prepare('INSERT INTO Anfitriao(idAnfitriao) VALUES (?);');
    $stmt->execute(array($id));
}
