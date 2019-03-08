<?php
if (version_compare(PHP_VERSION, '5.4') == -1) {
    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">

  <head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Tikiri</title>
    <script type="text/javascript" src="js/jquery.js"></script>
    <link rel="stylesheet" href="css/load-styles.css" type="text/css" media="all">
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="stylesheet" href="css/css.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/wc-setup.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  </head>
  
  
    <body class="wc-setup wp-core-ui">
    <h1 id="wc-logo"><a href="http://www.faveohelpdesk.com" target="_blank"><img src="images/logo.png" alt="faveo"></a></h1>
        <div class="wc-setup-content">
            <h1 style="text-align: center;"> Testando para  Tikiri 1.9.6 </h1>
            <p>
                <strong>Versão do Avaliador:</strong> 1.0
                 <div class="woocommerce-message woocommerce-tracker "><p><span id="fail">Error!</span> A versão mínima para executar o Tikiri é 5.6.*. Sua versão é: <?php echo PHP_VERSION ?>. Por favor, atualize sua versão do PHP.</p></div>
                 <br><span class="ok">Ok</span> — Tudo Certo
            <br><span class="warning">Warning</span> — Não é um impeditivo de continuar a instalação, mas é necessário para executar alguns recursos do Tikiri.
            <br><span class="error">Error</span> — O Tikiri não funciona sem esse recurso.
            <br>


        </div>
    <p style="text-align: center;">Copyright © 2015 - 2016 · Ladybird Web Solution Pvt Ltd. All Rights Reserved. Powered by <a href="http://www.faveohelpdesk.com" target="_blank">Faveo</a><br>
        Versão alterada/adaptada para <a href="https://tikiri.com.br" target="_blank">tikiri.com.br</a></p>

    </body>
  
</html>

<?php

} else {
    // Start the session
    session_start();
    $_SESSION['check'] = 1;
    header('location: step1.php');
}
?>