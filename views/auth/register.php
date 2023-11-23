<form action="/register" method="POST" class="container">
  <h1 class="text-center text-primary font-weight-bold">Register</h1>

  <div>
    <label for="name">Name </label>
    <input type="text" class="form-control <?= isset($params['errors']['name']) ? ' is-invalid' : '' ?>" id="name"
      name="name">
    <?= isset($params['errors']['name']) ? '<p class="text-danger">' . $params['errors']['name'] . '</p>' : null ?>
  </div>
  <div>
    <label for="email">Email address</label>
    <input type="email" class="form-control <?= isset($params['errors']['email']) ? ' is-invalid' : '' ?>" id="email"
      name="email">
    <?= isset($params['errors']['email']) ? '<p class="text-danger">' . $params['errors']['email'] . '</p>' : null ?>
  </div>
  <div>
    <label for="password">Password</label>
    <input id="password" name="password" type="password"
      class="form-control <?= isset($params['errors']['password']) ? ' is-invalid' : '' ?>">
    <?= isset($params['errors']['password']) ? '<p class="text-danger">' . $params['errors']['password'] . '</p>' : null ?>
  </div>
  <div>
    <label for="password_confirmation">Password Confirmation</label>
    <input id="password_confirmation" name="password_confirmation" type="password"
      class="form-control <?= isset($params['errors']['password_confirmation']) ? ' is-invalid' : '' ?>">
    <?= isset($params['errors']['password_confirmation']) ? '<p class="text-danger">' . $params['errors']['password_confirmation'] . '</p>' : null ?>
  </div>

  <button type="submit" class="btn btn-primary mt-2">Login</button>
</form>

<div class="text-center">
  <span class="text-muted">Already have an account? <a href="/login" class="text-primary">Login</a></span>
</div>