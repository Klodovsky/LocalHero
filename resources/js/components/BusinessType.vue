<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Business Type</div>

                    <div>
                        <label class="typo__label">Tagging</label>
                        <multiselect v-model="value" tag-placeholder="Add this as new tag" placeholder="Search or add a tag" label="branch" track-by="id" :options="options" :multiple="true" :taggable="true" @tag="addTag" @input="onSelect"></multiselect>
                        <!-- <pre class="language-json"><code>{{ value  }}</code></pre> -->
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
                                <!--  -->

                            </tr>
                             <tr>
                                <th scope="row"></th>
                                <td></td>
                                <td>{{this.total_1}}</td>
                                <td>{{this.total_2}}</td>
                                <td>{{this.total_3}}</td>
                                <td>{{this.total_4}}</td>
                                <td>{{this.total_5}}</td>
                                <td>{{this.total_6}}</td>
                                <td>{{this.total_7}}</td>
                                <td>{{this.total_8}}</td>
                                <td>{{this.total_9}}</td>
                                <td>{{this.total_10}}</td>
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
import Multiselect from 'vue-multiselect'
    export default {
        data(){
            return{
                total_1:'',
                total_2:'',
                total_3:'',
                total_4:'',
                total_5:'',
                total_6:'',
                total_7:'',
                total_8:'',
                total_9:'',
                total_10:'',
                businessData: {},
                loadData: false,
                //value: [],
                value: [
                     { id: 1, branch: 'Hotel' }
                ],
                options: [
                    
                ],
                insertion:{ id: '', branch: ''}
            }
        },
        components: { Multiselect },
        methods:{
            onSelect(){
                
                let data = {
                             business_values : this.value,
                        
                        }
                axios({
                            method: 'POST',
                            url:'get_specific_business_types',
                            data: data
                        })
                        .then(response =>{
                            if(response.data.status=='200'){
                                 this.businessData = response.data.data;
                                    this.total_1='';
                                    this.total_2='';
                                    this.total_3='';
                                    this.total_4='';
                                    this.total_5='';
                                    this.total_6='';
                                    this.total_7='';
                                    this.total_8='';
                                    this.total_9='';
                                    this.total_10='';
                                 for(var i=0; i<this.businessData.length; i++){
                                    // this.insertion.id = this.businessData[i].id;
                                    // this.insertion.branch = this.businessData[i].branch;
                                    

                                    // this.options.push(this.insertion);
                                    // this.insertion = {}
                                    this.total_1 = Number(this.total_1) + this.businessData[i].unbearbeitet;
                                    this.total_2 = Number(this.total_2) + this.businessData[i].gf_fehit;
                                    this.total_3 = Number(this.total_3) + this.businessData[i].nicht_erreicht;
                                    this.total_4 = Number(this.total_4) + this.businessData[i].weidervorlage;
                                    this.total_5 = Number(this.total_5) + this.businessData[i].kein_interesse;
                                    this.total_6 = Number(this.total_6) + this.businessData[i].zu_viele_versuche;
                                    this.total_7 = Number(this.total_7) + this.businessData[i].termine;
                                    this.total_8 = Number(this.total_8) + this.businessData[i].kunden;
                                    this.total_9 = Number(this.total_9) + this.businessData[i].blacklist;
                                    this.total_10 = Number(this.total_10) + this.businessData[i].insgesamt;
                                }
                                 this.loadData = true;
                            }
                            else{
                                    
                            }
                        })
                        .catch(()=>{
                            
                        });
            },
           
            addTag (newTag) {
                alert(newTag);
            const tag = {
                id: newTag,
                //code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
            }
            this.options.push(tag);
            this.value.push(tag);
                       

            }

        },
        mounted() {
            this.axios.get('get-business-type').then(response=>{
                this.businessData = response.data;

                for(var i=0; i<this.businessData.length; i++){
                    this.insertion.id = this.businessData[i].id;
                    this.insertion.branch = this.businessData[i].branch;
                    

                    this.options.push(this.insertion);
                    this.insertion = {}
                    this.total_1 = Number(this.total_1) + this.businessData[i].unbearbeitet;
                    this.total_2 = Number(this.total_2) + this.businessData[i].gf_fehit;
                    this.total_3 = Number(this.total_3) + this.businessData[i].nicht_erreicht;
                    this.total_4 = Number(this.total_4) + this.businessData[i].weidervorlage;
                    this.total_5 = Number(this.total_5) + this.businessData[i].kein_interesse;
                    this.total_6 = Number(this.total_6) + this.businessData[i].zu_viele_versuche;
                    this.total_7 = Number(this.total_7) + this.businessData[i].termine;
                    this.total_8 = Number(this.total_8) + this.businessData[i].kunden;
                    this.total_9 = Number(this.total_9) + this.businessData[i].blacklist;
                    this.total_10 = Number(this.total_10) + this.businessData[i].insgesamt;
                }
                this.loadData = true;
            })
        }
    }
</script>
