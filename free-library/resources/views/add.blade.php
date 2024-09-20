<?php
$conn = new mysqli('localhost', 'root', '', 'library');

// check submitting
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // no spec chars, hence secured al
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // upload file
    $file_path = '';
    if ($_FILES['file']['name']) {
        $file_path = basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], "uploads/" . $file_path);
    }

    // insert book into db
    $query = "INSERT INTO books (title, author, description, file_path) 
              VALUES ('$title', '$author', '$description', '$file_path')";
              
    // check for errors
    if ($conn->query($query) === TRUE) {
        // index.php if succeded
        header("Location: main");
    } else {
        // error if failed
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Book</title>
    @vite('resources/css/app.css')
</head>
<body>
    <h1>Add a New Book</h1>

    <form action="add" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" required><br>

        <label for="author">Author:</label>
        <input type="text" name="author" required><br>

        <label for="description">Description:</label>
        <textarea name="description"></textarea><br>

        <label for="file">Upload Book (PDF):</label>
        <input type="file" name="file"><br>

        <input type="submit" value="Add Book">
    </form>
</body>
</html>
