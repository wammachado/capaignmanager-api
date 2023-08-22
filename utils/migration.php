<?php

if (!in_array(PHP_SAPI, ['cli', 'phpdbg'], true)) {   
   return ! isset($_SERVER['REMOTE_ADDR']) && ! isset($_SERVER['REQUEST_METHOD']);
}

require_once 'config/database.php';

class MitgrationCampaing
{
    public function up()
    {

      global $conn;
        $query = "CREATE TABLE  IF NOT EXISTS `campanhas` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `nome` varchar(255) NOT NULL,
                  `orcamento` decimal(10,2) NOT NULL,
                  `publico` varchar(255) NOT NULL,
                  `data_inicio` date NOT NULL,
                  `data_termino` date NOT NULL,
                  `foto_video` varchar(255) DEFAULT NULL,
                  `status` varchar(20) NOT NULL,
                  PRIMARY KEY (`id`)
               ) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

        $result = $conn->query($query);

        if($result){
           echo "Tabela campanhas criada com sucesso".PHP_EOL;
         }else{
             echo "Erro ao criar tabela campanhas".PHP_EOL;
          }
    }

    public function down()
    {
        $query = "DROP TABLE campanhas";

        $result = $conn->query($query);

        if($result){
            echo "Tabela campanhas excluída com sucesso".PHP_EOL;
         }else{
            echo "Erro ao excluir tabela campanhas".PHP_EOL;
         }
    }
}



   $mitgrationCampaing = new MitgrationCampaing();
   $type = $argv[1] ?? null;
   
   if ($type == 'up') {
       $mitgrationCampaing->up();
   } else if ($type == 'down') {
       $mitgrationCampaing->down();
   } else {
       echo "Informe o tipo de migração (up ou down)".PHP_EOL;
   }



