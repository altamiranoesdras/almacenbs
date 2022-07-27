/**
 * Created by Usuario on 14/07/2018.
 */
Vue.filter('fecha-ltn', function (value) {
    if(!value){
        return null;
    }
    var f   = value.split('-');

    var dia = f[2];
    var mes = f[1];
    var anio = f[0];
    //
    return dia+'/'+mes+'/'+anio;
});
