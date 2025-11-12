Uma configuração crítica do servidor Apache, que é fundamental 
para URLs amigáveis (ex: /produtos/ver/1 em vez de index.php?page=produtos&action=ver&id=1), 
é a habilitação do mod_rewrite. Isso é feito no arquivo httpd.conf (ou configuração de virtual host), 
garantindo que AllowOverride All esteja definido para o diretório do projeto, 
permitindo que o arquivo .htaccess local sobrescreva as regras de roteamento.
