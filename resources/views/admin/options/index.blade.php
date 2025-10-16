@extends('layouts.app')

@section('titulo_pagina', 'Opciones')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Opciones</h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <div class="dropdown">
                    <a class="btn btn-outline-success round" href="{!! route('dev.options.create') !!}">
                        <i class="fa fa-plus"></i>
                        <span class="d-none d-sm-inline">{{__('New')}}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header d-flex gap-2">
                        <button type="button" id="expand-all" class="btn btn-outline-primary round">
                            <i class="fa fa-angle-double-down"></i> <span class="d-none d-sm-inline">Expandir todo</span>
                        </button>
                        <button type="button" id="collapse-all" class="btn btn-outline-secondary round">
                            <i class="fa fa-angle-double-up"></i> <span class="d-none d-sm-inline">Contraer todo</span>
                        </button>
                    </div>
                    <div class="card-body pt-0">
                        <ul class="tree tree-root list-unstyled m-0 sortable">
                            @include('admin.options.partials.list_admin')
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('layouts.plugins.jquery-ui')

@push('estilos')
    <style>
        /* Líneas estilo árbol */
        .tree, .tree ul { position: relative; }
        .tree ul { margin-left: 1.25rem; padding-left: 1rem; }
        .tree li { list-style: none; position: relative; padding-left: .5rem; }
        .tree ul:before {
            content: ""; position: absolute; top: 0; bottom: 0; left: .25rem;
            border-left: 1px solid #c9c9c9;
        }
        .tree li:before {
            content: ""; position: absolute; top: .95rem; left: .25rem; width: .9rem;
            border-top: 1px solid #c9c9c9;
        }
        .tree-root > li:before, .tree-root > ul:before { display: none; }

        /* Fila de nodo */
        .node-row {
            display: flex; align-items: center; gap: .5rem;
            padding: .25rem .4rem; border-radius: .4rem; cursor: default;
        }
        .node-row:hover { background: rgba(0,0,0,.035); }

        /* Toggle +/- */
        .toggle {
            width: 1.1rem; height: 1.1rem; border: 1px solid #c9c9c9; border-radius: .15rem;
            font-size: .7rem; line-height: 1.05rem; text-align: center; cursor: pointer;
            user-select: none; background: #fff;
        }
        .toggle[aria-expanded="true"] .minus { display: inline; }
        .toggle[aria-expanded="true"] .plus  { display: none; }
        .toggle[aria-expanded="false"] .minus{ display: none; }
        .toggle[aria-expanded="false"] .plus { display: inline; }

        /* Carpeta/ícono */
        .folder { width: 1.15rem; text-align: center; }
        .unidad-codigo{ font-weight: 600; }
        .unidad-tipo  { color:#6c757d; font-size:.9rem; }

        /* Acciones a la derecha */
        .node-actions { margin-left:auto; display:inline-flex; gap:.25rem; }

        /* Sortable helpers */
        .sortable-placeholder {
            border: 1px dashed #9aa0a6; height: 2rem; background: rgba(0,0,0,.03);
        }
        .handle { cursor: move; color:#6c757d; }
    </style>
@endpush

@push('scripts')
    <script>
        (function(){
            const STORAGE_KEY = 'dev_options_tree_open_nodes';

            const getState = () => JSON.parse(localStorage.getItem(STORAGE_KEY) || '{}');
            const setState = (s) => localStorage.setItem(STORAGE_KEY, JSON.stringify(s));

            function toggleById(id, expand){
                const body = document.getElementById('children-'+id);
                const btn  = document.querySelector('[data-bs-target="#children-'+id+'"]');
                if(!body || !btn) return;
                const c = bootstrap.Collapse.getOrCreateInstance(body,{toggle:false});
                expand ? c.show() : c.hide();
                btn.setAttribute('aria-expanded', expand ? 'true':'false');

                // Cambia ícono de carpeta (si existe)
                const folder = btn.closest('li')?.querySelector('.folder i');
                if(folder){
                    folder.classList.toggle('fa-folder-open', expand);
                    folder.classList.toggle('fa-folder', !expand);
                }
            }

            function expandAll(){
                document.querySelectorAll('.tree-children.collapse').forEach(el=>{
                    toggleById(el.id.replace('children-',''), true);
                });
                const st={}; document.querySelectorAll('.tree-children.collapse').forEach(el=>{
                    st[el.id.replace('children-','')] = true;
                }); setState(st);
            }
            function collapseAll(){
                document.querySelectorAll('.tree-children.collapse').forEach(el=>{
                    toggleById(el.id.replace('children-',''), false);
                });
                setState({});
            }

            document.addEventListener('DOMContentLoaded', function(){

                // Inicializar colapsables con estado persistido
                const state = getState();
                document.querySelectorAll('.tree-children.collapse').forEach(el=>{
                    const id  = el.id.replace('children-','');
                    const btn = document.querySelector('[data-bs-target="#'+el.id+'"]');
                    const open = state[id] ?? true; // por defecto abierto
                    const c = bootstrap.Collapse.getOrCreateInstance(el,{toggle:false});
                    open ? c.show() : c.hide();
                    btn?.setAttribute('aria-expanded', open ? 'true':'false');

                    el.addEventListener('shown.bs.collapse', ()=>{
                        const s=getState(); s[id]=true; setState(s);
                        const folder = btn.closest('li')?.querySelector('.folder i');
                        if (folder) { folder.classList.add('fa-folder-open'); folder.classList.remove('fa-folder'); }
                    });
                    el.addEventListener('hidden.bs.collapse', ()=>{
                        const s=getState(); delete s[id]; setState(s);
                        const folder = btn.closest('li')?.querySelector('.folder i');
                        if (folder) { folder.classList.remove('fa-folder-open'); folder.classList.add('fa-folder'); }
                    });
                });

                // Toggle click en fila (excepto acciones/enlaces/área de drag)
                document.querySelectorAll('.node-row[data-toggle-row="true"]').forEach(row=>{
                    row.addEventListener('click',(e)=>{
                        if (e.target.closest('.node-actions') || e.target.closest('a') || e.target.closest('.handle')) return;
                        const btn = row.querySelector('.toggle'); if(!btn) return;
                        const id  = btn.getAttribute('data-target').replace('#children-','');
                        const expanded = btn.getAttribute('aria-expanded')==='true';
                        toggleById(id, !expanded);
                    });
                });

                // ---- jQuery UI Sortable (anidado) ----
                // Evita conflicto con toggle/acciones usando cancel:
                $('.sortable').sortable({
                    items: '> li',
                    placeholder: 'sortable-placeholder',
                    tolerance: 'pointer',
                    handle: '.handle',
                    cancel: '.toggle, .node-actions, a, button',
                    connectWith: '.sortable',   // permitir reordenar entre niveles
                    update: function(event, ui) {
                        // Recolectar IDs del contenedor que cambió
                        const opciones = [];
                        $(this).children('li').each(function(){
                            opciones.push($(this).attr('id'));
                        });

                        const url = "{{ route('dev.option.order.store') }}";
                        const params = { params: { opciones } };

                        axios.get(url, params)
                            .then(resp => alertSucces(resp.data.message))
                            .catch(error => {
                                if (error.response) {
                                    alertWarning("Ooops...", error.response.data.message, null);
                                } else {
                                    console.log(error);
                                }
                            });
                    }
                }).disableSelection();

                // Botones globales
                document.getElementById('expand-all')?.addEventListener('click', expandAll);
                document.getElementById('collapse-all')?.addEventListener('click', collapseAll);
            });
        })();
    </script>
@endpush
