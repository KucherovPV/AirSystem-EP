<template>
    <div v-if="!types || !models || !airlines" class="loading-row">
        <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <div v-else id="app" class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        Борты
                    </div>
                    <table class="table table-bordered table-hover" id="dataTable">
                        <thead class="non-clickable">
                        <tr>
                            <th class="text-center">Номер борта</th>
                            <th class="text-center">Авиакомпания</th>
                            <th class="text-center">Марка/модель</th>
                            <th class="text-center">Тип</th>
                            <th class="text-center">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="cursor-pointer "></tr>
                        <template v-for="board in boards" :key="board.board_code">
                            <tr>
                                <td>{{ board.board_code }}</td>
                                <td>{{ board.airline.title }}</td>
                                <td>{{ board.model.manufacturer.title }} {{ board.model.title }}</td>
                                <td>{{ board.type.title }}</td>
                                <td>
                                    <div class="d-flex">
                                        <button :class="isEdit(board.board_code) ? 'd-none' : 'hidden'"
                                                class="btn btn-outline-success m-1"
                                                @click.prevent="changeEditBoardCode(board.board_code)">Редактировать
                                        </button>
                                        <button :class="isEdit(board.board_code) ? 'hidden' : 'd-none'"
                                                class="btn btn-outline-secondary m-1"
                                                @click.prevent="this.editBoardCode = null">Отмена
                                        </button>
                                        <button class="btn btn-outline-danger m-1"
                                                @click.prevent="deleteBoard(board.board_code)">Удалить
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr :class="isEdit(board.board_code) ?'':'d-none'">
                                <td><input type="text" class="form-control" v-model="board_code_edit"></td>
                                <td>
                                    <select v-model="airline_code_edit" v-if="airlines" name="airline_code_edit"
                                            class="form-select form-control"
                                            data-size="4">
                                        <template v-for="airline in airlines" :key="airline.id">
                                            <option :value="airline.code_iata">{{ airline.title }}</option>
                                        </template>
                                    </select>
                                </td>
                                <td>
                                    <select v-model="model_id_edit" v-if="models" name="model_id_edit" class="form-select form-control"
                                            data-size="4">
                                        <template v-for="model in models" :key="model.id">
                                            <option :value="model.id">{{ model.manufacturer.title }} {{ model.title }}</option>
                                        </template>
                                    </select>
                                </td>
                                <td><select v-model="board_type_id_edit" v-if="types" name="board_type_id_edit"
                                            class="form-select form-control" data-size="4">
                                    <template v-for="type in types" :key="type.id">
                                        <option :value="type.id">{{ type.title }}</option>
                                    </template>
                                </select></td>
                                <td>
                                    <button class="btn btn-outline-success m-1"
                                            @click.prevent="editBoard(board.board_code)">Сохранить
                                    </button>
                                </td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        Добавить борт
                    </div>
                    <form @submit.prevent="createBoard" id="addForm" method="POST" class="hidden r-3 p-3">
                        <div class="form-group mt-3 mb-3">
                            <label for="board_code">Номер судна:</label>
                            <input type="text" class="form-control" name="board_code" v-model="board_code"
                                   required placeholder="Введите номер борта">
                        </div>
                        <div class="form-group ">
                            <label for="fk_board_type">Авиакомпания:</label>
                            <select v-model="airline_code" v-if="airlines" name="airline_code"
                                    class="form-select form-control"
                                    data-size="4">
                                <template v-for="airline in airlines" :key="airline.id">
                                    <option :value="airline.code_iata">{{ airline.title }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="form-group ">
                            <label for="fk_board_type">Марка/модель:</label>
                            <select v-model="model_id" v-if="models" name="model_id" class="form-select form-control"
                                    data-size="4">
                                <template v-for="model in models" :key="model.id">
                                    <option :value="model.id">{{ model.manufacturer.title }} {{ model.title }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fk_board_type">Тип судна</label>
                            <select v-model="board_type_id" v-if="types" name="board_type_id"
                                    class="form-select form-control" data-size="4">
                                <template v-for="type in types" :key="type.id">
                                    <option :value="type.id">{{ type.title }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="form-group mt-2 mb-3">
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import mixin from "../mixins/mixin.js";

export default {
    name: 'BoardComponent',
    mixins: [mixin],
    data() {
        return {
            boards: null,
            editBoardCode: null,
            types: null,
            airlines: null,
            models: null,
        }
    },
    mounted() {
        this.fetchData();
        this.getBoards();
    },
    methods: {
        async fetchData() {
            try {
                this.types = await this.getType('admin','is_board_type');
            } catch (error) {
                console.error(error);
            }
            try {
                this.airlines = await this.getData('/api/admin/airlines');
            } catch (error) {
                console.error(error);
            }
            try {
                this.models = await this.getData('/api/admin/models');
            } catch (error) {
                console.error(error);
            }
        },
        getBoards() {
            axios.get('/api/admin/boards')
                .then(
                    response => {
                        this.boards = response.data
                        console.log(response.data)
                    })
                .catch(err => {
                    console.error(err);
                })
        },
        createBoard() {
            axios.post('/api/admin/boards', {
                board_code: this.board_code,
                airline_code: this.airline_code,
                model_id: this.model_id,
                board_type_id: this.board_type_id
            })
                .then(
                    response => {
                        this.getBoards();
                        this.board_code = ''
                        this.airline_code = ''
                        this.model_id= ''
                        this.board_type_id = ''
                    })
                .catch(err => {
                    console.error(err);
                })
        },
        changeEditBoardCode(code) {
            this.editBoardCode = code;
        },
        isEdit(code) {
            return this.editBoardCode === code;
        },
        editBoard(board) {
            this.editBoardCode = null;
            axios.patch(`/api/admin/boards/${board}`, {
                board_code: this.board_code_edit,
                name: this.airline_code_edit,
                country: this.model_id_edit,
                board_type_id: this.board_type_id_edit
            })
                .then(
                    response => {
                        this.getBoards();
                    })
                .catch(err => {
                    console.error(err);
                })
        },
        deleteBoard(board) {
            axios.delete(`/api/admin/boards/${board}`)
                .then(
                    response => {
                        //console.error(response.data);
                        this.getBoards();
                    })
                .catch(err => {
                    console.error(err);
                })
        },
    }
}
</script>
