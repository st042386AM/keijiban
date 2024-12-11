<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲示板</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>掲示板</h1>
    </header>

    <nav>
        <a href="#home">ホーム</a>
        <a href="#news">新着情報</a>
	<a href="#post">投稿</a>
        <a href="#contact">お問い合わせ</a>
	<a href="#view">投稿一覧</a>
    </nav>

    <main>
        <!-- ホームセクション -->
        <section id="home">
            <h2>ようこそ</h2>
            <p>こちらは掲示板システムです。情報の投稿、検索、新着情報の確認、お問い合わせが可能です。</p>
        </section>


	<!-- 新着情報セクション -->
        <section id="news">
            <h2>新着情報投稿フォーム</h2>
            <form method="POST" action="submit_news.php">
                <input type="text" name="title" placeholder="タイトル" required>
                <select name="genre">
                    <option value="一般">一般</option>
                    <option value="アニメ">アニメ</option>
                    <option value="ゲーム">ゲーム</option>
                    <option value="スポーツ">スポーツ</option>
                </select>
                <button type="submit">新着情報を追加</button>
            </form>
        </section>

        <!-- 投稿セクション -->
        <section id="post">
            <h2>投稿フォーム</h2>
            <form method="POST" action="submit.php">
                <input type="text" name="name" placeholder="名前" required>
                <textarea name="content" placeholder="内容" required></textarea>
                <select name="genre">
                    <option value="一般">一般</option>
                    <option value="アニメ">アニメ</option>
                    <option value="ゲーム">ゲーム</option>
                    <option value="スポーツ">スポーツ</option>
                </select>
                <button type="submit">投稿</button>
            </form>
        </section>


        <!-- お問い合わせセクション -->
        <section id="contact">
            <h2>お問い合わせフォーム</h2>
            <form method="POST" action="contact_submit.php">
                <input type="text" name="name" placeholder="名前" required>
                <input type="email" name="email" placeholder="メールアドレス" required>
                <textarea name="message" placeholder="メッセージ" required></textarea>
                <button type="submit">送信</button>
            </form>
        </section>


	<!-- 投稿一覧セクション -->
        <section id="view">
	<h2>投稿一覧</h2>
<?php foreach ($organizedPosts as $post): ?>
    <div class="post">
        <strong><?= htmlspecialchars($post['name']) ?></strong>
        <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
        <small>投稿日: <?= htmlspecialchars($post['created_at']) ?></small>

        <!-- 返信フォーム -->
        <div class="reply-form">
            <form method="POST" action="reply.php">
                <input type="hidden" name="parent_id" value="<?= $post['id'] ?>">
                <input type="text" name="name" placeholder="返信者の名前">
                <textarea name="content" placeholder="返信内容"></textarea>
                <button type="submit">返信</button>
            </form>
	</section>
        </div>

        <!-- 返信の表示 -->
        <?php if (!empty($post['replies'])): ?>
            <div class="reply">
                <?php foreach ($post['replies'] as $reply): ?>
                    <div>
                        <strong><?= htmlspecialchars($reply['name']) ?></strong>
                        <p><?= nl2br(htmlspecialchars($reply['content'])) ?></p>
                        <small>投稿日: <?= htmlspecialchars($reply['created_at']) ?></small>
                    </div>
                    <hr>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
<?php endforeach; ?>


    </main>

    <footer>
        <p>&copy; 2024 掲示板サイト</p>
    </footer>
</body>
</html>
