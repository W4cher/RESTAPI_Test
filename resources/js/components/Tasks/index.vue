<template>
    <div class="container">
        <button v-on:click="handlShowCreateForm" class="btn btn-success">Add New </button>
        <div action="" v-show="showCreateForm">
            <h2 class="text-left p-2 text-black mt-5">Create New Task</h2>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" v-model="title">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" cols="30" rows="10" v-model="description"></textarea>
            </div>
            <div class="form-group">
                <label for="description">Status</label>
                <select name="status" id="status" class="form-control" v-model="status">
                    <option value="PENDENTE">Pendente</option>
                    <option value="ACTIVO">Activo</option>
                    <option value="FEITO">Feito</option>
                </select>
            </div>
            <div class="form-group">
                <input type="file" class="form-control" name="files[]" multiple />
            </div>
            <button v-on:click="createTask" class="btn btn-success">Create</button>
        </div>
        <div>
            <h2 class="text-left p-2 text-black mt-5">All Tasks</h2>
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody v-for="(task, index) in tasks" :key="task.id">
                    <tr :data-row-id="task.id">
                        <td :data-id="task.id">{{task.id}}</td>
                        <td :data-title="task.title">
                            <h5 v-show="editOffset != index" class="list-group-item-heading">
                                {{ task.title }}
                            </h5>
                            <input v-show="editOffset==index" 
                                type="text" 
                                name="title" 
                                :id="'task-title-'+task.id"
                                v-model="task.title"
                            >
                        </td>
                        <td :data-description="task.description">
                            <h5 v-show="editOffset != index" class="list-group-item-heading">
                                <!-- <a href="#" @click.prevent="startEditing(index)" class="btn btn-md btn-info">
                                    <i class="glyphicon glyphicon-edit"></i>
                                </a> -->
                                {{ task.description }}
                            </h5>
                            <input v-show="editOffset==index" 
                                type="text" 
                                name="description" 
                                :id="'task-description-'+task.id"
                                v-model="task.description"
                            >
                        </td>
                        <td :data-status="task.status">
                            <h5 v-show="editOffset != index" class="list-group-item-heading">
                                <!-- <a href="#" @click.prevent="startEditing(index)" class="btn btn-md btn-info">
                                    <i class="glyphicon glyphicon-edit"></i>
                                </a> -->
                                {{ task.status }}
                            </h5>
                            <select v-show="editOffset == index" name="status" :id="'task-status-'+task.id" v-model="task.status">
                                <option value="PENDENTE">Pendente</option>
                                <option value="ACTIVO">Activo</option>
                                <option value="FEITO">Feito</option>
                            </select>
                        </td>
                        <td>
                            <a href="#" @click.prevent="startEditing(index)" class="btn btn-primary btn-sm">
                                Edit<i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a :href="'/tasks/' + task.id" class="btn btn-success btn-sm">
                                Show<i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <button class="btn btn-warning btn-sm"  v-on:click="updateTask(task.id)" :disabled="editOffset!=index">Update</button>
                            <button class="btn btn-danger btn-sm"  v-on:click="deleteTask(task.id, index)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>
</template>

<script>
var baseUrl = "http://localhost:8000"
export default {
    name: "Contact",
    created() {
       
    },

    data() {
        return {
            showCreateForm: false,
            url: document.head.querySelector('meta[name="url"]').content,
            editOffset: -1,
            editPost: {},
            tasks: [],
            title: "",
            description: "",
            status: "",
        };
    },

    mounted() {
        console.log("Task Component Mounted");
        this.loadData();   
    },

    methods: {
        loadData() {
            let url = `${baseUrl}/api/tasks`;
            this.axios.get(url).then((response) => {
                this.tasks = response.data;
                console.log(this.tasks);
            });
        },
        handlShowCreateForm() {
            this.showCreateForm = !this.showCreateForm ;
        },
        startEditing(index) {
            this.editOffset = index;
            this.editPost = this.tasks[index]
        },
        createTask() {
            let url = `${baseUrl}/api/tasks`;
            var data = {
                'title': this.title,
                'description': this.description,
                'status': this.status,
                // 'attached_images' = "";
            };

            this.axios.post(url, data)
            .then((response) => {
                var data = response.data;
                var tasks = this.tasks;

                if(data.success) {
                    this.title = "";
                    this.description = "";
                    this.tasks = [data.task].concat(tasks);
                    console.log("tasks", tasks)
                }
            });
        },

        updateTask(id) {
            let url = `${baseUrl}/api/tasks/update/${id}`;
            console.log(this.editPost.id)
            console.log(this.editPost.title)
            console.log(this.editPost.description)

            var data = {
                'title': this.editPost.title,
                'description': this.editPost.description,
                'status': this.editPost.status,
            };

            this.axios.put(url, data)
            .then((response) => {
                var data = response.data;
                this.editOffset = -1
                // var tasks = this.tasks;
                // this.tasks = response.data;
                console.log(data);
            });
        },
        deleteTask(id, index) {
            let url = `${baseUrl}/api/tasks/delete/${id}`;
            this.axios.delete(url)
            .then((response) => {
                var data = response.data;
                console.log(data);
                this.tasks.splice(index, 1)
                // del(this.tasks[index])
                // console.log(this.tasks);
            });
        },
    },
};
</script>
