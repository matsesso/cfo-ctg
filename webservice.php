<?php
if(count($_POST) > 0) {
    $dados = $_POST;
    $erros = [];

    function validaCPF($cpf) {
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
        if (strlen($cpf) != 11) {
            return false;
        }
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    function validaCNPJ($cnpj) {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        if (strlen($cnpj) != 14)
            return false;
        if (preg_match('/(\d)\1{13}/', $cnpj))
            return false;	
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
            return false;
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
    }

    if(!validaCPF($dados['cpfcnpj']) && !validaCNPJ($dados['cpfcnpj'])) {
        $erros["cpfcnpj"] =  "Insira um CPF ou CNPJ válido.";
        echo "<script>alert('Insira um CPF ou CNPJ válido.');</script>";
    }

    $cpfcnpj = mysqli_real_escape_string($connection, $dados['cpfcnpj']);

    $sql2 = "SELECT * FROM pfpj WHERE cpf_cnpj = '$cpfcnpj' AND situacao != 'Ativo'";
    $stmt = $connection->prepare($sql2);
    $stmt->execute();
    $stmt->store_result();

    if(validaCPF($dados['cpfcnpj']) && validaCNPJ($dados['cpfcnpj']) && $stmt->num_rows > 0) {
        $erros["cpfcnpj2"] =  "Este CPF ou CNPJ encontra-se inativo. Favor procurar o seu CRO para atualização de dados.";
        echo "<script>alert('Este CPF ou CNPJ encontra-se inativo. Favor procurar o seu CRO para atualização de dados.');</script>";
    }
    
    if(!count($erros)) {
      
      $sql = "SELECT * FROM pfpj WHERE cpf_cnpj = '$cpfcnpj'";
      $stmt = $connection->prepare($sql);
      $stmt->execute();
      $stmt->store_result();
      
        if($stmt->num_rows == 1) {
            echo "<script>alert('CPF ou CNPJ válido! Clique no OK para ser redirecionado.');</script>";
            header("refresh:1;url=index.php");
        }else {
            echo "<script>alert('Esse CPF ou CNPJ não se encontra no banco de dados do CFO. Favor informar um cadastrado.');</script>";
        }
    }
}
?>