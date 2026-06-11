<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if (!$post) {
    header('Location: index.php');
    exit;
}

// Only owner or admin can edit
if ($post['user_id'] != $_SESSION['user_id'] && $_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    // Validation
    if (empty($title) || empty($content)) {
        $error = "All fields are required!";
    } elseif (strlen($title) < 5) {
        $error = "Title must be at least 5 characters!";
    } elseif (strlen($content) < 10) {
        $error = "Content must be at least 10 characters!";
    } else {
        $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
        if ($stmt->execute([$title, $content, $id])) {
            header('Location: index.php');
            exit;
        } else {
            $error = "Failed to update post!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4">
    <span class="navbar-brand">📝 Blog App</span>
    <a href="index.php" class="btn btn-outline-light btn-sm">Back to Posts</a>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h3 class="mb-4">✏️ Edit Post</h3>
                    <?php if($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Post Title <small class="text-muted">(min 5 characters)</small></label>
                            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($post['title']); ?>" minlength="5" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Post Content <small class="text-muted">(min 10 characters)</small></label>
                            <textarea name="content" class="form-control" rows="6" minlength="10" required><?php echo htmlspecialchars($post['content']); ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>