<?php

session_start();


if(isset($_POST['add-todo']))
{
    $_SESSION['todo'] = [
        'title' => $_POST['title'],
        'list' => [
            [ 's_title' => '', 'hour' => '' ]
        ]
    ];
}

if(isset($_POST['add-subtodo']) && isset($_SESSION['todo']))
{

    foreach ($_SESSION['todo']['list'] as $i => $todo) {
        $_SESSION['todo']['list'][$i] = ['s_title' => $_POST['s_title'][$i], 'hour' => $_POST['hour'][$i]];
    }

    $_SESSION['todo']['list'][] = [ 's_title' => '', 'hour' => '' ];
}

if(isset($_POST['remove-subtodo'])) {

    $i = $_POST['remove-subtodo'];

    array_splice($_SESSION['todo']['list'], $i, 1);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>


    <div class="container py-3">
        <h1>Todo App</h1>

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form method="post">
                    <div class="py-1">
                        <label class="form-label">Title todo</label>
                        <input type="text" class="form-control" name="title" value="<?= isset($_SESSION['todo']) ? $_SESSION['todo']['title'] : '' ?>">
                    </div>
                    <div>

                        <?php if(isset($_SESSION['todo'])) : ?>

                        <label class="form-label">Subtodos list</label>

                        <?php if(sizeof($_SESSION['todo']['list'])) :

                            foreach($_SESSION['todo']['list'] as $i => $todo) : ?>
                        <div class="row my-2">
                            <div class="col-6">
                                <input type="text" class="form-control" name="s_title[]" value="<?= $todo['s_title'] ?>">
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control" min="0" name="hour[]" value="<?= $todo['hour'] ?>">
                            </div>
                            <div class="col-4">
                                <button class="btn btn-danger" name="remove-subtodo" value="<?= $i ?>">Remove</button>
                            </div>
                        </div>
                        <?php endforeach;
                            else :
                        ?>
                            <h2 class="text-muted">No subtodos</h2>
                        <?php endif; ?>


                        <div class="pt-4 d-grid">
                            <button class="btn btn-outline-primary" name="add-subtodo">Add subtodo</button>
                        </div>

                        <?php endif; ?>


                        <hr>

                        <div class="pt-4 d-grid">
                            <button class="btn btn-outline-success" name="add-todo">Add todo</button>
                        </div>


                    </div>
                </form>
            </div>
        </div>


    </div>

</body>
</html>
