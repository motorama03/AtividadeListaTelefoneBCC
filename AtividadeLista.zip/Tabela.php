<?php
   include_once "traTAMENTO.PHP";
?>

<!DOCTYPE html>
<head>

</head>

<body>
    <h1>Lista de contatos</h1>
    <nav>
        <ul class="MainMenu">
            <li id="cadastrar" class="itemenu"><a href="CadastrosPg.php">Cadastrar</a></li>
        </ul>
    </nav>

    <form method="post">
        <script src="script.js"></script>
            <thead>
                <tr>
                    <label for="pesquisa"></label>
                    <input type="search" id="busca" name="busca" value="">
                    <input type="submit" id="pesquisar" name="pesquisa" value="procurar">
                </tr>
            </thead>
    </form>


    <selection>
        <table class="table lista-contatos">
            <thead>
                <tr>
                    <th>Id</th><th>nome</th><th>sobrenome</th><th>Contato</th><th>Alterar</th><th>Deletar</th>
                </tr>
            </thead>
            <?php
                $dados = ApresentaDadosVetor();
                foreach($dados as $contato){
                    $alterar = "<a href='CadastrosPg.php?acao=editar&Id=".$contato['Id']."'>Alt</a>";
                    $excluir = "<a href='#' onclick=excluir('Tabela.php?acao=excluir&Id=".$contato['Id']."')>Del</a>";
                    echo "<tr><td>".$contato['Id']."</td><td>".$contato['nome']."</td><td>".$contato['sobrenome']."</td><td>"."</td><td>".$alterar."</td><td>".$excluir."</td></tr>";
                }
            ?>
        </table>
    </selection>
</body>