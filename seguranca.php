
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<?php
	# Tutorial em: http://blog.thiagobelem.net/criando-um-sistema-de-login-com-php-e-mysql

	if (!isset($_SESSION)){
		session_start();
  		session_cache_expire(60);
	}

	require_once "conexao.php";

	function validaUsuario($login, $senha) {
	  	$resultado = mysql_fetch_assoc(mysql_query("select * from usuarios where login='$login' and senha=MD5('$senha')"));
	    if (empty($resultado)) {
	    	return false;
	    }
	    else{
		    $_SESSION['login'] = $login;
		    $_SESSION['senha'] = $senha;
	    	$_SESSION['nome_usuario'] = $resultado['nome_usuario'];
	    	session_write_close();
	    	session_regenerate_id();
	      	return true;
	    }
	}

	function protegePagina() {
	  	if (!isset($_SESSION['login']) OR !isset($_SESSION['senha'])) {
	  		expulsaVisitante();
	  	}
	  	else {
			if (!validaUsuario($_SESSION['login'], $_SESSION['senha'])) {
		        expulsaVisitante();
			}
		}
	}

	function expulsaVisitante() {
	  unset($_SESSION['login'], $_SESSION['senha'], $_SESSION['nome_usuario']);
	  echo "<script>window.location.href='index.php';</script>";
	}

?>
