<?php
//connecting to db
$conn = new mysqli('localhost', 'root', '', 'library');

//limit na storinku
$limit = 5; 
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$query = "SELECT * FROM books LIMIT $limit OFFSET $offset";
$result = $conn->query($query);

$totalBooks = $conn->query("SELECT COUNT(*) AS total FROM books")->fetch_assoc()['total'];
$totalPages = ceil($totalBooks / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Free Library</title>
    @vite('resources/css/app.css')
</head>
<body>
    <h1>Free Library</h1>
    
    <div class="pagination"><a href="add">Add a Book</a></div>
    <table border="1">
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Description</th>
            <th>Download</th>
            <th>Actions</th>
        </tr>
        
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['author']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td>
                    <?php if ($row['file_path']) : ?>
                        <a href="uploads/<?php echo $row['file_path']; ?>" download>Download</a>
                    <?php else : ?>
                        No file available
                    <?php endif; ?>
                </td>
                <td>
                    <a href="edit?id=<?php echo $row['id']; ?>">Edit</a> |
                    <a href="delete?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>
</body>
</html>
