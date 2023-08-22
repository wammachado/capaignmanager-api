<?php

require_once 'config/database.php';
/*
    * Class Campanha
*/
class Campanha {
    private $id;
    private $nome;
    private $orcamento;
    private $publico;
    private $dataInicio;
    private $dataTermino;
    private $fotoVideo;
    private $status;
    /*
        * Campanha constructor
    */
    public function __construct($nome, $orcamento, $publico, $dataInicio, $dataTermino, $fotoVideo, $status) {
        $this->nome = $nome;
        $this->orcamento = $orcamento;
        $this->publico = $publico;
        $this->dataInicio = $dataInicio;
        $this->dataTermino = $dataTermino;
        $this->fotoVideo = $fotoVideo;
        $this->status = $status;
    }
    /*
        * @return mixed
    */
    public function save() {
        global $conn;

        $query = "INSERT INTO campanhas (nome, orcamento, publico, data_inicio, data_termino, foto_video, status)
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sdsssss", $this->nome, $this->orcamento, $this->publico, 
                          $this->dataInicio, $this->dataTermino, $this->fotoVideo, $this->status);
        
        if ($stmt->execute()) {            
            return $stmt->insert_id;
        } else {
            return false;
        }
    }
    /*
        * @param $id
        * @return array|null
    */
    public static function getById($id) {
        global $conn;

        $query = "SELECT * FROM campanhas WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("d", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        
        if ($result->num_rows > 0) {
         
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }
    /*
        * @param $id
        * @return bool
    */
    public function update($id) {
      global $conn;

      $query = "UPDATE campanhas SET nome = ?, orcamento = ?, publico = ?, 
                data_inicio = ?, data_termino = ?, foto_video = ?, status = ? WHERE id = ?";
      
      
      $stmt = $conn->prepare($query);
      $stmt->bind_param("sdsssssd", $this->nome, $this->orcamento, $this->publico, 
                        $this->dataInicio, $this->dataTermino, $this->fotoVideo, $this->status, $id);
      
      return $stmt->execute();
  }
  /*
      * @param $id
      * @return bool
  */
  public static function delete($id) {
      global $conn;
      
      $query = "DELETE FROM campanhas WHERE id = ?";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("d", $id);

      return $stmt->execute();
  }
  /*
      * @return array
  */
  public static function listAll() {
      global $conn;

      $query = "SELECT * FROM campanhas";
      $result = $conn->query($query);

      $campanhas = [];

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $campanhas[] = $row;
          }
      }

      return $campanhas;
  }

    
}
