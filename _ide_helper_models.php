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
 * @package App\Models
 * @version November 11, 2022, 11:13 am CST
 * @property \App\Models\Renglone $renglon
 * @property \App\Models\ActivoEstado $estado
 * @property \App\Models\Compra1hDetalle $detalle1h
 * @property \App\Models\ActivoTipo $tipo
 * @property \Illuminate\Database\Eloquent\Collection $items
 * @property \Illuminate\Database\Eloquent\Collection $solicitudDetalles
 * @property \Illuminate\Database\Eloquent\Collection $tarjetaDetalles
 * @property string $nombre
 * @property string $descripcion
 * @property string $codigo_inventario
 * @property string $folio
 * @property number $valor_actual
 * @property number $valor_adquisicion
 * @property number $valor_contabilizado
 * @property string $fecha_registro
 * @property integer $tipo_id
 * @property integer $estado_id
 * @property integer $renglon_id
 * @property integer $detalle_1h_id
 * @property integer $entidad
 * @property integer $unidad_ejecutadora
 * @property integer $tipo_inventario
 * @property string $codigo_sicoin
 * @property integer $codigo_donacion
 * @property string $nit
 * @property string $numero_documento
 * @property string $fecha_aprobado
 * @property string $fecha_contabilizacion
 * @property string $cur
 * @property string $contabilizado
 * @property integer $diferencia_act_adq
 * @property integer $diferencia_act_cont
 * @property integer $diferencia_adq_cont
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $img
 * @property-read mixed $thumb
 * @property-read int|null $items_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\App\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read int|null $solicitud_detalles_count
 * @property-read int|null $tarjeta_detalles_count
 * @method static \Database\Factories\ActivoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activo newQuery()
 * @method static \Illuminate\Database\Query\Builder|Activo onlyTrashed()
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
 * @method static \Illuminate\Database\Query\Builder|Activo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Activo withoutTrashed()
 * @mixin \Eloquent
 */
	class Activo extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * Class ActivoEstado
 *
 * @package App\Models
 * @version August 31, 2022, 10:51 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $activoSolicitudDetalles
 * @property \Illuminate\Database\Eloquent\Collection $activos
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $activo_solicitud_detalles_count
 * @property-read int|null $activos_count
 * @method static \Database\Factories\ActivoEstadoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado newQuery()
 * @method static \Illuminate\Database\Query\Builder|ActivoEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ActivoEstado withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ActivoEstado withoutTrashed()
 * @mixin \Eloquent
 */
	class ActivoEstado extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ActivoSolicitud
 *
 * @package App\Models
 * @version November 12, 2022, 10:29 am CST
 * @property \App\Models\RrhhUnidad $unidadOrigen
 * @property \App\Models\User $usuarioAutoriza
 * @property \App\Models\ActivoSolicitudEstado $estado
 * @property \App\Models\RrhhColaborador $colaboradorDestino
 * @property \App\Models\RrhhUnidad $unidadDestino
 * @property \App\Models\User $usuarioInventario
 * @property \App\Models\RrhhColaborador $colaboradorOrigen
 * @property \Illuminate\Database\Eloquent\Collection $detalles
 * @property integer $colaborador_origen
 * @property integer $unidad_origen
 * @property integer $colaborador_destino
 * @property integer $unidad_destino
 * @property string $codigo
 * @property integer $correlativo
 * @property integer $usuario_autoriza
 * @property integer $usuario_inventario
 * @property string $observaciones
 * @property integer $estado_id
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $detalles_count
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud delUsuarioCrea($user = null)
 * @method static \Database\Factories\ActivoSolicitudFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitud newQuery()
 * @method static \Illuminate\Database\Query\Builder|ActivoSolicitud onlyTrashed()
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
 * @method static \Illuminate\Database\Query\Builder|ActivoSolicitud withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ActivoSolicitud withoutTrashed()
 * @mixin \Eloquent
 */
	class ActivoSolicitud extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ActivoSolicitudDetalle
 *
 * @package App\Models
 * @version November 11, 2022, 2:58 pm CST
 * @property \App\Models\Activo $activo
 * @property \App\Models\ActivoSolicitudTipo $solicitudTipo
 * @property \App\Models\ActivoTipo $activoTipo
 * @property \App\Models\ActivoSolicitud $solicitud
 * @property \Illuminate\Database\Eloquent\Collection $activoTarjetaDetalles
 * @property integer $solicitud_id
 * @property integer $activo_id
 * @property integer $activo_tipo_id
 * @property integer $solicitud_tipo_id
 * @property string $estado_del_bien
 * @property string $observaciones
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $activo_tarjeta_detalles_count
 * @method static \Database\Factories\ActivoSolicitudDetalleFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle newQuery()
 * @method static \Illuminate\Database\Query\Builder|ActivoSolicitudDetalle onlyTrashed()
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
 * @method static \Illuminate\Database\Query\Builder|ActivoSolicitudDetalle withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ActivoSolicitudDetalle withoutTrashed()
 * @mixin Model
 */
	class ActivoSolicitudDetalle extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ActivoSolicitudEstado
 *
 * @package App\Models
 * @version August 31, 2022, 10:52 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $activoSolicitudes
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\ActivoSolicitudEstadoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado newQuery()
 * @method static \Illuminate\Database\Query\Builder|ActivoSolicitudEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ActivoSolicitudEstado withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ActivoSolicitudEstado withoutTrashed()
 * @property-read int|null $activo_solicitudes_count
 * @mixin \Eloquent
 */
	class ActivoSolicitudEstado extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ActivoSolicitudTipo
 *
 * @package App\Models
 * @version August 31, 2022, 10:52 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $activoSolicitudDetalles
 * @property \Illuminate\Database\Eloquent\Collection $activoSolicitudes
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $activo_solicitud_detalles_count
 * @method static \Database\Factories\ActivoSolicitudTipoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo newQuery()
 * @method static \Illuminate\Database\Query\Builder|ActivoSolicitudTipo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ActivoSolicitudTipo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ActivoSolicitudTipo withoutTrashed()
 * @property-read int|null $activo_solicitudes_count
 * @mixin \Eloquent
 */
	class ActivoSolicitudTipo extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ActivoTarjeta
 *
 * @package App\Models
 * @version August 31, 2022, 10:51 pm CST
 * @property \App\Models\User $responsable
 * @property \Illuminate\Database\Eloquent\Collection $solicitudes
 * @property \Illuminate\Database\Eloquent\Collection $detalles
 * @property integer $colaborador_id
 * @property string $codigo
 * @property string $codigo_interno
 * @property integer $correlativo
 * @property boolean $impreso
 * @property int $id
 * @property int $usuario_crea
 * @property int $estado_id
 * @property string|null $observaciones
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $detalles_count
 * @property-read \App\Models\User $usuarioCrea
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta delUsuarioCrea($user = null)
 * @method static \Database\Factories\ActivoTarjetaFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta noTemporal()
 * @method static \Illuminate\Database\Query\Builder|ActivoTarjeta onlyTrashed()
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
 * @method static \Illuminate\Database\Query\Builder|ActivoTarjeta withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ActivoTarjeta withoutTrashed()
 * @property-read int|null $solicitudes_count
 * @mixin \Eloquent
 */
	class ActivoTarjeta extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ActivoTarjetaDetalle
 *
 * @package App\Models
 * @version September 4, 2022, 7:56 pm CST
 * @property \App\Models\RrhhUnidad $unidad
 * @property \App\Models\Activo $activo
 * @property \App\Models\ActivoTarjeta $tarjeta
 * @property \Illuminate\Database\Eloquent\Collection $activoSolicitudDetalles
 * @property integer $tarjeta_id
 * @property integer $activo_id
 * @property string $tipo
 * @property integer $cantidad
 * @property number $valor
 * @property string $fecha_asigna
 * @property integer $unidad_id
 * @property boolean $impreso
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $activo_solicitud_detalles_count
 * @property-read mixed $valor_alza
 * @property-read mixed $valor_baja
 * @method static \Database\Factories\ActivoTarjetaDetalleFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle newQuery()
 * @method static \Illuminate\Database\Query\Builder|ActivoTarjetaDetalle onlyTrashed()
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
 * @method static \Illuminate\Database\Query\Builder|ActivoTarjetaDetalle withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ActivoTarjetaDetalle withoutTrashed()
 * @mixin \Eloquent
 */
	class ActivoTarjetaDetalle extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ActivoTarjetaEstado
 *
 * @package App\Models
 * @version November 10, 2022, 4:56 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $activoTarjetas
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $activo_tarjetas_count
 * @method static \Database\Factories\ActivoTarjetaEstadoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado newQuery()
 * @method static \Illuminate\Database\Query\Builder|ActivoTarjetaEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ActivoTarjetaEstado withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ActivoTarjetaEstado withoutTrashed()
 * @mixin Model
 */
	class ActivoTarjetaEstado extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ActivoTipo
 *
 * @package App\Models
 * @version August 31, 2022, 10:51 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $activos
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $activos_count
 * @property-read mixed $text_corto
 * @method static \Database\Factories\ActivoTipoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo newQuery()
 * @method static \Illuminate\Database\Query\Builder|ActivoTipo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ActivoTipo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ActivoTipo withoutTrashed()
 * @mixin \Eloquent
 */
	class ActivoTipo extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Bitacora
 *
 * @package App\Models
 * @version March 17, 2022, 10:16 am CST
 * @property \App\Models\User usuario
 * @property \Illuminate\Database\Eloquent\Collection usuariosNotificar
 * @property string model_type
 * @property integer model_id
 * @property string seccion
 * @property string titulo
 * @property string comentario
 * @property integer notificado
 * @property integer usuario_id
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $fecha_crea
 * @property-read Model|\Eloquent $model
 * @property-read \App\Models\User|null $usuario
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $usuariosNotificar
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
 * @property string $model_type
 * @property int $model_id
 * @property string|null $seccion
 * @property string $titulo
 * @property string $comentario
 * @property int $usuario_id
 * @mixin \Eloquent
 */
	class Bitacora extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Bodega
 *
 * @package App\Models
 * @version December 19, 2022, 11:01 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $stocks
 * @property \Illuminate\Database\Eloquent\Collection $users
 * @property string $nombre
 * @property string $direccion
 * @property string $telefono
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $stocks_count
 * @property-read int|null $users_count
 * @method static \Database\Factories\BodegaFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega newQuery()
 * @method static \Illuminate\Database\Query\Builder|Bodega onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Bodega withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Bodega withoutTrashed()
 * @mixin Model
 */
	class Bodega extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Colaborador
 *
 * @package App\Models
 * @version November 10, 2022, 2:41 pm CST
 * @property \App\Models\RrhhPuesto $puesto
 * @property \App\Models\User $user
 * @property \App\Models\RrhhUnidad $unidad
 * @property \Illuminate\Database\Eloquent\Collection $solicitudOrigen
 * @property \Illuminate\Database\Eloquent\Collection $solicitudDestino
 * @property \Illuminate\Database\Eloquent\Collection $activoTarjetas
 * @property \Illuminate\Database\Eloquent\Collection $contratos
 * @property \Illuminate\Database\Eloquent\Collection $jefe
 * @property string $nombres
 * @property string $apellidos
 * @property string $dpi
 * @property string $correo
 * @property string $telefono
 * @property string $direccion
 * @property string $nit
 * @property integer $puesto_id
 * @property integer $unidad_id
 * @property integer $user_id
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $activo_tarjetas_count
 * @property-read mixed $nombre_completo
 * @property-read mixed $text
 * @property-read int|null $jefe_count
 * @property-read int|null $solicitud_destino_count
 * @property-read int|null $solicitud_origen_count
 * @method static \Database\Factories\ColaboradorFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador newQuery()
 * @method static \Illuminate\Database\Query\Builder|Colaborador onlyTrashed()
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
 * @method static \Illuminate\Database\Query\Builder|Colaborador withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Colaborador withoutTrashed()
 * @property-read int|null $contratos_count
 * @mixin \Eloquent
 */
	class Colaborador extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Compra
 *
 * @package App\Models
 * @version July 27, 2022, 12:21 pm CST
 * @property \App\Models\User $usuarioCrea
 * @property \App\Models\Proveedor $proveedor
 * @property \App\Models\CompraTipo $tipo
 * @property \App\Models\User $usuarioRecibe
 * @property \App\Models\CompraEstado $estado
 * @property \Illuminate\Database\Eloquent\Collection $compra1hs
 * @property \Illuminate\Database\Eloquent\Collection $detalles
 * @property integer $tipo_id
 * @property integer $proveedor_id
 * @property string $codigo
 * @property integer $correlativo
 * @property Carbon $fecha_documento
 * @property Carbon $fecha_ingreso
 * @property string $serie
 * @property string $numero
 * @property integer $estado_id
 * @property integer $usuario_crea
 * @property integer $usuario_recibe
 * @property string $observaciones
 * @property string $orden_compra
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Compra1h|null $compra1h
 * @property-read int|null $compra1hs_count
 * @property-read int|null $detalles_count
 * @property-read mixed $sub_total
 * @property-read mixed $total
 * @property-read mixed $total_venta
 * @method static \Illuminate\Database\Eloquent\Builder|Compra delItem($item)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra delUser($user = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra delUsuarioCrea($user = null)
 * @method static \Database\Factories\CompraFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra noTemporal()
 * @method static \Illuminate\Database\Query\Builder|Compra onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra query()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra temporal()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereCorrelativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereFechaDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereFechaIngreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereOrdenCompra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereProveedorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereSerie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereTipoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereUsuarioCrea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereUsuarioRecibe($value)
 * @method static \Illuminate\Database\Query\Builder|Compra withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Compra withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $folio_almacen
 * @property-read mixed $anio
 * @property-read mixed $mes
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereFolioAlmacen($value)
 * @property string|null $folio_inventario
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereFolioInventario($value)
 * @property string $descuento
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereDescuento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra noAnuladas()
 */
	class Compra extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Compra1h
 *
 * @package App\Models
 * @version July 27, 2022, 12:27 pm CST
 * @property \App\Models\Compra $compra
 * @property \App\Models\User $usuarioProcesa
 * @property \App\Models\EnvioFiscal $envioFiscal
 * @property \Illuminate\Database\Eloquent\Collection $compra1hDetalles
 * @property string $folio
 * @property integer $compra_id
 * @property integer $envio_fiscal_id
 * @property string $codigo
 * @property integer $correlativo
 * @property integer $del
 * @property integer $al
 * @property string|\Carbon\Carbon $fecha_procesa
 * @property integer $usuario_procesa
 * @property string $observaciones
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Compra1hDetalle[] $detalles
 * @property-read int|null $detalles_count
 * @method static \Database\Factories\Compra1hFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h newQuery()
 * @method static \Illuminate\Database\Query\Builder|Compra1h onlyTrashed()
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
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereUsuarioProcesa($value)
 * @method static \Illuminate\Database\Query\Builder|Compra1h withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Compra1h withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereFolio($value)
 * @property-read mixed $sub_total
 * @property-read mixed $total
 * @property-read mixed $total_letras
 */
	class Compra1h extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Compra1hDetalle
 *
 * @package App\Models
 * @version July 27, 2022, 12:27 pm CST
 * @property \App\Models\Compra1h $1h
 * @property \App\Models\Item $item
 * @property integer $1h_id
 * @property integer $item_id
 * @property number $precio
 * @property number $cantidad
 * @property integer $folio_almacen
 * @property integer $folio_inventario
 * @property string $codigo_inventario
 * @property string $texto_extra
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Compra1h $compra1h
 * @property-read mixed $sub_total
 * @method static \Database\Factories\Compra1hDetalleFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle newQuery()
 * @method static \Illuminate\Database\Query\Builder|Compra1hDetalle onlyTrashed()
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
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Compra1hDetalle withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Compra1hDetalle withoutTrashed()
 * @property-read mixed $text
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle whereTextoExtra($value)
 * @mixin \Eloquent
 */
	class Compra1hDetalle extends \Eloquent {}
}

