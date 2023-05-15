<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Home about</title>
</head>
<style>
    body {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 20px;
    }
</style>
<body>
<main>
    <div class="alert alert-danger" role="alert">
        <pre>
            <?= $message ?>
        </pre>

    </div>
    <div class="alert alert-secondary" role="alert">
        <pre>
            <?= $trace ?>
        </pre>

    </div>

</main>
</body>
</html>