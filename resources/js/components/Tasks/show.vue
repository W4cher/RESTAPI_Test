<template>
    <div class="container">
        <!-- <button v-on:click="handlShowCreateForm" class="btn btn-success">Add New </button> -->
        <div>
            <p class="text-left pb-0 mb-0"><span :class="'badge badge-' + this.getbBadge(task.status)">{{task.status}}</span></p>
            <h2 class="text-left pt-2 text-black mt-0">Showing Task: {{task.title}}</h2>
            <p class="text-left">{{task.description}}</p>
            <p>FILES</p>
            <ul>
                <li v-for="(file) in task.files " v-bind:key="file.id">
                    {{ file.filename }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
var baseUrl = "http://localhost:8000"
export default {
    name: "Contact",
    created() {
        console.log("PARAMS", this.$route.params)
    },

    data() {
        return {
            task: {},
            badges: {
                "PENDING": 'default',
                "ACTIVO": 'warning',
                "FEITO": 'success',

            },
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
        getbBadge(status){
            return this.badges[status]
        },
        loadData() {
            var taskId = this.$route.params.id;
            let url = `${baseUrl}/api/tasks/${taskId}`;
            this.axios
            .get(url).then((response) => {
                this.task = response.data.task;
                console.log("TASK", this.task);
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
    },
};
</script>
