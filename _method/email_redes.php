<?php


include "../PHPMailer-master/PHPMailerAutoload.php";
 
// Inicia a classe PHPMailer
$mail = new PHPMailer();
 
// Método de envio
$mail->IsSMTP(); // Enviar por SMTP 
$mail->Host = "mail.divirede.com.br"; // Você pode alterar este parametro para o endereço de SMTP do seu provedor
$mail->Port = 587; 
 
$mail->SMTPAuth = true; // Usar autenticação SMTP (obrigatório)
$mail->Username = '_mainaccount@divirede.com.br'; // Usuário do servidor SMTP (endereço de email)
$mail->Password = 'dad03600eb623fb3'; // Mesma senha da sua conta de email
 
// Configurações de compatibilidade para autenticação em TLS
$mail->SMTPOptions = array(
 'ssl' => array(
 'verify_peer' => false,
 'verify_peer_name' => false,
 'allow_self_signed' => true
 )
);
// $mail->SMTPDebug = 2; // Você pode habilitar esta opção caso tenha problemas. Assim pode identificar mensagens de erro.
 
// Define o remetente
$mail->From = "marcelo@divirede.com"; // Seu e-mail
$mail->FromName = "Marcelo"; // Seu nome
 
// Define o(s) destinatário(s)
$mail->AddAddress('divirede@uol.com.br', 'Maria');


if(empty($_POST['rname'])  or empty($_POST['remail']) or empty($_POST['rassunto']) or empty($_POST['rcorpo']))
{
    $errors .= "\n Error: Todos os campos são necessarios";
}

	$name = $_POST['rname'];
	$email_address = $_POST['remail'];
	$telefone = $_POST['rtelefone'];
	$assunto = $_POST['rassunto'];
	$endereco = $_POST['rend'];
	$corpo = $_POST['rcorpo'];
    
    if(!empty($_POST['jan01'])) {
	    $local01 = $_POST['jan01'];
    }
    if(!empty($_POST['jan02'])) {
    	$local02 = $_POST['jan02'];
    }
    if(!empty($_POST['jan03'])) {
    	$local03 = $_POST['jan03'];
    }

	$mail->Subject = $assunto; 
 
	// Corpo do email
	$mail->Body = "Você recebeu um novo orçamento de dedetização para Rede de Proteção".
		"\n\nSegue aqui os detalhes:\r Nome: $name \r ".
		"Email: $email_address \n Telefone: $telefone\nEndereço: $endereco\n\nMedidas dos locais: \nLocal 01: $local01 \nLocal 02: $local02 \nLocal 03: $local03\n\n\n\n Mensagem: \n\n $corpo";
		$headers =  'DIVIREDE 2018' . "\r\n";
	 
	// Envia o e-mail
	$enviado = $mail->Send();

	if ($enviado) {
     header('Location: ../orcamento.html');
	} else {
     echo "Houve um erro enviando o email: ".$mail->ErrorInfo;
}
?>