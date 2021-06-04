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
                                <th scope="row"><a @click="showModalData(validator.id)" class="btn btn-primary">{{ validator.id }}</a></th>
                                <td>{{ validator.sales_person_name }}</td>
                                <td>{{ validator.post_code }}</td>
                                <Modal :based-on="showModal" title="Person Sales Area Codes" @close="showModal = false">
                                    
                                        
                                        <!-- <div >
                                            <label class="typo__label">Name</label>
                                            <div  class="">
                                                <input  type="text"  name="person_name" class="form-control" :value="validator.sales_person_name">
                                            </div>
                                        </div><br> -->
                                        <div>
                                            <label class="typo__label">Postal Codes</label>
                                            <multiselect v-model="value" tag-placeholder="Add this as new tag" placeholder="Search or add new code" label="code" track-by="id" :options="options" :multiple="true" :taggable="true" @tag="addTag"></multiselect>
                                            <br><div><button class="btn btn-primary" @click="checkConflict">Submit</button></div>
                                            <pre class="language-json"><code>{{ final_response  }}</code></pre>
                                        </div>
                                     
                                </Modal>
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
import Multiselect from 'vue-multiselect'
import VueModal from '@kouts/vue-modal'
import '@kouts/vue-modal/dist/vue-modal.css'
    export default {
        data(){
            return{
                
                showModal: false,
                validatorData: {},
                loadData: false,
                value: [
                     //{ id: 1, code: 'js' }
                ],
                options: [
                    
                ],
                insertion:{ id:'', code: ''},
                person_data:{},
                person_id:'',
                final_response:{}
            }
        },
        methods:{
            checkConflict(){
                let data = {
                            sales_person: this.person_id,
                            codes : this.value,

                        
                        }
                axios({
                            method: 'POST',
                            url:'check_conflict',
                            data: data
                        })
                        .then(response =>{
                            this.final_response = response.data; 
                        })
                        .catch(()=>{
                            
                        });

            },
            showModalData(id){
                        let data = {
                             id : id,
                        
                        }
                axios({
                            method: 'POST',
                            url:'get_specific_sales_person',
                            data: data
                        })
                        .then(response =>{
                            // if(response.data.status=='200'){
                                //alert(response.data);
                              
                                this.person_data = response.data.sales_person;
                                this.person_id = response.data.sales_person.id;
                                //this.insertion.id = this.person_data.id;
                                //this.insertion.code = this.person_data.post_code.toString();
                                for(var i=0; i<this.person_data.post_code.length; i++){
                                    

                                    this.insertion.id = i+1;
                                    this.insertion.code = this.person_data.post_code[i];
                                    this.options.push(this.insertion);
                                    this.insertion={};
                                    
                                }
                                

                                 


                            // }
                            // else{
                                    
                            // }
                        })
                        .catch(()=>{
                            
                        });
                this.showModal = true;
            },
             addTag (newTag) {
                const tag = {
                    id: 11,
                    code: newTag,
                    //code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
                }
                this.options.push(tag)
                this.value.push(tag)
            }
            
        },
        components: {
            'Modal': VueModal,
            Multiselect
        },
        mounted() {
            this.axios.get('get-validator').then(response=>{
                this.validatorData = response.data;
                this.loadData = true;
            })
        }
    }
</script>
