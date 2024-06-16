<template>
    <div v-if="!aircraftModels || !countries" class="loading-row">
        <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <div v-else id="app" class="container mt-3">
        <div class="row">
            <div class="container m-lg-4 col-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h5 class="mb-0">Создание производителя</h5>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="createManufacturer" id="addForm" method="POST">
                            <div class="form-group">
                                <label for="inputCode">Название:</label>
                                <input type="text" class="form-control" name="manufacturer_title"
                                       v-model="manufacturer_title"
                                       placeholder="Введите название производителя" required>
                            </div>
                            <div class="form-group">
                                <label for="fk_board_type">Страна-производитель:</label>
                                <select v-model="country_id" v-if="countries" name="country_id"
                                        class="form-select form-control"
                                        data-size="4">
                                    <template v-for="country in countries" :key="country.id">
                                        <option :value="country.id">{{ country.title }}</option>
                                    </template>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Создать</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="container m-lg-4 col-6">
                <div class="card ">
                    <div class="card-header text-center">
                        <h5 class="mb-0">Создание модели</h5>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="createAircraftModel" id="addModelForm" method="POST">
                            <div class="form-group">
                                <label for="inputCode">Модель:</label>
                                <input type="text" class="form-control" name="aircraft_model_title" v-model="aircraft_model_title"
                                       placeholder="Введите название модели" required>
                            </div>
                            <div class="form-group">
                                <label for="fk_board_type">Производитель:</label>
                                <select v-model="manufacturer_id" v-if="manufacturers" name="manufacturer_id"
                                        class="form-select form-control"
                                        data-size="4">
                                    <template v-for="manufacturer in manufacturers" :key="manufacturer.id">
                                        <option :value="manufacturer.id">{{ manufacturer.title }}</option>
                                    </template>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Создать</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="container m-lg-4 col-5">
                <div class="card ">
                    <div class="card-header text-center">
                        Производители
                    </div>
                    <table class="table table-bordered table-hover" id="dataTable">
                        <thead class="non-clickable">
                        <tr>
                            <th class="text-center">Название</th>
                            <th class="text-center">Страна-производитель</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="cursor-pointer "></tr>
                        <template v-for="manufacturer in manufacturers" :key="manufacturer.id">
                            <tr>
                                <td>{{ manufacturer.title }}</td>
                                <td>{{ manufacturer.country.title }}</td>
                                <td>
                                    <div class="d-flex">
                                        <button :class="isEdit(1,manufacturer.id) ? 'd-none' : 'hidden'"
                                                class="btn btn-outline-success m-1"
                                                @click.prevent="changeEditManufacturerCode(manufacturer.id)">Редактировать
                                        </button>
                                        <button :class="isEdit(1,manufacturer.id) ? 'hidden' : 'd-none'"
                                                class="btn btn-outline-secondary m-1"
                                                @click.prevent="this.editManufacturerId = null">Отмена
                                        </button>
                                        <button class="btn btn-outline-danger m-1"
                                                @click.prevent="deleteManufacturer(manufacturer.id)">Удалить
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr :class="isEdit(1,manufacturer.id) ?'':'d-none'">
                                <td><input type="text" class="form-control" v-model="manufacturer_title_edit"></td>
                                <td>
                                    <div class="form-group">
                                        <select v-model="country_id_edit" v-if="countries" name="country_id_edit"
                                                class="form-select form-control"
                                                data-size="4">
                                            <template v-for="country in countries" :key="country.id">
                                                <option :value="country.id">{{ country.title }}</option>
                                            </template>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-outline-success m-1"
                                            @click.prevent="editManufacturer(manufacturer.id)">Сохранить
                                    </button>
                                </td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container m-lg-4 col-6">
                <div class="card ">
                    <div class="card-header text-center">
                        Модели
                    </div>
                    <table class="table table-bordered table-hover" id="dataTable">
                        <thead class="non-clickable">
                        <tr>
                            <th class="text-center">Производитель</th>
                            <th class="text-center">Модель</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="cursor-pointer "></tr>
                        <template v-for="aircraftModel in aircraftModels" :key="aircraftModel.id">
                            <tr>
                                <td>{{ aircraftModel.manufacturer.title }}</td>
                                <td>{{ aircraftModel.title }}</td>
                                <td>
                                    <div class="d-flex">
                                        <button :class="isEdit(0,aircraftModel.id) ? 'd-none' : 'hidden'"
                                                class="btn btn-outline-success m-1"
                                                @click.prevent="changeAircraftModelCode(aircraftModel.id)">Редактировать
                                        </button>
                                        <button :class="isEdit(0,aircraftModel.id) ? 'hidden' : 'd-none'"
                                                class="btn btn-outline-secondary m-1"
                                                @click.prevent="this.editAircraftModelId = null">Отмена
                                        </button>
                                        <button class="btn btn-outline-danger m-1"
                                                @click.prevent="deleteAircraftModel(aircraftModel.id)">Удалить
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr :class="isEdit(0,aircraftModel.id) ?'':'d-none'">
                                <td>
                                    <select v-model="manufacturer_id_edit" v-if="manufacturers"
                                            name="manufacturer_idd_edit"
                                            class="form-select form-control"
                                            data-size="4">
                                        <template v-for="manufacturer in manufacturers" :key="manufacturer.id">
                                            <option :value="manufacturer.id">{{ manufacturer.title }}</option>
                                        </template>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" v-model="aircraft_model_title_edit"></td>
                                <td>
                                    <button class="btn btn-outline-success m-1"
                                            @click.prevent="editAircraftModel(aircraftModel.id)">Сохранить
                                    </button>
                                </td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import mixin from "../mixins/mixin.js";

