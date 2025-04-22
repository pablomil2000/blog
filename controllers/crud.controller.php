<?php

class CrudController
{

  protected $table = null;
  protected $permissions = [];
  protected $model = null;

  private $xPage = null;
  private $page = null;
  private $totalRows = null;
  private $maxPage = null;

  public function __construct($table, $permissions = [], $paginationConfig = [])
  {
    $this->table = $table;
    $this->model = $table . 'Model';
    $this->permissions = $permissions;

    if (!empty($paginationConfig)) {
      $this->xPage = $paginationConfig['xPage'];
      $this->totalRows = $this->count();
      $maxPage = ceil($this->totalRows / $this->xPage);
      $this->maxPage = $maxPage;

      if ($paginationConfig['page'] <= 0) {
        $this->page = 1;
      } elseif ($paginationConfig['page'] > $maxPage) {
        $this->page = $maxPage;
      } else {
        $this->page = $paginationConfig['page'];
      }
    }
  }

  protected function hasPermission($permission)
  {
    return in_array($permission, $this->permissions);
  }

  public function index()
  {
    if (!$this->hasPermission('R')) {
      return false;
    }

    $rsl = $this->model::index($this->table);

    return $rsl;
  }

  public function search($data, $order = [])
  {
    if (!$this->hasPermission('R')) {
      return false;
    }

    $rsl = $this->model::search($this->table, $data, $order);

    return $rsl;
  }

  public function count($data = ['id' => '%'])
  {
    if (!$this->hasPermission('R')) {
      return false;
    }

    $rsl = $this->model::search($this->table, $data);

    return count($rsl);
  }

  public function update($id, $data = ['id' => '%'])
  {
    if (!$this->hasPermission('U')) {
      return false;
    }

    $rsl = $this->model::update($this->table, $id, $data);
    return $rsl;
  }

  public function create($data)
  {
    if (!$this->hasPermission('C')) {
      return false;
    }

    $rsl = $this->model::create($this->table, $data);
    return $rsl;
  }

  public function delete($id)
  {
    if (!$this->hasPermission('D')) {
      return false;
    }
    $rsl = $this->model::delete($this->table, $id);
    return $rsl;
  }


  // get paginations
  public function getPaginated($page = 1)
  {
    if ($page < 1) {
      $page = 1;
    } elseif ($page > $this->maxPage) {
      $page = $this->maxPage;
    }

    // calculate the offset for the current page
    $skip = ($page - 1) * $this->xPage;
    try {
      $rsl = $this->model::index($this->table, $skip, $this->xPage);
    } catch (Exception $e) {
      return [];
    }
    return $rsl;
  }

  // get pagination info
  public function getPaginationInfo()
  {
    return [
      'totalRows' => $this->totalRows,
      'maxPage' => $this->maxPage,
      'xPage' => $this->xPage,
      'page' => $this->page
    ];
  }

  // get pagination link
  public function getPaginationLink($direccion, $page)
  {
    if ($page > $this->maxPage) {
      $page = $this->maxPage;
    }
    if ($page <= 0) {
      $page = 1;
    }
    $link = $direccion . '/' . $page;
    return $link;
  }

  public function getLastInsert()
  {
    return $this->model::getLastInsert($this->table);
  }
}
