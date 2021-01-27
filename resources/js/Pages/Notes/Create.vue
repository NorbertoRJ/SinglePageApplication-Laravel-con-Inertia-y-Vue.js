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
                            <h3 class="text-lg text-gray-900">Crear de una nota</h3>              
                            <p class="text-sm text-gray-600">Luego de crear la podrás editar</p>
                        </div>
                    </div>
                    <div class="md:col-span-2 mt-5 md:mt-0">
                        <div class="shadow bg-white md:rounded-md p-4">
                           <form @submit.prevent="submit">
                               <!--usar clases de tailwind css-->
                               <label class="block font-medium text-sm text-gray-700">
                                   Resumen
                                </label>
                               <textarea
                                    class="form-input w-full rounded-md shadow-sm"
                                    v-model="form.excerpt">
                                </textarea>
                               <label class="block font-medium text-sm text-gray-700">
                                   Contenido
                                </label>
                                <textarea
                                    class="form-input w-full rounded-md shadow-sm"
                                    v-model="form.content"
                                    rows="8">
                                </textarea>
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                                    Crear
                                </button>
                           </form>
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
        data(){
            return{
                form:{
                    excerpt: '',
                    content: '',
                }
            }
        },
        methods:{
            submit(){
                this.$inertia.post(this.route('notes.store'), this.form)
            }
        }
    }
</script>
