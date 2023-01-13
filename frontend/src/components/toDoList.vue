<script>
import axios from 'axios';
const API_URL = "http://localhost:8888/";
export default {
  data() {
    return {
      newTodo: "",
      todoList: []
    };
  },
  methods: {
    getAllData() {
      axios.get(API_URL + "api-read.php")
        .then(res => {
          const data = res.data;
          this.todoList = data;
        });
    },
    addTask(e) {
      e.preventDefault();
      const params = {
        params: {
          'newTodo': this.newTodo
        }
      };
      axios.get(API_URL + "api-write.php", params)
        .then(() => {
          this.getAllData();
        });
    },
    removeTask(index) {
      axios.delete(`${API_URL}api-delete.php?index=${index}`)
        .then(() => {
          this.getAllData();
        });
    }
  },
  mounted() {
    this.getAllData();
  }
}
</script>

<template>

  <div>
    <h1>ToDo LIST</h1>
    <form @submit="addTask">
      <input type="text" name="newTodo" v-model="newTodo">
      <input type="submit" value="CREATE">
    </form>
    <ul>
      <li v-for="(todoElem, ind) in todoList" :key="ind">
        {{ todoElem.text }}
        <button @click.prevent="removeTask(ind)">Rimuovi</button>
      </li>
    </ul>
  </div>


</template>

<style scoped>

</style>
