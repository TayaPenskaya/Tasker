<header>
    <h2>List of tasks</h2>
    <?php if ($isAdmin) :?>
        <div class="form right">
            <p class="admin-text"> You are logged in as admin </p>
            <form action="/admin/logout" class="go-logout">
                <input type="submit" value="Go to logout page" class="gray go-logout-btn">
            </form>
        </div>
    <?php else : ?>
        <form action="/account/login" method="post" class="right go-login">
            <input type="submit" value="Go to login page" class="gray go-login-btn">
        </form>
    <?php endif; ?>
</header>

<div class="grid-box">
    <div class="tasks-list">
        <div class="task">
            <p>Name</p>
            <p>Email</p>
            <p>Text</p>
            <p>Done</p>
            <p>Delete</p>
        </div>
        <?php for ($i = 0; $i < count($tasks); ++$i): ?>
            <div class="task">
                <?php $task = $tasks[$i] ?>
                <p><?php echo $task->getName()?></p>
                <p><?php echo $task->getEmail()?></p>
                <p><?php echo $task->getText()?></p>
                <form method="post">
                    <?php if ($task->getIsDone()) : ?>
                        <input type="submit" name=<?php echo "check-is-done-".$i?> value="+" class="table-btn check-plus">
                    <?php else : ?>
                        <input type="submit" name=<?php echo "check-is-done-".$i?> value="-" class="table-btn check-minus">
                    <?php endif; ?>
                </form>
                <form method="post">
                    <input type="submit" name=<?php echo "delete-".$i?> value="x" class="table-btn delete-btn">
                </form>
                <p></p>
            </div>
        <?php endfor; ?>
    </div>

    <div class="wrapper-form form-for-new-task">
        <h3>Add new task</h3>
        <form method="post" class="form add-form">
            <label for="name">Name</label>
            <input type="text" id="name" name="name">
            <label for="email">Email</label>
            <input type="text" id="email" name="email">
            <label for="text">Text</label>
            <input type="text" id="text" name="text">
            <input type="submit" value="Submit">
        </form>
    </div>


    <div class="wrapper-form form-for-sorting-tasks">
        <h3>Sorting</h3>
        <form method="post" class="form sort-form" id="sort-form">
            <div>
                <input type="radio" id="byName" name="sort" value="name" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "name") echo "checked"?>>
                <label for="byName">By name</label>
            </div>
            <div>
                <input type="radio" id="byEmail" name="sort" value="email" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "email") echo "checked"?>>
                <label for="byEmail">By email</label>
            </div>
            <div>
                <input type="radio" id="byStatus" name="sort" value="status" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "status") echo "checked"?>>
                <label for="byStatus">By status</label>
            </div>
        </form>
    </div>

</div>