namespace App\Models{
/**
 * Class CompraDetalle
 *
 * @package App\Models
 * @version July 27, 2022, 12:22 pm CST
 * @property Compra $compra
 * @property Item $item
 * @property integer $compra_id
 * @property integer $item_id
 * @property number $cantidad
 * @property number $precio
 * @property number $descuento
 * @property string $fecha_vence
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $codigo
 * @property-read mixed $responsable
 * @property-read mixed $sub_total
 * @property-read \App\Models\Kardex|null $kardex
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Stock[] $stocks
 * @property-read int|null $stocks_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StockTransaccion[] $transaccionesStock
 * @property-read int|null $transacciones_stock_count
 * @method static \Database\Factories\CompraDetalleFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle newQuery()
 * @method static \Illuminate\Database\Query\Builder|CompraDetalle onlyTrashed()
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
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|CompraDetalle withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CompraDetalle withoutTrashed()
 * @mixin \Eloquent
 */
	class CompraDetalle extends \Eloquent {}
}

namespace App\Models{
/**
 * Class CompraEstado
 *
 * @package App\Models
 * @version July 27, 2022, 12:20 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $compras
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $compras_count
 * @method static \Database\Factories\CompraEstadoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado newQuery()
 * @method static \Illuminate\Database\Query\Builder|CompraEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|CompraEstado withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CompraEstado withoutTrashed()
 * @mixin \Eloquent
 */
	class CompraEstado extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $bodega_id
 * @property int|null $proveedor_id
 * @property int|null $unidad_id
 * @property int|null $correlativo
 * @property string|null $codigo
 * @property \Illuminate\Support\Carbon|null $fecha_requiere
 * @property string|null $justificacion
 * @property int $estado_id
 * @property int $usuario_solicita
 * @property int|null $usuario_aprueba
 * @property int|null $usuario_administra
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Bodega|null $bodega
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraSolicitudDetalle> $detalles
 * @property-read int|null $detalles_count
 * @property-read \App\Models\CompraSolicitudEstado $estado
 * @property-read mixed $sub_total
 * @property-read mixed $total
 * @property-read \App\Models\Proveedor|null $proveedor
 * @property-read \App\Models\RrhhUnidad|null $unidad
 * @property-read \App\Models\User|null $usuarioAdministra
 * @property-read \App\Models\User|null $usuarioAprueba
 * @property-read \App\Models\User $usuarioSolicita
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
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereFechaRequiere($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereProveedorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereUnidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereUsuarioAdministra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereUsuarioAprueba($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereUsuarioSolicita($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $subproductos
 * @property string|null $partidas
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereJustificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud wherePartidas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereSubproductos($value)
 */
	class CompraSolicitud extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ComprasolicitudDetalle
 *
 * @package App\Models
 * @version April 18, 2024, 9:29 pm CST
 * @property \App\Models\Item $item
 * @property \App\Models\CompraSolicitud $solicitud
 * @property integer $solicitud_id
 * @property integer $item_id
 * @property integer $cantidad
 * @property number $precio_venta
 * @property number $precio_compra
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $sub_total
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
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle wherePrecioCompra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle wherePrecioVenta($value)
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
 * @package App\Models
 * @version July 27, 2022, 12:20 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $compras
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $compras_count
 * @method static \Database\Factories\CompraTipoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraTipo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraTipo newQuery()
 * @method static \Illuminate\Database\Query\Builder|CompraTipo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraTipo query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraTipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraTipo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraTipo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraTipo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraTipo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|CompraTipo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CompraTipo withoutTrashed()
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
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration newQuery()
 * @method static \Illuminate\Database\Query\Builder|Configuration onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration query()
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|Configuration withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Configuration withoutTrashed()
 * @mixin \Eloquent
 */
	class Configuration extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * Class Consumo
 *
 * @package App\Models
 * @version December 27, 2022, 11:27 am CST
 * @property \App\Models\User $usuarioCrea
 * @property \App\Models\Bodega $bodega
 * @property \App\Models\RrhhUnidad $unidad
 * @property \App\Models\ConsumoEstado $estado
 * @property \Illuminate\Database\Eloquent\Collection $detalles
 * @property integer $correlativo
 * @property string $codigo
 * @property integer $estado_id
 * @property integer $unidad_id
 * @property integer $bodega_id
 * @property integer $usuario_crea
 * @property int $id
 * @property string|null $observaciones
 * @property string|null $fecha_procesa
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $consumo_detalles_count
 * @method static Builder|Consumo delUsuarioCrea($user = null)
 * @method static \Database\Factories\ConsumoFactory factory(...$parameters)
 * @method static Builder|Consumo newModelQuery()
 * @method static Builder|Consumo newQuery()
 * @method static Builder|Consumo noTemporal()
 * @method static \Illuminate\Database\Query\Builder|Consumo onlyTrashed()
 * @method static Builder|Consumo query()
 * @method static Builder|Consumo temporal()
 * @method static Builder|Consumo whereBodegaId($value)
 * @method static Builder|Consumo whereCodigo($value)
 * @method static Builder|Consumo whereCorrelativo($value)
 * @method static Builder|Consumo whereCreatedAt($value)
 * @method static Builder|Consumo whereDeletedAt($value)
 * @method static Builder|Consumo whereEstadoId($value)
 * @method static Builder|Consumo whereId($value)
 * @method static Builder|Consumo whereObservaciones($value)
 * @method static Builder|Consumo whereUnidadId($value)
 * @method static Builder|Consumo whereUpdatedAt($value)
 * @method static Builder|Consumo whereUsuarioCrea($value)
 * @method static \Illuminate\Database\Query\Builder|Consumo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Consumo withoutTrashed()
 * @mixin Model
 * @property-read int|null $detalles_count
 * @method static \Illuminate\Database\Eloquent\Builder|Consumo whereFechaProcesa($value)
 */
	class Consumo extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ConsumoDetalle
 *
 * @package App\Models
 * @version December 27, 2022, 11:03 am CST
 * @property \App\Models\Consumo $consumo
 * @property \App\Models\Item $item
 * @property integer $consumo_id
 * @property integer $item_id
 * @property number $cantidad
 * @property number $precio
 * @property string $fecha_vence
 * @property string $observaciones
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Kardex|null $kardex
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StockTransaccion[] $transaccionesStock
 * @property-read int|null $transacciones_stock_count
 * @method static \Database\Factories\ConsumoDetalleFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle newQuery()
 * @method static \Illuminate\Database\Query\Builder|ConsumoDetalle onlyTrashed()
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
 * @method static \Illuminate\Database\Query\Builder|ConsumoDetalle withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ConsumoDetalle withoutTrashed()
 * @mixin Model
 */
	class ConsumoDetalle extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ConsumoEstado
 *
 * @package App\Models
 * @version December 27, 2022, 11:03 am CST
 * @property \Illuminate\Database\Eloquent\Collection $consumos
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $consumos_count
 * @method static \Database\Factories\ConsumoEstadoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado newQuery()
 * @method static \Illuminate\Database\Query\Builder|ConsumoEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ConsumoEstado withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ConsumoEstado withoutTrashed()
 * @mixin Model
 */
	class ConsumoEstado extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Contrato
 *
 * @package App\Models
 * @version November 10, 2022, 2:44 pm CST
 * @property \App\Models\RrhhColaborador $colaborador
 * @property \App\Models\RrhhUnidad $unidad
 * @property \App\Models\RrhhPuesto $puesto
 * @property integer $colaborador_id
 * @property integer $unidad_id
 * @property integer $puesto_id
 * @property string $numero
 * @property string $inicio
 * @property string $fin
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\ContratoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato newQuery()
 * @method static \Illuminate\Database\Query\Builder|Contrato onlyTrashed()
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
 * @method static \Illuminate\Database\Query\Builder|Contrato withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Contrato withoutTrashed()
 * @mixin Model
 */
	class Contrato extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Denominacion
 *
 * @package App\Models
 * @version July 27, 2022, 12:22 pm CST
 * @property number $monto
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\DenominacionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion newQuery()
 * @method static \Illuminate\Database\Query\Builder|Denominacion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion whereMonto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Denominacion withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Denominacion withoutTrashed()
 * @mixin \Eloquent
 */
	class Denominacion extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Divisa
 *
 * @package App\Models
 * @version July 27, 2022, 12:23 pm CST
 * @property string $simbolo
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\DivisaFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa newQuery()
 * @method static \Illuminate\Database\Query\Builder|Divisa onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa query()
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa whereSimbolo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Divisa withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Divisa withoutTrashed()
 * @mixin \Eloquent
 */
	class Divisa extends \Eloquent {}
}

namespace App\Models{
/**
 * Class EnvioFiscal
 *
 * @package App\Models
 * @version July 27, 2022, 12:26 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $compra1hs
 * @property integer $nuemero_constancia
 * @property string $serie_constancia
 * @property string $fecha
 * @property string $numero_cuenta
 * @property string $forma
 * @property integer $correlativo_del
 * @property integer $correlativo_al
 * @property integer $cantidad
 * @property integer $pendientes
 * @property string $serie
 * @property string $numero
 * @property string $libro
 * @property integer $folio
 * @property string $resolucion
 * @property string $numero_gestion
 * @property string $fecha_gestion
 * @property string $correlativo
 * @property string $activo
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $compra1hs_count
 * @method static \Database\Factories\EnvioFiscalFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal newQuery()
 * @method static \Illuminate\Database\Query\Builder|EnvioFiscal onlyTrashed()
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
 * @method static \Illuminate\Database\Query\Builder|EnvioFiscal withTrashed()
 * @method static \Illuminate\Database\Query\Builder|EnvioFiscal withoutTrashed()
 * @mixin \Eloquent
 */
	class EnvioFiscal extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Equivalencia
 *
 * @package App\Models
 * @version July 27, 2022, 12:23 pm CST
 * @property \App\Models\Item $itemOrigen
 * @property \App\Models\Item $itemDestino
 * @property integer $item_origen
 * @property integer $item_destino
 * @property number $cantidad
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\EquivalenciaFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia newQuery()
 * @method static \Illuminate\Database\Query\Builder|Equivalencia onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia query()
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia whereItemDestino($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia whereItemOrigen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Equivalencia withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Equivalencia withoutTrashed()
 * @mixin \Eloquent
 */
	class Equivalencia extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Item
 *
 * @package App\Models
 * @version July 27, 2022, 12:22 pm CST
 * @property \App\Models\ItemCategoria $categoria
 * @property \App\Models\Renglon $renglon
 * @property \App\Models\Marca $marca
 * @property \App\Models\Unimed $unimed
 * @property \App\Models\ItemTipo $tipo
 * @property \Illuminate\Database\Eloquent\Collection $compra1hDetalles
 * @property \Illuminate\Database\Eloquent\Collection $compraDetalles
 * @property \Illuminate\Database\Eloquent\Collection $equivalencias
 * @property \Illuminate\Database\Eloquent\Collection $equivalencia1s
 * @property \Illuminate\Database\Eloquent\Collection $itemCategoria2s
 * @property \Illuminate\Database\Eloquent\Collection $itemsTraslados
 * @property \Illuminate\Database\Eloquent\Collection $itemsTraslado3s
 * @property \Illuminate\Database\Eloquent\Collection $kardexes
 * @property \Illuminate\Database\Eloquent\Collection $solicitudDetalles
 * @property \Illuminate\Database\Eloquent\Collection $stockIniciales
 * @property \Illuminate\Database\Eloquent\Collection $stocks
 * @property string $codigo
 * @property string $nombre
 * @property string $descripcion
 * @property integer $tipo_id
 * @property integer $renglon_id
 * @property integer $marca_id
 * @property integer $unimed_id
 * @property integer $categoria_id
 * @property number $precio_venta
 * @property number $precio_compra
 * @property number $precio_promedio
 * @property number $stock_minimo
 * @property number $stock_maximo
 * @property number $stock_total
 * @property string $stock_reservado
 * @property string $ubicacion
 * @property boolean $perecedero
 * @property boolean $inventariable
 * @property int $id
 * @property string|null $codigo_insumo
 * @property int|null $presentacion_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ItemCategoria[] $categorias
 * @property-read int|null $categorias_count
 * @property-read int|null $compra1h_detalles_count
 * @property-read int|null $compra_detalles_count
 * @property-read int|null $equivalencia1s_count
 * @property-read int|null $equivalencias_count
 * @property-read mixed $img
 * @property-read mixed $text
 * @property-read mixed $thumb
 * @property-read int|null $kardexes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Kardex[] $kardexs
 * @property-read int|null $kardexs_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\App\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read int|null $solicitud_detalles_count
 * @property-read int|null $stocks_count
 * @method static \Illuminate\Database\Eloquent\Builder|Item deCategoria($categoria)
 * @method static \Illuminate\Database\Eloquent\Builder|Item deMarca($marca)
 * @method static \Database\Factories\ItemFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item newQuery()
 * @method static \Illuminate\Database\Query\Builder|Item onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|Item tipoActivo()
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCategoriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCodigoInsumo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereInventariable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereMarcaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item wherePerecedero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item wherePrecioCompra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item wherePrecioPromedio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item wherePrecioVenta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item wherePresentacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereRenglonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereStockMaximo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereStockMinimo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereTipoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUbicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUnimedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Item withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Item withoutAppends()
 * @method static \Illuminate\Database\Query\Builder|Item withoutTrashed()
 * @property-read int|null $items_traslado3s_count
 * @property-read int|null $items_traslados_count
 * @property-read int|null $stock_iniciales_count
 * @property string|null $codigo_presentacion
 * @property-read \App\Models\ItemPresentacion|null $presentacion
 * @method static \Illuminate\Database\Eloquent\Builder|Item conIngresos()
 * @method static \Illuminate\Database\Eloquent\Builder|Item conDetSolicitudesAprobadas()
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCodigoPresentacion($value)
 * @property-read mixed $stock_bodega
 * @property int|null $modelo_id
 * @property-read mixed $texto_libro_almacen
 * @property-read mixed $texto_principal
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereModeloId($value)
 * @property-read mixed $texto_kardex
 * @property-read mixed $texto_requisicion
 * @mixin \Eloquent
 */
	class Item extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * Class ItemCategoria
 *
 * @package App\Models
 * @version July 27, 2022, 12:21 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $items
 * @property \Illuminate\Database\Eloquent\Collection $item1s
 * @property string $nombre
 * @property string $descripcion
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $item1s_count
 * @property-read int|null $items_count
 * @method static \Database\Factories\ItemCategoriaFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria newQuery()
 * @method static \Illuminate\Database\Query\Builder|ItemCategoria onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ItemCategoria withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ItemCategoria withoutTrashed()
 * @mixin \Eloquent
 */
	class ItemCategoria extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ItemModelo
 *
 * @package App\Models
 * @version January 10, 2023, 9:22 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $items
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $items_count
 * @method static \Database\Factories\ItemModeloFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo newQuery()
 * @method static \Illuminate\Database\Query\Builder|ItemModelo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ItemModelo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ItemModelo withoutTrashed()
 * @mixin Model
 */
	class ItemModelo extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ItemPresentacion
 *
 * @package App\Models
 * @version December 8, 2022, 10:59 am CST
 * @property \Illuminate\Database\Eloquent\Collection $items
 * @property string $codigo
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $items_count
 * @method static \Database\Factories\ItemPresentacionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion newQuery()
 * @method static \Illuminate\Database\Query\Builder|ItemPresentacion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ItemPresentacion withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ItemPresentacion withoutTrashed()
 * @mixin Model
 */
	class ItemPresentacion extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ItemTipo
 *
 * @package App\Models
 * @version August 4, 2022, 7:00 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $items
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $items_count
 * @method static \Database\Factories\ItemTipoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo newQuery()
 * @method static \Illuminate\Database\Query\Builder|ItemTipo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ItemTipo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ItemTipo withoutTrashed()
 * @mixin \Eloquent
 */
	class ItemTipo extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ItemTraslado
 *
 * @package App\Models
 * @version July 27, 2022, 12:24 pm CST
 * @property \App\Models\User $user
 * @property \App\Models\ItemTrasladoEstado $estado
 * @property \App\Models\Item $itemDestino
 * @property \App\Models\Item $itemOrigen
 * @property string $codigo
 * @property integer $correlativo
 * @property integer $item_origen
 * @property number $cantidad_origen
 * @property integer $item_destino
 * @property number $cantidad_destino
 * @property string $observaciones
 * @property integer $user_id
 * @property integer $estado_id
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Kardex|null $kardex
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StockTransaccion[] $transaccionesStock
 * @property-read int|null $transacciones_stock_count
 * @method static \Database\Factories\ItemTrasladoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado newQuery()
 * @method static \Illuminate\Database\Query\Builder|ItemTraslado onlyTrashed()
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
 * @method static \Illuminate\Database\Query\Builder|ItemTraslado withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ItemTraslado withoutTrashed()
 * @mixin \Eloquent
 */
	class ItemTraslado extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ItemTrasladoEstado
 *
 * @package App\Models
 * @version July 27, 2022, 12:23 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $itemsTraslados
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\ItemTrasladoEstadoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado newQuery()
 * @method static \Illuminate\Database\Query\Builder|ItemTrasladoEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ItemTrasladoEstado withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ItemTrasladoEstado withoutTrashed()
 * @property-read int|null $items_traslados_count
 * @mixin \Eloquent
 */
	class ItemTrasladoEstado extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Kardex
 *
 * @package App\Models
 * @version July 27, 2022, 12:24 pm CST
 * @property \App\Models\Item $item
 * @property \App\Models\User $usuario
 * @property integer $item_id
 * @property integer $model_id
 * @property integer $folio
 * @property string $codigo_insumo
 * @property string $del
 * @property string $al
 * @property string $model_type
 * @property number $cantidad
 * @property number $saldo
 * @property string $tipo
 * @property string $codigo
 * @property string $fecha_ordena
 * @property string $fecha_ordena_timestamp
 * @property string $responsable
 * @property string $observacion
 * @property boolean $impreso
 * @property string $folio_siguiente
 * @property integer $usuario_id
 * @property int $id
 * @property string|null $concepto
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $ingreso
 * @property-read mixed $salida
 * @property-read Model|\Eloquent $model
 * @method static Builder|Kardex delItem($item)
 * @method static Builder|Kardex inventariable()
 * @method static Builder|Kardex newModelQuery()
 * @method static Builder|Kardex newQuery()
 * @method static \Illuminate\Database\Query\Builder|Kardex onlyTrashed()
 * @method static Builder|Kardex query()
 * @method static Builder|Kardex whereCantidad($value)
 * @method static Builder|Kardex whereCodigo($value)
 * @method static Builder|Kardex whereCreatedAt($value)
 * @method static Builder|Kardex whereDeletedAt($value)
 * @method static Builder|Kardex whereFolio($value)
 * @method static Builder|Kardex whereId($value)
 * @method static Builder|Kardex whereImpreso($value)
 * @method static Builder|Kardex whereItemId($value)
 * @method static Builder|Kardex whereModelId($value)
 * @method static Builder|Kardex whereModelType($value)
 * @method static Builder|Kardex whereObservacion($value)
 * @method static Builder|Kardex whereResponsable($value)
 * @method static Builder|Kardex whereTipo($value)
 * @method static Builder|Kardex whereUpdatedAt($value)
 * @method static Builder|Kardex whereUsuarioId($value)
 * @method static \Illuminate\Database\Query\Builder|Kardex withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Kardex withoutTrashed()
 * @property-read mixed $precio
 * @method static Builder|Kardex whereAl($value)
 * @method static Builder|Kardex whereCodigoInsumo($value)
 * @method static Builder|Kardex whereDel($value)
 * @property string|null $precio_existencia Precio unitario del las existencias
 * @property string|null $precio_movimiento Precio unitario del ingreso o egreso
 * @property-read mixed $sub_total
 * @method static Builder|Kardex whereFolioSiguiente($value)
 * @method static Builder|Kardex wherePrecioExistencia($value)
 * @method static Builder|Kardex wherePrecioMovimiento($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Bitacora> $bitacoras
 * @property-read int|null $bitacoras_count
 * @property-read mixed $saldo_stock
 * @property-read mixed $sub_total_saldo
 * @method static Builder|Kardex whereSaldo($value)
 * @mixin \Eloquent
 */
	class Kardex extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Magnitud
 *
 * @package App\Models
 * @version July 27, 2022, 12:21 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $unimeds
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $unimeds_count
 * @method static \Database\Factories\MagnitudFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud newQuery()
 * @method static \Illuminate\Database\Query\Builder|Magnitud onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud query()
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Magnitud withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Magnitud withoutTrashed()
 * @mixin \Eloquent
 */
	class Magnitud extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Marca
 *
 * @package App\Models
 * @version July 27, 2022, 12:21 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $items
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $items_count
 * @method static \Database\Factories\MarcaFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Marca newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Marca newQuery()
 * @method static \Illuminate\Database\Query\Builder|Marca onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Marca query()
 * @method static \Illuminate\Database\Eloquent\Builder|Marca whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marca whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marca whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marca whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marca whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Marca withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Marca withoutTrashed()
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
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $model
 * @method static \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|static[] all($columns = ['*'])
 * @method static \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|static[] get($columns = ['*'])
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
 * @property-read mixed $extension
 * @property-read mixed $human_readable_size
 * @property-read mixed $original_url
 * @property-read mixed $preview_url
 * @property-read mixed $type
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
 * @property-read \Illuminate\Database\Eloquent\Collection|Option[] $children
 * @property-read int|null $children_count
 * @property-read mixed $active
 * @property-read mixed $ruta_evaluada
 * @property-read mixed $text
 * @property-read mixed $visible_to_user
 * @property-read Option|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Option newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Option newQuery()
 * @method static \Illuminate\Database\Query\Builder|Option onlyTrashed()
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
 * @method static \Illuminate\Database\Query\Builder|Option withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Option withoutTrashed()
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
 * @property-read \Illuminate\Database\Eloquent\Collection|Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission role($roles, $guard = null)
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
 * @package App\Models
 * @version July 27, 2022, 12:20 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $compras
 * @property string $nit
 * @property string $nombre
 * @property string $razon_social
 * @property string $correo
 * @property string $telefono_movil
 * @property string $telefono_oficina
 * @property string $direccion
 * @property string $observaciones
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $compras_count
 * @method static \Database\Factories\ProveedorFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor newQuery()
 * @method static \Illuminate\Database\Query\Builder|Proveedor onlyTrashed()
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
 * @method static \Illuminate\Database\Query\Builder|Proveedor withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Proveedor withoutTrashed()
 * @mixin \Eloquent
 */
	class Proveedor extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Renglon
 *
 * @package App\Models
 * @version July 27, 2022, 12:22 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $items
 * @property integer $numero
 * @property string $descripcion
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $text
 * @property-read int|null $items_count
 * @method static \Database\Factories\RenglonFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon newQuery()
 * @method static \Illuminate\Database\Query\Builder|Renglon onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Renglon withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Renglon withoutTrashed()
 * @mixin \Eloquent
 */
	class Renglon extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Role
 *
 * @package App\Models
 * @version September 21, 2021, 3:52 pm CST
 * @property \App\Models\ModelHasRole $modelHasRole
 * @property \Illuminate\Database\Eloquent\Collection $options
 * @property \Illuminate\Database\Eloquent\Collection $permissions
 * @property string $name
 * @property string $guard_name
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read int|null $options_count
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role permission($permissions)
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
 * @package App\Models
 * @version November 12, 2022, 10:35 am CST
 * @property \App\Models\RrhhPuesto $puesto
 * @property \App\Models\User $user
 * @property \App\Models\RrhhUnidad $unidad
 * @property \Illuminate\Database\Eloquent\Collection $activoSolicitudes
 * @property \Illuminate\Database\Eloquent\Collection $activoSolicitude1s
 * @property \Illuminate\Database\Eloquent\Collection $activoTarjetas
 * @property \Illuminate\Database\Eloquent\Collection $rrhhContratos
 * @property \Illuminate\Database\Eloquent\Collection $rrhhUnidade2s
 * @property string $nombres
 * @property string $apellidos
 * @property string $dpi
 * @property string $correo
 * @property string $telefono
 * @property string $direccion
 * @property string $nit
 * @property integer $puesto_id
 * @property integer $unidad_id
 * @property integer $user_id
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $activo_tarjetas_count
 * @property-read mixed $nombre_completo
 * @property-read mixed $text
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador newQuery()
 * @method static \Illuminate\Database\Query\Builder|RrhhColaborador onlyTrashed()
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
 * @method static \Illuminate\Database\Query\Builder|RrhhColaborador withTrashed()
 * @method static \Illuminate\Database\Query\Builder|RrhhColaborador withoutTrashed()
 * @property-read int|null $activo_solicitude1s_count
 * @property-read int|null $activo_solicitudes_count
 * @property-read int|null $rrhh_unidade2s_count
 * @property-read int|null $rrhh_contratos_count
 * @mixin Model
 */
	class RrhhColaborador extends \Eloquent {}
}

namespace App\Models{
/**
 * Class RrhhContrato
 *
 * @package App\Models
 * @version December 8, 2022, 11:13 am CST
 * @property \App\Models\RrhhColaborador $colaborador
 * @property \App\Models\RrhhUnidad $unidad
 * @property \App\Models\RrhhPuesto $puesto
 * @property integer $colaborador_id
 * @property integer $unidad_id
 * @property integer $puesto_id
 * @property string $numero
 * @property string $inicio
 * @property string $fin
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\RrhhContratoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato newQuery()
 * @method static \Illuminate\Database\Query\Builder|RrhhContrato onlyTrashed()
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
 * @method static \Illuminate\Database\Query\Builder|RrhhContrato withTrashed()
 * @method static \Illuminate\Database\Query\Builder|RrhhContrato withoutTrashed()
 * @mixin Model
 */
	class RrhhContrato extends \Eloquent {}
}

namespace App\Models{
/**
 * Class RrhhPuesto
 *
 * @package App\Models
 * @version August 4, 2022, 9:33 am CST
 * @property \Illuminate\Database\Eloquent\Collection $users
 * @property string $nombre
 * @property string $atribuciones
 * @property string $activo
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $users_count
 * @method static \Database\Factories\RrhhPuestoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto newQuery()
 * @method static \Illuminate\Database\Query\Builder|RrhhPuesto onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto query()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereActivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereAtribuciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|RrhhPuesto withTrashed()
 * @method static \Illuminate\Database\Query\Builder|RrhhPuesto withoutTrashed()
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
 * @property int $unidad_tipo_id
 * @property int|null $unidad_padre_id
 * @property int|null $jefe_id
 * @property string $activa
 * @property string $solicita
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $jefe
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RrhhPuesto> $puestos
 * @property-read int|null $puestos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Solicitud> $solicitudes
 * @property-read int|null $solicitudes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $usuarios
 * @property-read int|null $usuarios_count
 * @method static \Database\Factories\RrhhUnidadFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad query()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereActiva($value)
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
 * @method static \Database\Factories\RrhhUnidadTipoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo query()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo withoutTrashed()
 */
	class RrhhUnidadTipo extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Solicitud
 *
 * @package App\Models
 * @version July 27, 2022, 12:25 pm CST
 * @property User $usuarioDespacha
 * @property User $usuarioSolicita
 * @property SolicitudEstado $estado
 * @property User $usuarioCrea
 * @property User $usuarioAutoriza
 * @property User $usuarioAprueba
 * @property RrhhUnidad $unidad
 * @property Collection $detalles
 * @property string $codigo
 * @property integer $correlativo
 * @property string $justificacion
 * @property integer $unidad_id
 * @property integer $usuario_crea
 * @property integer $usuario_solicita
 * @property integer $usuario_autoriza
 * @property integer $usuario_aprueba
 * @property integer $usuario_despacha
 * @property string $firma_requiere
 * @property string $firma_autoriza
 * @property string $firma_aprueba
 * @property string $firma_almacen
 * @property string|Carbon $fecha_solicita
 * @property string|Carbon $fecha_autoriza
 * @property string|Carbon $fecha_aprueba
 * @property string|Carbon $fecha_almacen_firma
 * @property string|Carbon $fecha_informa
 * @property string|Carbon $fecha_despacha
 * @property integer $estado_id
 * @property int $id
 * @property string|null $observaciones
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $detalles_count
 * @method static Builder|Solicitud aprobadas()
 * @method static Builder|Solicitud autorizadas()
 * @method static Builder|Solicitud deUnidad($unidad = null)
 * @method static Builder|Solicitud delUsuarioCrea($user = null)
 * @method static \Database\Factories\SolicitudFactory factory(...$parameters)
 * @method static Builder|Solicitud newModelQuery()
 * @method static Builder|Solicitud newQuery()
 * @method static \Illuminate\Database\Query\Builder|Solicitud onlyTrashed()
 * @method static Builder|Solicitud query()
 * @method static Builder|Solicitud solicitadas()
 * @method static Builder|Solicitud temporal()
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
 * @method static \Illuminate\Database\Query\Builder|Solicitud withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Solicitud withoutTrashed()
 * @property int|null $bodega_id
 * @property-read \App\Models\Bodega|null $bodega
 * @method static Builder|Solicitud whereBodegaId($value)
 * @property-read Collection<int, \App\Models\Bitacora> $bitacoras
 * @property-read int|null $bitacoras_count
 * @property-read mixed $motivo_retorna
 * @mixin \Eloquent
 */
	class Solicitud extends \Eloquent {}
}

namespace App\Models{
/**
 * Class SolicitudDetalle
 *
 * @package App\Models
 * @version July 27, 2022, 12:25 pm CST
 * @property Item $item
 * @property Solicitud $solicitud
 * @property integer $solicitud_id
 * @property integer $item_id
 * @property number $cantidad_solicitada
 * @property number $cantidad_aprobada
 * @property number $cantidad_despachada
 * @property number $precio
 * @property int $id
 * @property string|null $observaciones
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Kardex|null $kardex
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StockTransaccion[] $transaccionesStock
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Kardex[] $kardexes
 * @property-read int|null $transacciones_stock_count
 * @method static \Database\Factories\SolicitudDetalleFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle newQuery()
 * @method static \Illuminate\Database\Query\Builder|SolicitudDetalle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereCantidadAprobada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereCantidadDespachada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereCantidadSolicitada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereSolicitudId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|SolicitudDetalle withTrashed()
 * @method static \Illuminate\Database\Query\Builder|SolicitudDetalle withoutTrashed()
 * @property string|null $fecha_vence
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereFechaVence($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Kardex> $kardexs
 * @property-read int|null $kardexs_count
 * @mixin \Eloquent
 */
	class SolicitudDetalle extends \Eloquent {}
}

namespace App\Models{
/**
 * Class SolicitudEstado
 *
 * @package App\Models
 * @version July 27, 2022, 12:24 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $solicitudes
 * @property string $color
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\SolicitudEstadoFactory factory(...$parameters)
 * @method static Builder|SolicitudEstado newModelQuery()
 * @method static Builder|SolicitudEstado newQuery()
 * @method static \Illuminate\Database\Query\Builder|SolicitudEstado onlyTrashed()
 * @method static Builder|SolicitudEstado principales()
 * @method static Builder|SolicitudEstado query()
 * @method static Builder|SolicitudEstado whereCreatedAt($value)
 * @method static Builder|SolicitudEstado whereDeletedAt($value)
 * @method static Builder|SolicitudEstado whereId($value)
 * @method static Builder|SolicitudEstado whereNombre($value)
 * @method static Builder|SolicitudEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|SolicitudEstado withTrashed()
 * @method static \Illuminate\Database\Query\Builder|SolicitudEstado withoutTrashed()
 * @property-read int|null $solicitudes_count
 * @mixin \Eloquent
 */
	class SolicitudEstado extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Stock
 *
 * @package App\Models
 * @version July 27, 2022, 12:25 pm CST
 * @property \App\Models\Item $item
 * @property \Illuminate\Database\Eloquent\Collection $stocksTransacciones
 * @property integer $item_id
 * @property string $lote
 * @property string|\Carbon\Carbon $fecha_ing
 * @property string $fecha_vence
 * @property number $precio_compra
 * @property number $cantidad
 * @property number $sub_total
 * @property number $cantidad_inicial
 * @property boolean $orden_salida
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $codigo
 * @property-read mixed $responsable
 * @property-read \App\Models\Kardex|null $kardex
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StockTransaccion[] $transaccion
 * @property-read int|null $transaccion_count
 * @method static \Illuminate\Database\Eloquent\Builder|Stock conStock()
 * @method static \Database\Factories\StockFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newQuery()
 * @method static \Illuminate\Database\Query\Builder|Stock onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock quedanMeses($meses)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock query()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock vencidos()
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
 * @method static \Illuminate\Database\Query\Builder|Stock withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Stock withoutTrashed()
 * @property int|null $bodega_id
 * @method static \Illuminate\Database\Eloquent\Builder|Stock conIngresos()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereBodegaId($value)
 * @property-read \App\Models\Bodega|null $bodega
 * @method static \Illuminate\Database\Eloquent\Builder|Stock deBodega($bodega = null)
 * @mixin \Eloquent
 */
	class Stock extends \Eloquent {}
}

namespace App\Models{
/**
 * Class StockInicial
 *
 * @package App\Models
 * @version July 27, 2022, 12:23 pm CST
 * @property \App\Models\Item $item
 * @property \App\Models\User $user
 * @property integer $item_id
 * @property number $cantidad
 * @property integer $user_id
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\StockInicialFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial newQuery()
 * @method static \Illuminate\Database\Query\Builder|StockInicial onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial query()
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|StockInicial withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StockInicial withoutTrashed()
 * @mixin \Eloquent
 */
	class StockInicial extends \Eloquent {}
}

namespace App\Models{
/**
 * Class StockTransaccion
 *
 * @package App\Models
 * @version July 27, 2022, 12:26 pm CST
 * @property \App\Models\Stock $stock
 * @property string $model_type
 * @property integer $model_id
 * @property integer $stock_id
 * @property string $tipo
 * @property number $cantidad
 * @property number $precio_costo
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\StockTransaccionFactory factory(...$parameters)
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
 * @package App\Models
 * @version July 27, 2022, 12:21 pm CST
 * @property \App\Models\Magnitude $magnitude
 * @property \Illuminate\Database\Eloquent\Collection $items
 * @property integer $magnitud_id
 * @property string $simbolo
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $items_count
 * @property-read \App\Models\Magnitud $magnitud
 * @method static \Database\Factories\UnimedFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed newQuery()
 * @method static \Illuminate\Database\Query\Builder|Unimed onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed query()
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed whereMagnitudId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed whereSimbolo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Unimed withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Unimed withoutTrashed()
 * @mixin \Eloquent
 */
	class Unimed extends \Eloquent {}
}

namespace App\Models{
/**
 * Class User
 *
 * @package App\Models
 * @version August 6, 2022, 10:40 am CST
 * @property \App\Models\Bodega $bodega
 * @property \App\Models\RrhhPuesto $puesto
 * @property \App\Models\RrhhUnidad $unidad
 * @property \Illuminate\Database\Eloquent\Collection $compra1hs
 * @property \Illuminate\Database\Eloquent\Collection $compras
 * @property \Illuminate\Database\Eloquent\Collection $compra1s
 * @property \Illuminate\Database\Eloquent\Collection $itemsTraslados
 * @property \Illuminate\Database\Eloquent\Collection $kardexs
 * @property \Illuminate\Database\Eloquent\Collection $options
 * @property \Illuminate\Database\Eloquent\Collection $rrhhUnidade2s
 * @property \Illuminate\Database\Eloquent\Collection $solicitudes
 * @property \Illuminate\Database\Eloquent\Collection $solicitude3s
 * @property \Illuminate\Database\Eloquent\Collection $solicitude4s
 * @property \Illuminate\Database\Eloquent\Collection $solicitude5s
 * @property \Illuminate\Database\Eloquent\Collection $solicitude6s
 * @property \Illuminate\Database\Eloquent\Collection $stockIniciales
 * @property \App\Models\UserDespachaUser $userDespachaUser
 * @property \Illuminate\Database\Eloquent\Collection $userDespachaUser7s
 * @property \Illuminate\Database\Eloquent\Collection $option8s
 * @property string $username
 * @property string $name
 * @property string $nit
 * @property string $email
 * @property string|\Carbon\Carbon $email_verified_at
 * @property string $password
 * @property integer $unidad_id
 * @property integer $puesto_id
 * @property string $provider
 * @property string $provider_uid
 * @property string $remember_token
 * @property int $id
 * @property int|null $dpi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read int|null $compra1hs_count
 * @property-read int|null $compras_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Compra[] $comprasRecibe
 * @property-read int|null $compras_recibe_count
 * @property-read mixed $img
 * @property-read mixed $thumb
 * @property-read \App\Models\RrhhUnidad|null $jefeUnidad
 * @property-read int|null $kardexs_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\App\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read int|null $options_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Option[] $shortcuts
 * @property-read int|null $shortcuts_count
 * @property-read int|null $solicitudes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Solicitud[] $solicitudesAprueba
 * @property-read int|null $solicitudes_aprueba_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Solicitud[] $solicitudesAutoriza
 * @property-read int|null $solicitudes_autoriza_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Solicitud[] $solicitudesCrea
 * @property-read int|null $solicitudes_crea_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Solicitud[] $solicitudesDespacha
 * @property-read int|null $solicitudes_despacha_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $usersDespacha
 * @property-read int|null $users_despacha_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $usersSolicita
 * @property-read int|null $users_solicita_count
 * @method static \Illuminate\Database\Eloquent\Builder|User admins()
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User noClientes()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
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
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @property-read int|null $items_traslados_count
 * @property-read int|null $stock_iniciales_count
 * @property int|null $bodega_id
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBodegaId($value)
 * @property-read mixed $miniatura
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutRole($roles, $guard = null)
 * @mixin \Eloquent
 * @property-read mixed $rubrica
 */
	class User extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * Class UserDespachaUser
 *
 * @package App\Models
 * @version July 27, 2022, 12:26 pm CST
 * @property \App\Models\User $userSol
 * @property \App\Models\User $userDes
 * @property integer $user_des
 * @property int $user_sol
 * @method static \Database\Factories\UserDespachaUserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDespachaUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDespachaUser newQuery()
 * @method static \Illuminate\Database\Query\Builder|UserDespachaUser onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDespachaUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDespachaUser whereUserDes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDespachaUser whereUserSol($value)
 * @method static \Illuminate\Database\Query\Builder|UserDespachaUser withTrashed()
 * @method static \Illuminate\Database\Query\Builder|UserDespachaUser withoutTrashed()
 * @mixin \Eloquent
 */
	class UserDespachaUser extends \Eloquent {}
}

