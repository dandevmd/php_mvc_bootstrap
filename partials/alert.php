<?php if (isset($params['message'])): ?>
  <?php if ($params['end'] === 'bad'): ?>
    <div class="alert alert-danger" role="alert" id='message'>
      <?= $params['message'] ?>
    </div>
  <?php else: ?>
    <div class="alert alert-success" role="alert" id='message'>
      <?= $params['message'] ?>
    </div>
  <?php endif ?>
<?php endif ?>

<script>
  setTimeout(() => {
    const message = document.getElementById('message');
    if (message) {
      message.remove();
    }
  }, 3000)
</script>