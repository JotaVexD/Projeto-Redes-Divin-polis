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


if(empty($_POST['fname'])  or empty($_POST['email']) or empty($_POST['assunto']) or empty($_POST['corpo']))
{
    $errors .= "\n Error: Todos os campos são necessarios";
}

	$name = $_POST['fname'];
	$email_address = $_POST['email'];
	$telefone = $_POST['telefone'];
	$assunto = $_POST['assunto'];
	$corpo = $_POST['corpo'];
    $answer = $_POST['dedet']; 
	 
	if ($answer == "apt") {          
	    $proposta = 'Apartamento';     
	}
	else if ($answer == "casa") {          
	    $proposta = 'Casa';     
	}
	else if ($answer == "sitio") {          
	    $proposta = 'Sitio';     
	}
	else if ($answer == "fazenda") {          
	    $proposta = 'Fazenda';     
	}
	else if ($answer == "empresa") {          
	    $proposta = 'Empresa';     
	}

	$mail->Subject = $assunto; 
 
	// Corpo do email
	$mail->Body = "Você recebeu um novo orçamento de Limpeza de $proposta".
		"\n\nSeque aqui os detalhes:\r Nome: $name \r ".
		"Email: $email_address \n Telefone: $telefone\nEndereço: $endereco\n\nMensagem: \n\n $corpo";
	 
	// Envia o e-mail
	$enviado = $mail->Send();

	if ($enviado) {
     header('Location: ../orcamento.html');
	} else {
     echo "Houve um erro enviando o email: ".$mail->ErrorInfo;
}
?>
?>