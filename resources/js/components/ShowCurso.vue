<template >
    <div v-if="loading" class="w-full text-center text-white text-2xl">
        Cargando...
    </div>
    <div v-else class="grid grid-cols-3 gap-2">
        <div v-if="!activeCapitulo" class="col-span-2">
            <h1 class="text-3xl text-white font-medium">{{curso.nombre_curso}}</h1>
            <h4 class="text-xl text-white mt-4">Profesor: {{curso.profesor}}</h4>
        </div>
        <div v-else class="col-span-2">
            <h1 class="text-2xl text-white font-medium">{{activeCapitulo.nombre_capitulo}}</h1>
            <p  class="text-white mt-4">
                {{activeCapitulo.contenido}}
            </p>
        </div>
        <div class="col-span-1 bg-gray-900 p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-white text-lg">Capitulos</h2>
                <div>
                    <span class="bg-violet-500 px-2 py-1 rounded-md cursor-pointer hover:bg-violet-700" @click.prevent="beforeCapitulo()">👈</span>
                    <span  class="bg-violet-500  px-2 py-1 rounded-md cursor-pointer hover:bg-violet-700" @click.prevent="nextCapitulo()">👉</span>
                </div>
            </div>

            <br>
            <div class="grid grid-cols-1 gap-2">
                <div v-for="cap in curso.capitulos" @click.prevent="setActiveCapitulo(cap.id)"  class="bg-gray-700 p-2 text-white text-sm w-full rounded-md">
                    {{cap.nombre_capitulo}}
                 </div>
            </div>

        </div>
    </div>
</template>

<script >
    let token = localStorage.getItem('x-token');
    let pathname = window.location.pathname;

    export default{
        data(){
            return {
                loading:false,
                curso:{},
                activeCapitulo:null,
                activeNumberCap:0
            }
        },
        methods:{
            setActiveCapitulo(id_cap){

                let capitulos = this.curso.capitulos;
                this.activeCapitulo = capitulos.find(c => c.id === id_cap);
                /* capitulos.forEach((i,cap) => {
                    if(cap.id === id_cap){
                        this.activeCapitulo = cap;
                        //this.activeNumberCap = i+1;
                    }
                }); */
            },
            beforeCapitulo(){
                let capitulos = this.curso.capitulos;
                if(this.activeCapitulo){
                    this.activeCapitulo = this.activeNumberCap === 1 ? null : capitulos[this.activeNumberCap-1];
                    this.activeNumberCap = this.activeNumberCap-1;
                }
            },
            nextCapitulo(){
                let capitulos = this.curso.capitulos;
                if(!this.activeCapitulo){
                    this.activeCapitulo = capitulos[0];
                    this.activeNumberCap = 1;
                }else{
                    this.activeCapitulo = capitulos[this.activeNumberCap];
                    this.activeNumberCap = 1+this.activeNumberCap;
                }
            },
            async get_curso(){
                try{
                    let idCurso = pathname.split('/').pop();
                    this.loading = true;
                    let res = await axios.get(`/api/get_curso/${idCurso}`,{
                        headers: {
                            'Accept':'application/json',
                            'Content-Type': 'application/json',
                            "Authorization" : `Bearer ${token}`
                        }
                    });
                    let json = await res.data;
                    this.curso = json.data;
                    console.log(json);
                }catch(err){
                    console.log(err);
                }finally{
                    this.loading = false;
                }
            }
        },
        mounted() {
            this.get_curso();

        }
    }
</script>
