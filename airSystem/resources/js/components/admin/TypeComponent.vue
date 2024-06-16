<template>
    <div id="app" class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        категории
                    </div>
                    <div class="card-body">
                        <div class="input-group">
                            <select class="form-select" id="inputGroup" v-model="selectedType" aria-label="Example select with button addon">
                                <option value="is_reason_category">Категория задержки</option>
                                <option value="is_flight_type">Тип рейса</option>
                                <option value="is_board_type">Тип судна</option>
                            </select>
                            <button class="btn btn-outline-secondary" type="button" @click.prevent="this.fetchData">Получить</button>
                        </div>
                    </div>
                    <table v-if="categories" class="table table-bordered table-hover rounded-3" id="dataTable" >
                        <thead class="non-clickable">
                        <tr>
                            <th class="text-center">Название</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="cursor-pointer "></tr>
                        <template v-for="category in categories" :key="category.id">
                            <tr>
                                <td>{{ category.title }}</td>
                                <td>
                                    <div class="d-flex">
                                        <button :class="isEdit(category.id) ? 'd-none' : 'hidden'"
                                                class="btn btn-outline-success m-1"
                                                @click.prevent="changeEditTypeId(category.id)">Редактировать
                                        </button>
                                        <button :class="isEdit(category.id) ? 'hidden' : 'd-none'"
                                                class="btn btn-outline-secondary m-1"
                                                @click.prevent="this.editTypeId = null">Отмена
                                        </button>
                                        <button class="btn btn-outline-danger m-1"
                                                @click.prevent="deleteType(category.id)">Удалить
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr :class="isEdit(category.id) ?'':'d-none'">
                                <td><input type="text" class="form-control" v-model="type_name_edit">
                                    <div class="form-check" v-for="option in options" :key="option.value">
                                        <input class="form-check-input" type="radio" :value="option.value" v-model="selectedOption_edit" name="selectedOption_edit">
                                        <label class="form-check-label" >{{ option.label }}</label>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-outline-success m-1"
                                            @click.prevent="editType(category.id)">Сохранить
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
                        Добавить категорию
                    </div>
                    <form @submit.prevent="createType" id="addForm" method="POST" class="hidden r-3 p-3">
                        <div class="form-group mt-3 mb-3">
                            <label for="type_name">Название</label>
                            <input type="text" class="form-control" name="type_name_edit" v-model="type_name"
                                   required>
                        </div>
                        <div class="form-check" v-for="option in options" :key="option.value">
                            <input class="form-check-input" type="radio" :value="option.value" v-model="selectedOption" name="selectedOption">
                            <label class="form-check-label" >{{ option.label }}</label>
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
    name: 'TypeComponent',
    mixins: [mixin],
    data() {
        return {
            editTypeId: null,
            categories: null,
            options: [
                { value: 'is_reason_category', label: 'Категория задержки' },
                { value: 'is_flight_type', label: 'Тип рейса' },
                { value: 'is_board_type', label: 'Тип судна' },
            ],
        }
    },
    methods: {
        async fetchData() {
            try {
                this.categories = await this.getType('admin',this.selectedType);
                console.log(this.categories)
            } catch (error) {
                console.error(error);
            }
        },
        createType() {
            axios.post('/api/admin/types', {
                title: this.type_name,
                category: this.selectedOption,

            })
                .then(
                    response => {
                        if(this.selectedType) {
                            this.fetchData();
                        }
                        this.type_name = ''
                    })
                .catch(err => {
                    console.error(err);

                })
        },
        changeEditTypeId(code) {
            this.editTypeId = code;
        },
        isEdit(code) {
            return this.editTypeId === code;
        },
        editType(code) {
            this.editTypeId = null;
            axios.patch(`/api/admin/types/${code}`, {
                name: this.type_name_edit,
                category: this.selectedOption_edit,
            })
                .then(
                    response => {
                        console.log(response)
                        this.fetchData();
                        this.type_name_edit = ''
                    })
                .catch(err => {
                    console.error(err);
                })
        },
        deleteType(id) {
            axios.delete(`/api/admin/types/${id}`)
                .then(
                    response => {
                        this.fetchData();
                    })
                .catch(err => {
                    console.error(err);
                })
        },
    }
}
</script>
