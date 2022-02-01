<template>
    <div class="container">
        <!-- <button v-on:click="handlShowCreateForm" class="btn btn-success">Add New </button> -->
        <div>
            <h2 class="text-left p-2 text-black mt-5">Showing Task: {{task.title}}</h2>
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
