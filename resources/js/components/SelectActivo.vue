<template>
  <div>
      <multiselect
          v-model="activo"
          ref="multiselect"
          placeholder="Buscador de activos"
          label="nombre"
          track-by="id"
          open-direction="bottom"
          :options="activos"
          :option-height="300"
          :show-labels="false"
          :searchable="true"
          :loading="isLoading"
          :internal-search="false"
          :clear-on-select="true"
          :close-on-select="true"
          :allow-empty="false"
          :options-limit="20"
          :max-height="600"
          :show-no-results="false"
          :hide-selected="false"
          @search-change="asyncFind"
          @select="clear"
          selectLabel="Presione enter para selecionar"
          selectedLabel="Seleccionado"
          deselectLabel="Presione enter para remover"
      >



          <template slot="singleLabel" slot-scope="props">
              <div class='select-result-content clearfix' style="max-width: 100%">
                  <div class='select-result__avatar'>
                      <img :src='props.option.thumb' class='img-responsive' alt='Image'>
                  </div>
                  <div class='result-container text-uppercase'>

                      <div class='select-result__nombre' v-text="props.option.nombre"></div>

                      <div class='select-result__precio'>
                          <i class='far fa-money-bill-alt'></i>
                          <span v-text="props.option.valor_actual"></span>
                      </div>
                      <div class='select-result__codigo'>
                          <i class='fas fa-barcode'></i>
                          <span v-text="props.option.codigo_inventario"></span>
                      </div>
                      <div class='select-result__contiene'>
                          <span v-html="props.option.descripcion"></span>
                      </div>
                  </div>
              </div>
          </template>

          <template slot="option" slot-scope="props">
              <div class='select-result-content clearfix' style="max-width: 100%">
                  <div class='select-result__avatar'>
                      <img :src='props.option.thumb' class='img-responsive' alt='Image'>
                  </div>
                  <div class='result-container text-uppercase'>

                      <div class='select-result__nombre' v-text="props.option.nombre"></div>

                      <div class='select-result__precio'>
                          <i class='far fa-money-bill-alt'></i>
                          <span v-text="props.option.valor_actual"></span>
                      </div>
                      <div class='select-result__codigo'>
                          <i class='fas fa-barcode'></i>
                          <span v-text="props.option.codigo_inventario"></span>
                      </div>
                      <div class='select-result__contiene'>
                          <span v-html="props.option.descripcion"></span>
                      </div>
                  </div>
              </div>
          </template>

          <span slot="noResult">Oops! No se encontraron elementos. Considere cambiar la consulta de búsqueda.</span>


          <template slot="noOptions">
              Ingrese código,nombre o descripción para la búsqueda
          </template>

      </multiselect>
  </div>
</template>

<script>

    import Multiselect from 'vue-multiselect'

    export default {
        name: 'select-activos',
        components: {
            Multiselect
        },
        mounted(){
        },
        created() {
            this.activo = this.value;
        },
        props:{
            value: {
                default: null,
                required: true
            },
            solicitud: {
                type: Boolean,
                default:false
            }
        },
        data: () => ({
            activos : [],
            isLoading: false,
            activo: null
        }),
        computed: {
            titulo () {
                return 'hola';
            }
        },
        watch: {
            loading (val) {
                val || this.getDatos()
            },
            activo (val) {
                if (!val){
                    this.activos = [];
                }
                this.$emit('input', val);
            },
            value(val){
                logI('cambio valor_actual');
                this.activo = val;
            }
        },
        methods: {

            async asyncFind(query) {

                if (query!='' && query.length > 3){


                    this.isLoading = true;

                    try{

                        let data= { params: {search: query} };

                        const res = await axios.get(route('api.activos.index'),data);
                        this.activos = res.data.data;

                        this.isLoading = false;

                    }catch (error) {

                        this.isLoading = false;
                        if (error.response){
                            logI(error.response.data)
                        }else {
                            logI(error)
                        }

                    }

                }

            },
            customLabel (option) {
                return `${option.nombre}`
            },
            clear(){
                this.activos = [];
            }

        }
    }
</script>


<style scoped>

    @import "../../../node_modules/vue-multiselect/dist/vue-multiselect.min.css";
    .select-result-content { padding: 0px; }
    .select-result__avatar { float: left; width: 60px; margin-right: 5px; }
    .select-result__avatar img { width: 100%; height: auto; border-radius: 2px; }
    .result-container { margin-left: 65px; }
    .select-result__nombre { color: black; font-weight: bold; word-wrap: break-word; line-height: 1; font-size: 16px}
    .select-result__nombre { margin-bottom: 2px;}
    .select-result__precio,.select-result__stock, .select-result__ubicacion  { margin-right: 1em; }
    .select-result__precio, .select-result__ubicacion, .select-result__stock, .select-result__codigo {
        font-weight: bold; margin-bottom: 0px; margin-top: 0px; display: inline-block; color: #4078FA; font-size: 22px; padding: 0px;
    }
    .select-result__contiene {
        color: #777;
        inline-size: 100%;
        overflow-x: visible;
        line-height: 1;
        font-size: 11px
    }
    .multiselect__option--highlight .select-result__nombre,
    .multiselect__option--highlight .select-result__precio,
    .multiselect__option--highlight .select-result__stock,
    .multiselect__option--highlight .select-result__codigo,
    .multiselect__option--highlight .select-result__ubicacion { color: #F2FC2A; }
    .multiselect__option--highlight .select-result__contiene {
        color: #c6dcef;
    }
    .multiselect__option {
        width: 100%;
    }
</style>
