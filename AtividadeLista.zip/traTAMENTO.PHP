<?php

/*
echo 'Dados enviados:<br>';
echo '<pre>';
var_dump($lista);
echo '</pre>';
*/

define('JSON','cadastros.json');
define('JsonApi','https://6353e4c4ccce2f8c02febf65.mockapi.io/api/v1/cadastros');

function carregaDadosFormParaVetor(){
    $destino = '';
    if (isset($_FILES['foto'])){
        // define a pasta destino do arquivo feito upload
        $destino = 'imagens/'.$_FILES['foto']['name'];
        // move o arquivo para a pasta destino
        move_uploaded_file($_FILES['foto']['tmp_name'],$destino);
    }

    // pega informação enviada via post e guarda no vetor dados   
    $dados = array( 'Id' => isset($_POST['Id'])?$_POST['Id']:'$idas',  // teste ISSET é para verificar se os dados foram enviados
                    'nome' => isset($_POST['nome'])?$_POST['nome']:'',
                    'sobrenome' => isset($_POST['sobrenome'])?$_POST['sobrenome']:'',
                    'email' => isset($_POST['email'])?$_POST['email']:'',
                    'senha'=> isset($_POST['senha'])?$_POST['senha']:'',
                    'datanasc' => isset($_POST['datanasc'])?$_POST['datanasc']:'',
                    'parente' => isset($_POST['parente'])?$_POST['parente']:'',
                    'sexo' => isset($_POST['sexo'])?$_POST['sexo']:'',
                );


    return $dados; 

}

function idas($dados){
    $id = intval($dados[count($dados)-1]->Id);
    //echo $id;
    return (++$id);
}

// A função a seguir é responsável por deletar os dados

function excluir($id){
    echo "cheguei aqui";
    $dados = ApresentaDadosVetor();

    $i = 0;
    foreach($dados as $contato){
        if ($contato['Id'] == $id)
            break;
        else
        $i++;
    }
    array_splice($dados,$i,1);
    salvaDadosNoArquivo($dados);
}

function salvaDadosNoArquivo($dados){
    file_put_contents(JSON,json_encode($dados));    
}

// A função a seguir é responsável por alterar os dados

function alterar($alterado){
    $dados = ApresentaDadosVetor();
    $i = 0;
    foreach($dados as $contato){
        if ($contato['Id'] == $alterado['Id'])
            break;
        else
        $i++;
    }
    array_splice($dados,$i,1,array($alterado));
    inserir($dados);  
}

//function carregaDadosFormParaVetor(){
function salvaContexto($id, $nome, $sobrenome, $email, $senha, $datanasc, $parente, $sexo){
    $novosdados = array('Id'=>$id,
                        'nome'=>$nome,
                        'sobrenome'=>$sobrenome,
                        'email'=>$email,
                        'senha'=>$senha,
                        'datanasc'=>$datanasc,
                        'parente'=>$parente,
                        'sexo'=>$sexo);
    return $novosdados;
}
//}

function inserir($dados){
    $arquivo = fopen('cadastros.json','w+');
    fwrite($arquivo,json_encode($dados));
    fclose($arquivo);
}

function buscarDados(){
    // criar um vetor vazio para caso não for informado nada retornar um vator vazio
    $conteudo = file_get_contents(JsonApi);
    $dados = json_decode($conteudo);
    return $dados;
}

// A função a seguir será a responsável pelo abastecimento de dados na tabela html

function ApresentaDadosVetor(){
    //if (file_exists(JsonApi)){
        $conteudo = file_get_contents(JsonApi);
        $contatos = json_decode($conteudo,true);
        //print_r ($contatos);
        return $contatos;
    //}
    return null;
}

$nome = isset($_POST['nome'])&&(strlen($_POST['nome'])>3)?$_POST['nome']:'';

$sobrenome = isset($_POST['sobrenome'])?$_POST['sobrenome']:'';

$email = isset($_POST['email'])?$_POST['email']:'';

$senha = isset($_POST['senha'])?$_POST['senha']:'';

$datanasc = isset($_POST['datanasc'])?$_POST['datanasc']:'';

//$idade = $_POST['idade'];

$parente = isset($_POST['gaules'])?$_POST['gaules']:'';

$sexo = isset($_POST['sexo']);

if(isset($_POST['gaulles'])){
    $sexo = $_POST['gaulles'];
    if($sexo == 1){
        $sexo = 'Masculino';
    }
    else{
        if($sexo == 2){
            $sexo = 'Feminino';
        }
        else{
            $sexo = 'Outros';
        }
    }
}

$dados = array();
$novosdados = array();

$acao = isset($_POST['enviar'])?$_POST['enviar']:"";
if($acao == "salvar"){
    $dados = buscarDados();
    $id = idas($dados);
    $novosdados = salvaContexto($nome, $sobrenome, $email, $senha, $datanasc, $parente, $sexo, $id);
    array_push($dados,$novosdados);
    inserir($dados);
    
}


// TESTE FUNÇÃO QUE RETORNA PESQUISA
$pesquisa = (isset($_POST['pesquisa'])?$_POST['pesquisa']:'');
    if($pesquisa == 'procurar'){
        $resultadoPesquisa = $_POST['busca'];
        print_r($resultadoPesquisa);
    }


function buscaContato($id){
    $dados = ApresentaDadosVetor();  
    foreach($dados as $contato){
        //print_r($contato);
        if ($contato['Id'] == $id){
            echo "Passou no buscaContato"; //Fins de teste
            return $contato;
        }
    }
}

$acao = isset($_POST['acao'])?$_POST['acao']:'';

if ($acao =='salvar'){
    $contato = carregaDadosFormParaVetor();
    if ($contato['Id'] == 0){
        if (inserir($contato))
            header('location: Tabela.php');
    }else{    
        alterar($contato);
        header('location: Tabela.php');

    }
}
else{

    $acao = isset($_GET['acao'])?$_GET['acao']:'';
    $id = isset($_GET['Id'])?$_GET['Id']:'';
    //echo $acao;

    if ($acao == 'excluir'){
        echo "Alo"; //Fins de teste
        excluir($id);
    }else if($acao == 'editar'){
        //echo "Ai";
        $contato = buscaContato($id);
        print_r($contato);
        echo "aqui";        
    }
}

if(!empty($_GET['Id'])){
    
    $id = $_GET['Id'];
    $result = "a"; 

}


//tentar pegar o vetor na mesma posição do id informado

?>