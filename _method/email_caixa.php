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



if(empty($_POST['cname'])  or empty($_POST['cemail']) or empty($_POST['cassunto']) or empty($_POST['ccorpo']))
{
    $errors .= "\n Error: Todos os campos são necessarios";
}

	$name = $_POST['cname'];
	$email_address = $_POST['cemail'];
	$telefone = $_POST['ctelefone'];
	$assunto = $_POST['cassunto'];
	$endereco = $_POST['cend'];
	$corpo = $_POST['ccorpo'];
	$answer = $_POST['limp']; 
    
    if(!empty($_POST['cagua'])) {
	    $local01 = $_POST['cagua'];
    }

    if ($answer == "ind") {          
	    $proposta = 'Reservatorio Industrial';     
	}
	else if ($answer == "pred") {          
	    $proposta = 'Reservatorio Predial';     
	}
	else if ($answer == "resi") {          
	    $proposta = "Caixa d'água residencial";     
	}
	else if ($answer == "comer") {          
	    $proposta = "Caixa d'água comercial";
	}

	$mail->Subject = $assunto; 
 
	// Corpo do email
	$mail->Body = "Você recebeu um novo orçamento de Limpeza de $proposta".
		"\n\nSegue aqui os detalhes:\r Nome: $name \r ".
		"Email: $email_address \n Telefone: $telefone\nEndereço: $endereco\n\nMedidas dos locais: \nCaixa d'agua: $local01 \n\n\n Mensagem: \n\n $corpo";
	 
	// Envia o e-mail
	$enviado = $mail->Send();

	if ($enviado) {
     header('Location: ../orcamento.html');
	} else {
     echo "Houve um erro enviando o email: ".$mail->ErrorInfo;
}
?>