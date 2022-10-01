<template>
    <div class="bg-gray-500 rounded-md w-full sm:w-96 px-4 py-2">
        <h2 class="text-3xl text-white font-medium text-center my-3 ">Login</h2>
        <form @submit.prevent="handleSubmitForm()" action="">
            <div class="mb-2 ">
                <label class="block mb-1 text-white font-medium">Email</label>
                <input type="email" v-model="formLogin.email" class="w-full p-2 rounded-md" >
                <small class="text-red-500 text-sm">{{errors.email}}</small>
            </div>
            <div class="mb-2">
                <label class="block mb-1 text-white font-medium">Password</label>
                <input type="password"  v-model="formLogin.password"  class="w-full p-2 rounded-md">
                <small class="text-red-500 text-sm">{{errors.password}}</small>
            </div>
            <a :href="registerRoute" class="float-right underline text-blue-700 text-sm my-2 mb-3">Registrarse aqui</a>
            <br>
            <div class="mb-2 mt-3">
                <button :disabled="loading" type="submit" class="py-2 w-full rounded-md bg-violet-500 hover:bg-violet-600 duration-300">Entrar</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default{
        props:['registerRoute'],
        data(){
            return {
                formLogin:{
                    email:'',
                    password:''
                },
                errors:{

                },
                loading:false,
            }
        },
        methods:{
            validateForm(){
                let errors ={};
                if(!this.formLogin.email.trim()){
                    errors.email = 'El email es requerido'
                }
                if(!this.formLogin.password.trim()){
                    errors.password = 'El password es requerido'
                }

                return errors;
            },
            async handleSubmitForm(){

                this.errors = this.validateForm();
                if(Object.keys(this.errors).length === 0){
                    try{
                        this.loading = true;
                        let resp = await axios.post('/api/login',this.formLogin,{
                            headers: {
                                'Accept':'application/json',
                                'Content-Type': 'application/json'
                            }
                        });
                        let json = await resp.data;
                        window.location.reload();
                        console.log(json)
                    }catch(err){
                        console.log(err,err.response);
                        let errores = '';
                        if(err.response.status  && err.response.data.errors){
                            errores += '<ul>';
                            let resp = err.response.data.errors;
                            for (const er in resp) {
                                errores += `<li>${resp[er][0]}</li>`
                            }
                            errores += '</ul>';
                        }else if (err.response.data.msg){
                            errores = `<p>${err.response.data.msg}</p>`;
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
            console.log(this.registerRoute)
        }
    }
</script>

