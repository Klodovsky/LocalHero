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
                                <Modal :based-on="showModal" title="My first modal" @close="showModal = false">
                                    
                                        
                                        <div >
                                            <label class="typo__label">Name</label>
                                            <div  class="">
                                                <input  type="text"  name="person_name" class="form-control" :value="validator.sales_person_name">
                                            </div>
                                        </div>
                                        <div>
                                            <label class="typo__label">Postal Codes</label>
                                            <multiselect v-model="post_codes" tag-placeholder="Add this as new tag" placeholder="Search or add a tag" label="name" track-by="post_code" :options="post_codes" :multiple="true" :taggable="true" @tag="addTag"></multiselect>
                                            <pre class="language-json"><code>{{ post_codes  }}</code></pre>
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
                post_codes:[ {code:''}],
                showModal: false,
                validatorData: {},
                loadData: false,
                value: [
                    { name: 'Javascript', code: 'js' }
                ],
                options: [
                    
                ],
                insertion:{ postal_code: ''},
                person_data:{}
            }
        },
        methods:{
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
                                this.post_codes = this.person_data.post_code;
                                this.options.push(this.post_codes);

                                 


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
                    post_code: newTag,
                    //code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
                }
                this.options.push(tag)
                this.post_codes.push(tag)
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
