<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todo</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
        integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="container">
        <div id="app">
            <!-- Modal -->
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered ">
                    <div class="modal-content rounded-0 shadow border-0">
                        <div class="modal-body">
                            <form>
                                <div class="input-group shadow-sm">
                                    <input type="text" class="form-control rounded-0"
                                        placeholder="Tambah aktivitas mu disini......" v-model="content">
                                    <button type="button" @click="updateTodoList"
                                        class="btn btn-primary rounded-0">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-5 mb-5">
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control rounded-right-5 shadow"
                                    placeholder="Search aktivitas mu..." v-model="search" @keyup="findTodo">
                                {{-- <input v-model.lazy="search" placeholder="Search..." > --}}
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card rounded-3 shadow border-0 bg-transparent">
                        <div class="card-header rounded-3 ">
                            <form>
                                <div class="input-group shadow-sm">
                                    <input type="text" class="form-control"
                                        placeholder="Tambah aktivitas mu disini......" v-model="content">
                                    <button type="button" @click="saveTodoList"
                                        class="btn btn-primary rounded-0">Submit</button>
                                </div>
                            </form>
                        </div>

                        <div class="card-body border-bottom" v-for="item in data_list" :key="item.id">
                            <div class="row justify-content-center">
                                <div class="col justify-content-center text-center">

                                    <h6>
                                        @{{ item.content }}
                                    </h6>
                                </div>
                                <div class="col-4 col-md-3 col-sm-3">
                                    <div class="btn-group border-0">
                                        <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                            @click="editData(item.id)" class="btn btn-success rounded-0">
                                            <i class="fa-solid fa-pen-to-square"></i></a>
                                        </a>
                                        <a href="" class="btn btn-danger rounded-0" style="float: right"
                                            @click="deleteData(item.id)">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" v-if="!data_list.length">
                            <h6 class="text-center">
                                Data kosong
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var vue = new Vue({
            el: "#app",
            mounted() {
                this.getDataList();
            },
            data: {
                data_list: [],
                content: "",
                id: '',
                search: ""
            },
            methods: {

                openForm: function() {
                    // Show the modal using jQuery
                    $('#exampleModal').modal('show');
                },


                saveTodoList: function() {
                    var form_data = new FormData();
                    form_data.append("content", this.content);
                    axios.post("{{ url('http://127.0.0.1:8000/api/postList') }}", form_data)
                        .then(res => {
                            this.content = "";
                            $('#exampleModal').modal('hide');
                        })
                        .catch(err => {
                            alert("Terjadi kesalahan pada sistem" + err);
                        })

                },

                updateTodoList: function(id) {
                    this.id
                    var form_data = new FormData();
                    form_data.append("content", this.content);
                    axios.post("{{ url('http://127.0.0.1:8000/api/updateList') }}/" + this.id, form_data)
                        .then(res => {
                            this.content = "";
                            $('#exampleModal').modal('hide');
                        })
                        .catch(err => {
                            alert("Terjadi kesalahan pada sistem" + err);
                        })
                        .finally(() => {
                            $('#exampleModal').modal('hide');
                        });
                },

                deleteData: function(id) {
                    this.id
                    if (confirm("apakah anda ingin menghapus?")) {
                        axios.delete("{{ url('http://127.0.0.1:8000/api/deleteList') }}/" + id)
                            .then(res => {
                                alert(res.data.message);
                                this.getDataList();
                            })
                            .catch(err => {
                                alert("Terjadi kesalahan" + err);
                            });
                    }
                },
                editData: function(id) {
                    this.id = id;
                    axios.get("{{ url('http://127.0.0.1:8000/api/showList') }}/" + this.id)
                        .then(res => {
                            var item = res.data;
                            this.content = item.content;
                            $('#exampleModal').modal('show')

                        })
                        .catch(err => {
                            alert("Terjadi Kesalahan Pada Sistem");
                        });

                },
                findTodo: function() {
                    // Assuming "this.search" contains the data you want to send
                    var searchData = this.search;
                    console.log(searchData);
                    // Call getDataList with the search data to update data_list
                    this.getDataList(searchData);
                },

                getDataList: function(searchQuery) {
                    axios.get("{{ url('http://127.0.0.1:8000/api/getList') }}", {
                            params: {
                                search: searchQuery
                            }
                        })
                        .then(response => {
                            // Handle the response data here
                            this.data_list = response.data;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                },


            },



        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
</body>

</html>
