<form action="/login" method="POST" class="container">
  <h1 class="text-center text-primary font-weight-bold">Login</h1>

  <div>
    <label for="email">Email address</label>
    <input type="email" id="email" name="email"
      class="form-control <?= isset($params['errors']['email']) ? ' is-invalid' : '' ?>">
    <?= isset($params['errors']['email']) ? '<p class="text-danger">' . $params['errors']['email'] . '</p>' : '' ?>
  </div>
  <div>
    <label for="password">Password</label>
    <input id="password" name="password" type="password"
      class="form-control <?= isset($params['errors']['password']) ? ' is-invalid' : '' ?>">
    <?= isset($params['errors']['password']) ? '<p class="text-danger">' . $params['errors']['password'] . '</p>' : '' ?>
  </div>

  <button type="submit" class="btn btn-primary mt-2">Login</button>
</form>

<div class="text-center">
  <span class="text-muted">Don't have an account? <a href="/register" class="text-primary">Register</a></span>
</div>