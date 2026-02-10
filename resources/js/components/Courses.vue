<template>
  <div class="card">
    <h1 class="text-xl font-bold mb-4">Gestión de Cursos</h1>
    <form @submit.prevent="save">
      <input v-model="form.name" placeholder="Nombre del curso" required>
      <input v-model="form.description" placeholder="Descripción">
      <button type="submit" style="background: rgb(67, 133, 194); color:white ">{{ editMode ? 'Actualizar' : 'Crear Curso' }}</button>
    </form>

    <table>
      <thead>
        <tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Acciones</th></tr>
      </thead>
      <tbody>
        <tr v-for="c in courses" :key="c.id">
          <td>{{ c.id }}</td>
          <td>{{ c.name }}</td>
          <td>{{ c.description }}</td>
          <td>
            <button @click="edit(c)" style="background: #ca8a04">Editar</button>
            <button @click="remove(c.id)" style="background: #dc2626; margin-left: 5px;">Borrar</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const courses = ref([]);
const form = ref({ id: null, name: '', description: '' });
const editMode = ref(false);

const load = async () => {
  const res = await axios.get('/api/courses');
  courses.value = res.data;
};

const save = async () => {
  if (editMode.value) {
    await axios.put(`/api/courses/${form.value.id}`, form.value);
  } else {
    await axios.post('/api/courses', form.value);
  }
  form.value = { id: null, name: '', description: '' };
  editMode.value = false;
  load();
};

const edit = (c) => {
  form.value = { ...c };
  editMode.value = true;
};

const remove = async (id) => {
  if (confirm('¿Eliminar curso?')) {
    await axios.delete(`/api/courses/${id}`);
    load();
  }
};

onMounted(load);
</script>