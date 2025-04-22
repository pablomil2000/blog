<form action="" method="post">
    <h1>Buscar post</h1>
    <input type="search" name="search" value="<?= $_SERVER['REQUEST_METHOD'] == 'POST' ? $_POST['search'] : '' ?>">
    <button type="submit">Buscar</button>
</form>