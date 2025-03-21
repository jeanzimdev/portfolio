<?php
// Função para salvar mensagens em um arquivo
function save_contact_message($data) {
  // Cria um diretório 'messages' se não existir
  $dir = __DIR__ . '/messages';
  if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
  }
  
  // Definir arquivo que armazenará as mensagens (cada mensagem em uma nova linha)
  $file = $dir . '/contact_messages.txt';
  
  // Formatar mensagem com data e hora
  $timestamp = date('Y-m-d H:i:s');
  $message = "[{$timestamp}] ";
  $message .= "NOME: {$data['name']} | ";
  $message .= "EMAIL: {$data['email']} | ";
  $message .= "TELEFONE: {$data['phone']} | ";
  $message .= "ASSUNTO: {$data['subject']} | ";
  $message .= "MENSAGEM: {$data['message']}\n";
  
  // Salvar mensagem no arquivo (modo append)
  return file_put_contents($file, $message, FILE_APPEND | LOCK_EX);
}
?> 