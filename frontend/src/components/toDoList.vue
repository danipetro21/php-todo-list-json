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
    submitApi(e) {

      //per impedire il refresh della pagina
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
    getAllData() {
      axios.get(API_URL + "api-read.php")
        .then(res => {
          const data = res.data;
          console.log(data);
          this.todoList = data;
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
    <ul>
      <li v-for="(todoElem, ind) in todoList" :key="ind">
        {{ todoElem.text }}
      </li>
    </ul>
    <form @submit="submitApi">
      <input type="text" name="newTodo" v-model="newTodo">
      <input type="submit" value="CREATE">
    </form>
  </div>


</template>

<style scoped>

</style>
