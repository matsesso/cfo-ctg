<?php
include('connection.php');
include('webservice.php');
?>

<!-- 
    Landing Page CFO e BTG+ - Conselho Federal de Odontologia
    Feito por Matheus Sesso
-->
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        
        <!-- Fontes e Icons -->
        <link rel="shortcut icon" href="images/favicon.png" />
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
        
        <!-- Styles -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">
        <link href="css/owl.carousel.min.css" rel="stylesheet">
        <link href="css/owl.theme.default.min.css" rel="stylesheet">
        <link href="css/templatemo-medic-care.css" rel="stylesheet">

        <title>CFO e BTG+</title>

        <script type="text/javascript">
        function MascaraCpfCnpj(campo,teclapres) {
            var tecla = teclapres.keyCode;

            if ((tecla < 48 || tecla > 57) && (tecla < 96 || tecla > 105) && tecla != 46 && tecla != 8 && tecla != 9) {
                return false;
            }

            var vr = campo.value;
            vr = vr.replace( /\//g, "" );
            vr = vr.replace( /-/g, "" );
            vr = vr.replace( /\./g, "" );
            var tam = vr.length;

            if ( tam <= 2 ) {
                campo.value = vr;
            }
            if ( (tam > 2) && (tam <= 5) ) {
                campo.value = vr.substr( 0, tam - 2 ) + '-' + vr.substr( tam - 2, tam );
            }
            if ( (tam >= 6) && (tam <= 8) ) {
                campo.value = vr.substr( 0, tam - 5 ) + '.' + vr.substr( tam - 5, 3 ) + '-' + vr.substr( tam - 2, tam );
            }
            if ( (tam >= 9) && (tam <= 11) ) {
                campo.value = vr.substr( 0, tam - 8 ) + '.' + vr.substr( tam - 8, 3 ) + '.' + vr.substr( tam - 5, 3 ) + '-' + vr.substr( tam - 2, tam );
            }
            if ( (tam == 12) ) {
                campo.value = vr.substr( tam - 12, 3 ) + '.' + vr.substr( tam - 9, 3 ) + '/' + vr.substr( tam - 6, 4 ) + '-' + vr.substr( tam - 2, tam );
            }
            if ( (tam > 12) && (tam <= 14) ) {
                campo.value = vr.substr( 0, tam - 12 ) + '.' + vr.substr( tam - 12, 3 ) + '.' + vr.substr( tam - 9, 3 ) + '/' + vr.substr( tam - 6, 4 ) + '-' + vr.substr( tam - 2, tam );
            }
            if (tam > 13){     
                if (tecla != 8){
                    return false
                }
            }
        }
        </script>
    </head>
    
    <body id="top">
        <main>
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand mx-auto d-xl-none" href="index.php">
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
                                <a class="nav-link" href="#sobre">Sobre</a>
                            </li>
                            <a class="navbar-brand d-none d-xl-block" href="index.php"> 
                                <a href="index.php" class="text-black">
                                    <img class="d-none d-xl-block" src="images/logo.png"/>
                                </a>
                            </a>
                            <li class="nav-item">
                                <a class="nav-link" href="#infos">Seus benefícios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-link btn btn-plus" href="#btg">Seja BTG+</a>
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
                                <h4 style="font-weight: bold; color: #FFF" class="mt-auto mb-2">
                                O Conselho Federal de Odontologia
                                <br>
                                e o BTG Pactual se uniram
                                </h4>
                                <p style="font-size: 1.3rem; font-weight: 500; color: #FFF">para trazer os melhores benefícios para você e para seu negócio.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section-padding" id="sobre">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-7 col-md-7 col-12" id="btg">
                            <h3 class="mb-lg-3 mb-3" style="font-weight: bold; color: #73141d">Bem-Vindo</h2>

                            <p style="font-size: 1.5rem; font-weight: 500;">Neste espaço, os inscritos em situação ativa no<br>
                                Sistema Conselhos têm acesso a benefícios<br>
                                exclusivos para Pessoa Física e Jurídica.</p>

                        </div> 

                        <div class="col-lg-4 col-md-4 col-12 mx-auto">
                            <form action="#" method="POST" onsubmit="return checkForm()">
                                <div class="form-row">
                                    <input type="text" id="cpfcnpj" name="cpfcnpj" onkeydown="return MascaraCpfCnpj(this,event)" onkeyup="return MascaraCpfCnpj(this,event)" minlength="14" maxlength="18" class="form-setup" placeholder="Digite o número do CPF ou CNPJ">
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
                            <h3 class="mb-lg-3 mb-3 mt-3" style="font-weight: bold; color: #73141d">Conheça as vantagens BTG+ <br> para PF e PJ:</h2>
                    
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
                                <p style="margin-top: 25px; padding-bottom: 20px; font-size: 1.5rem; font-weight: 500;">Aprovação dos pagamentos de qualquer lugar.</p>
                                
                        </div>

                    </div>
                </div>
            </section>

            <section class="disclaimer">
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

        <!-- JS Files -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/scrollspy.min.js"></script>
        <script src="js/custom.js"></script>
    </body>
</html>