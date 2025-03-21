<?php
// Definir cabeçalhos
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Incluir arquivo de funções auxiliares
require_once 'save_message.php';

// Função para sanitizar a entrada
function sanitize_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Verificar se o método da requisição é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obter JSON da requisição
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);
  
  // Se os dados foram decodificados corretamente
  if ($data) {
    // Sanitizar e validar os dados
    $name = isset($data['name']) ? sanitize_input($data['name']) : '';
    $email = isset($data['email']) ? sanitize_input($data['email']) : '';
    $phone = isset($data['phone']) ? sanitize_input($data['phone']) : '';
    $subject = isset($data['subject']) ? sanitize_input($data['subject']) : '';
    $message = isset($data['message']) ? sanitize_input($data['message']) : '';
    
    // Verificar dados obrigatórios
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
      http_response_code(400);
      echo json_encode(['success' => false, 'message' => 'Por favor, preencha todos os campos obrigatórios.']);
      exit;
    }
    
    // Validar email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      http_response_code(400);
      echo json_encode(['success' => false, 'message' => 'Por favor, forneça um email válido.']);
      exit;
    }
    
    // Salvar mensagem em um arquivo de backup
    $formData = [
      'name' => $name,
      'email' => $email,
      'phone' => $phone,
      'subject' => $subject,
      'message' => $message
    ];
    
    // Salvar a mensagem como backup
    $saved = save_contact_message($formData);
    
    // Configurar destinatário
    $to = 'comercial.jeanzim@jeanfelipe.dev'; // Seu email
    
    // Configurar cabeçalhos do email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: $name <$email>" . "\r\n";
    
    // Criar o corpo do email
    $email_body = "
      <html>
      <head>
        <title>Nova mensagem do formulário de contato</title>
        <style>
          body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
          .container { max-width: 600px; margin: 0 auto; padding: 20px; }
          h2 { color: #0070f3; }
          .info { margin-bottom: 20px; }
          .label { font-weight: bold; }
        </style>
      </head>
      <body>
        <div class='container'>
          <h2>Nova mensagem do formulário de contato</h2>
          <div class='info'>
            <p><span class='label'>Nome:</span> $name</p>
            <p><span class='label'>Email:</span> $email</p>
            <p><span class='label'>Telefone:</span> $phone</p>
            <p><span class='label'>Assunto:</span> $subject</p>
            <p><span class='label'>Mensagem:</span></p>
            <p>" . nl2br($message) . "</p>
          </div>
        </div>
      </body>
      </html>
    ";
    
    // Tentar enviar o email
    $mail_sent = mail($to, "Contato do site: $subject", $email_body, $headers);
    
    // Verificar se o email foi enviado
    if ($mail_sent) {
      http_response_code(200);
      echo json_encode(['success' => true, 'message' => 'Mensagem enviada com sucesso!']);
    } else {
      // Log do erro (opcional)
      error_log("Falha ao enviar email: " . error_get_last()['message']);
      
      // Se falhou enviar email mas conseguiu salvar a mensagem
      if ($saved) {
        http_response_code(200);
        echo json_encode([
          'success' => true,
          'message' => 'Sua mensagem foi recebida e salva. Entraremos em contato em breve.'
        ]);
      } else {
        http_response_code(500);
        echo json_encode([
          'success' => false,
          'message' => 'Não foi possível enviar sua mensagem. Tente novamente mais tarde.'
        ]);
      }
    }
  } else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Dados inválidos.']);
  }
} else {
  http_response_code(405);
  echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
}
?> 