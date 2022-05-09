<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mt-0 mb-3">Projects</h4>
        <div class="card-tools">
          <button
            class="btn btn-blue"
            style="float: right; margin-top: -43px"
            @click="addProject"
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
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="project in projects" :key="project.id">
              <td>{{ project.id }}</td>
              <td>{{ project.project_name }}</td>
              <td>
                <a 
                  type="button" 
                  href="" 
                  @click.prevent="addTask(project)"
                  ><i class="fa fa-calendar-plus"></i
                ></a>
                /
                <a 
                  type="button" 
                  href="" 
                  @click.prevent="addTask(project)"
                  ><i class="fa fa-list"></i
                ></a>
                /
                <a 
                  type="button" 
                  href="" 
                  @click.prevent="editProject(project)"
                  ><i class="fa fa-edit"></i
                ></a>
                /
                <a
                  type="button"
                  href=""
                  @click.prevent="deleteProject(project.id)"
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
      id="addNewProject"
      class="modal fade"
      aria-hidden="true"
      aria-labelledby="addNewProjectLable"
    >
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 v-show="!editMode" class="modal-title">Add New Project</h4>
            <h4 v-show="editMode" class="modal-title">Update Project</h4>
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
          <form @submit.prevent="editMode ? updateProject() : createProject()">
            <div class="modal-body">
              <div v-if="formErr != ''" v-html="formErr" style="color: #db3535"/>
              <div class="form-group">
                <input
                  v-model="form.project_name"
                  type="text"
                  name="project_name"
                  placeholder="Project Name"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('project_name') }"
                />
                <has-error :form="form" field="project_name"></has-error>
                <div v-if="form.errors.has('project_name')" v-html="form.errors.get('project_name')" style="color: #db3535"/>
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

    <!-- Modal content-->
    <div
      id="addProjectTask"
      class="modal fade"
      aria-hidden="true"
      aria-labelledby="addProjectTaskLable"
    >
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 v-show="!editMode" class="modal-title">Add New Task To Project</h4>
            <h4 v-show="editMode" class="modal-title">Update Project Tasks</h4>
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
          <form @submit.prevent="editMode ? updateProjectTask() : createProjectTask(project_id)">
            <div class="modal-body">
              <div v-if="formErr != ''" v-html="formErr" style="color: #db3535"/>
              <table class="table table-hover mb-0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Task Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="task in tasks" :key="task.id">
                    <td>{{ task.id }}</td>
                    <td>{{ task.task_name }}</td>
                    <td>
                      <a 
                        type="button" 
                        href="" 
                        @click.prevent="addTaskToProject(task)"
                        ><i class="fa fa-plus"></i
                      ></a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
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
      demo_tasks: [],
      tasks: {},
      projects: {},
      project_id: '',
      formErr: '',
      form: new Form({
        id: "",
        project_name: "",
      }),
    };
  },
  methods: {
    loadProject() {
      axios.get("api/project").then(({ data }) => (this.projects = data.data));
    },
    addProject() {
      this.editMode = false;
      this.form.reset();
      $("#addNewProject").modal("show");
    },
    addTask(project) {
      axios.get("api/task_list/" + project.id).then(({ data }) => (this.tasks = data.data));
      this.editMode = false;
      this.project_id = project.id;
      this.form.reset();
      $("#addProjectTask").modal("show");
    },
    addTaskToProject(task) {
      this.demo_tasks.push(task);
      let i = this.tasks.map(item => item.id).indexOf(task.id) // find index of object
      this.tasks.splice(i, 1) // remove it from array
      this.editMode = false;
      this.form.reset();
      $("#addProjectTask").modal("show");
    },
    editProject(project) {
      this.editMode = true;
      this.form.reset();
      $("#addNewProject").modal("show");
      this.form.fill(project);
    },
    createProject() {
      this.form
        .post("api/project")
        .then((data) => {
          this.projects = data.data.data;
          $("#addNewProject").modal("hide");
          $("body").removeClass("modal-open");
          $(".modal-backdrop").remove();
        })
        .catch(() => {});
    },
    createProjectTask(project_id) {
      axios.post("api/add_tasks",{id: project_id, data: this.demo_tasks},)
        .then((data) => {
          if (data.data.status == 500) {
            this.formErr = data.data.error;
          } else {
            this.projects = data.data.data;
            $("#addProjectTask").modal("hide");
            $("body").removeClass("modal-open");
            $(".modal-backdrop").remove();
          }
        })
      .catch((errors) => {
        console.log(errors);
      });
    },
    deleteProject(id) {
      this.form.delete("api/project/" + id)
      .then((data) => {
          this.projects = data.data.data;
      });
    },
    closeModal() {
      this.form.reset();
      $("#addNewProject").modal("hide");
      $("#addProjectTask").modal("hide");
      $("body").removeClass("modal-open");
      $(".modal-backdrop").remove();
    },
  },
  created() {
    this.loadProject();
  },
};
</script>
