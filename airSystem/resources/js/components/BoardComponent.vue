<template>
    <div id="app" class="container mt-5">
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
                            <th class="text-center">Имя</th>
                            <th class="text-center">Страна</th>
                            <th class="text-center">Производитель</th>
                            <th class="text-center">Тип</th>
                            <th class="text-center">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="cursor-pointer "></tr>
                        <template v-for="board in boards" :key="board.board_code">
                            <tr>
                                <td>{{ board.board_code }}</td>
                                <td>{{ board.name }}</td>
                                <td>{{ board.country }}</td>
                                <td>{{ board.manufacturer }}</td>
                                <td>{{ board.type_category.name }}</td>
                                <td>
                                    <div class="d-flex">
                                        <button :class="isEdit(board.board_code) ? 'd-none' : 'hidden'" class="btn btn-outline-success m-1"
                                                @click.prevent="changeEditBoardCode(board.board_code)">Редактировать
                                        </button>
                                        <button :class="isEdit(board.board_code) ? 'hidden' : 'd-none'" class="btn btn-outline-secondary m-1"
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
                                <td><input type="text" class="form-control" v-model="board_name_edit"></td>
                                <td><input type="text" class="form-control" v-model="country_edit"></td>
                                <td><input type="text" class="form-control" v-model="manufacturer_edit"></td>
                                <td><select v-model="fk_board_type_edit" v-if="types" name="fk_board_type"
                                            class="form-select form-control" data-size="4">
                                    <template v-for="type in types" :key="type.id">
                                        <option  :value="type.id">{{ type.name }}</option>
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
                            <label for="board_code">Номер судна</label>
                            <input type="text" class="form-control" name="board_code" v-model="board_code"
                                   required>
                        </div>
                        <div class="form-group ">
                            <label for="board_name">Имя Судна</label>
                            <input type="text" class="form-control" name="board_name" v-model="board_name" required>
                        </div>
                        <div class="form-group">
                            <label for="country">Страна</label>
                            <input type="text" class="form-control" name="country" v-model="country"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="manufacturer">Производтель</label>
                            <input type="text" class="form-control" name="manufacturer" v-model="manufacturer"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="fk_board_type">Тип судна</label>
                            <select v-model="fk_board_type" v-if="types" name="fk_board_type" class="form-select form-control" data-size="4">
                                <template v-for="type in types" :key="type.id">
                                    <option :value="type.id">{{type.name}}</option>
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
import getTypeCategory from "../components/mixins/getTypeCategory.js";

export default {
    name: 'BoardComponent',
    mixins: [getTypeCategory],
    data() {
        return {
            boards: null,
            editBoardCode: null,
            types: null,
        }
    },
    mounted() {
        this.fetchData();
        this.getBoards();
    },
    methods: {
        async fetchData() {
            try {
                this.types = await this.getType('is_board_type');
            } catch (error) {
                console.error(error);
            }
        },
        getBoards() {
            axios.get('/api/board')
                .then(
                    response => {
                        this.boards = response.data
                    })
                .catch(err => {
                    console.error(err);
                })
        },
        createBoard() {
            axios.post('/api/board', {
                board_code: this.board_code,
                name: this.board_name,
                country: this.country,
                manufacturer: this.manufacturer,
                fk_board_type: this.fk_board_type
            })
                .then(
                    response => {
                        this.getBoards();
                        this.board_code =''
                        this.board_name =''
                        this.country =''
                        this.manufacturer =''
                        this.fk_board_type =''
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
        editBoard(code) {
            this.editBoardCode = null;
            axios.patch(`/api/board/${code}`, {
                board_code: this.board_code_edit,
                name: this.board_name_edit,
                country: this.country_edit,
                manufacturer: this.manufacturer_edit,
                fk_board_type: this.fk_board_type_edit
            })
                .then(
                    response => {
                        this.getBoards();
                        this.board_code_edit =''
                        this.board_name_edit =''
                        this.country_edit =''
                        this.manufacturer_edit =''
                        this.fk_board_type_edit =''
                    })
                .catch(err => {
                    console.error(err);
                })
        },
        deleteBoard(code) {
            axios.delete(`/api/board/${code}`)
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
