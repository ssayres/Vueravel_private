<template>
  <header>
    <nav class="navbar bg-express justify-content-between">
      <div class="brand">
        <a href="#">
          <img
            src="/images/logo_white.png"
          />
        </a>
      </div>

      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Sem conteúdo</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#/login">Login</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#/cadastro" disabled
            >Cadastro</a
          >
        </li>
      </ul>
    </nav>
  </header>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
.bg-express {
  background-color: #e98b00;
  box-shadow: 0 3px 3.5px rgba(0, 0, 0, 0.1);
  font-family: "Roboto", sans-serif;
  font-size: 1.375rem;
  font-weight: 200;
}
.brand {
  display: block;
  font-size: 1rem;
  margin-left: 5%;
}
.brand > a > img {
  position: absolute;
  width: auto;
  height: 2.5rem;
  transform: translate(-50%, -40%);
}
.nav-item {
  margin-right: 3.125rem;
  display: inline-block;
  margin-top: 0;
}
.nav-item > .nav-link {
  margin-top: 0;
  color: white;
}
.nav-item > .nav-link:hover {
  color: #b6b6b6;
}
.nav-item > .nav-link:active {
  color: #ffffff;
}
a.nav-link.active {
  color: #686868;
}
.dropdown-item:active {
  background-color: #ff9900;
}
/* Smartphones Devices */
@media (max-width: 768px) {
  .bg-express {
    font-size: 0.875rem;
  }
}
/* Tablet Devices */
@media (max-width: 991.98px) {
  .bg-express {
    font-size: 1.25rem;
  }
}
</style>