export default {
    name: 'ModelComponent',
    mixins: [mixin],
    data() {
        return {
            manufacturers: null,
            editManufacturerId: null,
            editAircraftModelId: null,
            aircraftModels: null,
            countries: null,
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        async fetchData() {
            try {
                this.manufacturers = await this.getData('/api/admin/manufacturers');
            } catch (error) {
                console.error(error);
            }
            try {
                this.aircraftModels = await this.getData('/api/admin/models');
            } catch (error) {
                console.error(error);
            }
            try {
                this.countries = await this.getData('/api/admin/countries');
            } catch (error) {
                console.error(error);
            }
        },
        createManufacturer() {
            axios.post('/api/admin/manufacturers', {
                title: this.manufacturer_title,
                country_id: this.country_id,
            })
                .then(
                    response => {
                        this.fetchData();
                        this.manufacturer_title = ''
                        this.country_id = ''
                    })
                .catch(err => {
                    console.error(err);
                })
        },
        createAircraftModel() {
            axios.post('/api/admin/models', {
                title: this.aircraft_model_title,
                manufacturer_id: this.manufacturer_id,
            })
                .then(
                    response => {
                        this.fetchData();
                        this.aircraft_model_title = ''
                        this.manufacturer_id = ''
                    })
                .catch(err => {
                    console.error(err);
                })
        },
        changeEditManufacturerCode(id) {
            this.editManufacturerId = id;
        },
        changeAircraftModelCode(id) {
            this.editAircraftModelId = id;
        },
        isEdit(mark, id) {
            if (mark === 1)
                return this.editManufacturerId === id;
            else {
                return this.editAircraftModelId === id;
            }
        },
        editManufacturer(id) {
            this.editManufacturerId = null;
            axios.patch(`/api/admin/manufacturers/${id}`, {
                title: this.manufacturer_title_edit,
                country_id: this.country_id_edit,
            })
                .then(
                    response => {
                        this.fetchData();
                    })
                .catch(err => {
                    console.error(err);
                })
        },
        editAircraftModel(id) {
            this.editAircraftModelId = null;
            axios.patch(`/api/admin/models/${id}`, {
                title: this.aircraft_model_title_edit,
                manufacturer_id: this.manufacturer_id_edit,
            })
                .then(
                    response => {
                        this.fetchData();
                    })
                .catch(err => {
                    console.error(err);
                })
        },
        deleteManufacturer(id) {
            axios.delete(`/api/admin/manufacturers/${id}`)
                .then(
                    response => {
                        this.fetchData();
                    })
                .catch(err => {
                    console.error(err);
                })
        },
        deleteAircraftModel(id) {
            axios.delete(`/api/admin/models/${id}`)
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
