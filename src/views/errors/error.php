<header>
    <h2 class="error">Error <?php echo $code ?>!<br> Error message: <?php echo $message ?></h2>
</header>

<div>
    <form action="/account/login" method="post" class="form go-login">
        <input type="submit" value="Go to login page" class="gray go-login-btn">
    </form>
    <form action="/tasks/show" method="post" class="form go-tasks">
        <input type="submit" value="Go to tasks page" class="gray go-tasks-btn error-tasks-btn">
    </form>
</div>