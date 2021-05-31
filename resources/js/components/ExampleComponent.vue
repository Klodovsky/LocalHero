<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Validator</div>

                    <div class="card-body">
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Sales person</th>
                                <th scope="col">Post code</th>
                            </tr>
                            </thead>
                            <tbody v-if="loadData">
                            <tr v-for="validator in validatorData" :key="validator.id">
                                <th scope="row">{{ validator.id }}</th>
                                <td>{{ validator.sales_person_name }}</td>
                                <td>{{ validator.post_code }}</td>
                            </tr>
                            </tbody>
                            <p v-else>
                                No data found
                            </p>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                validatorData: {},
                loadData: false,
            }
        },
        mounted() {
            this.axios.get('get-validator').then(response=>{
                this.validatorData = response.data;
                this.loadData = true;
            })
        }
    }
</script>
