# Avaliador de Ambiente para o Tikiri

<br><img src="https://img.shields.io/badge/License-OSL-blue.svg">

**Créditos**
1. Faveo Probe


Utilize este avaliador para verificar se você pode executar o [Tikiri](https://tikiri.com.br) no seu servidor. 

**Requisitos:**

Antes de executar este teste, os componentes a seguir devem ser instalados em seu servidor

1. Servidor Web: Apache or IIS or Nginx
2. Versão do PHP: 5.6
3. Servidor de Banco de Dados: MySQL(5.0+)
4. Extensões do Servidor Web: Pretty URLs ou Search Engine Friendly URL's tem que estar habilitadas no servidor WEB

**Instruções:**

1. Faça o download da última versão do Avaliador do GitHub, 
2. Descompacte na Documento Root do servidor web,
3. Abra o ``index.php`` no seu navegador, 
4. O script executará o teste de ambiente e mostrará os resultados.


**O teste mostrará um dos três resultados abaixo:**

1. <span style="color: green">**Ok** (green)</span> - Tudo certo para executar o Tikiri.
2. <span style="color: orange">**Warning** (orange)</span> - Não é um impeditivo de continuar a instalação, mas é necessário para executar alguns recursos do Tikiri.
3. <span style="color: red">**Error** (red)</span> - O Tikiri não funciona sem esse recurso os recursos apontados como ausentes.

Faveo probe is designed & developed by <a href="http://www.ladybirdweb.com" target="_blank">Ladybird Web Solution Pvt Ltd</a>, and launched in February 2016. Versão alterada/adaptada para <a href="https://tikiri.com.br" target="_blank">tikiri.com.br</a>


