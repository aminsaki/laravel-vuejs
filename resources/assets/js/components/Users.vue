<template>
    <div class="container">
        <a href="#" class="btn btn-success">Add USERS</a>
        <table class="table table-bordered  ">
            <thead class="bg-danger">
            <tr>
                <th>ID</th>
                <th>name</th>
                <th>email</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(user , index) in users">
                <td>{{user.id}}</td>
                <td>{{user.name}}</td>
                <td>{{user.email}}</td>
                <td><a href="#" class="btn btn-danger" v-on:click="deleteUser(user.id, index)">Delete</a>
                    <a href="#" class="btn btn-success" v-on:click="editUser(user.id)">Edit</a>
                </td>

            </tr>
            <tr>
                 <td colspan="4"  style="background: #2d5965;">

                         <button class="btn btn-default" v-on:click="foreachPaginateUsers(paginatetion.prev_page_url)" :disabled="!paginatetion.prev_page_url">  Previous
                         </button>
                         <span c>Page {{paginatetion.current_page}} of {{paginatetion.last_page}}</span>

                         <button class="btn btn-default"  v-on:click="foreachPaginateUsers(paginatetion.next_page_url)"  :disabled="!paginatetion.next_page_url">Next
                         </button>

                 </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                users: {},
                user: {
                    id: 0,
                    name: '',
                    email: ''
                },
                url: '/api/users',
                paginatetion:{ }
            }

        },
        mounted() {
            this.getUser()
        },
        methods: {
            getUser() {
                let $this = this;
                axios.get(this.url).then(response => {
                    console.log(response.data);
                    this.users = response.data.data;
                    $this.makePaginatetion(response.data);
                })
            },
            deleteUser(id, index) {
                axios.delete(this.url + id)
                    .then(response => {
                        console.log(response);
                        this.users.splice(index, 1);

                    }).errors(errors => {
                    alert('NO Delete Users');
                    console.log(errors);
                })
            },

            editUser(id){
                axios.update(this.url + id)
                    .then(response => {
                        console.log(response);
                        this.users.splice(index, 1);

                    }).errors(errors => {
                    alert('NO Delete Users');
                    console.log(errors);
                })

            },
            makePaginatetion(data) {
                let paginatetion = {
                    current_page: data.current_page,
                    last_page_url	: data.last_page,
                    next_page_url: data.next_page_url,
                    prev_page_url: data.prev_page_url
                }

                    this.paginatetion = paginatetion;
//                alert(paginatetion.current_page);
            },
            foreachPaginateUsers(url){

                 this.url = url,
                this.getUser()
            }
        },
    }
</script>
