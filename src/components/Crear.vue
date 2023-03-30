<template>
    <v-container class="bg-surface-variant">
            <v-card style="text-align: center;"  title=" Crear Empleado">
                <v-sheet width="300" class="mx-auto">
                    <v-form v-on:submit.prevent="agregarRegistro">
                    <v-text-field
                    v-model="empleado.nombre"
                    :counter="50"
                    label="Nombre"
                    ></v-text-field>
                    <v-text-field
                    v-model="empleado.correo"
                    :counter="50"
                    label="Correo"
                    ></v-text-field>
                    <v-text-field
                    v-model="empleado.celular"
                    :counter="50"
                    label="Celular"
                    ></v-text-field>
                    <v-text-field
                    v-model="empleado.cargo"
                    :counter="50"
                    label="Cargo"
                    ></v-text-field>
                    <v-text-field
                    v-model="empleado.usuario"
                    :counter="50"
                    label="Usuario"
                    ></v-text-field>
                    <v-text-field
                    v-model="empleado.contrasenia"
                    :counter="50"
                    label="Contraseña"
                    ></v-text-field>
                    <v-select
                    v-model="select"
                    :hint="`${select.nombre}, ${select.id}`"
                    :items="items"
                    item-title="nombre"
                    item-value="id"
                    label="Clientes"
                    persistent-hint
                    return-object
                    single-line
                    ></v-select>
                    <v-btn
                    class="me-4"
                    color="success"
                    type="submit"
                    >
                    Agregar
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
            empleado:{},
            select:[],
            items:[],
            cliente:null,
        }
    },
    created:function(){
        this.consultarClientes();
    },
    methods:{
        agregarRegistro(){
            var datosEnviar={nombre:this.empleado.nombre,correo:this.empleado.correo,
                celular:this.empleado.celular,cargo:this.empleado.cargo,usuario:this.empleado.usuario,
                contrasenia:this.empleado.contrasenia,id_cliente:this.select.id}
            console.log(datosEnviar)
            fetch('http://localhost/empleados/?insertar=1',{
                method:"POST",
                body:JSON.stringify(datosEnviar)

            })
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{
                console.log(datosRespuesta)
                window.location.href='Listar'
            })
        },
        consultarClientes(){
            fetch('http://localhost/empleados/?listarClientes')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=> {
                if(typeof datosRespuesta[0].success==='undefined')
                {
                    datosRespuesta.forEach(cliente => {
                        this.items.push({nombre:cliente.nombre,id:cliente.id});
                    });
                }
            })
            .catch(console.log)
        }

    }
    
}
</script>