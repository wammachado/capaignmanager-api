<?php

require_once 'models/Campanha.php';

/**
 * Class CampanhaController
 */
class CampanhaController
{

    /**
     * @param null $id
     * @param array $data
     * @return array
     */
    public function create($id = null, array $data = []): array
    {

        if (!isset($data['nome']) || !isset($data['orcamento']) || !isset($data['publico']) || !isset($data['dataInicio']) || !isset($data['dataTermino']) || !isset($data['fotoVideo']) || !isset($data['status'])) {
            return [
                'success' => 0,
                'error' => [
                    'message' => 'Missing required fields',
                ],
                'data' => [],
            ];
        }

        $campanha = new Campanha(
            $data['nome'],
            $data['orcamento'],
            $data['publico'],
            $data['dataInicio'],
            $data['dataTermino'],
            $data['fotoVideo'],
            $data['status']
        );

        $id = $campanha->save();

        if ($id) {
            return [
                'success' => 1,
                'error' => [],
                'data' => $this->get($id),
            ];
        } else {
            return [
                'success' => 0,
                'error' => [
                    'message' => 'Error creating campaign',
                ],
                'data' => [],
            ];
        }
    }
    /**
     * @param $id
     * @return array
     */
    public function get($id = null): array
    {

        $campanha = Campanha::getById($id);

        if ($campanha) {
            return $campanha;
        } else {
            return [
                'success' => 0,
                'error' => [
                    'message' => 'campaign not found',
                ],
                'data' => [],
            ];
        }

    }

    /**
     * @param $id
     * @param array $data
     * @return array
     */
    public function update($id = null, array $data = []): array
    {

        $campanha = Campanha::getById($id);

        if ($campanha) {
            $campanha = new Campanha(
                $data['nome'] ?? $campanha['nome'],
                $data['orcamento'] ?? $campanha['orcamento'],
                $data['publico'] ?? $campanha['publico'],
                $data['dataInicio'] ?? $campanha['data_inicio'],
                $data['dataTermino'] ?? $campanha['data_termino'],
                $data['fotoVideo'] ?? $campanha['foto_video'],
                $data['status'] ?? $campanha['status']
            );

            if ($campanha->update($id)) {
                return [
                    'success' => 1,
                    'error' => [],
                    'data' => $this->get($id),
                ];
            } else {
                return [
                    'success' => 0,
                    'error' => [
                        'message' => 'Error updating campaign',
                    ],
                    'data' => [],
                ];
            }
        } else {
            return [
                'success' => 0,
                'error' => [
                    'message' => 'campaign not found',
                ],
                'data' => [],
            ];
        }

    }
    /**
     * @param $id
     * @return array
     */
    public function delete($id): array
    {
        $campanha = Campanha::getById($id);

        if ($campanha) {
            $campanhadelete = Campanha::delete($id);

            if ($campanhadelete) {
                return [
                    'success' => 1,
                    'error' => [],
                    'data' => [],
                ];
                
            } else {
                return [
                    'success' => 0,
                    'error' => [
                        'message' => 'Error deleting campaign',
                    ],
                    'data' => [],
                ];
            }
        } else {
            return [
                'success' => 0,
                'error' => [
                    'message' => 'campaign not found',
                ],
                'data' => [],
            ];
        }
    }
    /**
     * @return array
     */
    public function getAll(): array
    {
        $campanhas = Campanha::listAll();
        return $campanhas;
    }
}
