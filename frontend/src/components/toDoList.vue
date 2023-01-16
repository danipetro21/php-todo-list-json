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
          this.newTodo = '';
          this.getAllData();
        });
    },
    removeTask(index) {
     
      axios.get(`${API_URL}api-delete.php?index=${index}`)
        .then(() => {
          this.getAllData();
        });
    },
    updateTask(index) {

      const params = {
        params: {
          'index': index
        }
      };
      axios.get(API_URL + "api-update.php", params)
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

  <div class="box">
    <h1>ToDo LIST</h1>
    <form @submit="addTask">
      <input type="text" name="newTodo" v-model="newTodo" placeholder="aggiungi task">
      <input type="submit" value="CREATE" id="sub">
    </form>
    <ul>

      <!--  -->
      <li v-for="(todoElem, ind) in todoList" :key="ind">

        <div @click.prevent="updateTask(ind)">

          <s v-if="todoElem.completed">
            {{ todoElem.text }}
          </s>

          <span v-else>
            {{ todoElem.text }}
          </span>

        </div>

        <button @click.prevent="removeTask(ind)"><i class="fa-solid fa-trash"></i></button>
      </li>
    </ul>
  </div>


</template>

<style scoped lang="scss">
form {
  display: flex;
  justify-content: center;
  align-items: center;


  input {
    padding: 10px;
    margin-left: 10px;
    border-radius: 5px;
    border: transparent;
    background-color: black;
    cursor: pointer;

    ::placeholder {
      color: white;
    }
  }

  #sub {
    border: 1px solid yellow;
  }
}

.box {
  width: 500px;
  display: flex;
  justify-content: space-around;
  align-items: center;
  flex-direction: column;
}

ul {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
}

li {

  width: calc(100%);
  background-color: white;
  border-radius: 15px;
  margin: 10px 0;
  color: black;
  list-style: none;
  border: 1px solid black;
  font-size: 1.5rem;
  cursor: pointer;

  padding: 10px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}


.unline {
  background-color: blue;
}

.line {
  background-color: red;
}
</style>
