<template>
    <div class="row">
        <!-- este div es fijo -->
                <div class="col-md-12">
                    <h2 style="font-size:35px;">Registrarme</h2>
                    <br>
                    <p>Aprende habilidades de las principales universidades de manera gratuita.</p>
                    <hr>
                </div>
                <!-- ----------------------------------------------------------------------------------- -->
                <!-- fomrulario de registro / div editable-->
                <div class="col-md-12">
                    <div class="col-md-12">
                        <h2 style="font-size:18px;">Registrarte es facil y rapido</h2>
                        <p> </p>
                    </div>
                    <div class="col-md-12">
                        <input v-model="nombres" :class="'ddco-t-100  '" @input="DeleteError" type="text" name="" id="" placeholder="Nombres">
                    </div> 
                    <div class="col-md-12">
                        <input v-model="apellidos" :class="'ddco-t-100 '" @input="DeleteError" type="text" name="" id="" placeholder="Apellidos">
                    </div>
                    <div class="col-md-12">
                        <input v-model="correo" :class="'ddco-t-100 correo '" @input="DeleteError" type="text" name="" id="" placeholder="Correo Electronico"> 
                    </div>
                    <div class="col-md-9">
                        <input v-model="password" :class="'ddco-t-100 '" @input="DeleteError" :type="typeInput" name="" id="" placeholder="Contraseña">
                    </div>
                    
                    <div class="col-md-3">
                        <h2 style="font-size:18px;color:rgba(0,0,0,0.5);"><input type="checkbox" v-model="inputcheck" @input="verpass(this);" name="check" id="check" > Mostrar</h2>
                    </div>
                    <div class="col-md-12">
                        <p>Al hacer clic en "Crear Cuenta", aceptas nuestras Condiciones, 
                            la Política de datos y la Política de cookies.</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <br>
                    <button class="ddco-btn-banners ddco-btn-primary float-right" @click="validar">Crear Cuentas</button>
                    <div>
                        <p style="padding-left:30px;color:red;" v-text="errornewcuenta"></p>
                    </div>
                </div>
                <!-- ------------------------------------------------------------------------------- -->
                <div class="col-md-12">
                    <!--div fijo no tocar-->
                    <hr>
                    <p>Power by: <a href="http://digitaldreams.co" target="_blank">Digital Dreams.co</a></p>
                </div>
                <!-- ------------------------------------------------------------------------------- -->
            </div>
</template>
<script>
export default{
    props:['ruta'],
    data(){
        return{
            nombres:'',  apellidos:'', correo:'',
            password:'',
            typeInput:'password', inputcheck:'', ir:3,
            errornewcuenta:'',
        }
    },
    mounted(){

    },
    methods:{
        iniciarsesion(){
            let me = this;
                me.button_view = Boolean(1);
                // validacion de input
                     axios.post(me.ruta + 'login',{
                    'usuario': me.correo,
                    'contrasena': me.password
                    }).then(function (response) {
                        me.button_view = Boolean(0);
                        let respose = response.data;
                        if(respose === ""){ window.location.href = "/Home";}else{
                             if(localStorage.getItem('rutaCompra')===null || localStorage.getItem('rutaCompra')===undefined){}else{
                                // ruta para comprar un curso.
                                window.location.href=localStorage.getItem('rutaCompra');
                            }
                        }
                        // si el usuario o contraseña es incorrecto
                        if(response.data ==="error"){
                            me.errornewcuenta = "Usuario y/o Contraseña Incorrecta";
                        }
                        // comprobamos si lo enviamos a la vista por defecto o la accion del usuario
                    }).catch(function (error) {
                        console.log(error);
                        me.button_view = Boolean(0);
                    });
                
        },
        verpass(){
            let me = this;
            (me.inputcheck)?me.typeInput = 'password':me.typeInput='text';
        },
        validar(){
            let state = true, me = this;
            $('.ddco-t-100').each(function(){
                    if($(this).val()===""){
                        $(this).addClass('ddco-errors-input');
                        state = false;
                    }
            });
            if(state){me.validateEmail();}
        },
         registrarUsuario(){
                let me = this;
                axios.post(me.ruta + '/usuario/registrar',{
                    'usuario': me.correo,  // datos de usuarios
                    'contrasena': me.password,  // datos de usuarios
                    'primer_nombre':  me.nombres,  // información de la persona
                    'primer_apellido': me.apellidos,  // información de la persona
                    'ir':me.ir,
                }).then(function (response) {
                    // iniciar sesion con el usuario que se acaba de regstrar.
                me.iniciarsesion();
                }).catch(function (error) {
                    console.log(error);
                });
            },
            DeleteError(){
                let me = this;
                 $('.ddco-t-100').each(function(){
                    if($(this).val()!==""){
                        $(this).removeClass('ddco-errors-input');
                        me.errornewcuenta = "";
                    }
            });
            },
            validateEmail(){
                let me = this;
                let url = "/correo?correo="+me.correo;
                        axios.get(url).then(function (response) {
                        let result  = response.data;
                        $('.correo').addClass('ddco-errors-input');
                        (Boolean(result.state))?me.registrarUsuario():me.errornewcuenta = result.answer,$('.correo').addClass('ddco-errors-input');
                        }).catch(function (error){console.error(error);});
            }

    }
}
</script>
