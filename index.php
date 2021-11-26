<?php
   define('DB_SERVER', '179.188.38.197');
   define('DB_USERNAME', 'guido');
   define('DB_PASSWORD', 'Xqr6w7J7NMRWdBC9');
   define('DB_DATABASE', 'website_estatistico');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>

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

    $cpfcnpj = mysqli_real_escape_string($db, $_POST['cpfcnpj']);

    $sql2 = "SELECT * FROM pfpj WHERE cpf_cnpj = '$cpfcnpj' AND sit_financeira != 'OK'";
    $stmt = $db->prepare($sql2);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0) {
        $erros["cpfcnpj2"] =  "Este CPF ou CNPJ consta débitos. Procure o CFO para mais informações.";
        echo "<script>alert('Este CPF ou CNPJ consta débitos. Procure o CFO para mais informações.');</script>";
    }
    
    if(!count($erros)) {
      
      $sql = "SELECT * FROM pfpj WHERE cpf_cnpj = '$cpfcnpj'";
      $stmt = $db->prepare($sql);
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

<!doctype html>
<html lang="pt-bt">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>CFO e BTG+</title>

        <!-- CSS FILES -->        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/owl.carousel.min.css" rel="stylesheet">

        <link href="css/owl.theme.default.min.css" rel="stylesheet">

        <link href="css/templatemo-medic-care.css" rel="stylesheet">

        <script type="text/javascript">
function mascaraMutuario(o,f){
    v_obj=o
    v_fun=f
    setTimeout('execmascara()',1)
}

function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

function cpfCnpj(v){

    //Remove tudo o que não é dígito
    v=v.replace(/\D/g,"")

    if (v.length <= 14) { //CPF

        //Coloca um ponto entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d)/,"$1.$2")

        //Coloca um ponto entre o terceiro e o quarto dígitos
        //de novo (para o segundo bloco de números)
        v=v.replace(/(\d{3})(\d)/,"$1.$2")

        //Coloca um hífen entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")

    } else { //CNPJ

        //Coloca ponto entre o segundo e o terceiro dígitos
        v=v.replace(/^(\d{2})(\d)/,"$1.$2")

        //Coloca ponto entre o quinto e o sexto dígitos
        v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")

        //Coloca uma barra entre o oitavo e o nono dígitos
        v=v.replace(/\.(\d{3})(\d)/,".$1/$2")

        //Coloca um hífen depois do bloco de quatro dígitos
        v=v.replace(/(\d{4})(\d)/,"$1-$2")

    }

    return v
}
        </script>

    </head>
    
    <body id="top">
    
        <main>

            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand mx-auto d-lg-none" href="index.php">
                        <img src="images/logo.png"/>
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#hero">Início</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#about">Sobre</a>
                            </li>

                            <a class="navbar-brand d-none d-sm-block" href="index.php"> 
                                <a href="index.php" class="text-black">
                                    <img class="d-none d-sm-block" src="images/logo.png"/>
                                </a>
                            </a>

                            <li class="nav-item">
                                <a class="nav-link" href="#infos">Seus benefícios</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link nav-link btn btn-plus" target="_blank" href="https://www.sejabtg.com/">Seja BTG+</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </nav>

            <section class="hero" id="hero">
                <div class="container">
                    <div class="row">

                        <div class="col-12">

                            <div class="heroText d-flex flex-column justify-content-center">

                                <h4 class="mt-auto mb-2">
                                    Parceria BTG Pactual e<br>
                                    Conselho Federal de Odontologia
                                </h4>

                                <p>O BTG e o CFO se uniram para trazer os melhores benefícios para você e para o seu negócio.</p>

                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <section class="section-padding" id="about">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-7 col-md-7 col-12">
                            <h3 class="mb-lg-3 mb-3" style="font-weight: bold; color: #73141d">Bem-Vindo</h2>

                            <p style="font-size: 1.5rem; font-weight: 500;">Neste espaço, os inscritos em situação ativa no<br>
                                Sistema Conselhos têm acesso a benefícios<br>
                                exclusivos para Pessoa Física e Jurídica..</p>

                        </div> 

                        <div class="col-lg-4 col-md-4 col-12 mx-auto">
                            <form action="#" method="POST" onsubmit="return checkForm()">
                                <div class="form-row">
                                    <input type="text" id="cpfcnpj" name="cpfcnpj" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' minlength="14" maxlength="18" class="form-setup" placeholder="Digite o número do CPF ou CNPJ">
                                    <div class="invalid-feedback">
                                        <?= $erros["cpfcnpj"]; $erros["cpfcnpj2"]; ?>
                                    </div>
                                </div>
                                <button class="btn btn-acess mt-3"><b>ACESSAR</b></button>
                            </form>
                        </div>

                    </div>
                </div>
            </section>

            <section class="infos" id="infos">

                <div class="container">
                    <div class="row">

                        <div class="col-lg-4 col-md-4 col-12 d-none d-lg-block">
                            <img id="img-footer" class="img-footer d-none d-lg-block" src="images/info.png" alt="">    
                        </div> 

                        
                        <div id="div-footer" class="div-footer col-lg-7 col-md-7 col-12 mx-auto py-5">
                            <h3 class="mb-lg-3 mb-3" style="font-weight: bold; color: #73141d">Conheça as vantagens da parceria <br> BTG+ e CFO para PF e PJ:</h2>
                    
                                <br>
            
                                <h3 class="mb-lg-3 mb-3" style="font-weight: normal; color: #4a897e">PESSOA FÍSICA</h2>
            
                                <p style="margin-top: 25px; font-size: 1.5rem; font-weight: 500;">6 meses de isenção no Plano Premium individual.</p>
                                <p style="margin-top: 25px; font-size: 1.5rem; font-weight: 500;">Isenção de anuidade no cartão de crédito.*</p>
                                
                                
                                <p style="margin-top:35px;font-size: 0.8rem; font-weight: 500;">
                                    *A parceria garante isenção apenas aos cartões Black e Platinum com Invest+.<br>
                                    Os demais produtos são contratados e cobrados separadamente e não fazem parte do<br>
                                    benefício da parceria.
                                </p>
                                <hr>
                                <br>
                                <h3 class="mb-lg-3 mb-3" style="font-weight: normal; color: #678aac">PESSOA JURÍDICA</h2>
            
                                <p style="margin-top: 25px; font-size: 1.5rem; font-weight: 500;">Abra de forma online a sua conta PJ, sem custos.</p>
                                <p style="margin-top: 25px; font-size: 1.5rem; font-weight: 500;">Transferências ilimitadas via PIX.*</p>
                                <p style="margin-top: 25px; margin-bottom: 0px; font-size: 1.5rem; font-weight: 500;">Aprovação dos pagamentos de qualquer lugar.</p>
                                
                                <button class="btn btn-acess mt-5"><b>SAIBA MAIS</b></button>
                        </div>

                    </div>
                </div>



            </section>

            <section class="gallery">
                <div class="container">
                    <div class="row">

                        <div class="col-12">

                            <p style="text-align: justify; font-size: 11px; font-weight: 500;"><i><b>Aviso legal:</b> O Conselho Federal de Odontologia não obterá lucro ou qualquer tipo de vantagem decorrente da eventual adesão do inscrito ao pacote de benefícios ofertado pelo BTG, o qual
                                foi disponibilizado sem qualquer ônus ao CFO. A validação do acesso nesta página apenas direcionará o interessado a uma página do BTG, em que se terá acesso às informações referentes
                                aos benefícios. O fornecimento de dados pessoais ao BTG será de responsabilidade do inscrito interessado. Não haverá compartilhamento de dados pessoais de inscritos por parte do CFO.</i>
                            </p>

                        </div> 

                    </div>
                </div>
            </section>

        </main>

        <footer class="site-footer" id="contact">
            <div class="container">
                <div class="row">

                    <div class="col-12" align="center">

                        <img src="images/footer-img.png"/>

                    </div> 

                </div>
            </div>
        </footer>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/scrollspy.min.js"></script>
        <script src="js/custom.js"></script>
<!--

TemplateMo 566 Medic Care

https://templatemo.com/tm-566-medic-care

-->
    </body>
</html>