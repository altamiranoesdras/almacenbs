<div class="form-row" id="camposTrasladoUnidades">

    <!-- Item Id Field -->
    <div class="form-group col-sm-10">
        {!! Form::label('item_origen', 'Artículo origen:') !!}
        <select-items
            api="{{route('api.items.index')}}"
            tienda="1"
            v-model="item_origen"
            ref="multiselect"
        >
        </select-items>
        <input type="hidden" name="item_origen" :value="getId(item_origen)">
        <span class="help-block" v-text="info"></span>
    </div>

    <div class="form-group col-sm-2">
        {!! Form::label('cantidad_origen', 'Cantidad: ') !!}
        <input type="number" step="any" class="form-control" name="cantidad_origen" v-model="candida_origen" @keyup="calculaCantidadDestino()" required>
        <input type="hidden" id="equivalencia" v-model="equivalencia" >
    </div>

    <!-- Item Id Field -->
    <div class="form-group col-sm-10">
        {!! Form::label('item_destino', 'Artículo destino:') !!}
        <select-items
            api="{{route('api.items.index')}}"
            tienda="1"
            v-model="item_destino"
            ref="multiselect"
        >
        </select-items>
        <input type="hidden" name="item_destino" :value="getId(item_destino)">
    </div>

    <div class="form-group col-sm-2">
        <label for="cantidad_destino">Cantidad:</label>
        <input type="number" step="any" class="form-control" name="cantidad_destino" v-model="cantidad_destino" required>
    </div>

</div>


@push('scripts')

    <script>

        new Vue({
            el: '#camposTrasladoUnidades',
            name: 'camposTrasladoUnidades',
            mounted() {
                logI('Instancia vue montada');
            },
            created() {
                logI('Instancia vue creada');
            },
            data: {
                item_origen: @json(\App\Models\Item::find(old('item_origen')) ?? null),
                candida_origen: @json(old('candida_origen')),

                item_destino: @json(\App\Models\Item::find(old('item_destino')) ?? null),
                cantidad_destino: @json(old('cantidad_destino')),

                equivalencia: 0,
                info: '',
            },
            methods: {
                getId(item){
                    if (item){
                        return item.id
                    }

                    return null;
                },
                calculaCantidadDestino(){
                    var cantidad = parseFloat(this.candida_origen);

                    cantidad = isNaN(cantidad) ? 0 : cantidad;

                    var equivalencia = parseFloat(this.equivalencia);
                    var total = cantidad* equivalencia;


                    logI(cantidad,equivalencia,total);
                    this.cantidad_destino= total;

                }
            },
            watch:{
                async item_origen (item){
                    this.info ='';


                    try {
                        let res = await axios.get(route('api.equivalencia.item',item.id));

                        logI(res.data.data);
                        this.info = res.data.message;
                        this.item_destino = res.data.data.item_destino
                        this.equivalencia = res.data.data.cantidad;

                    }catch (e) {
                        notifyErrorApi(e)
                        this.info = e.response.data.message;
                    }
                }
            }
        });


    </script>
@endpush
