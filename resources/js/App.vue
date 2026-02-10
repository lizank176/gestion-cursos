<template>
  <div class="container">
    <nav>
      <!-- NO USES <a href="/">, usa <router-link> -->
      <router-link to="/" class="nav-link">Cursos</router-link> | 
      <router-link to="/students" class="nav-link">Estudiantes</router-link>
    </nav>

    <!-- Aquí es donde se cargan los componentes sin recargar la página -->
    <div class="content">
        <router-view></router-view>
    </div>
  </div>
</template>

<style>
.nav-link { 
    text-decoration: none; 
    color: blue; 
    padding: 10px; 
}
/* Estilo opcional para saber en qué página estás */
.router-link-active { 
    font-weight: bold; 
    border-bottom: 2px solid blue; 
}
</style>