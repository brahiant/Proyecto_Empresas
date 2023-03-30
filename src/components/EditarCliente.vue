<template>
    <v-container class="bg-surface-variant">
            <v-card style="text-align: center;"  title=" Actualizar Cliente">
                <v-sheet width="300" class="mx-auto">
                    <v-form v-on:submit.prevent="actualizarRegistro">
                    <v-text-field
                    v-model="cliente.nombre"
                    :counter="50"
                    label="Nombre"
                    ></v-text-field>
                    <v-text-field
                    v-model="cliente.nit"
                    :counter="50"
                    label="Nit"
                    ></v-text-field>
                    <v-text-field
                    v-model="cliente.direccion"
                    :counter="50"
                    label="Dirección"
                    ></v-text-field>
                    <v-text-field
                    v-model="cliente.celular"
                    :counter="50"
                    label="Celular"
                    ></v-text-field>
                    <v-text-field
                    v-model="cliente.tipoEmpresa"
                    :counter="100"
                    label="Tipo de Empresa"
                    ></v-text-field>
                    <v-btn
                    class="me-4"
                    color="success"
                    type="submit"
                    >
                    Editar
                    </v-btn>
                    <router-link :to="{name:'Listar'}">
                    <v-btn color="orange" class="me-4" :to="{name:'Listar'}">
                    Cancelar
                    </v-btn>
                    </router-link>
                    </v-form>
                    <br/>
                </v-sheet>
            </v-card>
    </v-container>
</template>

<script>
export default {
    data(){
        return{
            cliente:{}
        }
    },
    created:function(){
        this.obtenerInformacionPorID();
    },
    methods:{
        obtenerInformacionPorID(){
            fetch('http://localhost/empleados/?consultarCliente='+this.$route.params.id)
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=> {
                console.log(datosRespuesta)
                this.cliente=datosRespuesta[0];
            })
            .catch(console.log)
        },
        actualizarRegistro(){
            var datosEnviar={id:this.$route.params.id,nombre:this.cliente.nombre,nit:this.cliente.nit,direccion:this.cliente.direccion,celular:this.cliente.celular,tipoEmpresa:this.cliente.tipoEmpresa}
            fetch('http://localhost/empleados/?actualizarCliente='+this.$route.params.id,{
                method:"POST",
                body:JSON.stringify(datosEnviar)

            })
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)
                window.location.href='../Listar'
            })
        }
    }
}
</script>