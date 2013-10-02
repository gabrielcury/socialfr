<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'frsocial');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'mysql');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'b469OmExksQ7@z{ud8nBiam3Y2>@6oI?mN^dOO;<FO18}[N&k?9jam,u]P?M>hYV');
define('SECURE_AUTH_KEY',  'u_=T18[Ack*nKiF{?XHOo_zY,W46Dc.[Evng+WLsDK%Rp6=/z0LMx*l6F?kyk;6*');
define('LOGGED_IN_KEY',    'r<7i)P?Oy-yPomICO0-R_?+G.VAn]VpF`SyTM/E|>w7E@;wZrd$REN.RF]h5{6>Q');
define('NONCE_KEY',        '*@qNpHlb>~7HpJs&|Wq,7=A@!i24E::+|J(jC6n7iJ$V>M?M+[J[I_|2)<k,FptM');
define('AUTH_SALT',        'kX$V!.x8K+Pm}|O:xUby!`yu$lp]hOeh8:ubp~Ghz;8<UMt;]JhY7DBSXiIE?F2R');
define('SECURE_AUTH_SALT', 'Fhc2<#`MN&@*1^B-^_TSPo_%!AwOdsaDf!S)(v&Mab[6r$JUh[!N35M-0!Kq]=6H');
define('LOGGED_IN_SALT',   '$Ig/$.@>E0<NVhWkEHSFdr]:H91yFMJ<%pEk60T:P%,@!m$s+F!h2Wj0;L${k2EJ');
define('NONCE_SALT',       '6>#<OA0*hZP[aD;uR-;9~+m7+GVt B}3flu C:Qk|H68jt^P{3|?k%?:AECm@99X');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'm80ucs_';

/**
 * O idioma localizado do WordPress é o inglês por padrão.
 *
 * Altere esta definição para localizar o WordPress. Um arquivo MO correspondente ao
 * idioma escolhido deve ser instalado em wp-content/languages. Por exemplo, instale
 * pt_BR.mo em wp-content/languages e altere WPLANG para 'pt_BR' para habilitar o suporte
 * ao português do Brasil.
 */
define('WPLANG', 'pt_BR');

/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
//Disable File Edits
define('DISALLOW_FILE_EDIT', true);