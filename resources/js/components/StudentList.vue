<template>
  <div class="card">
    <h1 class="text-xl font-bold mb-4">Gestión de Estudiantes</h1>
    <form @submit.prevent="save">
      <input v-model="form.name" placeholder="Nombre del estudiante" required>
      <input v-model="form.email" type="email" placeholder="Email" required>
      <select v-model="form.course_id" style="border: 1px solid black" required>
        <option value="" disabled>Selecciona un curso</option>
        <option v-for="c in courses" :key="c.id" :value="c.id">{{ c.name }}</option>
      </select>
      <button type="submit" style="background: rgb(67, 133, 194); color:white ">{{ editMode ? 'Actualizar' : 'Registrar Estudiante' }}</button>
    </form>

    <table>
      <thead>
        <tr><th>Nombre</th><th>Email</th><th>Curso</th><th>Acciones</th></tr>
      </thead>
      <tbody>
        <tr v-for="s in students" :key="s.id">
          <td>{{ s.name }}</td>
          <td>{{ s.email }}</td>
          <td>{{ s.course ? s.course.name : 'Sin curso' }}</td>
          <td>
            <button @click="edit(s)" style="background: #ca8a04">Editar</button>
            <button @click="remove(s.id)" style="background: #dc2626; margin-left: 5px;">Borrar</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const students = ref([]);
const courses = ref([]);
const form = ref({ id: null, name: '', email: '', course_id: '' });
const editMode = ref(false);

const load = async () => {
  const [resS, resC] = await Promise.all([
    axios.get('/api/students'),
    axios.get('/api/courses')
  ]);
  students.value = resS.data;
  courses.value = resC.data;
};

const save = async () => {
  try {
    if (editMode.value) {
      await axios.put(`/api/students/${form.value.id}`, form.value);
    } else {
      await axios.post('/api/students', form.value);
    }
    form.value = { id: null, name: '', email: '', course_id: '' };
    editMode.value = false;
    load();
  } catch (e) {
    alert("Error al guardar: Posiblemente el email ya existe.");
  }
};

const edit = (s) => {
  form.value = { ...s };
  editMode.value = true;
};

const remove = async (id) => {
  if (confirm('¿Eliminar estudiante?')) {
    await axios.delete(`/api/students/${id}`);
    load();
  }
};

onMounted(load);
</script>