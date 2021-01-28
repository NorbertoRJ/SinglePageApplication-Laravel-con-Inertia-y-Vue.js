<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Módulo de Notas
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div class="md:grid md:grid-cols-3 md:gap-6"> 
                   <!--md significa pantallas medianas, sintaxis de responsive desing inmediata
                    md:grid-cols3 que tenga 3 columnas, cuadricula de 3 columnas
                    md:gap-6 para que entre columnas tenga ese nivel de espacio
                   -->
                    <div class="md:col-span-1">
                        <!--md:col-span-1
                        si yo trabajo sin el md funcionara en cualquier pantalla
                        aquí solo estamos indicando como se comportara en pantallas medianas 
                        si es más pequeño de mediano usa toda la pantalla, más grande usa md en adelante-->
                        <div class="px-4 sm:px0"> <!--pantallas medianas en adelante padding de 4, en pequeñas sin padding-->
                            <h3 class="text-lg text-gray-900">Listado de notas</h3>              
                            <p class="text-sm text-gray-600">Toma el registro correcto y ejecuta cualquier función (ver, editar o eliminar)</p>
                        </div>
                    </div>
                    <div class="md:col-span-2 mt-5 md:mt-0">
                        <div class="shadow bg-white md:rounded-md p-4">
                            <div class="flex justify-between"><!--Espacio entre elementos sea igual-->
                                <input type="text" class="form-input rounded-md shadow-sm" placeholder="Buscar..." v-model="q">
                                <inertia-link :href="route('notes.create')" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md">
                                    Crear
                                </inertia-link>
                            </div>
                            <hr class="my-6">
                            <table>
                                <!--<tr v-for="(note, i) in notes" :key="i"> -- se usa un key generico-->
                                <tr v-for="note in notes" :key="note.id"> <!-- usamos el id como key -->
                                <!--<tr v-for="note in notes">--Opcion maestro Italo, con vue puro da error-->
                                    <td class="border px-4 py-2">
                                        {{ note.excerpt}}
                                    </td>
                                    <td class="px-4 py-2">
                                        <inertia-link :href="route('notes.show',note.id)">
                                            Ver
                                        </inertia-link>
                                    </td>
                                     <td class="px-4 py-2">
                                        <inertia-link :href="route('notes.edit',note.id)">
                                            Editar
                                        </inertia-link>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
               </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    //import Welcome from '@/Jetstream/Welcome'

    export default {
        components: {
            AppLayout,
        //    Welcome,
        },
        props:{
            notes:Array,
        },
        data(){
            return{
                q: ''
            }
        },
        watch: {
            q: function(value){
                this.$inertia.replace(this.route('notes.index',{q: value}))
            }
        }
    }
</script>
