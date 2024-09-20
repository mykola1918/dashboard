<?php
$conn = new mysqli('localhost', 'root', '', 'library');
$id = $_GET['id'];

// delete from db
$query = "DELETE FROM books WHERE id = $id";
$conn->query($query);

header("Location: /main");
?>
