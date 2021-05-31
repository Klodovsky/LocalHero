<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Business Type</div>

                    <div>
                        <Multiselect
                            v-model="value"
                            placeholder="Choose a programming language"
                            :filterResults="false"
                            :minChars="1"
                            :resolveOnLoad="false"
                            :delay="0"
                            :searchable="true"
                            :options="[
                                        { value: 'batman', label: 'Batman' },
                                        { value: 'robin', label: 'Robin', disabled: true },
                                        { value: 'joker', label: 'Joker' },
                                      ]"
                        />
                    </div>
                    <div class="card-body">
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Branch</th>
                                <th scope="col">Unbearbeitet</th>
                                <th scope="col">GF fehit</th>
                                <th scope="col">Nicht erreicht</th>
                                <th scope="col">Weidervorlage</th>
                                <th scope="col">Kein interesse</th>
                                <th scope="col">Zu viele versuche</th>
                                <th scope="col">Termine</th>
                                <th scope="col">Kunden</th>
                                <th scope="col">Blacklist</th>
                                <th scope="col">Insgesamt</th>
                            </tr>
                            </thead>
                            <tbody v-if="loadData">
                            <tr v-for="business in businessData" :key="business.id">
                                <th scope="row">{{ business.id }}</th>
                                <td>{{ business.branch }}</td>
                                <td>{{ business.unbearbeitet }}</td>
                                <td>{{ business.gf_fehit }}</td>
                                <td>{{ business.nicht_erreicht }}</td>
                                <td>{{ business.weidervorlage }}</td>
                                <td>{{ business.kein_interesse }}</td>
                                <td>{{ business.zu_viele_versuche }}</td>
                                <td>{{ business.termine }}</td>
                                <td>{{ business.kunden }}</td>
                                <td>{{ business.blacklist }}</td>
                                <td>{{ business.insgesamt }}</td>
                            </tr>
                            </tbody>
                            <p v-else>
                                No data found
                            </p>
                            <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
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
                businessData: {},
                loadData: false,
                value: []
            }
        },
        mounted() {
            this.axios.get('get-business-type').then(response=>{
                this.businessData = response.data;
                this.loadData = true;
            })
        }
    }
</script>
