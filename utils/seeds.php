<?php

if (!in_array(PHP_SAPI, ['cli', 'phpdbg'], true)) {   
   return ! isset($_SERVER['REMOTE_ADDR']) && ! isset($_SERVER['REQUEST_METHOD']);
}

require_once 'config/database.php';

class Seeds{

   public function seed(){
      global $conn;

      $query = "INSERT INTO campanhas (nome, orcamento, publico, data_inicio, data_termino, foto_video, status)
                  VALUES
                     ('Campanha de Verão', 10000.00, 'Jovens adultos', '2023-06-01', '2023-08-31', 'verao.jpg', 'ativa'),
                     ('Campanha de Inverno', 8000.00, 'Famílias', '2023-12-01', '2024-02-28', 'inverno.jpg', 'ativa'),
                     ('Campanha de Lançamento', 15000.00, 'Público-alvo', '2023-09-15', '2023-09-30', 'lançamento.mp4', 'concluída');
                  ";
   
      $result = $conn->query($query);

      if($result){
         echo "Dados inseridos com sucesso".PHP_EOL;
      }else{
         echo "Erro ao inserir dados".PHP_EOL;
      }
   
   }

}

$seeds = new Seeds();
$seeds->seed();