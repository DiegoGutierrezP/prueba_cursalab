<template>
    <div v-if="loading" class="flex items-center justify-center text-white text-2xl">
        Cargando cursos.....
    </div>
    <div v-else class="grid grid-cols-2 sm:grid-cols-3 gap-4 w-full mt-4">
        <div v-for="curso in cursos" @click.prevent="redirect(curso.rutaShow)" class="cursor-pointer bg-white rounded-lg py-4 px-2 hover:bg-slate-100">
            <h2 class="text-2xl font-medium mb-2 leading-6">{{curso.nombre_curso}}</h2>
            <span class="text-sm font-normal">{{curso.profesor}}</span>
        </div>

    </div>
</template>

<script >

    let token = localStorage.getItem('x-token');

    export default{
        data(){
            return {
                loading:false,
                cursos:[]
            }
        },
        methods:{
            redirect(ruta){
                window.location = ruta;
            },
            async get_cursos(){
                try{
                    this.loading = true;
                    let res = await axios.get('/api/cursos-user',{
                        headers: {
                            'Accept':'application/json',
                            'Content-Type': 'application/json',
                            "Authorization" : `Bearer ${token}`
                        }
                    });
                    let json = await res.data;
                    this.cursos = json.data;
                    console.log(json);
                }catch(err){
                    console.log(err);
                }finally{
                    this.loading = false;
                }
            }
        },
        mounted() {
            this.get_cursos();
            console.log(token);
        }
    }
</script>
