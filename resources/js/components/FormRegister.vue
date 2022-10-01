<template>
    <div class="bg-gray-500 rounded-md w-full sm:w-96 px-4 py-2">
        <h2 class="text-3xl text-white font-medium text-center my-3 ">Register</h2>
        <form @submit.prevent="handleSubmitForm()" action="">
            <div class="mb-2 ">
                <label class="block mb-1 text-white font-medium">Nombre</label>
                <input type="text" v-model="formRegister.nombre" class="w-full p-2 rounded-md" >
                <small class="text-red-500 text-sm">{{errors.nombre}}</small>
            </div>
            <div class="mb-2 ">
                <label class="block mb-1 text-white font-medium">Email</label>
                <input type="email" v-model="formRegister.email" class="w-full p-2 rounded-md" >
                <small class="text-red-500 text-sm">{{errors.email}}</small>
            </div>
            <div class="mb-2">
                <label class="block mb-1 text-white font-medium">Password</label>
                <input type="password" v-model="formRegister.password" class="w-full p-2 rounded-md">
                <small class="text-red-500 text-sm">{{errors.password}}</small>
            </div>
            <div class="mb-2">
                <label class="block mb-1 text-white font-medium">Password Confirm</label>
                <input type="password" v-model="formRegister.password_confirmation" class="w-full p-2 rounded-md">
                <small class="text-red-500 text-sm">{{errors.password_confirmation}}</small>
            </div>
            <a :href="loginRoute" class="float-right underline text-blue-700 text-sm my-2 mb-3">Logueate</a>
            <br>
            <div class="mb-2 mt-3">
                <button :disabled="loading" type="submit" class="py-2 w-full rounded-md bg-violet-500 hover:bg-violet-600 duration-300 font-medium text-white">Registrarse</button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

    export default{
        props:['loginRoute'],
        data(){
            return {
                formRegister:{
                    nombre:'',
                    email:'',
                    password:'',
                    password_confirmation:''
                },
                errors:{},
                loading:false,
            }
        },
        methods:{
            validateForm(){
                let errors ={};
                if(!this.formRegister.nombre.trim()){
                    errors.nombre = 'El nombre es requerido'
                }
                if(!this.formRegister.password_confirmation.trim()){
                    errors.password_confirmation = 'Confirma password'
                }
                if(!this.formRegister.email.trim()){
                    errors.email = 'El email es requerido'
                }
                if(!this.formRegister.password.trim()){
                    errors.password = 'El password es requerido'
                }

                return errors;
            },
            async handleSubmitForm(){

                this.errors = this.validateForm();
                if(Object.keys(this.errors).length === 0){
                    try{
                        console.log(this.formRegister)
                        this.loading = true;
                        let resp = await axios.post('/api/register',this.formRegister,{
                            headers: {
                                'Accept':'application/json',
                                'Content-Type': 'application/json'
                            }
                        });
                        let json = await resp.data;
                        Swal.fire({
                            text:json.msg,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then(result => {
                            window.location = this.loginRoute
                        })
                        console.log(json)
                    }catch(err){
                        console.log(err,err.response);
                        let errores = '';
                        if(err.response.status == 422 && err.response.data.errors){
                            errores += '<ul>';
                            let resp = err.response.data.errors;
                            for (const er in resp) {
                                errores += `<li>${resp[er][0]}</li>`
                            }
                            errores += '</ul>';
                        }
                        Swal.fire({
                            html:errores ? errores : '<p>Ocurrio un error</p>',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        })
                    }finally{
                        this.loading = false;
                    }

                }
            }
        },
        mounted() {
            console.log('Formregister.')
        }
    }
</script>

