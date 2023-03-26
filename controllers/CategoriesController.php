<?php

require_once '../config/Database.php';
require_once '../models/CategoriesModel.php';

class CategoriesController
{
    private $categoriesModel;

    public function __construct()
    {
        $this->categoriesModel = new CategoriesModel();
    }

    public function getCategories()
    {
        $result = $this->categoriesModel->getCategories();
        if ($result) {
            $data = array(
                'status' => 'success',
                'code' => 200,
                'data' => $result
            );
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'No hay categorías disponibles'
            );
        }
        echo json_encode($data);
    }

    public function error()
    {
        $data = array(
            'status' => 'error',
            'code' => 404,
            'message' => 'La operación no existe'
        );
        echo json_encode($data);
    }

    public function getCategory()
    {
        $decodedId = json_decode(file_get_contents("php://input"), true);
        $id = $decodedId['id_categories'];
        $result = $this->categoriesModel->getCategory($id);
        if ($result) {
            $data = array(
                'status' => 'success',
                'code' => 200,
                'data' => $result
            );
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'No existe la categoría'
            );
        }
        echo json_encode($data);
    }

    public function createCategory()
    {
        $decodedId = json_decode(file_get_contents("php://input"), true);
        $name = $decodedId['name'];
        $observations = $decodedId['observations'];
        $result = $this->categoriesModel->createCategory($name, $observations);
        if (!$result) {
            $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Categoría creada correctamente'
            );
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Categoría no creada'
            );
        }
        echo json_encode($data);
    }

    public function updateCategory()
    {
        $decodedId = json_decode(file_get_contents("php://input"), true);
        $id = $decodedId['id_categories'];
        $name = $decodedId['name'];
        $observations = $decodedId['observations'];
        $result = $this->categoriesModel->updateCategory($id, $name, $observations);
        if (!$result) {
            $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Categoría actualizada correctamente'
            );
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Categoría no actualizada'
            );
        }
        echo json_encode($data);
    }

    public function deleteCategory()
    {
        $decodedId = json_decode(file_get_contents("php://input"), true);
        $id = $decodedId['id_categories'];
        $result = $this->categoriesModel->deleteCategory($id);
        if (!$result) {
            $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Categoría eliminada correctamente'
            );
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Categoría no eliminada'
            );
        }
        echo json_encode($data);
    }
}

$categoriesController = new CategoriesController();
if (isset($_GET['getCategories'])) {
    $categoriesController->getCategories();
} elseif (isset($_GET['getCategory'])) {
    $categoriesController->getCategory($_GET['getCategory']);
} elseif (isset($_GET['updateCategory'])) {
    $categoriesController->updateCategory($_GET['updateCategory']);
} elseif (isset($_GET['createCategory'])) {
    $categoriesController->createCategory($_GET['createCategory']);
} elseif (isset($_GET['deleteCategory'])) {
    $categoriesController->deleteCategory($_GET['deleteCategory']);
} else {
    $categoriesController->error();
}
