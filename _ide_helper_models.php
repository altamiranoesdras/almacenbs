<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * Class Activo
 *
 * @property int $id
 * @property string|null $nombre
 * @property string $descripcion
 * @property string $codigo_inventario
 * @property string|null $folio
 * @property string|null $valor_actual
 * @property string|null $valor_adquisicion
 * @property string|null $valor_contabilizado
 * @property \Illuminate\Support\Carbon|null $fecha_registro
 * @property int $tipo_id
 * @property int $estado_id
 * @property int|null $renglon_id
 * @property int|null $detalle_1h_id
 * @property int|null $entidad
 * @property int|null $unidad_ejecutadora
 * @property int|null $tipo_inventario
 * @property string|null $codigo_sicoin
 * @property int|null $codigo_donacion
 * @property string|null $nit
 * @property string|null $numero_documento
 * @property \Illuminate\Support\Carbon|null $fecha_aprobado
 * @property \Illuminate\Support\Carbon|null $fecha_contabilizacion
 * @property string|null $cur
 * @property string|null $contabilizado
 * @property int|null $diferencia_act_adq
 * @property int|null $diferencia_act_cont
 * @property int|null $diferencia_adq_cont
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Compra1hDetalle|null $detalle1h
 * @property-read \App\Models\ActivoEstado $estado
 * @property-read mixed $img
 * @property-read mixed $thumb
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read int|null $items_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Renglon|null $renglon
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoSolicitudDetalle> $solicitudDetalles
 * @property-read int|null $solicitud_detalles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoTarjetaDetalle> $tarjetaDetalles
 * @property-read int|null $tarjeta_detalles_count
 * @property-read \App\Models\ActivoTipo $tipo
 * @method static \Database\Factories\ActivoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Activo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Activo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereCodigoDonacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereCodigoInventario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereCodigoSicoin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereContabilizado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereCur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereDetalle1hId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereDiferenciaActAdq($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereDiferenciaActCont($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereDiferenciaAdqCont($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereEntidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereFechaAprobado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereFechaContabilizacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereFechaRegistro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereFolio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereNit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereNumeroDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereRenglonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereTipoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereTipoInventario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereUnidadEjecutadora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereValorActual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereValorAdquisicion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereValorContabilizado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Activo withoutTrashed()
 * @mixin \Eloquent
 */
	class Activo extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * Class ActivoEstado
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoSolicitudDetalle> $activoSolicitudDetalles
 * @property-read int|null $activo_solicitud_detalles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Activo> $activos
 * @property-read int|null $activos_count
 * @method static \Database\Factories\ActivoEstadoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado withoutTrashed()
 * @mixin \Eloquent
 */
	class ActivoEstado extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ActivoSolicitud
 *
 * @property int $id
 * @property int|null $colaborador_origen
 * @property int|null $unidad_origen
 * @property int|null $colaborador_destino
 * @property int|null $unidad_destino
 * @property string|null $codigo
 * @property int|null $correlativo
 * @property int|null $usuario_autoriza
 * @property int|null $usuario_inventario
 * @property string|null $observaciones
 * @property int $estado_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\RrhhColaborador|null $colaboradorDestino
 * @property-read \App\Models\RrhhColaborador|null $colaboradorOrigen
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoSolicitudDetalle> $detalles
 * @property-read int|null $detalles_count
 * @property-read \App\Models\ActivoSolicitudEstado $estado
 * @property-read \App\Models\RrhhUnidad|null $unidadDestino
 * @property-read \App\Models\RrhhUnidad|null $unidadOrigen
 * @property-read \App\Models\User|null $usuarioAutoriza
 * @property-read \App\Models\User|null $usuarioInventario
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud delUsuarioCrea($user = null)
 * @method static \Database\Factories\ActivoSolicitudFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud temporal()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud whereColaboradorDestino($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud whereColaboradorOrigen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud whereCorrelativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud whereUnidadDestino($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud whereUnidadOrigen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud whereUsuarioAutoriza($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud whereUsuarioInventario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud withoutTrashed()
 * @mixin \Eloquent
 */
	class ActivoSolicitud extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ActivoSolicitudDetalle
 *
 * @property int $id
 * @property int $solicitud_id
 * @property int $activo_id
 * @property int $activo_tipo_id
 * @property int $solicitud_tipo_id
 * @property string|null $estado_del_bien
 * @property string|null $observaciones
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Activo $activo
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoTarjetaDetalle> $activoTarjetaDetalles
 * @property-read int|null $activo_tarjeta_detalles_count
 * @property-read \App\Models\ActivoTipo $activoTipo
 * @property-read \App\Models\ActivoSolicitud $solicitud
 * @property-read \App\Models\ActivoSolicitudTipo $solicitudTipo
 * @method static \Database\Factories\ActivoSolicitudDetalleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle whereActivoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle whereActivoTipoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle whereEstadoDelBien($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle whereSolicitudId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle whereSolicitudTipoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle withoutTrashed()
 * @mixin Model
 */
	class ActivoSolicitudDetalle extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ActivoSolicitudEstado
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoSolicitud> $activoSolicitudes
 * @property-read int|null $activo_solicitudes_count
 * @method static \Database\Factories\ActivoSolicitudEstadoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado withoutTrashed()
 * @mixin \Eloquent
 */
	class ActivoSolicitudEstado extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ActivoSolicitudTipo
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoSolicitudDetalle> $activoSolicitudDetalles
 * @property-read int|null $activo_solicitud_detalles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoSolicitud> $activoSolicitudes
 * @property-read int|null $activo_solicitudes_count
 * @method static \Database\Factories\ActivoSolicitudTipoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo withoutTrashed()
 * @mixin \Eloquent
 */
	class ActivoSolicitudTipo extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ActivoTarjeta
 *
 * @property int $id
 * @property int|null $colaborador_id
 * @property string|null $codigo
 * @property string|null $codigo_interno
 * @property int|null $correlativo
 * @property int|null $impreso
 * @property int $usuario_crea
 * @property int $estado_id
 * @property string|null $observaciones
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoTarjetaDetalle> $detalles
 * @property-read int|null $detalles_count
 * @property-read \App\Models\Colaborador|null $responsable
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoSolicitud> $solicitudes
 * @property-read int|null $solicitudes_count
 * @property-read \App\Models\User $usuarioCrea
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta delUsuarioCrea($user = null)
 * @method static \Database\Factories\ActivoTarjetaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta noTemporal()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta temporal()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereCodigoInterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereColaboradorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereCorrelativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereImpreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereUsuarioCrea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta withoutTrashed()
 * @mixin \Eloquent
 */
	class ActivoTarjeta extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ActivoTarjetaDetalle
 *
 * @property int $id
 * @property int $tarjeta_id
 * @property int $activo_id
 * @property string $tipo
 * @property int $cantidad
 * @property string|null $valor
 * @property \Illuminate\Support\Carbon $fecha_asigna
 * @property int|null $unidad_id
 * @property int|null $impreso
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Activo $activo
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoSolicitudDetalle> $activoSolicitudDetalles
 * @property-read int|null $activo_solicitud_detalles_count
 * @property-read mixed $valor_alza
 * @property-read mixed $valor_baja
 * @property-read \App\Models\ActivoTarjeta $tarjeta
 * @property-read \App\Models\RrhhUnidad|null $unidad
 * @method static \Database\Factories\ActivoTarjetaDetalleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereActivoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereFechaAsigna($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereImpreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereTarjetaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereUnidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereValor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle withoutTrashed()
 * @mixin \Eloquent
 */
	class ActivoTarjetaDetalle extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ActivoTarjetaEstado
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoTarjeta> $activoTarjetas
 * @property-read int|null $activo_tarjetas_count
 * @method static \Database\Factories\ActivoTarjetaEstadoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado withoutTrashed()
 * @mixin Model
 */
	class ActivoTarjetaEstado extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ActivoTipo
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Activo> $activos
 * @property-read int|null $activos_count
 * @property-read mixed $text_corto
 * @method static \Database\Factories\ActivoTipoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo withoutTrashed()
 * @mixin \Eloquent
 */
	class ActivoTipo extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Bitacora
 *
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property string|null $seccion
 * @property string $titulo
 * @property string $comentario
 * @property int $usuario_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $fecha_crea
 * @property-read Model|\Eloquent $model
 * @property-read \App\Models\User|null $usuario
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $usuariosNotificar
 * @property-read int|null $usuarios_notificar_count
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora whereComentario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora whereSeccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora whereTitulo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora whereUsuarioId($value)
 * @mixin \Eloquent
 */
	class Bitacora extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Bodega
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $direccion
 * @property string|null $telefono
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Stock> $stocks
 * @property-read int|null $stocks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\BodegaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega withoutTrashed()
 * @mixin \Eloquent
 */
	class Bodega extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Colaborador
 *
 * @property int $id
 * @property string $nombres
 * @property string $apellidos
 * @property string|null $dpi
 * @property string|null $correo
 * @property string|null $telefono
 * @property string|null $direccion
 * @property string|null $nit
 * @property int|null $puesto_id
 * @property int $unidad_id
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoTarjeta> $activoTarjetas
 * @property-read int|null $activo_tarjetas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RrhhContrato> $contratos
 * @property-read int|null $contratos_count
 * @property-read mixed $nombre_completo
 * @property-read mixed $text
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RrhhUnidad> $jefe
 * @property-read int|null $jefe_count
 * @property-read \App\Models\RrhhPuesto|null $puesto
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoSolicitud> $solicitudDestino
 * @property-read int|null $solicitud_destino_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoSolicitud> $solicitudOrigen
 * @property-read int|null $solicitud_origen_count
 * @property-read \App\Models\RrhhUnidad $unidad
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\ColaboradorFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador query()
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereApellidos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereDpi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereNit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereNombres($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador wherePuestoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereUnidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador withoutTrashed()
 * @mixin \Eloquent
 */
	class Colaborador extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Compra
 *
 * @property int $id
 * @property int|null $tipo_id
 * @property int|null $proveedor_id
 * @property string|null $codigo
 * @property int|null $correlativo
 * @property int|null $unidad_solicita_id
 * @property \Illuminate\Support\Carbon|null $fecha_documento Fecha del documento de  la Factura
 * @property \Illuminate\Support\Carbon|null $fecha_ingreso Fecha de ingreso al sistema
 * @property string|null $serie
 * @property string|null $numero
 * @property int $estado_id
 * @property int $usuario_crea
 * @property int|null $usuario_recibe
 * @property string|null $orden_compra
 * @property string $descuento
 * @property string|null $folio_almacen
 * @property string|null $folio_inventario
 * @property string|null $observaciones
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Compra1h|null $compra1h
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Compra1h> $compra1hs
 * @property-read int|null $compra1hs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraDetalle> $detalles
 * @property-read int|null $detalles_count
 * @property-read \App\Models\CompraEstado $estado
 * @property-read mixed $anio
 * @property-read mixed $mes
 * @property-read mixed $sub_total
 * @property-read mixed $total
 * @property-read mixed $total_venta
 * @property-read \App\Models\Proveedor|null $proveedor
 * @property-read \App\Models\CompraTipo|null $tipo
 * @property-read \App\Models\User $usuarioCrea
 * @property-read \App\Models\User|null $usuarioRecibe
 * @method static \Illuminate\Database\Eloquent\Builder|Compra delItem($item)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra delUser($user = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra delUsuarioCrea($user = null)
 * @method static \Database\Factories\CompraFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Compra newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra noAnuladas()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra noTemporal()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra query()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra temporal()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereCorrelativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereDescuento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereFechaDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereFechaIngreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereFolioAlmacen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereFolioInventario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereOrdenCompra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereProveedorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereSerie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereTipoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereUnidadSolicitaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereUsuarioCrea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereUsuarioRecibe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\RrhhUnidad|null $unidadSolicitante
 */
	class Compra extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Compra1h
 *
 * @property int $id
 * @property string|null $folio
 * @property int $compra_id
 * @property int $envio_fiscal_id
 * @property string|null $codigo
 * @property int|null $correlativo
 * @property int|null $del
 * @property int|null $al
 * @property \Illuminate\Support\Carbon|null $fecha_procesa
 * @property int $usuario_procesa
 * @property string|null $observaciones
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Compra $compra
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Compra1hDetalle> $detalles
 * @property-read int|null $detalles_count
 * @property-read \App\Models\EnvioFiscal $envioFiscal
 * @property-read mixed $sub_total
 * @property-read mixed $total
 * @property-read mixed $total_letras
 * @property-read \App\Models\User $usuarioProcesa
 * @method static \Database\Factories\Compra1hFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h query()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereAl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereCompraId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereCorrelativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereDel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereEnvioFiscalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereFechaProcesa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereFolio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereUsuarioProcesa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h withoutTrashed()
 * @mixin \Eloquent
 */
	class Compra1h extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Compra1hDetalle
 *
 * @property int $id
 * @property int $1h_id
 * @property int $item_id
 * @property string $precio
 * @property string $cantidad
 * @property int|null $folio_almacen
 * @property int|null $folio_inventario
 * @property string|null $codigo_inventario
 * @property string|null $texto_extra
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Compra1h $compra1h
 * @property-read mixed $sub_total
 * @property-read mixed $text
 * @property-read \App\Models\Item $item
 * @method static \Database\Factories\Compra1hDetalleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle where1hId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle whereCodigoInventario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle whereFolioAlmacen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle whereFolioInventario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle whereTextoExtra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle withoutTrashed()
 * @mixin \Eloquent
 */
	class Compra1hDetalle extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property int $rol_id
 * @property string $nombre
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraRequisicionEstado> $estados
 * @property-read int|null $estados_count
 * @property-read \App\Models\Role $rol
 * @method static \Database\Factories\CompraBandejaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja whereRolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja withoutTrashed()
 * @mixin \Eloquent
 */
	class CompraBandeja extends \Eloquent {}
}

namespace App\Models{
/**
 * Class CompraDetalle
 *
 * @property int $id
 * @property int $compra_id
 * @property int|null $unidad_solicita_id
 * @property int $item_id
 * @property string $cantidad
 * @property string $precio
 * @property string $descuento
 * @property \Illuminate\Support\Carbon|null $fecha_vence
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Compra $compra
 * @property-read mixed $codigo
 * @property-read mixed $responsable
 * @property-read mixed $sub_total
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\Kardex|null $kardex
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Stock> $stocks
 * @property-read int|null $stocks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockTransaccion> $transaccionesStock
 * @property-read int|null $transacciones_stock_count
 * @method static \Database\Factories\CompraDetalleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle whereCompraId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle whereDescuento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle whereFechaVence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle whereUnidadSolicitaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\RrhhUnidad|null $unidadSolicitante
 */
	class CompraDetalle extends \Eloquent {}
}

namespace App\Models{
/**
 * Class CompraEstado
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Compra> $compras
 * @property-read int|null $compras_count
 * @method static \Database\Factories\CompraEstadoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado withoutTrashed()
 * @mixin \Eloquent
 */
	class CompraEstado extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property int $gestion_id
 * @property int $proveedor_id
 * @property string $numero
 * @property \Illuminate\Support\Carbon $fecha
 * @property string $estado
 * @property string|null $observaciones
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraOrdenDetalle> $compraOrdenDetalles
 * @property-read int|null $compra_orden_detalles_count
 * @method static \Database\Factories\CompraOrdenFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden whereGestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden whereProveedorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden withoutTrashed()
 * @mixin \Eloquent
 */
	class CompraOrden extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property int $orden_id
 * @property int $item_id
 * @property string $cantidad
 * @property string $precio
 * @property string|null $observacion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Item $item
 * @method static \Database\Factories\CompraOrdenDetalleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle whereObservacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle whereOrdenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle withoutTrashed()
 * @mixin \Eloquent
 */
	class CompraOrdenDetalle extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraBandeja> $compraBandejas
 * @property-read int|null $compra_bandejas_count
 * @method static \Database\Factories\CompraRequicicionEstadoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado withoutTrashed()
 * @mixin \Eloquent
 */
	class CompraRequicicionEstado extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\CompraRequicicionTipoAdquisicionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionTipoAdquisicion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionTipoAdquisicion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionTipoAdquisicion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionTipoAdquisicion query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionTipoAdquisicion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionTipoAdquisicion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionTipoAdquisicion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionTipoAdquisicion whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionTipoAdquisicion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionTipoAdquisicion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionTipoAdquisicion withoutTrashed()
 * @mixin \Eloquent
 */
	class CompraRequicicionTipoAdquisicion extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property int $requisicion_id
 * @property int $solicitud_detalle_id
 * @property int $item_id
 * @property string $cantidad
 * @property string $precio_estimado
 * @property string|null $observaciones
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\CompraRequisicion\CompraRequisicion $requisicion
 * @property-read \App\Models\CompraSolicitudDetalle $solicitudDetalle
 * @method static \Database\Factories\CompraRequisicionDetalleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle wherePrecioEstimado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereRequisicionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereSolicitudDetalleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle withoutTrashed()
 * @mixin \Eloquent
 */
	class CompraRequisicionDetalle extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\CompraRequisicionTipoConcursoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso withoutTrashed()
 * @mixin \Eloquent
 */
	class CompraRequisicionTipoConcurso extends \Eloquent {}
}

namespace App\Models\CompraRequisicion{
/**
 *
 *
 * @property int $id
 * @property int|null $tipo_concurso_id
 * @property int|null $tipo_adquisicion_id
 * @property int|null $correlativo
 * @property string|null $codigo ID interno de gestión, p.ej. G-2025-001
 * @property string|null $codigo_consolidacion Código de lote interno, p.ej. L-2025-001
 * @property string|null $npg Número de Publicación (Compra Menor)
 * @property string|null $nog Número de Operación (Licitación Abreviada)
 * @property int $usuario_crea_id
 * @property int|null $usuario_aprueba_id
 * @property int|null $usuario_autoriza_id
 * @property int|null $usuario_asigna_id
 * @property int|null $usuario_analista_id
 * @property int $unidad_id
 * @property int|null $proveedor_adjudicado
 * @property string|null $numero_adjudicacion
 * @property int $estado_id
 * @property string|null $subproductos
 * @property string|null $partidas
 * @property string|null $observaciones
 * @property string|null $justificacion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, CompraSolicitud> $compraSolicitudes
 * @property-read int|null $compra_solicitudes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraRequisicionDetalle> $detalles
 * @property-read int|null $detalles_count
 * @property-read \App\Models\CompraRequisicionTipoConcurso|null $tipoConcurso
 * @method static \Database\Factories\CompraRequisicion\CompraRequisicionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereCodigoConsolidacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereCorrelativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereIpoAdquisicionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereJustificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereNog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereNpg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereNumeroAdjudicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion wherePartidas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereProveedorAdjudicado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereSubproductos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereTipoConcursoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereUnidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereUsuarioAnalistaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereUsuarioApruebaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereUsuarioAsignaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereUsuarioAutorizaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereUsuarioCreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion withoutTrashed()
 * @mixin \Eloquent
 */
	class CompraRequisicion extends \Eloquent {}
}

namespace App\Models\CompraRequisicion{
/**
 *
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraBandeja> $compraBandejas
 * @property-read int|null $compra_bandejas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraRequisicion\CompraRequisicion> $requisicion
 * @property-read int|null $requisicion_count
 * @method static \Database\Factories\CompraRequisicion\CompraRequisicionEstadoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado withoutTrashed()
 * @mixin \Eloquent
 */
	class CompraRequisicionEstado extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property int|null $bodega_id
 * @property int|null $unidad_id
 * @property int|null $correlativo
 * @property string|null $codigo
 * @property \Illuminate\Support\Carbon|null $fecha_solicita
 * @property string|null $justificacion
 * @property int $estado_id
 * @property int $usuario_solicita
 * @property int|null $usuario_verifica
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Bodega|null $bodega
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraRequisicion\CompraRequisicion> $compraRequisiciones
 * @property-read int|null $compra_requisiciones_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraSolicitudDetalle> $detalles
 * @property-read int|null $detalles_count
 * @property-read \App\Models\CompraSolicitudEstado $estado
 * @property-read mixed $sub_total
 * @property-read mixed $total
 * @property-read \App\Models\RrhhUnidad|null $unidad
 * @property-read \App\Models\User $usuarioSolicita
 * @property-read \App\Models\User|null $usuarioVerifica
 * @method static \Database\Factories\CompraSolicitudFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud noTemporal()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereBodegaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereCorrelativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereFechaSolicita($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereJustificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereUnidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereUsuarioSolicita($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereUsuarioVerifica($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud withoutTrashed()
 * @mixin \Eloquent
 */
	class CompraSolicitud extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property int $solicitud_id
 * @property int $item_id
 * @property int $cantidad
 * @property string $precio_estimado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraRequisicionDetalle> $compraRequisicionDetalles
 * @property-read int|null $compra_requisicion_detalles_count
 * @property-read mixed $sub_total
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\CompraSolicitud $solicitud
 * @method static \Database\Factories\CompraSolicitudDetalleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle wherePrecioEstimado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle whereSolicitudId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle withoutTrashed()
 * @mixin \Eloquent
 */
	class CompraSolicitudDetalle extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read string $color
 * @method static \Database\Factories\CompraSolicitudEstadoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado withoutTrashed()
 * @mixin \Eloquent
 */
	class CompraSolicitudEstado extends \Eloquent {}
}

namespace App\Models{
/**
 * Class CompraTipo
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Compra> $compras
 * @property-read int|null $compras_count
 * @method static \Database\Factories\CompraTipoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraTipo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraTipo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraTipo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraTipo query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraTipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraTipo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraTipo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraTipo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraTipo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraTipo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraTipo withoutTrashed()
 * @mixin \Eloquent
 */
	class CompraTipo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Configuration
 *
 * @property int $id
 * @property string $key
 * @property string $value
 * @property string $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration query()
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration withoutTrashed()
 * @mixin \Eloquent
 */
	class Configuration extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * Class Consumo
 *
 * @property int $id
 * @property int|null $correlativo
 * @property string|null $codigo
 * @property string|null $observaciones
 * @property string|null $fecha_procesa
 * @property int $estado_id
 * @property int|null $unidad_id
 * @property int|null $bodega_id
 * @property int $usuario_crea
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Bodega|null $bodega
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ConsumoDetalle> $detalles
 * @property-read int|null $detalles_count
 * @property-read \App\Models\ConsumoEstado $estado
 * @property-read \App\Models\RrhhUnidad|null $unidad
 * @property-read \App\Models\User $usuarioCrea
 * @method static Builder|Consumo delUsuarioCrea($user = null)
 * @method static \Database\Factories\ConsumoFactory factory($count = null, $state = [])
 * @method static Builder|Consumo newModelQuery()
 * @method static Builder|Consumo newQuery()
 * @method static Builder|Consumo noTemporal()
 * @method static Builder|Consumo onlyTrashed()
 * @method static Builder|Consumo query()
 * @method static Builder|Consumo temporal()
 * @method static Builder|Consumo whereBodegaId($value)
 * @method static Builder|Consumo whereCodigo($value)
 * @method static Builder|Consumo whereCorrelativo($value)
 * @method static Builder|Consumo whereCreatedAt($value)
 * @method static Builder|Consumo whereDeletedAt($value)
 * @method static Builder|Consumo whereEstadoId($value)
 * @method static Builder|Consumo whereFechaProcesa($value)
 * @method static Builder|Consumo whereId($value)
 * @method static Builder|Consumo whereObservaciones($value)
 * @method static Builder|Consumo whereUnidadId($value)
 * @method static Builder|Consumo whereUpdatedAt($value)
 * @method static Builder|Consumo whereUsuarioCrea($value)
 * @method static Builder|Consumo withTrashed()
 * @method static Builder|Consumo withoutTrashed()
 * @mixin Model
 */
	class Consumo extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ConsumoDetalle
 *
 * @property int $id
 * @property int $consumo_id
 * @property int $item_id
 * @property string $cantidad
 * @property string|null $precio
 * @property \Illuminate\Support\Carbon|null $fecha_vence
 * @property string|null $observaciones
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Consumo $consumo
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\Kardex|null $kardex
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockTransaccion> $transaccionesStock
 * @property-read int|null $transacciones_stock_count
 * @method static \Database\Factories\ConsumoDetalleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle whereConsumoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle whereFechaVence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle withoutTrashed()
 * @mixin Model
 */
	class ConsumoDetalle extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ConsumoEstado
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Consumo> $consumos
 * @property-read int|null $consumos_count
 * @method static \Database\Factories\ConsumoEstadoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado withoutTrashed()
 * @mixin Model
 */
	class ConsumoEstado extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Contrato
 *
 * @property int $id
 * @property int $colaborador_id
 * @property int $unidad_id
 * @property int|null $puesto_id
 * @property string $numero
 * @property \Illuminate\Support\Carbon $inicio
 * @property \Illuminate\Support\Carbon|null $fin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\RrhhColaborador $colaborador
 * @property-read \App\Models\RrhhPuesto|null $puesto
 * @property-read \App\Models\RrhhUnidad $unidad
 * @method static \Database\Factories\ContratoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereColaboradorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato wherePuestoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereUnidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato withoutTrashed()
 * @mixin Model
 */
	class Contrato extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property int|null $padre_id
 * @property string|null $nombre
 * @property string|null $codigo
 * @method static \Database\Factories\CostoCentroFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CostoCentro newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CostoCentro newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CostoCentro onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CostoCentro query()
 * @method static \Illuminate\Database\Eloquent\Builder|CostoCentro whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CostoCentro whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CostoCentro whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CostoCentro wherePadreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CostoCentro withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CostoCentro withoutTrashed()
 * @mixin \Eloquent
 */
	class CostoCentro extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Denominacion
 *
 * @property int $id
 * @property string $monto
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\DenominacionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion whereMonto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion withoutTrashed()
 * @mixin \Eloquent
 */
	class Denominacion extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Divisa
 *
 * @property int $id
 * @property string $simbolo
 * @property string|null $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\DivisaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa query()
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa whereSimbolo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa withoutTrashed()
 * @mixin \Eloquent
 */
	class Divisa extends \Eloquent {}
}

namespace App\Models{
/**
 * Class EnvioFiscal
 *
 * @property int $id
 * @property int $nuemero_constancia
 * @property string $serie_constancia
 * @property \Illuminate\Support\Carbon $fecha
 * @property string $numero_cuenta
 * @property string $forma
 * @property int $correlativo_del
 * @property int $correlativo_al
 * @property int $cantidad
 * @property int $pendientes
 * @property string $serie
 * @property string $numero
 * @property string $libro
 * @property int $folio
 * @property string $resolucion
 * @property string $numero_gestion
 * @property \Illuminate\Support\Carbon $fecha_gestion
 * @property string $correlativo
 * @property string|null $activo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Compra1h> $compra1hs
 * @property-read int|null $compra1hs_count
 * @method static \Database\Factories\EnvioFiscalFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal query()
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereActivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereCorrelativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereCorrelativoAl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereCorrelativoDel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereFechaGestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereFolio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereForma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereLibro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereNuemeroConstancia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereNumeroCuenta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereNumeroGestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal wherePendientes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereResolucion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereSerie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereSerieConstancia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal withoutTrashed()
 * @mixin \Eloquent
 */
	class EnvioFiscal extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Equivalencia
 *
 * @property int $id
 * @property int $item_origen
 * @property int $item_destino
 * @property string $cantidad
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Item $itemDestino
 * @property-read \App\Models\Item $itemOrigen
 * @method static \Database\Factories\EquivalenciaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia query()
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia whereItemDestino($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia whereItemOrigen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia withoutTrashed()
 * @mixin \Eloquent
 */
	class Equivalencia extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Item
 *
 * @property int $id
 * @property string|null $codigo
 * @property string|null $codigo_insumo
 * @property string|null $codigo_presentacion
 * @property string $nombre
 * @property string|null $descripcion
 * @property int $tipo_id
 * @property int $renglon_id
 * @property int|null $marca_id
 * @property int|null $modelo_id
 * @property int|null $unimed_id
 * @property int|null $presentacion_id
 * @property int|null $categoria_id
 * @property string|null $precio_venta
 * @property string $precio_compra
 * @property string $precio_promedio
 * @property string|null $stock_minimo
 * @property string|null $stock_maximo
 * @property string|null $ubicacion
 * @property int|null $inventariable
 * @property bool|null $perecedero
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\ItemCategoria|null $categoria
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ItemCategoria> $categorias
 * @property-read int|null $categorias_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Compra1hDetalle> $compra1hDetalles
 * @property-read int|null $compra1h_detalles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraDetalle> $compraDetalles
 * @property-read int|null $compra_detalles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraSolicitudDetalle> $compraSolicitudDetalles
 * @property-read int|null $compra_solicitud_detalles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Equivalencia> $equivalencia1s
 * @property-read int|null $equivalencia1s_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Equivalencia> $equivalencias
 * @property-read int|null $equivalencias_count
 * @property-read mixed $img
 * @property-read mixed $stock_bodega
 * @property-read void $stock_reservado
 * @property-read mixed $stock_total
 * @property-read mixed $text
 * @property-read mixed $texto_kardex
 * @property-read mixed $texto_libro_almacen
 * @property-read mixed $texto_principal
 * @property-read mixed $texto_requisicion
 * @property-read mixed $thumb
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ItemTraslado> $itemsTraslado3s
 * @property-read int|null $items_traslado3s_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ItemTraslado> $itemsTraslados
 * @property-read int|null $items_traslados_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Kardex> $kardexes
 * @property-read int|null $kardexes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Kardex> $kardexs
 * @property-read int|null $kardexs_count
 * @property-read \App\Models\Marca|null $marca
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\ItemPresentacion|null $presentacion
 * @property-read \App\Models\Renglon $renglon
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SolicitudDetalle> $solicitudDetalles
 * @property-read int|null $solicitud_detalles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockInicial> $stockIniciales
 * @property-read int|null $stock_iniciales_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Stock> $stocks
 * @property-read int|null $stocks_count
 * @property-read \App\Models\ItemTipo $tipo
 * @property-read \App\Models\Unimed|null $unimed
 * @method static Builder|Item conDetSolicitudesAprobadas()
 * @method static Builder|Item conIngresos()
 * @method static Builder|Item deCategoria($categoria)
 * @method static Builder|Item deMarca($marca)
 * @method static Builder|Item enSolicitudCompraActiva()
 * @method static \Database\Factories\ItemFactory factory($count = null, $state = [])
 * @method static Builder|Item newModelQuery()
 * @method static Builder|Item newQuery()
 * @method static Builder|Item onlyTrashed()
 * @method static Builder|Item query()
 * @method static Builder|Item tipoActivo()
 * @method static Builder|Item whereCategoriaId($value)
 * @method static Builder|Item whereCodigo($value)
 * @method static Builder|Item whereCodigoInsumo($value)
 * @method static Builder|Item whereCodigoPresentacion($value)
 * @method static Builder|Item whereCreatedAt($value)
 * @method static Builder|Item whereDeletedAt($value)
 * @method static Builder|Item whereDescripcion($value)
 * @method static Builder|Item whereId($value)
 * @method static Builder|Item whereInventariable($value)
 * @method static Builder|Item whereMarcaId($value)
 * @method static Builder|Item whereModeloId($value)
 * @method static Builder|Item whereNombre($value)
 * @method static Builder|Item wherePerecedero($value)
 * @method static Builder|Item wherePrecioCompra($value)
 * @method static Builder|Item wherePrecioPromedio($value)
 * @method static Builder|Item wherePrecioVenta($value)
 * @method static Builder|Item wherePresentacionId($value)
 * @method static Builder|Item whereRenglonId($value)
 * @method static Builder|Item whereStockMaximo($value)
 * @method static Builder|Item whereStockMinimo($value)
 * @method static Builder|Item whereTipoId($value)
 * @method static Builder|Item whereUbicacion($value)
 * @method static Builder|Item whereUnimedId($value)
 * @method static Builder|Item whereUpdatedAt($value)
 * @method static Builder|Item withTrashed()
 * @method static Builder|Item withoutAppends()
 * @method static Builder|Item withoutTrashed()
 * @mixin \Eloquent
 */
	class Item extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * Class ItemCategoria
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $item1s
 * @property-read int|null $item1s_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read int|null $items_count
 * @method static \Database\Factories\ItemCategoriaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria withoutTrashed()
 * @mixin \Eloquent
 */
	class ItemCategoria extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ItemModelo
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read int|null $items_count
 * @method static \Database\Factories\ItemModeloFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo withoutTrashed()
 * @mixin Model
 */
	class ItemModelo extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ItemPresentacion
 *
 * @property int $id
 * @property string|null $codigo
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read int|null $items_count
 * @method static \Database\Factories\ItemPresentacionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion withoutTrashed()
 * @mixin Model
 */
	class ItemPresentacion extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ItemTipo
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read int|null $items_count
 * @method static \Database\Factories\ItemTipoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo withoutTrashed()
 * @mixin \Eloquent
 */
	class ItemTipo extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ItemTraslado
 *
 * @property int $id
 * @property string $codigo
 * @property int $correlativo
 * @property int $item_origen
 * @property string|null $cantidad_origen
 * @property int $item_destino
 * @property string|null $cantidad_destino
 * @property string|null $observaciones
 * @property int $user_id
 * @property int $estado_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\ItemTrasladoEstado $estado
 * @property-read \App\Models\Item $itemDestino
 * @property-read \App\Models\Item $itemOrigen
 * @property-read \App\Models\Kardex|null $kardex
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockTransaccion> $transaccionesStock
 * @property-read int|null $transacciones_stock_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ItemTrasladoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereCantidadDestino($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereCantidadOrigen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereCorrelativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereItemDestino($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereItemOrigen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado withoutTrashed()
 * @mixin \Eloquent
 */
	class ItemTraslado extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ItemTrasladoEstado
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ItemTraslado> $itemsTraslados
 * @property-read int|null $items_traslados_count
 * @method static \Database\Factories\ItemTrasladoEstadoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado withoutTrashed()
 * @mixin \Eloquent
 */
	class ItemTrasladoEstado extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Kardex
 *
 * @property int $id
 * @property int $item_id
 * @property int $model_id
 * @property string $model_type
 * @property int|null $folio
 * @property string|null $al
 * @property string|null $del
 * @property string|null $codigo_insumo
 * @property string $cantidad
 * @property string|null $saldo
 * @property string|null $precio_existencia Precio unitario del las existencias
 * @property string|null $precio_movimiento Precio unitario del ingreso o egreso
 * @property string $tipo
 * @property string|null $codigo
 * @property string|null $responsable
 * @property string|null $observacion
 * @property bool|null $impreso
 * @property string|null $folio_siguiente
 * @property int $usuario_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Bitacora> $bitacoras
 * @property-read int|null $bitacoras_count
 * @property-read mixed $concepto
 * @property-read mixed $fecha_ordena
 * @property-read mixed $fecha_ordena_timestamp
 * @property-read mixed $ingreso
 * @property-read mixed $precio
 * @property-read mixed $saldo_stock
 * @property-read mixed $salida
 * @property-read mixed $sub_total
 * @property-read mixed $sub_total_saldo
 * @property-read \App\Models\Item $item
 * @property-read Model|\Eloquent $model
 * @property-read \App\Models\User $usuario
 * @method static Builder|Kardex delItem($item)
 * @method static Builder|Kardex inventariable()
 * @method static Builder|Kardex newModelQuery()
 * @method static Builder|Kardex newQuery()
 * @method static Builder|Kardex onlyTrashed()
 * @method static Builder|Kardex query()
 * @method static Builder|Kardex whereAl($value)
 * @method static Builder|Kardex whereCantidad($value)
 * @method static Builder|Kardex whereCodigo($value)
 * @method static Builder|Kardex whereCodigoInsumo($value)
 * @method static Builder|Kardex whereCreatedAt($value)
 * @method static Builder|Kardex whereDel($value)
 * @method static Builder|Kardex whereDeletedAt($value)
 * @method static Builder|Kardex whereFolio($value)
 * @method static Builder|Kardex whereFolioSiguiente($value)
 * @method static Builder|Kardex whereId($value)
 * @method static Builder|Kardex whereImpreso($value)
 * @method static Builder|Kardex whereItemId($value)
 * @method static Builder|Kardex whereModelId($value)
 * @method static Builder|Kardex whereModelType($value)
 * @method static Builder|Kardex whereObservacion($value)
 * @method static Builder|Kardex wherePrecioExistencia($value)
 * @method static Builder|Kardex wherePrecioMovimiento($value)
 * @method static Builder|Kardex whereResponsable($value)
 * @method static Builder|Kardex whereSaldo($value)
 * @method static Builder|Kardex whereTipo($value)
 * @method static Builder|Kardex whereUpdatedAt($value)
 * @method static Builder|Kardex whereUsuarioId($value)
 * @method static Builder|Kardex withTrashed()
 * @method static Builder|Kardex withoutTrashed()
 * @mixin \Eloquent
 */
	class Kardex extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Magnitud
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Unimed> $unimeds
 * @property-read int|null $unimeds_count
 * @method static \Database\Factories\MagnitudFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud query()
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud withoutTrashed()
 * @mixin \Eloquent
 */
	class Magnitud extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Marca
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read int|null $items_count
 * @method static \Database\Factories\MarcaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Marca newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Marca newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Marca onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Marca query()
 * @method static \Illuminate\Database\Eloquent\Builder|Marca whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marca whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marca whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marca whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marca whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marca withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Marca withoutTrashed()
 * @mixin \Eloquent
 */
	class Marca extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Media
 *
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property string|null $uuid
 * @property string $collection_name
 * @property string $name
 * @property string $file_name
 * @property string|null $mime_type
 * @property string $disk
 * @property string|null $conversions_disk
 * @property int $size
 * @property array $manipulations
 * @property array $custom_properties
 * @property array $generated_conversions
 * @property array $responsive_images
 * @property int|null $order_column
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $extension
 * @property-read mixed $human_readable_size
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $model
 * @property-read mixed $original_url
 * @property-read mixed $preview_url
 * @property-read mixed $type
 * @method static \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, static> all($columns = ['*'])
 * @method static \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, static> get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media newQuery()
 * @method static Builder|Media ordered()
 * @method static \Illuminate\Database\Eloquent\Builder|Media query()
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCollectionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereConversionsDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCustomProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereGeneratedConversions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereManipulations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereResponsiveImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUuid($value)
 * @mixin \Eloquent
 */
	class Media extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Option
 *
 * @property int $id
 * @property int|null $option_id opcion padre
 * @property string $nombre
 * @property string|null $ruta
 * @property string|null $descripcion
 * @property string $icono_l
 * @property string|null $icono_r
 * @property int|null $orden
 * @property string|null $color
 * @property int $recursos
 * @property bool $dev
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Option> $children
 * @property-read int|null $children_count
 * @property-read mixed $active
 * @property-read mixed $ruta_evaluada
 * @property-read mixed $text
 * @property-read mixed $visible_to_user
 * @property-read Option|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Option newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Option newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Option onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Option padres()
 * @method static \Illuminate\Database\Eloquent\Builder|Option padresDe($chidres)
 * @method static \Illuminate\Database\Eloquent\Builder|Option query()
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereDev($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereIconoL($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereIconoR($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereOrden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereRecursos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereRuta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Option withoutTrashed()
 * @mixin \Eloquent
 */
	class Option extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Permission
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission withoutRole($roles, $guard = null)
 * @mixin \Eloquent
 */
	class Permission extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Proveedor
 *
 * @property int $id
 * @property string|null $nit
 * @property string $nombre
 * @property string|null $razon_social
 * @property string|null $correo
 * @property string|null $telefono_movil
 * @property string|null $telefono_oficina
 * @property string|null $direccion
 * @property string|null $observaciones
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Compra> $compras
 * @property-read int|null $compras_count
 * @method static \Database\Factories\ProveedorFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereNit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereRazonSocial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereTelefonoMovil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereTelefonoOficina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor withoutTrashed()
 * @mixin \Eloquent
 */
	class Proveedor extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Renglon
 *
 * @property int $id
 * @property string $numero
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $text
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read int|null $items_count
 * @method static \Database\Factories\RenglonFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon withoutTrashed()
 * @mixin \Eloquent
 */
	class Renglon extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Role
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Option> $options
 * @property-read int|null $options_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role withoutPermission($permissions)
 * @mixin \Eloquent
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * Class RrhhColaborador
 *
 * @property int $id
 * @property string $nombres
 * @property string $apellidos
 * @property string|null $dpi
 * @property string|null $correo
 * @property string|null $telefono
 * @property string|null $direccion
 * @property string|null $nit
 * @property int|null $puesto_id
 * @property int $unidad_id
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoSolicitud> $activoSolicitude1s
 * @property-read int|null $activo_solicitude1s_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoSolicitud> $activoSolicitudes
 * @property-read int|null $activo_solicitudes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoTarjeta> $activoTarjetas
 * @property-read int|null $activo_tarjetas_count
 * @property-read mixed $nombre_completo
 * @property-read mixed $text
 * @property-read \App\Models\RrhhPuesto|null $puesto
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RrhhContrato> $rrhhContratos
 * @property-read int|null $rrhh_contratos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RrhhUnidad> $rrhhUnidade2s
 * @property-read int|null $rrhh_unidade2s_count
 * @property-read \App\Models\RrhhUnidad $unidad
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador query()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereApellidos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereDpi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereNit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereNombres($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador wherePuestoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereUnidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador withoutTrashed()
 * @mixin Model
 */
	class RrhhColaborador extends \Eloquent {}
}

namespace App\Models{
/**
 * Class RrhhContrato
 *
 * @property int $id
 * @property int $colaborador_id
 * @property int $unidad_id
 * @property int|null $puesto_id
 * @property string $numero
 * @property \Illuminate\Support\Carbon $inicio
 * @property \Illuminate\Support\Carbon|null $fin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\RrhhColaborador $colaborador
 * @property-read \App\Models\RrhhPuesto|null $puesto
 * @property-read \App\Models\RrhhUnidad $unidad
 * @method static \Database\Factories\RrhhContratoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato query()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato whereColaboradorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato whereFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato whereInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato wherePuestoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato whereUnidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato withoutTrashed()
 * @mixin Model
 */
	class RrhhContrato extends \Eloquent {}
}

namespace App\Models{
/**
 * Class RrhhPuesto
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $atribuciones
 * @property string|null $activo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\RrhhPuestoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto query()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereActivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereAtribuciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto withoutTrashed()
 * @mixin \Eloquent
 */
	class RrhhPuesto extends \Eloquent {}
}

namespace App\Models{
/**
 * Class RrhhUnidad
 *
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property int|null $centro_id
 * @property int $unidad_tipo_id
 * @property int|null $unidad_padre_id
 * @property int|null $jefe_id
 * @property string $activa
 * @property string $solicita
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, RrhhUnidad> $children
 * @property-read int|null $children_count
 * @property-read string $text
 * @property-read \App\Models\User|null $jefe
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RrhhPuesto> $puestos
 * @property-read int|null $puestos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Solicitud> $solicitudes
 * @property-read int|null $solicitudes_count
 * @property-read \App\Models\RrhhUnidadTipo $tipo
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $usuarios
 * @property-read int|null $usuarios_count
 * @method static \Database\Factories\RrhhUnidadFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad padres()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad query()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereActiva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereCentroId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereJefeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereSolicita($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereUnidadPadreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereUnidadTipoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad withoutTrashed()
 * @mixin \Eloquent
 */
	class RrhhUnidad extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property string $nombre
 * @property bool|null $nivel
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\RrhhUnidadTipoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo query()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo whereNivel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo withoutTrashed()
 * @mixin \Eloquent
 */
	class RrhhUnidadTipo extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Solicitud
 *
 * @property int $id
 * @property string|null $codigo
 * @property int|null $correlativo
 * @property string|null $justificacion
 * @property string|null $observaciones
 * @property int|null $unidad_id
 * @property int|null $bodega_id
 * @property int $usuario_crea
 * @property int|null $usuario_solicita
 * @property int|null $usuario_autoriza
 * @property int|null $usuario_aprueba
 * @property int|null $usuario_despacha
 * @property string|null $firma_requiere
 * @property string|null $firma_autoriza
 * @property string|null $firma_aprueba
 * @property string|null $firma_almacen
 * @property \Illuminate\Support\Carbon|null $fecha_solicita
 * @property \Illuminate\Support\Carbon|null $fecha_autoriza
 * @property \Illuminate\Support\Carbon|null $fecha_aprueba
 * @property \Illuminate\Support\Carbon|null $fecha_almacen_firma
 * @property \Illuminate\Support\Carbon|null $fecha_informa
 * @property \Illuminate\Support\Carbon|null $fecha_despacha
 * @property int $estado_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read Collection<int, \App\Models\Bitacora> $bitacoras
 * @property-read int|null $bitacoras_count
 * @property-read \App\Models\Bodega|null $bodega
 * @property-read Collection<int, \App\Models\SolicitudDetalle> $detalles
 * @property-read int|null $detalles_count
 * @property-read \App\Models\SolicitudEstado $estado
 * @property-read mixed $motivo_retorna
 * @property-read \App\Models\RrhhUnidad|null $unidad
 * @property-read \App\Models\User|null $usuarioAprueba
 * @property-read \App\Models\User|null $usuarioAutoriza
 * @property-read \App\Models\User $usuarioCrea
 * @property-read \App\Models\User|null $usuarioDespacha
 * @property-read \App\Models\User|null $usuarioSolicita
 * @method static Builder|Solicitud aprobadas()
 * @method static Builder|Solicitud autorizadas()
 * @method static Builder|Solicitud deUnidad($unidad = null)
 * @method static Builder|Solicitud delUsuarioCrea($user = null)
 * @method static \Database\Factories\SolicitudFactory factory($count = null, $state = [])
 * @method static Builder|Solicitud newModelQuery()
 * @method static Builder|Solicitud newQuery()
 * @method static Builder|Solicitud onlyTrashed()
 * @method static Builder|Solicitud query()
 * @method static Builder|Solicitud solicitadas()
 * @method static Builder|Solicitud temporal()
 * @method static Builder|Solicitud whereBodegaId($value)
 * @method static Builder|Solicitud whereCodigo($value)
 * @method static Builder|Solicitud whereCorrelativo($value)
 * @method static Builder|Solicitud whereCreatedAt($value)
 * @method static Builder|Solicitud whereDeletedAt($value)
 * @method static Builder|Solicitud whereEstadoId($value)
 * @method static Builder|Solicitud whereFechaAlmacenFirma($value)
 * @method static Builder|Solicitud whereFechaAprueba($value)
 * @method static Builder|Solicitud whereFechaAutoriza($value)
 * @method static Builder|Solicitud whereFechaDespacha($value)
 * @method static Builder|Solicitud whereFechaInforma($value)
 * @method static Builder|Solicitud whereFechaSolicita($value)
 * @method static Builder|Solicitud whereFirmaAlmacen($value)
 * @method static Builder|Solicitud whereFirmaAprueba($value)
 * @method static Builder|Solicitud whereFirmaAutoriza($value)
 * @method static Builder|Solicitud whereFirmaRequiere($value)
 * @method static Builder|Solicitud whereId($value)
 * @method static Builder|Solicitud whereJustificacion($value)
 * @method static Builder|Solicitud whereObservaciones($value)
 * @method static Builder|Solicitud whereUnidadId($value)
 * @method static Builder|Solicitud whereUpdatedAt($value)
 * @method static Builder|Solicitud whereUsuarioAprueba($value)
 * @method static Builder|Solicitud whereUsuarioAutoriza($value)
 * @method static Builder|Solicitud whereUsuarioCrea($value)
 * @method static Builder|Solicitud whereUsuarioDespacha($value)
 * @method static Builder|Solicitud whereUsuarioSolicita($value)
 * @method static Builder|Solicitud withTrashed()
 * @method static Builder|Solicitud withoutTrashed()
 * @mixin \Eloquent
 */
	class Solicitud extends \Eloquent {}
}

namespace App\Models{
/**
 * Class SolicitudDetalle
 *
 * @property int $id
 * @property int $solicitud_id
 * @property int $item_id
 * @property string $cantidad_solicitada
 * @property string $cantidad_aprobada
 * @property string $cantidad_despachada
 * @property string|null $precio
 * @property string|null $fecha_vence
 * @property string|null $observaciones
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\Kardex|null $kardex
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Kardex> $kardexs
 * @property-read int|null $kardexs_count
 * @property-read \App\Models\Solicitud $solicitud
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockTransaccion> $transaccionesStock
 * @property-read int|null $transacciones_stock_count
 * @method static \Database\Factories\SolicitudDetalleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereCantidadAprobada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereCantidadDespachada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereCantidadSolicitada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereFechaVence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereSolicitudId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle withoutTrashed()
 * @mixin \Eloquent
 */
	class SolicitudDetalle extends \Eloquent {}
}

namespace App\Models{
/**
 * Class SolicitudEstado
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $color
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Solicitud> $solicitudes
 * @property-read int|null $solicitudes_count
 * @method static \Database\Factories\SolicitudEstadoFactory factory($count = null, $state = [])
 * @method static Builder|SolicitudEstado newModelQuery()
 * @method static Builder|SolicitudEstado newQuery()
 * @method static Builder|SolicitudEstado onlyTrashed()
 * @method static Builder|SolicitudEstado principales()
 * @method static Builder|SolicitudEstado query()
 * @method static Builder|SolicitudEstado whereCreatedAt($value)
 * @method static Builder|SolicitudEstado whereDeletedAt($value)
 * @method static Builder|SolicitudEstado whereId($value)
 * @method static Builder|SolicitudEstado whereNombre($value)
 * @method static Builder|SolicitudEstado whereUpdatedAt($value)
 * @method static Builder|SolicitudEstado withTrashed()
 * @method static Builder|SolicitudEstado withoutTrashed()
 * @mixin \Eloquent
 */
	class SolicitudEstado extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Stock
 *
 * @property int $id
 * @property int $item_id
 * @property int|null $bodega_id
 * @property string|null $lote
 * @property \Illuminate\Support\Carbon $fecha_ing
 * @property \Illuminate\Support\Carbon|null $fecha_vence
 * @property string $precio_compra
 * @property string $cantidad
 * @property string $cantidad_inicial
 * @property bool $orden_salida
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Bodega|null $bodega
 * @property-read mixed $codigo
 * @property-read mixed $responsable
 * @property-read mixed $sub_total
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\Kardex|null $kardex
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockTransaccion> $transaccion
 * @property-read int|null $transaccion_count
 * @method static \Illuminate\Database\Eloquent\Builder|Stock conIngresos()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock conStock()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock deBodega($bodega = null)
 * @method static \Database\Factories\StockFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock quedanMeses($meses)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock query()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock vencidos()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereBodegaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereCantidadInicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereFechaIng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereFechaVence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereOrdenSalida($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock wherePrecioCompra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock withoutTrashed()
 * @mixin \Eloquent
 */
	class Stock extends \Eloquent {}
}

namespace App\Models{
/**
 * Class StockInicial
 *
 * @property int $id
 * @property int $item_id
 * @property string $cantidad
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\StockInicialFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial query()
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial withoutTrashed()
 * @mixin \Eloquent
 */
	class StockInicial extends \Eloquent {}
}

namespace App\Models{
/**
 * Class StockTransaccion
 *
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property int $stock_id
 * @property string $tipo
 * @property string $cantidad
 * @property string $precio_costo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Stock $stock
 * @method static \Database\Factories\StockTransaccionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion query()
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion wherePrecioCosto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion whereStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class StockTransaccion extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Unimed
 *
 * @property int $id
 * @property int $magnitud_id
 * @property string $simbolo
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read int|null $items_count
 * @property-read \App\Models\Magnitud $magnitud
 * @method static \Database\Factories\UnimedFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed query()
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed whereMagnitudId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed whereSimbolo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed withoutTrashed()
 * @mixin \Eloquent
 */
	class Unimed extends \Eloquent {}
}

namespace App\Models{
/**
 * Class User
 *
 * @property int $id
 * @property string|null $username
 * @property string $name
 * @property int|null $dpi
 * @property string|null $nit
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property int|null $bodega_id
 * @property int|null $unidad_id
 * @property int|null $puesto_id
 * @property string|null $provider
 * @property string|null $provider_uid
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Bodega|null $bodega
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Compra1h> $compra1hs
 * @property-read int|null $compra1hs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Compra> $compras
 * @property-read int|null $compras_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Compra> $comprasRecibe
 * @property-read int|null $compras_recibe_count
 * @property-read mixed $img
 * @property-read mixed $miniatura
 * @property-read mixed $rubrica
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ItemTraslado> $itemsTraslados
 * @property-read int|null $items_traslados_count
 * @property-read \App\Models\RrhhUnidad|null $jefeUnidad
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Kardex> $kardexs
 * @property-read int|null $kardexs_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Option> $options
 * @property-read int|null $options_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \App\Models\RrhhPuesto|null $puesto
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Option> $shortcuts
 * @property-read int|null $shortcuts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Solicitud> $solicitudes
 * @property-read int|null $solicitudes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Solicitud> $solicitudesAprueba
 * @property-read int|null $solicitudes_aprueba_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Solicitud> $solicitudesAutoriza
 * @property-read int|null $solicitudes_autoriza_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Solicitud> $solicitudesCrea
 * @property-read int|null $solicitudes_crea_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Solicitud> $solicitudesDespacha
 * @property-read int|null $solicitudes_despacha_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockInicial> $stockIniciales
 * @property-read int|null $stock_iniciales_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \App\Models\RrhhUnidad|null $unidad
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $usersDespacha
 * @property-read int|null $users_despacha_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $usersSolicita
 * @property-read int|null $users_solicita_count
 * @method static \Illuminate\Database\Eloquent\Builder|User admins()
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User jefes()
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User noClientes()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBodegaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDpi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProviderUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePuestoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUnidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutRole($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 * @mixin \Eloquent
 */
	class User extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property string $key
 * @property string $value
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration withoutTrashed()
 * @mixin \Eloquent
 */
	class UserConfiguration extends \Eloquent {}
}

namespace App\Models{
/**
 * Class UserDespachaUser
 *
 * @property int $user_sol
 * @property int $user_des
 * @property-read \App\Models\User $userDes
 * @property-read \App\Models\User $userSol
 * @method static \Database\Factories\UserDespachaUserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UserDespachaUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDespachaUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDespachaUser onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDespachaUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDespachaUser whereUserDes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDespachaUser whereUserSol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDespachaUser withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDespachaUser withoutTrashed()
 * @mixin \Eloquent
 */
	class UserDespachaUser extends \Eloquent {}
}

