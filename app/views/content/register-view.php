<div class="login-box">
  <form class="Formulario" method="POST" action="<?php echo APP_URL;?>/app/ajax/usuarioAjax.php">
    <input type="hidden" name="modulo_user" value="registrar">
    <div class="title">
        <h2>Register Form</h2>
    </div>
    <div class="user-box">
      <input type="text" name="user" pattern="[A-Za-z0-9áéíóúÁÉÍÓÚñÑ ]{3,20}" required="">
      <label>Username</label>
    </div>
    <div class="user-box">
      <input type="email" name="email" required="" maxlength="50">
      <label>Email</label>
    </div>
    <div class="user-box">
      <input type="password" name="pass" required="" pattern="[ A-Za-z0-9áéíóúÁÉÍÓÚñÑ$@ ]{8,}">
      <label>Password</label>
    </div>
    <center>
        <button type="submit"><a class="sign-up aux">LOGIN<span></span></a></button>
    </center>
  </form>
</div>
