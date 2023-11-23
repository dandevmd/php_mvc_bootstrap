<form action="/contacts" method="post" class="container">
  <h1 class="display-4 mt-5 mb-5 text-center text-primary">Contact Us</h1>
  <div>
    <label for="name">Name</label>
    <input type="name" class="form-control" id="name" name="name">
  </div>
  <div>
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  <div>
    <label for="body">Body</label>
    <textarea class="form-control" id="body" name="body">// TODO</textarea>
  </div>

  <button type="submit" class="btn btn-primary mt-2">Submit</button>
</form>