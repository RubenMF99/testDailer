<template>
    <div id="Mm"  class="menu-mobile-effect navbar-toggle" data-effect="mobile-effect" @click="menuLateral">
                    <div v-if="ver">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </div>
                    <div v-else>
                        <i style="font-size:25px;" class="fas fa-times"></i>
                    </div>
    </div>
    
</template>
<script>
export default {
    data(){
        return{
            ver:Boolean(1),
        }
    },
    methods:{
        menuLateral: function(){
            let _this = this;
            if(_this.ver)
            {
                $('.menu-responsive').removeClass('not-show-movil');
                $('.menu-responsive').addClass('yes-show-movil');
                _this.ver = Boolean(0);
            }else{
                $('.menu-responsive').removeClass('yes-show-movil');
                $('.menu-responsive').addClass('not-show-movil');
                _this.ver = Boolean(1);
            }
            
        }
    },
    mounted(){

    }
}
</script>