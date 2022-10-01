<template>
    <header class="bg-gray-700 flex items-center justify-between px-4 lg:px-48 xl:px-64 py-4">
        <h2 class="text-2xl font-medium text-violet-600">UDEMYX</h2>
        <nav class="flex items-center justify-between">
            <a href="" @click.prevent="logout()" class="text-white text-lg">Salir</a>
        </nav>
    </header>
</template>

<script>

    export default{
        methods:{
           async logout(){
                try{
                    let res = await axios.get('/api/logout',{
                            headers: {
                                'Accept':'application/json',
                                'Content-Type': 'application/json'
                            }
                        });
                    let json = await res.data;

                    if(json.status){
                        window.location.reload();
                        localStorage.removeItem('x-token');
                    }

                }catch(err){
                    console.log(err);
                }
           }
        },
        mounted() {

        }
    }
</script>
