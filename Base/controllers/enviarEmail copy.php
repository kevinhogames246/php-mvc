<?php
  //Variáveis
  $codigo = $_POST['codigo'];
  $email = $_POST['email'];

  //Compo E-mail
  $arquivo = "
    <html>
      <p><b>Nome: </b>$codigo</p>
    </html>
  ";
  
  //Emails para quem será enviado o formulário
  $destino = "$email";
//   $destino = "edipojoseoliveira@gmail.com";
  $assunto = "Contato pelo Site";

  //Este sempre deverá existir para garantir a exibição correta dos caracteres
  $headers  = "MIME-Version: 1.0\n";
  $headers .= "Content-type: text/html; charset=iso-8859-1\n";
  $headers .= "From: kevinqcardoso@gmail.com";

  //Enviar
  mail($email, $assunto, $arquivo, $headers);
  
//   echo "<meta http-equiv='refresh' content='10;URL=../views/testeEmail'>";
?>