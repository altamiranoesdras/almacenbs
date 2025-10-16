@extends('layouts.app')

@section('titulo_pagina', __('Unidades / Dependencias'))

@section('content')

    <!-- Content Header (Page header) -->
    <x-content-header titulo="Unidades / Dependencias">
        <a class="btn btn-outline-success round"
           href="{!! route('rrhhUnidades.create') !!}">
            <i class="fa fa-plus"></i>
            <span class="d-none d-sm-inline">Nueva Unidad</span>
        </a>
    </x-content-header>

    <div class="content-body">
        <div class="card card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <button type="button" id="expand-all" class="btn btn-outline-primary btn-sm">
                            <i class="fa fa-angle-double-down"></i> <span class="d-none d-sm-inline">Expandir todo</span>
                        </button>
                        <button type="button" id="collapse-all" class="btn btn-outline-secondary btn-sm">
                            <i class="fa fa-angle-double-up"></i> <span class="d-none d-sm-inline">Contraer todo</span>
                        </button>
                    </div>

                </div>

                <ul class="tree tree-root list-unstyled m-0">
                    @include('rrhh_unidads.partials.listado_unidades')
                </ul>
            </div>
        </div>
    </div>
@endsection

@push('estilos')
    <style>
        /* ----- Líneas estilo árbol ----- */
        .tree, .tree ul { position: relative; }
        .tree ul { margin-left: 1.25rem; padding-left: 1rem; }
        .tree li { list-style: none; position: relative; padding-left: .5rem; }

        /* Línea vertical del contenedor */
        .tree ul:before {
            content: ""; position: absolute; top: 0; bottom: 0; left: .25rem;
            border-left: 1px solid #c9c9c9;
        }
        /* Conectores horizontales */
        .tree li:before {
            content: ""; position: absolute; top: .95rem; left: .25rem; width: .9rem;
            border-top: 1px solid #c9c9c9;
        }

        /* ----- Nodo ----- */
        .node-row {
            display: flex; align-items: center; gap: .5rem;
            padding: .25rem .4rem; border-radius: .4rem; cursor: default;
        }
        .node-row:hover { background: rgba(0,0,0,.035); }

        /* Toggle estilo +/- cuadrado */
        .toggle {
            width: 1.1rem; height: 1.1rem; border: 1px solid #c9c9c9; border-radius: .15rem;
            font-size: .7rem; line-height: 1.05rem; text-align: center; cursor: pointer;
            user-select: none; background: #fff;
        }
        .toggle[aria-expanded="true"] .minus { display: inline; }
        .toggle[aria-expanded="true"] .plus  { display: none; }
        .toggle[aria-expanded="false"] .minus{ display: none; }
        .toggle[aria-expanded="false"] .plus { display: inline; }

        /* Ícono de carpeta */
        .folder { width: 1.15rem; text-align: center; }

        /* Identación visual del primer nivel (sin conector a la izquierda) */
        .tree-root > li:before,
        .tree-root > ul:before { display: none; }

        /* Texto */
        .unidad-codigo{ font-weight: 600; }
        .unidad-tipo  { color:#6c757d; font-size:.9rem; }

        /* Acciones a la derecha */
        .node-actions { margin-left:auto; display:inline-flex; gap:.25rem; }
    </style>
@endpush

@push('scripts')
    <script>
        (() => {
            const STORAGE_KEY = 'rrhh_tree_open_nodes';
            const getState = () => JSON.parse(localStorage.getItem(STORAGE_KEY) || '{}');
            const setState = (s) => localStorage.setItem(STORAGE_KEY, JSON.stringify(s));

            function toggleById(id, expand) {
                const body = document.getElementById('children-' + id);
                const btn  = document.querySelector('[data-bs-target="#children-' + id + '"]');
                if (!body || !btn) return;
                const c = bootstrap.Collapse.getOrCreateInstance(body, { toggle:false });
                expand ? c.show() : c.hide();
                btn.setAttribute('aria-expanded', expand ? 'true' : 'false');
                // Cambiar icono carpeta
                const folder = btn.closest('li')?.querySelector('.folder i');
                if (folder) folder.classList.toggle('fa-folder-open', expand),
                    folder.classList.toggle('fa-folder', !expand);
            }

            function expandAll(){
                document.querySelectorAll('.tree-children.collapse').forEach(el=>{
                    const id = el.id.replace('children-',''); toggleById(id,true);
                });
                const st={}; document.querySelectorAll('.tree-children.collapse').forEach(el=>{
                    st[el.id.replace('children-','')] = true;
                }); setState(st);
            }
            function collapseAll(){
                document.querySelectorAll('.tree-children.collapse').forEach(el=>{
                    const id = el.id.replace('children-',''); toggleById(id,false);
                }); setState({});
            }

            document.addEventListener('DOMContentLoaded', ()=>{
                const state = getState();
                document.querySelectorAll('.tree-children.collapse').forEach(el=>{
                    const id = el.id.replace('children-','');
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

                document.getElementById('expand-all')?.addEventListener('click', expandAll);
                document.getElementById('collapse-all')?.addEventListener('click', collapseAll);

                // Toggle al hacer click en la fila (menos en acciones)
                document.querySelectorAll('.node-row[data-toggle-row="true"]').forEach(row=>{
                    row.addEventListener('click', (e)=>{
                        if (e.target.closest('.node-actions') || e.target.closest('a')) return;
                        const btn = row.querySelector('.toggle'); if (!btn) return;
                        const id = btn.getAttribute('data-target').replace('#children-','');
                        const expanded = btn.getAttribute('aria-expanded')==='true';
                        toggleById(id, !expanded);
                    });
                });
            });
        })();
    </script>
@endpush
