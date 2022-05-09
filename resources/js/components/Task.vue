<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mt-0 mb-3">Tasks</h4>
        <div class="card-tools">
          <button
            class="btn btn-blue"
            style="float: right; margin-top: -43px"
            @click="addTask"
          >
            +
          </button>
        </div>
      </div>
      <div class="table-responsive card-body">
        <table class="table table-hover mb-0">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Start Date</th>
              <th>Due Date</th>
              <th>Done Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="task in tasks" :key="task.id">
              <td>{{ task.id }}</td>
              <td>{{ task.task_name }}</td>
              <td>{{ task.task_start }}</td>
              <td>{{ task.task_due }}</td>
              <td>{{ task.task_done }}</td>
              <td>{{ task.task_status ? 'Done' : 'ToDo' }}</td>
              <td>
                <a 
                  type="button" 
                  href="" 
                  @click.prevent="editTask(task)"
                  ><i class="fa fa-edit"></i
                ></a>
                /
                <a
                  type="button"
                  href=""
                  @click.prevent="deleteTask(task.id)"
                  ><i class="fa fa-trash"></i
                ></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Modal content-->
    <div
      id="addNewTask"
      class="modal fade"
      aria-hidden="true"
      aria-labelledby="addNewTaskLable"
    >
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 v-show="!editMode" class="modal-title">Add New Task</h4>
            <h4 v-show="editMode" class="modal-title">Update Task</h4>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-hidden="true"
              @click="closeModal"
            >
              ×
            </button>
          </div>
          <form @submit.prevent="editMode ? updateTask() : createTask()">
            <div class="modal-body">
              <div v-if="formErr != ''" v-html="formErr" style="color: #db3535"/>
              <div class="form-group">
                <input
                  v-model="form.task_name"
                  type="text"
                  name="task_name"
                  placeholder="Task Name"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('task_name') }"
                />
                <has-error :form="form" field="task_name"></has-error>
                <div v-if="form.errors.has('task_name')" v-html="form.errors.get('task_name')" style="color: #db3535"/>
              </div>
              <div class="form-group">
                <label for="task_start">Task Start Date</label>
                <input
                  v-model="form.task_start"
                  type="date"
                  id="task_start"
                  name="task_start"
                  placeholder="Start Date"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('task_start') }"
                />
                <has-error :form="form" field="task_start"></has-error>
                <div v-if="form.errors.has('task_start')" v-html="form.errors.get('task_start')" style="color: #db3535"/>
              </div>
              <div class="form-group">
                <label for="task_start">Task Due Date</label>
                <input
                  v-model="form.task_due"
                  type="date"
                  id="task_start"
                  name="task_due"
                  placeholder="Due Date"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('task_due') }"
                />
                <has-error :form="form" field="task_due"></has-error>
                <div v-if="form.errors.has('task_due')" v-html="form.errors.get('task_due')" style="color: #db3535"/>
              </div>
              <div class="form-group" v-show="editMode">
                <select
                  v-model="form.task_status"
                  type="text"
                  name="task_status"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('task_status') }"
                >
                  <option value="">Select Status</option>
                  <option value="0">ToDo</option>
                  <option value="1">Done</option>
                </select>
                <has-error :form="form" field="task_status"></has-error>
                <div v-if="form.errors.has('task_status')" v-html="form.errors.get('task_status')" style="color: #db3535"/>
              </div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-inverse">Clear</button>
              <button
                v-show="editMode"
                type="submit"
                id="update_btn"
                class="btn btn-inverse"
              >
                Update
              </button>
              <button
                v-show="!editMode"
                type="submit"
                id="submit_btn"
                class="btn btn-inverse"
              >
                Save
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      editMode: false,
      tasks: {},
      formErr: '',
      form: new Form({
        id: "",
        task_name: "",
        task_start: "",
        task_due: "",
        task_done: "",
        task_status: ""
      }),
    };
  },
  methods: {
    loadTask() {
      axios.get("api/task").then(({ data }) => (this.tasks = data.data));
    },
    addTask() {
      this.editMode = false;
      this.form.reset();
      $("#addNewTask").modal("show");
    },
    editTask(task) {
      this.editMode = true;
      this.form.reset();
      $("#addNewTask").modal("show");
      this.form.fill(task);
    },
    createTask() {
      this.form
        .post("api/task")
        .then((data) => {
          this.tasks = data.data.data;
          $("#addNewTask").modal("hide");
          $("body").removeClass("modal-open");
          $(".modal-backdrop").remove();
        })
        .catch(() => {});
    },
    updateTask() {
      this.form.put("api/task/" + this.form.id)
        .then((data) => {
          if (data.data.status == 500) {
            this.formErr = data.data.error;
          } else {
            this.tasks = data.data.data;
            $("#addNewTask").modal("hide");
            $("body").removeClass("modal-open");
            $(".modal-backdrop").remove();
          }
        })
      .catch((errors) => {
        console.log(errors);
      });
    },
    deleteTask(id) {
      this.form.delete("api/task/" + id)
      .then((data) => {
          this.tasks = data.data.data;
      });
    },
    closeModal() {
      this.form.reset();
      $("#addNewTask").modal("hide");
      $("body").removeClass("modal-open");
      $(".modal-backdrop").remove();
    },
  },
  created() {
    this.loadTask();
  },
};
</script>
