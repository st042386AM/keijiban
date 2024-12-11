<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dsn = 'mysql:host=localhost;dbname=bulletin_board;charset=utf8';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // フォームデータを取得
        $parent_id = $_POST['parent_id'];
        $name = $_POST['name'];
        $content = $_POST['content'];

        // データを挿入
        $stmt = $pdo->prepare("INSERT INTO posts (name, content, parent_id, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$name, $content, $parent_id]);

        // リダイレクトして再読み込み
        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }
}
?>
