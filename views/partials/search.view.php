<form action="" method="post" id="searchForm">
    <h1>Buscar post</h1>
    <input id="search" type="search" name="search" value="<?= $_SERVER['REQUEST_METHOD'] == 'POST' ? $_POST['search'] : '' ?>">
    <button type="submit" class="btn btn-primary">Buscar</button>
</form>