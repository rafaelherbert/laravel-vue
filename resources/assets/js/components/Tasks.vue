<template>
    <div class="col-md-6 ml-auto mr-auto">
        <div class="card card-default">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>Task Manager</div>
                <vue-component-pagination :source="pagination" @navigate="navigate"></vue-component-pagination>
            </div>
            <div class="card-body">
                <div class="alert alert-danger" role="alert" v-if="!tasks.length">
                    There are no tasks.
                </div>
                <div class="input-group mb-3">
                    
                    <input type="text" class="form-control" placeholder="Task Description" v-model="task.description" @keydown.enter="createTask" id="descriptionInput" 
                    :disabled="createLoading == 1">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button" @click="createTask">Button</button>
                    </div>
                </div>
                
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" v-for="task in tasks" :key="task.id">
                        <div class="custom-control custom-checkbox d-flex justify-content-between align-items-center">
                            <div>
                                <input type="checkbox" class="custom-control-input" :id="'customCheck' + task.id" v-model="task.completed" @change="toggleComplete(task)"
                                :disabled="updateLoading == 1">
                                <label class="custom-control-label" :for="'customCheck' + task.id" style="word-break: break-all;">{{task.description}}</label>
                            </div>
                            <a href="#" @click.prevent="removeTask(task)" :class="{ 'd-none': removeLoading }" class="text-danger font-weight-bold">X</a>
                            <div class="sk-fading-circle" v-if="removeLoading">
                                <div class="sk-circle1 sk-circle"></div>
                                <div class="sk-circle2 sk-circle"></div>
                                <div class="sk-circle3 sk-circle"></div>
                                <div class="sk-circle4 sk-circle"></div>
                                <div class="sk-circle5 sk-circle"></div>
                                <div class="sk-circle6 sk-circle"></div>
                                <div class="sk-circle7 sk-circle"></div>
                                <div class="sk-circle8 sk-circle"></div>
                                <div class="sk-circle9 sk-circle"></div>
                                <div class="sk-circle10 sk-circle"></div>
                                <div class="sk-circle11 sk-circle"></div>
                                <div class="sk-circle12 sk-circle"></div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="card-footer text-muted">
                <div class="d-flex justify-content-between">
                    <div>
                        <span class="badge badge-secondary">You have {{this.allTasksInfo.data}} Tasks</span>
                        <span class="badge badge-danger" v-if="this.allTasksInfo.notCompleted"> {{this.allTasksInfo.notCompleted}} Tasks left</span>
                        <span class="badge badge-success" v-if="this.allTasksInfo.completed"> {{this.allTasksInfo.completed}} Tasks done</span>
                    </div>
                    <span class="font-weight-bold">{{progress}}% Done</span>
                </div>
                <div class="progress mt-1 text-center" style="height:30px;">
                    <div class="progress-bar bg-success" role="progressbar" :style="{'width':progress + '%'}"
                        :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</template>
<script>
import VueComponentPagination from './pagination.vue'

export default {

    components:{
        VueComponentPagination
    },

    mounted() {
        this.fetchData()
        this.fetchAllData() //This is happening all time, reactive.
    },

    data() {
        return {
            allTasksInfo: [],
            tasks: [],
            task: {
                description: '',
                completed: false,
            },
            pagination: {},
            createLoading: 0,
            removeLoading: 0,
            updateLoading: 0,
            requestAcess: 1
        }
    },
    
    computed: {
        progress(){
            if ((this.allTasksInfo.completed/this.allTasksInfo.data)*100)
                return ((this.allTasksInfo.completed/this.allTasksInfo.data)*100).toPrecision(3)
            else
                return 0
        }
    },

    methods: {

        fetchAllData(){
            axios.get('/api/tasks')
              .then((response) => {
                    this.allTasksInfo = response.data
              })
              .catch((error) => {
                    console.log(error)
              })
        },

        fetchData() {
            axios.get('/api/tasks/pagination')
              .then((response) => {
                    this.tasks = response.data.data
                    this.pagination = response.data
              })
              .catch((error) => {
                    console.log(error)
              })
        },

        createTask() {
            this.createLoading = 1
            Pace.start()
                axios.post('/api/tasks', this.task)
                .then((response) => {
                    this.fetchData()
                    this.fetchAllData()
                    this.task.description = ""
                    Pace.stop()
                    this.createLoading = 0
                })
                .catch((error) => {
                    console.log(error)
                    Pace.stop()
                    this.createLoading = 0
                })

        },
        //Ajustar o toggleComplete.
        toggleComplete(task) {
            this.updateLoading = 1

            axios.put('/api/tasks/' + task.id, {
                completed: task.completed
            })
            .then((response) => {
                this.tasks.task = response.data
                this.fetchAllData()
                this.updateLoading = 0
            })
            .catch((error) => {
                console.log(error)
                this.updateLoading = 0
            })
        },

        removeTask(task) {
            this.removeLoading = 1

            axios.delete('/api/tasks/' + task.id)
            .then((response) => {
                this.navigate(this.pagination.current_page)
                this.fetchAllData()
                this.removeLoading = 0
            })
            .catch((error) => {
                console.log(error)
                this.removeLoading = 0
            })
        },

        navigate(page){
            axios.get('/api/tasks/pagination?page=' + page)
              .then((response) => {
                    this.tasks = response.data.data
                    this.pagination = response.data
              })
              .catch((error) => {
                    console.log(error)
              })
        }
    }
}
</script>