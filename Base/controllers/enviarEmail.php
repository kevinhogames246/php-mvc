<?php
  $data_envio = date('d/m/Y');
  $hora_envio = date('H:i:s');

  //Compo E-mail
  $arquivo = "
    <html>
      <p><b>Nome: </b>Kevin</p>
      <p><b>E-mail: </b>kevinqcardoso@gmail.com</p>
      <p><b>Mensagem: </b>tsetes_2</p>
      <p>Este e-mail foi enviado em <b>$data_envio</b> às <b>$hora_envio</b></p>
    </html>
  ";
  
  //Emails para quem será enviado o formulário
  $destino = "kevinqcardoso@gmail.com";
  $assunto = "Contato pelo Site";

  //Este sempre deverá existir para garantir a exibição correta dos caracteres
  $headers  = "MIME-Version: 1.0\n";
  $headers .= "Content-type: text/html; charset=iso-8859-1\n";
  $headers .= "From: Health Track <health.track.contato@gmail.com";

  //Enviar
  mail($destino, $assunto, $arquivo, $headers);
  
  echo "tenta lá";
  // echo "<meta http-equiv='refresh' content='10;URL=contato.html'>";
?>