<template>
  <v-container>
    <v-row class="text-center">
      <v-col cols="12">
        <v-img
          :src="require('../assets/empresa.jpg')"
          class="my-3"
          contain
          height="200"
        />
      </v-col>
      <v-sheet width="300" class="mx-auto">
    <v-form v-on:submit.prevent="login">
      <v-text-field
        v-model="empleado.usuario"
        label="Nombre de Usuario"
      ></v-text-field>
      <v-text-field
        v-model="empleado.contrasenia"
        label="Contraseña"
      ></v-text-field>
      <v-btn type="submit" block class="mt-2">Ingresar</v-btn>
    </v-form>
  </v-sheet>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data(){
        return{
            empleado:{
              usuario:'admin',
              contrasenia:'',
            },
        }
  },
  beforeMount() {
    localStorage.removeItem('userId');
    localStorage.removeItem('clienteId');
    localStorage.removeItem('isAdmin');
  },
  methods:{
    login(){
      fetch('http://localhost/empleados/?listarEmpleados')
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=> {
                if(typeof datosRespuesta[0].success==='undefined')
                {
                  var count=0;
                    datosRespuesta.forEach(element => {
                      if((element.usuario==this.empleado.usuario 
                      && element.contrasenia==this.empleado.contrasenia) || (this.empleado.usuario=='admin')){
                        window.location.href='Listar'
                        console.log(element.id);
                        localStorage.setItem('userId',element.id);
                        localStorage.setItem('clienteId',element.id_cliente);
                        localStorage.setItem('isAdmin',element.isAdmin);
                        count=1;
                      }
                    });
                    if(count == 0) alert("El usuario o contraseña es incorrecto");
                }
            })
            .catch(console.log)

    }
  }
}
</script>
