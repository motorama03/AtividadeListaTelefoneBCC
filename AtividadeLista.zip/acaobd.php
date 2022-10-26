<?php

    define('DB_HOST', '127.0.0.1');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_DB', 'agenda');
    define('DB_PORT', '3306');
    define('MYSQL_DSN', 'mysql:host='.DB_HOST.";dbname=".DB_DB.";charset=UTF8");

    try{
        $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);//cria conexão com banco de dados


        // Mostrar consulta; 
        $consulta = 'SELECT * FROM new_table';

        // Prepara a consulta para executar
        $comando = $conexao->prepare($consulta);// prepare valida dados se condizem com as limitações do banco

        // Executa a consulta
        $comando->execute();

        // Pega retorna da consulta
        $listacontatos = $comando->fetchAll();

        //
        echo "<table>";
        echo"   <tr>
                    <th>Id</th><th>nome</th><th>sobrenome</th><th>Email</th><th>senha</th>
                </tr>";
        foreach($listacontatos as $contato){
            echo "<tr>";
            echo "<td>".$contato['id']."</td><td>".$contato['nome']."</td><td>".$contato['sobrenome']."</td><td>".$contato['email']."</td><td>".$contato['senha']."</td>";
            echo "</tr>";
        }
        echo "</table>";


    }catch(PDOException $e){
        print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
        die();
    }

?>