<?php 
session_start();
//$check = $_SESSION['check'];
error_reporting(0);
if (isset($_SESSION['check']) == 1) {
    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">

	<head>
		<meta name="viewport" content="width=device-width">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Tikiri - Gestão de HelpDesk</title>
		<script type="text/javascript" src="js/jquery.js"></script>
		<link rel="stylesheet" href="css/load-styles.css" type="text/css" media="all">
		<link rel="shortcut icon" href="images/favicon.ico">
		<link rel="stylesheet" href="css/css.css" type="text/css" media="all">
		<link rel="stylesheet" href="css/wc-setup.css" type="text/css" media="all">
		<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

	</head>
	
	
		<body class="wc-setup wp-core-ui">
		<h1 id="wc-logo"><a href="https://tikiri.com.br" target="_blank"><img src="images/tikiri.png" alt="Tikiri"></a></h1>
			<div class="wc-setup-content">
				<h1 style="text-align: center;"> Testando para	Tikiri 1.9.6 </h1>
				<p>
					<strong>Versão do Avaliador:</strong> 1.0
				</p>
				<p class="wc-setup-actions step">
						Este teste verifica os requisitos para instalar o Tikiri.
                <br/>
                <p><b>OBS:</b>&nbsp;O Tikiri não funciona corretamente sem o JavaScript.  Desta forma, para que a instalação e diversos recursos do sistema funcionem é necessário que o navegador esteja habilitado para executar Javascript.</p>
                <p><b>Extensões do Servidor Web:</b> É necessário que os módulos de Pretty URLs, Mod_rewrite ou Search Engine Friendly estejam habilitados no seu servidor Web seja ele Apache ou Nginx.</p>
							
					<!-- -->
<?php


    // -- No need to change anything below this line --------------------------------------

    define('PROBE_VERSION', '1');
    define('PROBE_FOR', 'Tikiri 1.9.6');
    define('STATUS_OK', 'ok');
    define('STATUS_WARNING', 'warning');
    define('STATUS_ERROR', 'error');
    class TestResult
    {
        public $message;
        public $status;

        public function __construct($message, $status = STATUS_OK)
        {
            $this->message = $message;
            $this->status = $status;
        }
    } // TestResult
    // ---------------------------------------------------
    //  Validators
    // ---------------------------------------------------

    /**
     * Validate PHP platform.
     *
     * @param array $results
     */
    function validate_php(&$results)
    {
        if (version_compare(PHP_VERSION, '5.6') == -1) {
            $results[] = new TestResult('A versão do PHP mínima para executar o Tikiri é 5.6. Sua versão do PHP é: '.PHP_VERSION, STATUS_ERROR);

            return false;
        } else {
            $results[] = new TestResult('Sua versão do PHP é: '.PHP_VERSION, STATUS_OK);

            return true;
        } // if
    } // validate_php

    /**
     * Validate maximum execution time.
     *
     * @param array $results
     */
    function checkMaxExecutiontime(&$results)
    {
        $ok = true;
        if ((int) ini_get('max_execution_time') >= 120) {
            $results[] = new TestResult('O parâmetro Maximum execution time está conforme necessário.', STATUS_OK);
        } else {
            $results[] = new TestResult('O parâmetro Maximum execution time está muito baixo. O recomendado é 120 segundos. ', STATUS_WARNING);
        }

        return $ok;
    }

    /**
     * Validate memory limit.
     *
     * @param array $results
     */
    function validate_memory_limit(&$results)
    {
        $memory_limit = php_config_value_to_bytes(ini_get('memory_limit'));
        $formatted_memory_limit = $memory_limit === -1 ? 'unlimited' : format_file_size($memory_limit);
        if ($memory_limit === -1 || $memory_limit >= 67108864) {
            $results[] = new TestResult('A memória limite do servidor é: '.$formatted_memory_limit, STATUS_OK);

            return true;
        } else {
            $results[] = new TestResult('O parâmetro de memória limite está muito baixo. O valor mínimo é, você tem que definir para '.$formatted_memory_limit, STATUS_ERROR);

            return false;
        } // if
    } // validate_memory_limit

        /**
         * Validate Apache modules.
         *
         *@param array $results
         */
        function validate_apache_module(&$results)
        {
            $sapi_type = php_sapi_name();
            if (substr($sapi_type, 0, 3) == 'cgi') {
                $results[] = new TestResult('Não conseguimos detectar seu servidor da web. Certifique-se de que os recursos de search engine friendly URL’s ou pretty URLS’s estejam ativados em seu servidor da web. ', STATUS_WARNING);

                return true;
            } else {
                $modules = apache_get_modules();
                if (in_array('mod_rewrite', $modules) === true) {
                    $results[] = new TestResult("Apache 'mod_rewrite' não econtrado.", STATUS_OK);

                    return true;
                } else {
                    $results[] = new TestResult("Apache 'mod_rewrite' é necessário.", STATUS_ERROR);

                    return false;
                }
            }
        }

        /**
         * Validate PHP extensions.
         *
         * @param array $results
         */
        function validate_extensions(&$results)
        {
            $ok = true;

            $required_extensions = ['mysqli', 'tokenizer', 'imap', 'curl', 'mcrypt', 'mbstring', 'openssl', 'fileinfo', 'zip'];

            foreach ($required_extensions as $required_extension) {
                if (extension_loaded($required_extension)) {
                    $results[] = new TestResult("Extensão REQUERIDA '$required_extension' está instalada", STATUS_OK);
                } else {
                    $results[] = new TestResult("A extensão '$required_extension' é necessária para o Tikiri", STATUS_ERROR);
                    $ok = false;
                } // if
            } // foreach
        // Check for eAccelerator
        if (extension_loaded('eAccelerator') && ini_get('eaccelerator.enable')) {
            $results[] = new TestResult('eAccelerator opcode cache está ativado. <span class="details">eAccelerator opcode cache é incompatível com o Tikiri. <a href="https://eaccelerator.net/wiki/Settings">Desabilite isto </a> para a pasta onde o Tikiri está instalado: <a href="http://www.php.net/apc">http://www.php.net/apc</a>.</span>', STATUS_ERROR);
            $ok = false;
        } // if
        // Check for XCache
        if (extension_loaded('XCache') && ini_get('xcache.cacher')) {
            $results[] = new TestResult('XCache opcode cache está ativado. <span class="details">XCache opcode cache é incompatível com o Tikiri. <a href="http://xcache.lighttpd.net/wiki/XcacheIni">Disable it</a> para a pasta onde o Tikiri está instalado. <a href="http://www.php.net/apc">http://www.php.net/apc</a>.</span>', STATUS_ERROR);
            $ok = false;
        } // if

        $recommended_extensions = [
            'gd'    => 'GD é usado para manipulação de imagens. Sem ele, o sistema não é capaz de criar miniaturas de arquivos ou gerenciar avatares, logotipos e ícones de projetos. Por favor, consulte <a href="http://www.php.net/manual/en/image.installation.php">esta página</a> para instruções de instalação',
            'iconv' => 'Iconv é usado para conversão de conjunto de caracteres. Sem ele, o sistema fica um pouco mais lento ao converter diferentes conjuntos de caracteres. Por favor, consulte <a href="http://www.php.net/manual/en/iconv.installation.php">esta página</a> para instruções de instalação',
            //'imap' => 'IMAP is used to connect to POP3 and IMAP servers. Without it, Incoming Mail module will not work. Please refer to <a href="http://www.php.net/manual/en/imap.installation.php">this</a> page for installation instructions',
            // 'zlib' => 'ZLIB is used to read and write gzip (.gz) compressed files',
            // SVN extension ommited, to avoid confusion
            // 'fileinfo' => '\'fileinfo\' extension is used to check the mime type of the files uploaded by users on the server. This helps server to validate the file extension before saving them on the server. Please enable it to upload Tikiri\'s plugins and packages.',
        ];
            foreach ($recommended_extensions as $recommended_extension => $recommended_extension_desc) {
                if (extension_loaded($recommended_extension)) {
                    $results[] = new TestResult("Extensão '$recommended_extension' instalada", STATUS_OK);
                } else {
                    $results[] = new TestResult("A extensão '$recommended_extension' não foi encontrada. <span class=\"details\">$recommended_extension_desc</span>", STATUS_WARNING);
                } // if
            } // foreach

        return $ok;
        } // validate_extensions

    /**
     * Validate Zend Engine compatibility mode.
     *
     * @param array $results
     */
    function validate_zend_compatibility_mode(&$results)
    {
        $ok = true;

        if (version_compare(PHP_VERSION, '5.0') >= 0) {
            if (ini_get('zend.ze1_compatibility_mode')) {
                $results[] = new TestResult('zend.ze1_compatibility_mode está habilitado. Isso pode causar alguns problemas no Tikiri. Recomenda-se fortemente que este valor seja desativado (no seu arquivo php.ini)', STATUS_WARNING);
                $ok = false;
            } else {
                $results[] = new TestResult('zend.ze1_compatibility_mode is está desativado', STATUS_OK);
            } // if
        } // if

        return $ok;
    } // validate_zend_compatibility_mode
    /**
     * Convert filesize value from php.ini to bytes.
     *
     * Convert PHP config value (2M, 8M, 200K...) to bytes. This function was taken from PHP documentation. $val is string
     * value that need to be converted
     *
     * @param string $val
     *
     * @return int
     */
    function php_config_value_to_bytes($val)
    {
        $val = trim($val);
        $last = strtolower($val[strlen($val) - 1]);
        switch ($last) {
            // The 'G' modifier is available since PHP 5.1.0
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
        } // if
        return (int) $val;
    } // php_config_value_to_bytes
    /**
     * Format filesize.
     *
     * @param string $value
     *
     * @return string
     */
    function format_file_size($value)
    {
        $data = [
            'TB' => 1099511627776,
            'GB' => 1073741824,
            'MB' => 1048576,
            'kb' => 1024,
        ];
        // commented because of integer overflow on 32bit sistems
        // http://php.net/manual/en/language.types.integer.php#language.types.integer.overflow
        // $value = (integer) $value;
        foreach ($data as $unit => $bytes) {
            $in_unit = $value / $bytes;
            if ($in_unit > 0.9) {
                return trim(trim(number_format($in_unit, 2), '0'), '.').$unit;
            } // if
        } // foreach
        return $value.'b';
    } // format_file_size
    /**
     * Return true if MySQL supports InnoDB storage engine.
     *
     * @param resource $link
     *
     * @return bool
     */
    function check_have_inno($link)
    {
        if ($result = mysql_query('SHOW ENGINES', $link)) {
            while ($engine = mysql_fetch_assoc($result)) {
                if (strtolower($engine['Engine']) == 'innodb' && in_array(strtolower($engine['Support']), ['yes', 'default'])) {
                    return true;
                } // if
            } // while
        } // if
        return true;
    } // check_have_inno

    /**
     * function to check if there are laravel required functions are disabled.
     */
    function checkDisabledFunctions(&$results)
    {
        $ok = true;
        $sets = explode(',', ini_get('disable_functions'));
        $required_functions = ['escapeshellarg'];
        // dd($required_functions,$sets);
        foreach ($sets as $key) {
            $key = trim($key);
            foreach ($required_functions as $value) {
                if ($key == $value) {
                    if (strpos(ini_get('disable_functions'), $key) !== false) {
                        $results[] = new TestResult("A função '$value' é necessário para executar o Tikiri. Por favor, verifique php.ini para habilitar esta função ou contate o administrador do seu servidor.", STATUS_ERROR);
                        $ok = false;
                    } else {
                        $results[] = new TestResult('Todas as funções necessárias encontradas', STATUS_OK);
                    }
                }
            }
        }

        return $ok;
    }
    // ---------------------------------------------------
    //  Do the magic
    // ---------------------------------------------------
    $results = [];

    $php_ok = validate_php($results);
    $memory_ok = validate_memory_limit($results);
    $extensions_ok = validate_extensions($results);
    $module_ok = validate_apache_module($results);
    $required_functions = checkDisabledFunctions($results);
    $check_execution_time = checkMaxExecutiontime($results);
    // $compatibility_mode_ok = validate_zend_compatibility_mode($results);

    foreach ($results as $result) {
        echo '<br/><span class="'.$result->status.'">'.$result->status.'</span> &mdash; '.$result->message.'';
    } // foreach
    ?>
						<!-- -->
						</p>
						
						<?php if ($php_ok && $memory_ok && $extensions_ok && $module_ok && $required_functions && $check_execution_time) {
        ?>
			<div class="woocommerce-message woocommerce-tracker" >
				<p id="pass">OK, tudo certo para executar o Tikiri</p>
				
			</div>
<?php 
    } else {
        ?>
			<div class="woocommerce-message woocommerce-tracker " >
				<p id="fail">Seu ambiente ainda não suporta o Tikiri.</p>
				</div>
		 <?php 
    } ?>
						
			
						
						<br><span class="ok">Ok</span> — Tudo certo
						<br><span class="warning">Warning</span> &mdash; Não é um impeditivo de continuar a instalação, mas é necessário para executar alguns recursos do Tikiri.
						<br><span class="error">Error</span> &mdash; O Tikiri não funciona sem esse recurso.

						<br>
						<br>


				</div>
		<p style="text-align: center;">Copyright © 2015 - 2016 · Ladybird Web Solution Pvt Ltd. All Rights Reserved. Powered by <a href="http://www.faveohelpdesk.com" target="_blank">Faveo</a><br>
        Versão alterada/adaptada para <a href="https://tikiri.com.br" target="_blank">tikiri.com.br</a></p>
		</body>
	
</html>
<?php
    unset($_SESSION['check']);
} else {
    header('location: index.php');
}
?>