<?php
$conn = new mysqli('localhost', 'root', '', 'library');
$id = $_GET['id'];

// fetch the details of my books
$book = $conn->query("SELECT * FROM books WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];

    // File upload
    $file_path = $book['file_path'];
    if ($_FILES['file']['name']) {
        $file_path = basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], "uploads/" . $file_path);
    }

    // book dets
    $query = "UPDATE books SET title='$title', author='$author', description='$description', file_path='$file_path' WHERE id=$id";
    $conn->query($query);

    header("Location: main");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Book</title>
    @vite('resources/css/app.css')
</head>
<body>
    <h1>Edit Book</h1>

    <form action="edit?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo $book['title']; ?>" required><br>

        <label for="author">Author:</label>
        <input type="text" name="author" value="<?php echo $book['author']; ?>" required><br>

        <label for="description">Description:</label>
        <textarea name="description"><?php echo $book['description']; ?></textarea><br>

        <label for="file">Upload New File (optional):</label>
        <input type="file" name="file"><br>

        <input type="submit" value="Update Book">
    </form>
</body>
</html>
