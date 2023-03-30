<template>
    <v-container class="bg-surface-variant">
        <div v-if="isAdmin == 1">
        <router-link to="/crear">
        <v-btn color="success" class="me-4" to="/crear">
        Agregar nuevo empleados
        </v-btn>
        </router-link>
        </div>
        <v-card>
            <v-card title="Lista de empleados"/>
            <v-table density="compact">
                <thead>
                    <tr>
                        <th class="text-left">Nombre</th>
                        <th class="text-left">Correo</th>
                        <th class="text-left">Celular</th>
                        <th class="text-left">Cargo</th>
                        <th class="text-left">Usuario</th>
                        <th class="text-left">Nombre del cliente</th>
                        <th class="text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="empleado in empleados" :key="empleado.id">
                        <td class="text-left">{{empleado.nombre}}</td>
                        <td class="text-left">{{empleado.correo}}</td>
                        <td class="text-left">{{empleado.celular}}</td>
                        <td class="text-left">{{empleado.cargo}}</td>
                        <td class="text-left">{{empleado.usuario}}</td>
                        <td class="text-left">{{empleado.nombreCliente}}</td>
                        <td>
                        <router-link :to="{name:'Editar',params:{id:empleado.id}}">
                        <v-btn color="info" class="me-4" :to="{name:'Editar',params:{id:empleado.id}}">
                        Editar
                        </v-btn>
                        </router-link>
                        <v-btn
                        v-on:click="borrarEmpleado(empleado.id)"
                        class="me-4"
                        color="danger"
                        type="button"
                        >
                        Borrar
                        </v-btn> 
                        </td>
                    </tr>
                </tbody>
            </v-table>
        </v-card>
        <br/><br/>
        <v-card>
        <router-link to="/crearCliente">
        <v-btn color="success" class="me-4" to="/crearCliente">
        Agregar nuevo cliente
        </v-btn>
        </router-link>
        <v-card title="Lista de clientes"/>
            <v-table density="compact">
                <thead>
                    <tr>
                        <th class="text-left">Nombre</th>
                        <th class="text-left">Nit</th>
                        <th class="text-left">celular</th>
                        <th class="text-left">Dirección</th>
                        <th class="text-left">Tipo</th>
                        <th class="text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="cliente in clientes" :key="cliente.id">
                        <td class="text-left">{{cliente.nombre}}</td>
                        <td class="text-left">{{cliente.nit}}</td>
                        <td class="text-left">{{cliente.celular}}</td>
                        <td class="text-left">{{cliente.direccion}}</td>
                        <td class="text-left">{{cliente.tipoEmpresa}}</td>
                        <td>
                        <router-link :to="{name:'EditarCliente',params:{id:cliente.id}}">
                        <v-btn color="info" class="me-4" :to="{name:'EditarCliente',params:{id:cliente.id}}">
                        Editar
                        </v-btn>
                        </router-link>
                        <v-btn
                        v-on:click="borrarCliente(cliente.id)"
                        class="me-4"
                        color="danger"
                        type="button"
                        >
                        Borrar
                        </v-btn> 
                        </td>
                    </tr>
                </tbody>
            </v-table>
        </v-card>
    </v-container>
</template>

<script>
export default {
    data(){
        return{
            empleados:[],
            clientes:[],
            userId:null,
            isAdmin:null,
            clienteId:null,
        }

    },
    created:function(){
        this.clienteId=localStorage.getItem('clienteId'),
        this.userId=localStorage.getItem('userId'),
        this.isAdmin=localStorage.getItem('isAdmin'),
        this.consultarEmpleado();
        this.consultarClientes();
    },
    methods:{
        consultarEmpleado(){
            fetch('http://localhost/empleados/?consultarClientePorUsuario')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=> {
                if(typeof datosRespuesta[0].success==='undefined')
                {
                    if(this.isAdmin==0){
                    datosRespuesta.forEach(element => {
                        if(element.id==this.userId){
                           this.empleados.push(
                            {
                            id:element.id,    
                            nombre:element.nombre,correo:element.correo,
                            celular:element.celular,cargo:element.cargo,
                            usuario:element.usuario,nombreCliente:element.nombreCliente,
                            });
                        }
                    });
                    }else{
                    this.empleados=datosRespuesta;
                    }
                   
                }
            })
            .catch(console.log)
        },
        borrarEmpleado(id){
            console.log(id);
            fetch('http://localhost/empleados/?borrar='+id)
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=> {
                console.log(datosRespuesta)
                window.location.href='Listar'
            })
            .catch(console.log)
        },
        consultarClientes(){
            fetch('http://localhost/empleados/?listarClientes')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=> {
                this.clientes=[]
                if(typeof datosRespuesta[0].success==='undefined')
                {
                    if(this.isAdmin==0){
                    datosRespuesta.forEach(element => {
                         if(element.id==this.clienteId){
                            this.clientes.push({
                                id:element.id,nombre:element.nombre,
                                nit:element.nit,direccion:element.direccion,
                                celular:element.celular,tipoEmpresa:element.tipoEmpresa,
                            })
                         }
                    });
                    }else{
                     this.clientes=datosRespuesta;
                    }
                 
                }
            })
            .catch(console.log)
        },
        borrarCliente(id){
            console.log(id);
            fetch('http://localhost/empleados/?borrarCliente='+id)
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=> {
                console.log(datosRespuesta)
                window.location.href='Listar'
            })
            .catch(console.log)
        },
    }
}
</script>