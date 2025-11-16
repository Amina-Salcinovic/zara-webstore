<?php
require_once 'BaseService.php';
// require_once '../dao/CategoriesDao.php';
require_once __DIR__ . '/../dao/CategoriesDao.php';

class CategoriesService extends BaseService {
   public function __construct() {
       $dao = new CategoriesDao();
       parent::__construct($dao);
   }
   public function getByUserId($user_id) {
       return $this->dao->getByUserId($user_id);
   }

   public function createCategories($data) {
        if (empty($data['name'])) {
            throw new Exception('Category name cannot be empty.');
        }

        if (strlen($data['name']) < 3) {
            throw new Exception('Category name must be at least 3 characters long.');
        }

        return $this->dao->create($data);
    }
    public function updateCategory($id, $data) {
        if (empty($data['name'])) {
            throw new Exception('Category name cannot be empty.');
        }

        if (strlen($data['name']) < 3) {
            throw new Exception('Category name must be at least 3 characters long.');
        }

        return $this->dao->update($id, $data);
    }
     public function deleteCategory($id) {
        return $this->dao->delete($id);
    }
    public function partialUpdateCategory($id, $data) {
    $category = $this->dao->getById($id); // check if exist

    if (!$category) {
        return false; // exception / HTTP 404
    }

    // update fields that exists in $data
    $updatedData = [
        'name' => $data['name'] ?? $category['name'],
        'description' => $data['description'] ?? $category['description']
    ];

    return $this->dao->updateCategory($id, $updatedData);
}

}
?>
