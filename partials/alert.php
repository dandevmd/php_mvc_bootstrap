<?php if (isset($params['message'])): ?>
  <div class="alert alert-danger" role="alert" id='message'>
    <?= $params['message'] ?>
  </div>
<?php endif ?>

<script>
  setTimeout(() => {
    const message = document.getElementById('message');
    if (message) {
      message.remove();
    }
  }, 3000)
</script>